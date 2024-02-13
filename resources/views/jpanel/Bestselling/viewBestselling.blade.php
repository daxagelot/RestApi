@extends('jpanel.layouts.app')
@section('title')
Best Selling
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Best Selling</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">View Best Selling</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <div class="row">
            @if(hasPermission('bestselling',1))
            <div class="col-12">
                <!-- Default box -->
                 <!-- Profile Update box -->
                 <form action="{{ route('store.bestSelling') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Best Selling Add Form</h3>
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
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="product">Product:</label>
                                        <select class="form-control form-control-sm select2 @error('product') is-invalid @enderror" id="product"
                                        name="product" data-placeholder="Select Product">
                                        <option value="">Select Product</option>
                                            @foreach($products as $product)
                                                <option {{old('product') == $product->id ?'selected':''}} value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('product'))
                                        <div class="text-danger">{{ $errors->first('product') }}</div>
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
            @endif
            @if(hasPermission('bestselling',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Best Selling List</h3>
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
                        <table class="table table-bordered table-hover" id="bestSellingDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($bestSelling as $key =>$Bestselling)

                                <tr class="dataRow{{$Bestselling->id}} {{$Bestselling->deleted_at != null ? 'bg-danger text-white':''}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$Bestselling->Product->name}}</td>
                                    <td>
                                        @if(hasPermission('bestselling',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$Bestselling->id}}" type="checkbox" class="custom-control-input bestSellingStatus" {{$Bestselling->deleted_at != null ? 'disabled':''}} id="status{{$Bestselling->id}}" name="status{{$Bestselling->id}}" {{ $Bestselling->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$Bestselling->id}}"></label>
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        @if($Bestselling->deleted_at == null)
                                            @if(hasPermission('bestselling',3))
                                            <a href="{{route('edit.bestSelling',$Bestselling->id)}}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                            @endif
                                            @if(hasPermission('bestselling',4))
                                            <a href="javascript:void(0)" data-id="{{$Bestselling->id}}" class="text-danger deleteBestselling" id="delete{{$Bestselling->id}}" name="delete{{$Bestselling->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                            @endif
                                        @else
                                            @if(hasPermission('bestselling',4))
                                            <a href="javascript:void(0)" data-id="{{$Bestselling->id}}" class="text-white restoreBestselling" id="restore{{$Bestselling->id}}" name="restore{{$Bestselling->id}}" data-toggle="tooltip" data-placement="top" title="Restore"><i class="fas fa-trash-restore-alt"></i></a>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
    @include('jpanel.Bestselling.ajax')
@endsection
