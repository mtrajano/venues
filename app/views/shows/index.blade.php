@extends('master')

@section('content')

<div id="page-wrapper">
	<div class="page-header">
		<h1>Events</h1>
	</div>

	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
		<thead>
			<th>Date</th>
			<th>Artist</th>
			<th>City</th>
			<th>State</th>
		</thead>
		<tbody>
			@foreach($shows as $show)
				<tr>
					<td> {{ $show->when }} </td>
					<td> 
						@if($show->artist)
							{{ $show->artist->name }}
						@endif
					</td>
					<td> 
						@if($show->hostedAt)
							{{ $show->hostedAt->city }} 
						@endif
					</td>
					<td> 
						@if($show->hostedAt)
							{{ $show->hostedAt->state }} 
						@endif
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{{ $shows->links() }}
</div>
@stop