<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use Notifiable, SoftDeletes;

	protected $fillable = [
		'fullname',
		'username',
		'email',
		'phone',
		'password',
		'description',
		'active',
		'role',
	];

	protected $hidden = [
		'password',
	];
}
