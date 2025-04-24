@extends('layouts.admin.master')

@section('title', 'Chi tiết sản phẩm')

@section('nav-active', 'product')

@php
    $breadCrump = [
        ['name' => 'Quản lý sản phẩm', 'href' => route('admin.products')],
        ['name' => $product->name, 'href' => Request::url()],
    ];
@endphp

@section('content')
    <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ route('admin.products') }}"
            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
            <span class="material-symbols-rounded mr-2">arrow_back</span>
            Quay lại danh sách
        </a>
        <a href="{{ route('admin.products.edit', $product->id) }}"
            class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
            <span class="material-symbols-rounded mr-2">edit_square</span>
            Chỉnh sửa
        </a>
        <button class="inline-flex items-center px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600"
            onclick="confirmDelete({{ $product->id }})">
            <span class="material-symbols-rounded mr-2">delete</span>
            Xóa
        </button>
    </div>

    <div class="bg-white p-4 border border-1 rounded-md">
        {{-- Thông tin cơ bản --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Thông tin cơ bản</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Tên sản phẩm:</p>
                    <p class="font-medium">{{ $product->name }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Danh mục:</p>
                    <p class="font-medium">{{ $product->category->name }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Loại:</p>
                    <p class="font-medium">{{ $product->type == 'ROUND_NECK' ? 'Cổ tròn' : 'Cổ bẻ' }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Giảm giá:</p>
                    <p class="font-medium">{{ $product->discount }}%</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Tùy chỉnh:</p>
                    <p class="font-medium">
                        <span
                            class="px-2 py-1 rounded-full text-sm {{ $product->has_customization ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->has_customization ? 'Có thể tùy chỉnh' : 'Không thể tùy chỉnh' }}
                        </span>
                    </p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Lượt xem:</p>
                    <p class="font-medium">{{ $product->view }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Trạng thái:</p>
                    <p class="font-medium">
                        <span
                            class="px-2 py-1 rounded-full text-sm {{ $product->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $product->active ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Lượt yêu thích:</p>
                    <p class="font-medium">{{ $product->favorite }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold text-nowrap">Mô tả:</p>
                    <p class="font-medium">{{ $product->description }}</p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Lượt mua:</p>
                    <p class="font-medium">{{ $product->bought }}</p>
                </div>
            </div>
        </div>

        {{-- Hình ảnh sản phẩm --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Hình ảnh sản phẩm</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($product->product_images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="Product image"
                            class="w-full object-cover rounded-lg">
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Các biến thể --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold mb-4">Các biến thể</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-500">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                        <tr>
                            <th class="px-6 py-3">Vị trí in</th>
                            <th class="px-6 py-3">Giá</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($product->product_variants as $variant)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    @switch($variant->print_position)
                                        @case('LEFT_CHEST')
                                            Ngực trái
                                        @break

                                        @case('RIGHT_CHEST')
                                            Ngực phải
                                        @break

                                        @case('CENTER_CHEST')
                                            Giữa ngực
                                        @break

                                        @case('CENTER_CHEST_A4')
                                            Giữa ngực A4
                                        @break

                                        @case('CENTER_CHEST_A3')
                                            Giữa ngực A3
                                        @break

                                        @case('FRONT_RIGHT')
                                            Trước phải
                                        @break

                                        @case('FRONT_LEFT')
                                            Trước trái
                                        @break

                                        @case('LOWER_FRONT_RIGHT')
                                            Trước dưới phải
                                        @break

                                        @case('LOWER_FRONT_LEFT')
                                            Trước dưới trái
                                        @break

                                        @case('BACK_NECK_CENTER')
                                            Sau giữa cổ
                                        @break

                                        @case('CENTER_BACK_A4')
                                            Giữa lưng A4
                                        @break

                                        @case('CENTER_BACK_A3')
                                            Giữa lưng A3
                                        @break

                                        @case('BOTH_SIDES')
                                            Cả 2 mặt trước sau
                                        @break
                                    @endswitch
                                </td>
                                <td class="px-6 py-4">{{ number_format($variant->price) }}đ</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Đánh giá --}}
        <div>
            <h2 class="text-xl font-semibold mb-4">Đánh giá</h2>
            <div class="space-y-4">
                @foreach ($product->reviews as $review)
                    <div class="border rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold">{{ $review->fullname }}</p>
                                <p class="text-sm text-gray-500">{{ $review->phone }}</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="flex items-center">
                                    @for ($i = 1; $i <= $review->rated; $i++)
                                        ⭐
                                    @endfor
                                </div>
                                <span style="font-size: 32px;"
                                    class="material-symbols-rounded {{ $review->active ? 'text-green-600' : 'text-gray-600' }}">
                                    {{ $review->active ? 'toggle_on' : 'toggle_off' }}
                                </span>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-2">{{ $review->content }}</p>
                        @if ($review->image)
                            <img src="{{ asset('storage/' . $review->image) }}" alt="Review image"
                                class="w-32 h-32 object-cover rounded-lg">
                        @endif
                        <div class="mt-2">
                            <span class="text-sm text-gray-500">{{ $review->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(productId) {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: "Bạn có chắc chắn muốn xóa sản phẩm này? Hành động này không thể hoàn tác.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/admin/products/${productId}`;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endpush
