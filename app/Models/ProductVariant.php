<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariant extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'color_code',
		'price',
		'size',
		'print_position',
		'image',
		'product_id',
	];

	// Mỗi variant thuộc về 1 sản phẩm
	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class);
	}

	// Một variant có nhiều chi tiết đơn hàng
	public function orderDetails(): HasMany
	{
		return $this->hasMany(OrderDetail::class);
	}
}
