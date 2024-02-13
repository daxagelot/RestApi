@extends('jpanel.layouts.app')
@section('title')
    Update Country
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
                        <li class="breadcrumb-item active">Update Country</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    @if (hasPermission('country', 3))
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('update.country',$country->id) }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"> Update Country</h3>
                                <div class="card-tools">
                                    @if(hasPermission('country',2))
                                        <a href="{{route('list.country')}}" class="btn btn-sm bg-pcb">
                                            <i class="fas fa-eye"></i> View Country List
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
                                    <label for="cname">Country Name</label>
                                    <input type="text" class="form-control form-control-sm @error('cname') is-invalid @enderror" id="cname"
                                        name="cname" value="{{$country->name}}" placeholder="Enter Country Name">
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

