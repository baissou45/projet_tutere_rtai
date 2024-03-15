{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Agen Habitat</title>
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

        @yield("css")

        <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
        <style>
            .btn-orange {
                background-color: #e97800;
            }
            .btn-orange:hover {
                background-color: #ac5c06;
                color: white
            }
        </style>

    </head>


    <body class="fixed-left">

        <!-- Loader -->
        <div id="preloader"><div id="status"><div class="spinner"></div></div></div>

        <!-- Begin page -->
        <div id="wrapper">

            @include("layouts.partials.sidebar")

            <!-- Start right Content here -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">

                    <!-- Top Bar Start -->
                    @include("layouts.partials.header")
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
            @method("DELETE")
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

        @yield("script")

        <script>
            $(document).ready(function() {
                toastr.options.timeOut = 10000;

                @if (Session::has('error'))
                    toastr.error('{{ Session::get('error') }}');
                @elseif(Session::has('success'))
                    toastr.success('{{ Session::get('success') }}');
                @elseif(Session::has('warning'))
                    toastr.warning('{{ Session::get('warning') }}');
                @endif
            });

            show_alerte = (route) => {
                $('.sa-warning').click(function () {
                    swal({
                        title: 'Etes-vous sûre ?',
                        text: "Cette action est irréversible !",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonClass: 'btn btn-success',
                        cancelButtonClass: 'btn btn-danger m-l-10',
                        confirmButtonText: 'Oui, Supprimer !',
                        cancelButtonText: 'Annuler'
                    }).then(function () {
                        $('#delete_form').attr('action', route);
                        $('#delete_form').submit();
                    })
                });
            }
        </script>

        <script src="{{ asset('js/toastr.min.js') }}"></script>

    </body>
</html>