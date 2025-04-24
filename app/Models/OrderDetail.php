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

	// Một order detail thuộc về 1 biến thể sản phẩm
	public function variant(): BelongsTo
	{
		return $this->belongsTo(ProductVariant::class, 'product_variant_id');
	}

	// Lấy thông tin sản phẩm thông qua biến thể
	public function getProductAttribute()
	{
		return $this->variant->product;
	}

	// Tính giá sau khi giảm giá
	public function getDiscountedPriceAttribute()
	{
		$originalPrice = $this->variant->price;
		$discount = $this->product->discount;
		return $originalPrice * (1 - $discount / 100);
	}

	// Lấy vị trí in bằng tiếng Việt
	public function getPrintPositionLabelAttribute()
	{
		$positions = [
			'CENTER_CHEST_A4' => 'Mặt trước',
			'CENTER_BACK_A4' => 'Mặt sau',
			'BOTH_SIDES' => 'Cả 2 mặt'
		];
		return $positions[$this->variant->print_position] ?? $this->variant->print_position;
	}

	// Lấy màu sắc bằng tiếng Việt
	public function getColorLabelAttribute()
	{
		$colors = [
			'white' => 'Trắng',
			'black' => 'Đen',
		];
		return $colors[$this->color] ?? $this->color;
	}
}
