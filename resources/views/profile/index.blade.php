@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Profiles</h1>
            <table class="table table-responsive table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>DOB</th>
                </tr>
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->first_name }}</td>
                        <td>{{ $profile->email }}</td>
                        <td>{{ $profile->mobile }}</td>
                        <td>{{ $profile->dob }}</td>
                    </tr>
                @endforeach
            </table>
            {{ $profiles->links() }}
        </div>
    </div>
@endsection
