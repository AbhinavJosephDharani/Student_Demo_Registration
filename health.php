<?php
header('Content-Type: application/json');

$status = [
    'status' => 'healthy',
    'timestamp' => date('Y-m-d H:i:s'),
    'php_version' => phpversion(),
    'extensions' => [
        'pdo' => extension_loaded('pdo'),
        'pdo_mysql' => extension_loaded('pdo_mysql'),
        'json' => extension_loaded('json')
    ]
];

// Test database connection if credentials are available
if (!empty($_ENV['DB_HOST'])) {
    try {
        require_once 'config/database.php';
        $pdo = getDBConnection();
        $status['database'] = 'connected';
        
        // Test a simple query
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM time_slots");
        $result = $stmt->fetch();
        $status['time_slots_count'] = $result['count'];
        
    } catch (Exception $e) {
        $status['database'] = 'error';
        $status['database_error'] = $e->getMessage();
    }
} else {
    $status['database'] = 'not_configured';
}

echo json_encode($status, JSON_PRETTY_PRINT);
?> 