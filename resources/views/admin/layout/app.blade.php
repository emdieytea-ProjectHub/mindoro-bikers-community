<!doctype html>
<html lang="en">

<!-- Mirrored from getbootstrap.com/docs/4.0/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 May 2021 03:02:29 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="description" content="">
     <meta name="author" content="">
     <link rel="icon" href="https://getbootstrap.com/docs/4.0/assets/img/favicons/favicon.ico">

     <title>Admin|Mindoro Bikers Community</title>

     <link rel="canonical" href="index.html">

     <!-- Bootstrap core CSS -->
     <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

     <!-- Custom styles for this template -->
     <link href="{{ asset('assets/css/dashboard.css') }}" rel="stylesheet">
</head>

<body style="background-image: linear-gradient(to left,#daedf4, white);">
     <nav class="navbar navbar-dark sticky-top bg-primary flex-md-nowrap p-0">
          <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"> <img style="height:40px; "
                    src="{{ asset('/images/bikers.png') }}" /> &nbsp ADMIN | MBC</a>
          <!--   <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
          <ul class="navbar-nav px-3">
               <li class="nav-item text-nowrap">
                    <a class="nav-link" href="{{ route('logout') }}">Sign out</a>
               </li>
          </ul>
     </nav>

     <style>
          .nav-item:hover {
               background-color: #0b6c91;
          }

     </style>

     <div class="container-fluid">
          <div class="row">
               <nav class="col-md-2 d-none d-md-block bg-primary sidebar">
                    <div class="sidebar-sticky">
                         <ul class="nav flex-column">
                              <li class="nav-item"><br>
                                   <a class="nav-link" href="{{ route('dashboard') }}" style="color:white;">
                                        <span data-feather="home" style="color:white;"></span>
                                        Dashboard
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.products') }}"
                                        style="color:white;">
                                        <span data-feather="shopping-cart" style="color:white;"></span>
                                        Products
                                   </a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.sales') }}" style="color:white;">
                                        <span data-feather="shopping-cart" style="color:white;"></span>
                                        Sales
                                   </a>
                              </li>

                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.tournament') }}"
                                        style="color:white;">
                                        <span data-feather="list" style="color:white;"></span>
                                        Tournament Events
                                   </a>
                              </li>

                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.scoreboard') }}"
                                        style="color:white;">
                                        <span data-feather="monitor" style="color:white;"></span>
                                        Scoreboard
                                   </a>
                              </li>

                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('report') }}" style="color:white;">
                                        <span data-feather="bar-chart-2" style="color:white;"></span>
                                        Reports
                                   </a>
                              </li>



                              <li class="nav-item">
                                   <a class="nav-link" href="{{ route('admin.users') }}" style="color:white;">
                                        <span data-feather="users" style="color:white;"></span>
                                        Users
                                   </a>
                              </li>
                         </ul>


                    </div>
               </nav>

               @yield('body')
          </div>
     </div>

     <!-- Bootstrap core JavaScript
    ================================================== -->
     <!-- Placed at the end of the document so the pages load faster -->
     <script src="{{ asset('assets/js/jquery-slim.min.js') }}"
          integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
     </script>
     <script>
          window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
     </script>
     <script src="{{ asset('assets/js/popper.min.js') }}"></script>
     <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

     <!-- Icons -->
     <script src="{{ asset('assets/js/feather.min.js') }}"></script>
     <script>
          feather.replace()
     </script>

</body>

<!-- Mirrored from getbootstrap.com/docs/4.0/examples/dashboard/ by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 28 May 2021 03:02:35 GMT -->

</html>
