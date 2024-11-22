@extends('admin.layouts.admin-layout')
@section('edit_admin_active', 'active')

@section('content')
<div class="container">
    <h2>تعديل بيانات المسؤول</h2>

    <div class="card mt-4">
        <div class="card-header">
            تعديل المسؤول
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.updateAdmin', $admin->id) }}" method="POST">
                @csrf
                @method('POST')

                <div class="form-group">
                    <label class="mb-2" for="name">الاسم:</label>
                    <input type="text" name="name" id="name" value="{{ $admin->name }}" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2" for="email">البريد الإلكتروني:</label>
                    <input type="email" name="email" id="email" value="{{ $admin->email }}" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2" for="password_new">كلمة المرور (اختياري):</label>
                    <input type="password_new" name="password_new" id="password_new" class="form-control" placeholder="اتركه فارغاً إذا كنت لا تريد تغييره">
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2">تعيين الأدوار:</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="form-check-input" id="role-{{ $role->id }}"
                                           @if($admin->roles->contains($role)) checked @endif>
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">تحديث المسؤول</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $('.loader').fadeOut();
</script>
@endsection
