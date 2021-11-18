<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scoreboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'tournament_id','plate','team','time','time_interval','actual_time','rank','score'
    ];

    public function tournament(){
        return $this->belongsTo(Tournament::class);
    }
}
