@extends('layouts.app')
@section('title', 'Product Master')

@section('content')
{{-- {{ $editData }} --}}

{{-- {{ $productData }} --}}

<fieldset class="mt-3">
    <legend>Product Master</legend>
    <div class="card">
        <div class="card-header bg-submenu">
            Product Master Details
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">

                    @if (session('success'))
                    <div class="alert alert-success" id="mydiv">
                        <strong> {{ session('success') }}</strong>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger" id="mydiv">
                        <strong> {{ session('error') }}</strong>
                    </div>
                    @endif

                    <form action="{{ url('admin/master/product_master') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md mb-2">
                                <label for="">Product Name <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" placeholder="Product Name" id="product_name"
                                    name="product_name"
                                    @isset($editData) value="{{ $editData->product_name }}" @endisset
                                    @empty($editData) value="{{ old('product_name') }}" @endempty>
                                <span style="color:red">
                                    @error('product_name')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md mb-2">
                                <label for="">Rate <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" placeholder="Rate" id="rate"
                                    name="rate"
                                    @isset($editData) value="{{ $editData->rate }}" @endisset
                                    @empty($editData) value="{{ old('rate') }}" @endempty>
                                <span style="color:red">
                                    @error('rate')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md mb-2">
                                <label for="">Unit Name <span class="text-danger fw-bold">*</span></label>
                                <select name="unit_id" id="unit_id"
                                    class="form-control form-control-sm chosen-select">
                                    <option value="">Nothing</option>
                                    @foreach ($unit_data as $row)
                                    <option value="{{ $row->id }}"
                                        @isset($editData) {{ $row->id == $editData->unit_id ? 'selected' : '' }} @endisset>
                                        {{ $row->unit_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <span style="color:red">
                                    @error('unit_id')
                                    {{ $message }}
                                    @enderror
                                </span>


                            </div>
                            <div class="col-md mb-2">
                                <br />
                                <button type="submit" class="btn btn-dark btn-sm">{{ $btnName }}</button>

                                <input type="hidden" name="product_id"
                                    value="@isset($editData) {{ $editData->id }} @endisset">

                                <a href="{{ url('admin/master/product_master') }}" class="btn btn-danger btn-sm"> Reset
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="row mt-4 mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-submenu">
                Product Master Record
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-sm table-hover">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Product Name</th>
                            <th>Rate</th>
                            <th>Unit Name</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($productData as $rowget)
                            <tr id="pid{{ $rowget->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ ucfirst($rowget->product_name) }}</td>
                                <td>{{ ucfirst($rowget->rate) }}</td>
                                <td>{{ ucfirst($rowget->unit_name) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/master/product_master/edit/' . $rowget->id) }}"
                                        title="Edit" class="btn btn-sm btn-outline-success"><i
                                            class="bi bi-pencil-square"></i></a>
                                </td>
                                <td class="text-center">

                                    <button type="button" onclick="funDel({{ $rowget->id }})" title="Delete"
                                        class="btn btn-sm btn-outline-danger"><i
                                            class="bi bi-trash3-fill"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@push('status')
<script>
    function funDel(id) {
        // alert(id);
        if (confirm('Are you sure you want to Delete?')) {
            $.ajax({
                url: '/delete_record/' + id,
                type: 'DELETE',
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(response) {
                    // console.log(response);
                    $('#pid' + id).remove();

                }
            });
        }
    }
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds



    $(".chosen-select").chosen({});
    $(".example").Datatable({});


    // $('#product_name').attr('placeholder',
    //     'This is a new placeholder');
</script>
@endpush
@endsection