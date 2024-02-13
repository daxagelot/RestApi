@extends('jpanel.layouts.app')
@section('title')
    Add New Product
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.product') }}">View Products</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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
                    <form action="{{ route('store.product') }}" id="productForm" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Product Add Form</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.product') }}" class="btn btn-sm bg-pcb">
                                        <i class="fas fa-eye"></i> View All Products
                                    </a>
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
                                {{-- Part 1 --}}
                                <div id="PP-1" class="content" role="tabpanel" aria-labelledby="PP-1-trigger">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Product Name</label>
                                                <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror " id="name"
                                                    name="name" placeholder="Enter Product Name" value="{{old('name')}}">
                                                <div class="text-danger name"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="price">Price</label>
                                                <input type="number" class="form-control form-control-sm @error('price') is-invalid @enderror " id="price"
                                                    name="price" placeholder="Enter price" max="10" value="{{old('price')}}">
                                                <div class="text-danger price"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="categorie">Category</label><br>
                                                <select class="form-control form-control-sm select2  @error('category') is-invalid @enderror" style="width:100%;"  name="category"
                                                    id="category" data-placeholder="Select Category">
                                                    <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            @if($category->parent_id != null)
                                                                <option {{old('category') == $category->categories_id  ? 'selected' : ''}} value="{{$category->categories_id}}">{{ $category->Category->name }}</option>
                                                            @else
                                                                <option {{old('category') == $category->id  ? 'selected' : ''}} value="{{$category->id}}">{{ $category->name }}</option>
                                                            @endif
                                                        @endforeach
                                                </select>
                                                <div class="text-danger category"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn float-right bg-pcb mb-2" onclick="validate1();" type="button">Next <i class="fas fa-angle-double-right"></i></button>
                                </div>
                                {{-- Part 2 --}}
                                <div id="PP-2" class="content d-none" role="tabpanel" aria-labelledby="PP-2-trigger">
                                    {{-- specification --}}
                                    <div class="specification mb-3">
                                        <label for="specification">Specifications:</label>
                                        <div class="col-md-12 ansList">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="title">Title</label>
                                                        <input type="text" class="form-control form-control-sm" id="title" name="title[]" placeholder="Enter Title">
                                                        <div class="text-danger title"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="value">Value</label>
                                                        <input type="text" class="form-control form-control-sm" id="value" name="value[]" placeholder="Enter Value">
                                                        <div class="text-danger value"></div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mt-4">
                                                    <div class="form-group">
                                                        <label for=""></label>
                                                        <button type="button" class="removeBox text-danger btn btn-sm bg-pcb" id="Rmemo" onclick="removeBox(this);"><i class="fas fa-trash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm bg-pcb col-md-2 rounded ml-2" onclick="addMore();"><i class="fas fa-plus"></i> Add More</button>
                                    </div>
                                    <button class="btn bg-pcb mb-2" type="button" onclick="previous('PP-1','PP-2')"><i class="fas fa-angle-double-left"></i> Previous</button>
                                    <button class="btn float-right bg-pcb mb-2" type="button" onclick="next('PP-3','PP-2');">Next <i class="fas fa-angle-double-right"></i></button>
                                </div>
                                {{-- Part 3 --}}
                                <div id="PP-3" class="content d-none" role="tabpanel" aria-labelledby="PP-3-trigger">
                                    <div class="row">
                                        {{-- Multiple Image --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="image">Select Images</label>
                                                <input type="file" class="form-control form-control-sm @error('image') is-invalid @enderror" onchange="tobase64(this)" id="image"
                                                    name="image[]" multiple accept="image/*">
                                                    <div class="text-danger image"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6 imagePreview d-none">
                                        </div>
                                    </div>
                                    <button class="btn bg-pcb mb-2" type="button" onclick="previous('PP-2','PP-3')"><i class="fas fa-angle-double-left"></i> Previous</button>
                                    <button class="btn float-right bg-pcb mb-2" type="button" onclick="next('PP-4','PP-3')">Next <i class="fas fa-angle-double-right"></i></button>
                                </div>
                                {{-- Part 4 --}}
                                <div id="PP-4" class="content d-none" role="tabpanel" aria-labelledby="PP-4-trigger">
                                    <div class="form-group">
                                        <label for="">Short Description:</label>
                                        <textarea name="short_desc" class="summernote">{{old('short_desc')}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Long Description:</label>
                                        <textarea name="long_desc" class="summernote" placeholder="Write Long Description...">{{old('long_desc')}}</textarea>
                                    </div>
                                    <button class="btn bg-pcb mb-2" type="button" onclick="previous('PP-3','PP-4')"><i class="fas fa-angle-double-left"></i> Previous</button>
                                    <button class="btn float-right bg-pcb mb-2" type="button" onclick="next('PP-5','PP-4')">Next <i class="fas fa-angle-double-right"></i></button>
                                </div>
                                {{-- Part 5 --}}
                                <div id="PP-5" class="content d-none" role="tabpanel" aria-labelledby="PP-5-trigger">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mTitle">Meta Title</label>
                                                <input type="text" class="form-control form-control-sm @error('mTitle') is-invalid @enderror " id="mTitle"
                                                    name="mTitle" placeholder="Enter Meta Title" value="{{old('mTitle')}}">
                                                <div class="text-danger mTitle"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mKeyword">Meta Keyword</label>
                                                <input type="text" class="form-control form-control-sm @error('mKeyword') is-invalid @enderror " id="mKeyword"
                                                    name="mKeyword" placeholder="Enter Meta Keyword" value="{{old('mKeyword')}}">
                                                <div class="text-danger mKeyword"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mDesc">Meta Description</label>
                                                <textarea class="form-control form-control-sm @error('mDesc') is-invalid @enderror " id="mDesc"
                                                    name="mDesc" placeholder="Enter Meta Description">{{old('mDesc')}}</textarea>
                                                <div class="text-danger mDesc"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn bg-pcb mb-2" type="button" onclick="previous('PP-4','PP-5')"><i class="fas fa-angle-double-left"></i> Previous</button>
                                    <button class="btn float-right bg-pcb mb-2 submit" type="button" onclick="validate6()">Submit <i class="fas fa-angle-double-right"></i></button>
                                </div>
                            </div>
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
    @include('jpanel.Product.ajax')
@endsection