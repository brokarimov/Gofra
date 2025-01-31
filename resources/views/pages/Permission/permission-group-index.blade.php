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
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ $model->name }}</td>
                        <td>
                            <a href="{{route('permission-group.status', $model->id)}}" class="btn btn-outline-{{$model->status == 1 ? 'primary' : 'danger'}}">{{$model->status == 1 ? 'Active': 'Inactive'}}</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection