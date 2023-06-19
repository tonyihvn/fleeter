<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ $pagetitle ?? 'TrERP' }}</title>
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->

    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <style>
        .card,
        .card-body,
        table {
            width: 100% !important;
            -- overflow: auto !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/realtyplus_logo.png') }}" alt="RealtyPlus"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ '/home' }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="https://trerp.com/" target="_blank" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span
                            class="badge badge-danger navbar-badge">{{ $mytasks->where('category', 'Message')->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{ asset('dist/img/realtyplus_logo.png') }}" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    @foreach ($mytasks->where('category', 'Message') as $msg)
                                        <h3 class="dropdown-item-title">
                                            Client
                                            <span class="float-right text-sm text-danger"><i
                                                    class="fas fa-star"></i></span>
                                        </h3>
                                        <a class="text-sm" href="{{ url('tasks') }}">{{ $msg->subject }}</a>
                                        <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                            {{ $msg->created_at }}</p>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="{{ url('tasks') }}" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span
                            class="badge badge-warning navbar-badge">{{ $mytasks->where('category', 'Notification')->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span
                            class="dropdown-item dropdown-header">{{ $mytasks->where('category', 'Notification')->count() }}
                            Notification(s)</span>
                        <div class="dropdown-divider"></div>
                        @foreach ($mytasks->where('category', 'Notification') as $noti)
                            <a href="{{ url('tasks') }}" class="dropdown-item">
                                <i class="fas fa-envelope mr-2"></i> {{ $noti->subject }}
                                <span class="float-right text-muted text-sm">{{ $noti->start_date }}
                                    {{ $noti->start_date == $noti->end_date ? ' ' : $noti->end_date }} </span>
                            </a>
                        @endforeach

                        <div class="dropdown-divider"></div>

                        <a href="{{ url('tasks') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true"
                        href="#" role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ '/home' }}" class="brand-link">
                <img src="{{ asset('dist/img/realtyplus_logo.png') }}" alt="RealtyPlus"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">TrERP</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/passport.jpg') }}" class="img-circle elevation-2"
                            alt="User Image"> <span style="color: white">{{ auth()->user()->name }}</span>
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">

                        </a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-dashboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Personnel
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('staffs') }}" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>All Staff</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('new-staff') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>New Staff</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('drivers') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>All Drivers</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>
                                    Vehicles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('all-vehicles') }}" class="nav-link">
                                        <i class="far fa-add nav-icon"></i>
                                        <p>All Vehicles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('new-request') }}" class="nav-link">
                                        <i class="far fa-plus nav-icon"></i>
                                        <p>Add New Vehicle</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-suitcase"></i>
                                <p>
                                    Requests / Trips
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('requests') }}" class="nav-link">
                                        <i class="far fa-things nav-icon"></i>
                                        <p>View All Requests</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('new-request') }}" class="nav-link">
                                        <i class="far fa-plus nav-icon"></i>
                                        <p>New Request</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('trips') }}" class="nav-link">
                                        <i class="far fa-plus nav-icon"></i>
                                        <p>View Trips</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>
                                    Finance
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('transactions') }}" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>Manage Transactions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('account-heads') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Manage Account Heads</p>
                                    </a>
                                </li>


                            </ul>
                        </li>





                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>
                                    Tasks
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('tasks') }}" class="nav-link">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>View Tasks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('new-task') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>New Task</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>
                                    Settings
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('settings') }}" class="nav-link" data-toggle="modal"
                                        data-target="#settings">
                                        <i class="far fa-user nav-icon"></i>
                                        <p>System Settings</p>
                                    </a>

                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('facilities') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Facilities</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('departments') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Departments</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('units') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Units</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('categories') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('audits') }}" class="nav-link">
                                        <i class="far fa-user-plus nav-icon"></i>
                                        <p>Audit Trails</p>
                                    </a>
                                </li>


                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('requests') }}" class="btn btn-success nav-link">
                                <i class="nav-icon fa far fa-upload text-info"></i>
                                <p><b> VEHICLE REQUESTS<b></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('trips') }}" class="btn btn-default nav-link">
                                <i class="nav-icon fa far fa-upload text-info"></i>
                                <p><b>ALL TRIPS<b></p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ url('logout') }}" class="nav-link">
                                <i class="nav-icon far fa-user text-info"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->

            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <!-----------------------------START YIELD PAGE CONTENT -->
                    @if (Session::get('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                    aria-hidden="true">×</span></button>
                            <i class="fa fa-check-circle"></i> {!! Session::get('message') !!}
                        </div>
                    @endif
                    @yield('content')

                    <!----------------------------END YIELD PAGE CONTENT -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="">TrERP</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.0
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- The Settings Modal -->
    <div class="modal" id="settings">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Application Settings</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">

                    <form method="POST" action="{{ route('settings') }}" id="settingsform"
                        enctype="multipart/form-data">
                        @csrf


                        <input type="hidden" name="oldlogo" value="{{ $organization->logo }}">

                        <input type="hidden" name="oldbackground" value="{{ $organization->background }}">



                        <div class="form-group">
                            <label for="org_name">Organization Name</label>
                            <input type="text" name="org_name" id="org_name" class="form-control"
                                value="{{ $organization->org_name }}">
                        </div>

                        <div class="form-group">
                            <label for="motto">Motto</label>
                            <input type="text" name="motto" id="motto" class="form-control"
                                value="{{ $organization->motto }}">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" name="address" id="address" class="form-control"
                                value="{{ $organization->address }}">
                        </div>




                        <div class="form-group">
                            <label for="logo">Upload Logo Image</label>
                            <input type="file" name="logo" id="logo" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="background">Upload Background Image</label>
                            <input type="file" name="background" id="background" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="color">Choose System Colour</label>
                            <input type="color" name="color" id="color" class="form-control"
                                value="{{ $organization->color }}">
                        </div>

                        <div class="form-group">
                            <label for="mode">Mode</label>
                            <select class="form-control" name="mode" id="mode">
                                <option value="{{ $organization->mode }}">{{ $organization->mode }}</option>
                                <option value="Active" selected>Active</option>
                                <option value="Maintenance">Maintenance</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Save Settings') }}
                            </button>
                        </div>


                    </form>


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    @if (isset($pagetype) && $pagetype == 'Dashboard')
        <!-- ChartJS -->
        <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>

        <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
    @endif

    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            // On Page Load

            //Date picker

            $('.date').datetimepicker({
                format: 'YYYY-MM-DD'
            });

            $('.datetime').datetimepicker({
                useCurrent: false,
                format: 'YYYY-MM-DD HH:mm',
                sideBySide: true,
            });

            $('.select2').select2();

            $('.wyswygeditor').summernote();

        });

        function assignDriver(reqid) {
            $("#request_id").val(reqid);
        }

        function accountHead(accid) {
            var title = $('#ach' + accid).attr("data-title");
            var category = $('#ach' + accid).attr("data-category");
            var type = $('#ach' + accid).attr("data-type");
            var description = $('#ach' + accid).attr("data-description");

            $('#id').val(accid);
            $('#title').val(title);
            $('#category').val(category).attr("selected", "selected");
            $('#type').val(type);
            $('#description').val(description);

        }

        function category(accid) {
            var title = $('#ach' + accid).attr("data-title");
            var category_group = $('#ach' + accid).attr("data-category_group");
            var description = $('#ach' + accid).attr("data-description");
            var business_id = $('#ach' + accid).attr("data-business_id");


            $('#id').val(accid);
            $('#title').val(title);
            $('#category_group').val(category_group).attr("selected", "selected");
            $('#description').val(description);
            $('#catbutton').html("Update Category");
        }


        function transaction(accid) {

            var title = $('#ach' + accid).attr("data-title");
            var date = $('#ach' + accid).attr("data-date");
            var account_head = $('#ach' + accid).attr("data-account_head");
            var amount = $('#ach' + accid).attr("data-amount");
            var reference_no = $('#ach' + accid).attr("data-reference_no");
            var detail = $('#ach' + accid).attr("data-detail");
            var project = $('#ach' + accid).attr("data-project");
            var from = $('#ach' + accid).attr("data-from");
            var to = $('#ach' + accid).attr("data-to");
            var approved_by = $('#ach' + accid).attr("data-approved_by");
            var recorded_by = $('#ach' + accid).attr("data-recorded_by");

            $('#title').val(title);
            $('#id').val(accid);
            $('#date').val(date);
            $('#account_head').val(account_head).attr("selected", "selected");
            $('#project_id').val(project).attr("selected", "selected");
            $('#amount').val(amount);
            $('#reference_no').val(reference_no);
            $('#detail').val(detail);
            $('#from').val(from).attr("selected", "selected");
            $('#to').val(to).attr("selected", "selected");
            $('#approved_by').val(approved_by).attr("selected", "selected");
            $('#recorded_by').val(recorded_by).attr("selected", "selected");

        }



        $(document.body).on('click', '.removeitem', function(event) {

            var item_id = $(this).attr("id");
            item_id = item_id.substr(2);

            $("#" + item_id).remove();
            $("#itrow" + item_id).remove();
        });


        // ADD STAFF
        $(".adds_item").click(function() {
            var item_class = $(".adds_item").attr("id");
            var old_class = parseFloat(item_class);
            new_class = old_class + 1;
            $(".adds_item").prop('id', new_class);

            $("#100").clone().attr('id', new_class).appendTo("#staff_list");
            $("#" + new_class + " a").prop('id', "res" + new_class);

            // $("table tbody#item_list").append("<tr scope='row' class='row"+new_class+"'><td class='input-field'><input type='text' name='property[]' value='' placeholder='e.g. Color, Brand etc'></td><td class='input-field'><td class='input-field'><input type='text' name='value[]' value='' placeholder='e.g. Red, HP etc'></td><td><a href='#' class='btn-floating red btn-small delpos' onClick='delRow("+new_class+")'><i class='small material-icons'>remove</i></a></td></tr>");

        });

        // ADD DESTINATION
        $(".adds_des").click(function() {
            var item_class = $(".adds_des").attr("id");
            var old_class = parseFloat(item_class);
            new_class = old_class + 1;
            $(".adds_des").prop('id', new_class);

            // $("#1000").clone().attr('id', new_class).appendTo("#destination");
            // $("#" + new_class + " a").prop('id', "des" + new_class);

            // $("table tbody#item_list").append("<tr scope='row' class='row"+new_class+"'><td class='input-field'><input type='text' name='property[]' value='' placeholder='e.g. Color, Brand etc'></td><td class='input-field'><td class='input-field'><input type='text' name='value[]' value='' placeholder='e.g. Red, HP etc'></td><td><a href='#' class='btn-floating red btn-small delpos' onClick='delRow("+new_class+")'><i class='small material-icons'>remove</i></a></td></tr>");
            $("#destination").append('<div class="row" id="' + new_class +
                '"><div class="form-group col-md-10"><label>Next Destination</label><input type="text" list="facilities" class="form-control" name="destination[]"  onchange="addHiddenFieldValue(' +
                new_class + ')" id="to' +
                new_class + '" placeholder="Next Destination"><input type="hidden" name="geocord[]" id="toid' +
                new_class +
                '"></div><div class="form-group col-md-2"><label>.</label><a href="#destination" class="btn btn-sm btn-danger btn-block removesitem"id="des' +
                new_class + '">Remove<i class="lnr lnr-remove"></i></a></div></div>');
        });

        $(document.body).on('click', '.removesitem', function(event) {

            var item_id = $(this).attr("id");
            item_id = item_id.substr(3);
            confirm("Are you sure you want to remove the selected item?");
            $("#" + item_id).remove();
            // $("#itrow2" + item_id).remove();
        });

        $("#from").on('change', function() {
            var val = $('#from').val()
            var fid = $('#facilities option').filter(function() {
                return this.value == val;
            }).data('fid');
            /* if value doesn't match an option, xyz will be undefined*/
            var fidd = fid ? fid : '';
            $("#fromid").val(fidd);

        });

        $("#to").on('change', function() {
            var val = $('#to').val()
            var fid = $('#facilities option').filter(function() {
                return this.value == val;
            }).data('fid');
            /* if value doesn't match an option, xyz will be undefined*/
            var fidd = fid ? fid : '';
            $("#toid").val(fidd);

        });

        function addHiddenFieldValue(sourceId) {
            var newVal = $("#to" + sourceId).val();

            var fid = $('#facilities option').filter(function() {
                return this.value == newVal;
            }).data('fid');
            /* if value doesn't match an option, xyz will be undefined*/
            var fidd = fid ? fid : '';

            alert(fidd);
            $("#toid" + sourceId).val(fidd);
        }

        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>

    @if (isset($pagetype) && $pagetype == 'Table')
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script>
            // TABLES WITH FILTERS
            $('#products thead tr').clone(true).appendTo('#products thead');
            $('#products thead tr:eq(1) th:not(:last)').each(function(i) {
                var title = $(this).text();
                $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" value="" />');

                $('input', this).on('keyup change', function() {
                    if (table.column(i).search() !== this.value) {
                        table
                            .column(i)
                            .search(this.value)
                            .draw();
                    }
                });
            });

            var table = $('#products').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "order": [
                    [0, "asc"]
                ],
                "paging": true,
                "pageLength": 50,
                "filter": true,
                "ordering": true,
                deferRender: true,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        </script>
    @endif
</body>

</html>
