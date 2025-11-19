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
                                                <th>id</th>
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
                                            @foreach ($user as $index => $user)
                                                <tr>
                                                    <td>{{ $user->id }}</td>

                                                    <td>{{ $user->name }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>{{ $user->email }}</td>
                                                    <td></td>
                                                    <td></td>



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
                                                                    <div class="accordion-body"
                                                                        style="padding-top: 8px;padding-bottom: unset;">
                                                                        @include('permission.components.change_permission') <br>
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

                            </div>
                        </div>
                        <!-- End Card -->

                    </div>
                </div>

            </div>
        </div>

    </main>
@endsection
