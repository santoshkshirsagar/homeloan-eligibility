@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mb-5">Check your Home Loan Eligibility</h1>
                        <div class="mb-3">
                            <label for="mobile">Enter Mobile Number</label>
                            <input type="text" maxlength="10" name="mobile" class="form-control">
                        </div>
                        <a href="{{ route('form') }}" class="btn btn-primary">Continue</a>
            </div>
            <div class="col-md-6 text-end">
                <img class="w-100" src="{{ asset('images/undraw_Home_settings_re_pkya.svg') }}" alt="">
            </div>
        </div>
        
        

    </div>
@endsection
