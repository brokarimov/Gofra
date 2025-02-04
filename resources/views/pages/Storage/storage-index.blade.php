@extends('layouts.admin')

@section('content')

<div class="col-12">
    <h1>Storage Management</h1>
    @if (auth()->user()->hasPermission('storage.store'))
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
        </svg>
    </button>

    <!-- Add Role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addRoleModalLabel">Add New Storage Type</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('storage.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="roleName" class="form-label">Storage Name</label>
                            <input type="text" class="form-control" id="roleName" name="name" placeholder="Name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror

                            <label for="roleName" class="form-label">Users </label>
                            <select name="user_id" class="form-control">
                                <option value="">Select User Name</option>
                                @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <span class="text-danger">{{ $message }}</span><br>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Salary</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif



    <div class="card mt-2">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>User</th>
                        @if (auth()->user()->hasPermission('storage.status'))
                        <th>Status</th>
                        @endif
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->user->name}}</td>
                        <td>
                            @if (auth()->user()->hasPermission('storage.status'))
                            <a href="{{route('storage.status', $model->id)}}" class="btn btn-outline-{{$model->status == 1 ? 'primary' : 'danger'}}">{{$model->status == 1 ? 'Active': 'Inactive'}}</a>

                            @endif

                        </td>

                        <td>
                            @if (auth()->user()->hasPermission('storage.delete'))
                            <!-- Delete Button -->
                            <a href="{{route('storage.delete', $model->id)}}" type="button" class="btn btn-outline-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                </svg>
                            </a>
                            @endif

                            @if (auth()->user()->hasPermission('storage.update'))
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editRoleModal{{ $model->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                </svg>
                            </button>

                            <!-- Edit Role Modal -->
                            <div class="modal fade" id="editRoleModal{{ $model->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Edit Storage</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('storage.update', $model->id)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label">Storage Name</label>
                                                    <input type="text" class="form-control" name="name" value="{{ $model->name }}" placeholder="Name">
                                                    @error('name')
                                                    <span class="text-danger">{{ $message }}</span><br>
                                                    @enderror

                                                    <label class="form-label">Users</label>
                                                    <select name="user_id" class="form-control">
                                                        @foreach ($users as $user)
                                                        <option value="{{ $user->id }}" {{ $model->user_id == $user->id ? 'selected' : '' }}>
                                                            {{ $user->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span><br>
                                                    @enderror
                                                </div>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {{$models->links()}}
            </div>
        </div>
    </div>
</div>

@endsection