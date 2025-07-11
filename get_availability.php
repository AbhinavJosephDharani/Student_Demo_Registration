<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'includes/functions.php';

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