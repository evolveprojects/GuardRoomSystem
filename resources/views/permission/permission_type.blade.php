@extends('layouts.app')

@section('title', 'Permission')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Permission Manager</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Permission Type</li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>

        <div class="app-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        @include('common.alerts')
                        <!-- Card -->
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">

                                <!-- Add permission Button & Search -->
                                <div class="row mb-3">
                                    <!-- Add permission Button -->
                                    <div class="col-md-6 d-flex align-items-permission">
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#add-permission-modal">
                                            <i class="bi bi-plus-lg"></i> Add Permission Type
                                        </button>
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="col-md-6">
                                        <form action="{{ route('permissions.type') }}" method="get">
                                            <div class="input-group">
                                                <input type="search" class="form-control" name="searchKey"
                                                    placeholder="Permission Type" value="{{ $searchKey ?? '' }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Add permission Modal -->
                                <div class="p-1">
                                    @include('permission.components.createpermission_type')
                                </div>

                                <!-- permissions Table -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                            <tr>
                                                <th class="w-25">#</th>
                                                <th class="w-25">Permission Type</th>
                                                <th class="w-25">Status</th>
                                                <th class="w-25">Actions</th>
                                            </tr>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($permission as $permissions)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $permissions->type_name }}</td>
                                                <td>
                                                    @if ($permissions->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
{{-- 
                                                <td>
                                                    <div class="accordion accordion-flush"
                                                        id="accordionFlush{{ $permissions->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="flush-heading{{ $permissions->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    style="padding-top: unset;padding-bottom: unset;"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapse{{ $permissions->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapse{{ $permissions->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $permissions->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-heading{{ $permissions->id }}"
                                                                data-bs-parent="#accordionFlush{{ $permissions->id }}">
                                                                <div class="accordion-body"
                                                                    style="padding-top: 8px;padding-bottom: unset;">
                                                                    @include('permission.components.edit_permission_type', ['permissionType' => $permissions])

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td> --}}
                                                <td>
    <div class="accordion accordion-flush" id="accordionFlush{{ $permissions->id }}">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-heading{{ $permissions->id }}">
                <button class="accordion-button collapsed" type="button"
                    style="padding-top: unset;padding-bottom: unset;"
                    data-bs-toggle="collapse"
                    data-bs-target="#flush-collapse{{ $permissions->id }}"
                    aria-expanded="false"
                    aria-controls="flush-collapse{{ $permissions->id }}">
                    Actions
                </button>
            </h2>
            <div id="flush-collapse{{ $permissions->id }}"
                class="accordion-collapse collapse"
                aria-labelledby="flush-heading{{ $permissions->id }}"
                data-bs-parent="#accordionFlush{{ $permissions->id }}">
                <div class="accordion-body" style="padding-top: 8px; padding-bottom: unset;">
                    <!-- Edit button now triggers modal -->
                    <button type="button"
    class="btn btn-success btn-sm w-100"
    data-bs-toggle="modal"
    data-bs-target="#editPermissionTypeModal{{ $permissions->id }}">
    Edit
</button>

           

                    <!-- Include Edit Modal -->
                    @include('permission.components.edit_permission_type', ['permissionType' => $permissions])
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

                                <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-4">
                                <div class="pagination-wrapper">
                                    {{ $permission->onEachSide(1)->links('pagination::bootstrap-5') }}
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

<style>
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
</style>
