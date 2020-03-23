<?php

/* https://code.tutsplus.com/tutorials/using-illuminate-database-with-eloquent-in-your-php-app-without-laravel--cms-27247 */
/* https://laravel.com/docs/6.x/eloquent-relationships */

namespace App\Auth;

use App\Models\Members;

class Membre
{

//obtenir la liste des membres
    public function getAllMembers()
    {
    	//$this->adhesion_date= $this->adhesion_date=='' ? $day : $this->adhesion_date;
        $membres = Members::all();
        /* $livres = Members::find(3)->bureau; */

        return $membres;
    }

    //récupérer l'enregistrement qui a la clé primaire donnée en paramètre
    public function certainsElts($int)
    {
        //$int pourrait être aussi un tableau de valeur [1,5,9]
        return Members::find($int);
    }

     // obtenir les éléments de ceux qui 
    public function Choixmembres(string $genre)
    {
        $membres=Members::where('nom', 'like', '%$genre%')->get();
        return $membres;
    }

    //récupérer liste liées à un paramètre
    public function lister($nom)
    {
        return Members::lists($nom);
    }
    //obtenir les membres à jour de cotisation
    public function membresAjourCota(){

    	$cotas=Members::select('id_membres','adhesion_date','nom','prenom','cotisation','dons')
    					->where('cotisation','>',0)
                        ->distinct()
    					->get();
    	//$cotas->select('nom','prenom','cotisation','dons')->get();
    	return $cotas;
    }

    //Les jointures
   // $bureaux = Members::find(11)->bureau;
    //les statistiques sur les membres
    public function getStat(){

    	// de ceux qui ont cotisé
    	$count=Members::where('cotisation','>',0)->count();
    	$maxCot=Members::where('cotisation','>',0)->max('cotisation');
    	$minCot=Members::where('cotisation','>',0)->min('cotisation');
    	$total=Members::where('cotisation','>',0)->sum('cotisation');
        $moyenne=Members::where('cotisation','>',0)->avg('cotisation');

    	return array(
    		'effectif'=>$count,
    		'cot_max'=>$maxCot,
    		'total'=>$total,
            'moyenne'=>$moyenne,
    		'cota_min'=>$minCot
    	);
    }
}