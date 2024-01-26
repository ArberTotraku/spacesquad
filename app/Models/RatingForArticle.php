<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RatingForArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'stars',
        'comment',
    ];

    public function articles() : HasOne
    {
        return $this->hasOne(ArticleOfInventory::class);
    }

}
