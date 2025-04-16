@extends('layouts.app')
@section('title', 'User Master')
@section('content')


    {{-- <style>
        label {
            font-weight: bold;
        }
    </style> --}}
    <fieldset class="mt-2">
        <div class="card">
            <div class="card-header bg-submenu">
                User Master
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
            <form action="{{ url('admin/master/user_master') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label for="">User Name <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="@isset($editData) {{ $editData->username }} @endisset"
                                placeholder="User Name">
                            <span class="text-danger">
                                @error('username')
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
                            <label for="">Password <span class="text-danger fw-bold">*</span></label>
                            <input type="password"
                                value="@isset($editData) {{ $editData->password }} @endisset"
                                class="form-control" name="password" id="password" placeholder="Password">
                            <span class="text-danger">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">User Type <span class="text-danger fw-bold">*</span></label>

                            <select name="user_type"
                                class="nice-select nice-select-search-box wide form-control form-control-sm" id="user_type">
                                <option value="user">User</option>
                                <script>
                                    document.getElementById('user_type').value =
                                        @isset($editData)
                                            {{ $editData->user_type }}
                                        @endisset
                                </script>
                            </select>
                            <span class="text-danger">
                                @error('user_type')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Full Name <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name"
                                value="@isset($editData) {{ $editData->full_name }} @endisset"
                                placeholder="Full Name">
                            <span class="text-danger">
                                @error('full_name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label for="">Contact No. <span class="text-danger fw-bold">*</span></label>
                            <input type="text" class="form-control" id="contact" name="contact"
                                value="@isset($editData) {{ $editData->contact }} @endisset"
                                placeholder="Contact No.">
                            <span class="text-danger">
                                @error('contact')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>


                        <div class="col-md-4 mb-2">
                            <label for="">Status <span class="text-danger fw-bold">*</span></label>

                            <select name="status" class="form-control chosen-select1" id="status">
                                <option value="0">Enable</option>
                                <option value="1">Disable</option>

                            </select>
                            <script>
                                document.getElementById('status').value =
                                    @isset($editData)
                                        {{ $editData->status }}
                                    @endisset
                            </script>
                            <span class="text-danger">
                                @error('status')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="col-md-4     mb-2">
                            <label for="">Address <span class="text-danger fw-bold">*</span></label>
                            <textarea type="text" class="form-control" id="address" name="address" placeholder="Address">
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
                            <br />
                            <button type="submit" class="btn btn-dark btn-sm">{{ $btnname }}</button>
                            @isset($editData)
                                <input type="hidden" name="department_id" value="">
                            @endisset
                            <a href="{{ url('admin/master/user_master') }}" class="btn btn-danger btn-sm"> Reset </a>

                            <input type="hidden" name="user_id"
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
                    User Record
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-sm table-hover">
                            <thead>
                                <th>Sr. No.</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Full Name</th>
                                <th>Contact</th>
                                <th>Password</th>
                                <th class="text-center">Edit</th>
                                <th class="text-center">Delete</th>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($allData as $data)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ucfirst($data->username) }}</td>
                                        <td>{{ ucfirst($data->email) }}</td>
                                        <td>{{ ucfirst($data->full_name) }}</td>
                                        <td>{{ ucfirst($data->contact) }}</td>
                                        <td><input type="password" readonly value="233"><i class="bi bi-eye-slash"
                                                id="togglePassword"></i></td>
                                        <td class="text-center">
                                            <a href="{{ url('admin/master/user_master/edit/' . $data->id) }}"
                                                class="btn btn-sm btn-outline-success"><i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a onclick="return confirm('Are you sure you want to delete?')"
                                                href="{{ url('admin/master/user_master/delete/' . $data->id) }}"
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
@endsection
@push('user')
    <script>
        $(".chosen-select1").chosen({

        });
    </script>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Toggle Password Visibility</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href="css/style.css" />
    </head>

    <body>
        <div class="container">
            <h1>Sign In</h1>
            <form method="post">
                <p>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" />
                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                </p>
                <button type="submit" id="submit" class="submit">Log In</button>
            </form>
        </div>

    </body>

    </html>
@endpush
