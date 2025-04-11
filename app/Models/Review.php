<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'product_id',
		'rated',
		'content',
		'image',
		'phone',
		'fullname',
		'active',
	];

	// Mỗi review thuộc về một sản phẩm
	public function product(): BelongsTo
	{
		return $this->belongsTo(Product::class);
	}
}
