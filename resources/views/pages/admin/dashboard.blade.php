@extends('layouts.admin.master')

@section('title', 'Bảng Điều Khiển')
@section('nav-active', 'dashBoard')
@section('currentScreenManager', 'Bảng Điều Khiển')

@vite(['resources/js/admin/Dashboard.js'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php $breadCrump = [['name' => 'Bảng điều khiển', 'href' => route('admin.dashboard')]]; @endphp

@section('content')
    <div class="grid md:grid-cols-3">
        <div class="bg-white">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection