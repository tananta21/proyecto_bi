<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="{{url('/')}}/assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>

    <title>INFO | TERREMOTOS</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>


    <!-- Bootstrap core CSS     -->
    <link href="{{url('/')}}/assets/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Animation library for notifications   -->
    <link href="{{url('/')}}/assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="{{url('/')}}/assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{url('/')}}/assets/css/demo.css" rel="stylesheet"/>
    <link href="{{url('/')}}/assets/css/proyecto.css" rel="stylesheet"/>


    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="{{url('/')}}/assets/css/pe-icon-7-stroke.css" rel="stylesheet"/>
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            border-bottom: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
    </style>

</head>
<body>

<div class="wrapper">
<div class="sidebar" data-color="purple" data-image="{{url('/')}}/assets/img/sidebar-5.jpg">

    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Creative Tim
            </a>
        </div>

        <ul class="nav">
<!--            <li class="{{ Request::is('/') ? 'active' : '' }}">-->
<!--                <a href="/">-->
<!--                    <i class="pe-7s-graph"></i>-->
<!---->
<!--                    <p>Dashboard</p>-->
<!--                </a>-->
<!--            </li>-->
            <li class="{{ Request::is('/') ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="pe-7s-map-marker"></i>
                    <p>Mapa Sismos</p>
                </a>
            </li>
            <li class="{{ Request::is('resumen/paises') ? 'active' : '' }}">
                <a href="{{ url('/resumen/paises') }}">
                    <i class="pe-7s-note2"></i>
                    <p>Resumen países</p>
                </a>
            </li>
            <li class="{{ Request::is('historial/categorias') ? 'active' : '' }}">
                <a href="{{ url('/historial/categorias') }}">
                    <i class="pe-7s-news-paper"></i>
                    <p>Historial categorias</p>
                </a>
            </li>

            <li class="{{ Request::is('categoria/sismos') ? 'active' : '' }}">
                <a href="{{ url('/categoria/sismos') }}">
                    <i class="pe-7s-news-paper"></i>
                    <p>Resumen categorias</p>
                </a>
            </li>
            <li class="{{ Request::is('sismos/fuertes') ? 'active' : '' }}">
                <a href="{{ url('/sismos/fuertes') }}">
                    <i class="pe-7s-note2"></i>
                    <p>Sismos Fuertes</p>
                </a>
            </li>
<!--            <li class="">-->
<!--                <a href="">-->
<!--                    <i class="pe-7s-note2"></i>-->
<!--                    <p>Tendencia Anual</p>-->
<!--                </a>-->
<!--            </li>-->
            <li class="{{ Request::is('resumen/meses') ? 'active' : '' }}">
                <a href="{{ url('/resumen/meses') }}">
                    <i class="pe-7s-graph"></i>
                    <p>Registro mensual</p>
                </a>
            </li>
            <!--            <li>-->
            <!--                <a href="">-->
            <!--                    <i class="pe-7s-science"></i>-->
            <!--                    <p>Icons</p>-->
            <!--                </a>-->
            <!--            </li>-->
            <!--            <li>-->
            <!--                <a href="">-->
            <!--                    <i class="pe-7s-bell"></i>-->
            <!--                    <p>Notifications</p>-->
            <!--                </a>-->
            <!--            </li>-->
            <!--            <li class="active-pro">-->
            <!--                <a href="upgrade.html">-->
            <!--                    <i class="pe-7s-rocket"></i>-->
            <!--                    <p>Upgrade to PRO</p>-->
            <!--                </a>-->
            <!--            </li>-->
        </ul>
    </div>
</div>

<div class="main-panel">
<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-globe"></i>
                        <b class="caret"></b>
                        <span class="notification">5</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Notification 1</a></li>
                        <li><a href="#">Notification 2</a></li>
                        <li><a href="#">Notification 3</a></li>
                        <li><a href="#">Notification 4</a></li>
                        <li><a href="#">Another notification</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="">
                        Account
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        Dropdown
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#">
                        Log out
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@section("content")
<div class="content">
<div class="container-fluid">
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="header">
                <h4 class="title">Email Statistics</h4>

                <p class="category">Last Campaign Performance</p>
            </div>
            <div class="content">
                <div id="chartPreferences" class="ct-chart ct-perfect-fourth"></div>

                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> Open
                        <i class="fa fa-circle text-danger"></i> Bounce
                        <i class="fa fa-circle text-warning"></i> Unsubscribe
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-clock-o"></i> Campaign sent 2 days ago
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="header">
                <h4 class="title">Users Behavior</h4>

                <p class="category">24 Hours performance</p>
            </div>
            <div class="content">
                <div id="chartHours" class="ct-chart"></div>
                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> Open
                        <i class="fa fa-circle text-danger"></i> Click
                        <i class="fa fa-circle text-warning"></i> Click Second Time
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">2014 Sales</h4>

                <p class="category">All products including Taxes</p>
            </div>
            <div class="content">
                <div id="chartActivity" class="ct-chart"></div>

                <div class="footer">
                    <div class="legend">
                        <i class="fa fa-circle text-info"></i> Tesla Model S
                        <i class="fa fa-circle text-danger"></i> BMW 5 Series
                    </div>
                    <hr>
                    <div class="stats">
                        <i class="fa fa-check"></i> Data information certified
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card ">
            <div class="header">
                <h4 class="title">Tasks</h4>

                <p class="category">Backend development</p>
            </div>
            <div class="content">
                <div class="table-full-width">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </td>
                            <td>Sign contract for "What are conference organizers afraid of?"</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                </label>
                            </td>
                            <td>Lines From Great Russian Literature? Or E-mails From My Boss?</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox" checked="">
                                </label>
                            </td>
                            <td>Flooded: One year later, assessing what was lost and what was found when a
                                ravaging rain swept through metro Detroit
                            </td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </td>
                            <td>Create 4 Invisible User Experiences you Never Knew About</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </td>
                            <td>Read "Following makes Medium better"</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="checkbox">
                                    <input type="checkbox" value="" data-toggle="checkbox">
                                </label>
                            </td>
                            <td>Unfollow 5 enemies from twitter</td>
                            <td class="td-actions text-right">
                                <button type="button" rel="tooltip" title="Edit Task"
                                        class="btn btn-info btn-simple btn-xs">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" rel="tooltip" title="Remove"
                                        class="btn btn-danger btn-simple btn-xs">
                                    <i class="fa fa-times"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="footer">
                    <hr>
                    <div class="stats">
                        <i class="fa fa-history"></i> Updated 3 minutes ago
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@show


