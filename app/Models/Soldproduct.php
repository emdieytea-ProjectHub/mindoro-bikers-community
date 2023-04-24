<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soldproduct extends Model
{
	use HasFactory;

	protected $fillable = [
		'seller_id',
		'buyer_id',
		'product_id',
		'contact',
		'email',
		'address'
	];

	public function seller()
	{
		return $this->belongsTo(User::class, 'seller_id');
	}

	public function buyer()
	{
		return $this->belongsTo(User::class, 'buyer_id');
	}

	public function boughtproduct()
	{
		return $this->belongsTo(Product::class, 'product_id');
	}
}
