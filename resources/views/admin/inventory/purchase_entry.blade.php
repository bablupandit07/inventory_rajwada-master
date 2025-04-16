@extends('layouts.app')
@section('title', 'Purchase Entry')
@section('content')
{{-- <style>
        label {
            font-weight: bold;
        }
    </style> --}}
<a href="{{ url('admin/purchase_details') }}" class="btn btn-success" style="margin-top: 1%;margin-left: 89%;
    ">Show
    list</a>
<fieldset class="mt-2">
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
    <form action="{{ url('admin/purchase_entry') }}" method="POST">
        @csrf
        <div class="card mb-2">
            <div class="card-header bg-submenu  ">
                Purchase Entry
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label for="">Supplier<span class="text-danger fw-bold">*</span></label>
                        <select name="par_sup_id" class="nice-select  form-control chosen-select" id="par_sup_id">
                            <option value="">--Select Supplier--</option>
                            @foreach ($supplier_data as $data)
                            <option value="{{ $data->id }}"
                                @isset($editData) {{ $data->id == $editData->par_sup_id ? 'selected' : '' }} @endisset>
                                {{ $data->name }}
                            </option>
                            @endforeach
                        </select>
                        <span class="text-danger">
                            @error('par_sup_id')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="">Purchase Date <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="purchase_date" name="purchase_date"
                            @isset($editData) value="{{ date('d-m-Y', strtotime($editData->purchase_date)) }}" @endisset
                            @empty($editData) value="{{ $purchase_date }}" @endempty
                            placeholder="dd-mm-yyy">
                        <span class="text-danger">
                            @error('purchase_date')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="">Purchase No. <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" readonly id="purchase_no" name="purchase_no"
                            value="{{ $purchase_no }}" placeholder="Purchase No.">
                        <span class="text-danger">
                            @error('purchase_no')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-3 mb-2">
                        <label for="">Purchase Type <span class="text-danger fw-bold">*</span></label>
                        <select name="purchase_type" class="nice-select  form-control chosen-select" id="purchase_type">
                            <option value="cash">Cash</option>
                            <option value="cheque">Cheque</option>
                        </select>
                        <span class="text-danger">
                            @error('purchase_type')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="">Remark <span class="text-danger fw-bold"></span></label>
                        <textarea type="text" rows="3" class="form-control" id="remark" name="remark" placeholder="Remark">
@isset($editData)
{{ $editData->remark }}
@endisset
</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-2">
            <div class="card-header bg-submenu">
                Product Details
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <label for="">Product
                        </label>
                        <div class="input-group mb-3">
                            <select name="product_id" class="nice-select  form-control chosen-select1" id="product_id"
                                onchange="getproductUnit(this.value)">
                                <option value="">--Select Product--</option>
                                @foreach ($product_data as $row)
                                <option value="{{ $row->id }}">{{ $row->product_name }}</option>
                                @endforeach

                            </select>
                            <button class="btn btn-secondary" type="button" id="button-addon2" data-toggle="modal"
                                onclick="show_model()" data-target="#exampleModal">+</button>
                        </div>
                        {{-- <label for="">Product
                            </label> <strong style="margin-bottom:20px" class="btn btn-success" data-toggle="modal"
                                onclick="show_model()" data-target="#exampleModal">+</strong> --}}


                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="">Unit Name<span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" readonly id="unit_name" name="unit_name">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="">Rate <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" onkeyup="getTotal()" id="rate"
                            name="rate" placeholder="Rate">
                    </div>
                    {{-- <div class="col-md-4 mb-2">
                        <label for="">Price <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="price" name="price" placeholder="price">
                    </div> --}}
                    <div class="col-md-2 mb-2">
                        <label for="">QTY <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" onkeyup="getTotal()" id="qty"
                            name="qty" placeholder="QTY">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label for="">Total <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="total" name="total"
                            placeholder="Total">
                    </div>
                    <div class="col-md-1 mb-5 mt-3">
                        {{-- <button class="btn btn-danger" id="butsave">Add</button> --}}
                        {{-- <input type="submit" name="submit" class="btn btn-danger"> --}}
                        <button type="button" class="btn btn-primary" id="addproduct"
                            onclick="addlist()">Add</button>
                        <input type="hidden" name="purchase_id" id="purchase_id" value="{{ $purchase_id }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-2">
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
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody id="show_recod">
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    {{-- <input type="hidden" name="net_amount" id=""> --}}
                                    <button class="btn btn-dark btn-sm" id="save"
                                        name="save">{{ $btnname }}</button>
                                    <a href="{{ url('/admin/inventory/purchase_entry') }}"
                                        class="btn btn-danger btn-sm">Reset</a>
                                </td>
                            <tr>
                        </tfoot>

                    </table>
                </div>

            </div>
        </div>

    </form>
