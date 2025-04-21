@extends('layouts.admin.master')
@section('title', 'Tạo mới danh mục sản phẩm')

@section('nav-active', 'product')
@php
    $breadCrump = [
        ['name' => 'Quản lý sản phẩm', 'href' => route('admin.product')],
        ['name' => 'Quản lý danh mục sản phẩm', 'href' => route('admin.product-category')],
        ['name' => 'Tạo mới danh mục sản phẩm', 'href' => route('admin.product-category.create')],
    ];
@endphp

@section('content')

    <div class="bg-white p-2 border border-1 rounded-md">
        <form action="{{ route('admin.product-category.store') }}" method="POST"
            class="space-y-2 bg-white p-6 rounded-xl shadow-md">
            @csrf

            {{-- Tên danh mục --}}
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700">Tên danh mục 
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full p-2 rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập tên danh mục" required maxlength="100">
            </div>

            {{-- Mô tả --}}
            <div>
                <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                <textarea name="description" id="description" rows="3"
                    class="mt-1 block p-2 w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300"
                    placeholder="Nhập mô tả danh mục"></textarea>
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
                <button type="submit" class="px-4 py-2 w-full bg-blue-600 text-white rounded-md hover:bg-blue-700">Tạo danh
                    mục</button>
            </div>
        </form>
    </div>
@endsection
{{-- Modal xác nhận --}}
<div id="confirmModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-md w-full max-w-md p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-3">Xác nhận cập nhật danh mục</h2>

        <div class="mb-4 text-gray-700 space-y-2">
            <p><strong>Tên danh mục:</strong> <span id="confirm-name" class="text-blue-600"></span></p>
            <p><strong>Mô tả:</strong> <span id="confirm-description" class="text-blue-600"></span></p>
            <p><strong>Trạng thái:</strong> <span id="confirm-status" class="text-blue-600"></span></p>
        </div>

        <p class="text-sm text-gray-500 mb-4">Bạn có chắc chắn muốn cập nhật danh mục này không?</p>

        <div class="flex justify-end gap-2">
            <button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                Hủy
            </button>
            <button type="button" onclick="submitUpdateForm()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Xác nhận cập nhật
            </button>
        </div>
    </div>
</div>
<script>
    function openConfirmModal() {
        // Lấy giá trị từ form
        const name = document.getElementById('name').value.trim();
        const description = document.getElementById('description').value.trim();
        const active = document.querySelector('input[name="active"]').checked;

        // Gán giá trị vào modal
        document.getElementById('confirm-name').textContent = name || '[Chưa nhập]';
        document.getElementById('confirm-description').textContent = description || '[Không có mô tả]';
        document.getElementById('confirm-status').textContent = active ? 'Hiển thị' : 'Ẩn';

        // Hiện modal
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function closeConfirmModal() {
        document.getElementById('confirmModal').classList.add('hidden');
    }

    function submitUpdateForm() {
        document.querySelector('form').submit();
    }
</script>

