<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Otp extends Component
{
    public $mobile;

    public function mount(){
        if(session('mobile')){
            return redirect()->to(route('form'));
        }
    }
    protected $rules=[
        "mobile"=>"required|regex:/[0-9]{10}/"
    ];
    public function submit()
    {
        $this->validate();
        session(['mobile' => $this->mobile]);
        return redirect()->to(route('form'));
    }
    public function render()
    {
        return view('livewire.otp');
    }
}
