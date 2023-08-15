<?php
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "timetable1";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert data into the course table
$courseName = $_POST['courseName'];
$semester = $_POST['semester'];
$courseCode = $_POST['courseCode'];
$enrolledStudents = $_POST['enrolledStudent'];
$lab = $_POST['lab'];
$credit = $_POST['creditHours'];
$status = "available";

$insertQuery = "INSERT INTO course (semester,course_code,course_name, enrolled_students,lab, credit, status)
               VALUES ('$semester','$courseCode','$courseName', $enrolledStudents,'$lab', $credit, '$status')";

if ($conn->query($insertQuery) === TRUE) {
    $_SESSION['message'] = "Data inserted successfully";
    header("Location: ../course_details.php");
    exit();
} else {
    $_SESSION['message'] = "Error inserting data";
    header("Location: ../course_details.php");
}

// Close the database connection
$conn->close();
?>