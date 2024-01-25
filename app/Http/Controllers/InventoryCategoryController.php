<?php

namespace App\Http\Controllers;

use App\Models\ArticleOfInventory;
use App\Models\InventoryCategory;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        return inertia('Inventory/InventoryIndex', [
            'inventories' => InventoryCategory::with('articles')->get()
        ]);
    }

    public function store()
    {
        $inventory = InventoryCategory::create([
            'name' => 'a cat'
        ]);

        return response()->json($inventory);
    }

    public function storeArticle(InventoryCategory $inventory)
    {
        ArticleOfInventory::create([
            'article_name' => 'article',
            'inventory_category_id' => $inventory->id,
            'type' => 'all',
        ]);

        $articles = ArticleOfInventory::whereInventoryCategoryId($inventory->id)->get();

        return response()->json($articles);
    }

    public function destroy(InventoryCategory $inventory)
    {
        $inventory->delete();
    }
}
