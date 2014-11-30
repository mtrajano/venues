@extends('master')

@section('content')

<div id="search-box" class="container content">
	<form role="form">
		<div id="search-box-dropshadow" class="panel panel-primary">
			<div class="panel-heading">
			  	<h3 class="panel-title" style="font-family: Helvetica, sans-serif; font-size:2em;">Find the music you love</h3>
			</div>
			<div id="search-panel" class="panel-body">
			  	<div id="search-container">
			  		<p id="search-desc">Click on search by event to search for events around your area, or type in a name and click on search by friends to see what your friends are up to!</p>
					<div class="input-group">
						<input type="text" class="form-control">
						<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
					</div>
					<nav>
						<ul class="pagination menu">
				  			<li><a href="#/eventfinder">Search By Event</a></li>
				  			<li><a href="#/friendsfinder">Search By Friends</a></li>
						</ul>
					</nav>
			  	</div>
			</div>
		</div>
	</form>
</div>


@stop
