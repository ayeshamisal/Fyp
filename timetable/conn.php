<?php
session_start();
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error);
}

// Database creation query
$databaseName = "timetable1";
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

$createTableQuery = "CREATE TABLE IF NOT EXISTS user (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    role VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
)";

$createCourseTable = "CREATE TABLE IF NOT EXISTS course (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    semester VARCHAR(255) NOT NULL,
    course_code VARCHAR(255) NOT NULL,
    course_name VARCHAR(255) NOT NULL,
    lab VARCHAR(255) NOT NULL,
    enrolled_students INT(11) DEFAULT 0,
    credit INT(11),
    status VARCHAR(255)
)";

$createRoomTable = "CREATE TABLE IF NOT EXISTS room (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_name VARCHAR(255) NOT NULL,
    lab VARCHAR(255) NOT NULL,
    capacity INT(11) DEFAULT 0,
    status VARCHAR(255)
)";
$createTeacherTable = "CREATE TABLE IF NOT EXISTS teachers (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject TEXT NOT NULL,
    availability TEXT NOT NULL,
    status VARCHAR(255)
)";

$createStudentTable = "CREATE TABLE IF NOT EXISTS students (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    s_id VARCHAR(255) NOT NULL,
    subject TEXT NOT NULL,
    status VARCHAR(255)
)";
$createTime = "CREATE TABLE IF NOT EXISTS timetable (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    timetable TEXT NOT NULL,
    status VARCHAR(255)
)";
// Create the database if it doesn't exist
if ($conn->query($createDatabaseQuery) === TRUE) {
    // echo "Database created successfully or already exists\n";

    $dbConnection = new mysqli($servername, $username, $password, $databaseName);
    if ($dbConnection->connect_error) {
        die("Connection to database failed: " . $dbConnection->connect_error);
    }
    $dbConnection->query($createCourseTable);
    $dbConnection->query($createRoomTable);
    $dbConnection->query($createTeacherTable);
    $dbConnection->query($createStudentTable);
    $dbConnection->query($createTime);
    if ($dbConnection->query($createTableQuery) === TRUE) {
        // echo "Table 'user' created successfully or already exists\n";

        // Check if any records exist in the "user" table
        $checkQuery = "SELECT COUNT(*) as count FROM user";
        $result = $dbConnection->query($checkQuery);
        $row = $result->fetch_assoc();
        $recordCount = $row['count'];

        // Insert data only if no records exist in the "user" table
        if ($recordCount == 0) {
           
            $insertQuery = "INSERT INTO user (email, password, role) VALUES
    ('admin@gmail.com', '" . password_hash('admin', PASSWORD_DEFAULT) . "', 'admin'),
    ('hod@gmail.com', '" . password_hash('admin', PASSWORD_DEFAULT) . "', 'hod')";
;
            
            
            if ($dbConnection->query($insertQuery) === TRUE) {
                // echo "Values inserted successfully\n";
            } else {
                echo "Error inserting values: " . $dbConnection->error;
            }
        } else {
            // echo "Data already exists in the 'user' table\n";
        }
    } else {
        echo "Error creating table: " . $dbConnection->error;
    }

} else {
    echo "Error creating database: " . $conn->error;
}

// Close the database connection

?>