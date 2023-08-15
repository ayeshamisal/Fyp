<?php
require('../../conn.php');
$id = $_POST['id'];
$name = $_POST['name'];
$Subjects = $_POST['Subjects'];

$Subject_endcode = json_encode($Subjects);
$insertQuery = "INSERT INTO students (s_id,name, subject, status) VALUES ('$id','$name', '$Subject_endcode', 'available')";
if ($dbConnection->query($insertQuery) === TRUE) {
    $_SESSION['message'] = "Data inserted successfully";
    header("Location: ../student_details.php");
    exit();
} else {
    $_SESSION['message'] = "Error inserting values";
    header("Location: ../student_details.php");
}

// Close the database connection
$conn->close();
?>