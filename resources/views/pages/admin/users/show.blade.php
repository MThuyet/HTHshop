@extends('layouts.admin.master')
@section('title', 'Thông tin người dùng')
@section('nav-active', 'user')

@php 
    $breadCrump = [
        ['name' => 'Quản lý người dùng', 'href' => route('admin.user')],
        ['name' => 'Thông tin chi tiết người dùng '. $user->fullname, 'href' => Request::url()]
    ]; 
@endphp

@section('content')
<div class="bg-white p-4 border border-1 rounded-md">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Thông tin chi tiết người dùng</h2>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.user.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                <span class="material-symbols-rounded mr-2">edit_square</span>
                Chỉnh sửa
            </a>
            <button class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 btn-open-modal-confirm-delete" data-id="{{ $user->id }}">
                <span class="material-symbols-rounded mr-2">delete</span>
                Xóa
            </button>
        </div>
    </div>
    
    <!-- Thông tin người dùng -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Thông tin cơ bản -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-700">Thông tin cơ bản</h3>
            
            <div class="space-y-4">
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Ảnh đại diện:</span>
                    <img src="{{ $user->avatar
                    ? asset('storage/' . $user->avatar) 
                    : asset('images/avatar-temp.webp') }}"
                    alt="{{ $user->fullname }}" width="40" height="40" class="rounded-full cursor-pointer" />
                </div>

                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Họ tên:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->fullname }}</span>
                </div>
                
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Email:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->email }}</span>
                </div>
                
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Số điện thoại:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->phone }}</span>
                </div>
                
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Vai trò:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->role }}</span>
                </div>
                
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Trạng thái:</span>
                    <span class="w-full md:w-2/3">
                        <form action="{{ route('admin.user.toggle', $user->id) }}" method="POST" class="mb-0">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="flex items-center">
                                <span style="font-size: 32px;" class="material-symbols-rounded {{ $user->active ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $user->active ? 'toggle_on' : 'toggle_off' }}
                                </span>
                                <span class="ml-2 text-sm text-gray-700">{{ $user->active ? 'Đang hoạt động' : 'Đã vô hiệu hóa' }}</span>
                            </button>
                        </form>
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Thông tin thêm -->
        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
            <h3 class="text-lg font-semibold border-b pb-2 mb-4 text-gray-700">Thông tin thêm</h3>
            
            <div class="space-y-4">
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Ngày tạo:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->created_at->format('d/m/Y H:i:s') }}</span>
                </div>
                
                <div class="flex flex-col md:flex-row">
                    <span class="w-full md:w-1/3 font-medium text-gray-600">Cập nhật lần cuối:</span>
                    <span class="w-full md:w-2/3 text-gray-900">{{ $user->updated_at->format('d/m/Y H:i:s') }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quay lại -->
    <div class="mt-6">
        <a href="{{ route('admin.user') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
            <span class="material-symbols-rounded mr-2">arrow_back</span>
            Quay lại danh sách
        </a>
    </div>
</div>
@endsection