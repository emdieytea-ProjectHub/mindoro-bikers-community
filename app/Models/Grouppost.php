<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grouppost extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'group_id',
        'post',
        'file',

    ];

    public function group(){
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function groupcomment(){
        return $this->hasMany(Groupcomments::class, 'post_id')->latest();
    }



}
