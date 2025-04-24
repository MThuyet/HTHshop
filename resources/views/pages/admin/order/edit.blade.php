@extends('layouts.admin.master')
@section('title', 'Chỉnh sửa đơn hàng')
@section('nav-active', 'order')

@php
    $breadCrump = [
        ['name' => 'Quản lý đơn hàng', 'href' => route('admin.order')],
        ['name' => 'Chỉnh sửa đơn hàng: ' . $order->order_code, 'href' => '#'],
    ];

    $statusLabels = [
        'PENDING' => 'Chờ xác nhận',
        'CONFIRMED' => 'Đã xác nhận',
        'SHIPPING' => 'Đang giao hàng',
        'DONE' => 'Đã hoàn thành',
        'CANCELLED' => 'Đã hủy',
    ];
@endphp

@section('content')
    <div class="bg-white p-4 border border-1 rounded-md">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Chỉnh sửa đơn hàng</h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.order') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    <span class="material-symbols-rounded mr-2">arrow_back</span>
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.order.update', $order->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Thông tin đơn hàng -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Thông tin đơn hàng</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Mã đơn hàng:</p>
                        <p class="font-medium">{{ $order->order_code }}</p>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Ngày tạo:</p>
                        <p class="font-medium">
                            {{ $order->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</p>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Trạng thái:</p>
                        <select name="status" id="status"
                            class="border rounded-md px-2 py-1 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach ($statusLabels as $value => $label)
                                <option value="{{ $value }}" {{ $order->status == $value ? 'selected' : '' }}>
                                    {{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Tổng tiền:</p>
                        <p class="font-medium">{{ number_format($order->total_price) }}đ</p>
                    </div>
                </div>

                <!-- Ảnh tùy chỉnh -->
                @if ($order->details->where('custom_image')->count() > 0)
                    <div class="mt-4">
                        <h4 class="text-gray-600 font-semibold mb-2">Ảnh tùy chỉnh:</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach ($order->details as $detail)
                                @if ($detail->custom_image)
                                    <div class="flex flex-col items-center">
                                        <img src="{{ asset('storage/' . $detail->custom_image) }}" alt="Ảnh tùy chỉnh"
                                            class="w-32 h-32 object-cover rounded-md">
                                        <span class="text-sm text-gray-500 mt-1">{{ $detail->product->name }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Lý do hủy (chỉ hiển thị khi chọn trạng thái CANCELLED) -->
                <div id="cancelReasonContainer" class="mt-4 hidden">
                    <label for="cancel_reason" class="block text-gray-600 font-semibold mb-2">Lý do hủy:</label>
                    <textarea name="cancel_reason" id="cancel_reason" rows="3"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->cancel_reason }}</textarea>
                </div>
            </div>

            <!-- Thông tin khách hàng -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Thông tin khách hàng</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Họ tên:</p>
                        <p class="font-medium">{{ $order->fullname }}</p>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Số điện thoại:</p>
                        <p class="font-medium">{{ $order->phone }}</p>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Email:</p>
                        <p class="font-medium">{{ $order->email }}</p>
                    </div>
                    <div class="flex gap-2">
                        <p class="text-gray-600 font-semibold">Địa chỉ:</p>
                        <p class="font-medium">{{ $order->location }}</p>
                    </div>
                </div>
            </div>

            <!-- Chi tiết sản phẩm -->
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Chi tiết sản phẩm</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm text-left text-gray-700">
                        <thead class="text-xs uppercase bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-6 py-3">Sản phẩm</th>
                                <th class="px-6 py-3">Màu sắc</th>
                                <th class="px-6 py-3">Kích thước</th>
                                <th class="px-6 py-3">Vị trí in</th>
                                <th class="px-6 py-3">Số lượng</th>
                                <th class="px-6 py-3">Đơn giá</th>
                                <th class="px-6 py-3">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->details as $detail)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $detail->product->name }}</td>
                                    <td class="px-6 py-4">{{ $detail->color_label }}</td>
                                    <td class="px-6 py-4">{{ $detail->size }}</td>
                                    <td class="px-6 py-4">{{ $detail->print_position_label }}</td>
                                    <td class="px-6 py-4">{{ $detail->quantity }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-col">
                                            <div class="flex items-center gap-2">
                                                <span
                                                    class="text-gray-500 line-through">{{ number_format($detail->variant->price) }}đ</span>
                                                <span
                                                    class="text-red-500 text-sm">-{{ $detail->product->discount }}%</span>
                                            </div>
                                            <span>{{ number_format($detail->discounted_price) }}đ</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ number_format($detail->quantity * $detail->discounted_price) }}đ</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Ghi chú -->
            <div class="mb-6">
                <label for="note" class="block text-gray-600 font-semibold mb-2">Ghi chú:</label>
                <textarea name="note" id="note" rows="3"
                    class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ $order->note }}</textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const statusSelect = document.getElementById('status');
                const cancelReasonContainer = document.getElementById('cancelReasonContainer');
                const cancelReasonInput = document.getElementById('cancel_reason');

                function toggleCancelReason() {
                    if (statusSelect.value === 'CANCELLED') {
                        cancelReasonContainer.classList.remove('hidden');
                        cancelReasonInput.setAttribute('required', 'required');
                    } else {
                        cancelReasonContainer.classList.add('hidden');
                        cancelReasonInput.removeAttribute('required');
                    }
                }

                // Kiểm tra trạng thái ban đầu
                toggleCancelReason();

                // Lắng nghe sự kiện thay đổi trạng thái
                statusSelect.addEventListener('change', toggleCancelReason);
            });
        </script>
    @endpush
@endsection
