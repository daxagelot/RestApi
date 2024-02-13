@extends('jpanel.layouts.app')
@section('title')
    Attribute Values
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Attribute Value For {{$attribute->name}}</h1>
            </div>
            <div class="col-5 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.attributes') }}">View Attribute</a></li>
                    <li class="breadcrumb-item active">Attribute Values</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        @if(hasPermission('attribute',3))
        <div class="row">
            <div class="col-4">
                <!-- Default box -->
                 <!-- Attribute Update box -->
                 <form action="{{ route('store.value.attribute',$attribute->id) }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Attribute Value </h3>
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
                                <label for="name">Value</label>
                                <input type="text" class="form-control form-control-sm @error('attribute_value') is-invalid @enderror" id="attribute_value"
                                    name="attribute_value" placeholder="Enter Attribute Value" value="">
                                @if ($errors->has('attribute_value'))
                                    <div class="text-danger">{{ $errors->first('attribute_value') }}</div>
                                @endif
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
            <div class="col-8">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Attributes Value</h3>
                        <div class="card-tools">
                            @if(hasPermission('attribute',1))
                            <a href="{{route('list.attributes')}}" class="btn btn-sm bg-pcb">
                                <i class="fas fa-eye"></i> View All Attribute
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
                        <table class="table table-bordered table-hover" id="attributeValueDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Value</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($attributeValues as $key =>$attributeValue)

                                <tr class="dataRow{{$attributeValue->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$attributeValue->value}}</td>
                                    <td>
                                        @if(hasPermission('attribute',4))
                                        <a href="javascript:void(0)" data-id="{{$attributeValue->id}}" class="text-danger deleteAttributeValue" id="delete{{$attributeValue->id}}" name="delete{{$attributeValue->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Value</th>
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
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.catalog.ajax')
@endsection
