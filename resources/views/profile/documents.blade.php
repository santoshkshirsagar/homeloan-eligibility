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
                                <option>Electricity Bill</option>
                                <option>Water Bill</option>
                                <option>Telephone Bill</option>
                                <option>Valid Passport</option>
                                <option>Aadhaar Card</option>
                                <option>Driving License</option>
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
                <div class="border p-3">
                    <b>Income Tax Returns for the last 3 years</b>
                    <div class="mb-3">
                        <label for="itr1">Income Tax Return 1</label>
                        <input type="file" name="itr1" id="itr1" class="form-control">
                        @error('itr1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="itr2">Income Tax Return 2</label>
                        <input type="file" name="itr2" id="itr2" class="form-control">
                        @error('itr2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="itr3">Income Tax Return 3</label>
                        <input type="file" name="itr3" id="itr3" class="form-control">
                        @error('itr3')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="qualificationCertificate">Certificate of Qualification (for Doctors/CA and other professionals)</label>
                    <input type="file" name="qualificationCertificate" id="qualificationCertificate" class="form-control">
                        @error('qualificationCertificate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="border p-3">
                    <b>Balance Sheet audited by a certified CA and Profit and Loss account for the previous 3 years</b>
                    <div class="mb-3">
                        <label for="balanceSheet1">Balance Sheet 1</label>
                        <input type="file" name="balanceSheet1" id="balanceSheet1" class="form-control">
                        @error('balanceSheet1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="balanceSheet2">Balance Sheet 2</label>
                        <input type="file" name="balanceSheet2" id="balanceSheet2" class="form-control">
                        @error('balanceSheet2')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="balanceSheet3">Balance Sheet 3</label>
                        <input type="file" name="balanceSheet3" id="balanceSheet3" class="form-control">
                        @error('balanceSheet3')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="businessLicence">Business License Details</label>
                    <input type="file" name="businessLicence" id="businessLicence" class="form-control">
                    @error('businessLicence')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="businessAddress">Business address proof</label>
                    <input type="file" name="businessAddress" id="businessAddress" class="form-control">
                    @error('businessAddress')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="businessTDS">TDS Certificate</label>
                    <input type="file" name="businessTDS" id="businessTDS" class="form-control">
                    @error('businessTDS')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            @else
                <b>Salary Slips for last 3 months</b>
                <div class="mb-3">
                    <label for="salary_slip1">Salary Slip 1</label>
                    <input type="file" name="salary_slip1" id="salary_slip1" class="form-control">
                            @error('salary_slip1')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <div class="mb-3">
                    <label for="salary_slip2">Salary Slip 2</label>
                    <input type="file" name="salary_slip2" id="salary_slip2" class="form-control">
                            @error('salary_slip2')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <div class="mb-3">
                    <label for="salary_slip3">Salary Slip 3</label>
                    <input type="file" name="salary_slip3" id="salary_slip3" class="form-control">
                            @error('salary_slip3')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <div class="border-top my-2"></div>
                <b>Income tax return</b>
                <div class="mb-3">
                    <label for="form16">Form 16</label>
                    <input type="file" name="form16" id="form16" class="form-control">
                            @error('form16')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                </div>
                <b>OR</b>
                <div class="mb-3">
                    <label for="itr1">Current/Recent year Income Tax Returns</label>
                    <input type="file" name="itr1" id="itr1" class="form-control">
                        @error('itr1')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                </div>
                <div class="mb-3">
                    <label for="itr2">Previous year Income Tax Returns</label>
                    <input type="file" name="itr2" id="itr2" class="form-control">
                        @error('itr2')
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