</fieldset>
<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" onclick="show_hide()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Product Name: <span
                                style="color: red">*</span></label>
                        <input type="text" id="m_product_name" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Rate: <span
                                style="color: red">*</span></label>
                        <input type="text" id="m_rate" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Unit Name <span
                                style="color: red">*</span></label>
                        <select class="form-control chosen-select" id="m_unit_id">
                            <option>--Select--</option>
                            @foreach ($unit_data as $key)
                            <option value="{{ $key['id'] }}">{{ $key['unit_name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="show_hide()">Close</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="addproduct()">Save</button>
            </div>
        </div>
    </div>
</div>
{{-- modol close --}}

<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Product Record</h5>
                <button type="button" onclick="show_hide1()" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Product <span
                            style="color: red">*</span></label>
                    <select name="m_product_id" onchange="getproduct_unit(this.value)"
                        class="nice-select  form-control chosen-select " id="m_product_id">
                        <option value="">--Select Product--</option>
                        @foreach ($product_data as $row)
                        <option value="{{ $row->id }}">{{ $row->product_name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Unit Name <span
                            style="color: red">*</span></label>
                    <input type="text" readonly class="form-control" id="m_unit_name" name="m_unit_name"
                        placeholder="Unit Name">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Rate <span style="color: red">*</span></label>
                    <input type="text" onkeyup="getTotal_product()" class="form-control" id="m_rate"
                        name="m_rate" placeholder="Rate">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Qty <span style="color: red">*</span></label>
                    <input type="text" onkeyup="getTotal_product()" class="form-control" id="m_qty"
                        name="m_qty" placeholder="Qty">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">Total <span style="color: red">*</span></label>
                    <input type="text" readonly class="form-control" id="m_total" name="m_total"
                        placeholder="Total">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" onclick="show_hide1()">Close</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="addproduct_details()">Save</button>
                <input type="hidden" name="m_id" id="m_id">
            </div>
        </div>
    </div>
</div>

@endsection
@push('ajax_save')
<script>
    function show_model() {
        // alert('jdhasm');
        $('#myModal').modal('show');
    }

    function show_hide() {
        $('#myModal').modal('hide');
    }

    function show_hide1() {
        $('#product_modal').modal('hide');
    }

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

    function getTotal_product() {
        var m_rate = document.getElementById('m_rate').value;
        var m_qty = document.getElementById('m_qty').value;
        if (rate == "") {
            alert("Please Enter Rate");
            document.getElementById('qty').value = "";
            return false;
        }
        m_total = m_rate * m_qty;
        document.
        getElementById('m_total').value = m_total;
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
            document.getElementById("addproduct").disabled = true;
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
                    // console.log(data);
                    // document.getElementById('product_id').value = '';
                    $("#product_id").val('').trigger("chosen:updated");
                    document.getElementById('unit_name').value = '';
                    document.getElementById('rate').value = '';
                    document.getElementById('qty').value = '';
                    document.getElementById('total').value = '';
                    document.getElementById("addproduct").disabled = false;
                    show_record(purchase_id);
                }
            });
        }
    }

    function addproduct() {
        var product_name = document.getElementById('m_product_name').value;
        var m_rate = document.getElementById('m_rate').value;
        var unit_id = document.getElementById('m_unit_id').value;
        if (product_name == "") {
            alert('Please Enter Product Name');
            document.getElementById('m_product_name').focus();
            return false
        }
        if (m_rate == "") {
            alert('Please Enter Rate');
            document.getElementById('m_rate').focus();
            return false
        }
        if (unit_id == "") {
            alert('Please Select Unit Name');
            return false
        } else {
            $.ajax({
                url: '/ajax_add_product',
                type: 'POST',
                data: {
                    product_name: product_name,
                    rate: m_rate,
                    unit_id: unit_id,
                    _token: '{!! csrf_token() !!}',
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data.error) {
                        alert(data.error);
                        return false;
                    }
                    if (data) {
                        $('#product_id').append('<option value="' + data.id + '" selected="selected">' +
                            data.product_name +
                            '</option>');
                        $('#myModal').modal('hide');
                        $("#product_id").trigger("chosen:updated");
                        $("#product_id").trigger("liszt:updated");
                        $("#m_unit_id").val('').trigger("chosen:updated");
                        document.getElementById('m_product_name').value = "";
                        document.getElementById('m_unit_id').value = "";
                        document.getElementById('m_rate').value = "";
                    }

                    // alert(data);
                    getproductUnit(data.id);
                    // $('#pid' + id).remove(); ?
                }
            });

        }

    }

    function addproduct_details() {
        // alert("ajhes");
        var m_product_id = document.getElementById('m_product_id').value;
        var m_unit_name = document.getElementById('m_unit_name').value;
        var m_qty = document.getElementById('m_qty').value;
        var m_rate = document.getElementById('m_rate').value;
        var m_total = document.getElementById('m_total').value;
        var m_id = document.getElementById('m_id').value;
        var purchase_id = document.getElementById('purchase_id').value;

        if (m_product_id == "") {
            alert('Please Enter Product Name');
            return false
        }
        if (m_unit_name == "") {
            alert('Please Enter Unit Name');
            document.getElementById('m_unit_name').focus();
            return false
        }
        if (m_qty == "") {
            alert('Please Enter QTY Name');
            document.getElementById('m_qty').focus();
            return false
        }
        if (m_rate == "") {
            alert('Please Enter Rate Name');
            document.getElementById('m_rate').focus();
            return false
        } else {
            $.ajax({
                url: '/ajax_edit_product_details',
                type: 'POST',
                data: {
                    m_id: m_id,
                    m_product_id: m_product_id,
                    m_unit_name: m_unit_name,
                    m_qty: m_qty,
                    m_rate: m_rate,
                    m_total: m_total,
                    _token: '{!! csrf_token() !!}',
                },
                dataType: 'JSON',
                success: function(data) {
                    // console.log(data);
                    if (data) {
                        show_record(purchase_id);
                        $('#product_modal').modal('hide')
                    }
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


        // alert(purchase_id);
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

                console.log(response);
                // obj = JSON.parse(response);


                document.getElementById('unit_name').value = response.unit_name;
                document.getElementById('rate').value = response.rate;

                // console.log(response.unit_name);
            }
        });

    }

    function getproduct_unit(product_id) {
        // alert(product_id);
        $.ajax({
            url: '/get_unit/' + product_id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {

                // alert(response);
                document.getElementById('m_unit_name').value = response.unit_name;
                document.getElementById('m_rate').value = response.rate;
                // console.log(response.unit_name);
            }
        });

    }


    //    alert("jhsas");
</script>
<script>
    $(".chosen-select1").chosen({

    });

    // $(".chosen-select").choesn({
    //     width: '100%'
    // });
</script>

<script>
    function show_product(id, product_id, unit_name, rate, qty, total) {
        // alert(unit_name);
        document.getElementById('m_product_id').value = product_id;
        document.getElementById('m_unit_name').value = unit_name;
        document.getElementById('m_rate').value = rate;
        document.getElementById('m_qty').value = qty;
        document.getElementById('m_total').value = total;
        document.getElementById('m_id').value = id;
        $("#m_product_id").trigger("chosen:updated");
        $("#m_product_id").trigger("liszt:updated");
        $('#product_modal').modal('show');
    }
</script>
@endpush