<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['parent_id','name','url','icon'];

    public function parent()
    {
        return $this->belongsTo('App\Models\Menu','parent_id');
    }
}
