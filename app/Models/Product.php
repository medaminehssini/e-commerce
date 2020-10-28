<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'title',
        'price',
        'code',
        'description',
        'images',
    ];
    public function categorie()
    {
        return $this->belongsTo('App\Models\Categorie','categorie' );
    }
}
