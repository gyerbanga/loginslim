<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Members extends Model
{
     /**
     * The table associated with the model.
     * The primary key associated with the table.
     * @var string
     * @var string
     */
    protected $table = 'membres';
    protected $primaryKey = 'id_membres';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nom',
        'prenom',
        'civilite',
        'adresse',
        'cp',
        'ville',
        'tel1',
        'tel2',
        'mail',
        'adhesion_date',
        'status',
        'cotisation',
        'dons',
    ];


    public function setAdhesionDate(){

        $this->update([
            'adhesion_date' => date('Y-m-d H:i:s');
        ]);
    }
}