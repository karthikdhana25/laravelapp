@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Tickets</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('tickets.create') }}"> Create New Ticket</a>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Category</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
    @foreach ($tickets as $ticket)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $ticket->title}}</td>
        <td>{{ $ticket->category}}</td>
        <td>{{ $ticket->description}}</td>
        <td>
            <a class="btn btn-info" href="{{ route('tickets.show',$ticket->id) }}">Show</a>
            <a class="btn btn-primary" href="{{ route('tickets.edit',$ticket->id) }}">Edit</a>
            {!! Form::open(['method' => 'DELETE','route' => ['tickets.destroy', $ticket->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
    </table>
    {!! $tickets->render() !!}
@endsection