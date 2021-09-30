@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Edit</h1>
            <form action="{{ route('bank.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    @error('email')
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
                <div class="mb-3">
                    <label for="max_age_limit">Upper Age Limit</label>
                    <input type="text" name="max_age_limit" id="max_age_limit" value="{{ old('max_age_limit') }}" class="form-control">
                    @error('max_age_limit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Save" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
