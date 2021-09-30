@extends('layouts.admin')

@section('content')
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

            @if($application->coapplicant)
            <h5>Co Applicant Details</h5>
            <?php 
                $coProfile = json_decode($application->coapplicant_info);
            ?>
            <table class="table table-bordered">
                <tr>
                    <td>Gender</td>
                    <td>{{ $coProfile->gender }}</td>
                </tr>
                <tr>
                    <td>Date of Birth</td>
                    <td>{{ $coProfile->dob }}</td>
                </tr>
                <tr>
                    <td>Employment</td>
                    <td>{{ $coProfile->employment }}</td>
                </tr>
                <tr>
                    <td>Income</td>
                    <td>{{ $coProfile->income }}</td>
                </tr>
                <tr>
                    <td>Existing EMI</td>
                    <td>{{ $coProfile->existing_emi }}</td>
                </tr>
            </table>
            @endif
            @if($application->documents)
            <h5>Documents</h5>
            <?php $docs = json_decode($application->documents) ?>
            <table class="table table-bordered">
                <tr>
                    <td>Identity Proof</td>
                    <td>
                        {{ $docs->identity_type }}
                        <a target="_blank" href="{{ asset('storage/'.$docs->identity_file) }}">View</a>
                    </td>
                </tr>
                <tr>
                    <td>Residence Proof</td>
                    <td>
                        {{ $docs->residence_proof_type }}
                        <a target="_blank" href="{{ asset('storage/'.$docs->residence_proof) }}">View</a>
                    </td>
                </tr>
                @if($application->employment=="business")
                    <tr>
                        <td>Income Tax Return 1</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->itr1) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Income Tax Return 2</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->itr2) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Income Tax Return 3</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->itr3) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Certificate of Qualification (for Doctors/CA and other professionals)</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->qualificationCertificate) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Balance Sheet 1</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->balanceSheet1) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Balance Sheet 2</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->balanceSheet2) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Balance Sheet 3</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->balanceSheet3) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Business License Details</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->businessLicence) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>Business address proof</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->businessAddress) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>TDS Certificate</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->businessTDS) }}">View</a></td>
                    </tr>
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
                    @if(isset($docs->form16))
                    <tr>
                        <td>Form 16</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->form16) }}">View</a></td>
                    </tr>
                    @else
                    <tr>
                        <td>ITR 1</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->itr1) }}">View</a></td>
                    </tr>
                    <tr>
                        <td>ITR 2</td>
                        <td><a target="_blank" href="{{ asset('storage/'.$docs->itr2) }}">View</a></td>
                    </tr>
                    @endif
                @endif
            </table>

            <button class="btn btn-primary">Send to Bank</button>
            @endif
        </div>
    </div>
@endsection
