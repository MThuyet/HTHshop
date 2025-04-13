@extends('layouts.admin.master')
@section('title', 'Tạo sản phẩm mới')
@section('nav-active', 'product')
@php
    $breadCrump = [
        ['name' => 'Quản lý sản phẩm', 'href' => route('admin.product')], 
        ['name' => 'Tạo sản phẩm mới', 'href' => route('admin.product.create')], 
    ];
@endphp

@section('content')
    <form action=""></form>
@endsection