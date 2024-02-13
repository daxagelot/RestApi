@extends('jpanel.layouts.app')
@section('title')
Update City
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
                        <li class="breadcrumb-item active">Update City</li>
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
                <div class="col-md-12">
                    <form action="{{ route('update.city',$city->id) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Update City</h3>
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
                                    <select class="form-control select2 form-control-sm @error('state') is-invalid @enderror" id="state" name="state">
                                        <option value="Select State">Select State</option>
                                        @foreach ($states as $state)
                                        @if ($state->id == $city->state) 
                                        <option value="{{$state->id}}" selected>{{$state->name}}</option>  
                                        @else  
                                        <option value="{{$state->id}}" >{{$state->name}}</option>  
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('state'))
                                        <div class="text-danger">{{ $errors->first('state') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">City Name</label>
                                    <input type="text" class="form-control form-control-sm @error('cname') is-invalid @enderror" id="cname"
                                        name="cname" value="{{$city->name}}" placeholder="Enter City Name">
                                    @if ($errors->has('cname'))
                                        <div class="text-danger">{{ $errors->first('cname') }}</div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block bg-side">Update <i
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
    @endif
    <!-- /.content -->
@endsection
@section('scripts')
@endsection

