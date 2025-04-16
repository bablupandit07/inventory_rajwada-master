@extends('layouts.app')
@section('title', 'Supplier Master')
@section('content')



    {{-- <style>
        label {
            font-weight: bold;
        }
    </style> --}}
    <fieldset class="mt-2">
        <legend>Supplier Master</legend>
        <div class="card">
            <div class="card-header bg-submenu">
                Supplier Master
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
            {{-- @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}
            <form action="{{ url('admin/master/supplier_master') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">Supplier Name <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="@isset($editData) {{ $editData->name }} @endisset"
                                placeholder="Supplier Name">
                            <span class="text-danger">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Email Id <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="@isset($editData) {{ $editData->email }} @endisset"
                                placeholder="Email Id">
                            <span class="text-danger">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label for="">Mobile <span class="text-danger fw-bold">*</span></label>
                            <input type="text"
                                value="@isset($editData) {{ $editData->mobile }} @endisset"
                                class="form-control" name="mobile" id="mobile" placeholder="Mobile">
                            <span class="text-danger">
                                @error('mobile')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="col-md-4     mb-2">
                            <label for="">Address <span class="text-danger fw-bold">*</span></label>
                            <textarea type="text" class="form-control" rows="3" id="address" name="address" placeholder="Address">
@isset($editData)
{{ $editData->address }}
@endisset
</textarea>
                            <span class="text-danger">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Type <span class="text-danger fw-bold"></span></label><br>
                            Breakfast <input type="checkbox"
                                @isset($editData) @if ($editData->breckfast == 'breckfast') {{ 'checked' }} @endif @endisset
                                value="breckfast" name="breckfast" style="margin-left: 25px;"><br>
                            Lunch <input type="checkbox" value="lunch"
                                @isset($editData) @if ($editData->lunch == 'lunch') {{ 'checked' }} @endif @endisset
                                name="lunch" style="margin-left: 46px"><br>
                            Dinner <input type="checkbox"
                                @isset($editData) @if ($editData->dinner == 'dinner') {{ 'checked' }} @endif @endisset
                                value="dinner" name="dinner" style="margin-left: 40px"><br>
                            Hightea <input type="checkbox"
                                @isset($editData) @if ($editData->hightea == 'hightea') {{ 'checked' }} @endif @endisset
                                value="hightea" name="hightea" style="margin-left: 30px">
                        </div>

                        <div class="col-md-4 mb-2">
                            <br />
                            <button type="submit" class="btn btn-dark btn-sm">{{ $btnname }}</button>

                            <a href="{{ url('admin/master/supplier_master') }}" class="btn btn-danger btn-sm"> Reset </a>

                            <input type="hidden" name="party_id"
                                value="@isset($editData) {{ $editData->id }} @endisset">

                        </div>
                    </div>
                </div>
        </div>
        </form>
        </div>
    </fieldset>
    <div class="row mt-4 mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-submenu">
                    Supplier Master Record
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-sm table-hover">
                            <thead>
                                <th>Sr. No.</th>
                                <th>Supplier Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Adress</th>
                                <th>Type</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($allData as $data)
                                    <tr id="pid{{ $data->id }}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucfirst($data->name) }}</td>
                                        <td>{{ ucfirst($data->email) }}</td>
                                        <td>{{ ucfirst($data->mobile) }}</td>
                                        <td>{{ ucfirst($data->address) }}</td>
                                        <td>{{ ucfirst($data->breckfast) }}
                                            <br>{{ ucfirst($data->lunch) }}<br>{{ ucfirst($data->dinner) }}
                                            <br>{{ ucfirst($data->hightea) }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/master/supplier_master/edit/' . $data->id) }}"
                                                class="btn btn-sm btn-outline-success"><i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:void(0)" onclick="funDel({{ $data->id }})"
                                                class="btn btn-sm btn-outline-danger"><i class="bi bi-trash3-fill"></i>
                                            </a>

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
                        url: '/delete_supplier/' + id,
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

            // $('#product_name').attr('placeholder',
            //     'This is a new placeholder');
        </script>
    @endpush
@endsection
