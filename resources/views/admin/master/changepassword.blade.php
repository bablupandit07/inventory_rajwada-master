@extends('layouts.app')
@section('title', 'Change Password')
@section('content')
    <fieldset class="mt-2">
        <div class="card">
            <div class="card-header bg-submenul">
                Change Password
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
            <form action="{{ url('admin/master/changepassword') }}" method="post">
                @csrf

                <div class="card-body">
                    <div class="row">
                        <div class="col-md mb-2">
                            <label for="">Old Password <span class="text-danger fw-bold">*</span></label>
                            <input type="text" autocomplete="off" onchange="checkoldpass()"
                                class="form-control @error('oldpass') is-invalid @enderror" id="oldpass" name="oldpass"
                                placeholder="Old Password">
                            <span id="msg1"></span>
                            <span class="text-danger">
                                @error('oldpass')
                                    {{ $message }}
                                @enderror

                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mb-2">
                            <label for="">New Password <span class="text-danger fw-bold">*</span></label>
                            <input type="text"autocomplete="off" onKeyUp="checkPassEqual()"
                                class="form-control @error('newpass') is-invalid @enderror" id="newpass" name="newpass"
                                placeholder="New Password">
                            <span class="text-danger">
                                @error('newpass')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mb-2">
                            <label for="">Confirm Password <span class="text-danger fw-bold">*</span></label>
                            <input type="text" autocomplete="off"
                                class="form-control @error('confirmpass') is-invalid @enderror" onKeyUp="checkPassEqual()"
                                id="confirmpass" name="confirmpass" placeholder="Confirm  Password">

                            <span id="msg2">

                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md mb-2">
                            <br />
                            <button type="submit" class="btn btn-dark">Change Password</button>
                            @isset($editData)
                                <input type="hidden" name="department_id" value=" {{ $editData->id }}">
                            @endisset
                            <a href="{{ url('admin/master/changepassword') }}" class="btn btn-danger"> Reset </a>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </fieldset>
    @push('status')
        <script>
            function checkoldpass() {
                var oldpass = document.getElementById('oldpass').value;
                $.ajax({
                    url: '/check_oldpass/' + oldpass,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var success_data = response.success;
                            document.getElementById('msg1').innerHTML = "<span style='color: green;'>**" +
                                success_data + "</span>";
                        }
                        if (response.error) {
                            var error_data = response.error;
                            document.getElementById('msg1').innerHTML = "<span style='color: red;'>**" +
                                error_data + "</span>";

                        }
                    }
                });
            }

            function checkPassEqual() {
                var newpass = document.getElementById("newpass").value;
                var confirmpass = document.getElementById("confirmpass").value;
                // alert(confirmpass);
                //alert(confirmpass);
                if (newpass != "" && confirmpass != "") {
                    if (newpass == confirmpass)
                        document.getElementById('msg2').innerHTML =
                        "<span style='color: green;'>**Password matched</span>";

                    // document.getElementById("msg2").style.color = "green";

                    else
                        document.getElementById('msg2').innerHTML = "<span style='color: red;'>**Password not matched</span>";
                }
            }
        </script>
    @endpush

@endsection
