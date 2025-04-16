@extends('layouts.app')
@section('title', 'Purchase Record')
@section('content')
<a href="{{ url('admin/inventory/purchase_entry') }}" class="btn btn-success" style="margin-top: 1%"> + Add New</a>
<fieldset class="mt-2">

    <div class="card">
        <div class="card-header">
            Purchase entry Details
        </div>
        <div class="card-body">
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
            <form action="{{ url('admin/purchase_details') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md mb-2">
                        <label for="">From Date <span class="text-danger fw-bold">*</span></label>
                        <input type="text" value="{{ $from_date }}" class="form-control form-control-sm"
                            name="from_date" id="from_date">
                        <span class="text-danger">
                            @error('from_date')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md mb-2">
                        <label for="">To Date <span class="text-danger fw-bold">*</span></label>
                        <input type="text" value="{{ $to_date }}" class="form-control form-control-sm"
                            name="to_date" id="to_date">
                        <span class="text-danger">
                            @error('to_date')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="col-md mb-2">
                        <br />
                        <input type="submit" name="submit" class="btn btn-theme " value="{{ $btnName }}">
                        @isset($editData)
                        <input type="hidden" name="session_id" value=" {{ $editData->id }}">
                        @endisset
                        <a href="{{ url('admin/purchase_details') }}" class="btn btn-danger "> Reset </a>
                    </div>


                </div>
            </form>
        </div>
    </div>
</fieldset>
<div class="row mt-4 mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Purchase Record
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-sm table-hover">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Purchase No. </th>
                            <th>Suplier Name</th>
                            <th>Purchase Date</th>
                            <th>Amount</th>
                            <th>Print Pdf</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($purchase_entrys as $row_get)
                            <tr id="pid{{ $row_get->id }}">
                                <td>{{ $i++ }}</td>
                                <td>{{ $row_get->purchase_no }}</td>
                                <td>{{ $row_get->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($row_get->purchase_date)) }}
                                </td>
                                <td>{{ number_format($row_get->net_amount, 2) }}</td>
                                <td><a target="_blank" href="{{ url('pdf_purchase_entry/' . $row_get->id) }}"
                                        class="btn btn-danger ">Pdf</a></td>
                                <td class="text-center">
                                    <a href="{{ url('admin/purchase_entry/edit/' . $row_get->id) }}" title="Edit"
                                        class="btn btn-sm btn-outline-success"><i
                                            class="bi bi-pencil-square"></i></a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger"
                                        onclick="funDel({{ $row_get->id }})"><i
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
                url: '/delete_purchase_entry/' + id,
                type: 'DELETE',
                data: {
                    _token: $("input[name=_token]").val()
                },
                success: function(response) {
                    // console.log(response);
                    $('#pid' + id).remove();

                    // show_record(purchase_id);
                }
            });
        }
    }
</script>
@endpush


@endsection