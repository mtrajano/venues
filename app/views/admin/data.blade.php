@extends('admin.master')

@section('content')

<div id="page-wrapper">
	<div class="row">
	    <div class="col-lg-12">
	        <h1 class="page-header">Admin Data</h1>
	    </div>
	    <!-- /.col-lg-12 -->
	</div>
	<div class="row">
	    <div class="col-lg-8">
	    	<div class="panel panel-default">
	    	    <div class="panel-heading">
	    	    	<h3 class="panel-title">Profit vs Ticket Price and Likes</h3>
	    	    </div>
	    	    <div class="panel-body">
	    	    	<div id="chartContainer"></div>
	    	    </div>
    	    </div>
	    </div>
	    <div class="col-lg-4">
	    	<div class="panel panel-default">
	    	    <div class="panel-heading">
	    	    	<h3 class="panel-title">Sample Data</h3>
	    	    </div>
	    	    <div class="panel-body">
	    	    </div>
    	    </div>
	    </div>
	</div>
</div>

@stop

@section('scripts')

<script>

$(function(){
	data = {{ Cache::get('profit_data') }};

	var svg = dimple.newSvg("#chartContainer", 590, 400);
	var chart = new dimple.chart(svg, data);
	x = chart.addCategoryAxis("x", "price");
	y = chart.addCategoryAxis("y", "number_likes");
	chart.addMeasureAxis("z", "profit");
	x.addOrderRule("price");
	y.addOrderRule(["0", "1-20", "20-100", "100-1000", "1000+"]);
	chart.addSeries(["number_likes, price"], dimple.plot.bubble);
	chart.addLegend(180, 10, 360, 20, "right");
	chart.draw();
});

</script>

@stop