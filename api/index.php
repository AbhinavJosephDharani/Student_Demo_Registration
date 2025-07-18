<?php
<<<<<<< HEAD
// Vercel deployment ready - Student Demo Registration System
// Simple test file for Vercel deployment

echo "Student Demo Registration System - API Index";
echo "<br>";
echo "Status: Running on Vercel";
echo "<br>";
echo "Time: " . date('Y-m-d H:i:s');
?> 
=======
require_once 'includes/functions.php';

$page_title = 'Student Demo Registration';
$errors = [];
$success_message = '';
$form_data = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data
    $form_data = [
        'id' => sanitizeInput($_POST['studentId'] ?? ''),
        'first_name' => sanitizeInput($_POST['firstName'] ?? ''),
        'last_name' => sanitizeInput($_POST['lastName'] ?? ''),
        'project_title' => sanitizeInput($_POST['projectTitle'] ?? ''),
        'email' => sanitizeInput($_POST['email'] ?? ''),
        'phone' => sanitizeInput($_POST['phone'] ?? ''),
        'time_slot_id' => (int)($_POST['timeSlot'] ?? 0)
    ];

    // Server-side validation
    if (!validateStudentID($form_data['id'])) {
        $errors['studentId'] = 'Student ID must be exactly 8 digits';
    }

    if (!validateName($form_data['first_name'])) {
        $errors['firstName'] = 'First name must contain only letters and cannot be empty';
    }

    if (!validateName($form_data['last_name'])) {
        $errors['lastName'] = 'Last name must contain only letters and cannot be empty';
    }

    if (!validateEmail($form_data['email'])) {
        $errors['email'] = 'Please enter a valid email address';
    }

    if (!validatePhone($form_data['phone'])) {
        $errors['phone'] = 'Phone number must be in format: 999-999-9999';
    }

    if (!validateProjectTitle($form_data['project_title'])) {
        $errors['projectTitle'] = 'Project title cannot be empty';
    }

    if ($form_data['time_slot_id'] <= 0) {
        $errors['timeSlot'] = 'Please select a time slot';
    }

    // Check time slot availability
    if (empty($errors['timeSlot'])) {
        $available_seats = checkTimeSlotAvailability($form_data['time_slot_id']);
        if ($available_seats <= 0) {
            $errors['timeSlot'] = 'This time slot is full. Please select another time slot.';
        }
    }

    // If no validation errors, process registration
    if (empty($errors)) {
        // Check if student already exists
        $existing_student = getStudentByID($form_data['id']);
        
        if ($existing_student) {
            // Student already registered - show confirmation dialog
            $success_message = "Student ID {$form_data['id']} is already registered. Your registration will be updated to the new time slot.";
        }
        
        // Attempt to register/update student
        if (registerStudent($form_data)) {
            if ($existing_student) {
                $success_message = "Registration updated successfully! You are now registered for the selected time slot.";
            } else {
                $success_message = "Registration successful! You have been registered for the selected time slot.";
            }
            // Clear form data after successful registration
            $form_data = [];
        } else {
            $errors['general'] = 'Registration failed. Please try again.';
        }
    }
}

// Get time slots with availability
$time_slots = getTimeSlots();
?>

