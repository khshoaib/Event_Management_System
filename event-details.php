<?php
session_start();

$con = mysqli_connect("localhost", "root", "", "events");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['download_csv'])) {
    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin') {
        $event_id = intval($_POST['event_id']);

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=attendees_list_event_' . $event_id . '.csv');

        $output = fopen('php://output', 'w');
        fputcsv($output, array('Attendee ID', 'User ID', 'User Name'));

        $query = "SELECT a.attendee_id, u.user_id, u.user_name FROM attendees a JOIN user u ON a.user_id = u.user_id WHERE a.event_id = $event_id";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, $row);
        }

        fclose($output);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            padding: 5px 10px;
            color: #fff;
            background-color: #007bff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>All Events</h1>
        <?php
        $events_query = "SELECT * FROM event";
        $events_result = mysqli_query($con, $events_query);

        if (mysqli_num_rows($events_result) > 0) {
            echo "<table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Venue</th>
                            <th>Max Capacity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>";
            while ($event = mysqli_fetch_assoc($events_result)) {
                echo "<tr>
                        <td>{$event['event_id']}</td>
                        <td>{$event['event_name']}</td>
                        <td>{$event['event_desc']}</td>
                        <td>{$event['event_date']}</td>
                        <td>{$event['event_time']}</td>
                        <td>{$event['event_venue']}</td>
                        <td>{$event['max_capacity']}</td>
                        <td>";

                if (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'Admin') {
                    echo "<form method='POST' action=''>
                            <input type='hidden' name='event_id' value='{$event['event_id']}'>
                            <button type='submit' name='download_csv' class='btn'>Download CSV</button>
                          </form>";
                } else {
                    echo "<span style='color: gray;'>No Access</span>";
                }

                echo "</td></tr>";
            }
            echo "</tbody>
                </table>";
        } else {
            echo "<p>No events found.</p>";
        }
        ?>
    </div>
</body>
</html>