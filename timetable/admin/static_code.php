<?php
include "Header.php"
    ?>

<!-- Page (2 columns) -->
<div id="page" class="box">
    <div id="page-in" class="box">

        <!-- Content -->
        <div id="content">
            <!-- Article -->
            <div class="article">
                <h2><span>Generated timetable</span></h2>

                <table width="100%" border="1" cellpadding="1" cellspacing="2" bordercolor="#006699">
                    <thead>
                        <tr>
                            <th height="32" bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>Day</strong></div>
                            </th>
                            <th bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>8:00 AM - 9:30 AM</strong></div>
                            </th>
                            <th bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>9:45 AM - 11:15 AM</strong></div>
                            </th>
                            <th bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>11:30 AM - 1:00 PM</strong></div>
                            </th>
                            <th bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>2:00 PM - 3:30 PM</strong></div>
                            </th>
                            <th bgcolor="#006699" class="style3">
                                <div align="left" class="style9 style5 style2"><strong>3:45 PM - 5:15 PM</strong></div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
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
                                'capacity' => 1000,
                                'status' => 'available'
                            ],
                        ];
                        $courses = [
                            'Mathematics' => [
                                'enrolled_students' => 50,
                                'credits' => 1,
                                'status' => false
                            ],
                            'English' => [
                                'enrolled_students' => 45,
                                'credits' => 2,
                                'status' => false
                            ],
                            'Computer Science' => [
                                'enrolled_students' => 1000,
                                'credits' => 2,
                                'status' => false
                            ],
                            'Physics' => [
                                'enrolled_students' => 60,
                                'credits' => 1,
                                'status' => false
                            ],
                            'Urdu' => [
                                'enrolled_students' => 60,
                                'credits' => 1,
                                'status' => false
                            ]
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
                                echo '<tr>';
                                echo '<td>' . $day . '</td>';
                                foreach ($timeSlots as $timeSlot) {
                                    echo '<td>';
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

                                                    if ($room['status'] == 'available' && $room['capacity'] >= $courses[$assignedSubject]['enrolled_students']) {

                                                        $count = 1;
                                                        foreach ($assignedSubjects as $dayss => $singleSubjects) {
                                                            $count += count(array_filter($singleSubjects, function ($subj) use ($assignedSubject) {
                                                                return $subj === $assignedSubject;
                                                            }));
                                                        }
                                                        $subjectCount[$assignedSubject] = $count;
                                                        $assignedSubjects[$day][] = $assignedSubject;


                                                        if ($subjectCount[$assignedSubject] <= $courses[$assignedSubject]['credits']) {
                                                            $assignedRooms[$day][] = $room['name'];
                                                            echo $teacher['name'] . "<br>";
                                                            echo $assignedSubject . "<br>";
                                                            echo $room['name'] . "<br><br>";

                                                            $teacher['status'] = true;
                                                            $availableRooms[$key]['status'] = 'taken';
                                                            break;
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    echo '</td>';

                                }
                                echo '</tr>';
                            }
                        }

                        generateTimetable($days, $timeSlots, $rooms, $courses, $teachers);
                        ?>
                    </tbody>
                </table>


            </div> <!-- /article -->
            <hr class="noscreen" />

        </div> <!-- /content -->

        <?php
        include "right.php"
            ?>
    </div> <!-- /page-in -->
</div> <!-- /page -->

<?php
include "footer.php"
    ?>

</div> <!-- /main -->

</body>

</html>