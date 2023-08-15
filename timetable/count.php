<?php
$array = [
    'Monday' => ['Mathematics', 'English', 'Computer Science', 'Urdu', 'Physics'],
    'Tuesday' => ['Mathematics', 'English', 'Computer Science', 'Urdu', 'Physics'],
    'Wednesday' => ['Mathematics', 'English', 'Computer Science', 'Urdu', 'Physics'],
    'Thursday' => ['Mathematics', 'English', 'Computer Science', 'Urdu', 'Physics'],
    'Friday' => ['Mathematics', 'English', 'Computer Science', 'Urdu', 'Physics'],
];
$count = 0;
foreach ($array as $day => $subjects) {
    echo "Day: $day" . PHP_EOL;
    echo "Subjects: ";

    foreach ($subjects as $subject) {
        if ($subject == "Physics") {
            $count++;
        }
        echo "$subject, ";
    }
    echo $count;
    echo PHP_EOL . PHP_EOL;
}


?>