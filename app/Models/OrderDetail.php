<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'order_id',
		'product_variant_id',
		'quantity',
		'custom_image',
	];

	// Một order detail thuộc về 1 đơn hàng
	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}

	// Một order detail thuộc về 1 variant sản phẩm
	public function productVariant(): BelongsTo
	{
		return $this->belongsTo(ProductVariant::class);
	}
}
