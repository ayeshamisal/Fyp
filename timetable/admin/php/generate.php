<?php
require('../../conn.php');
  
$getrooms = [];
$getcourses = [];
$getteachers = [];

$selectQueryRoom = "SELECT * FROM room ORDER BY id DESC";
$resultRoom = $dbConnection->query($selectQueryRoom);
if ($resultRoom->num_rows > 0) {
    while ($rowRoom = mysqli_fetch_assoc($resultRoom)) {
        $getrooms[] = $rowRoom;
    }
}

$query = "SELECT * FROM course ORDER BY id DESC";
$result = mysqli_query($dbConnection, $query);
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $getcourses[] = $row;
    }
    mysqli_free_result($result);
}
// echo "<pre>";
// print_r($getcourses);
// echo "</pre>";
$modifiedArrayCourse = array();

foreach ($getcourses as $array) {
    $key = $array["course_name"];
    $modifiedArrayCourse[$key] = $array;
}



$selectQueryteachers = "SELECT * FROM teachers ORDER BY id DESC";
$resultteachers = $dbConnection->query($selectQueryteachers);
if ($resultteachers->num_rows > 0) {
    while ($rowteachers = mysqli_fetch_assoc($resultteachers)) {
        $getteachers[] = $rowteachers;
    }
}
$modifiedArrayTeacher = array();
foreach ($getteachers as $array) {
    $array["subject"] = json_decode($array["subject"], true);
    $array["availability"] = json_decode($array["availability"], true);
    $modifiedArrayTeacher[] = $array;
}



$selectQueryStudent = "SELECT * FROM students ORDER BY id DESC";
$resultStudent = $dbConnection->query($selectQueryStudent);
if ($resultStudent->num_rows > 0) {
    while ($rowStudent = mysqli_fetch_assoc($resultStudent)) {
        $getStudent[] = $rowStudent;
    }
}

$modifiedArrayStudent = array();
foreach ($getStudent as $array) {
    $array["subject"] = json_decode($array["subject"], true);
    $modifiedArrayStudent[] = $array;
}



                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
                        $timeSlots = [
                            '9:00 AM - 10:30 AM',
                            '11:00 AM - 12:30 PM',
                            '12:35 AM - 2:05 PM',
                            '2:10 PM - 3:40 PM',
                            '4:00 PM - 5:30 PM'
                        ];
function generateTimetable($days, $timeSlots, $rooms, $courses, $teachers, $students)
{
    $tableArray = array();
    $creditHours = array();
    foreach ($days as $day) {
        $htmlTable = ' <tr><td>Day here</td>';
        $tableArray[$day] = array();
        $subjectAdded = array();
        foreach ($timeSlots as $timeSlot) {
            $studentClash = array();
            $teacherAdded = array();
            $roomAdded = array();
            $htmlTable .= ' <td>Time here</td>';
            $assignmentFound = false; // Flag to track if a suitable assignment was found
            foreach ($teachers as $teacher) {
              
                if (isset($teacher['availability'][$day]) && in_array($timeSlot, $teacher['availability'][$day])) {
                    foreach ($teacher['subject'] as $subject) {
                        foreach($rooms as $room){
                            if(isset($courses[$subject])){
                            $courseCredit = $courses[$subject]['credit'];
                            $cLab = $courses[$subject]['lab'];
                            $capcity = $courses[$subject]['enrolled_students'];
                            $courseName = $courses[$subject]['course_code'];
                            $count =  array_count_values($creditHours);
                            $total = 0;
                            if (isset($count[$courseName])) {
                                $total = $count[$courseName];
                            }
                            // echo $total;
                            // echo $courseCredit;
                            if (!in_array($subject, $subjectAdded) && !in_array($teacher['name'], $teacherAdded) && ($total <= $courseCredit) && ($room["capacity"] >= $capcity) && ($room["lab"] == $cLab) && !in_array($room["room_name"], $roomAdded)) {
                                // Additional constraint check
                                // Add your constraint conditions here before inserting into $tableArray
                                
                                $totalstudentClash = 0;
                                foreach($students as $student){
                                    foreach($student["subject"] as $sub){
                                        $studentClashCount =  array_count_values($studentClash);
                                        //    $totalstudentClash = $studentClashCount[$sub];
                                        if (isset($studentClashCount[$sub])) {
                                            $totalstudentClash = $studentClashCount[$sub];
                                        }
                                    }
                                }
                                $teacherDetails = [
                                    'teacher' => $teacher['name'],
                                    'semester' => $courses[$subject]['semester'],
                                    'course_code' => $courses[$subject]['course_code'],
                                    'room' => $room["room_name"],
                                    'clash' => $totalstudentClash,
                                ];
                                // Add the course to $tableArray for the current day and time slot
                                $tableArray[$day][$timeSlot][] = $teacherDetails;
                                $teacherAdded[] = $teacher['name'];
                                $subjectAdded[] = $subject;
                                $creditHours[] = $courseName;
                                $roomAdded[] = $room["room_name"];
                                $studentClash[] = $subject;
                                $assignmentFound = true; // Mark assignment as found
                            }
                        }
                            }

                    }
                }
            }

            // If no suitable assignment is found for the current time slot, add a "not found" message
            if (!$assignmentFound) {
                $tableArray[$day][$timeSlot][] = array('teacher' => 'Not found', 'room' => 'Not found', 'clash' => 0);
            }
        }
    }

    return $tableArray;
}




$generatedTimetable = generateTimetable($days, $timeSlots, $getrooms, $modifiedArrayCourse, $modifiedArrayTeacher, $modifiedArrayStudent);

$tableserialize = serialize($generatedTimetable);

$table = $dbConnection->real_escape_string($table);
$insertQuery = "INSERT INTO timetable (timetable, status) VALUES ('$tableserialize', 'available')";
if ($dbConnection->query($insertQuery) === TRUE) {
    $_SESSION['message'] = "Data inserted successfully";
    header("Location: ../generate.php");
    exit();
} else {
    $_SESSION['message'] = "Error inserting values";
    header("Location: ../generate.php");
}
