<?php
require("../../conn.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Insert data into the course table

    $sql = "Delete from timetable WHERE id = $id";

    if ($dbConnection->query($sql) === TRUE) {
        $_SESSION['message'] = "Data update successfully";
        header("Location: ../generate.php");
        exit();
    } else {
        $_SESSION['message'] = "Error inserting data";
        header("Location: ../generate.php");
    }
} else {
    $_SESSION['message'] = "No ID specified.";
    header("Location: ../generate.php");
}
// Close the database connection
$dbConnection->close();
?>