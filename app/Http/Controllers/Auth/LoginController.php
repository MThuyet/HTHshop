<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
	public function showForm()
	{
		return view('pages.admin.LoginPage');
	}

	public function handleLogin(Request $request)
	{
		$email = $request->input('email');
		$password = $request->input('password');
		$status = Auth::attempt(['email' => $email, 'password' => $password]);
		// Thử đăng nhập
		if ($status) {
			$user = Auth::user();
			if ($user->role === 'ADMIN' || $user->role === 'STAFF') {
				return redirect()->route('admin.dashboard');
			}
		}

		// Nếu đăng nhập thất bại
		return redirect()->back()->with('toast', [
			'title' => 'Đăng nhập thất bại!',
			'text' => 'Tài khoản hoặc mật khẩu không chính xác.',
			'icon' => 'error',
		])->withInput($request->only('email'));
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login');
	}
}
