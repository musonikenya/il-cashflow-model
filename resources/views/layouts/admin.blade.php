<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap -->
    <link href="frontEnd/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="frontEnd/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="frontEnd/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="frontEnd/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="frontEnd/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="frontEnd/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="frontEnd/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="frontEnd/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="frontEnd/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    @yield('css')
    <!-- Custom Theme Style -->
    <link href="frontEnd/build/css/custom.min.css" rel="stylesheet">
        {!! Charts::assets() !!}
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="{{url('/home')}}" class="site_title"><i class="fa fa-paw"></i> <span>Musoni Cashflow</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="frontEnd/images/img.jpg" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>Options</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-home"></i> Select <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('reports')}}">Reports</a></li>
                    </ul>
                  </li>
                </ul>
              </div>


            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="frontEnd/images/img.jpg" alt="">{{ Auth::user()->name }}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li>
                      <a href="{{ url('/logout') }}"
                          onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                                   <i class="fa fa-sign-out pull-right"></i>Logout
                      </a>
                      <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                          {{ csrf_field() }}
                      </form>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        @yield('content')
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            {{ config('app.name') }} by <a href="https://musoni.co.ke">Musoni Kenya</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- jQuery -->
    <script src="frontEnd/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="frontEnd/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="frontEnd/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="frontEnd/vendors/nprogress/nprogress.js"></script>
    <!-- iCheck -->
    <script src="frontEnd/vendors/iCheck/icheck.min.js"></script>
    <!-- Datatables -->
    <script src="frontEnd/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="frontEnd/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="frontEnd/vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script src="frontEnd/vendors/jszip/dist/jszip.min.js"></script>
    <script src="frontEnd/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="frontEnd/vendors/pdfmake/build/vfs_fonts.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="frontEnd/build/js/custom.min.js"></script>
    @yield('script')

    <!-- Datatables -->
    <script>
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable-buttons").length) {
            $("#datatable-buttons").DataTable({
              dom: "Bfrtip",
              buttons: [
                {
                  extend: "copy",
                  className: "btn-sm"
                },
                {
                  extend: "csv",
                  className: "btn-sm"
                },
                {
                  extend: "excel",
                  className: "btn-sm"
                },
                {
                  extend: "pdfHtml5",
                  className: "btn-sm"
                },
                {
                  extend: "print",
                  className: "btn-sm"
                },
              ],
              responsive: true
            });
          }
        };

        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();

        $('#datatable').dataTable();


        TableManageButtons.init();
      });
    </script>
    <!-- /Datatables -->
  </body>
</html>
