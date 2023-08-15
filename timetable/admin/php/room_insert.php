<?php
require("../../conn.php");

// Insert data into the course table
$room_name = $_POST['room_name'];
$capacity = $_POST['capacity'];
$lab = $_POST['lab'];
$status = "available";

$insertQuery = "INSERT INTO room (room_name, capacity,lab, status)
               VALUES ('$room_name', $capacity,'$lab', '$status')";

if ($dbConnection->query($insertQuery) === TRUE) {
    $_SESSION['message'] = "Data inserted successfully";
    header("Location: ../room_detail.php");
    exit();
} else {
    $_SESSION['message'] = "Error inserting data";
    header("Location: ../room_detail.php");
}

// Close the database connection
$dbConnection->close();
?>