<?php
require('../../conn.php');
$name = $_POST['name'];
$email = $_POST['email'];
$Monday = isset($_POST['Monday']) ? $_POST['Monday'] : 0;
$Tuesday = isset($_POST['Tuesday']) ? $_POST['Tuesday'] : 0;
$Wednesday = isset($_POST['Wednesday']) ? $_POST['Wednesday'] : 0;
$Thursday = isset($_POST['Thursday']) ? $_POST['Thursday'] : 0;
$Friday = isset($_POST['Friday']) ? $_POST['Friday'] : 0;
$Subjects = $_POST['Subjects'];

// Check if days exist and add them to the $availability array
$availability = [];
if ($Monday) {
    $availability['Monday'] = $Monday;
}
if ($Tuesday) {
    $availability['Tuesday'] = $Tuesday;
}
if ($Wednesday) {
    $availability['Wednesday'] = $Wednesday;
}
if ($Thursday) {
    $availability['Thursday'] = $Thursday;
}
if ($Friday) {
    $availability['Friday'] = $Friday;
}

$data = json_encode($availability);
$Subject_encode = json_encode($Subjects);
$insertQuery = "INSERT INTO teachers (name, email, subject, availability, status) VALUES ('$name', '$email', '$Subject_encode', '$data', 'available')";

if ($dbConnection->query($insertQuery) === TRUE) {
    $_SESSION['message'] = "Data inserted successfully";
    header("Location: ../faculty_details.php");
    exit();
} else {
    $_SESSION['message'] = "Error inserting values";
    header("Location: ../faculty_details.php");
}

// Close the database connection
$conn->close();
?>
