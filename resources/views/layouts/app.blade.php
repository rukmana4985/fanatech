<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>APLIKASI GROSIR | Management System</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="{{ @$description }}" name="description" />
        <meta content="{{ @$author }}" name="author" />
        {{-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" /> --}}
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/css/backend.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/metronic/theme') }}/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="favicon.ico" />
        
    </head>

    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
        @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
        @include('sweetalert::alert')
        <div class="page-wrapper">
            @include('layouts.header')
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->
            <!-- BEGIN CONTAINER -->
            <div class="page-container">
                @include('layouts.side')
                @yield('plugin')
                <!-- BEGIN CONTENT -->
                <div class="page-content-wrapper">
                    <!-- BEGIN CONTENT BODY -->
                    <div class="page-content">
                        @include('layouts.breadcrump')
                        @yield('content')
                    </div>  
                    <!-- END CONTENT BODY -->
                </div>
                <!-- END CONTENT -->
            </div>
            <!-- END CONTAINER -->
            @include('layouts.footer')
        </div>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/layouts/layout/scripts/demo.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="{{ url('/metronic/theme') }}/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script>
            
            $(document).ready(function()
            {
                $('.select').select2();

                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });

                @if(!empty($columns))
                $('#datatable tfoot th').each( function () {
                    var title = $(this).text();
                    $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                } );
                var table = $('#datatable').DataTable({
                    processing: true,
                    //order: [[ 0, 'desc' ], [ 0, 'asc' ]],
                    dom: 'Bfrtip',
                    buttons: [
                            'csv', 'excel', 'pdf'
                        ],
                    serverSide: true,
                    ajax: '{{ url()->full() }}',
                    columns: {!! General::columnDatatable($columns) !!}
                });
                @endif
                @if(!empty($columns2))
                    $('#datatable2 tfoot th').each( function () {
                        var title = $(this).text();
                        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
                    } );
                 var table = $('#datatable2').DataTable({
                    searching: false, 
                    paging: true,
                    processing: true,
                    order: [[ 0, 'desc' ]],
                    serverSide: true,
                    ajax: '{{ url()->current() }}',
                    columns: {!! General::columnDatatable($columns2) !!}
                });
                // Apply the search
                // table.columns().every( function () {
                //     var that = this;
                //     $( 'input', this.footer()).on( 'keyup change', function () {
                //         if ( that.search() !== this.value ) {
                //             that
                //                 .search( this.value )
                //                 .draw();
                //         }
                //     } );
                // } );
                @endif

                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
                $('.datepicker').datepicker({
                    format: 'yyyy-mm-dd'
                });
        </script>

        <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
        @if(!empty($validator))
        {!! $validator->render() !!}
        @endif
        @yield('js')
    </body>

</html>
