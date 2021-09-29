@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Your Applications</h1>
        <table class="table table-bordered">
            <tr>
                <th>Date</th>
                <th>Bank</th>
                <th>Amount</th>
                <th>Status</th>
            </tr>
            @foreach($applications as $application)
                <tr>
                    <td>{{ $application->created_at->format('d-m-Y') }}</td>
                    <td>{{ $application->bank->name }}</td>
                    <td>{{ $application->amount }}</td>
                    <td>{{ $application->status }}
                    @if($application->status=='pending')
                        <a href="{{ route('apply.documents',['application'=>$application->id]) }}" class="btn btn-sm btn-primary">
                            Complete
                        </a>
                        <a href="{{ route('apply.cancel',['application'=>$application->id]) }}" class="btn btn-sm btn-danger">
                            Cancel
                        </a>
                    @endif
                    <a class="btn btn-sm btn-info" href="{{ route('profile.applications.view',['application'=>$application->id]) }}">View</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection