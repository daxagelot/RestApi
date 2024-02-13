@extends('jpanel.layouts.app')
@section('title')
    Update Review
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Update Review</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.review') }}">View Review</a></li>
                    <li class="breadcrumb-item active">Update Review</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row flash-message">
            <div class="col-12">
                @include('jpanel/flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                 <!-- Profile Update box -->
                 <form action="{{ route('update.review',$review->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Review Form</h3>
                            <div class="card-tools">
                                <a href="{{route('list.review')}}" class="btn btn-sm bg-pcb">
                                    <i class="fas fa-eye"></i> View All Review
                                </a>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="profile">Profile:</label>
                                        <input type="file" class="form-control form-control-sm @error('profile') is-invalid @enderror" id="profile"
                                        name="profile">
                                        @if ($errors->has('profile'))
                                            <div class="text-danger">{{ $errors->first('profile') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                                        name="name" placeholder="Enter Name" value="{{$review->name}}">
                                        @if ($errors->has('name'))
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="designation">Designation:</label>
                                        <input type="text" class="form-control form-control-sm @error('designation') is-invalid @enderror" id="designation"
                                        name="designation" placeholder="Enter Designation" value="{{$review->designation}}">
                                        @if ($errors->has('designation'))
                                        <div class="text-danger">{{ $errors->first('designation') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rating">Rating:</label>
                                        <input type="text" class="form-control form-control-sm @error('rating') is-invalid @enderror" id="rating"
                                        name="rating" placeholder="Enter Rating" value="{{$review->rating}}">
                                        @if ($errors->has('rating'))
                                        <div class="text-danger">{{ $errors->first('rating') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="review">Review:</label>
                                        <textarea class="form-control form-control-sm @error('review') is-invalid @enderror" id="review"
                                            name="review">{{$review->review}}</textarea>
                                        @if ($errors->has('review'))
                                            <div class="text-danger">{{ $errors->first('review') }}</div>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn bg-pcb btn-block">Submit <i
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
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.Review.ajax')
@endsection
