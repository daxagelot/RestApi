@extends('jpanel.layouts.app')
@section('title')
    Edit Brand
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Edit Brand</h1>
            </div>
            <div class="col-5 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.brands') }}">View Brand</a></li>
                    <li class="breadcrumb-item active">Edit Brand</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        @if(hasPermission('brand',3))
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                 <!-- Category Update box -->
                 <form action="{{ route('update.brand',$brand->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Brand Edit Form</h3>
                            <div class="card-tools">
                                <a href="{{route('list.brands')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Brand
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
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-sm @error('brand_name') is-invalid @enderror" id="brand_name"
                                    name="brand_name" placeholder="Enter Brand Name" value="{{$brand->name}}">
                                @if ($errors->has('brand_name'))
                                    <div class="text-danger">{{ $errors->first('brand_name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug"
                                    name="slug" placeholder="Enter Slug" value="{{$brand->slug}}">
                                @if ($errors->has('slug'))
                                    <div class="text-danger">{{ $errors->first('slug') }}</div>
                                @endif
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Update <i
                                    class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </form>
            </div>
            <div class="col-6">
                <!-- Default box -->
                 <!-- Description Update box -->
                 <form action="{{ route('update.brand.description',$brand->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Brand Descriptions</h3>
                            <div class="card-tools">

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
                                <label for="name">Short Description</label>
                                <input type="text" class="form-control form-control-sm @error('shortDescription') is-invalid @enderror" id="shortDescription"
                                    name="shortDescription" placeholder="Short Description" value="{{$brand->shortDescription}}">
                                @if ($errors->has('shortDescription'))
                                    <div class="text-danger">{{ $errors->first('shortDescription') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Long Description</label>
                                <textarea rows="3" class="form-control form-control-sm @error('longDescription') is-invalid @enderror" id="longDescription"
                                    name="longDescription" placeholder="Long Description" >{{$brand->longDescription}}</textarea>
                                @if ($errors->has('longDescription'))
                                    <div class="text-danger">{{ $errors->first('longDescription') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Update <i
                                    class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </form>
            </div>
            <div class="col-6">
                <!-- Category Meta Data Update box -->
                <form action="{{ route('update.brand.meta',$brand->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Brand Meta Details</h3>
                            <div class="card-tools">

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
                                <label for="name">Meta Title</label>
                                <input type="text" class="form-control form-control-sm @error('metaTitle') is-invalid @enderror" id="metaTitle"
                                    name="metaTitle" placeholder="Meta Title" value="{{$brand->metaTitle}}">
                                @if ($errors->has('metaTitle'))
                                    <div class="text-danger">{{ $errors->first('metaTitle') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Keywords</label>
                                <input type="text" class="form-control form-control-sm @error('metaKeyword') is-invalid @enderror" id="metaKeyword"
                                    name="metaKeyword" placeholder="Meta Keywords" value="{{$brand->metaKeyword}}">
                                @if ($errors->has('metaKeyword'))
                                    <div class="text-danger">{{ $errors->first('metaKeyword') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Description</label>
                                <input type="text" class="form-control form-control-sm @error('metaDescription') is-invalid @enderror" id="metaDescription"
                                    name="metaDescription" placeholder="Meta Description" value="{{$brand->metaDescription}}">
                                @if ($errors->has('metaDescription'))
                                    <div class="text-danger">{{ $errors->first('metaDescription') }}</div>
                                @endif
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Update <i
                                    class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </form>
            </div>

        </div>
        <div class="row">

            <div class="col-6">
                <!-- Default box -->
                <!-- Category Icon Image Update box -->
                <form action="{{ route('update.brand.logo',$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Logo Image</h3>
                            <div class="card-tools">
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
                                <img height="80px" src="{{ asset('/storage/images/brand/logo/th/'.$brand->brandLogo) }}" class="elevation-2 mb-4 p-2">
                                <input type="file" name="icon" class="form-control @error('icon') is-invalid @enderror" >
                                @if ($errors->has('icon'))
                                    <div class="text-danger">{{ $errors->first('icon') }}</div>
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
                <!-- Category Icon Image Update box -->
            </div>
            <div class="col-6">
                <!-- Default box -->
                <!-- Category Cover Image Update box -->
                <form action="{{ route('update.brand.cover',$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Brand Cover Image</h3>
                            <div class="card-tools">
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
                                <img height="80px" src="{{ asset('/storage/images/brand/cover/th/'.$brand->coverImage) }}" class="elevation-2 mb-4 p-2">
                                <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" >
                                @if ($errors->has('cover'))
                                    <div class="text-danger">{{ $errors->first('cover') }}</div>
                                @endif

                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Submit <i class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->

                    </div>
                    <!-- /.card -->
                </form>
                <!-- Category Icon Image Update box -->
            </div>
        </div>
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