</div>
</div>

<div class="modal fade" id="detalleSisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content col-md-12" style="padding: 0rem">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title" id="exampleModalLabel">Detalles del Sismo</h5>
            </div>
            <div class="modal-body col-md-12" id="LoadingDetalle" style="padding: 15px 0px">
                <div class="col-md-12" id="loadingDetalle" style="position: inherit; top: 25%; left: 40%">
                    <div class="loader"></div>
                    <p style="font-weight: bold; padding-left: 20px; padding-top: 15px">Cargando...</p>
                </div>
                <div id="errorDetalle" style="display:none; position: absolute; top: 30%; left: 40%"> Ha surgido un
                    error.
                </div>
                <div id="contentDetalle" style="display: none">
                    <div class="col-md-6">
                        <form>
                            <div class="form-group modalDetail__box">
                                <label for="recipient-name" class="col-form-label modalDetail__label">País</label>
                                <h4 id="sis_pais" class="modalDetail__name">PERÚ</h4>
                            </div>
                            <div class="form-group modalDetail__box">
                                <label for="recipient-name" class="col-form-label modalDetail__label">Región del
                                    sismo</label>
                                <h4 id="sis_region" class="modalDetail__name">NEAR COAST OF NORTHERN CHILE</h4>
                            </div>
                            <div class="form-group modalDetail__box">
                                <label for="recipient-name" class="col-form-label modalDetail__label">Punto de
                                    Ubicación</label>
                                <h4 class="modalDetail__name">
                                    <span>LAT:</span><span id="sis_lat" style="font-weight: bold">18.7</span>
                                    <span style="padding-left: 15px">LONG:</span><span id="sis_lon"
                                                                                       style="font-weight: bold">-72.7</span>
                                </h4>
                            </div>
                            <div class="form-group modalDetail__box">
                                <label for="recipient-name" class="col-form-label modalDetail__label">Fecha
                                    Sismo</label>
                                <h4 id="sis_fecha" class="modalDetail__name">jueves, septiembre 14, 2017 @ 07:07 PM</h4>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 boxMapModal">
                        <div class="form-group modalDetail__box">
                            <label for="recipient-name" class="col-form-label modalDetail__label">Magnitud</label>
                            <h4 id="sis_fecha" class="modalDetail__name">7.5 escala de Ritcher</h4>
                        </div>
                        <div class="form-group modalDetail__box">
                            <label for="recipient-name" class="col-form-label modalDetail__label">Categoría
                                Sismo</label>
                            <h4 id="sis_cat" class="modalDetail__name">FUERTE</h4>
                        </div>
                        <div class="form-group modalDetail__box">
                            <label for="recipient-name" class="col-form-label modalDetail__label">Profundidad
                                Sismo</label>
                            <h4 class="modalDetail__name"><span id="sis_profun" style="font-weight: bold">150</span>
                                kilómetros</h4>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="boxMapModal__map" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<!--   Core JS Files   -->
<script src="{{url('/')}}/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="{{url('/')}}/assets/js/bootstrap.min.js" type="text/javascript"></script>

<!--  Checkbox, Radio & Switch Plugins -->
<script src="{{url('/')}}/assets/js/bootstrap-checkbox-radio-switch.js"></script>

<!--  Charts Plugin -->
<script src="{{url('/')}}/assets/js/chartist.min.js"></script>

<!--  Notifications Plugin    -->
<script src="{{url('/')}}/assets/js/bootstrap-notify.js"></script>

<!--  Google Maps Plugin    -->

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="{{url('/')}}/assets/js/light-bootstrap-dashboard.js"></script>

<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="{{url('/')}}/assets/js/demo.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>


@section("js")
@show

</html>
