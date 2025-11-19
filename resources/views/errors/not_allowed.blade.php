@extends('layouts.app')

@section('title', 'Not Allowed')



@section('content')







<div>



    <section class="d-flex justify-content-center align-items-start vh-100 py-5 px-3 px-md-0">



<div class="d-flex flex-column w-100 align-items-center">

    <div class="p-4 p-sm-5 col-lg-7 col-md-10 col-12 text-center px-4">

        <i class="ri-file-damage-fill ri-5x mb-3"></i>

        <h1 class="mb-4 display-5 fw-bold" style="color: red;">Access Denied</h1>


        <p class="lead text-muted">Looks like you've no permissions to view this page content. Please contact the Administrator.</p>

        <a class="btn btn-primary mt-4" href="/dashboard">Back to home</a>

    </div>

</div>



</section>

  </div>



@endsection

