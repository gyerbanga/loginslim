<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{

     /**
     * The table associated with the model.
     * The primary key associated with the table.
     * @var string
     * @var string
     */
    protected $table = 'users';
    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'email',
        'name',
        'password',
    ];


    public function setPassword($password){
        $this->update([
            'password' => password_hash($password,PASSWORD_DEFAULT)
        ]);
    }
}