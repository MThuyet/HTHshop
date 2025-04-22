@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa sản phẩm')
@section('nav-active', 'product')

@php $breadCrump = [['name' => 'Quản lý sản phẩm', 'href' => route('admin.product')], ['name' => 'Chỉnh sửa sản phẩm', 'href' => '#']]; @endphp

@section('content')
    <div class="bg-white p-4 border border-1 rounded-md">
        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Tên sản phẩm -->
                <div class="col-span-2">
                    <label for="name" class="block text-sm font-bold text-gray-700">Tên sản phẩm <span
                            class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập tên sản phẩm" required maxlength="100">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Danh mục -->
                <div>
                    <label for="product_category_id" class="block text-sm font-bold text-gray-700">Danh mục <span
                            class="text-red-500">*</span></label>
                    <select name="product_category_id" id="product_category_id"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Loại áo -->
                <div>
                    <label for="type" class="block text-sm font-bold text-gray-700">Loại áo <span
                            class="text-red-500">*</span></label>
                    <select name="type" id="type"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="ROUND_NECK" {{ old('type', $product->type) == 'ROUND_NECK' ? 'selected' : '' }}>Cổ
                            tròn</option>
                        <option value="COLLAR_NECK" {{ old('type', $product->type) == 'COLLAR_NECK' ? 'selected' : '' }}>Cổ
                            trụ</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Giảm giá -->
                <div>
                    <label for="discount" class="block text-sm font-bold text-gray-700">Giảm giá (%) <span
                            class="text-red-500">*</span></label>
                    <input type="number" name="discount" id="discount" min="0" max="100"
                        value="{{ old('discount', $product->discount) }}"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập phần trăm giảm giá" required>
                    @error('discount')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tùy chỉnh -->
                <div>
                    <label for="has_customization" class="block text-sm font-bold text-gray-700">Cho phép tùy chỉnh</label>
                    <div class="mt-1">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="has_customization" id="has_customization" value="1"
                                {{ old('has_customization', $product->has_customization) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Cho phép khách hàng tải ảnh lên</span>
                        </label>
                    </div>
                    @error('has_customization')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Trạng thái -->
                <div>
                    <label for="active" class="block text-sm font-bold text-gray-700">Trạng thái</label>
                    <div class="mt-1">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="active" id="active" value="1"
                                {{ old('active', $product->active) ? 'checked' : '' }}
                                class="w-5 h-5 rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Hiển thị sản phẩm</span>
                        </label>
                    </div>
                    @error('active')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Mô tả -->
                <div class="col-span-2">
                    <label for="description" class="block text-sm font-bold text-gray-700">Mô tả</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Nhập mô tả sản phẩm">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ảnh sản phẩm -->
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700">Ảnh sản phẩm</label>
                    <div class="mt-1 grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($product->images as $image)
                            <div class="relative">
                                <img src="{{ asset('storage/' . $image->image) }}" alt="Product image"
                                    class="w-full object-cover rounded-md" data-image-id="{{ $image->id }}">
                                <button type="button" onclick="deleteImage({{ $image->id }})"
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded-full p-1 hover:bg-red-600">
                                    <span class="material-symbols-rounded text-sm">delete</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        <input type="file" name="images[]" id="images" multiple accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    @error('images')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Biến thể -->
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-gray-700">Biến thể</label>
                    <div id="variants-container" class="mt-4 space-y-4">
                        @foreach ($product->variants as $variant)
                            <div class="flex gap-4 items-end">
                                <div class="flex-1">
                                    <label class="block text-sm font-bold text-gray-700">Vị trí in</label>
                                    <input type="text"
                                        value="{{ $variant->print_position == 'CENTER_CHEST_A4' ? 'Mặt trước' : ($variant->print_position == 'CENTER_BACK_A4' ? 'Mặt sau' : 'Cả hai mặt') }}"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm bg-gray-50"
                                        readonly>
                                    <input type="hidden" name="variants[{{ $variant->id }}][print_position]"
                                        value="{{ $variant->print_position }}">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-sm font-bold text-gray-700">Giá</label>
                                    <input type="number" name="variants[{{ $variant->id }}][price]"
                                        value="{{ $variant->price }}" min="0"
                                        class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                                        placeholder="Nhập giá">
                                </div>
                                <button type="button" onclick="removeVariant(this)"
                                    class="mb-1 text-red-600 hover:text-red-900">
                                    <span class="material-symbols-rounded">delete</span>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <a href="{{ route('admin.product') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Hủy
                </a>
                <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    <span class="material-symbols-rounded mr-2">save</span>
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            function deleteImage(imageId) {
                // Kiểm tra số lượng ảnh hiện tại
                const currentImages = document.querySelectorAll('.grid.grid-cols-2.md\\:grid-cols-4.gap-4 .relative').length;
                if (currentImages <= 1) {
                    Swal.fire({
                        title: 'Lỗi',
                        text: 'Sản phẩm phải có ít nhất 1 ảnh',
                        icon: 'error',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    return;
                }

                Swal.fire({
                    title: 'Xác nhận xóa',
                    text: "Hành động này không thể hoàn tác, bạn có chắc chắn muốn xóa ảnh này khỏi sản phẩm?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Xóa ảnh khỏi DOM trước
                        const imageElement = document.querySelector(`img[data-image-id="${imageId}"]`);
                        if (imageElement) {
                            imageElement.closest('.relative').remove();
                        }

                        // Gửi request xóa ảnh
                        fetch(`{{ route('admin.product.image.delete', '') }}/${imageId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(response => {
                            if (response.ok) {
                                Swal.fire({
                                    title: 'Thành công',
                                    text: 'Xóa ảnh thành công',
                                    icon: 'success',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                });
                            } else {
                                // Nếu xóa thất bại, reload lại trang để khôi phục ảnh
                                location.reload();
                                response.json().then(data => {
                                    Swal.fire('Lỗi', data.message || 'Không thể xóa ảnh', 'error', {
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                    });
                                });
                            }
                        }).catch(error => {
                            // Nếu có lỗi, reload lại trang để khôi phục ảnh
                            location.reload();
                            Swal.fire('Lỗi', 'Có lỗi xảy ra khi xóa ảnh', 'error', {
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        });
                    }
                });
            }

            function removeVariant(button) {
                button.closest('.flex').remove();
            }
        </script>
    @endpush
@endsection
