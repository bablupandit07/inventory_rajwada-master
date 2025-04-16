@extends('layouts.app')
@section('title', 'Designation')

@section('content')


<!-- {{print_r($departments_data)}} -->
<fieldset class="mt-3">
    <legend>Designation</legend>
    <div class="card">
        <div class="card-header">
            Designation Details
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-12">

                    @if (session('success'))
                    <div class="alert alert-success">
                        <strong> {{ session('success') }}</strong>
                    </div>
                    @endif
                    @isset($editData)
                    <form action="{{ url('admin/master/Designations/'.$editData->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md mb-2">
                                <label for="">Designation Name <span class="text-danger fw-bold">*</span></label>
                                <select name="department_id" id="department_id" class=" nice-select nice-select-search-box wide form-control form-control-sm">
                                    <option value="">Nothing</option>
                                    @foreach($departments_data as $row)

                                    <option value="{{$row->id}}" @isset($editData) {{ $row->id == $editData->department_id  ? 'selected' : ''}} @endisset>{{$row->department_name}}</option>
                                    @endforeach
                                </select>

                                @error('department_id')
                                {{$message}}
                                @enderror
                                </span>


                            </div>

                            <div class="col-md mb-2">
                                <label for="">Designation Name <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" id="designation_name" name="designation_name" value="@isset($editData)  {{$editData->designation_name}}  @endisset" placeholder="Designation Name  ">
                                <span class="text-danger">
                                    @error('designation_name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md mb-2">
                                <br />
                                <button type="submit" class="btn btn-dark">{{ $btnName }}</button>

                                <a href="{{ url('admin/master/Designations') }}" class="btn btn-danger "> Reset </a>
                            </div>
                        </div>
                    </form>
                    @endisset
                    @empty($editData)
                    <form action="{{ url('admin/master/Designations') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md mb-2">
                                <label for="">Designation Name <span class="text-danger fw-bold">*</span></label>
                                <select name="department_id" id="department_id" class=" nice-select nice-select-search-box wide form-control form-control-sm">
                                    <option value="">Nothing</option>
                                    @foreach($departments_data as $row)
                                    <option value="{{$row->id}}" @isset($editData) {{ $row->id == $editData->department_id  ? 'selected' : ''}} @endisset )>{{$row->department_name}}</option>
                                    @endforeach
                                </select>
                                <span style="color:red">
                                    @error('department_id')
                                    {{$message}}
                                    @enderror
                                </span>


                            </div>

                            <div class="col-md mb-2">
                                <label for="">Designation Name <span class="text-danger fw-bold">*</span></label>
                                <input type="text" class="form-control" id="designation_name" name="designation_name" value="@isset($editData)  {{$editData->designation_name}}  @endisset" placeholder="Designation Name  ">
                                <span class="text-danger">
                                    @error('designation_name')
                                    {{$message}}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md mb-2">
                                <br />
                                <button type="submit" class="btn btn-dark">{{ $btnName }}</button>

                                <a href="{{ url('admin/master/Designations') }}" class="btn btn-danger "> Reset </a>
                            </div>
                        </div>
                    </form>
                    @endisset

                </div>
            </div>
        </div>
    </div>
</fieldset>
<div class="row mt-4 mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Designation Record
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-sm table-hover">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Department Name</th>
                            <th>Designation Name</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach($designationData as $rowget)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ ucfirst($rowget->department_name)}}</td>
                                <td>{{ ucfirst($rowget->designation_name)}}</td>
                                <td class="text-center">
                                    <a href="{{url('admin/master/Designations/'.$rowget->id.'/edit')}}" title="Edit" class="btn btn-sm btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td class="text-center">
                                    <form action="{{url('admin/master/Designations/'.$rowget->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete?')" title="Delete" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
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
@endsection