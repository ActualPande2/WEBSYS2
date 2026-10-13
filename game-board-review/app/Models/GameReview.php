<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameReview extends Model
{
    protected $fillable = [
        'author',
        'game_title',
        'review',
        'rating',
    ];
}
