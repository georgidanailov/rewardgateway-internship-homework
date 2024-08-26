<?php

require_once __DIR__ . '/vendor/autoload.php';

use src\commands\CreateSubjectCommand;
use src\commands\CreateStudentCommand;
use src\commands\CreateTeacherCommand;
use src\commands\GradeStudentCommand;
use src\commands\RemoveSubjectCommand;
use src\commands\RemoveStudentCommand;
use src\commands\RemoveTeacherCommand;
use src\core\Admin;
use src\core\Student;
use src\core\Subject;
use src\core\Teacher;


$subjects = [];
$users = [];


function displayAdminMenu()
{
    echo "\nAdmin Menu\n";
    echo "1. Create Subject\n";
    echo "2. Create Student\n";
    echo "3. Create Teacher\n";
    echo "4. Remove Subject\n";
    echo "5. Remove Student\n";
    echo "6. Remove Teacher\n";
    echo "7. Log out\n";
    echo "Enter your choice: ";
}

function displayTeacherMenu(Teacher $teacher)
{
    echo "\nTeacher Menu\n";
    echo "The subjects you teach are: " . implode(', ', $teacher->getSubjects()) . "\n";
    echo "1. Grade a Student\n";
    echo "2. Log out\n";
    echo "Enter your choice: ";
}

function displayStudentMenu(Student $student)
{
    echo "\nStudent Menu\n";
    echo "1. Check Grades for a Subject\n";
    echo "2. Log out\n";
    echo "Enter your choice: ";
}

function handleAdmin()
{
    global $subjects, $users;

    while (true) {
        displayAdminMenu();
        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case 1:
                echo "Enter subject name: ";
                $subjectName = trim(fgets(STDIN));
                $command = new CreateSubjectCommand($subjectName);
                $command->execute();
                $subjects = Subject::getSubjects(); // Refresh subjects list
                break;

            case 2:
                echo "Enter student username: ";
                $username = trim(fgets(STDIN));
                echo "Enter student password: ";
                $password = trim(fgets(STDIN));
                echo "Enter student name: ";
                $name = trim(fgets(STDIN));
                echo "Enter subjects (comma-separated): ";
                $subjectList = trim(fgets(STDIN));
                $command = new CreateStudentCommand($username, $password, $name, $subjectList);
                $command->execute();
                $users[$username] = new Student($username, $password, explode(',', $subjectList));
                break;

            case 3:
                echo "Enter teacher username: ";
                $username = trim(fgets(STDIN));
                echo "Enter teacher password: ";
                $password = trim(fgets(STDIN));
                echo "Enter teacher name: ";
                $name = trim(fgets(STDIN));
                echo "Enter subjects (comma-separated): ";
                $subjectList = trim(fgets(STDIN));
                $command = new CreateTeacherCommand($username, $password, $name, $subjectList);
                $command->execute();
                $users[$username] = new Teacher($username, $password, explode(',', $subjectList));
                break;

            case 4:
                echo "Enter subject name to remove: ";
                $subjectName = trim(fgets(STDIN));
                $command = new RemoveSubjectCommand($subjectName);
                $command->execute();
                $subjects = Subject::getSubjects(); // Refresh subjects list
                break;

            case 5:
                echo "Enter student username to remove: ";
                $username = trim(fgets(STDIN));
                $command = new RemoveStudentCommand($username);
                $command->execute();
                unset($users[$username]);
                break;

            case 6:
                echo "Enter teacher username to remove: ";
                $username = trim(fgets(STDIN));
                $command = new RemoveTeacherCommand($username);
                $command->execute();
                unset($users[$username]);
                break;

            case 7:
                return;


            default:
                echo "Invalid choice, please try again.\n";
                break;
        }
    }
}

function handleTeacher(Teacher $teacher)
{
    global $users;

    while (true) {
        displayTeacherMenu($teacher);
        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case 1:
                echo "Enter student username: ";
                $studentUsername = trim(fgets(STDIN));
                echo "Enter subject name: ";
                $subjectName = trim(fgets(STDIN));
                echo "Enter grade (2-6): ";
                $grade = trim(fgets(STDIN));

                if (isset($users[$studentUsername]) && $users[$studentUsername] instanceof Student) {
                    $student = $users[$studentUsername];
                    $command = new GradeStudentCommand($student, $subjectName, $grade);
                    $command->execute();
                } else {
                    echo "Student '$studentUsername' not found.\n";
                }
                break;

            case 2:
                return;


            default:
                echo "Invalid choice, please try again.\n";
                break;
        }
    }
}

function handleStudent(Student $student)
{
    while (true) {
        displayStudentMenu($student);
        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case 1: // Check Grades for a Subject
                echo "Enter subject name: ";
                $subjectName = trim(fgets(STDIN));

                if (array_key_exists($subjectName, $student->getGrades())) {
                    $grades = $student->getGrades()[$subjectName];
                    $average = array_sum($grades) / count($grades);
                    echo "Your '$subjectName' grades are: " . implode(', ', $grades) . "\n";
                    echo "Average: " . round($average, 2) . "\n";
                } else {
                    echo "No grades found for subject '$subjectName'.\n";
                }
                break;

            case 2:
                return;


            default:
                echo "Invalid choice, please try again.\n";
                break;
        }
    }
}

function main()
{
    global $users;

    while (true) {
        echo "Login\n";
        echo "1. Admin\n";
        echo "2. Teacher\n";
        echo "3. Student\n";
        echo "4. Exit\n";
        echo "Enter your choice: ";
        $choice = trim(fgets(STDIN));

        switch ($choice) {
            case 1:
                echo "Enter admin username: ";
                $username = trim(fgets(STDIN));
                echo "Enter admin password: ";
                $password = trim(fgets(STDIN));


                if ($username === 'admin' && $password === 'adminpass') {
                    $admin = new Admin($username, $password);
                    handleAdmin();
                } else {
                    echo "Invalid credentials.\n";
                }
                break;

            case 2:
                echo "Enter teacher username: ";
                $username = trim(fgets(STDIN));
                echo "Enter teacher password: ";
                $password = trim(fgets(STDIN));

                if (isset($users[$username]) && $users[$username] instanceof Teacher && $users[$username]->getPassword() === $password) {
                    $teacher = $users[$username];
                    handleTeacher($teacher);
                } else {
                    echo "Invalid credentials.\n";
                }
                break;

            case 3:
                echo "Enter student username: ";
                $username = trim(fgets(STDIN));
                echo "Enter student password: ";
                $password = trim(fgets(STDIN));

                if (isset($users[$username]) && $users[$username] instanceof Student && $users[$username]->getPassword() === $password) {
                    $student = $users[$username];
                    handleStudent($student);
                } else {
                    echo "Invalid credentials.\n";
                }
                break;

            case 4:
                exit("Goodbye!\n");

            default:
                echo "Invalid choice, please try again.\n";
                break;
        }
    }
}

main();