<?php

namespace Core;

use Commands\CreateSubjectCommand;

class Admin extends User
{
    public function getMenu()
    {
        echo "1. Create a subject\n";
        echo "2. Create a teacher\n";
        echo "3. Create a student\n";
        echo "4. Remove a subject\n";
        echo "5. Remove a teacher\n";
        echo "6. Remove a student\n";
        echo "7. Log out\n";
    }

    public function handleMenuOption($option)
    {
        switch ($option) {
            case 1:
                echo "Enter subject name: ";
                $subjectName = trim(fgets(STDIN));
                $command = new CreateSubjectCommand($subjectName);
                $command->execute();
                break;

            case 7:
                echo "Logging out...\n";
                break;
            default:
                echo "Invalid option.\n";
                break;
        }
    }
}
