@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users</div>

                <div class="card-body">

                <table border="1">
                	<thead>
                		<tr>
                			<th>Name</th>
                			<th>Email</th>
                			<th>Action</th>
                		</tr>
                	</thead>
                	<tbody>
                		
                     @foreach($users as $user)
                     	<tr>
                     		
                    	<td>{{ $user->name }}</td>
                    	<td>{{ $user->email }}</td>
                    	<td><a href="{{ URL::to('users/' . $user->id) }}">View</a></td>
                    	<td><a href="{{ URL::to('users/' . $user->id . '/edit') }}">Edit</a></td>
                     	</tr>
                    @endforeach 
                	</tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
