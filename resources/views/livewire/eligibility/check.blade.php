<div>
        <form wire:submit.prevent="check">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <div class="card-header">
                            Personal Details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                    <label for="mobile">Mobile <a wire:click="exit" class="text-info">Change</a></label>
                                    <input wire:model="mobile" type="text" class="form-control" disabled>
                                    @error('mobile')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>


                            <div class="row g-3 mb-3">
                                <div class="col">
                                    <label for="first_name">First Name</label>
                                    <input wire:model="first_name" type="text" class="form-control" value="{{ old('first_name') }}" >
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="last_name">Last Name</label>
                                    <input wire:model="last_name" type="text" class="form-control" value="{{ old('last_name') }}" >
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input type="text" wire:model="email" class="form-control">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" wire:model="dob" class="form-control"  max="{{ $maxDate }}">
                                    @error('dob')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            
                            <div class="mb-3">
                                <label for="gender">Gender</label><br/>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="gender" id="Male" value="male">
                                    <label class="form-check-label" for="Male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="gender" id="Female" value="female">
                                    <label class="form-check-label" for="Female">Female</label>
                                </div>
                                    @error('gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" wire:model="coapplicant" id="coapplicant">
                                <label class="form-check-label" for="coapplicant">
                                Do You Wish To Add Co-Applicants While Applying For This Loan?
                                <small class="text-muted">( All owners / proposed owners of the property have to be applicant to the loan. )</small>
                                </label>
                            </div>

                        </div>
                    </div>

                    @if($coapplicant)
                    <div class="card">
                        <div class="card-header">
                        Co-applicant details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="coapplicant_info">Co-applicant Gender</label><br/>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="coapplicant_info.gender" id="coMale" value="male">
                                    <label class="form-check-label" for="coMale">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="coapplicant_info.gender" id="coFemale" value="female">
                                    <label class="form-check-label" for="coFemale">Female</label>
                                </div>
                                    @error('coapplicant_info.gender')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="dob">Date of Birth</label>
                                <input type="date" wire:model="coapplicant_info.dob" class="form-control"  max="{{ $maxDate }}">
                                    @error('coapplicant_info.dob')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
                <div class="col-md-6">
                    
                    <div class="card mb-3">
                        <div class="card-header">
                            Employment/Income Details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="employment" id="salaried" value="salaried">
                                    <label class="form-check-label" for="salaried">Salaried</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="employment" id="business" value="business">
                                    <label class="form-check-label" for="business">Business</label>
                                </div>
                                    @error('employment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <div class="float-end">
                                    <input type="text" id="income" wire:model="income" class="form-control text-end" value="0">
                                </div>
                                <label for="income-range" class="form-label">Monthly Income</label>
                                <input type="range" class="form-range" min="0" max="500000" wire:model="income" id="income-range" value="0" oninput="document.getElementById('income').value=this.value">
                                    @error('income')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <div class="float-end">
                                    <input type="text" id="emi" wire:model="existing_emi" class="form-control text-end" value="0">
                                </div>
                                <label for="emi-range" class="form-label">Existing EMI </label>
                                <input wire:model="existing_emi" type="range" class="form-range" min="0" max="500000" id="emi-range" value="0" oninput="document.getElementById('emi').value=this.value">
                                <!-- oninput="document.getElementById('emi').value=this.value" -->
                                    @error('existing_emi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <div class="float-end">
                                    {{ $tenure }}
                                </div>
                                <label for="tenure-range" class="form-label">Tenure in Years </label>
                                <input wire:model="tenure" type="range" class="form-range" min="0" max="{{ $maxTenure }}" id="tenure-range" value="0" oninput="document.getElementById('tenure_year').value=this.value">
                                    @error('tenure')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            
                        </div>
                    </div>

                    @if($coapplicant)

                    <div class="card mb-3">
                        <div class="card-header">
                            Co-Applicant Employment/Income Details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="coapplicant_info.employment" id="csalaried" value="salaried">
                                    <label class="form-check-label" for="csalaried">Salaried</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" wire:model="coapplicant_info.employment" id="cbusiness" value="business">
                                    <label class="form-check-label" for="cbusiness">Business</label>
                                </div>
                                    @error('coapplicant_info.employment')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <div class="float-end">
                                    <input type="text" id="cincome" wire:model="coapplicant_info.income" class="form-control text-end" value="0">
                                </div>
                                <label for="cincome-range" class="form-label">Monthly Income</label>
                                <input type="range" class="form-range" min="0" max="500000" wire:model="coapplicant_info.income" id="cincome-range" value="0" oninput="document.getElementById('cincome').value=this.value">
                                    @error('coapplicant_info.income')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>

                            <div class="mb-3">
                                <div class="float-end">
                                    <input type="text" id="cemi" wire:model="coapplicant_info.existing_emi" class="form-control text-end" value="0">
                                </div>
                                <label for="emi-range" class="form-label">Existing EMI </label>
                                <input wire:model="coapplicant_info.existing_emi" type="range" class="form-range" min="0" max="500000" id="cemi-range" value="0" oninput="document.getElementById('cemi').value=this.value">
                                <!-- oninput="document.getElementById('emi').value=this.value" -->
                                    @error('coapplicant_info.existing_emi')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                        </div>
                    </div>

                    @endif

                    <div class="card mb-3">
                        <div class="card-header">
                            Property Details
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="">Property Price <small class="text-muted">Leave blank if property not finalised</small></label>
                                <input class="form-control" type="text" wire:model="property_price">
                                    @error('property_price')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="mb-3">
                                <label for="">Required Loan Amount</label>
                                <input class="form-control" type="text" wire:model="required_amount">
                                    @error('required_amount')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" wire:model="first_home" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    This is my first home
                                </label>
                            </div>
                            <small class="text-muted">First home buyer might be eligible for Pradhan Mantri Awas Yojana (Urban)-PMAY (U). for more details visit <a target="_blank" href="https://pmaymis.gov.in/">https://pmaymis.gov.in/</a></small>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                        <button class="btn btn-primary w-100">Calculate Loan Eligibility</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>
