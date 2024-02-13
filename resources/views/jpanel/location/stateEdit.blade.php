@extends('jpanel.layouts.app')
@section('title')
    Update State
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
                        <li class="breadcrumb-item active">Update State</li>
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
                <div class="col-md-12">
                    <form action="{{ route('update.state',$state->id) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Update State</h3>
                                <div class="card-tools">
                                    @if(hasPermission('state',2))
                                        <a href="{{route('list.state')}}" class="btn btn-sm bg-pcb">
                                            <i class="fas fa-eye"></i> View State List
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
                                <div class="form-group">
                                    <label for="country">Country Name</label>
                                    <select class="form-control select2 form-control-sm @error('country') is-invalid @enderror" id="country" name="country">
                                        @foreach ($country as $Country)
                                        <option value="Select Country">Select Country</option>
                                        @if ($Country->id == $state->country) 
                                        <option value="{{$Country->id}}" selected>{{$Country->name}}</option>  
                                        @else  
                                        <option value="{{$Country->id}}" >{{$Country->name}}</option>  
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('country'))
                                        <div class="text-danger">{{ $errors->first('country') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">State Name</label>
                                    <input type="text" class="form-control form-control-sm @error('sname') is-invalid @enderror" id="sname"
                                        name="sname" value="{{$state->name}}" placeholder="Enter State Name">
                                    @if ($errors->has('sname'))
                                        <div class="text-danger">{{ $errors->first('sname') }}</div>
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

