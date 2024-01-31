<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('./img/logos/logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('./img/logos/logo.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Biblioteca UTVT
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- CSS Files -->
    <!-- Bootstrap version 4.4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/paper-dashboard.css?v=2.0.1') }}" rel="stylesheet" />
    @yield('css')
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                    <!-- <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div> -->
                    <!-- <p>CT</p> -->
                </a>
                <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                    BIBLIOTECA UTVT
                    <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li id="inicio">
                        <a href="javascript:;">
                            <i class="bi bi-building-fill"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li id="usuarios">
                        <a href="javascript:;">
                            <i class="bi bi-person-fill"></i>
                            <p>Usuarios</p>
                        </a>
                    </li>
                    <li id="maquinas">
                        <a href="javascript:;">
                            <i class="bi bi-pc-display"></i>
                            <p>Maquinas</p>
                        </a>
                    </li>
                    <li id="libros">
                        <a href="javascript:;">
                            <i class="bi bi-journal-bookmark-fill"></i>
                            <p>Libros</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel" style="height: 100vh;">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <p class="navbar-brand" id="titulo"></p>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <ul class="navbar-nav">
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bi bi-gear-fill"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="/logout">Cerrar Sesión</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    @yield('content')
                </div>
            </div>
            <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="#" target="_blank">BIBLIOTECA UTVT</a></li>
                            </ul>
                        </nav>
                        <div class="credits ml-auto">
                            <span class="copyright"></span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    @yield('js')
    <script src="{{ asset('./js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('./js/core/popper.min.js') }}"></script>
    <script src="{{ asset('./js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('./js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('./js/plugins/chartjs.min.js') }}"></script>
    <!--  Notifications Plugin    -->
    <script src="{{ asset('./js/plugins/bootstrap-notify.js') }}"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('./js/paper-dashboard.min.js') }}" type="text/javascript"></script>
</body>

</html>