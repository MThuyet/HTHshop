<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
	use HasFactory, SoftDeletes;

	protected $fillable = [
		'order_id',
		'product_variant_id',
		'quantity',
		'price',
		'color',
		'size',
		'print_position',
		'custom_image'
	];

	// Một order detail thuộc về 1 đơn hàng
	public function order(): BelongsTo
	{
		return $this->belongsTo(Order::class);
	}

	// Một order detail thuộc về 1 sản phẩm
	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class);
	}
}
