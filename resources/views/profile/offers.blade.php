@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Eligibility offers</h1>

        <table class="table table-bordered">
            <tr>
                <th></th>
                <th>Bank</th>
                <th>Rate</th>
                <th>Eligibile Amount</th>
            </tr>
        @foreach($banks as $bank)
            <?php
            //age calculation
            $from = new DateTime($profile->dob);
            $to   = new DateTime('today');
            $from->format('d-m-Y');
            $age = $from->diff($to)->y;

            $capacity = $profile->income - ((40*$profile->income)/100) - $profile->existing_emi;
            $principalAmount = 100000;
            $ratePerAnnum = $bank->interest_rate;
            $rateOfInterest = $ratePerAnnum/12/100;
            $numberInstallments = (60-$age)*12;
            $emi = ($principalAmount * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            $eligibility= floor(($capacity/$emi)*100000);

            $loanemi = ($eligibility * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            ?>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $bank->id }}" name="banks[]">
                    </div>
                </td>
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->interest_rate }}%</td>
                <td>
                    @if($eligibility>0)
                        {{ number_format($eligibility) }} 
                    @else
                        <span class="text-danger">Not Eligibile</span>
                    @endif
                </td>
            </tr>
        @endforeach
        </table>

        <div class="row my-5 border-top py-5">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="identity_type">Select Identity proof</label>
                    <select name="identity_type" id="identity_type" class="form-control">
                        <option value="">Driving License</option>
                        <option value="">PAN</option>
                        <option value="">Voter Id</option>
                        <option value="">Valid Passport</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="identity_file">Upload Identity File</label>
                    <input type="file" name="identity_file" id="identity_file" class="form-control">
                </div>
            </div>
        </div>
    </div>
@endsection
