<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $fillable = ['role_id','menu_id'];

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function menu()
    {
        return $this->belongsTo('App\Models\Menu');
    }
}
