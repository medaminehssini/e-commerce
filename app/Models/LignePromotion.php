<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LignePromotion extends Model
{
    use HasFactory;
    protected $table = "ligne_promotion";
    public $timestamps = false;
}
