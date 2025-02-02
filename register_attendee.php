<?php
session_start();
$event_id = $_POST['event_id'];
$user_id = $_SESSION['userid'];

$con = mysqli_connect("localhost", "root", "", "events");

// Step 1: Check the max capacity for the event
$capacity_sql = "SELECT max_capacity FROM event WHERE event_id = '$event_id'";
$capacity_result = mysqli_query($con, $capacity_sql);
$capacity_data = mysqli_fetch_assoc($capacity_result);
$max_capacity = $capacity_data['max_capacity'];

// Step 2: Count current attendees
$attendee_sql = "SELECT COUNT(*) AS attendee_count FROM attendees WHERE event_id = '$event_id'";
$attendee_result = mysqli_query($con, $attendee_sql);
$attendee_data = mysqli_fetch_assoc($attendee_result);
$current_attendees = $attendee_data['attendee_count'];

// Debugging: Display the numbers
echo "Max Capacity: $max_capacity<br>";
echo "Current Attendees: $current_attendees<br>";

// Step 3: Check if event is full
if ($current_attendees >= $max_capacity) {
    echo "<script>alert('This event is full.'); window.location.href='event-details.php?id=$event_id';</script>";
    exit;
}

// Step 4: Register attendee if not full
$insert_sql = "INSERT INTO attendees (event_id, user_id) VALUES ('$event_id', '$user_id')";
if (mysqli_query($con, $insert_sql)) {
    echo "<script>alert('Registration successful!'); window.location.href='event-details.php?id=$event_id';</script>";
} else {
    echo "<script>alert('Registration failed. Please try again.'); window.location.href='event-details.php?id=$event_id';</script>";
}

mysqli_close($con);
?>
