<?php
// Database connection
$servername = "sql305.infinityfree.com";
$username = "if0_39084164"; // Change this to your database username
$password = "kevinmetal411"; // Change this to your database password
$dbname = "if0_39084164_exam"; 
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch sports data
$sql = "SELECT * FROM sports";
$result = $conn->query($sql);
// Initialize variables for computation
$totalDuration = 0;
$count = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sports Information</title>
</head>
<body>
    <h1>Sports Information</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Type</th>
            <th>Players</th>
            <th>Duration (min)</th>
            <th>Popularity</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["type"] . "</td>";
                echo "<td>" . $row["players"] . "</td>";
                echo "<td>" . $row["duration"] . "</td>";
                echo "<td>" . $row["popularity"] . "</td>";
                echo "</tr>";
                // Compute total duration and count
                $totalDuration += $row["duration"];
                $count++;
            }
        } else {
            echo "<tr><td colspan='6'>No records found</td></tr>";
        }
        ?>
    </table>
    <?php
    // Compute average duration
    $averageDuration = $count > 0 ? $totalDuration / $count : 0;
    ?>
    <h2>Average Duration of Sports Events: <?php echo number_format($averageDuration, 2); ?> minutes</h2>
    <?php
    $conn->close();
    ?>
</body>
</html>
