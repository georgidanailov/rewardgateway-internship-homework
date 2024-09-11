<?php

require_once '../vendor/autoload.php';
require 'AuthController.php';

$authController = new AuthController;

$authController->logout();