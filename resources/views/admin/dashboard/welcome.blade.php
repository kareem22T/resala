@extends('admin.layouts.admin-layout')
@section('title', "تعديل الصفحة الرئيسية")
@section('content')
<div class="d-flex justify-content-between align-items-center">

    <h1 class="m-0 mt-4">
        اهلا {{ Auth::guard('admin')->user()->name }}
    </h1>
    <a href="/admin/logout" class="btn btn-outline-danger mx-3 mt-2 d-block">Logout</a>
</div>

@endsection
@section('scripts')
<script>
    $('.loader').fadeOut();
</script>
@endsection
