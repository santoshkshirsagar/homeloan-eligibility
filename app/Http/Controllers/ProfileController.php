<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Application;
use DateTime;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */

    public function show(Profile $profile)
    {
        //
    }

    public function applicationview(\App\Models\Application $application){
        return view('application.view',compact('application'));
    }

    public function offers()
    {
        $profile = Profile::where('mobile',session('mobile'))->firstOrFail();
        $banks = \App\Models\Bank::get();
        $offerCount=0;
        $eligibleAmount=array();
        $yearArr=array();
        foreach($banks as $bank){
            //age calculation
            $from = new DateTime($profile->dob);
            $to   = new DateTime('today');
            $from->format('d-m-Y');
            $age = $from->diff($to)->y;
            $years = $profile->tenure;
            /* if($years>30){
                $years=30;
            }
            if($profile->employment=="business" && $years>20){
                $years=20;
            } */

            $totalIncome = $profile->income;
            $totalEMI = $profile->existing_emi;
            if($profile->coapplicant){
                $coProfile = json_decode($profile->coapplicant_info);
                $totalIncome = $profile->income + $coProfile->income;
                $totalEMI = $profile->existing_emi + $coProfile->existing_emi;
            }

            $capacity = $totalIncome - ((40*$totalIncome)/100) - $totalEMI;
            $principalAmount = 100000;
            $ratePerAnnum = $bank->interest_rate;
            $rateOfInterest = $ratePerAnnum/12/100;
            $numberInstallments = ($years)*12;
            $emi = ($principalAmount * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            $eligibility= floor(($capacity/$emi)*100000);

            $loanemi = ($eligibility * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
            $eligibleAmount[$bank->id]=$eligibility;
            $yearArr[$bank->id]=$years;
            if($eligibility>$profile->required_amount){
                $offerCount+=1;
            }
        }
        $percent = 75;
        if($profile->property_price<7500000){
            $percent = 80;
        }
        if($profile->property_price<3000000){
            $percent = 90;
        }
        $maxLoanOnProperty=0;
        if($profile->property_price>0){
            $maxLoanOnProperty= floor($percent * $profile->property_price/100);
        }
        
        return view('profile.offers', compact('profile','banks','eligibleAmount','offerCount','yearArr', 'loanemi','maxLoanOnProperty'));
    }
    public function apply(Request $request)
    { 
        $profile = Profile::where('mobile',session('mobile'))->firstOrFail();
        $profileData = $profile->toArray();
        unset($profileData['created_at']);
        unset($profileData['updated_at']);
        unset($profileData['id']);
        $validated = $request->validate([
            "bank_id" => "required",
            "interest_rate" => "required",
            "amount" => "required",
            "years" => "required",
        ]);
        $data = array_merge($profileData,$validated);
        $application = Application::create($data);
        return redirect(route('apply.documents', ['application'=>$application->id]));
    }

    public function cancel(\App\Models\Application $application){
        $application->status="cancelled";
        $application->save();
        return redirect(route('profile.applications'))->with('alert-success','application cancelled successfully');
    }

    public function applications()
    {
        $applications = \App\Models\Application::where('mobile',session('mobile'))->paginate(10);
        return view('profile.applications', compact('applications'));
    }

    public function documents(Application $application)
    {
        return view('profile.documents', compact('application'));
    }
    public function submit(Request $request, Application $application)
    {
        $rules= array(
            "identity_type"=> "required",
            "identity_file"=> "required|mimes:jpeg,bmp,png,pdf|max:2000",
            "residence_proof_type" => "required",
            "residence_proof" => "required|mimes:jpeg,bmp,png,pdf",
        );
        if($application->employment=="business"){
            $rules['itr1']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['itr2']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['itr3']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['qualificationCertificate']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['balanceSheet1']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['balanceSheet2']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['balanceSheet3']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['businessLicence']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['businessAddress']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['businessTDS']="required_without:form16|mimes:jpeg,bmp,png,pdf";            
        }else{
            $rules['salary_slip1']="required|mimes:jpeg,bmp,png,pdf";
            $rules['salary_slip2']="required|mimes:jpeg,bmp,png,pdf";
            $rules['salary_slip3']="required|mimes:jpeg,bmp,png,pdf";
            $rules['form16']="nullable|mimes:jpeg,bmp,png,pdf";
            $rules['itr1']="required_without:form16|mimes:jpeg,bmp,png,pdf";
            $rules['itr2']="required_without:form16|mimes:jpeg,bmp,png,pdf";
        }
        $validated = $request->validate($rules);

        
        $documents=array();
        $documents['identity_type'] = $request->identity_type;
        $documents['identity_file'] = $request->file('identity_file')->store('documents/'.$application->id,'public');
        $documents['residence_proof_type'] = $request->residence_proof_type;
        $documents['residence_proof'] = $request->file('residence_proof')->store('documents/'.$application->id,'public');

        if($application->employment=="business"){   
            $documents['itr1'] = $request->file('itr1')->store('documents/'.$application->id,'public');
            $documents['itr2'] = $request->file('itr2')->store('documents/'.$application->id,'public');
            $documents['itr3'] = $request->file('itr3')->store('documents/'.$application->id,'public');
            $documents['qualificationCertificate'] = $request->file('qualificationCertificate')->store('documents/'.$application->id,'public');
            $documents['balanceSheet1'] = $request->file('balanceSheet1')->store('documents/'.$application->id,'public');
            $documents['balanceSheet2'] = $request->file('balanceSheet2')->store('documents/'.$application->id,'public');
            $documents['balanceSheet3'] = $request->file('balanceSheet3')->store('documents/'.$application->id,'public');
            $documents['businessLicence'] = $request->file('businessLicence')->store('documents/'.$application->id,'public');
            $documents['businessAddress'] = $request->file('businessAddress')->store('documents/'.$application->id,'public');
            $documents['businessTDS'] = $request->file('businessTDS')->store('documents/'.$application->id,'public');
        }else{
            $documents['salary_slip1'] = $request->file('salary_slip1')->store('documents/'.$application->id,'public');
            $documents['salary_slip2'] = $request->file('salary_slip2')->store('documents/'.$application->id,'public');
            $documents['salary_slip3'] = $request->file('salary_slip3')->store('documents/'.$application->id,'public');
            if($request->file('form16')){
                $documents['form16'] = $request->file('form16')->store('documents/'.$application->id,'public');
            }else{
                $documents['itr1'] = $request->file('itr1')->store('documents/'.$application->id,'public');
                $documents['itr2'] = $request->file('itr2')->store('documents/'.$application->id,'public');
            }
        }
        
        $application->documents=json_encode($documents);
        $application->status="submitted";
        $application->save();
        return redirect(route('profile.applications'))->with('alert-success','application submitted successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
