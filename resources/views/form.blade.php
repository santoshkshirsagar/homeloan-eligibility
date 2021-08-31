@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Personal Details
                    </div>
                    <div class="card-body">

                        <div class="row g-3 mb-3">
                            <div class="col">
                            <label for="firstname">First Name</label>
                                <input type="text" class="form-control" >
                            </div>
                            <div class="col">
                            <label for="lastname">Last Name</label>
                                <input type="text" class="form-control" >
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dob">Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>

                        
                        <div class="mb-3">
                            <label for="gender">Gender</label><br/>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="Male" value="option1">
                                <label class="form-check-label" for="Male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="Female" value="option2">
                                <label class="form-check-label" for="Female">Female</label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                
                <div class="card mb-3">
                    <div class="card-header">
                        Employment/Income Details
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employment" id="salaried" value="option1">
                                <label class="form-check-label" for="salaried">Salaried</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="employment" id="business" value="option2">
                                <label class="form-check-label" for="business">Business</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="float-end">
                                <input type="text" id="income" class="form-control text-end" value="0">
                            </div>
                            <label for="income-range" class="form-label">Monthly Income</label>
                            <input type="range" class="form-range" min="0" max="500000" id="income-range" value="0" oninput="document.getElementById('income').value=this.value">
                        </div>

                        <div class="mb-3">
                            <div class="float-end">
                                <input type="text" id="emi" class="form-control text-end" value="0">
                            </div>
                            <label for="emi-range" class="form-label">Existing EMI </label>
                            <input type="range" class="form-range" min="0" max="500000" id="emi-range" value="0" oninput="document.getElementById('emi').value=this.value">
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        
                    <button class="btn btn-primary w-100">Calculate Loan Eligibility</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection