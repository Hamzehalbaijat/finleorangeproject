@extends('layouts.app')

@section('title', 'الملف الشخصي')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i>الملف الشخصي</h4>
        </div>
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div class="mb-3">
                        <i class="bi bi-person-badge fs-1 text-primary"></i>
                    </div>
                    <h3>{{ $user->name }}</h3>
                    <p class="text-muted">{{ $user->role }}</p>
                </div>
                
                <div class="col-md-8">
                    <dl class="row">
                        <dt class="col-sm-4">البريد الإلكتروني:</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>

                        <dt class="col-sm-4">رقم الهاتف:</dt>
                        <dd class="col-sm-8">{{ $user->phone }}</dd>

                        <dt class="col-sm-4">رصيد المحفظة:</dt>
                        <dd class="col-sm-8">{{ $user->balance }} دينار</dd>

                        <dt class="col-sm-4">رقم البطاقة:</dt>
                        <dd class="col-sm-8">{{ $user->nfc_card_id ?? 'غير مسجلة' }}</dd>
                    </dl>
                    
                    <a href="{{ route('passenger.profile.edit') }}" class="btn btn-primary">
                        <i class="bi bi-pencil-square me-2"></i>تعديل الملف
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection