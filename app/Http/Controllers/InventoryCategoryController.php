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

    public function updateArticle(ArticleOfInventory $article, Request $request)
    {
        $article->update([
            'article_name' => $request->article_name,
            'edit' => 1,
            'type' => $request->type
        ]);
        return response()->json($article);
    }

    public function updateEdit(ArticleOfInventory $article)
    {
        $article->update([ 'edit' => 1 ]);
    }

    public function deleteArticle(ArticleOfInventory $article)
    {
        $inventory = $article->inventory_category_id;
        $article->delete();
        $articles = ArticleOfInventory::whereInventoryCategoryId($inventory)->get();
        return response()->json($articles);
    }

    public function updateInventory(InventoryCategory $inventory, Request $request)
    {
        $inventory->update([
            'name' => $request->name
        ]);

        return response()->json('done');
    }
}
