@extends('layouts.admin.master')
@section('title', 'Quản lý đơn hàng')
@section('nav-active', 'order')

@php
    $breadCrump = [['name' => 'Quản lý đơn hàng', 'href' => route('admin.order')]];

    $statusLabels = [
        'PENDING' => 'Chờ xác nhận',
        'CONFIRMED' => 'Đã xác nhận',
        'SHIPPING' => 'Đang giao hàng',
        'DONE' => 'Đã hoàn thành',
        'CANCELLED' => 'Đã hủy',
    ];
@endphp

@section('content')
    <div class="bg-white p-2 border border-1 rounded-md">
        <form method="GET" action="{{ route('admin.order') }}"
            class="flex flex-col md:flex-row items-center justify-between mb-4 gap-3">
            <div class="w-full md:w-1/2">
                <div class="relative z-40">
                    <div class="mb-0 text-md">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Tìm kiếm đơn hàng..."
                            class="w-full border border-gray-300 rounded-lg py-1.5 pl-10 pr-4 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <span class="material-symbols-rounded absolute left-3 top-2 text-gray-400">
                            search
                        </span>
                        <button type="submit"
                            class="text-white absolute end-2.5 top-1/2 -translate-y-1/2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Tìm
                            kiếm</button>
                    </div>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="flex gap-2 mb-0 items-center">
                    <label for="table-row-length" class="text-sm font-medium text-gray-700 mr-2">Hiển thị:</label>
                    <select name="limit-row-length" id="table-row-length" onchange="this.form.submit()"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-md text-sm focus:ring-blue-500 focus:border-blue-500 block p-2">
                        <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 Dòng</option>
                        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 Dòng</option>
                        <option value="20" {{ $perPage == 20 ? 'selected' : '' }}>20 Dòng</option>
                        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25 Dòng</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto mb-3">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="text-xs uppercase bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 font-semibold">
                    <tr>
                        <th class="px-6 py-3">Mã đơn hàng</th>
                        <th class="px-6 py-3">Khách hàng</th>
                        <th class="px-6 py-3">Số điện thoại</th>
                        <th class="px-6 py-3">Tổng tiền</th>
                        <th class="px-6 py-3">Trạng thái</th>
                        <th class="px-6 py-3">Ngày tạo</th>
                        <th class="px-6 py-3 text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $order->order_code }}</td>
                            <td class="px-6 py-4">{{ $order->fullname }}</td>
                            <td class="px-6 py-4">{{ $order->phone }}</td>
                            <td class="px-6 py-4">{{ number_format($order->total_price) }}đ</td>
                            <td class="px-6 py-4">
                                <span
                                    class="px-2 py-1 rounded-full text-sm
                                    @if ($order->status == 'PENDING') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'CONFIRMED') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'SHIPPING') bg-indigo-100 text-indigo-800
                                    @elseif($order->status == 'DONE') bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800 @endif">
                                    {{ $statusLabels[$order->status] }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ $order->created_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.order.show', $order->id) }}"
                                    class="inline-flex rounded-md font-medium text-blue-500 border p-1 hover:underline mr-2">
                                    <span class="material-symbols-rounded">visibility</span>
                                </a>
                                <a href="{{ route('admin.order.edit', $order->id) }}"
                                    class="inline-flex rounded-md font-medium text-yellow-500 border p-1 hover:underline mr-2">
                                    <span class="material-symbols-rounded">edit_square</span>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Không tìm thấy đơn hàng nào
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            {{-- Pagination --}}
            <div class="flex flex-wrap justify-center gap-5 items-center mt-3 px-2">
                <span class="text-sm text-gray-500">
                    Hiển thị {{ $orders->firstItem() }}-{{ $orders->lastItem() }}/{{ $orders->total() }} dòng
                </span>
                <div class="flex items-center gap-1">
                    @if ($orders->lastPage() > 1)
                        {{ $orders->appends(['limit-row-length' => $perPage, 'search' => request('search')])->links('vendor.pagination.tailwind') }}
                    @else
                        <span class="text-gray-400 text-sm">Chỉ có 1 trang</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
