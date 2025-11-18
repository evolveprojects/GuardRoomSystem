@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Userlevels Master</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                             <li class="breadcrumb-item"><a href="/dashboard"><i class="bi bi-house"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">userlevels</li>
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
                        <div class="card mb-4">

                            <div class="row">
                                <div class="col-md-2" style="padding-left: 28px;padding-top: 10px;">
                                    {{-- @if (Auth::user()->hasPermission('create_vendor')) --}}
                                    @include('masterfiles.components.add_userlevel')
                                    {{-- @endif --}}
                                </div>
                                
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-6"style="padding-top: 10px;padding-right: 28px;">
                                    <form action="" method="get">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="searchKey"
                                                placeholder="level Name" value="{{ $searchKey }}">

                                            <button type="submit" class="btn btn-primary">
                                                search
                                            </button>

                                        </div>

                                    </form>
                                </div>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body" style="padding-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">#</th>
                                            <th>Level Code</th>
                                            <th>Level Name</th>
                                            <th>Status</th>
                                            <th style="width: 40px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getuserlevels as $index => $userl)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>

                                                <td>{{ $userl->level_code }}</td>

                                                <td>{{ $userl->level_name }}</td>

                                                <td>
                                                    @if ($userl->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="accordion accordion-flush"
                                                        id="accordionFlush{{ $userl->id }}">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header"
                                                                id="flush-heading{{ $userl->id }}">
                                                                <button class="accordion-button collapsed" type="button"
                                                                    style="padding-top: unset;padding-bottom: unset;"
                                                                    data-bs-toggle="collapse"
                                                                    data-bs-target="#flush-collapse{{ $userl->id }}"
                                                                    aria-expanded="false"
                                                                    aria-controls="flush-collapse{{ $userl->id }}">
                                                                    Actions
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapse{{ $userl->id }}"
                                                                class="accordion-collapse collapse"
                                                                aria-labelledby="flush-heading{{ $userl->id }}"
                                                                data-bs-parent="#accordionFlush{{ $userl->id }}">
                                                                <div class="accordion-body"
                                                                    style="padding-top: 8px;padding-bottom: unset;">
                                                                    @include('masterfiles.components.edit_userlevel') <br>
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
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <div class="d-felx justify-content-center">



                                    {{ $getuserlevels->links() }}



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>
@endsection
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach((form) => {
            form.addEventListener(
                'submit',
                (event) => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }

                    form.classList.add('was-validated');
                },
                false,
            );
        });
    })();
</script>
