<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $limit=10;
        $applications = Application::paginate($limit);
        return view('application.index', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('application.create');
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
        $validated=$request->validate([
            "first_name"=>"required",
            "last_name"=>"required",
            "email"=>"required|email",
            "dob"=>"required|date|before:-18 years",
            "gender"=>"required",
            "employment"=>"required",
            "income"=>"required",
            "existing_emi"=>"required",
        ]);
        $application = Application::create($validated);
        return redirect(route('application.show',['application'=>$application->id]))->with('alert-success',"Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application)
    {
        //
        
        $banks = \App\Models\Bank::get();
        /* 
        $capacity = $application->income - ((40*$application->income)/100) - $application->existing_emi;
        $principalAmount = 100000;
        $ratePerAnnum = 10;
        $rateOfInterest = $ratePerAnnum/12/100;
        $numberInstallments = 29*12;
        $emi = ($principalAmount * $rateOfInterest * pow(1+$rateOfInterest, $numberInstallments))/ (pow((1+$rateOfInterest), $numberInstallments)-1);
        $eligibility= ($capacity/$emi)*100000; */
        return view('application.show', compact('application','banks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application)
    {
        //
        return view('application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        //
        $validated=$request->validate([
            "name"=>"required",
            "interest_rate"=>"required",
        ]);
        $application->update($validated);
        return redirect(route('application.index'))->with('alert-success',"Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Application $application)
    {
        //
        $application->delete();
        return redirect(route('application.index'))->with('alert-success',"Deleted Successfully");
    }
}
