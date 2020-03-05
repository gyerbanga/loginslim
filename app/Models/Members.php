<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


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
        'tel1',
        'tel2',
        'mail',
        'adhesion_date',
    ];


    public function setAdhesionDate($date){
        $day=date('Y-m-d H:i:s');
        $this->update([
            'adhesion_date' => $day
        ]);
    }
}