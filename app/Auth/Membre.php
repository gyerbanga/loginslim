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
}