<?php include 'includes/header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fas fa-user-plus"></i>
            Student Demo Registration
        </h2>
        <p class="card-subtitle">
            Register for your project demonstration time slot. All fields are required.
        </p>
    </div>

    <?php if ($success_message): ?>
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span><?php echo htmlspecialchars($success_message); ?></span>
        </div>
    <?php endif; ?>

    <?php if (isset($errors['general'])): ?>
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo htmlspecialchars($errors['general']); ?></span>
        </div>
    <?php endif; ?>

    <form id="registrationForm" method="POST" action="">
        <div class="form-group">
            <label for="studentId" class="form-label">Student ID *</label>
            <input 
                type="text" 
                id="studentId" 
                name="studentId" 
                class="form-input <?php echo isset($errors['studentId']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['id'] ?? ''); ?>"
                placeholder="Enter 8-digit student ID"
                maxlength="8"
                required
            >
            <div class="error-message <?php echo isset($errors['studentId']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['studentId'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="firstName" class="form-label">First Name *</label>
            <input 
                type="text" 
                id="firstName" 
                name="firstName" 
                class="form-input <?php echo isset($errors['firstName']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['first_name'] ?? ''); ?>"
                placeholder="Enter your first name"
                required
            >
            <div class="error-message <?php echo isset($errors['firstName']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['firstName'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="lastName" class="form-label">Last Name *</label>
            <input 
                type="text" 
                id="lastName" 
                name="lastName" 
                class="form-input <?php echo isset($errors['lastName']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['last_name'] ?? ''); ?>"
                placeholder="Enter your last name"
                required
            >
            <div class="error-message <?php echo isset($errors['lastName']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['lastName'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="projectTitle" class="form-label">Project Title *</label>
            <input 
                type="text" 
                id="projectTitle" 
                name="projectTitle" 
                class="form-input <?php echo isset($errors['projectTitle']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['project_title'] ?? ''); ?>"
                placeholder="Enter your project title"
                required
            >
            <div class="error-message <?php echo isset($errors['projectTitle']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['projectTitle'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="form-label">Email Address *</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-input <?php echo isset($errors['email']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['email'] ?? ''); ?>"
                placeholder="Enter your email address"
                required
            >
            <div class="error-message <?php echo isset($errors['email']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['email'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="form-label">Phone Number *</label>
            <input 
                type="tel" 
                id="phone" 
                name="phone" 
                class="form-input <?php echo isset($errors['phone']) ? 'error' : ''; ?>"
                value="<?php echo htmlspecialchars($form_data['phone'] ?? ''); ?>"
                placeholder="999-999-9999"
                required
            >
            <div class="error-message <?php echo isset($errors['phone']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['phone'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Select Time Slot *</label>
            <div class="time-slots">
                <?php foreach ($time_slots as $slot): ?>
                    <div class="time-slot <?php echo $slot['available_seats'] <= 0 ? 'full' : ''; ?>" 
                         data-time-slot-id="<?php echo $slot['id']; ?>">
                        <div class="time-slot-header">
                            <div class="time-slot-title">
                                <?php echo htmlspecialchars(formatTimeSlot($slot['date_time'], $slot['time_range'])); ?>
                            </div>
                            <div class="time-slot-seats <?php echo $slot['available_seats'] > 0 ? 'seats-available' : 'seats-full'; ?>">
                                <?php echo $slot['available_seats']; ?> seats remaining
                            </div>
                        </div>
                        <div class="time-slot-datetime">
                            <input 
                                type="radio" 
                                name="timeSlot" 
                                value="<?php echo $slot['id']; ?>"
                                id="slot_<?php echo $slot['id']; ?>"
                                <?php echo ($form_data['time_slot_id'] ?? 0) == $slot['id'] ? 'checked' : ''; ?>
                                <?php echo $slot['available_seats'] <= 0 ? 'disabled' : ''; ?>
                                required
                            >
                            <label for="slot_<?php echo $slot['id']; ?>">
                                <?php echo htmlspecialchars($slot['date_time'] . ', ' . $slot['time_range']); ?>
                            </label>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div id="timeSlotError" class="error-message <?php echo isset($errors['timeSlot']) ? 'show' : ''; ?>">
                <?php echo htmlspecialchars($errors['timeSlot'] ?? ''); ?>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i>
                Register for Demo
            </button>
        </div>
    </form>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-info-circle"></i>
            Registration Information
        </h3>
    </div>
    <div class="alert alert-info">
        <i class="fas fa-info-circle"></i>
        <div>
            <strong>Important Notes:</strong>
            <ul style="margin-top: 0.5rem; margin-left: 1rem;">
                <li>Student ID must be exactly 8 digits</li>
                <li>Names must contain only letters</li>
                <li>Email must follow standard format with valid domain</li>
                <li>Phone number must be in format: 999-999-9999</li>
                <li>Each time slot can accommodate up to 6 students</li>
                <li>If you're already registered, your registration will be updated to the new time slot</li>
            </ul>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?> 
>>>>>>> 98990f230d3f5d2c1fbd352988704faec16ca3f6
