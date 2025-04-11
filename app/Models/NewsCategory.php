<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsCategory extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'name',
		'slug',
		'active',
		'description',
	];

	// Mỗi category có thể có nhiều bài viết (news)
	public function news(): HasMany
	{
		return $this->hasMany(News::class);
	}
}
