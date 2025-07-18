<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

<<<<<<< HEAD
require_once '../includes/functions.php';
=======
require_once 'includes/functions.php';
>>>>>>> 98990f230d3f5d2c1fbd352988704faec16ca3f6

try {
    $time_slots = getTimeSlots();
    
    // Format the data for JSON response
    $availability = [];
    foreach ($time_slots as $slot) {
        $availability[] = [
            'id' => $slot['id'],
            'available_seats' => $slot['available_seats'],
            'max_seats' => $slot['max_seats'],
            'date_time' => $slot['date_time'],
            'time_range' => $slot['time_range']
        ];
    }
    
    echo json_encode($availability);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to get availability data']);
}
?> 