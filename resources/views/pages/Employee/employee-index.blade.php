@extends('layouts.admin')

@section('content')

<div class="col-12">
    <h1>Employee Management</h1>

    @if (auth()->user()->hasPermission('employee.store'))
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
        </svg>
    </button>
    @endif

    <!-- Add Employee Modal -->
    <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add New Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf

                        <label class="form-label">Employee Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Name">
                        @error('name') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">Employee Telephone</label>
                        <input type="text" class="form-control" name="tel" required placeholder="Tel">
                        @error('tel') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">Employee Address</label>
                        <input type="text" class="form-control" name="address" required placeholder="Address">
                        @error('address') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">Employee Department</label>
                        <select name="department_id" class="form-control" required>
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">Employee Salary</label>
                        <select name="salary_type" class="form-control" required>
                            <option value="">Select Salary Type</option>
                            @foreach ($salaries as $salary)
                            <option value="{{ $salary->id }}">{{ $salary->name }}</option>
                            @endforeach
                        </select>
                        @error('salary_type') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">Start Day</label>
                        <input type="time" class="form-control" name="start_day" required>
                        @error('start_day') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <label class="form-label">End Day</label>
                        <input type="time" class="form-control" name="end_day" required>
                        @error('end_day') <span class="text-danger">{{ $message }}</span><br> @enderror

                        <button type="submit" class="btn btn-primary mt-3">Save Employee</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Table -->
    <div class="card mt-2">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        @if (auth()->user()->hasPermission('employee.status'))
                        <th>Status</th>
                        @endif
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                    <tr>
                        <td>{{ $model->id }}</td>
                        <td>{{ ucfirst($model->name) }}</td>

                        @if (auth()->user()->hasPermission('employee.status'))
                        <td>
                            <a href="{{ route('employee.status', $model->id) }}" class="btn btn-outline-{{ $model->status == 1 ? 'primary' : 'danger' }}">
                                {{ $model->status == 1 ? 'Active' : 'Inactive' }}
                            </a>
                        </td>
                        @endif

                        <td>
                            @if (auth()->user()->hasPermission('employee.update'))
                            <!-- Edit Button -->
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#editEmployeeModal{{ $model->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001" />
                                </svg>
                            </button>
                            @endif

                            @if (auth()->user()->hasPermission('employee.delete'))
                            <!-- Delete Button -->
                            <form action="{{ route('employee.delete', $model->id) }}"  style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                                    </svg>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    <!-- Edit Employee Modal -->
                    @if (auth()->user()->hasPermission('employee.update'))
                    <div class="modal fade" id="editEmployeeModal{{ $model->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Edit Employee</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('employee.update', $model->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <label class="form-label">Employee Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $model->name }}" required>
                                        @error('name') <span class="text-danger">{{ $message }}</span><br> @enderror


                                        <label class="form-label">Employee Telephone</label>
                                        <input type="text" class="form-control" name="tel" value="{{ $model->tel }}" required>
                                        @error('tel') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <label class="form-label">Employee Address</label>
                                        <input type="text" class="form-control" name="address" value="{{ $model->address }}" required>
                                        @error('address') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <label class="form-label">Employee Department</label>
                                        <select name="department_id" class="form-control">
                                            @foreach ($departments as $department)
                                            <option value="{{ $department->id }}" {{ $model->department_id == $department->id ? 'selected' : '' }}>
                                                {{ $department->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('department_id') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <label class="form-label">Employee Salary</label>
                                        <select name="salary_type" class="form-control">
                                            @foreach ($salaries as $salary)
                                            <option value="{{ $salary->id }}" {{ $model->salary_type == $salary->id ? 'selected' : '' }}>
                                                {{ $salary->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('department_id') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <label class="form-label">Start Day</label>
                                        <input type="time" class="form-control" name="start_day" value="{{ $model->start_day }}" required>
                                        @error('start_day') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <label class="form-label">End Day</label>
                                        <input type="time" class="form-control" name="end_day" value="{{ $model->end_day }}" required>
                                        @error('end_day') <span class="text-danger">{{ $message }}</span><br> @enderror

                                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @endforeach
                </tbody>
            </table>
            <div>{{ $models->links() }}</div>
        </div>
    </div>
</div>

@endsection