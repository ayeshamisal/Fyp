<?php

$room = array(
    array(
        'id' => 18,
        'room_name' => 'c',
        'lab' => 'no',
        'capacity' => 30,
        'status' => 'available'
    ),
    array(
        'id' => 17,
        'room_name' => 'B',
        'lab' => 'yes',
        'capacity' => 40,
        'status' => 'available'
    ),
    array(
        'id' => 16,
        'room_name' => 'A',
        'lab' => 'no',
        'capacity' => 40,
        'status' => 'available'
    )
);

$course = array(
    'Object-Oriented Programming' => array(
        'id' => 228,
        'semester' => 1,
        'course_code' => 'IT202',
        'course_name' => 'Object-Oriented Programming',
        'lab' => 'yes',
        'enrolled_students' => 29,
        'credit' => 3,
        'status' => 'available'
    ),
    'Database Management Systems' => array(
        'id' => 229,
        'semester' => 2,
        'course_code' => 'IT203',
        'course_name' => 'Database Management Systems',
        'lab' => 'no',
        'enrolled_students' => 40,
        'credit' => 3,
        'status' => 'available'
    ),
    'Computer Networks' => array(
        'id' => 230,
        'semester' => 3,
        'course_code' => 'IT204',
        'course_name' => 'Computer Networks',
        'lab' => 'yes',
        'enrolled_students' => 40,
        'credit' => 3,
        'status' => 'available'
    ),
    'Assebly' => array(
        'id' => 231,
        'semester' => 2,
        'course_code' => 'IT401',
        'course_name' => 'Assebly',
        'lab' => 'no',
        'enrolled_students' => 30,
        'credit' => 3,
        'status' => 'available'
    )
);
$teacher = array(
    array(
        'id' => 64,
        'name' => 'Mudassar Manzoor',
        'email' => 'ali@gmail.com',
        'subject' => array(
            'Assebly'
        ),
        'availability' => array(
            'Monday' => array(
                '8:00 AM - 9:30 AM'
            ),
            'Tuesday' => array(
                '8:00 AM - 9:30 AM'
            ),
            'Wednesday' => array(
                '8:00 AM - 9:30 AM'
            ),
            'Thursday' => array(
                '8:00 AM - 9:30 AM'
            ),
            'Friday' => array(
                '8:00 AM - 9:30 AM'
            )
        ),
        'status' => 'available'
    ),
    array(
        'id' => 63,
        'name' => 'Mudassar',
        'email' => 'ali@gmail.com',
        'subject' => array(
            'Computer Networks',
            'Database Management Systems',
            'Object-Oriented Programming'
        ),
        'availability' => array(
            'Monday' => array(
                '8:00 AM - 9:30 AM',
                '9:45 AM - 11:15 AM',
                '11:30 AM - 1:00 PM',
                '2:00 PM - 3:30 PM',
                '3:45 PM - 5:15 PM'
            ),
            'Tuesday' => array(
                '8:00 AM - 9:30 AM',
                '9:45 AM - 11:15 AM',
                '11:30 AM - 1:00 PM',
                '2:00 PM - 3:30 PM',
                '3:45 PM - 5:15 PM'
            ),
            'Wednesday' => array(
                '8:00 AM - 9:30 AM',
                '9:45 AM - 11:15 AM',
                '11:30 AM - 1:00 PM',
                '2:00 PM - 3:30 PM',
                '3:45 PM - 5:15 PM'
            ),
            'Thursday' => array(
                '8:00 AM - 9:30 AM',
                '9:45 AM - 11:15 AM',
                '11:30 AM - 1:00 PM',
                '2:00 PM - 3:30 PM',
                '3:45 PM - 5:15 PM'
            ),
            'Friday' => array(
                '8:00 AM - 9:30 AM',
                '9:45 AM - 11:15 AM',
                '11:30 AM - 1:00 PM',
                '2:00 PM - 3:30 PM',
                '3:45 PM - 5:15 PM'
            )
        ),
        'status' => 'available'
    )
);
$students = array(
    array(
        'id' => 38,
        'name' => 'ali',
        's_id' => 1,
        'subject' => array(
            'Assebly',
            'Computer Networks',
            'Database Management Systems',
            'Object-Oriented Programming'
        ),
        'status' => 'available'
    )
);
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

$timeSlots = [
    '8:00 AM - 9:30 AM',
    '9:45 AM - 11:15 AM',
    '11:30 AM - 1:00 PM',
    '2:00 PM - 3:30 PM',
    '3:45 PM - 5:15 PM'
];
function generateTimetable($days, $timeSlots, $teacher, $course, $room)
{
    $timetable = array();

    foreach ($days as $day) {
        foreach ($timeSlots as $timeSlot) {
            $availableTeachers = array();

            // Check teacher availability
            foreach ($teacher as $t) {
                if (in_array($day, array_keys($t['availability'])) && in_array($timeSlot, $t['availability'][$day])) {
                    $availableTeachers[] = $t;
                }
            }

            // Assign course to available teacher and check constraints
            foreach ($course as $c) {
                $credit = $c['credit'];

                // Check if the course can be assigned for the given credit
                $assignmentsLeft = $credit;
                while ($assignmentsLeft > 0) {
                    $assigned = false;

                    // Check if the course is already assigned in the same time slot
                    if (!isset($timetable[$day][$timeSlot])) {
                        foreach ($availableTeachers as $t) {
                            // Check if the course is assigned only once a day
                            if ( !in_array($c['course_name'], $t['subject'])) {
                                foreach ($room as $r) {
                                    // Check if the room lab matches the course lab
                                    if ($r['lab'] === $c['lab'] && $c['enrolled_students'] >= $r['capacity']) {
                                        $timetable[$day][$timeSlot] = array(
                                            'course_name' => $c['course_name'],
                                            'teacher' => $t['name'],
                                            'room' => $r['room_name']
                                        );
                                        $assignmentsLeft--;
                                        $assigned = true;
                                    }
                                }
                            }
                        }
                    }

                    // If the course couldn't be assigned in the current time slot, break the loop
                    if (!$assigned) {
                        break;
                    }
                }
            }
        }
    }

    return $timetable;
}
$timetable = generateTimetable($days, $timeSlots, $teacher, $course, $room);
echo '<table>';
echo '<thead>';
echo '<tr>';
echo '<th>Time Slot</th>';
foreach ($days as $day) {
    echo '<th>' . $day . '</th>';
}
echo '</tr>';
echo '</thead>';

echo '<tbody>';
foreach ($timeSlots as $timeSlot) {
    echo '<tr>';
    echo '<td>' . $timeSlot . '</td>';

    foreach ($days as $day) {
        echo '<td>';

        if (isset($timetable[$day][$timeSlot])) {
            $entry = $timetable[$day][$timeSlot];
            echo 'Course: ' . $entry['course_name'] . '<br>';
            echo 'Teacher: ' . $entry['teacher'] . '<br>';
            echo 'Room: ' . $entry['room'] . '<br>';
        } else {
            echo '---';
        }

        echo '</td>';
    }

    echo '</tr>';
}
echo '</tbody>';

echo '</table>';



?>