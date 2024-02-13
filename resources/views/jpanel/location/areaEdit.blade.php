@extends('jpanel.layouts.app')
@section('title')
    Update Area
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
                        <li class="breadcrumb-item active">Update Area</li>
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
                <div class="col-md-12">
                    <form action="{{ route('update.area',$area->id) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Update Area</h3>
                                <div class="card-tools">
                                    @if(hasPermission('area',2))
                                        <a href="{{route('list.area')}}" class="btn btn-sm bg-pcb">
                                            <i class="fas fa-eye"></i> View Area List
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
                                    <label for="name">City Name</label>
                                    <select class="form-control select2 form-control-sm @error('city') is-invalid @enderror" id="city"
                                        name="city">
                                        <option value="Select City">Select City</option>
                                        @foreach ($cities as $city)
                                        @if ($city->id == $area->city)
                                        <option selected value="{{$city->id}}">{{$city->name}}</option>    
                                        @else
                                        <option  value="{{$city->id}}">{{$city->name}}</option>    
                                        @endif
                                        @endforeach
                                    </select>
                                    @if ($errors->has('city'))
                                        <div class="text-danger">{{ $errors->first('city') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Area Name</label>
                                    <input type="text" class="form-control form-control-sm @error('aname') is-invalid @enderror" id="aname"
                                        name="aname" value="{{$area->name}}" placeholder="Enter Area Name">
                                    @if ($errors->has('aname'))
                                        <div class="text-danger">{{ $errors->first('aname') }}</div>
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

