@extends('jpanel.layouts.app')
@section('title')
    Team
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Team</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Team</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            {{-- @if(hasPermission('gallery',2)) --}}
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Team List</h3>
                        <div class="card-tools">
                            {{-- @if(hasPermission('gallery',1)) --}}
                            <a href="{{route('team.create')}}" class="btn btn-sm bg-pcb">
                                <i class="fas fa-plus-square"></i> Add New Team
                            </a>
                            {{-- @endif --}}
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="teamDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($teams as $key =>$gallery)

                                <tr class="dataRow{{$gallery->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$gallery->name}}</td>
                                    <td>{{$gallery->title}}</td>
                                    <td>{{$gallery->description}}</td>

                                    <td>
                                        @if($gallery->image)
                                            <img src="{{ asset('storage/team_images/' . basename($gallery->image)) }}" alt="Gallery Image" width="80px" height="80px">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>
                                        {{-- @if(hasPermission('gallery',2)) --}}
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$gallery->id}}" type="checkbox" class="custom-control-input galleryStatus" id="status{{$gallery->id}}" name="status{{$gallery->id}}" {{ $gallery->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$gallery->id}}"></label>
                                        </div>
                                        {{-- @endif --}}
                                    </td>
                                    <td>
                                        {{-- @if(hasPermission('gallery',3)) --}}
                                        <a href="{{route('team.edit',$gallery->id)}}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        {{-- @endif
                                        @if(hasPermission('gallery',4)) --}}
                                        <a href="javascript:void(0)" data-id="{{$gallery->id}}" class="text-danger deleteGallery" id="delete{{$gallery->id}}" name="delete{{$gallery->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @endforeach
                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">

                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
            </div>
            {{-- @endif --}}
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    {{-- @include('jpanel.catalog.ajax') --}}
@endsection
