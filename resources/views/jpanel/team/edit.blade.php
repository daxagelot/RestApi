@extends('jpanel.layouts.app')
@section('title')
    Add New Team
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Team</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('team.index') }}">View Team</a></li>
                    <li class="breadcrumb-item active">Add Team</li> 
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
                 <form action="{{ route('team.update',$team->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Team</h3>
                            <div class="card-tools">
                                <a href="{{route('team.index')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Team
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
                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                                    name="name" placeholder="Enter Name" value="{{$team->name}}">
                                @if ($errors->has('name'))
                                    <div class="text-danger">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name"> Image</label>
                                <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" id="name"
                                    name="image" placeholder="Enter Name">
                                    
                                @if ($errors->has('image'))
                                    <div class="text-danger">{{ $errors->first('image') }}</div>
                                @endif
                            </div>
                            
                            <div class="form-group">
                                <label for="title"> Title</label>
                                <input type="text" class="form-control form-control-sm @error('title') is-invalid @enderror" id="title"
                                    name="title" placeholder="Enter Title" value="{{$team->title}}">
                                @if ($errors->has('title'))
                                    <div class="text-danger">{{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="description"> Description</label>
                                <input type="text" class="form-control form-control-sm @error('description') is-invalid @enderror" id="description"
                                    name="description" placeholder="Enter Description" value="{{$team->description}}">
                                @if ($errors->has('description'))
                                    <div class="text-danger">{{ $errors->first('description') }}</div>
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
    {{-- @include('jpanel.catalog.ajax') --}}
@endsection
