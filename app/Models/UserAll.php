<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class UserAll extends Model
{
    protected $table = 'users';
    protected $fillable = ['username','role_id', 'password'];



    public function sales(){
        return $this->hasMany('App\Models\Sales', 'id');
    }
}   
