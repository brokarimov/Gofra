@extends('layouts.admin')

@section('content')
<div class="col-12">
    <h1>Permission Management</h1>
    <h3>Role: {{ ucfirst($role->name) }}</h3>

    {{-- Permissions Assignment Form --}}
    @if(isset($permissionGroups))
    <form action="{{ route('permission.store', $role->id) }}" method="POST">
        @csrf
        <div class="row mt-4">
            {{-- Display Permissions Below Each Group --}}
            <div class="col-12 mt-2">
                <div class="row">
                    @foreach ($permissionGroups as $group)
                    <div class="col-md-4">
                        <h5>{{ ucfirst($group->name) }}</h5>
                        <div class="border p-2 rounded">
                            @foreach ($group->permissions as $permission)
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input"
                                    name="permissions[]" value="{{ $permission->id }}"
                                    @if($rolePermissions->where('role_id', $role->id)->where('permission_id', $permission->id)->count() > 0) checked @endif>
                                <label class="form-check-label">{{ $permission->name }}</label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Save Permissions</button>
    </form>
    @endif
</div>
@endsection