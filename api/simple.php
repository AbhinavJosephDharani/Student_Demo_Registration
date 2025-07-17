<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Demo Registration - Simple Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: white;
        }
        .card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            margin: 2rem 0;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: #374151;
        }
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 1rem;
        }
        .btn {
            background: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
        }
        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎓 Student Demo Registration - Test Mode</h1>
        
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
            <div class="success">
                <h2>✅ Form Submitted Successfully!</h2>
                <p>This is a test mode without database connection.</p>
                <h3>Submitted Data:</h3>
                <ul>
                    <li><strong>Student ID:</strong> <?php echo htmlspecialchars($_POST['studentId'] ?? ''); ?></li>
                    <li><strong>Name:</strong> <?php echo htmlspecialchars($_POST['firstName'] ?? '') . ' ' . htmlspecialchars($_POST['lastName'] ?? ''); ?></li>
                    <li><strong>Project Title:</strong> <?php echo htmlspecialchars($_POST['projectTitle'] ?? ''); ?></li>
                    <li><strong>Email:</strong> <?php echo htmlspecialchars($_POST['email'] ?? ''); ?></li>
                    <li><strong>Phone:</strong> <?php echo htmlspecialchars($_POST['phone'] ?? ''); ?></li>
                    <li><strong>Time Slot:</strong> <?php echo htmlspecialchars($_POST['timeSlot'] ?? ''); ?></li>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="studentId" class="form-label">Student ID *</label>
                <input type="text" id="studentId" name="studentId" class="form-input" 
                       placeholder="Enter 8-digit student ID" maxlength="8" required>
            </div>
            
            <div class="form-group">
                <label for="firstName" class="form-label">First Name *</label>
                <input type="text" id="firstName" name="firstName" class="form-input" 
                       placeholder="Enter your first name" required>
            </div>
            
            <div class="form-group">
                <label for="lastName" class="form-label">Last Name *</label>
                <input type="text" id="lastName" name="lastName" class="form-input" 
                       placeholder="Enter your last name" required>
            </div>
            
            <div class="form-group">
                <label for="projectTitle" class="form-label">Project Title *</label>
                <input type="text" id="projectTitle" name="projectTitle" class="form-input" 
                       placeholder="Enter your project title" required>
            </div>
            
            <div class="form-group">
                <label for="email" class="form-label">Email Address *</label>
                <input type="email" id="email" name="email" class="form-input" 
                       placeholder="Enter your email address" required>
            </div>
            
            <div class="form-group">
                <label for="phone" class="form-label">Phone Number *</label>
                <input type="tel" id="phone" name="phone" class="form-input" 
                       placeholder="999-999-9999" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Select Time Slot *</label>
                <select name="timeSlot" class="form-input" required>
                    <option value="">Choose a time slot</option>
                    <option value="1">4/19/2070, 6:00 PM – 7:00 PM</option>
                    <option value="2">4/19/2070, 7:00 PM – 8:00 PM</option>
                    <option value="3">4/19/2070, 8:00 PM – 9:00 PM</option>
                    <option value="4">4/20/2070, 6:00 PM – 7:00 PM</option>
                    <option value="5">4/20/2070, 7:00 PM – 8:00 PM</option>
                    <option value="6">4/20/2070, 8:00 PM – 9:00 PM</option>
                </select>
            </div>
            
            <button type="submit" class="btn">📝 Submit Registration (Test Mode)</button>
        </form>
        
        <div style="margin-top: 2rem;">
            <a href="test.php" class="btn">🔧 System Test</a>
            <a href="health.php" class="btn">❤️ Health Check</a>
        </div>
    </div>
</body>
</html> 