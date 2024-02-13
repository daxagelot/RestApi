@extends('jpanel.layouts.app')
@section('title')
    Add New Gallery
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Gallery</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.gallery') }}">View Gallery</a></li>
                    <li class="breadcrumb-item active">Add Gallery</li> 
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
                 <form action="{{ route('store.gallery') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Gallery</h3>
                            <div class="card-tools">
                                <a href="{{route('list.gallery')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Gallery
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
                                <label for="name"> Name</label>
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="cname"
                                    name="name" placeholder="Enter Name">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name"> Image</label>
                                <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="cname"
                                    name="image" placeholder="Enter Name">
                                    
                                @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1"> Category</label>
                                <select  class="form-control form-control-sm select2 @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    <option value="">No  Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('category_id'))
                                    <div class="text-danger">{{ $errors->first('category_id') }}</div>
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
