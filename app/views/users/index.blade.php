@extends('master')

@section('content')

<div id="page-wrapper">
	<div class="page-header">
		<h1>Users</h1>
	</div>

	<table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
		<thead>
			<th>Name</th>
			<th>Last Name</th>
			<th>Email Address</th>
			<th>Birthday</th>
			<th>Address</th>
			<th>City</th>
			<th>State</th>
			<th>Zip Code</th>
			<th>Phone number</th>
		</thead>
		<tbody>
			@foreach($users as $user)
				<tr>
					<td> {{ $user->f_name }} </td>
					<td> {{ $user->l_name }} </td>
					<td> {{ $user->email }} </td>
					<td> {{ $user->b_day}}</td>
					<td> {{ $user->address }} </td>
					<td> {{ $user->city}} </td>
					<td> {{ $user->state}} </td>
					<td> {{ $user->zip}} </td>
					<td> {{ $user->phone}} </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	
	{{ $users->links() }}
</div>

@stop