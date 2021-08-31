@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <h1>Edit</h1>
            <form action="{{ route('user.update',['user'=>$user->id]) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <input type="submit" value="Save" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
