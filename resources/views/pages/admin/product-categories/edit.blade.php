@extends('layouts.admin.master')
@section('title', 'Cập nhật danh mục sản phẩm')

@section('nav-active', 'product')
@php
$breadCrump = [
    ['name' => 'Quản lý sản phẩm', 'href' => route('admin.products')],
    ['name' => 'Quản lý danh mục sản phẩm', 'href' => route('admin.product-categories')],
    ['name' => 'Cập nhật danh mục sản phẩm', 'href' => Request::url()],
];
@endphp

@section('content')

    <div class="bg-white p-2 border border-1 rounded-md">
        <form action="{{ route('admin.product-categories.update', $productCategory->id) }}" method="POST"
            class="space-y-2 bg-white p-6 rounded-xl shadow-md">
            @csrf
            @method('PUT') 

            {{-- Tên danh mục --}}
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700">Tên danh mục <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name', $productCategory->name) }}"
                    class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập tên danh mục" required maxlength="100">
            </div>

            {{-- Mô tả --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập mô tả danh mục">{{ old('description', $productCategory->description) }}</textarea>
            </div>

            {{-- Trạng thái --}}
            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="active" value="1" checked
                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-300">
                    <span class="ml-2 text-sm text-gray-700">Hiển thị danh mục</span>
                </label>
            </div>

            {{-- Nút submit --}}
            <div>
                <button type="submit" class="px-4 py-2 w-full bg-blue-600 text-white rounded-md hover:bg-blue-700">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection