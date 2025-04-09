<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateAdmin
{
	public function handle(Request $request, Closure $next): Response
	{
		$user = Auth::user();

		// Nếu chưa đăng nhập, redirect về trang login
		if (!$user) {
			return redirect()->route('login');
		}

		if ($user->role !== 'ADMIN') {
			abort(403, 'Bạn không có quyền truy cập trang này.');
		}

		return $next($request);
	}
}
