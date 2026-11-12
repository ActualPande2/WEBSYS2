<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameReview extends Model
{
    // model YO
    protected $fillable = [
        "game_title","review","rating"
    ];
}
