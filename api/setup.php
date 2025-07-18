<?php
// Setup script for Student Demo Registration System
echo "<h1>Student Demo Registration System - Setup</h1>";

// Check PHP version
echo "<h2>System Requirements Check</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>PDO Extension:</strong> " . (extension_loaded('pdo') ? '✓ Available' : '✗ Not Available') . "</p>";
echo "<p><strong>PDO MySQL Extension:</strong> " . (extension_loaded('pdo_mysql') ? '✓ Available' : '✗ Not Available') . "</p>";

// Test database connection
echo "<h2>Database Connection Test</h2>";
try {
    require_once 'config/database.php';
    $pdo = getDBConnection();
    echo "<p style='color: green;'>✓ Database connection successful!</p>";
    
    // Check if tables exist
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (in_array('time_slots', $tables) && in_array('students', $tables)) {
        echo "<p style='color: green;'>✓ Database tables exist!</p>";
        
        // Count time slots
        $stmt = $pdo->query("SELECT COUNT(*) FROM time_slots");
        $timeSlotCount = $stmt->fetchColumn();
        echo "<p><strong>Time Slots:</strong> {$timeSlotCount}</p>";
        
        // Count students
        $stmt = $pdo->query("SELECT COUNT(*) FROM students");
        $studentCount = $stmt->fetchColumn();
        echo "<p><strong>Registered Students:</strong> {$studentCount}</p>";
        
    } else {
        echo "<p style='color: orange;'>⚠ Database tables not found. Please import the schema from database/schema.sql</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
    echo "<p>Please check your database configuration in config/database.php</p>";
}

echo "<h2>Next Steps</h2>";
echo "<ol>";
echo "<li>Make sure your web server is running</li>";
echo "<li>Import the database schema from database/schema.sql</li>";
echo "<li>Update database credentials in config/database.php if needed</li>";
echo "<li>Access the application at: <a href='index.php'>index.php</a></li>";
echo "<li>View admin panel at: <a href='admin.php'>admin.php</a></li>";
echo "</ol>";

echo "<h2>File Structure Check</h2>";
$requiredFiles = [
    'index.php',
    'admin.php',
    'config/database.php',
    'includes/functions.php',
    'includes/header.php',
    'includes/footer.php',
    'css/style.css',
    'js/validation.js',
    'database/schema.sql'
];

foreach ($requiredFiles as $file) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✓ {$file}</p>";
    } else {
        echo "<p style='color: red;'>✗ {$file} (missing)</p>";
    }
}
?> 