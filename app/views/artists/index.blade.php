@extends('master')

@section('content')

<div id="page-wrapper">
	
	<div class="page-header">
		<h1>Artists</h1>
	</div>

	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
		<thead>
			<th>Name</th>
			<th>Genre</th>
		</thead>
		<tbody>
			@foreach($artists as $artist)
				<tr>
					<td> {{ $artist->name }} </td>
					<td> {{ $artist->genre->name }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{{ $artists->links() }}

</div>

@stop