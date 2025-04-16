@extends('layouts.app')
@section('title', 'Purchase Entry')
@section('content')



    <style>
        label {
            font-weight: bold;
        }
    </style>
    <a href="{{ url('admin/purchase_details') }}" class="btn btn-success"
        style="margin-top: 1%;    margin-left: 89%;
    ">Show
        list</a>
    <fieldset class="mt-2">
        <div class="card">
            <div class="card-header bg-submenu  ">
                Purchase Entry
            </div>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <strong> {{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('update') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ url('admin/purchase_entry') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">Supplier<span class="text-danger fw-bold">*</span></label>
                            <select name="par_sup_id"
                                class="nice-select nice-select-search-box wide form-control form-control-sm"
                                id="par_sup_id">
                                <option value="">--Select Supplier--</option>
                                @foreach ($supplier_data as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                @endforeach

                            </select>
                            <span class="text-danger">
                                @error('par_sup_id')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Purchase Date <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="purchase_date" name="purchase_date"
                                value="@isset($editData) {{ $editData->purchase_date }} @endisset"
                                placeholder="dd-mm-yyy">
                            <span class="text-danger">
                                @error('purchase_date')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Purchase No. <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="purchase_no" name="purchase_no"
                                value="@isset($editData) {{ $editData->purchase_no }} @endisset"
                                placeholder="Purchase No.">
                            <span class="text-danger">
                                @error('purchase_no')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Purchase Type <span class="text-danger fw-bold">*</span></label>
                            <select name="purchase_type"
                                class="nice-select nice-select-search-box wide form-control form-control-sm"
                                id="purchase_type">
                                <option value="cash">Cash</option>
                                <option value="cheque">Cheque</option>
                            </select>
                            <span class="text-danger">
                                @error('purchase_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-8 mb-2">
                            <label for="">Remark <span class="text-danger fw-bold">*</span></label>
                            <textarea type="text" class="form-control" id="remark" name="remark" placeholder="Remark">
@isset($editData)
{{ $editData->remark }}
@endisset
</textarea>
                        </div>
                    </div>
                </div>
        </div>

        </div>
    </fieldset>

    <fieldset class="mt-2">
        <div class="card">
            <div class="card-header bg-submenu">
                Product Details
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label for="">Product<span class="text-danger fw-bold">*</span></label>
                        <select name="product_id"
                            class="nice-select nice-select-search-box wide form-control form-control-sm" id="product_id"
                            onchange="getproductUnit(this.value)">
                            <option value="">--Select Product--</option>
                            @foreach ($product_data as $row)
                                <option value="{{ $row->id }}">{{ $row->product_name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="">Unit Name<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="unit_name" name="unit_name">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="">Rate <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="rate" name="rate" placeholder="Rate">
                    </div>
                    {{-- <div class="col-md-4 mb-2">
                        <label for="">Price <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="price">
                    </div> --}}
                    <div class="col-md-4 mb-2">
                        <label for="">QTY <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" onkeyup="getTotal()" id="qty" name="qty"
                            placeholder="QTY">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label for="">Total <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="total" name="total" placeholder="Total">
                    </div>
                    <div class="col-md-4 mb-5 mt-3">
                        {{-- <button class="btn btn-danger" id="butsave">Add</button> --}}
                        {{-- <input type="submit" name="submit" class="btn btn-danger"> --}}
                        <button type="button" class="btn btn-primary" onclick="addlist()">Add</button>
                        <input type="hidden" name="purchase_id" id="purchase_id" value="{{ $purchase_id }}">
                    </div>

                </div>
            </div>

        </div>
    </fieldset>

    <div class="row mt-4 mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-submenu">
                    Product Record
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-sm table-hover">
                            <thead>
                                <th>Sr. No.</th>
                                <th>Product</th>
                                <th>Unit</th>
                                <th>Rate </th>
                                <th>QTY </th>
                                <th style="text-align: right;">Total </th>
                                <th class="text-center">Delete</th>
                            </thead>
                            <tbody id="show_recod">

                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@push('ajax_save')
    <script>
        function getTotal() {
            var rate = document.getElementById('rate').value;
            var qty = document.getElementById('qty').value;
            if (rate == "") {
                alert("Please Enter Rate");
                document.getElementById('qty').value = "";
                return false;

            }
            total = rate * qty;
            document.
            getElementById('total').value = total;
        }


        function addlist() {
            // alert("ajhes");
            var product_id = document.getElementById('product_id').value;
            var rate = document.getElementById('rate').value;
            var qty = document.getElementById('qty').value;
            var total = document.getElementById('total').value;
            var unit_name = document.getElementById('unit_name').value;
            var purchase_id = document.getElementById('purchase_id').value;
            if (product_id == "") {
                alert('Please Select Product');
                return false

            }

            if (rate == "") {
                alert('Please Please Enter rate');
                return false

            }
            if (qty == "") {
                alert('Please Please Enter QTY');
                return false

            } else {

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });
                $.ajax({
                    url: '/ajax_save_product',
                    type: 'POST',
                    data: {
                        product_id: product_id,
                        rate: rate,
                        qty: qty,
                        total: total,
                        unit_name: unit_name,
                        purchase_id: purchase_id,
                        _token: '{!! csrf_token() !!}',
                    },
                    dataType: 'JSON',
                    success: function(data) {

                        console.log(data);
                        document.getElementById('product_id').value = '';
                        document.getElementById('rate').value = '';
                        document.getElementById('qty').value = '';
                        document.getElementById('total').value = '';
                        show_record(purchase_id);
                        // alert(data);

                        // $('#pid' + id).remove(); ?
                    }
                });

            }

        }

        var purchase_id = document.getElementById('purchase_id').value;
        $(document).ready(function() {
            show_record(purchase_id);
        });

        function show_record(purchase_id) {
            // console.log("before request");
            var i = 1;
            $.ajax({
                url: '/show_product/' + purchase_id,
                type: 'GET',

                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // $('#tbody').html(response);
                    document.getElementById('show_recod').innerHTML = response.html;

                    if (response.data != "") {
                        $('#save').prop("disabled", false);
                    } else {
                        $('#save').prop("disabled", true);
                    }
                }
            });
            // console.log("after request");
        }

        function fundel(id) {
            // alert(id);
            if (confirm('Are you sure you want to Delete?')) {
                $.ajax({
                    url: '/delete_purchase_details/' + id,
                    type: 'DELETE',
                    data: {
                        _token: $("input[name=_token]").val()
                    },
                    success: function(response) {
                        // console.log(response);
                        // alert(response);
                        $('#pid' + id).remove();

                        show_record(purchase_id);
                    }
                });
            }
        }

        function getproductUnit(product_id) {
            // alert(product_id);
            $.ajax({
                url: '/get_unit/' + product_id,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    document.getElementById('unit_name').value = response.unit_name;
                    // console.log(response.unit_name);

                }
            });

        }
    </script>
@endpush
