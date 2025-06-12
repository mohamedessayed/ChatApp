<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    //

    protected $fillable = [
        'message',
        'user_id'
    ];

    /**
     * 
     * Model ORM
     */
    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
