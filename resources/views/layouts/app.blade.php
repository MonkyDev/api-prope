<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Ing. Ricardo Elías Mondragón Trujillo">
  <meta name="description" content="Programa de Prestamos en Servicios Escolares">


	<!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>API | {{config('app.name', 'PROPE')}} {{-- API | @yield('title','PROPE') --}}</title>

	<!-- Styles -->
  {!! Html::style('assets/bootstrap3.3.7/css/bootstrap.min.css') !!}
  {!! Html::style('assets/datatables.net-bs/css/dataTables.bootstrap.min.css') !!}
  {!! Html::style('assets/alertifyJS/css/themes/bootstrap.min.css') !!}
  {!! Html::style('assets/alertifyJS/css/alertify.min.css') !!}
  {!! Html::script('assets/jquery2.2.1/jquery.js') !!}
  {!! Html::script('assets/push.js-1.0.5/bin/push.min.js') !!}


 	<link rel="icon" href="assets/icons/iesch_ico.ico"/>

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

</head>
<body>
	@section('sidebar')
    <nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="{{ url('/') }}">Prestamos</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		    	@guest
		    		<ul class="nav navbar-nav navbar-right">
	            <li>
                <a href="{{ route('login') }}">{{ 'Identificarse' }}</a>
              </li>
	            <li>
                <a href="{{ route('register') }}">{{ 'Registrarse' }}</a>
              </li>
			      </ul>
		    	@else
			    	<ul class="nav navbar-nav">
			        <li class="active"><a href=".">Inicio <span class="sr-only">(current)</span></a></li>
			        <li><a href="{{ route('prestar') }}">Prestar</a></li>
			        <li><a href="{{ route('seguimiento') }}">Seguimiento</a></li>
			        <li><a href="{{ route('documents.index') }}">Documentos</a></li>
			        <li><a href="{{ route('reasons.index') }}">Motivos</a></li>

			      </ul>
			      <form action="{{ route('bucarprestamo') }}" method="POST" class="navbar-form navbar-left">
              @csrf
			        <div class="form-group">
			          <input id="usr_search" name="usr_search" type="text" class="form-control" placeholder="Buscar registros...">
			        </div>
			        <button type="submit" class="btn btn-primary">Buscar</button>
			      </form>
			      <ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <i class="glyphicon glyphicon-user"></i> {{ Auth::user()->nombres }} <span class="caret"></span>
                </a>
			          <ul class="dropdown-menu">
			            <li>
                    <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Salir <i class="glyphicon glyphicon-log-out text-danger"></i>
                    </a>
                  </li>
			            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
			          </ul>
			        </li>
			      </ul>
		    	@endguest

		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
  @show

  @yield('content')

 <!-- Scripts -->
 {!! Html::script('js/functions.js') !!}
 {!! Html::script('js/global.js') !!}
 {!! Html::script('js/ajax.js') !!}
 {!! Html::script('assets/bootstrap3.3.7/js/bootstrap.min.js') !!}
 {!! Html::script('assets/datatables.net/js/jquery.dataTables.min.js') !!}
 {!! Html::script('assets/datatables.net-bs/js/dataTables.bootstrap.min.js') !!}
 {!! Html::script('assets/alertifyJS/alertify.min.js') !!}

<script type="text/javascript">$('table.TableAdvanced').DataTable();</script>

{{-- Notificamos el suceso del controlador  --}}

<?php if ( Session::has('code') ) { ?>
<script>
    if ( {{Session::get('code')}} == 200 )
      alertify.success('Los datos se guardaron correctamente!!!');

    if( {{Session::get('code')}} == 302 )
      alertify.error('!Error al guardar los datos¡');

    if( {{Session::get('code')}} == 303)
      alertify.error('!No se pudieron encontrar los datos¡');

    if( {{Session::get('code')}} == 304)
      alertify.error('!No se pudieron realizar cambios en el registro¡');

</script>
<?php }?>

</body>
</html>
{{-- <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        Authentication Links
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html> --}}