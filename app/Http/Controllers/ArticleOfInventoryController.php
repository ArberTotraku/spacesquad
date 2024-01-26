<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InventoryCategory;

class ArticleOfInventoryController extends Controller
{
    public function index()
    {
        $inventories = InventoryCategory::with('articles')->get();

        return inertia('World/WhereIAmAndWantToBuy', [
            'inventories' => $inventories
        ]);
    }
}
