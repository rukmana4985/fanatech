<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Inventory;

use App\Http\Resources\Inventory as InventoryResource;

class InventoriesController extends Controller
{
    public function show ($id)
    {
        return new InventoryResource(Inventory::find($id));
    }
}
