<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    protected $fillable = ['sales_id','inventory_id', 'price', 'qty'];

    public function inventory()
    {
        return $this->belongsTo('App\Models\Inventory');
    }

    public function sales()
    {
        return $this->belongsTo('App\Models\Sales');
    }

}
