@extends('layouts.admin.master')
@section('title', 'Chi tiết đơn hàng')
@section('nav-active', 'order')

@php
    $breadCrump = [
        ['name' => 'Quản lý đơn hàng', 'href' => route('admin.order')],
        ['name' => 'Chi tiết đơn hàng: ' . $order->order_code, 'href' => '#'],
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
            <h2 class="text-2xl font-bold text-gray-800 mb-4 md:mb-0">Chi tiết đơn hàng</h2>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('admin.order') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    <span class="material-symbols-rounded mr-2">arrow_back</span>
                    Quay lại danh sách
                </a>
                <a href="{{ route('admin.order.edit', $order->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">
                    <span class="material-symbols-rounded mr-2">edit_square</span>
                    Chỉnh sửa
                </a>
            </div>
        </div>

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
                    <p class="font-medium">{{ $order->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                    </p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Trạng thái:</p>
                    <p class="font-medium">
                        <span
                            class="px-2 py-1 rounded-full text-sm
                            @if ($order->status == 'PENDING') bg-yellow-100 text-yellow-800
                            @elseif($order->status == 'CONFIRMED') bg-blue-100 text-blue-800
                            @elseif($order->status == 'SHIPPING') bg-indigo-100 text-indigo-800
                            @elseif($order->status == 'DONE') bg-green-100 text-green-800
                            @else bg-red-100 text-red-800 @endif">
                            {{ $statusLabels[$order->status] }}
                        </span>
                    </p>
                </div>
                <div class="flex gap-2">
                    <p class="text-gray-600 font-semibold">Tổng tiền:</p>
                    <p class="font-medium">{{ number_format($order->total_price) }}đ</p>
                </div>
            </div>
            @if ($order->details->where('custom_image')->count() > 0)
                <div class="mt-4">
                    <h4 class="text-lg font-semibold mb-2">Ảnh tùy chỉnh</h4>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach ($order->details as $detail)
                            @if ($detail->custom_image)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $detail->custom_image) }}" alt="Ảnh tùy chỉnh"
                                        class="w-full h-48 object-cover">
                                    <div class="p-2 text-sm text-gray-600">
                                        {{ $detail->product->name }} - {{ $detail->print_position_label }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
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
                                            <span class="text-red-500 text-sm">-{{ $detail->product->discount }}%</span>
                                        </div>
                                        <span>{{ number_format($detail->discounted_price) }}đ</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">{{ number_format($detail->quantity * $detail->discounted_price) }}đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Ghi chú -->
        @if ($order->note)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Ghi chú</h3>
                <p class="text-gray-700">{{ $order->note }}</p>
            </div>
        @endif

        <!-- Lý do hủy -->
        @if ($order->cancel_reason)
            <div class="mb-6">
                <h3 class="text-xl font-semibold mb-4">Lý do hủy</h3>
                <p class="text-gray-700">{{ $order->cancel_reason }}</p>
            </div>
        @endif
    </div>
@endsection
