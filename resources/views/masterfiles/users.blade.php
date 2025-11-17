@extends('layouts.app')

@section('title', 'Users')

@section('content')
<main class="app-main">

    <!-- Header -->
    <div class="app-content-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h3 mb-1 fw-bold">User Management</h1>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="/dashboard"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">

                    <!-- Card -->
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-body">

                            <!-- Add User Button -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-user-modal">
                                    <i class="bi bi-plus-lg"></i> Add User
                                </button>
                            </div>

                            <!-- Add User Modal (Component Included) -->
                            <div class="p-3">
                                @include('masterfiles.components.add_user')
                            </div>

                            <!-- Users Table -->
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>User Type</th>
                                            <th>EPF Number</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Status</th>
                                            <th style="width: 120px;">Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Example User</td>
                                            <td>Admin</td>
                                            <td>1212</td>
                                            <td>admin123</td>
                                            <td>demo@mail.com</td>
                                            <td>0771234567</td>
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table>
                            </div>
                            <!-- End Users Table -->

                        </div>
                    </div>
                    <!-- End Card -->

                </div>
            </div>

        </div>
    </div>

</main>
@endsection
