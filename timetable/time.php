<?php
$days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
$timeSlots = [
    '8:00 AM - 9:30 AM',
    '9:45 AM - 11:15 AM',
    '11:30 AM - 1:00 PM',
    '2:00 PM - 3:30 PM',
    '3:45 PM - 5:15 PM'
];
$rooms = [
    [
        'name' => 'Room A',
        'capacity' => 112,
        'status' => 'available'
    ],
    [
        'name' => 'Room B',
        'capacity' => 400,
        'status' => 'available'
    ],
    [
        'name' => 'Room C',
        'capacity' => 500,
        'status' => 'available'
    ],
    [
        'name' => 'Room D',
        'capacity' => 500,
        'status' => 'available'
    ],
];
$courses = [
    [
        'name' => 'Mathematics',
        'enrolled_students' => 50,
        'credits' => 3,
        'status' => false
    ],
    [
        'name' => 'English',
        'enrolled_students' => 45,
        'credits' => 3,
        'status' => false
    ],
    [
        'name' => 'Computer Science',
        'enrolled_students' => 60,
        'credits' => 3,
        'status' => false
    ],
    [
        'name' => 'Physics',
        'enrolled_students' => 60,
        'credits' => 3,
        'status' => false
    ],
    [
        'name' => 'Urdu',
        'enrolled_students' => 60,
        'credits' => 3,
        'status' => false
    ],
];
$teachers = [
    [
        'name' => 'Umair',
        'subjects' => ['Mathematics', 'Computer Science', 'Physics'],
        'availability' => [
            'Monday' => $timeSlots,
            'Tuesday' => $timeSlots,
            'Wednesday' => $timeSlots,
            'Thursday' => $timeSlots,
            'Friday' => $timeSlots,
        ],
        'status' => false
    ],
    [
        'name' => 'Fahad',
        'subjects' => ['English', 'Urdu'],
        'availability' => [
            'Monday' => $timeSlots,
            'Tuesday' => $timeSlots,
            'Wednesday' => $timeSlots,
            'Thursday' => $timeSlots,
            'Friday' => $timeSlots,
        ],
        'status' => false
    ],
];

function generateTimetable($days, $timeSlots, $rooms, $courses, $teachers)
{
    $assignedSubjects = array_fill_keys($days, []);
    $assignedRooms = array_fill_keys($days, []);

    foreach ($days as $day) {
        echo 'Day: ' . $day . "<br><br>";
        foreach ($timeSlots as $timeSlot) {
            $availableRooms = $rooms;

            foreach ($teachers as $teacher) {
                if (isset($teacher['availability'][$day]) && in_array($timeSlot, $teacher['availability'][$day]) && !$teacher['status']) {
                    $assignedSubject = null;

                    foreach ($teacher['subjects'] as $subject) {
                        if (!in_array($subject, $assignedSubjects[$day])) {
                            $assignedSubject = $subject;

                            break;
                        }
                    }

                    if ($assignedSubject !== null) {
                        foreach ($availableRooms as $key => $room) {
                            foreach ($courses as $course) {

                                if ($room['status'] == 'available' && $room['capacity'] >= $course['enrolled_students']) {

                                    $count = 1;
                                    foreach ($assignedSubjects as $dayss => $singleSubjects) {
                                        $count += count(array_filter($singleSubjects, function ($subj) use ($assignedSubject) {
                                            return $subj === $assignedSubject;
                                        }));
                                    }
                                    $subjectCount[$assignedSubject] = $count;



                                    if ($subjectCount[$assignedSubject] <= 4) {
                                        $assignedSubjects[$day][] = $assignedSubject;
                                        $assignedRooms[$day][] = $room['name'];

                                        echo $teacher['name'] . "<br>";
                                        echo $assignedSubject . "<br>";
                                        echo $room['name'] . "<br>";
                                        // echo $assignedSubject . " appears " . $subjectCount[$assignedSubject] . " time(s) in the array.";
                                        echo 'Time Slot: ' . $timeSlot . "<br><br>";
                                        $teacher['status'] = true;
                                        $availableRooms[$key]['status'] = 'taken';
                                        break; // Break out of the available rooms loop
                                    }
                                }


                            }
                        }
                    }
                }
            }
        }

        echo "---------------------------<br><br><br>";
    }

    echo '---------------------------' . "<br><br>";
}

generateTimetable($days, $timeSlots, $rooms, $courses, $teachers);




?>