<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = ['number','date', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\UserAll', 'user_id');
        
    }
    
    public function purchase_details()
    {
        return $this->hasMany('App\Models\PurchaseDetail' , 'purchase_id');
    }
}
