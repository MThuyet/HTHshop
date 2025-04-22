<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'product_category_id',
		'type',
		'name',
		'slug',
		'description',
		'active',
		'discount',
		'has_customization',
		'view',
		'favorite',
		'bought',
	];

	// Quan hệ: Một product thuộc về một category
	public function category()
	{
		return $this->belongsTo(ProductCategory::class, 'product_category_id');
	}

	// Một product có nhiều hình ảnh
	public function images(): HasMany
	{
		return $this->hasMany(ProductImage::class);
	}

	// Một product có nhiều variant
	public function variants()
	{
		return $this->hasMany(ProductVariant::class);
	}

	// Một product có nhiều review
	public function reviews(): HasMany
	{
		return $this->hasMany(Review::class);
	}
}
