@extends('layouts.admin.master')

@section('title', 'Thống kê')
@section('nav-active', 'dashBoard')

@vite(['resources/js/admin/Dashboard.js'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php $breadCrump = [['name' => 'Thống kê', 'href' => route('admin.dashboard')]]; @endphp

@section('content')
    {{-- Grid badge data --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-5">
        <div
            class="col flex gap-4 items-center py-2 px-3 lg:px-4 rounded-xl text-sm md:text-md bg-blue-500 text-white transition-transform duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <span style="font-size: 24px; md:font-size: 30px" class="material-symbols-rounded">
                payments
            </span>
            <div>
                <h2>Doanh Thu</h2>
                <span class="font-bold text-lg md:text-xl" id="revenue-value">{{ number_format($totalRevenue) }}đ</span>
            </div>
        </div>
        <a href="{{ route('admin.orders') }}"
            class="col flex gap-4 items-center py-2 px-3 lg:px-4 rounded-xl text-sm md:text-md bg-green-500 text-white transition-transform duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <span style="font-size: 24px; md:font-size: 30px" class="material-symbols-rounded">
                shopping_cart
            </span>
            <div>
                <h2>Đơn Hàng</h2>
                <span class="font-bold text-lg md:text-xl" id="order-value">{{ number_format($totalOrder) }}</span>
            </div>
        </a>
        <a href="{{ route('admin.products') }}"
            class="col flex gap-4 items-center py-2 px-3 lg:px-4 rounded-xl text-sm md:text-md bg-yellow-500 text-white transition-transform duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <span style="font-size: 24px; md:font-size: 30px" class="material-symbols-rounded">
                apparel
            </span>
            <div>
                <h2>Sản Phẩm</h2>
                <span class="font-bold text-lg md:text-xl" id="product-value">{{ number_format($totalProduct) }}</span>
            </div>
        </a>
        <a href="{{ route('dashboard.news') }}"
            class="col flex gap-4 items-center py-2 px-3 lg:px-4 rounded-xl text-sm md:text-md bg-gray-500 text-white transition-transform duration-300 hover:scale-105 hover:shadow-xl cursor-pointer">
            <span style="font-size: 24px; md:font-size: 30px" class="material-symbols-rounded">
                news
            </span>
            <div>
                <h2>Bài Viết</h2>
                <span class="font-bold text-lg md:text-xl" id="news-value">{{ number_format($totalNews) }}</span>
            </div>
        </a>
    </div>

    {{-- Grid charts --}}
    <div class="grid md:grid-cols-1 lg:grid-cols-2 gap-4 lg:gap-5 py-4">
        {{-- Revenue Chart --}}
        <div class="col">
            <div class="mt-4 lg:mt-8 bg-white p-3 lg:p-4 rounded-xl shadow">
                <h2 class="text-lg md:text-xl font-bold mb-3 lg:mb-4">Doanh thu</h2>
                <div class="flex flex-wrap items-end gap-2 md:gap-4 mb-4" id="revenue-filter">
                    @php
                        $from = request()->input('from', \Carbon\Carbon::parse($firstSaleDate)->format('Y-m-d'));
                        $to = request()->input('to', now()->format('Y-m-d'));
                    @endphp

                    <div class="w-full sm:w-auto">
                        <label for="from" class="block text-sm font-medium">Từ ngày:</label>
                        <input type="date" id="from" value="{{ $from }}"
                            class="w-full sm:w-auto p-2 border rounded" />
                    </div>

                    <div class="w-full sm:w-auto">
                        <label for="to" class="block text-sm font-medium">Đến ngày:</label>
                        <input type="date" id="to" value="{{ $to }}"
                            class="w-full sm:w-auto p-2 border rounded" />
                    </div>

                    <button id="filter-button"
                        class="w-full sm:w-auto mt-2 sm:mt-0 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                        Lọc doanh thu
                    </button>
                </div>

                <div style="min-height: 250px; max-height: 350px; md:min-height: 300px; md:max-height: 400px;">
                    <canvas id="revenueChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Order By Status Chart --}}
        <div class="col">
            <div class="mt-4 lg:mt-8 bg-white p-3 lg:p-4 rounded-xl shadow">
                <h2 class="text-lg md:text-xl font-bold mb-3 lg:mb-4">Số đơn hàng theo trạng thái</h2>
                <div style="min-height: 250px; max-height: 350px; md:min-height: 300px; md:max-height: 400px;">
                    <canvas id="orderStatusChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Favorite Products Chart --}}
        <div class="col">
            <div class="mt-4 lg:mt-8 bg-white p-3 lg:p-4 rounded-xl shadow">
                <h2 class="text-lg md:text-xl font-bold mb-3 lg:mb-4">Top Sản phẩm được yêu thích nhất</h2>
                <div style="min-height: 250px; max-height: 350px; md:min-height: 300px; md:max-height: 400px;">
                    <canvas id="favoriteProductChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top View Products Chart --}}
        <div class="col">
            <div class="mt-4 lg:mt-8 bg-white p-3 lg:p-4 rounded-xl shadow">
                <h2 class="text-lg md:text-xl font-bold mb-3 lg:mb-4">Top Sản phẩm được xem nhiều nhất</h2>
                <div style="min-height: 250px; max-height: 350px; md:min-height: 300px; md:max-height: 400px;">
                    <canvas id="viewProductChart"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Watch News Chart --}}
        <div class="col">
            <div class="mt-4 lg:mt-8 bg-white p-3 lg:p-4 rounded-xl shadow">
                <h2 class="text-lg md:text-xl font-bold mb-3 lg:mb-4">Top tin tức được xem nhiều nhất</h2>
                <div style="min-height: 250px; max-height: 350px; md:min-height: 300px; md:max-height: 400px;">
                    <canvas id="newsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection
