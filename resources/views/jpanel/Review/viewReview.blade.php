@extends('jpanel.layouts.app')
@section('title')
Review
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Review</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Review</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            @if(hasPermission('review',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Review List</h3>
                        <div class="card-tools">
                            @if(hasPermission('review',1))
                            <a href="{{route('create.review')}}" class="btn btn-sm bg-pcb">
                                <i class="fas fa-plus-square"></i> Add New Review
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
                        <table class="table table-bordered table-hover" id="reviewDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Review</th>
                                    <th>Reting</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($review as $key =>$Review)

                                <tr class="dataRow{{$Review->id}} {{$Review->deleted_at != null ? 'bg-danger text-white':''}}">
                                    <td>{{++$key}}</td>
                                    <td><a href="{{ asset('/storage/images/review/th/'.$Review->profile) }}" target="_blank"><img src="{{ asset('/storage/images/review/th/'.$Review->profile) }}" width="60px"></a></td>
                                    <td>{{$Review->name}}</td>
                                    <td>{{$Review->designation}}</td>
                                    <td>{{$Review->review}}</td>
                                    <td>{{$Review->rating}} Star</td>
                                    <td>
                                        @if(hasPermission('review',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$Review->id}}" type="checkbox" class="custom-control-input reviewStatus" {{$Review->deleted_at != null ? 'disabled':''}} id="status{{$Review->id}}" name="status{{$Review->id}}" {{ $Review->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$Review->id}}"></label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($Review->deleted_at == null)
                                            @if(hasPermission('review',3))
                                            <a href="{{route('edit.review',$Review->id)}}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                            @endif
                                            @if(hasPermission('review',4))
                                            <a href="javascript:void(0)" data-id="{{$Review->id}}" class="text-danger deleteReview" id="delete{{$Review->id}}" name="delete{{$Review->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                            @endif
                                        @else
                                            @if(hasPermission('review',4))
                                            <a href="javascript:void(0)" data-id="{{$Review->id}}" class="text-white restoreReview" id="restore{{$Review->id}}" name="restore{{$Review->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Review</th>
                                    <th>Reting</th>
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
    @include('jpanel.Review.ajax')
@endsection
