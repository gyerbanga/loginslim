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

//déconnexion
    public function logout()
    {
        unset($_SESSION['user']);
    }

     //on recherche le modèle dans la BDD avant de le supprimer
    public function delete(int $id)
    {
        $user = User::find($id);
        return $user->delete();
    }

//on connâit déjà les modèles qu'on voudrait supprimer
    public function destroy()
    {
        $user = User::destroy(1);
        $user = User::destroy(1,2,3);
        $user = User::destroy([1,2,3]);
        $user = User::destroy(collect([1, 2, 3]));
    }

    public function delte2()
    {
        //si on veut supprimer l'utilisateur dont user_id=1
        $deletedRows = User::where('user_id', 5)->delete();
        var_dump($deletedRows);
        exit;
        return $deletedRows;
    }

    public function getAll()
    {
         $allResults = User::all(); //return all of the results in the model's table
         return $allResults;
    }


//selections avec contraintes
    public function selections(int $id)
    {
        $certains = User::where('membre_id', $id)
                   ->orderBy('name', 'desc')
                   ->take(10)  //limité à 10 max
                   ->get();
        return $certains;
    }

    public function particuliere()
    {
        $certains->refresh(); //re-hydrate the existing model using fresh data from the database

        $premier = App\User::where('membre_id', '>',1)->first(); //retourne le premier sur la liste
        $premierbis = App\User::firstWhere('membre_id', '1');
        $premierExcept = App\User::where('membre_id', '1')->firstOrFail();//if no result is found, a Illuminate\Database\Eloquent\ModelNotFoundException will be thrown
    }


//les métodes d'agrégats sont : count , max , min , avg et sum
    public function agregats()
    {
        $users = User::table('users')->count();

        $price = User::table('orders')->max('price');
    }
//clause de sélection
    public function selection()
    {
        $users = User::table('users')->select('name', 'email as user_email')->get();
        $users = User::table('users')->distinct()->get();
    }
}