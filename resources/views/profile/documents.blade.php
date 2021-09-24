@extends('layouts.app')

@section('content')
    <div class="container mb-5">
        <form action="{{ route('apply.submit', ['application'=>$application->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
        <h5 class="my-3">Complete your application</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identity_type">Select Identity proof</label>
                    <select name="identity_type" id="identity_type" class="form-control">
                        <option value="">Select</option>    
                        <option>Driving License</option>
                        <option>PAN</option>
                        <option>Voter Id</option>
                        <option>Valid Passport</option>
                    </select>
                    @error('identity_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identity_file">Upload Identity File</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                    @error('identity_file')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        
            <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="residence_proof_type">Residence proof</label>
                            <select name="residence_proof_type" id="residence_proof_type" class="form-control">
                                <option value="">Select</option> 
                                <option value="">Copy of Electricity Bill/Water Bill/Telephone Bill</option>
                                <option value="">Copy of valid Passport/Aadhaar Card/Driving License</option>
                            </select>
                            @error('residence_proof_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="residence_proof">Upload Residence Proof File</label>
                            <input type="file" name="residence_proof" id="residence_proof" class="form-control">
                            @error('residence_proof')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
        <h5>Income proof documents</h5>
        <div class="row">
            <div class="col-md-6">
            @if($application->employment=="business")
                <div class="mb-3">
                    <label for="identity_file">Income Tax Returns for the last 3 years</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="identity_file">Certificate of Qualification (for Doctors/CA and other professionals)</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="identity_file">Balance Sheet audited by a certified CA and Profit and Loss account for the previous 3 years</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="identity_file">Business License Details</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="identity_file">Business address proof</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="identity_file">TDS Certificate</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
            @else
                <div class="mb-3">
                    <label for="salary_slips">Salary Slips for the last three months</label>
                    <input type="file" name="salary_slips" id="salary_slips" class="form-control">
                            @error('salary_slips')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <div class="mb-3">
                    <label for="form_16">Copy of Form 16 or Income Tax Returns for the last two years</label>
                    <input type="file" name="form_16" id="form_16" class="form-control">
                            @error('form_16')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
            @endif
            </div>
        </div>
        <input type="submit" value="Submit" class="btn btn-sm btn-primary">
        </form>
    </div>
@endsection