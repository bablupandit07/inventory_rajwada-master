@extends('layouts.app')
@section('title', 'Company Profile')
@section('content')



<fieldset class="mt-2">
    <div class="card">
        <div class="card-header">
            Department
        </div>
        <form action="{{ url('Departments/'.$editData->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row">
                    <div class="col-md mb-2">
                        <label for="">Department Name <span class="text-danger fw-bold">*</span></label>
                        <input type="text" class="form-control" id="department_name" name="department_name" value="{{$editData->department_name}}" placeholder="Department Name">
                        <span class="text-danger">
                            @error('department_name')
                            {{$message}}
                            @enderror
                        </span>
                    </div>
                    <div class="col-md mb-2">
                        <br />
                        <button type="submit" class="btn btn-dark">{{ $btnName }}</button>

                        <a href="{{ url('Departments') }}" class="btn btn-danger btn-sm"> Reset </a>
                    </div>
                </div>

            </div>
        </form>



    </div>
</fieldset>
<div class="row mt-4 mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                Department Record
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-bordered table-sm table-hover">
                        <thead>
                            <th>Sr. No.</th>
                            <th>Department Name</th>
                            <th class="text-center">Edit</th>
                            <th class="text-center">Delete</th>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @foreach($departmentData as $data)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{ ucfirst($data->department_name)}}</td>
                                <td class="text-center">
                                    <a href="{{url('Departments/'.$data->id.'/edit')}}" title="Edit" class="btn btn-sm btn-outline-success"><i class="bi bi-pencil-square"></i></a>
                                </td>
                                <td>
                                    <form action="{{url('Departments/'.$data->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Delete" class="btn btn-sm btn-danger"><i class="bi bi-trash3-fill"></i></button>
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