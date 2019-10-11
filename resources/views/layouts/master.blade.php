<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured system for Law firms.">
        <meta name="author" content="Thembo Charles Lwanga">

        <!-- App Favicon -->
        <link rel="icon" href="{{asset('documents/favicon.PNG')}}">

        <!-- App title -->
        <title>Themis</title>

        <!-- Switchery css -->
        <link href="{{asset('back_end/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
         <link href="{{asset('back_end/assets/plugins/custombox/css/custombox.min.css')}}" rel="stylesheet">
      <!--   <link rel="stylesheet" type="text/css" href=" https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css"> -->

        <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/buttons.dataTables.min.css') }}">

        <link href="{{asset('back_end/assets/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet">
        <link href="{{asset('back_end/assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.css')}}" rel="stylesheet">
        <link href="{{asset('back_end/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
        <link href="{{asset('back_end/assets/plugins/clockpicker/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
        <link href="{{asset('back_end/assets/plugins/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

        <link href="{{asset('back_end/assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')}}" rel="stylesheet" />
        <link href="{{asset('back_end/assets/plugins/multiselect/css/multi-select.css')}}"  rel="stylesheet" type="text/css" />
        <link href="{{asset('back_end/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <link href="{{asset('back_end/assets/plugins/fullcalendar/dist/fullcalendar.css')}}" rel="stylesheet" />

        <!-- App CSS -->
        <link href="{{asset('back_end/assets/css/style.css')}}" rel="stylesheet" type="text/css" />

        <style type="text/css">
            #topnav .topbar-main {
                background-color: #990E2C;
            }
          
        </style>

        
 

        @yield('styles')

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <!-- Modernizr js -->
        <script src="{{asset('back_end/assets/js/modernizr.min.js')}}"></script>

    </head>


    <body>

        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="/home" class="logo">
                            <i class="zmdi zmdi-case icon-c-logo"></i>
                            <span>Themis</span>

                           <span> => {{Auth::user()->company->name}} </span>
                        </a>
                    </div>
                    <!-- End Logo container-->

                    <?php 
                        $read_Task=array();
                        $my_tasks=\DB::table('task_user')->where('user_id',\Auth::user()->id)->get();
                        foreach ($my_tasks as $task_value) {
                            # code...
                            if (App\Task::find($task_value->task_id)->status==0) {
                                $read_Task[]=App\Task::find($task_value->task_id);
                            }
                        }

                     ?>


                    <div class="menu-extras">

                        <ul class="nav navbar-nav pull-right">

                              <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="zmdi zmdi-notifications-none noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg" aria-labelledby="Preview">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5><small><span class="label label-danger pull-xs-right">{{count($read_Task)}}</span>Pending Tasks</small></h5>
                                    </div>

                                    @foreach($read_Task as $tasks)
                                    <?php
                                        $data = explode("/", $tasks->start_time) ;
                                    ?>
                                     
                                    <a href="{{route('matter_task.show',$tasks->id)}}" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-success"><i class="icon-bubble"></i></div>
                                        <p class="notify-details">{{$tasks->name}}<small class="text-muted">{{$data[0]}} {{$data[1]}}</small></p>
                                    </a>

                                    @endforeach                                 
                                 
 
                                </div>
                            </li>
