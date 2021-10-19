<?php

namespace App\Http\Livewire\Eligibility;

use Livewire\Component;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
class Check extends Component
{
    public $first_name, $last_name, $email, $dob, $gender, $employment, $income, $existing_emi, $mobile, $maxDate, $profile, $property_price, $required_amount, $first_home, $coapplicant, $coapplicant_info, $tenure, $maxTenure=30;

    public function mount(){
        $count = \App\Models\Application::where('mobile',session('mobile'))->where('status','pending')->count();
        if($count>0){
            return redirect()->to(route('profile.applications'));
        }
        $currentDateTime = Carbon::now();
        $this->maxDate = Carbon::now()->subYears(18)->format('Y-m-d');
        $this->income=0;
        $this->existing_emi=0;
        $this->tenure=$this->maxTenure;
        $this->mobile=session('mobile');

        $this->coapplicant_info['income']=0;
        $this->coapplicant_info['existing_emi']=0;

        $this->profile = \App\Models\Profile::firstOrNew([
            'mobile' => $this->mobile
        ]);
        $this->first_name = $this->profile->first_name;
        $this->last_name = $this->profile->last_name;
        $this->email = $this->profile->email;
        $this->dob = $this->profile->dob;
        $this->gender = $this->profile->gender;
        $this->employment = $this->profile->employment;
        if($this->profile->income){
            $this->income = $this->profile->income;
            $this->existing_emi = $this->profile->existing_emi;
        }
        $this->tenure = $this->profile->tenure;
        $this->property_price = $this->profile->property_price;
        $this->required_amount = $this->profile->required_amount; 
        $this->first_home = $this->profile->first_home;

        $this->updatedDob();
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
        "property_price"=>"nullable|numeric",
        "required_amount"=>"nullable|numeric",
        "tenure"=>"nullable|numeric",
        "first_home"=>"nullable|boolean",
        "coapplicant"=>"nullable|boolean",
        "coapplicant_info.gender"=>"required_with:coapplicant",
        "coapplicant_info.dob"=>"required_with:coapplicant|date|before:-18 years",
        "coapplicant_info.employment"=>"required_with:coapplicant",
        "coapplicant_info.income"=>"required_with:coapplicant",
        "coapplicant_info.existing_emi"=>"required_with:coapplicant",
    ];

    function updatedDob()
    {
        $from = new DateTime($this->dob);
        $to   = new DateTime('today');
        $from->format('d-m-Y');
        $age = $from->diff($to)->y;
        $years = 60 - $age;
            if($years>30){
                $years=30;
            }
            if($this->employment=="business" && $years>20){
                $years=20;
            }
        $this->maxTenure=$years;
        if($this->tenure>$this->maxTenure){
            $this->tenure=$this->maxTenure;
        }
    }
    function updatedEmployment(){
        $this->updatedDob();
    }

    function updatedCoapplicant(){
        if(!$this->coapplicant){ 
            $this->coapplicant=null; 
        }
    }
    public function check(){
        $validated = $this->validate();
        //$validated['mobile']=$this->mobile;
        $this->profile->mobile=$this->mobile;
        $this->profile->first_name=$validated['first_name'];
        $this->profile->last_name=$validated['last_name'];
        $this->profile->email=$validated['email'];
        $this->profile->dob=$validated['dob'];
        $this->profile->gender=$validated['gender'];
        $this->profile->employment=$validated['employment'];
        $this->profile->income=$validated['income'];
        $this->profile->existing_emi=$validated['existing_emi'];
        $this->profile->property_price= ($validated['property_price']=="") ? 0 : $validated['property_price'];
        $this->profile->required_amount=($validated['required_amount']=="") ? 0 : $validated['required_amount'];
        $this->profile->tenure=$validated['tenure'];
        $this->profile->first_home=$validated['first_home'];
        $this->profile->coapplicant=$validated['coapplicant'];
        $this->profile->coapplicant_info=json_encode($validated['coapplicant_info']);
        $this->profile->save();
        //$this->profile->update($validated);
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
