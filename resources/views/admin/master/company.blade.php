@extends('layouts.app')
@section('title', 'Company Profile')
@section('content')
<fieldset class="mt-3">
    <legend>Company Profile</legend>
    <div class="card">
        <div class="card-header  bg-submenu">
            Company Details
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">

                    @if (session('success'))
                    <div class="alert alert-success">
                        <strong> {{ session('success') }}</strong>
                    </div>
                    @endif
                    @isset($companyData)
                    <form action="{{ url('admin/master/company/' . $companyData->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="name" name="name"
                                    value=" {{ $companyData->name }}" placeholder="Company Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact_no" class="col-sm-2 col-form-label">Contact No.</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="contact_no" name="contact_no"
                                    value="{{ $companyData->number }}" placeholder="Contact No.">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email_id" class="col-sm-2 col-form-label">Email ID</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $companyData->email }}" placeholder="Email ID">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-5">
                                <textarea id="address" name="address" class="form-control" placeholder="Address">{{ $companyData->address }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label "></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-dark">{{ $btnName }}</button>
                            </div>
                        </div>
                    </form>
                    @endisset
                    @empty($companyData)
                    <form action="{{ url('admin/master/company') }}" method="post">
                        @csrf
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Company Name</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}" placeholder="Company Name">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="contact_no" class="col-sm-2 col-form-label">Contact No.</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="contact_no" name="contact_no"
                                    value="{{ old('contact_no') }}" placeholder="Contact No.">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email_id" class="col-sm-2 col-form-label">Email ID</label>
                            <div class="col-sm-5">
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ old('email') }}" placeholder="Email ID">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-5">
                                <textarea id="address" name="address" class="form-control" placeholder="Address">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="address" class="col-sm-2 col-form-label "></label>
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-dark">{{ $btnName }}</button>
                            </div>
                        </div>
                    </form>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</fieldset>
@endsection