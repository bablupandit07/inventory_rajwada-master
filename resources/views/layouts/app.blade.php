<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="This is admin UI">
    <meta name="author" content="Bablu Pandit">
    <title>TrinitySolutions - @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('font/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('choosen-select/chosen.min.css') }}">
    <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap5.min.css') }}">
    @stack('chart')
</head>

<body class="bg-light">
    <!-- Sidebar -->
    @section('sidebar')
    <div class="offcanvas show shadow-sm text-white offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false"
        tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel"
        style="width: 220px;background: #06163a;">
        <div class="offcanvas-header shadow-sm">
            <h5 class="offcanvas-title" id="staticBackdropLabel">TrinitySolutions</h5>
            <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <hr class="mt-0" />
        <div class="offcanvas-body p-0">
            <ul class="nav flex-column mt-3">
                <li class="nav-item shadow-sm">
                    <a class="nav-link {{ request()->is('admin/index') ? 'active' : '' }}"
                        href="{{ url('admin/index') }}">
                        <i class="bi bi-speedometer2"></i> &nbsp; Dashboard
                        <span class="float-end"><i class="bi bi-chevron-right"></i></span>
                    </a>
                </li>
                <li class="nav-item shadow-sm">
                    <a class="nav-link {{ request()->is('admin/master/*') ? 'active' : '' }}" href="#"
                        data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                        <i class="bi bi-pencil-square"></i> &nbsp; Master
                        <span class="float-end down"><i class="bi bi-chevron-right"></i></span>
                    </a>
                    <div class="collapse {{ request()->is('admin/master/*') ? 'show' : '' }}" id="home-collapse">
                        <ul class="btn-toggle-nav list-group list-unstyled fw-normal pb-1 small">
                            <li>
                                <a href="{{ url('admin/master/company') }}"
                                    class="list-group-item bg-submenu list-group-item-action">
                                    <i class="bi bi-chevron-right"></i> &nbsp; Company Profile
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('Sessions.index') }}"
                                    class="list-group-item bg-submenu list-group-item-action">
                                    <i class="bi bi-chevron-right"></i> &nbsp; Session Master
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/master/unitmaster') }}"
                                    class="list-group-item bg-submenu list-group-item-action">
                                    <i class="bi bi-chevron-right"></i> &nbsp; Unit Master
                                </a>
                            </li>
                            {{-- <li>
                                    <a href="{{ route('Designations.index') }}"
                            class="list-group-item bg-submenu list-group-item-action">
                            <i class="bi bi-chevron-right"></i> &nbsp; Designation
                            </a>
                </li> --}}
                <li>
                    <a href="{{ url('admin/master/product_master') }}"
                        class="list-group-item bg-submenu list-group-item-action">
                        <i class="bi bi-chevron-right"></i> &nbsp; Product Master </a>
                </li>
                <li>
                    <a href="{{ url('admin/master/party_master') }}"
                        class="list-group-item bg-submenu list-group-item-action">
                        <i class="bi bi-chevron-right"></i> &nbsp; Party Master </a>
                </li>
                <li>
                    <a href="{{ url('admin/master/supplier_master') }}"
                        class="list-group-item bg-submenu list-group-item-action">
                        <i class="bi bi-chevron-right"></i> &nbsp; Supplier Master </a>
                </li>
                <li>
                    <a href="{{ url('admin/master/user_master') }}"
                        class="list-group-item bg-submenu list-group-item-action">
                        <i class="bi bi-chevron-right"></i> &nbsp; User Master
                    </a>
                </li>
            </ul>
        </div>
        </li>
        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->is('admin/master/*') ? 'active' : '' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#home-collapse1" aria-expanded="true">
                <i class="bi bi-pencil-square"></i> &nbsp; inventory
                <span class="float-end down"><i class="bi bi-chevron-right"></i></span>
            </a>
            <div class="collapse {{ request()->is('admin/inventory/*') ? 'show' : '' }}" id="home-collapse1">
                <ul class="btn-toggle-nav list-group list-unstyled fw-normal pb-1 small">

                    <li class="nav-item shadow-sm">
                        <a class="nav-link {{ request()->is('admin/purchase_entry') ? 'active' : '' }}"
                            href="{{ route('purchase_entry') }}">
                            <i class="bi bi-bag-fill"></i> &nbsp; Purchase entry
                            <span class="float-end"></span>
                        </a>
                    </li>
                    <li class="nav-item shadow-sm">
                        <a class="nav-link {{ request()->is('admin/sale_entry') ? 'active' : '' }}"
                            href="{{ route('sale_entry') }}">
                            <i class="bi bi-bag-fill"></i> &nbsp; Sale entry
                            <span class="float-end"></span>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        <li class="nav-item shadow-sm">
            <a class="nav-link {{ request()->is('admin/master/changepassword') ? 'active' : '' }}"
                href="{{ url('admin/master/changepassword') }}">
                <i class="bi bi-key"></i> &nbsp; Changepassword
                <span class="float-end"></span>
            </a>
        </li>
        </ul>
    </div>
    </div>
    <!-- modal -->
    <div class="modal fade" id="feedback" tabindex="-1" aria-labelledby="exampleModalLabel"
        data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary bg-gradient">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Send us your feedback!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Do you have a suggestion or found some bug? <br /> Let us know in the field below.</p>
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Feedback:</label>
                            <textarea class="form-control" cols="20" rows="5" id="message-text"
                                placeholder="Describe your experience here..."></textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @show
    <!-- Sidebar Close-->
    <!-- Main -->
    <div class="main w-auto">
        <!-- Header -->
        @section('header')
        <nav class="navbar bg-white shadow-sm border-bottom">
            <div class="container-fluid ">
                <a class="navbar-brand" href="javascript:void(0);" data-bs-toggle="offcanvas"
                    data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
                    <i class="bi bi-list"></i>
                </a>

                <h4> {{$module}} </h4>
                <div class="d-flex">
                    <a href="#" class="position-relative me-4">
                        <i class="bi bi-bell-fill text-dark"></i>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge border border-light rounded-circle bg-danger">9</span>
                    </a>
                    <div class="dropdown">
                        <a href="#" class="text-decoration-none dropdown-toggle" id="dropdownUser1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle text-dark"></i>
                        </a>
                        <ul class="dropdown-menu end-0 text-small shadow" aria-labelledby="dropdownUser1"
                            style="left: auto;">
                            <li><a class="dropdown-item"
                                    href="{{ url('admin/master/changepassword') }}">Changepassword</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item" name="logout">LogOut</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        @show
        <!-- Header Close -->
        <!-- Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')
                </div>
            </div>
        </div>
        <!-- Content close-->
    </div>
    <!-- Main Close-->

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('choosen-select/chosen.jquery.min.js') }}"></script>
    <!-- javascript -->
    <script>
        var x = window.matchMedia("(max-width: 600px)");
        myFunction(x);
        x.addListener(myFunction)

        function myFunction(x) {
            if (x.matches) { // If media query matches
                //alert('sdf');
                $(".main").css("margin-left", "0");
                $(".offcanvas").removeClass("show");
            } else {
                $(".main").css("margin-left", "220px");
                $(".offcanvas").addClass("show");

                const myOffcanvas = document.getElementById('staticBackdrop')
                myOffcanvas.addEventListener('hide.bs.offcanvas', event => {
                    // do something...
                    $(".main").css("margin-left", "0px");
                })
                myOffcanvas.addEventListener('show.bs.offcanvas', event => {
                    // do something...
                    $(".main").css("margin-left", "220px");
                })
            }
        }
        $(".nav .nav-item").find("a.active>span.down>i").removeClass("bi bi-chevron-right");
        $(".nav .nav-item").find("a.active>span.down>i").addClass("bi bi-chevron-down");
    </script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

        });
    </script>
    @stack('status')
    @stack('ajax_save')
</body>

</html>