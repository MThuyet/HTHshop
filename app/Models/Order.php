<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'order_code',
		'email',
		'fullname',
		'location',
		'phone',
		'note',
		'status',
		'cancel_reason',
		'total_price',
	];

	// Một order có nhiều chi tiết đơn hàng
	public function details(): HasMany
	{
		return $this->hasMany(OrderDetail::class);
	}
}
