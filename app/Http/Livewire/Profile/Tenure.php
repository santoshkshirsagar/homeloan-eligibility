<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;
use DateTime;
class Tenure extends Component
{
    public $profile, $tenure, $edit=false, $maxTenure;


    public function mount(){
        $this->mobile=session('mobile');
        $this->profile = \App\Models\Profile::firstOrNew([
            'mobile' => $this->mobile
        ]);
        
        $from = new DateTime($this->profile->dob);
        $to   = new DateTime('today');
        $from->format('d-m-Y');
        $age = $from->diff($to)->y;
        $years = 60 - $age;
            if($years>30){
                $years=30;
            }
            if($this->profile->employment=="business" && $years>20){
                $years=20;
            }
        $this->maxTenure=$years;
        if($this->tenure>$this->maxTenure){
            $this->tenure=$this->maxTenure;
        }
    }
    public function editTenure(){
        $this->edit=true;
    }
    public function save(){
        $this->validate([
            "tenure"=>"required|numeric|max:".$this->maxTenure,
        ]);
        $this->profile->tenure=$this->tenure;
        $this->profile->save();
        return redirect()->to('/offers');
    }
    public function render()
    {
        return view('livewire.profile.tenure');
    }
}
