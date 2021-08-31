@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Edit</h1>
            <form action="{{ route('application.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="interest_rate">Interest_rate</label>
                    <input type="text" name="interest_rate" id="interest_rate" value="{{ old('interest_rate') }}" class="form-control">
                    @error('interest_rate')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Save" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
