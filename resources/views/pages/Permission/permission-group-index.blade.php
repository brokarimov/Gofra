@extends('layouts.admin')

@section('content')

<div class="col-12">
    <h1>Permission Group Management</h1>


    <div class="card mt-2">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        @if (auth()->user()->hasPermission('permission.status'))
                        <th>Permissions</th>
                        @endif

                        @if (auth()->user()->hasPermission('permission-group.status'))
                        <th>Status</th>
                        @endif

                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ ucfirst($model->name) }}</td>
                        <td>
                            @if (auth()->user()->hasPermission('permission.status'))
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal{{$model->id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list-ul" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M5 11.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5m-3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2m0 4a1 1 0 1 0 0-2 1 1 0 0 0 0 2" />
                                </svg>
                            </button>

                            <!-- Add Role Modal -->
                            <div class="modal fade" id="addRoleModal{{$model->id}}" tabindex="-1" aria-labelledby="addRoleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="addRoleModalLabel">Permissions Status</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('permission.status', $model->id)}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    @foreach ($model->permissions as $permission)
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input"
                                                            name="permissions[]" value="{{ $permission->id }}"
                                                            @if($permission->status == 1) checked @endif>
                                                        <label class="form-check-label" style="{{$permission->status == 0 ? "text-decoration: line-through; color: red;": 'color: green'}}">{{ $permission->name }}</label>
                                                    </div>
                                                    @endforeach
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Save Permissions</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </td>
                        <td>
                            @if (auth()->user()->hasPermission('permission-group.status'))
                            <a href="{{route('permission-group.status', $model->id)}}" class="btn btn-outline-{{$model->status == 1 ? 'primary' : 'danger'}}">{{$model->status == 1 ? 'Active': 'Inactive'}}</a>

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