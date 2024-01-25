<!DOCTYPE html>
<!--
Template Name: NobleUI - HTML Bootstrap 5 Admin Dashboard Template
Author: NobleUI
Purchase: https://1.envato.market/nobleui_admin
Website: https://www.nobleui.com
Portfolio: https://themeforest.net/user/nobleui/portfolio
Contact: nobleui123@gmail.com
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>Denteksi - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/core/core.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/select2/select2.min.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('assets/swal/sweetalert.css')}}">
    <script src="{{asset('assets/swal/sweetalert.js')}}"></script>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
	<link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css">

    <link rel="stylesheet" href="{{asset('assets/vendors/prismjs/themes/prism.css')}}">

    <link rel="stylesheet" href="{{asset('assets/vendors/dropify/dist/dropify.min.css')}}">

    <!-- select 2 -->
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('select2/dist/css/select2-bootstrap4.min.css')}}">

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/jquery-steps/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">

    <!-- End plugin css for this page -->
    @yield('style')
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/fonts/feather-font/css/iconfont.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/demo1/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('assets/images/logo-denteksi-removebg.png')}}" />


    <script src="https://use.fontawesome.com/62b53805d2.js"></script>

</head>

    <style>
        .error{
            color: red;
        }
        .page-content{
            /* background-image: url('{{ asset('assets/images/bg-app.jpeg')}}') */
            background-color: #D3E6E9;
        }
        .select2-selection__choice{
            padding-right: 24px !important;
        }
        .select2-selection__choice__remove{
            border-radius: 4px !important;
            right: 0;
            bottom: 0;
            left: unset !important;
        }

        .form-control{

    }

    .selected{
        background-color: lightblue;
    }

    </style>

<body>
    <div class="main-wrapper">
        @include('sweetalert::alert')
        <!-- partial:partials/_sidebar.html -->
        @include('layout.sidebar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('layout.navbar')
            <!-- partial -->

            <div class="page-content">
                @yield('content')
            </div>

            <!-- partial:partials/_footer.html -->
            <!-- @include('layout.footer') -->
            <!-- partial -->

            @include('layout.footer')
        </div>
    </div>

    <!-- core:js -->

    <script src="{{asset('assets/vendors/core/core.js')}}"></script>

    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{asset('assets/vendors/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery.flot/jquery.flot.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery.flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery.flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/vendors/apexcharts/apexcharts.min.js')}}"></script>


    <!-- End plugin js for this page -->

    <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('assets/vendors/jquery-steps/jquery.steps.min.js')}}"></script>
    <script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/select2.js')}}"></script>
	<script src="{{asset('assets/vendors/prismjs/prism.js')}}"></script>
	<script src="{{asset('assets/vendors/clipboard/clipboard.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="{{asset('assets/vendors/dropify/dist/dropify.min.js')}}"></script>
    <script src="{{asset('assets/js/dropify.js')}}"></script>
    <!-- inject:js -->

	<script src="{{asset('assets/vendors/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/template.js')}}"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{asset('select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/vendors/js/dropify.js')}}"></script>

    <script src="{{asset('assets/js/dashboard-light.js')}}"></script>
    <script src="{{asset('assets/js/datepicker.js')}}"></script>
    <!-- Grafik -->
    <script src="{{asset('assets/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    {{-- for select in datatables --}}
    <script src="https://cdn.datatables.net/select/1.3.3/js/dataTables.select.min.js"></script>

    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>

    @stack('after-style')




    <script>
        $(document).ready(function () {
            $('#dataTableExample').DataTable();

        });

    </script>
    <!-- End custom js for this page -->
    @stack('after-script')

</body>

</html>
