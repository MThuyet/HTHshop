@extends('layouts.admin.master')
@section('title', 'Tạo người dùng mới')
@section('nav-active', 'user')

@php 
    $breadCrump = [
        ['name' => 'Quản lý người dùng', 'href' => route('admin.user')],
        ['name' => 'Tạo người dùng mới', 'href' => route('admin.user.create')]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        <div class="grid md:grid-cols-5 gap-5">
            <div class="md:col-span-4 space-y-6">
                {{-- Fullname + Username --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="fullname" class="block text-sm font-bold text-gray-700">Họ tên
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="fullname" id="fullname" maxlength="20"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nhập họ và tên" required>
                    </div>
        
                    <div>
                        <label for="username" class="block text-sm font-bold text-gray-700">Tên tài khoản
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="username" id="username" minlength="5" maxlength="50" placeholder="Nhập tên tài khoản"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            
                {{-- Role --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="role" class="block text-sm font-bold text-gray-700">Vai trò
                            <span class="text-red-500">*</span>
                        </label>
                        <select name="role" id="role"
                                class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="ADMIN">ADMIN</option>
                            <option value="STAFF">STAFF</option>
                        </select>
                    </div>
        
                    <div>
                        <label for="password" class="block text-sm font-bold text-gray-700">Mật khẩu
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="password" id="password" minlength="5" maxlength="60" placeholder="Nhập mật khẩu"
                            class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>      
                </div>
            
                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" rows="3" placeholder="Nhập mô tả"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>
            </div>
            <div class="flex flex-col items-center">
                {{-- Avatar --}}
                <label class="block text-sm font-bold text-gray-700">Ảnh đại diện</label>
                <img id="avatar-image" src="" class="w-[150px] h-[150px] mb-5 rounded-full" />
                <label class="cursor-pointer text-nowrap rounded-md bg-white px-2.5 py-1.5 text-sm font-medium text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50">
                    Tải ảnh lên
                    <input type="file" class="hidden" name="avatar" accept="image/*">
                </label>
            </div>
        </div>
    
        {{-- Submit --}}
        <div>
            <button type="submit"
                    class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                Tạo người dùng
            </button>
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