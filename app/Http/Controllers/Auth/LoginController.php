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
		$username = $request->input('username');
		$password = $request->input('password');
		$status = Auth::attempt(['username' => $username, 'password' => $password]);
		// Thử đăng nhập
		if ($status) {
			$user = Auth::user();
			if ($user->role === 'ADMIN' ) {
				return redirect()->route('admin.dashboard')->with('toast', [
					'title' => 'Đăng nhập thành công',
					'text' => 'Chào mừng bạn quay trở lại',
					'icon' => 'success'
				]);
			}else {
				return redirect()->route('dashboard.news')->with('toast', [
					'title' => 'Đăng nhập thành công',
					'text' => 'Chào mừng bạn quay trở lại',
					'icon' => 'success'
				]);
			}
		}

		// Nếu đăng nhập thất bại
		return redirect()->back()->with('toast', [
			'title' => 'Đăng nhập thất bại!',
			'text' => 'Tài khoản hoặc mật khẩu không chính xác.',
			'icon' => 'error',
		])->withInput($request->only('username'));
	}

	public function logout()
	{
		Auth::logout();
		return redirect()->route('login');
	}
}
