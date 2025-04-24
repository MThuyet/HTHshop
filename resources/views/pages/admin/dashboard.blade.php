@extends('layouts.admin.master')

@section('title', 'Thống kê')
@section('nav-active', 'dashBoard')

@vite(['resources/js/admin/Dashboard.js'])
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php $breadCrump = [['name' => 'Thống kê', 'href' => route('admin.dashboard')]]; @endphp

@section('content')
    <div class="grid md:grid-cols-3">
        <div class="bg-white">
            <canvas id="myChart"></canvas>
        </div>
    </div>
@endsection