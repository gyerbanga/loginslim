<?php

/*  https://laravel.sillo.org/les-relations-avec-eloquent-12/php relations*/
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
        'pays',
        'tel1',
        'tel2',
        'mail',
        'adhesion_date',
        'status',
        'cotisation',
        'dons',
    ];

    /**
     * relation de type 1:1
     */
     public function bureau()
    {
        return $this->hasOne('App\Models\Bureaux','membre_id');
    }

    public function setAdhesionDate(){

        $this->update([
            'adhesion_date' => date('Y-m-d H:i:s')
        ]);
    }
}