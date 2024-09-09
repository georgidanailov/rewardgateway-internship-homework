<?php

class AuthController
{
    public function login($username, $password)
    {
        if ($username === 'admin' && $password === 'password') {
            session_start();
            $_SESSION['loggedin'] = true;
            header('Location: /dashboard.php');
        } else {
            echo "Invalid credentials";
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: /login.php');
    }
}

