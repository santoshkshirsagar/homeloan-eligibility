@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{ route('form') }}" class="btn btn-sm btn-primary">Back</a>
        <h1 class="my-5">Eligibility offers</h1>
        
            @if($offerCount>0)
                <div class="text-center mb-3 shadow p-4">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:100px;" class="text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                    <h1>Congratulations</h1>
                    <h5>You have {{ $offerCount }} offers for your home loan</h5>
                </div>
            <table class="table table-bordered">
            <tr>
                <th>Bank</th>
                <th>Rate</th>
                <th>Eligibile Amount</th>
                <th>Years</th>
                <th>EMI</th>
            </tr>
                @foreach($banks as $bank)
                    <tr>
                        <td>
                            <h4>{{ $bank->name }}</h4>
                            <!-- <img src="..." class="img-fluid rounded-start" alt="..."> -->
                        </td>
                        <td>
                            {{ $bank->interest_rate }}% per annum
                        </td>
                        <td>
                                @if($eligibleAmount[$bank->id]>0)
                                <h5 class="card-title fs-3" style="color:#a6c938;">Rs. {{ number_format($eligibleAmount[$bank->id]) }}</h5>
                                <form action="{{ route('apply') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="bank_id" value="{{ $bank->id }}">
                                    <input type="hidden" name="interest_rate" value="{{ $bank->interest_rate }}">
                                    <input type="hidden" name="amount" value="{{ $eligibleAmount[$bank->id] }}">
                                    <input type="hidden" name="years" value="{{ $yearArr[$bank->id] }}">
                                    <button type="submit" class="ˀbtn btn-sm btn-primary">Apply Now</button>
                                </form>
                                @else
                                    <span class="text-danger">Not Eligible</span>
                                @endif
                        </td>
                        <td>
                            @livewire('profile.tenure',['tenure'=>$yearArr[$bank->id]])
                        </td>
                        <td>
                            {{ floor($loanemi) }}
                        </td>
                    </tr>

                @endforeach

            @else
                <div class="text-center mb-3 shadow p-4">
                    <h1>Oops!</h1>
                    <h5>You are not eligible for home loan</h5>
                    @if(!$profile->coapplicant)
                        <p class="text-info">You might add co-applicant to get home loan</p>
                    @endif
                </div>
            @endif
        </div>

        

    </div>
@endsection
