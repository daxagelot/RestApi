@extends('jpanel.layouts.app')
@section('title')
    Company Settings
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Company Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Company Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('jpanel/flash-message')
                </div>
            </div>
            
            {{-- <div class="row"> --}}
                <div class="col-12">
                     <!-- Profile Update box -->
                    <form action="{{ route('company.update') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Company Details</h3>
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
                                    @if($company != null)
                                        <input type="text" name="company_id" value="{{$company->id}}" class="d-none">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                                                    name="company_name" placeholder="Enter Company Name" value="{{$company->company_name}}">
                                                @if ($errors->has('company_name'))
                                                    <div class="text-danger">{{ $errors->first('company_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="company_type">Types</label>
                                                <select class="form-control @error('company_type') is-invalid @enderror" id="company_type"
                                                    name="company_type" >
                                                    <option value="">Select Type</option>
                                                    <option {{$company->company_type == 'Private Ltd' ? 'selected':''}} value="Private Ltd">Private Ltd</option>
                                                    <option {{$company->company_type == 'Public Ltd' ? 'selected':''}} value="Public Ltd">Public Ltd</option>
                                                    <option {{$company->company_type == 'Sole Proprietorship' ? 'selected':''}} value="Sole Proprietorship">Sole Proprietorship</option>
                                                    <option {{$company->company_type == 'Partnership' ? 'selected':''}} value="Partnership">Partnership</option>
                                                </select>
                                                @if ($errors->has('company_type'))
                                                    <div class="text-danger">{{ $errors->first('company_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="gst_no">Gst No</label>
                                                <input type="text" class="form-control @error('gst_no') is-invalid @enderror" id="gst_no"
                                                    name="gst_no" placeholder="Enter GST No" maxlength="15" value="{{$company->gst_no}}">
                                                @if ($errors->has('gst_no'))
                                                    <div class="text-danger">{{ $errors->first('gst_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="reg_date">Registration Date</label>
                                                <input type="date" class="form-control @error('reg_date') is-invalid @enderror" id="reg_date"
                                                    name="reg_date" value="{{$company->reg_date}}">
                                                @if ($errors->has('reg_date'))
                                                    <div class="text-danger">{{ $errors->first('reg_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contact_no">Contact No</label>
                                                <input type="number" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no"
                                                    name="contact_no" maxlength="10" placeholder="Enter Contact No" value="{{$company->phone_no}}">
                                                @if ($errors->has('contact_no'))
                                                    <div class="text-danger">{{ $errors->first('contact_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="alternate_no">Alternate No</label>
                                                <input type="number" class="form-control @error('alternate_no') is-invalid @enderror" id="alternate_no"
                                                    name="alternate_no" maxlength="10" placeholder="Enter Alternate No" value="{{$company->alternate_phone_no}}">
                                                @if ($errors->has('alternate_no'))
                                                    <div class="text-danger">{{ $errors->first('alternate_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" placeholder="Enter Email" value="{{$company->email}}">
                                                @if ($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select class="form-control select2 @error('country') is-invalid @enderror" id="country"
                                                    name="country" data-placeholder="Select Country" onchange="getState(this.value);">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option {{$company->country == $country->id ? 'selected':''}} value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country'))
                                                    <div class="text-danger">{{ $errors->first('country') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control select2 @error('state') is-invalid @enderror" id="state"
                                                    name="state" data-placeholder="Select State" onchange="getCity(this.value);">
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option {{$company->state == $state->id ? 'selected':''}} value="{{$state->id}}">{{$state->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state'))
                                                    <div class="text-danger">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select class="form-control select2 @error('city') is-invalid @enderror" id="city"
                                                    name="city" data-placeholder="Select City">
                                                    <option value="">Select City</option>
                                                    @foreach($cities as $city)
                                                        <option {{$company->city == $city->id ? 'selected':''}} value="{{$city->id}}">{{$city->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('city'))
                                                    <div class="text-danger">{{ $errors->first('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="zipcode">ZipCode</label>
                                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode"
                                                    name="zipcode" placeholder="Enter Zipcode" maxlength="6" value="{{$company->zipcode}}">
                                                @if ($errors->has('zipcode'))
                                                    <div class="text-danger">{{ $errors->first('zipcode') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                                    name="address">{{$company->address}}</textarea>
                                                @if ($errors->has('address'))
                                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name"
                                                    name="company_name" placeholder="Enter Company Name" value="{{old('company_name')}}">
                                                @if ($errors->has('company_name'))
                                                    <div class="text-danger">{{ $errors->first('company_name') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="company_type">Types</label>
                                                <select class="form-control @error('company_type') is-invalid @enderror" id="company_type"
                                                    name="company_type" >
                                                    <option value="">Select Type</option>
                                                    <option value="Private Ltd">Private Ltd</option>
                                                    <option value="Public Ltd">Public Ltd</option>
                                                    <option value="Sole Proprietorship">Sole Proprietorship</option>
                                                    <option value="Partnership">Partnership</option>
                                                </select>
                                                @if ($errors->has('company_type'))
                                                    <div class="text-danger">{{ $errors->first('company_type') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="gst_no">Gst No</label>
                                                <input type="text" class="form-control @error('gst_no') is-invalid @enderror" id="gst_no"
                                                    name="gst_no" placeholder="Enter GST No" maxlength="15" value="{{old('gst_no')}}">
                                                @if ($errors->has('gst_no'))
                                                    <div class="text-danger">{{ $errors->first('gst_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label for="reg_date">Registration Date</label>
                                                <input type="date" class="form-control @error('reg_date') is-invalid @enderror" id="reg_date"
                                                    name="reg_date" value="{{old('reg_date')}}">
                                                @if ($errors->has('reg_date'))
                                                    <div class="text-danger">{{ $errors->first('reg_date') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="contact_no">Contact No</label>
                                                <input type="number" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no"
                                                    name="contact_no" placeholder="Enter Contact No" value="{{old('contact_no')}}">
                                                @if ($errors->has('contact_no'))
                                                    <div class="text-danger">{{ $errors->first('contact_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="alternate_no">Alternate No</label>
                                                <input type="number" class="form-control @error('alternate_no') is-invalid @enderror" id="alternate_no"
                                                    name="alternate_no" placeholder="Enter Alternate No" value="{{old('alternate_no')}}">
                                                @if ($errors->has('alternate_no'))
                                                    <div class="text-danger">{{ $errors->first('alternate_no') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                                    name="email" placeholder="Enter Email" value="{{old('email')}}">
                                                @if ($errors->has('email'))
                                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="country">Country</label>
                                                <select class="form-control select2 @error('country') is-invalid @enderror" id="country"
                                                    name="country" data-placeholder="Select Country" onchange="getState(this.value);">
                                                    <option value="">Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->id}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('country'))
                                                    <div class="text-danger">{{ $errors->first('country') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="state">State</label>
                                                <select class="form-control select2 @error('state') is-invalid @enderror" id="state"
                                                    name="state" data-placeholder="Select State" onchange="getCity(this.value);">
                                                    <option value="">Select State</option>
                                                </select>
                                                @if ($errors->has('state'))
                                                    <div class="text-danger">{{ $errors->first('state') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city">City</label>
                                                <select class="form-control select2 @error('city') is-invalid @enderror" id="city"
                                                    name="city" data-placeholder="Select City">
                                                    <option value="">Select City</option>
                                                </select>
                                                @if ($errors->has('city'))
                                                    <div class="text-danger">{{ $errors->first('city') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="zipcode">ZipCode</label>
                                                <input type="text" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode"
                                                    name="zipcode" placeholder="Enter Zipcode" value="{{old('zipcode')}}">
                                                @if ($errors->has('zipcode'))
                                                    <div class="text-danger">{{ $errors->first('zipcode') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address"
                                                    name="address">{{old('address')}}</textarea>
                                                @if ($errors->has('address'))
                                                    <div class="text-danger">{{ $errors->first('address') }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-block bg-pcb">Submit <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                            <!-- /.card-footer-->

                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-12">
                    <!-- Profile Image Update box -->
                     <form action="{{ route('company.image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Company Logo</h3>
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
                                    @if($company!=null)
                                        <img height="80px" src="{{ asset('/storage/images/companyProfile/th/'.$company->company_logo) }}" class="img-circle elevation-2 mb-4 p-2">
                                    @else
                                        <img height="80px" src="{{ asset('/storage/images/companyProfile/th/') }}" class="img-circle elevation-2 mb-4 p-2">
                                    @endif
                                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" >
                                    @if ($errors->has('avatar'))
                                        <div class="text-danger">{{ $errors->first('avatar') }}</div>
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
            {{-- </div> --}}
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
@include('jpanel.ajax')
@endsection
