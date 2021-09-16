<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\Application;

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

    public function offers()
    {
        $profile = Profile::where('mobile',session('mobile'))->firstOrFail();
        $banks = \App\Models\Bank::get();
        return view('profile.offers', compact('profile','banks'));
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

    public function applications()
    {
        $applications = \App\Models\Application::where('mobile',session('mobile'))->paginate(10);
        return view('profile.applications', compact('applications'));
    }

    public function documents(Application $application)
    {
        return view('profile.documents', compact('application'));
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
