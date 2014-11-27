<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Eventigo</title>

    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="/assets/css/main-user.css">
</head>

<body>

	@if(Session::has('error'))
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('error') }}
		</div>
	@elseif(Session::has('message'))
		<div class="alert alert-info alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('message') }}
		</div>
	@elseif(Session::has('success'))
		<div class="alert alert-success alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			{{ Session::get('success') }}
		</div>
	@endif

	<nav class="navbar navbar-default" role="navigation" style="z-index: 999">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{ URL::to('/') }}">Eventigo</a>
	    </div>

	    <ul class="nav navbar-nav navbar-right">
	    	@if(Auth::check())
	    		<li><a href="{{ URL::to('logout') }}">Logout</a></li>
	    	@else
	    		<li><a href="{{ URL::to('login') }}">Login</a></li>
	    	@endif
        </ul>
	  </div>
	</nav>

	@yield('content')

	<script src="/assets/js/jquery.min.js" ></script>
	<script src="/assets/js/bootstrap.min.js" ></script>

	@yield('scripts')

</body>

</html>