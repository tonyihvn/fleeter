<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TreERP | Sign up</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition register-page">
    <div class="col-md-6 col-md-offset-3">
        <div class="register-logo">
            <a href="../../index2.html"><b>Tr</b>ERP</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Sign up</p>

                @yield('content')


                <div class="d-flex justify-content-center" style="margin-top: 20px;">
                    <a href="{{ url('/login') }}" class="btn btn-info btn-xs">I already have an account</a>
                </div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
<script>
    $(function() {
        $("#client").hide();
        $("#contributor").hide();

        $('#memberrole').on('change', function() {
            var target = $('#memberrole option:selected').val();
            if (target == "Client") {
                $("#contributor").hide();
                $("#client").show();
            } else {
                $("#client").hide();
                $("#contributor").show();
            }
        });
    });
</script>
