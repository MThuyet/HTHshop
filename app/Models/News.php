<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'title',
		'slug',
		'content',
		'thumbnail',
		'active',
		'news_category_id',
		'user_id_created',
		'user_id_updated',
	];

	// Quan hệ: Bài viết thuộc 1 danh mục
	public function category(): BelongsTo
	{
		return $this->belongsTo(NewsCategory::class, 'news_category_id');
	}

	// Quan hệ: Người tạo bài viết
	public function createdBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id_created');
	}

	// Quan hệ: Người cập nhật bài viết
	public function updatedBy(): BelongsTo
	{
		return $this->belongsTo(User::class, 'user_id_updated');
	}
}
