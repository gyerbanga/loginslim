<?php

/* https://code.tutsplus.com/tutorials/using-illuminate-database-with-eloquent-in-your-php-app-without-laravel--cms-27247 */

namespace App\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Bureaux;

class Bureau
{

//obtenir la liste des membres
    public function getAllMembers()
    {
    	//$this->adhesion_date= $this->adhesion_date=='' ? $day : $this->adhesion_date;
        $membres = Bureaux::all();
        return $membres;
    }


    //les statistiques sur les membres
    public function getStat(){

    	// de ceux qui ont cotisé
    	$count=Bureaux::where('id_bureau','>',0)->count();
    	$maxCot=Bureaux::where('id_bureau','>',0)->max('cotisation');
    	$minCot=Bureaux::where('id_bureau','>',0)->min('cotisation');
    	$total=Bureaux::where('id_bureau','>',0)->sum('cotisation');
        $moyenne=Bureaux::where('id_bureau','>',0)->avg('cotisation');

    	return array(
    		'effectif'=>$count,
    		'cot_max'=>$maxCot,
    		'total'=>$total,
            'moyenne'=>$moyenne,
    		'cota_min'=>$minCot
    	);
    }
}