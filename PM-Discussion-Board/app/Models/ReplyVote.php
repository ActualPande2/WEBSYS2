<?php

namespace App\Models;

use Database\Factories\ReplyVoteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['reply_id', 'vote_type'])]
class ReplyVote extends Model
{
    /** @use HasFactory<ReplyVoteFactory> */
    use HasFactory;

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reply(): BelongsTo
    {
        return $this->belongsTo(Reply::class);
    }
}
