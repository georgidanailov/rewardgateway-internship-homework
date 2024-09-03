L6 Web School Management System

Overview

The L6 Web School Management System is a web-based application designed to manage various aspects of school
administration. This system includes functionalities for managing students, teachers, subjects, and more.

Project Structure
src/: Contains the main application source code.
tests/: Contains PHPUnit test files.
vendor/: Contains third-party dependencies managed by Composer.
composer.json: Composer configuration file for managing dependencies and autoloading.
phpunit.xml: PHPUnit configuration file.
Installation
Clone the repository:

cd L6WebSchoolManagementSystem
Install dependencies:

composer install
Configuration
Composer Autoloading
The project uses PSR-4 autoloading for the GeorgiSimeonov\L6WebSchoolManagementSystem namespace. Ensure your classes are
placed in the src/ directory.

PHPUnit
The project uses PHPUnit for testing. Ensure tests are placed in the tests/ directory. Update the paths in your test
files if necessary.

Running Tests
To run tests using PHPUnit, execute:

vendor/bin/phpunit

Common Issues
File Not Found Errors: Ensure all required files exist in the correct directories and that include paths in test files
are accurate.
Autoloading Issues: Regenerate Composer autoload files using composer dump-autoload.