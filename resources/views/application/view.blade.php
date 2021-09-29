@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Application</h1>

            <table class="table table-bordered my-3">
                <tr>
                    <td>Status</td>
                    <td>{{ $application->status }}</td>
                </tr>
                <tr>
                    <td>Mobile</td>
                    <td>{{ $application->mobile }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $application->first_name }} {{ $application->last_name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $application->email }}</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>{{ $application->dob }}</td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>{{ $application->gender }}</td>
                </tr>
                <tr>
                    <td>Employment</td>
                    <td>{{ $application->employment }}</td>
                </tr>
                <tr>
                    <td>Income</td>
                    <td>{{ $application->income }}</td>
                </tr>
                <tr>
                    <td>Existing EMI</td>
                    <td>{{ $application->existing_emi }}</td>
                </tr>
                <tr>
                    <td>Property Price</td>
                    <td>{{ $application->property_price }}</td>
                </tr>
                <tr>
                    <td>Required Amount</td>
                    <td>{{ $application->required_amount }}</td>
                </tr>
                <tr>
                    <td>First Home</td>
                    <td> @if($application->first_home) Yes @else No @endif </td>
                </tr>
            </table>

            @if($application->documents)
            <h5>Documents</h5>
            <?php $docs = json_decode($application->documents) ?>
            <table class="table table-bordered">
                <tr>
                    <td>identity Proof</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Residence Proof</td>
                    <td></td>
                </tr>
                @if($application->employment=="business")

                @else
                <tr>
                    <td>Salary Slip 1</td>
                    <td><a target="_blank" href="{{ asset('storage/'.$docs->salary_slip1) }}">View</a></td>
                </tr>
                <tr>
                    <td>Salary Slip 2</td>
                    <td><a target="_blank" href="{{ asset('storage/'.$docs->salary_slip2) }}">View</a></td>
                </tr>
                <tr>
                    <td>Salary Slip 3</td>
                    <td><a target="_blank" href="{{ asset('storage/'.$docs->salary_slip3) }}">View</a></td>
                </tr>
                <tr>
                    <td>ITR 1</td>
                    <td><a target="_blank" href="{{ asset('storage/'.$docs->itr1) }}">View</a></td>
                </tr>
                <tr>
                    <td>ITR 2</td>
                    <td><a target="_blank" href="{{ asset('storage/'.$docs->itr2) }}">View</a></td>
                </tr>
                @endif
            </table>
            @endif

        </div>
    </div>
</div>
@endsection
