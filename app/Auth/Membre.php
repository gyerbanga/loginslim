<?php

namespace App\Auth;

use App\Models\Members;

class Membre
{

//obtenir la liste des membres
    public function getAllMembers()
    {
    	//$this->adhesion_date= $this->adhesion_date=='' ? $day : $this->adhesion_date;
        $membres = Members::all();
        return $membres;
    }

    //obtenir les membres à jour de cotisation
    public function membresAjourCota(){

    	$cotas=Members::select('id_membres','adhesion_date','nom','prenom','cotisation','dons')
    					->where('cotisation','>',0)
    					->get();
    	//$cotas->select('nom','prenom','cotisation','dons')->get();
    	return $cotas;
    }

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