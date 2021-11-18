<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_id',
        'user_id',
        'message'
    ];

    public function chat(){
        return $this->belongsTo(Message::class, 'chat_id');
    }
}
