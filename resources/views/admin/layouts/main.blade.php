<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin {{ $setting->site_name }} | {{$title}}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('customer/img/ruci_logo.ico')}}" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href=" {{ asset('admin/assets/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href=" {{ asset('admin/assets/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href=" {{ asset('admin/assets/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href=" {{ asset('admin/assets/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/assets/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <!-- <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/morris.js/morris.css') }}"> -->
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('admin/assets/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet"
        href="{{ asset('admin/assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="{{ asset('admin/assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
    .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
    }

    .example-modal .modal {
        background: transparent !important;
    }
    </style>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        @include('admin/layouts/header')
        <!-- Sidebar -->
        @include('admin/layouts/sidebar')
        @yield('content')
        @include('admin/layouts/controlside')
        <!-- Footer -->
        @include('admin/layouts/footer')
    </div>
    <!-- ./wrapper -->

    <!-- jQuery 3 -->
    <script src="../admin/assets/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="../admin/assets/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../admin/assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="../admin/assets/bower_components/raphael/raphael.min.js"></script>
    <!-- <script src="../admin/assets/bower_components/morris.js/morris.min.js"></script> -->
    <!-- Sparkline -->
    <script src="../admin/assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../admin/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../admin/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../admin/assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="../admin/assets/bower_components/moment/min/moment.min.js"></script>
    <script src="../admin/assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../admin/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../admin/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../admin/assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../admin/assets/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="../admin/assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="../admin/assets/dist/js/pages/dashboard.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <script src="../admin/assets/dist/js/demo.js"></script>
    <!-- Custom JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables -->
    <script src="../admin/assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../admin/assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- page script -->
    <script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': false,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': false,
            'autoWidth': false
        })
        // SESION PAGE
        $('#example2').on('page.dt', function () {
            var info = $('#example2').DataTable().page.info();
            localStorage.setItem('last_page', info.page);
        });
        // Saat reload/redirect, buka kembali halaman terakhir
        $(document).ready(function() {
            var lastPage = localStorage.getItem('last_page');
            if (lastPage !== null) {
                $('#example2').DataTable().page(parseInt(lastPage)).draw(false);
            }
        });
    })
    </script>

    <script>
    // Menginisialisasi Tagify pada input
    var input = document.querySelector('input[name=sizes]');
    new Tagify(input);
    function checkSize() {
        var check= document.getElementById("sizes").value;
        console.log(check);
    }

    var inputEditSize = document.querySelector('input[name=SizeEdit]');
    new Tagify(inputEditSize);
    </script>
    @if (session('success'))
    <script>
    Swal.fire({
        toast: true,
        position: 'top',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
    });
    </script>
    @endif
</body>

</html>
<script>
// Logout
function confirmLogout() {
    Swal.fire({
        title: "Logout",
        text: "Are you sure you want to logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Logout",
    }).then((result) => {
        if (result.value) {
            document.getElementById("logout-form").submit();
        }
    });
}
</script>

<script>
    function fetchNotifications() {
        fetch('{{ route('notifications.unread') }}')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    let notificationList = document.getElementById('notification-list');
                    notificationList.innerHTML = ''; // Clear existing notifications

                    data.notifications.forEach(notif => {
                        notificationList.innerHTML += `
                            <li>
                                <a href="/notifications/read/${notif.id}">
                                    <i class="fa fa-shopping-cart text-aqua"></i>
                                    Order #${notif.CheckoutID} is unpaid.
                                </a>
                            </li>
                        `;
                    });
                }
            });
    }

    // Call the function periodically (e.g., every 30 seconds)
    setInterval(fetchNotifications, 30000);
</script>
</body>

</html>