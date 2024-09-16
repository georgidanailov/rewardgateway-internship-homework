<?php

class Singleton
{
    private static $instance = null;

    private function __construct()
    {
        echo "Singleton instance created.\n";
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function sayHello()
    {
        echo "Hello from Singleton!\n";
    }
}
