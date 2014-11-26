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

	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
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

	@yield('content')

	<script src="/assets/js/jquery.min.js" ></script>
	<script src="/assets/js/bootstrap.min.js" ></script>

	@yield('scripts')

</body>

</html>