@extends('jpanel.layouts.app')
@section('title')
    State
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>State</h1>
                </div>
                <div class="col-md-6 messageArea">
                    @include('jpanel/flash-message')
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add State</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @if (hasPermission('state', 1))
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <form action="{{ route('store.state') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New State</h3>
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
                                    <label for="country">Country Name</label>
                                    <select class="form-control select2 form-control-sm @error('country') is-invalid @enderror" id="country"
                                        name="country">
                                        <option value="Select Country">Select Country</option>
                                        @foreach ($country as $Country)
                                            <option value="{{$Country->id}}">{{$Country->name}}</option>    
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <div class="text-danger">{{ $errors->first('country') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">State Name</label>
                                    <input type="text" class="form-control form-control-sm @error('sname') is-invalid @enderror" id="sname"
                                        name="sname" placeholder="Enter State Name">
                                    @if ($errors->has('sname'))
                                        <div class="text-danger">{{ $errors->first('sname') }}</div>
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
                            <h3 class="card-title">State List</h3>
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
                            <table class="table table-bordered table-hover" id="stateDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($states as $key =>$state)
                                    
                                    <tr class="dataRow{{$state->id}} {{ $state->deleted_at != null ? 'bg-danger text-white' : ''}}">
                                        <td>{{++$key}}</td>
                                        <td>{{$state->countryName}}</td>
                                        <td>{{$state->stateName}}</td>
                                        <td>
                                            @if($state->deleted_at == null)
                                                @if(hasPermission('state',3))
                                                <a href="{{ route('edit.state',$state->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                                @endif
                                                @if(hasPermission('state',4))
                                                <a href="javascript:void(0)" data-id="{{$state->id}}" class="text-danger deleteState" id="delete{{$state->id}}" name="delete{{$state->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                                @endif
                                            @else
                                                @if(hasPermission('state',4))
                                                    <a href="javascript:void(0)" data-id="{{$state->id}}" class="text-white restoreState" id="restore{{$state->id}}" name="restore{{$state->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>State</th>
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

