@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="display-1">404</h1>
    <p class="lead">الصفحة المطلوبة غير موجودة</p>
    <a href="{{ url('/') }}" class="btn btn-primary">العودة إلى الصفحة الرئيسية</a>
</div>
@endsection