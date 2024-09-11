<?php

$usersFile = 'data/users.txt';
$subjectsFile = 'data/subjects.txt';
$teachersFile = 'data/teachers.txt';
$studentsFile = 'data/students.txt';
$gradesFile = 'data/grades.txt';

$users = [
    'admin' => ['password' => 'adminpass', 'role' => 'admin'],
    'teacher1' => ['password' => 'teacherpass', 'role' => 'teacher'],
    'student1' => ['password' => 'studentpass', 'role' => 'student']
];

$subjects = [
    'Maths',
    'English',
    'Science'
];

$teachers = [
    'teacher1' => [
        'name' => 'John Doe',
        'subjects' => ['Maths', 'Science']
    ]
];

$students = [
    'student1' => [
        'name' => 'Jane Smith',
        'subjects' => ['Maths', 'English']
    ]
];

$grades = [
    'student1' => [
        'Maths' => [4, 5],
        'English' => [3, 4]
    ]
];

file_put_contents($usersFile, serialize($users));
file_put_contents($subjectsFile, serialize($subjects));
file_put_contents($teachersFile, serialize($teachers));
file_put_contents($studentsFile, serialize($students));
file_put_contents($gradesFile, serialize($grades));

echo "Setup completed successfully.";