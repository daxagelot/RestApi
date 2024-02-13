@extends('jpanel.layouts.app')
@section('title')
    Country
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>Country</h1>
                </div>
                <div class="col-md-6 messageArea">
                    @include('jpanel/flash-message')
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Country</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (hasPermission('country', 1))
                <div class="col-4">
                    <form action="{{ route('store.country') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Country</h3>
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
                                    <label for="cname">Country Name</label>
                                    <input type="text" class="form-control form-control-sm @error('cname') is-invalid @enderror" id="cname"
                                        name="cname" placeholder="Enter Country Name">
                                    @if ($errors->has('cname'))
                                        <div class="text-danger">{{ $errors->first('cname') }}</div>
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
                @endif
                @if (hasPermission('country', 2))
                <div class="col-8">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Country List</h3>
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
                            <table class="table table-bordered table-hover" id="countryDataTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Country</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($country as $key =>$Country)
                                    
                                    <tr class="dataRow{{$Country->id}} {{ $Country->deleted_at != null ? 'bg-danger text-white' : ''}}">
                                        <td>{{++$key}}</td>
                                        <td>{{$Country->name}}</td>
                                        <td>
                                            @if($Country->deleted_at == null)
                                                @if(hasPermission('country',3))
                                                <a href="{{ route('edit.country',$Country->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                                @endif
                                                @if(hasPermission('country',4))
                                                <a href="javascript:void(0)" data-id="{{$Country->id}}" class="text-danger deleteCountry" id="delete{{$Country->id}}" name="delete{{$Country->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                                @endif
                                            @else
                                                @if(hasPermission('country',4))
                                                    <a href="javascript:void(0)" data-id="{{$Country->id}}" class="text-white restoreCountry" id="restore{{$Country->id}}" name="restore{{$Country->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
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
@include('jpanel.location.ajax')
@endsection

