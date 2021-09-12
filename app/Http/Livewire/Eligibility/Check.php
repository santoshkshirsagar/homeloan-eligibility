<?php

namespace App\Http\Livewire\Eligibility;

use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;

class Check extends Component
{
    public $first_name, $last_name, $email, $dob, $gender, $employment, $income, $existing_emi, $mobile, $maxDate;

    public function mount(){
        
        $currentDateTime = Carbon::now();

        $this->maxDate = Carbon::now()->subYears(18)->format('Y-m-d');

        $this->income=0;
        $this->existing_emi=0;
        $this->mobile=session('mobile');
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
        $this->validate();
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
