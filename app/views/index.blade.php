@extends('master')

@section('content')

<div id="search-box" class="container content">
  <form role="form">
    <div class="panel panel-primary">
      <div class="panel-heading">
          <h3 class="panel-title" style="font-family: Helvetica, sans-serif; font-size:2em;">Are you ready for the best music experience ever?</h3>
      </div>
      <div id="search-panel" class="panel-body">
	      <div id="search-container">
		      <div class="input-group">
		        <input type="text" class="form-control">
		        <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
		      </div>
		      <nav>
		        <ul class="pagination menu">
		          <li><a href="#/eventfinder">Search By Concert</a></li>
		          <li><a href="#/friendsfinder">Search By Friends</a></li>
		        </ul>
		      </nav>
	      </div>
	    </div>
      </div>
    </div>
  </form>
</div>


@stop
