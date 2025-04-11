<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'description',
		'active',
	];

	// Quan hệ: Một category có nhiều product
	public function products()
	{
		return $this->hasMany(Product::class, 'product_category_id');
	}
}
