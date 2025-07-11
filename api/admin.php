<?php
require_once 'includes/functions.php';

$page_title = 'Admin View - Student Registrations';

// Get all students with their time slot information
$students = getAllStudents();
?>

<?php include 'includes/header.php'; ?>

<div class="card">
    <div class="card-header">
        <h2 class="card-title">
            <i class="fas fa-users"></i>
            Student Registrations
        </h2>
        <p class="card-subtitle">
            View all registered students and their demo time slots
        </p>
    </div>

    <?php if (empty($students)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <span>No students have registered yet.</span>
        </div>
    <?php else: ?>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Project Title</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Time Slot</th>
                        <th>Registration Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td>
                                <strong><?php echo htmlspecialchars($student['id']); ?></strong>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($student['first_name'] . ' ' . $student['last_name']); ?>
                            </td>
                            <td>
                                <em><?php echo htmlspecialchars($student['project_title']); ?></em>
                            </td>
                            <td>
                                <a href="mailto:<?php echo htmlspecialchars($student['email']); ?>">
                                    <?php echo htmlspecialchars($student['email']); ?>
                                </a>
                            </td>
                            <td>
                                <a href="tel:<?php echo htmlspecialchars($student['phone']); ?>">
                                    <?php echo htmlspecialchars($student['phone']); ?>
                                </a>
                            </td>
                            <td>
                                <span class="badge">
                                    <?php echo htmlspecialchars($student['date_time'] . ', ' . $student['time_range']); ?>
                                </span>
                            </td>
                            <td>
                                <?php echo date('M j, Y g:i A', strtotime($student['created_at'])); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background: #f9fafb; border-radius: 0.5rem;">
            <h3 style="margin-bottom: 1rem; color: #374151;">
                <i class="fas fa-chart-bar"></i>
                Registration Summary
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                <div style="text-align: center; padding: 1rem; background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="font-size: 2rem; font-weight: bold; color: #4f46e5;">
                        <?php echo count($students); ?>
                    </div>
                    <div style="color: #6b7280; font-size: 0.875rem;">
                        Total Registrations
                    </div>
                </div>
                <div style="text-align: center; padding: 1rem; background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="font-size: 2rem; font-weight: bold; color: #10b981;">
                        <?php echo 36 - count($students); ?>
                    </div>
                    <div style="color: #6b7280; font-size: 0.875rem;">
                        Remaining Spots
                    </div>
                </div>
                <div style="text-align: center; padding: 1rem; background: white; border-radius: 0.5rem; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="font-size: 2rem; font-weight: bold; color: #f59e0b;">
                        6
                    </div>
                    <div style="color: #6b7280; font-size: 0.875rem;">
                        Time Slots
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-clock"></i>
            Time Slot Availability
        </h3>
    </div>
    
    <?php
    $time_slots = getTimeSlots();
    ?>
    
    <div class="time-slots">
        <?php foreach ($time_slots as $slot): ?>
            <div class="time-slot <?php echo $slot['available_seats'] <= 0 ? 'full' : ''; ?>">
                <div class="time-slot-header">
                    <div class="time-slot-title">
                        <?php echo htmlspecialchars(formatTimeSlot($slot['date_time'], $slot['time_range'])); ?>
                    </div>
                    <div class="time-slot-seats <?php echo $slot['available_seats'] > 0 ? 'seats-available' : 'seats-full'; ?>">
                        <?php echo $slot['available_seats']; ?> seats remaining
                    </div>
                </div>
                <div class="time-slot-datetime">
                    <?php echo htmlspecialchars($slot['date_time'] . ', ' . $slot['time_range']); ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.badge {
    background: #4f46e5;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
    font-weight: 500;
}

.table a {
    color: #4f46e5;
    text-decoration: none;
}

.table a:hover {
    text-decoration: underline;
}
</style>

<?php include 'includes/footer.php'; ?> 