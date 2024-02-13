@extends('jpanel.layouts.app')
@section('title')
    Categories
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Categories</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Categories</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            @if(hasPermission('category',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Categories List</h3>
                        <div class="card-tools">
                            @if(hasPermission('category',1))
                            <a href="{{route('create.category')}}" class="btn btn-sm bg-pcb">
                                <i class="fas fa-plus-square"></i> Add New Category
                            </a>
                            @endif
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="categoryDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Menu Status</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $key =>$category)

                                <tr class="dataRow{{$category->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->parent_id ? $category->parent->name : '-' }}</td>
                                    <td>
                                        @if(hasPermission('category',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$category->id}}" type="checkbox" class="custom-control-input categoryMenuStatus" id="menuStatus{{$category->id}}" name="status{{$category->id}}" {{ $category->is_menu ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="menuStatus{{$category->id}}"></label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(hasPermission('category',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$category->id}}" type="checkbox" class="custom-control-input categoryStatus" id="status{{$category->id}}" name="status{{$category->id}}" {{ $category->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$category->id}}"></label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if(hasPermission('category',3))
                                        <a href="{{route('edit.category',$category->id)}}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('category',4))
                                        <a href="javascript:void(0)" data-id="{{$category->id}}" class="text-danger deleteCategory" id="delete{{$category->id}}" name="delete{{$category->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Parent Category</th>
                                    <th>Menu Status</th>
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
            @endif
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
