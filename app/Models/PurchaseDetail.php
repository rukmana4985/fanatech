<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = ['purchase_id','inventory_id', 'qty', 'price'];

    public function purchase()
    {
        return $this->belongsTo('App\Models\Purchase');
    }

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory');
    }
}
