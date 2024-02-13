@extends('jpanel.layouts.app')
@section('title')
    Add New Brand
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Brand</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.brands') }}">View Brand</a></li>
                    <li class="breadcrumb-item active">Add Brand</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row flash-message">
            <div class="col-12">
                @include('jpanel/flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                 <!-- Profile Update box -->
                 <form action="{{ route('store.brand') }}" method="post">
                    @csrf

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Brand Add Form</h3>
                            <div class="card-tools">
                                <a href="{{route('list.brands')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Brands
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Brand Name</label>
                                <input type="text" class="form-control form-control-sm @error('brand_name') is-invalid @enderror" id="brand_name"
                                    name="brand_name" placeholder="Enter Brand Name">
                                @if ($errors->has('brand_name'))
                                    <div class="text-danger">{{ $errors->first('brand_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug"
                                    name="slug" placeholder="Enter Slug">
                                @if ($errors->has('slug'))
                                    <div class="text-danger">{{ $errors->first('slug') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Submit <i
                                    class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->

                    </div>
                    <!-- /.card -->
                </form>

            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
