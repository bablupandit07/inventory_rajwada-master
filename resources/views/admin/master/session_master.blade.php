@extends('layouts.app')
@section('title', 'Session Master')
@section('content')

    <meta name="csrf-token" content="{{ csrf_token() }}">


    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .toggle {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .lswitch {
            cursor: pointer;
            text-indent: -9999px;
            width: 50px;
            height: 25px;
            background: grey;
            display: block;
            border-radius: 100px;
            position: relative;
            margin-top: -20px;

        }

        .lswitch:after {
            content: '';
            position: absolute;
            top: 4px;
            left: 5px;
            width: 20px;
            height: 18px;
            background: #fff;
            border-radius: 90px;
            transition: 0.3s;
        }

        .toggle:checked+label {
            background: #bada55;
        }

        .toggle:checked+label:after {
            left: calc(100% - 3px);
            transform: translateX(-100%);
        }

        .lswitch:active:after {
            width: 30px;
        }
    </style>


    <fieldset class="mt-2">

        <div class="card">
            <div class="card-header bg-submenu">
                Session Master
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
                <form action="{{ url('admin/master/Sessions') }}" method="post">
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
                            <label for="">Session <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control form-control-sm" name="session_name"
                                value="@isset($editData) {{ $editData->session_name }} @endisset"
                                id="session_name">
                            <span class="text-danger">
                                @error('session_name')
                                    {{ $message }}
                                @enderror
                            </span>

                        </div>
                        <div class="col-md mb-2">
                            <br />
                            <input type="submit" name="submit" class="btn btn-theme btn-sm" value="{{ $btnName }}">
                            @isset($editData)
                                <input type="hidden" name="session_id" value=" {{ $editData->id }}">
                            @endisset
                            <a href="{{ url('admin/master/Sessions') }}" class="btn btn-danger btn-sm"> Reset </a>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </fieldset>
    <div class="row mt-4 mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-submenu">
                    Session Record
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-sm table-hover">
                            <thead>
                                <th>Sr. No.</th>
                                <th>From Date</th>
                                <th>To Date</th>
                                <th>Session Name</th>
                                <th>Status</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($session_data as $row_get)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row_get->from_date)) }}</td>
                                        <td>{{ date('d-m-Y', strtotime($row_get->to_date)) }}</td>
                                        <td>{{ $row_get->session_name }}</td>
                                        <td class="text-center">
                                            <input class="toggle" type="checkbox"
                                                onclick="status({{ $row_get->id }},{{ $row_get->status }})"
                                                id="switch<?php echo $i; ?>"
                                                @if ($row_get->status == 1) {{ 'checked' }} @endif /><label
                                                class="lswitch" for="switch<?php echo $i; ?>">Toggle</label>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/master/Sessions/' . $row_get->id . '/edit') }}"
                                                title="Edit" class="btn btn-sm btn-outline-success"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ url('admin/master/Sessions/' . $row_get->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete?')"
                                                    title="Delete" class="btn btn-sm btn-danger"><i
                                                        class="bi bi-trash3-fill"></i></button>
                                            </form>

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
            function status(id, status) {

                // $.ajaxSetup({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     }
                // });

                if (confirm('Are you sure you want to Change Status?')) {
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: "/session_master",
                        data: {
                            'status': status,
                            'id': id
                        },
                        success: function(data) {
                            // console.log(data);
                            location = "{{ url('admin/master/Sessions') }}";
                        }
                    });
                } else location = "{{ url('admin/master/Sessions') }}";
            }
        </script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();

            });
        </script>
    @endpush


@endsection
