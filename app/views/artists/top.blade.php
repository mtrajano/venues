@extends('master')

@section('content')

<div id="page-wrapper">
	
	<div class="page-header">
		<h1>Top Artists</h1>
	</div>

	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
		<thead>
			<th>Rank</th>
			<th>Name</th>
			<th>Genre</th>
		</thead>
		<tbody>
			<?php $i=1; ?>
			@foreach($artists as $artist)
				<tr>
					<td> {{ $i++ }} </td>
					<td> {{ $artist->name }} </td>
					<td> {{ $artist->genre->name }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>

</div>

@stop