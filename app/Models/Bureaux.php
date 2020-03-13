<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bureaux extends Model
{
     /**
     * The table associated with the model.
     * The primary key associated with the table.
     * @var string
     * @var string
     */
    protected $table = 'bureau';
    protected $primaryKey = 'id_bureau';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'membre_id',
    ];

//on enrégistre les enregistrements liés à la table des membres
    public function bureau()
    {
        return $this->belongsTo('App\Models\Membres','id_membres');
    }
}