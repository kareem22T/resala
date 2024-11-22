@extends('admin.layouts.admin-layout')
@section('create_role_active', 'active')
@section('content')
<div class="container">
    <h2>ادارة التصريحات</h2>

    <!-- Display Existing Roles in a Table -->
    <div class="card mt-4">
        <div class="card-header">
            الادوار المتاحة
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>اسم الدور</th>
                        <th>التصريحات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @foreach($role->permissions as $permission)
                                    <span class="badge bg-primary my-2">{{ $permission->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Form to Create a New Role -->
    <div class="card mt-4">
        <div class="card-header">
            اضافة دور
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.storeRole') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="role_name"  class="mb-3">اسم الدور:</label>
                    <input type="text" name="role_name" id="role_name" class="form-control" required>
                </div>

                <div class="form-group mt-3">
                    <label class="mb-3">اضافة التصريحات:</label>
                    <div class="row">
                        @foreach($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" class="form-check-input" id="permission-{{ $permission->id }}">
                                    <label class="form-check-label" for="permission-{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-4">اضافة الدور</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.loader').fadeOut()
</script>
@endsection
