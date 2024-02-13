@extends('jpanel.layouts.app')
@section('title')
    Contact
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Contact</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Contact</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            @if(hasPermission('contact',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Contact List</h3>
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
                        <table class="table table-bordered table-hover" id="contactDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contact as $key =>$Contact)

                                <tr class="dataRow{{$Contact->id}} {{$Contact->deleted_at != null ? 'bg-danger text-white':''}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$Contact->name}}</td>
                                    <td>{{$Contact->phone}}</td>
                                    <td>{{$Contact->email}}</td>
                                    <td>{{$Contact->message}}</td>
                                    <td>
                                        @if($Contact->deleted_at == null)
                                            @if(hasPermission('contact',4))
                                            <a href="javascript:void(0)" data-id="{{$Contact->id}}" class="text-danger deleteContact" id="delete{{$Contact->id}}" name="delete{{$Contact->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                            @endif
                                        @else
                                            @if(hasPermission('contact',4))
                                            <a href="javascript:void(0)" data-id="{{$Contact->id}}" class="text-white restoreContact" id="restore{{$Contact->id}}" name="restore{{$Contact->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Message</th>
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
    @include('jpanel.Contact.ajax')
@endsection
