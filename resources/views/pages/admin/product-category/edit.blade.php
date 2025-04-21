@extends('layouts.admin.master')
@section('title', 'Cập nhật danh mục sản phẩm')

@section('nav-active', 'product')
@php
$breadCrump = [
    ['name' => 'Quản lý sản phẩm', 'href' => route('admin.product')],
    ['name' => 'Quản lý danh mục sản phẩm', 'href' => route('admin.product-category')],
    ['name' => 'Cập nhật danh mục sản phẩm', 'href' => route('admin.product-category.create')],
];
@endphp

@section('content')

    <div class="bg-white p-2 border border-1 rounded-md">
        <form action="{{ route('admin.product-category.update', $category->id) }}" method="POST"
            class="space-y-2 bg-white p-6 rounded-xl shadow-md">
            @csrf
            @method('PUT') 

            {{-- Tên danh mục --}}
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700">Tên danh mục <span
                        class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{old('name',$category->name)}}"
                    class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập tên danh mục" required maxlength="100">
            </div>

            {{-- Mô tả --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập mô tả danh mục">{{old('description',$category->description)}}</textarea>
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
            {{-- <div>
                <button type="submit" class="px-4 py-2 w-full bg-blue-600 text-white rounded-md hover:bg-blue-700">Cập nhật</button>
            </div> --}}
                {{-- Nút Cập nhật không gửi form ngay, mà mở modal --}}
            <div>
                <button
                    type="button"
                    onclick="openConfirmModal()"
                    class="px-4 py-2 w-full bg-blue-600 text-white rounded-md hover:bg-blue-700"
                >
                    Cập nhật
                </button>
            </div>

        </form>
    </div>
@endsection
{{-- Modal xác nhận --}}
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">Xác nhận cập nhật</h2>
        <p class="text-gray-700 mb-4">Bạn có chắc chắn muốn cập nhật danh mục này?</p>
        <div class="flex justify-end gap-2">
            <button
                type="button"
                onclick="closeConfirmModal()"
                class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
            >
                Hủy
            </button>
            <button
                type="button"
                onclick="submitUpdateForm()"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
            >
                Cập nhật
            </button>
        </div>
    </div>
</div>

<script>
    function openConfirmModal() {
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function submitUpdateForm() {
        // Tìm form và submit
        document.querySelector('form').submit();
    }
</script>
