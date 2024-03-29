<?php

use App\Models\InventoryCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_of_inventories', function (Blueprint $table) {
            $table->id();
            $table->string('article_name');
            $table->foreignIdFor(InventoryCategory::class)->constrained()->onDelete('cascade');
            $table->enum('type', [
                'all',
                'Drinks',
                'Snacks',
                'Take-Away',
                'Board-Game'
            ]);
            $table->tinyInteger('edit')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_of_inventories');
    }
};
