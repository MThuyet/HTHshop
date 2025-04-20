<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('pages.admin.profile');
    }

    public function update(Request $request)
    {
        try {
            $currentUser = Auth::user();

            $validated = $request->validate([
                'fullname' => 'required|max:50',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($request->hasFile('avatar')) {
                try {
                    if ($currentUser->avatar && Storage::disk('public')->exists($currentUser->avatar)) {
                        Storage::disk('public')->delete($currentUser->avatar);
                    }
            
                    $avatarName = time() . '_' . $currentUser->id . '.' . $request->avatar->extension();
            
                    $destinationPath = storage_path('app/public/images/avatar');
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0755, true);
                    }
            
                    $request->file('avatar')->move($destinationPath, $avatarName);
            
                    $validated['avatar'] = 'images/avatar/' . $avatarName;
            
                    Log::info('Ảnh đã lưu bằng move(): ' . $validated['avatar']);
            
                } catch (\Exception $e) {
                    Log::error('Avatar upload error', ['error' => $e->getMessage()]);
                }
            }

            if ($request->filled('oldPassword') && $request->filled('newPassword')) {
                if (!$this->checkOldPassword($currentUser, $request->oldPassword)) {
                    return redirect()->back()->with('toast', [
                        'title' => 'Thất bại',
                        'text' => 'Mật khẩu cũ không đúng.',
                        'icon' => 'error'
                    ]);
                }

                $request->validate([
                    'newPassword' => 'required|min:5|max:255',
                ]);

                $validated['password'] = Hash::make($request->newPassword);
            }

            $currentUser->fill($validated)->save();

            return redirect()->back()->with('toast', [
                'title' => 'Thành công',
                'text' => 'Thông tin cá nhân đã được cập nhật.',
                'icon' => 'success'
            ]);

        } catch (ValidationException $e) {
            $firstField = array_key_first($e->errors());
            $firstError = $e->errors()[$firstField][0];

            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật thông tin cá nhân',
                'text' => $firstError,
                'icon' => 'error'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('toast', [
                'title' => 'Lỗi cập nhật thông tin cá nhân',
                'text' => $e->getMessage(),
                'icon' => 'error'
            ]);
        }
    }

    private function checkOldPassword($user, $oldPassword)
    {
        return Hash::check($oldPassword, $user->password);
    }
}
