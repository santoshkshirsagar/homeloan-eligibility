@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-5">Eligibility offers</h1>

        <!-- <table class="table table-bordered">
            <tr>
                <th>Bank</th>
                <th>Rate</th>
                <th>Eligibile Amount</th>
            </tr>
            
        </table> -->
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
            <!-- <tr>
                <td>{{ $bank->name }}</td>
                <td>{{ $bank->interest_rate }}%</td>
                <td>
                    @if($eligibility>0)
                        Rs. {{ number_format($eligibility) }} <br/>
                        <a href="" class="btn btn-primary btn-sm">
                            Apply Now   
                        </a>
                    @else
                        <span class="text-danger">Not Eligibile</span>
                    @endif
                </td>
            </tr> -->
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4 text-center">
                        <div class="card-body">
                            <h4>{{ $bank->name }}</h4>
                            <!-- <img src="..." class="img-fluid rounded-start" alt="..."> -->
                        </div>
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">Rs. {{ number_format($eligibility) }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $bank->interest_rate }}% per annum</h6>
                        <form action="{{ route('apply') }}" method="POST">
                            @csrf
                            <input type="hidden" name="bank_id" value="{{ $bank->id }}">
                            <input type="hidden" name="interest_rate" value="{{ $bank->interest_rate }}">
                            <input type="hidden" name="amount" value="{{ $eligibility }}">
                            <input type="hidden" name="years" value="{{ (60-$age) }}">
                            <button type="submit" class="btn btn-sm btn-primary">Apply Now</button>
                        </form>
                    </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>
@endsection
