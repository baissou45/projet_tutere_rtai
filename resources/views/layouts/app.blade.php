<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Property management</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App Icons -->
    <link rel="shortcut icon" href="{{ asset('logo.png') }}">

    <!-- Basic Css files -->
    <link href="{{ asset('template/back/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/back/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/back/assets/css/style.css') }}" rel="stylesheet" type="text/css">

    <!-- DataTables -->
    <link href="{{ asset('template/back/assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/back/assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('template/back/assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Sweet Alert -->
    <link href="{{ asset('template/back/assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">

    @yield('css')
</head>


<body class="fixed-left">

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner"></div>
        </div>
    </div>

    <!-- Begin page -->
    <div id="wrapper">

        @include('layouts.partials.sidebar')

        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                @include('layouts.partials.header')
                <!-- Top Bar End -->

                <!-- ==================
                         PAGE CONTENT START
                         ================== -->

                <div class="page-content-wrapper">
                    <div class="container-fluid">

                        @yield('content')

                    </div>
                </div>

            </div>
            <!-- end content -->

        </div>
        <!-- End Right content here -->

    </div>
    <!-- END wrapper -->

    <form action="" method="post" id="delete_form">
        @csrf
        @method('DELETE')
    </form>

    <!-- jQuery  -->
    <script src="{{ asset('template/back/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/modernizr.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/waves.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ asset('template/back/assets/js/jquery.scrollTo.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('template/back/assets/js/app.js') }}"></script>

    <!-- Required datatable js -->
    <script src="{{ asset('template/back/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons examples -->
    <script src="{{ asset('template/back/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <!-- Responsive examples -->
    <script src="{{ asset('template/back/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/back/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('template/back/assets/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('template/back/assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    {{-- <script src="assets/pages/sweet-alert.init.js"></script> --}}

    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}

    @yield('script')

    <script>
        $(document).ready(function() {
            toastr.options.timeOut = 10000;

            @if (Session::has('error'))
                toastr.error('{{ Session::get('error') }}');
            @elseif (Session::has('success'))
                toastr.success('{{ Session::get('success') }}');
            @elseif (Session::has('warning'))
                toastr.warning('{{ Session::get('warning') }}');
            @endif
        });

        logout = () => {
            $('#dec_form').submit();
        }

        show_alerte = (route) => {
            $('.sa-warning').click(function() {
                swal({
                    title: 'Etes-vous sûre ?',
                    text: "Cette action est irréversible !",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Oui, Supprimer !',
                    cancelButtonText: 'Annuler'
                }).then(function() {
                    $('#delete_form').attr('action', route);
                    $('#delete_form').submit();
                })
            });
        }
    </script>

    <script src="{{ asset('js/toastr.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.47.0/apexcharts.min.js"
        integrity="sha512-oM6gsyV28tHLTsSyakEjJ8TpRtYpjrbWQ9aBEPJIyS17LcEXltOVDaa/S9V+x9cxT9HKW+x3E39wqtYYDU1LXw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.11/index.min.js" integrity="sha512-xCMh+IX6X2jqIgak2DBvsP6DNPne/t52lMbAUJSjr3+trFn14zlaryZlBcXbHKw8SbrpS0n3zlqSVmZPITRDSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    @prepend('scripts')
        {{-- Push ApexCharts to the top of the scripts stack --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script> --}}
    @endprepend

</body>

</html>
