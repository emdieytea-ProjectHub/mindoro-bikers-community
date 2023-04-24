<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
	use HasFactory, Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'avatar',
		'fname',
		'lname',
		'email',
		'password',
		'phone',
		'type',
		'gender'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'last_seen' => 'datetime',
	];

	public function post()
	{
		return $this->hasMany(Post::class);
	}

	public function comment()
	{
		return $this->hasMany(Comment::class);
	}

	public function group()
	{
		return $this->hasMany(Group::class, 'admin_id');
	}

	public function grouppost()
	{
		return $this->hasMany(Grouppost::class, 'user_id');
	}

	public function productseller()
	{
		return $this->hasMany(Soldproduct::class, 'seller_id');
	}

	public function productbuyer()
	{
		return $this->hasMany(Soldproduct::class, 'buyer_id');
	}

	public function rate()
	{
		return $this->hasMany(Rate::class, 'user_id');
	}


	public function messageSender()
	{
		return $this->hasMany(Message::class, 'sender_id');
	}

	public function messageReceiver()
	{
		return $this->hasMany(Message::class, 'reciever_id');
	}

	public function tournamentMember()
	{
		return $this->hasMany(Tournament_group_join::class, 'user_id');
	}
}
