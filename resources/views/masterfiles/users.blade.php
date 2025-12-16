@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">User Management</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <!-- Card -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">

                                <!-- Add User Button and Search Bar in Same Row -->
                                <div class="row mb-3">
                                    <div class="col-md-6 d-flex align-items-center">
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
                                            <i class="bi bi-plus-lg"></i> Add User
                                        </button>
                                    </div>

                                    <div class="col-md-6">
                                        <form action="{{ route('Masterfile.users') }}" method="get">
                                            <div class="input-group">
                                                <input type="search"
                                                       class="form-control"
                                                       name="searchKey"
                                                       placeholder="User Name"
                                                       value="{{ $searchKey ?? '' }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Add User Modal (Component Included) -->
                                <div class="p-1">
                                    @include('masterfiles.components.add_user')
                                </div>

                                <!-- Users Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>id</th>
                                                <th>Name</th>
                                                <th>User Type</th>
                                                <th>EPF Number</th>

                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Status</th>
                                                <th style="width: 120px;">Actions</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                           @foreach ($users as $index => $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->level_name }}</td>
                                                    <td>{{ $user->epf_number }}</td>

                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                   <td>
                                                    @if ($user->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                    <td>
                                                        <div class="accordion accordion-flush"
                                                            id="accordionFlush{{ $user->id }}">
                                                            <div class="accordion-item">
                                                                <h2 class="accordion-header"
                                                                    id="flush-heading{{ $user->id }}">
                                                                    <button class="accordion-button collapsed"
                                                                        type="button"
                                                                        style="padding-top: unset;padding-bottom: unset;"
                                                                        data-bs-toggle="collapse"
                                                                        data-bs-target="#flush-collapse{{ $user->id }}"
                                                                        aria-expanded="false"
                                                                        aria-controls="flush-collapse{{ $user->id }}">
                                                                        Actions
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapse{{ $user->id }}"
                                                                    class="accordion-collapse collapse"
                                                                    aria-labelledby="flush-heading{{ $user->id }}"
                                                                    data-bs-parent="#accordionFlush{{ $user->id }}">
                                                                    @if(auth()->user()->user_type == 1)
                                                                        <div class="accordion-body"
                                                                            style="padding-top: 8px;padding-bottom: unset;">
                                                                            @include('permission.components.change_permission') <br>
                                                                        </div>
                                                                    @endif
                                                                    <div class="accordion-body"
                                                                    style="padding-top: 8px;padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_users')
                                                                    <br>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                                <!-- End Users Table -->


                                <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-4">
                                <div class="pagination-wrapper">
                                    {{ $users->onEachSide(1)->links('pagination::bootstrap-5') }}
                                </div>
                            </div>

                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
{{-- <style>
.pagination-wrapper nav {
    display: inline-block;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-radius: 8px;
    /* padding: 8px ; */
    background: #fff;
}

.pagination-wrapper .page-link {
    border-radius: 6px !important;
    padding: 6px 12px;
}

.pagination-wrapper .page-item.active .page-link {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
}
</style> --}}
