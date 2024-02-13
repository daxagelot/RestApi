@extends('jpanel.layouts.app')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Dashboard</li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
@if (hasPermission('dashboard', 1))
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('jpanel/flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-warning">
                    <div class="inner">
                        {{-- <h3>{{$categories}}</h3> --}}
                        <h3>0</h3>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        {{-- <h3>{{$products}}</h3> --}}
                        <h3>0</h3>
                        <p>Products</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3 col-sm-6 col-12">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Categories</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</section>
@endif
    <!-- /.content -->
@endsection
@section('scripts')
@endsection

