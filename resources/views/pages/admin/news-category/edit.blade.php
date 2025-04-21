@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa thông tin danh mục tin tức')
@section('nav-active', 'news')

@php 
    $breadCrump = [
        ['name' => 'Quản lý tin tức', 'href' => route('dashboard.news')],
        ['name' => 'Quản lý danh mục tin tức', 'href' => route('dashboard.news-category')],
        ['name' => 'Chỉnh sửa danh mục tin tức', 'href' => Request::url()]
    ]; 
@endphp

@section('content')
<div class="bg-white p-2 border border-1 rounded-md">
    <form action="{{ route('dashboard.news-category.update', $newsCategory->id) }}" method="POST" class="m-2 px-4 py-2 border border-gray-200 bg-white rounded-lg shadow-md space-y-6">
        @csrf
        @method('PUT')
    
        {{-- Tên danh mục --}}
        <div>
            <label class="block font-bold">Tên danh mục
                <span class="text-red-500">*</span>
            </label>
            <input type="text" name="name" value="{{ old('name', $newsCategory->name) }}" class="w-full border rounded px-3 py-2">
        </div>
    
        {{-- Mô tả --}}
        <div>
            <label class="block font-bold">Mô tả</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $newsCategory->description) }}</textarea>
        </div>
    
        {{-- Trạng thái hoạt động --}}
        <div class="flex items-center gap-2">
            <input type="checkbox" name="active" value="1" {{ old('active', $newsCategory->active) ? 'checked' : '' }} class="w-4 h-4">
            <label>Hoạt động</label>
        </div>
    
        {{-- Submit --}}
        <div>
            <button type="submit" class="w-full py-2 px-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md shadow-sm">
                Cập nhật danh mục
            </button>
        </div>
    </form>
</div>
@endsection