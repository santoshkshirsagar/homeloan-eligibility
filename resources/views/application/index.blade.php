@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('application.create') }}" class="btn btn-primary float-end">Add</a>
            <h1>Applications</h1>
            <table class="table table-responsive table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->first_name }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->status }}</td>
                        <td>
                            <a href="{{ route('application.show',['application'=>$application->id]) }}">View</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $applications->links() }}
        </div>
    </div>
@endsection
