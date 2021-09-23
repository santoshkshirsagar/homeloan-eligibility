@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
            <h1>Welcome</h1>
            <div class="card my-4" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title">{{ $applicationCount }}</h3>
                    <h6 class="card-subtitle mb-2 text-muted"> Total Applications</h6>
                    <a href="{{ route('application.index')}}" class="card-link">View</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
