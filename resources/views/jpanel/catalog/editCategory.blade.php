@extends('jpanel.layouts.app')
@section('title')
    Edit Category
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Edit Category</h1>
            </div>
            <div class="col-5 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.category') }}">View Category</a></li>
                    <li class="breadcrumb-item active">Edit Category</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        @if(hasPermission('category',3))
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                 <!-- Category Update box -->
                 <form action="{{ route('update.category',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category Edit Form</h3>
                            <div class="card-tools">

                                <a href="{{route('list.category')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Category
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
                                <input type="text" class="form-control form-control-sm @error('cname') is-invalid @enderror" id="cname"
                                    name="cname" placeholder="Enter Name" value="{{$category->name}}">
                                @if ($errors->has('cname'))
                                    <div class="text-danger">{{ $errors->first('cname') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Parent Category</label>
                                <select  class="form-control form-control-sm select2 @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                    <option value="" @if($category->parent_id==null) selected @endif>No Parent Category</option>
                                    @foreach ($categories as $cate)
                                    <option value="{{$cate->id}}" @if($category->parent_id!=null && $category->parent_id==$cate->id) selected @endif>{{$cate->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('parent_id'))
                                    <div class="text-danger">{{ $errors->first('parent_id') }}</div>
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
                 <form action="{{ route('update.category.description',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category Descriptions</h3>
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
                                    name="shortDescription" placeholder="Short Description" value="{{$category->shortDescription}}">
                                @if ($errors->has('shortDescription'))
                                    <div class="text-danger">{{ $errors->first('shortDescription') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Long Description</label>
                                <textarea rows="3" class="form-control form-control-sm @error('longDescription') is-invalid @enderror" id="longDescription"
                                    name="longDescription" placeholder="Long Description" >{{$category->longDescription}}</textarea>
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
                <form action="{{ route('update.category.meta',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category Meta Details</h3>
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
                                    name="metaTitle" placeholder="Meta Title" value="{{$category->metaTitle}}">
                                @if ($errors->has('metaTitle'))
                                    <div class="text-danger">{{ $errors->first('metaTitle') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Keywords</label>
                                <input type="text" class="form-control form-control-sm @error('metaKeyword') is-invalid @enderror" id="metaKeyword"
                                    name="metaKeyword" placeholder="Meta Keywords" value="{{$category->metaKeyword}}">
                                @if ($errors->has('metaKeyword'))
                                    <div class="text-danger">{{ $errors->first('metaKeyword') }}</div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="name">Meta Description</label>
                                <input type="text" class="form-control form-control-sm @error('metaDescription') is-invalid @enderror" id="metaDescription"
                                    name="metaDescription" placeholder="Meta Description" value="{{$category->metaDescription}}">
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
            <div class="col-4">
                <!-- Default box -->
                <!-- Category Thumbnail Image Update box -->
                <form action="{{ route('update.category.thumbnail',$category->id) }}" method="post" enctype="multipart/form-data">
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
                                <img height="80px" src="{{ asset('/storage/images/category/th/'.$category->thumbnailImage) }}" class="elevation-2 mb-4 p-2">
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
                <form action="{{ route('update.category.icon',$category->id) }}" method="post" enctype="multipart/form-data">
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
                                <img height="80px" src="{{ asset('/storage/images/category/icon/th/'.$category->iconImage) }}" class="elevation-2 mb-4 p-2">
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
                <form action="{{ route('update.category.cover',$category->id) }}" method="post" enctype="multipart/form-data">
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
                                <img height="80px" src="{{ asset('/storage/images/category/cover/th/'.$category->coverImage) }}" class="elevation-2 mb-4 p-2">
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
        </div>
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
