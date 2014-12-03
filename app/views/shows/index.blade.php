@extends('master')

@section('content')

<div id="page-wrapper">
	<div class="page-header">
		<h1>Events</h1>
	</div>

	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
		<thead>
			<th>Name</th>
			<th>Date</th>
			<th>Location</th>
			<th>Artist</th>
			<th>Description</th>
		</thead>
		<tbody>
			@foreach($shows as $show)
				<tr>
					<td> {{ $show->name }} </td>
					<td> {{ $show->when }} </td>
					<td> @if($show->hostedAt)
							{{ $show->hostedAt->name }} 
						@endif
					</td>
					<td> @if($show->artist)
						{{ $show->artist->name }}
						@endif
					</td>
					<td> {{ $show->description }} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{{ $shows->links() }}
</div>
@stop