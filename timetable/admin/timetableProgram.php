<!DOCTYPE html>
<html>
<head>
    <title>Timetable</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        }
         .clash {
            background-color: #ffcccc; /* Add your desired background color for clashes */
        }
    </style>
</head>
<body>
    <h1>Timetable</h1>
    <table>
        <tr>
            <th>Day</th>
            <th>9:00 AM - 10:30 AM</th>
            <th>11:00 AM - 12:30 PM</th>
            <th>12:35 AM - 2:05 PM</th>
            <th>2:10 PM - 3:40 PM</th>
            <th>4:00 PM - 5:30 PM</th>
            <!-- Add more timeslots here if needed -->
        </tr>
        <?php
     
                    include "../conn.php";
                    $sql = "SELECT * FROM timetable WHERE status = 'approve'";
                    $result = $dbConnection->query($sql);
                    if ($result) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $time = $row['timetable'];
                               $table = unserialize($time);
                                foreach ($table as $day => $timeslots) {
            echo "<tr>";
            echo "<td>$day</td>";

            // Loop through each timeslot of the day
            foreach ($timeslots as $timeslot => $subjects) {
                echo "<td>";
                // Loop through each subject in the timeslot
                foreach ($subjects as $subject) {
                    $teacher = $subject['teacher'];
                    $course_code = $subject['course_code'];
                    $room = $subject['room'];
                    $clash = $subject['clash'];
                    $class = ($clash == 1) ? 'class="clash"' : '';
                    echo "<b $class >$course_code ($room)<br></b>";
                }
                echo "</td>";
            }

            // If there are fewer timeslots for a day, fill the remaining columns with empty cells
            $num_empty_cells = 5 - count($timeslots);
            for ($i = 0; $i < $num_empty_cells; $i++) {
                echo "<td></td>";
            }

            echo "</tr>";
        }
                            }
                        } else {
                            // echo "No timetable found with ID $id.";
                        }
                    } else {
                        echo 'Error: ' . $dbConnection->error;
                    }

                    // Close the database connection
                    $dbConnection->close();
                    
                    ?>
       
    </table>
</body>
</html>
