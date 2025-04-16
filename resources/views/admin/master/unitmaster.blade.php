@extends('layouts.app')
@section('title', 'Unit Master')
@section('content')

<fieldset class="mt-2">
    <div class="card">
        <div class="card-header bg-submenu">
            Unit Master
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
        <form action="{{ url('admin/master/unitmaster') }}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md mb-2">
                        <label for="">Unit Name <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="unit_name" name="unit_name"
                            @isset($editData) value=" {{ $editData->unit_name }}" @endisset
                            @empty($editData) value="{{ old('unit_name') }}" @endempty
                            placeholder="Unit Name">
                        <span class="text-danger">
                            @error('unit_name')
                            {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md mb-2">
                        <br />
                        <button type="submit" name="submit" class="btn btn-dark btn-sm">{{ $btnName }}</button>
                        @isset($editData)
                        <input type="hidden" name="unit_id" value=" {{ $editData->id }}">
                        @endisset
                        <a href="{{ url('admin/master/unitmaster') }}" class="btn btn-danger btn-sm"> Reset </a>

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
                Unit Record
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-sm table-hover">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Unit Name</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach ($unitData as $data)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ ucfirst($data->unit_name) }}</td>
                                <td class="text-center">
                                    <a href="{{ url('admin/master/unitmaster/edit/' . $data->id) }}" title="Edit"
                                        class="btn btn-sm btn-outline-success"><i
                                            class="bi bi-pencil-square"></i></a>
                                </td>
                                <td class="text-center">

                                    <a href="{{ url('admin/master/unitmaster/delete/' . $data->id) }}"
                                        onclick="return confirm('Are you sure you want to delete?')"
                                        class="btn btn-danger"> <i class="bi bi-trash3-fill"></i> </a>
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

@endsection