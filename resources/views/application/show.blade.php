@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Eligibility offers</h1>

        @foreach($banks as $bank)
            <?php
            //age calculation
            $from = new DateTime($application->dob);
            $to   = new DateTime('today');
            $from->format('d-m-Y');
            $age = $from->diff($to)->y;

            $capacity = $application->income - ((40*$application->income)/100) - $application->existing_emi;
            $principalAmount = 100000;
            $ratePerAnnum = $bank->interest_rate;
            $rateOfInterest = $ratePerAnnum/12/100;
            $numberInstallments = (60-$age)*12;
            $emi = ($principalAmount * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            $eligibility= floor(($capacity/$emi)*100000);

            $loanemi = ($eligibility * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            ?>
            <div class="card mb-3">
                <div class="card-header">
                    {{ $bank->name }}
                </div>
                <div class="card-body">
                    @if($eligibility>0)
                        Eligibile Amount : {{ $eligibility }}
                        EMI : {{ floor($loanemi) }} for {{ (60-$age) }} years
                    @else
                        <p class="text-danger">Not Eligibile</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
