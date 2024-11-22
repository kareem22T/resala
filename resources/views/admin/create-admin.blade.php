@extends('admin.layouts.admin-layout')
@section('create_admin_active', 'active')

@section('content')
<div class="container">
    <h2>إدارة المسؤولين</h2>

    <!-- عرض المسؤولين الحاليين في جدول -->
    <div class="card mt-4">
        <div class="card-header">
            المسؤولون الحاليون
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الأدوار</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                @foreach($admin->roles as $role)
                                    <span class="badge bg-success">{{ $role->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('admin.editAdmin', $admin->id) }}" class="btn btn-sm btn-warning">تعديل</a>

                                <!-- Delete Button with Confirmation -->
                                <form action="{{ route('admin.deleteAdmin', $admin->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">حذف</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- نموذج لإنشاء مسؤول جديد -->
    <div class="card mt-4">
        <div class="card-header">
            إنشاء مسؤول جديد
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.storeAdmin') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label class="mb-2" for="name">الاسم:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2" for="email">البريد الإلكتروني:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2" for="password">كلمة المرور:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2" for="password_confirmation">تأكيد كلمة المرور:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-2">تعيين الأدوار:</label>
                    <div class="row">
                        @foreach($roles as $role)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="roles[]" value="{{ $role->name }}" class="form-check-input" id="role-{{ $role->id }}">
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">إنشاء مسؤول</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Show confirmation before deletion
    function confirmDelete(button) {
        if (confirm('هل أنت متأكد من أنك تريد حذف هذا المسؤول؟')) {
            button.closest('form').submit();
        }
    }

    // Hide loader after content loads
    $('.loader').fadeOut();
</script>
@endsection
