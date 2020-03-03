<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    /**
     * @return mixed
     * zwraca obiekt zalogowanego urzytkownika
     */
    public function user()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
        return false;
    }


    /**
     * @return bool
     * sprawdza czy jest ktoś zalogowany zwraca true/false
     */
    public function check()
    {
        return isset($_SESSION['user']);
    }


    /**
     * @param $email
     * @param $password
     * @return bool
     * zwraca true jeśli  podany email i hasło jest prawdziwe, ustwaia zmienną $_SESSION['user'] = id w bazie
     */
    public function attempt($email, $password)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}