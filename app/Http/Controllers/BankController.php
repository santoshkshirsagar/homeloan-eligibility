<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bank;
class BankController extends Controller
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
        $banks = Bank::paginate($limit);
        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bank.create');
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
            "name"=>"required",
            "interest_rate"=>"required",
            "max_age_limit"=>"required|numeric|max:70"
        ]);
        $bank = Bank::create($validated);
        return redirect(route('bank.index'))->with('alert-success',"Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        //
        return view('bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        //
        $validated=$request->validate([
            "name"=>"required",
            "interest_rate"=>"required",
            "max_age_limit"=>"required",
        ]);
        $bank->update($validated);
        return redirect(route('bank.index'))->with('alert-success',"Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        //
        $bank->delete();
        return redirect(route('bank.index'))->with('alert-success',"Deleted Successfully");
    }
}