<!-- 
                             <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <i class="zmdi zmdi-email noti-icon"></i>
                                    <span class="noti-icon-badge"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg" aria-labelledby="Preview">
                            
                                    <div class="dropdown-item noti-title bg-success">
                                        <h5><small><span class="label label-danger pull-xs-right">7</span>Notifications</small></h5>
                                    </div>

                        
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-faded">
                                            <img src="assets/images/users/avatar-2.jpg" alt="img" class="img-circle img-fluid">
                                        </div>
                                        <p class="notify-details">
                                            <b>Robert Taylor</b>
                                            <span>New tasks needs to be done</span>
                                            <small class="text-muted">1min ago</small>
                                        </p>
                                    </a>

                           
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-faded">
                                            <img src="assets/images/users/avatar-3.jpg" alt="img" class="img-circle img-fluid">
                                        </div>
                                        <p class="notify-details">
                                            <b>Carlos Crouch</b>
                                            <span>New tasks needs to be done</span>
                                            <small class="text-muted">1min ago</small>
                                        </p>
                                    </a>

                            
                                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                                        <div class="notify-icon bg-faded">
                                            <img src="assets/images/users/avatar-4.jpg" alt="img" class="img-circle img-fluid">
                                        </div>
                                        <p class="notify-details">
                                            <b>Robert Taylor</b>
                                            <span>New tasks needs to be done</span>
                                            <small class="text-muted">1min ago</small>
                                        </p>
                                    </a>

                                
                                    <a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
                                        View All
                                    </a>

                                </div>
                            </li> -->

                             

                            <li class="nav-item">
                                <!-- Mobile menu toggle-->
                                <a class="navbar-toggle">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                                <!-- End mobile menu toggle-->
                            </li>  


                  
                        
                            <li class="nav-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <!-- <img src="back_end/assets/images/users/avatar-1.jpg" alt="{{Auth::user()->name}}" class="img-circle"> -->
                                    <span style="color: #FFF;">{{Auth::user()->name}}</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-arrow profile-dropdown " aria-labelledby="Preview">                                
                                  

                                 

                                   
                                    <!-- item-->                                 
                                      
                                    <a href="{{ route('logout') }}" class="dropdown-item notify-item"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                       <i class="zmdi zmdi-power"> Logout</i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>                             
                                     

                                </div>
                            </li>

                        </ul>

                    </div> <!-- end menu-extras -->
                    <div class="clearfix"></div>

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                           @role(['lawyers','admin']) 

                            <li class="has-submenu">
                                <a href="/home"><i class="zmdi zmdi-home"></i>Dashboard</a>
                              
                            </li>                          

                            <li class="has-submenu">
                                <a href="{{route('client.create')}}"><i class="zmdi zmdi-local-wc"></i>Clients</a>                               
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('matter.index')}}"><i class="zmdi zmdi-collection-bookmark"></i>Matter</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('court_book.index')}}"><i class="zmdi zmdi-border-color"></i>Court book</a>
                            </li>                             

                            <li class="has-submenu">
                                <a href="{{route('communication.index')}}"><i class="zmdi zmdi-whatsapp"></i>Client Communications</a>
                            </li>

                            <li class="has-submenu">
                                <a href="{{route('matter_event.index')}}"><i class="zmdi zmdi-account-calendar"></i>  Calender</a>
                            </li>

                             <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-collection-bookmark"></i>Reports</a>
                                <ul class="submenu">
                                    
                                    <li><a href="{{route('alert.index')}}">Billing report</a></li>
                                    <li><a href="{{url('client_report')}}">Client report</a></li>
                                    <li><a href="{{url('client_list')}}">Client comprehensive report</a></li>
                                    <li><a href="{{url('casees_report')}}">Court book report</a></li>
                                    <li><a href="{{route('alert.create')}}">Expenses report</a></li>
                                    <li><a href="{{url('matter_report')}}">Matter report</a></li>
                                    <li><a href="{{url('matter/time/create')}}">Timesheet report</a></li>
                                    
                                    
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="zmdi zmdi-settings-square"></i>Settings</a>
                                <ul class="submenu">
                                    <li><a href="{{route('case_types.create')}}">Case types</a></li>
                                    <li><a href="{{route('practice_area.index')}}">Practice area</a></li>
                                    <li><a href="{{route('user.index')}}">Users</a></li>
                                    <li><a href="{{route('user.create')}}">Change password</a></li>
                                    <li><a href="/logs">User Logs</a></li>
                                </ul>
                            </li>
                            @endrole
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


      

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="wrapper">
            <div class="container">

         <!-- ============================================================== -->
       <!--  Notification area -->
        <!-- ============================================================== -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif  

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h4>{{$title}}</h4>

        <!-- ============================================================== -->
        <!-- End of Notification area -->
        <!-- ============================================================== -->


           <!--  <br><br> -->

       <!-- ============================================================== -->
       <!--  Blade template -->
        <!-- ============================================================== -->
                @yield('content')
        <!-- ============================================================== -->
        <!-- End Blade template -->
        <!-- ============================================================== -->   

            <!-- Footer -->
            <footer class="footer text-right">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                          © <?php echo date("Y") ?> Veritas Interactive. All rights reserved
                        </div>
                    </div>
                </div>
            </footer>             


            </div> <!-- container -->
           </div> <!-- End wrapper -->




        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
       
        <script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
        <script src="{{asset('back_end/assets/js/tether.min.js')}}"></script><!-- Tether for Bootstrap -->
        <script src="{{asset('back_end/assets/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('back_end/assets/js/waves.js')}}"></script>
        <script src="{{asset('back_end/assets/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/switchery/switchery.min.js')}}"></script>
     
        <script src="{{asset('back_end/assets/js/jquery.app.js')}}"></script>  
      

        <script src="{{asset('back_end/assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/clockpicker/bootstrap-clockpicker.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>

        <script src="{{asset('back_end/assets/pages/jquery.form-pickers.init.js')}}"></script>

        <script src="{{asset('back_end/assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.js')}}"></script>
        <script type="text/javascript" src="{{asset('back_end/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('back_end/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
        <script src="{{asset('back_end/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>

        <!-- Autocomplete -->
        <script type="text/javascript" src="{{asset('back_end/assets/plugins/autocomplete/jquery.mockjax.js')}}"></script>
        <script type="text/javascript" src="{{asset('back_end/assets/plugins/autocomplete/jquery.autocomplete.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('back_end/assets/plugins/autocomplete/countries.js')}}"></script>
        <!-- <script type="text/javascript" src="{{asset('back_end/assets/pages/jquery.autocomplete.init.js')}}"></script> -->

        <script type="text/javascript" src="{{asset('back_end/assets/pages/jquery.formadvanced.init.js')}}"></script>


        <script src="{{asset('back_end/assets/plugins/moment/moment.js')}}"></script>
        <script src="{{asset('back_end/assets/plugins/fullcalendar/dist/fullcalendar.min.js')}}"></script>
        <script src="{{asset('back_end/assets/pages/jquery.fullcalendar.js')}}"></script>

        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('js/jszip.min.js') }}"></script>
        <script src="{{ asset('js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('js/vfs_fonts.js') }}"></script>
        <script src="{{ asset('js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('js/buttons.print.min.js') }}"></script>

        <script type="text/javascript">

             $(document).ready(function() {
                $('#table_details,#tadetails,#table_records,#billingrecords,#lost,#clients,#matters,#practice_area,#billing,#case_table,#court_records,#court_records,#users_list').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                } );
            } );      
        
        </script>

    <script type="text/javascript">
        $(document).ready(function() {
        setInterval(function() {
            verify_response()
        }, 10000);
        });

        function verify_response() {
        $.ajax({
                type: "GET",
                url: "/task_remiders",
                data: {                
                    _token: "{{Session::token()}}" },
                success: function(result){
                console.log(result);
                }
            })
        }
    </script>
    @stack('scripts')
    </body>
</html>