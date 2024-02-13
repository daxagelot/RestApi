@extends('jpanel.layouts.app')
@section('title')
    City
@endsection

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-3">
                    <h1>City</h1>
                </div>
                <div class="col-md-6 messageArea">
                    @include('jpanel/flash-message')
                </div>
                <div class="col-md-3">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add City</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @if (hasPermission('city', 1))
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <form action="{{ route('store.city') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New City</h3>
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
                                    <label for="name">State Name</label>
                                    <select class="form-control select2 form-control-sm @error('state') is-invalid @enderror" id="state"
                                        name="state">
                                        <option value="Select State">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{$state->id}}">{{$state->name}}</option>    
                                        @endforeach
                                    </select>
                                    @if ($errors->has('cname'))
                                        <div class="text-danger">{{ $errors->first('cname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">City Name</label>
                                    <input type="text" class="form-control form-control-sm @error('cname') is-invalid @enderror" id="cname"
                                        name="cname" placeholder="Enter City Name">
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
                <div class="col-8">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">City List</h3>
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
                            <table class="table table-bordered table-hover" id="cityDatatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>State</th>
                                        <th>City</th>
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

