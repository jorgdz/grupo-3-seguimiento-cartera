<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | Data Marketing Plus</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/lte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('assets/lte/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}"> 

    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- para agregar otros estilos css en otras paginas-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.10/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    {{--@yield("styles")--}}

    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper" id="app">
             <!-- INICIO DEL HEADER -->
                @include("theme.lte.header")
            <!-- FIN DEL HEADER -->
            <!-- INICIO DEL ASIDE -->
                @include("theme.lte.aside")
            <!-- FIN DEL ASIDE  -->
        
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
            <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <ol class="breadcrumb float-sm-left">
                                    <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                                    
                                    @if(Auth::user()->perfil_actualizado)
                                       <!-- @can('roles.index')
                                            <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                                        @endcan 

                                        @can('users.index')
                                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                                        @endcan

                                        @can('permissions.index')
                                            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permisos</a></li>
                                        @endcan-->
                                    @endif
                                    
                                    <li class="breadcrumb-item active">  @yield("miga")</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.content-header -->
                <!-- Main content -->
                <section class="content">

                    @yield("content")

                </section>
               
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>     
                <!-- /.content -->
                <!-- /.content-wrapper -->
             <!-- inicio footer -->
             @extends("theme.lte.footer")
              <!-- fin footer -->
            <!-- Control Sidebar -->    
        </div>   
    </div>   
    @yield('script')
    <script src="{{ asset('assets/lte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('assets/lte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    <script src="{{ asset('js/app.js') }}"></script>
    
    @yield('script-discapacidad') 

    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('assets/lte/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('assets/lte/plugins/sparklines/sparkline.js') }}"></script>
    <!-- JQVMap -->
    <script src="{{ asset('assets/lte/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/jqvmap/maps/jquery.vmap.world.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('assets/lte/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('assets/lte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('assets/lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('assets/lte/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('assets/lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('assets/lte/plugins/fastclick/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('assets/lte/dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('assets/lte/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('assets/lte/dist/js/demo.js') }}"></script> 
    <!-- query validaciones -->
    <script src="{{ asset('assets/js/jquery-validation/jquery.validate.min.js') }}"></script> 
    <!-- cambiar mensajes a español -->
    <script src="{{ asset('assets/js/jquery-validation/localization/messages_es.min.js') }}"></script>  
 
    </body>
</html>