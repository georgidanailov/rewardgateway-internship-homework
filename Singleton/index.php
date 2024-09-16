<?php

require_once 'Singleton.php';

$singleton1 = Singleton::getInstance();
$singleton1->sayHello();

$singleton2 = Singleton::getInstance();
$singleton2->sayHello();

var_dump($singleton1 === $singleton2);
