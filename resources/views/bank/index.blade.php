@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <a href="{{ route('bank.create') }}" class="btn btn-primary float-end">Add</a>
            <h1>Banks</h1>
            <table class="table table-responsive table-striped">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Rate</th>
                    <th>Action</th>
                </tr>
                @foreach($banks as $bank)
                    <tr>
                        <td>{{ $bank->id }}</td>
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->interest_rate }}</td>
                        <td>
                            <a href="{{ route('bank.edit',['bank'=>$bank->id]) }}">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $banks->links() }}
        </div>
    </div>
@endsection
