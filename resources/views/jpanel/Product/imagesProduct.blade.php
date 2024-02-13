@extends('jpanel.layouts.app')
@section('title')
    Upload Images
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Upload images</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.product') }}">Product list</a></li>
                        <li class="breadcrumb-item active">Upload</li>
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
                    @if(hasPermission('product',1))
                    <form action="{{ route('upload.image.product') }}" method="post" enctype="multipart/form-data" >
                        @csrf
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Upload Image</h3>
                                <div class="card-tools">
                                    <input type="text" class="d-none" name="productId" id="productId" value="{{$id}}">
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    {{-- <img height="80px" src="{{ asset('/storage/images/userProfile/th/'.Auth::getUser()->avatar) }}" class="img-circle elevation-2 mb-4 p-2"> --}}
                                    <input type="file" name="productImage" class="form-control @error('productImage') is-invalid @enderror" >
                                    @if ($errors->has('productImage'))
                                        <div class="text-danger">{{ $errors->first('productImage') }}</div>
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
                    </form>
                    @endif
                    @if(hasPermission('product',2))
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th>Image</th>     
                                    <th>Image Order</th>     
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($images as $key =>$image)

                                <tr class="dataRow{{$image->id}}">
                                    <td>{{++$key}}</td>
                                    <td> <a href="{{ asset('/storage/images/product/'.$image->image) }}" target="_blank"> <img src={{ asset('/storage/images/product/'.$image->image) }} alt="image" width="80px"></td></a>
                                    <td><input type="number" data-id="{{$image->id}}" class="imageOrder border-0" onkeydown="return false" value="{{$image->imageorder}}" min="1" max="10"></td>
                                    <td>
                                        @if(hasPermission('product',4))
                                        <a class="rounded" href="{{ route('product.image.delete',$image->id) }}"><i class="fas fa-trash text-danger"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('jpanel.Product.ajax')
@endsection  


