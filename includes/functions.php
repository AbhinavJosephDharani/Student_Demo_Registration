<?php
require_once 'config/database.php';

// Validation functions
function validateStudentID($id) {
    return preg_match('/^\d{8}$/', $id);
}

function validateName($name) {
    return !empty($name) && preg_match('/^[a-zA-Z\s]+$/', $name);
}

function validateEmail($email) {
    // Email validation with domain restrictions
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($pattern, $email)) {
        return false;
    }
    
    // Check domain length and format
    $parts = explode('@', $email);
    if (count($parts) !== 2) {
        return false;
    }
    
    $domain = $parts[1];
    $labels = explode('.', $domain);
    
    // Check total domain length (max 80 characters including dots)
    if (strlen($domain) > 80) {
        return false;
    }
    
    // Check each label (1-20 alphanumeric characters)
    foreach ($labels as $label) {
        if (strlen($label) < 1 || strlen($label) > 20 || !preg_match('/^[a-zA-Z0-9]+$/', $label)) {
            return false;
        }
    }
    
    return true;
}

function validatePhone($phone) {
    return preg_match('/^\d{3}-\d{3}-\d{4}$/', $phone);
}

function validateProjectTitle($title) {
    return !empty(trim($title));
}

// Database functions
function getTimeSlots() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("
        SELECT ts.*, 
               (ts.max_seats - COALESCE(COUNT(s.id), 0)) as available_seats
        FROM time_slots ts
        LEFT JOIN students s ON ts.id = s.time_slot_id
        GROUP BY ts.id
        ORDER BY ts.date_time, ts.time_range
    ");
    return $stmt->fetchAll();
}

function getStudentByID($id) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM students WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch();
}

function registerStudent($data) {
    $pdo = getDBConnection();
    
    // Check if student already exists
    $existing = getStudentByID($data['id']);
    
    if ($existing) {
        // Update existing registration
        $stmt = $pdo->prepare("
            UPDATE students 
            SET first_name = ?, last_name = ?, project_title = ?, 
                email = ?, phone = ?, time_slot_id = ?, updated_at = CURRENT_TIMESTAMP
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['first_name'], $data['last_name'], $data['project_title'],
            $data['email'], $data['phone'], $data['time_slot_id'], $data['id']
        ]);
    } else {
        // Insert new registration
        $stmt = $pdo->prepare("
            INSERT INTO students (id, first_name, last_name, project_title, email, phone, time_slot_id)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['id'], $data['first_name'], $data['last_name'], 
            $data['project_title'], $data['email'], $data['phone'], $data['time_slot_id']
        ]);
    }
}

function getAllStudents() {
    $pdo = getDBConnection();
    $stmt = $pdo->query("
        SELECT s.*, ts.date_time, ts.time_range
        FROM students s
        JOIN time_slots ts ON s.time_slot_id = ts.id
        ORDER BY ts.date_time, ts.time_range, s.last_name, s.first_name
    ");
    return $stmt->fetchAll();
}

function checkTimeSlotAvailability($timeSlotId) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("
        SELECT ts.max_seats, COUNT(s.id) as registered_count
        FROM time_slots ts
        LEFT JOIN students s ON ts.id = s.time_slot_id
        WHERE ts.id = ?
        GROUP BY ts.id
    ");
    $stmt->execute([$timeSlotId]);
    $result = $stmt->fetch();
    
    if ($result) {
        return $result['max_seats'] - $result['registered_count'];
    }
    return 0;
}

// Utility functions
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function formatTimeSlot($dateTime, $timeRange) {
    return $dateTime . ', ' . $timeRange;
}

function getStudentByEmail($email) {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}
?> 