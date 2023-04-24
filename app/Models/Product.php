<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use HasFactory;

	protected $fillable = [
		'user_id',
		'category_id',
		'productImage',
		'description',
		'product',
		'price',
		'status',
		'verified'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function soldproducts()
	{
		return $this->hasMany(Soldproduct::class, 'product_id');
	}

	public function rating()
	{
		return $this->hasMany(Rate::class, 'product_id');
	}
}
