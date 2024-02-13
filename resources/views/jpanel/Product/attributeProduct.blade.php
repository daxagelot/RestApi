@extends('jpanel.layouts.app')
@section('title')
    Attribute Value
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 flash-message">
                <div class="col-sm-3">
                    <h6>Attribute Values for - <strong>{{$product->name}}</strong></h6>
                </div>
                <div class="col-5 messageArea">
                    @include('jpanel/flash-message')
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.product') }}">View Product</a></li>
                        <li class="breadcrumb-item active">Attribute Value</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (hasPermission('product', 3))
                <div class="row">
                    <div class="col-4">
                        <!-- Default box -->
                        <!-- Attribute Update box -->
                        <form action="{{ route('store.attribute.product') }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Add Attribute Value</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="d-none" value="{{ $product->id }}" name="product_id">

                                    <div class="form-group">
                                        <label for="categorie">Attribute</label>
                                        <select class="attribute_id form-control form-control-sm select2 @error('attribute_id') is-invalid @enderror"
                                            onchange="getValues(this.value)" name="attribute_id" id="attribute_id">
                                            <option value="">Select Attribute</option>
                                            @foreach ($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('attribute_id'))
                                            <div class="text-danger">{{ $errors->first('attribute_id') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="categorie">Attribute Value</label>
                                        <select class="attribute_id form-control form-control-sm select2 @error('attribute_value_id') is-invalid @enderror "
                                            name="attribute_value_id"  id="attribute_value_id">
                                            <option value="Select Attribute Value">Select Attribute Value</option>
                                        </select>
                                        @if ($errors->has('attribute_value_id'))
                                            <div class="text-danger">{{ $errors->first('attribute_value_id') }}</div>
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
                                <h3 class="card-title">Product Attributes</h3>
                                <div class="card-tools">
                                    @if (hasPermission('product', 2))
                                        <a href="{{ route('list.product') }}" class="btn btn-sm bg-pcb">
                                            <i class="fas fa-eye"></i> View All Products
                                        </a>
                                    @endif
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
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
                                            <th>Attribute</th>
                                            <th>Attribute Value</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($product_attributes as $key => $product_attribute)
                                        <tr class="dataRow{{ $product_attribute->id }}">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $product_attribute->get_attr->name }}</td>
                                            <td>{{ $product_attribute->get_attr_value->value }}</td>
                                            <td>
                                                @if (hasPermission('product', 4))
                                                    <a href="javascript:void(0)" data-id="{{ $product_attribute->id }}"
                                                        class="text-danger deleteProductAttribute"
                                                        id="delete{{ $product_attribute->id }}"
                                                        name="delete{{ $product_attribute->id }}" data-toggle="tooltip"
                                                        data-placement="top" title="Trash"><i
                                                            class="fas fa-trash"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Attribute</th>
                                            <th>Attribute Value</th>
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
    @include('jpanel.Product.ajax')
@endsection
