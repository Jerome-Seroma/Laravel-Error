<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    //Add this array
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'image',
    ];
    public function category(): BelongsTo
    {
        //A Product BELONGS TO one Category
        return $this->belongsTo(Category::class);
    }
}
