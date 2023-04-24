<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable =[
        'admin_id',
        'groupName',
        'groupType'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function usergroup(){
        return $this->hasMany(Usergroup::class);
    }

    public function grouppost(){
        return $this->hasMany(Grouppost::class, 'group_id');
    }
    
}

