@extends('layouts.app')

@section('title', 'Centers')

@section('content')
    <main class="app-main">

        <!-- Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">All OutWards </h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">
                                    <i class="bi bi-house"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">All OutWards</li>
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


                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <!-- Add outward Button -->
                                    <!-- Add Center Button -->
                                    <div class="col-md-6 d-flex align-items-center">
                                        <a href="{{ route('outward.outwardtype2') }}"><button class="btn btn-primary">
                                                <i class="bi bi-plus-lg"></i> Add New
                                            </button></a>
                                    </div>

                                    <!-- Search Bar -->
                                    <div class="col-md-6">
                                        <form action="" method="get">
                                            <div class="input-group">
                                                <input type="search" class="form-control" name="searchKey"
                                                    placeholder="Search by Outward Number or Vehicle" value="{{ $searchKey ?? '' }}">
                                                <button type="submit" class="btn btn-primary">Search</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Outward No</th>
                                    <th>Center</th>
                                    <th>Type</th>
                                    <th>Vehicle</th>
                                    <th>Driver</th>
                                    <th>Helper</th>
                                    <th>Created by</th>
                                    <th>Status</th>
                                    <th class="">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($out_data as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->outward_no }}</td>
                                        <td>{{ $data->center_name }}</td>
                                        <td>{{$data->type}}</td>
                                        <td>{{ $data->vehicle_no }}/{{ $data->vehicle_type }}</td>
                                        <td>{{ $data->driver_name }}</td>
                                        <td>{{ $data->helper_name }}</td>
                                        <td>{{ $data->created_by_name }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <span class="badge bg-primary">Ongoing</span>
                                            @else
                                                <span class="badge bg-success">Completed</span>
                                            @endif
                                        </td>
                                         <td>
                                    <div class="accordion accordion-flush" id="accordionFlush{{ $data->id }}">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading{{ $data->id }}">
                                                <button class="accordion-button collapsed" type="button"
                                                        style="padding-top: unset; padding-bottom: unset;"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapse{{ $data->id }}"
                                                        aria-expanded="false"
                                                        aria-controls="flush-collapse{{ $data->id }}">
                                                    Actions
                                                </button>
                                            </h2>

                                                    <div id="flush-collapse{{ $data->id }}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="flush-heading{{ $data->id }}"
                                                        data-bs-parent="#accordionFlush{{ $data->id }}">

                                                        <div class="accordion-body" style="padding-top: 8px; padding-bottom: unset;">
                                                           <!-- Change from modal button to link -->
                                                               <a href="{{ route('outward.type2.edit', $data->id) }}" 
   class="btn btn-success btn-sm text-white w-100">
    <i class="ri-add-circle-line align-bottom"></i> Edit
</a>

                                                            
                                                            {{-- <!-- Include Edit Modal -->
                                                            @include('outward.components.edit_outward_type2', ['outward' => $data]) --}}
                                                            
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

                    <!-- Pagination -->
                            <div class="d-flex justify-content-end mt-4">
                                <div class="pagination-wrapper">
                                    {{ $out_data->onEachSide(1)->links('pagination::bootstrap-5') }}
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
