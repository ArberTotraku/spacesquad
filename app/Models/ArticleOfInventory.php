<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
// use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

class ArticleOfInventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_name',
        'inventory_category_id',
        'type',
        'edit',
    ];

    protected $casts = [ 'edit' => 'boolean' ];

    public function rating() : BelongsTo
    {
        return $this->belongsTo(RatingForArticle::class);
    }
}
