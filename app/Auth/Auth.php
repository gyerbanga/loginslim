<?php

namespace App\Auth;

use App\Models\User;

class Auth
{

    /**
     * @return mixed
     * renvoie l'objet de l'utilisateur connecté
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
     * vérifie si quelqu'un est connecté renvoie vrai / faux
     */
    public function check()
    {
        return isset($_SESSION['user']);
    }


    /**
     * @param $email
     * @param $password
     * @return bool
     retourne vrai si l'e-mail et le mot de passe donnés sont valides ,$_SESSION['user'] = id dans la base
     */
    public function attempt($email, $password)
    {

        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        /*if (password_verify($password, $user->password))*/
        if($password == $user->password){

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