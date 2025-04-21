@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa thông tin người dùng')
@section('nav-active', 'user')

@php 
    $breadCrump = [
        ['name' => 'Quản lý người dùng', 'href' => route('admin.user')],
        ['name' => 'Chỉnh sửa thông tin người dùng', 'href' => Request::url()]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        @method('PUT')

        <div class="grid md:grid-cols-5 gap-5">
            <div class="md:col-span-4 space-y-6">
                {{-- Fullname + Username --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullname" class="block text-sm font-bold text-gray-700">Họ tên</label>
                        <input type="text" name="fullname" value="{{ old('fullname', $user->fullname) }}" class="w-full border rounded px-3 py-2">
                    </div>
    
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700">Tên tài khoản</label>
                        <input type="text" name="username" value="{{ old('username', $user->username) }}" class="w-full border rounded px-3 py-2">
                    </div>
                </div>
    
                {{-- Description --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700">Mô tả</label>
                    <textarea name="description" rows="3" class="w-full border rounded px-3 py-2">{{ old('description', $user->description) }}</textarea>
                </div>
            </div>

            <div class="flex flex-col items-center">
                {{-- Avatar --}}
                <label class="block text-sm font-bold text-gray-700">Ảnh đại diện</label>
                <img id="avatar-image" src="{{ $user->avatar
                ? asset('storage/' . $user->avatar) 
                : asset('images/avatar-temp.webp') }}"
                alt="{{ $user->fullname }}" class="w-[150px] h-[150px] mb-5 rounded-full" />
                <label class="cursor-pointer text-nowrap rounded-md bg-white px-2.5 py-1.5 text-sm font-medium text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    Thay đổi ảnh đại diện
                    <input type="file" class="hidden" name="avatar" accept="image/*">
                </label>
            </div>
        </div>

        {{-- Active --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="active" {{ $user->active ? 'checked' : '' }} class="w-4 h-4">
            <label>Hoạt động</label>
        </div>

        {{-- Submit --}}
        <div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">Cập nhật</button>
        </div>
    </form>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const avatarInput = document.querySelector('input[name="avatar"]')
        const avatarImage = document.getElementById('avatar-image');

        avatarInput.addEventListener('change', () => {
            const file = avatarInput.files[0];
            if (file) {
                const fileName = file.name;
                const fileExtension = fileName.slice(((fileName.lastIndexOf(".") - 1) >>> 0) + 2);

                if (fileExtension === 'jpg' || fileExtension === 'jpeg' || fileExtension === 'png' || fileExtension === 'webp') {
                    const url = window.URL.createObjectURL(file);
                    avatarImage.src = url;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: `Có lỗi`,
                        text: `Vui lòng gửi file đúng định dạnh ảnh (jpg, jpeg, png, webp)`,
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            }
        });
      
    });
</script>