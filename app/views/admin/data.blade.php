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
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="panel panel-default">
	    	    <div class="panel-heading">
	    	    	<h3 class="panel-title">Number of Likes vs Number of Sales</h3>
	    	    </div>
	    	    <div class="panel-body">
	    	    	<div id="chartContainer2"></div>
	    	    </div>
    	    </div>
	    </div>
	</div>
	<div class="row">
	    <div class="col-lg-12">
	    	<div class="panel panel-default">
	    	    <div class="panel-heading">
	    	    	<h3 class="panel-title">Price of Ticket vs Number of Sales</h3>
	    	    </div>
	    	    <div class="panel-body">
	    	    	<div id="chartContainer3"></div>
	    	    </div>
    	    </div>
	    </div>
	</div>
</div>

@stop

@section('scripts')

<script>

$(function(){
	//Graph 1 - Number of likes of artist and price of ticket vs the profits made in concert
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

	//Graph 2 - Price of tickets vs the number of ticket sales
	new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'chartContainer2',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: {{ Cache::get('price_sales') }},
	  // The name of the data record attribute that contains x-values.
	  xkey: 'price',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['avg_sale'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Average Sales']
	});

	//Graph 3 - Number of likes of artist vs the number of ticket sales
	new Morris.Line({
	  // ID of the element in which to draw the chart.
	  element: 'chartContainer3',
	  // Chart data records -- each entry in this array corresponds to a point on
	  // the chart.
	  data: {{ Cache::get('likes_sales') }},
	  // The name of the data record attribute that contains x-values.
	  xkey: 'number_likes',
	  // A list of names of data record attributes that contain y-values.
	  ykeys: ['avg_sale'],
	  // Labels for the ykeys -- will be displayed when you hover over the
	  // chart.
	  labels: ['Average Sales']
	});
});

</script>

@stop