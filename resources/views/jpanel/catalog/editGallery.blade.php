@extends('jpanel.layouts.app')
@section('title')
    Edit Gallery
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Edit Gallery</h1>
            </div>
            <div class="col-5 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.gallery') }}">View Gallery</a></li>
                    <li class="breadcrumb-item active">Edit Gallery</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        {{-- @if(hasPermission('category',3)) --}}
        <div class="row">
            <div class="col-12">
                <!-- Default box -->                               
               
<form method="POST" action="{{ route('update.gallery', ['gallery' => $gallery->id]) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gallery Edit Form</h3>
                            <div class="card-tools">

                                <a href="{{route('list.gallery')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All gallery
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
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter Name" value="{{ $gallery->name }}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                                
                            </div>
                            <div class="form-group">
                                <label for="name"> Image</label>
                                <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="cname"
                                    name="image" placeholder="Enter Name" value="{{$gallery->image}}">
                                    
                                @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Category</label>
                                <select class="form-control form-control-sm select2 @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                                    <option value="">No Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id) selected @endif>{{ $category->category->name }}</option>
                                    @endforeach
                                </select>                               
                               
                                @if ($errors->has('category_id'))
                                    <div class="text-danger">{{ $errors->first('category_id') }}</div>
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
            {{-- <div class="col-6">
                <!-- Default box -->
                 <!-- Description Update box -->
                 <form action="{{ url('update.gallery.description',$gallery->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gallery Descriptions</h3>
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
                                    name="shortDescription" placeholder="Short Description" value="{{$gallery->shortDescription}}">
                                @if ($errors->has('shortDescription'))
                                    <div class="text-danger">{{ $errors->first('shortDescription') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Long Description</label>
                                <textarea rows="3" class="form-control form-control-sm @error('longDescription') is-invalid @enderror" id="longDescription"
                                    name="longDescription" placeholder="Long Description" >{{$gallery->longDescription}}</textarea>
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
            </div> --}}
            {{-- <div class="col-6">
                <!-- Category Meta Data Update box -->
                <form action="{{ url('update.gallery.meta',$gallery->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Gallery Meta Details</h3>
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
                                    name="metaTitle" placeholder="Meta Title" value="{{$gallery->metaTitle}}">
                                @if ($errors->has('metaTitle'))
                                    <div class="text-danger">{{ $errors->first('metaTitle') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Keywords</label>
                                <input type="text" class="form-control form-control-sm @error('metaKeyword') is-invalid @enderror" id="metaKeyword"
                                    name="metaKeyword" placeholder="Meta Keywords" value="{{$gallery->metaKeyword}}">
                                @if ($errors->has('metaKeyword'))
                                    <div class="text-danger">{{ $errors->first('metaKeyword') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Description</label>
                                <input type="text" class="form-control form-control-sm @error('metaDescription') is-invalid @enderror" id="metaDescription"
                                    name="metaDescription" placeholder="Meta Description" value="{{$gallery->metaDescription}}">
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
            </div> --}}

        </div>
        {{-- <div class="row">
            <div class="col-4">
                <!-- Default box -->
                <!-- Category Thumbnail Image Update box -->
                <form action="{{ url('update.gallery.thumbnail',$gallery->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Thumbnail Image</h3>
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
                                <img height="80px" src="{{ asset('/storage/images/gallery/th/'.$gallery->thumbnailImage) }}" class="elevation-2 mb-4 p-2">
                                <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" >
                                @if ($errors->has('avatar'))
                                    <div class="text-danger">{{ $errors->first('avatar') }}</div>
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
                <!-- Category Thumbnail Image Update box -->
            </div>
            <div class="col-4">
                <!-- Default box -->
                <!-- Category Icon Image Update box -->
                <form action="{{ url('update.gallery.icon',$gallery->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Icon Image</h3>
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
                                <img height="80px" src="{{ asset('/storage/images/gallery/icon/th/'.$gallery->iconImage) }}" class="elevation-2 mb-4 p-2">
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
            <div class="col-4">
                <!-- Default box -->
                <!-- Category Cover Image Update box -->
                <form action="{{ url('update.gallery.cover',$gallery->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Cover Image</h3>
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
                                <img height="80px" src="{{ asset('/storage/images/gallery/cover/th/'.$gallery->coverImage) }}" class="elevation-2 mb-4 p-2">
                                <input type="file" name="cover" class="form-control @error('cover') is-invalid @enderror" >
                                @if ($errors->has('cover'))
                                    <div class="text-danger">{{ $errors->first('cover') }}</div>
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
        </div> --}}
        
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
