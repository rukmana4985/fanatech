<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations;

class Sales extends Model
{
    protected $table = 'sales';
    protected $fillable = ['number','date', 'user_id'];


    public function user()
    {
        return $this->belongsTo('App\Models\UserAll', 'user_id');
        
    }
    public function sales_details()
    {
        return $this->hasMany('App\Models\SalesDetail' , 'sales_id');
    }
}
