<?php

namespace App\Http\Livewire\Eligibility;

use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Check extends Component
{
    public $first_name, $last_name, $email, $dob, $gender, $employment, $income, $existing_emi, $mobile, $maxDate, $profile;

    public function mount(){
        $currentDateTime = Carbon::now();
        $this->maxDate = Carbon::now()->subYears(18)->format('Y-m-d');
        $this->income=0;
        $this->existing_emi=0;
        $this->mobile=session('mobile');

        $this->profile = \App\Models\Profile::firstOrNew([
            'mobile' => $this->mobile
        ]);
        $this->first_name = $this->profile->first_name;
        $this->last_name = $this->profile->last_name;
        $this->email = $this->profile->email;
        $this->dob = $this->profile->dob;
        $this->gender = $this->profile->gender;
        $this->employment = $this->profile->employment;
        $this->income = $this->profile->income;
        $this->existing_emi = $this->profile->existing_emi;
    }
    protected $rules = [
        "first_name"=>"required",
        "last_name"=>"required",
        "email"=>"required|email",
        "dob"=>"required|date|before:-18 years",
        "gender"=>"required",
        "employment"=>"required",
        "income"=>"required",
        "existing_emi"=>"required",
    ];
    public function check(){
        $validated = $this->validate();
        $this->profile->first_name=$validated['first_name'];
        $this->profile->last_name=$validated['last_name'];
        $this->profile->email=$validated['email'];
        $this->profile->dob=$validated['dob'];
        $this->profile->gender=$validated['gender'];
        $this->profile->employment=$validated['employment'];
        $this->profile->income=$validated['income'];
        $this->profile->existing_emi=$validated['existing_emi'];
        $this->profile->save();
        return redirect()->to('offers');
    }
    public function exit(Request $request){
        $request->session()->forget('mobile');
        return redirect()->to('/');
    }
    public function render()
    {
        return view('livewire.eligibility.check');
    }
}
