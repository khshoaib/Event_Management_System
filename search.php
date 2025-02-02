<?php
$con = mysqli_connect("localhost", "root", "", "events");
$query = "%" . htmlspecialchars($_GET['query']) . "%";

// Search for events
$event_stmt = $con->prepare("SELECT event_id, event_name FROM event WHERE event_name LIKE ? OR event_category LIKE ?");
$event_stmt->bind_param("ss", $query, $query);
$event_stmt->execute();
$event_results = $event_stmt->get_result();

// Search for attendees
$attendee_stmt = $con->prepare("
    SELECT u.user_name, e.event_name 
    FROM attendees a 
    JOIN user u ON a.user_id = u.user_id 
    JOIN event e ON a.event_id = e.event_id 
    WHERE u.user_name LIKE ?");
$attendee_stmt->bind_param("s", $query);
$attendee_stmt->execute();
$attendee_results = $attendee_stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2>Search Results</h2>

        <h3>Events:</h3>
        <?php if ($event_results->num_rows > 0): ?>
            <ul>
                <?php while ($event = $event_results->fetch_assoc()): ?>
                    <li><a href="event-details.php?id=<?= $event['event_id']; ?>"><?= htmlspecialchars($event['event_name']); ?></a></li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No events found.</p>
        <?php endif; ?>

      
        
    </div>
</body>
</html>
