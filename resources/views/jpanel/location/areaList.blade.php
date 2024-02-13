@extends('jpanel.layouts.app')
@section('title')
    Area
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Area</h1>
                </div>
                <div class="col-md-6 messageArea">
                    @include('jpanel/flash-message')
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Area</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @if (hasPermission('area', 1))
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <form action="{{ route('store.area') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Area</h3>
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
                                    <label for="name">City Name</label>
                                    <select class="form-control select2 form-control-sm @error('city') is-invalid @enderror" id="city"
                                        name="city">
                                        <option value="Select City">Select City</option>
                                        @foreach ($cities as $city)
                                        <option value="{{$city->id}}">{{$city->name}}</option>    
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <div class="text-danger">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Area Name</label>
                                    <input type="text" class="form-control form-control-sm @error('aname') is-invalid @enderror" id="aname"
                                        name="aname" placeholder="Enter Area Name">
                                    @if ($errors->has('aname'))
                                        <div class="text-danger">{{ $errors->first('aname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block bg-side">Submit <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                            <!-- /.card-footer-->
    
                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-8">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Area List</h3>
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
                            <table class="table table-bordered table-hover" id="areaDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Area</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($areas as $key =>$area)
                                    
                                    <tr class="dataRow{{$area->id}} {{ $area->deleted_at != null ? 'bg-danger text-white' : ''}}">
                                        <td>{{++$key}}</td>
                                        <td>{{$area->City->name}}</td>
                                        <td>{{$area->name}}</td>
                                        <td>
                                            @if($area->deleted_at == null)
                                                @if(hasPermission('area',3))
                                                <a href="{{ route('edit.area',$area->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                                @endif
                                                @if(hasPermission('area',4))
                                                <a href="javascript:void(0)" data-id="{{$area->id}}" class="text-danger deleteArea" id="delete{{$area->id}}" name="delete{{$area->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                                @endif
                                            @else
                                                @if(hasPermission('area',4))
                                                    <a href="javascript:void(0)" data-id="{{$area->id}}" class="text-white restoreArea" id="restore{{$area->id}}" name="restore{{$area->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>City</th>
                                        <th>Area</th>
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
            </div>
        </div>
    </section>
    @endif
    <!-- /.content -->
@endsection
@section('scripts')
@include('jpanel.location.ajax')

@endsection

