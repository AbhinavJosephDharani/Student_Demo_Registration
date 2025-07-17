require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const Student = require('./models/Student');

const app = express();
app.use(express.json());

// Connect to MongoDB
mongoose.connect(process.env.MONGODB_URI, { 
  useNewUrlParser: true, 
  useUnifiedTopology: true 
})
.then(() => console.log('MongoDB connected'))
.catch(err => console.error('MongoDB connection error:', err));

// Health check
app.get('/health', (req, res) => res.json({ status: 'ok' }));

// Register a student
app.post('/register', async (req, res) => {
  try {
    const { studentId, firstName, lastName, projectTitle, email, phone, timeSlot } = req.body;
    
    // Check if student is already registered
    const existingStudent = await Student.findOne({ studentId });
    
    if (existingStudent) {
      return res.status(400).json({ 
        error: 'Student already registered',
        message: 'A student with this ID is already registered. If you want to change your registration, please contact the instructor.',
        existingRegistration: {
          timeSlot: existingStudent.timeSlot,
          registeredAt: existingStudent.registeredAt
        }
      });
    }
    
    // Create new student registration
    const student = new Student({ 
      studentId, 
      firstName, 
      lastName, 
      projectTitle, 
      email, 
      phone, 
      timeSlot 
    });
    
    await student.save();
    
    res.status(201).json({ 
      message: 'Registration successful! You have been registered for the selected time slot.',
      student: {
        studentId: student.studentId,
        name: `${student.firstName} ${student.lastName}`,
        projectTitle: student.projectTitle,
        timeSlot: student.timeSlot
      }
    });
  } catch (err) {
    res.status(400).json({ error: err.message });
  }
});

// Admin: Get all registrations
app.get('/admin', async (req, res) => {
  try {
    const students = await Student.find().sort({ registeredAt: -1 });
    res.json(students);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

// Get time slot availability
app.get('/time-slots', async (req, res) => {
  try {
    const timeSlots = [
      { id: 1, date: '4/19/2070', time: '6:00 PM – 7:00 PM', max: 6 },
      { id: 2, date: '4/19/2070', time: '7:00 PM – 8:00 PM', max: 6 },
      { id: 3, date: '4/19/2070', time: '8:00 PM – 9:00 PM', max: 6 },
      { id: 4, date: '4/20/2070', time: '6:00 PM – 7:00 PM', max: 6 },
      { id: 5, date: '4/20/2070', time: '7:00 PM – 8:00 PM', max: 6 },
      { id: 6, date: '4/20/2070', time: '8:00 PM – 9:00 PM', max: 6 }
    ];
    
    // Get count of students in each time slot
    for (let slot of timeSlots) {
      const count = await Student.countDocuments({ timeSlot: slot.id });
      slot.available = slot.max - count;
    }
    
    res.json(timeSlots);
  } catch (err) {
    res.status(500).json({ error: err.message });
  }
});

const PORT = process.env.PORT || 3000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`)); 