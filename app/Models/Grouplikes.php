<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grouplikes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'like'
    ];


    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grouppost(){
        return $this->belongsTo(Grouppost::class, 'post_id');
    }

}

