<?php

class AuthController
{
    public function login($username, $password)
    {
        if ($username === 'admin' && $password === 'password123') {
            session_start();
            $_SESSION['loggedin'] = true;
            header('Location: /src/dashboard.php');
        } else {
            echo "Invalid credentials";
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: login.php');
    }
}

