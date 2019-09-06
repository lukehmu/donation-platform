<?php

namespace App\Http\Controllers;

use App\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'donationType'=>'required|string',
            'emailAddress'=>'required|email',
            'fullName'=>'required|string',
            'paymentType'=>'required|string',
            'donationAmount'=>'required|numeric',
        ]);
        $donation = new Donation([
            'donationType'=> $request->get('donationType'),
            'emailAddress'=>$request->get('emailAddress'),
            'fullName'=> $request->get('fullName'),
            'paymentType'=> $request->get('paymentType'),
            'donationAmount'=>$request->get('donationAmount'),
        ]);
        $donation->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        //
    }
}
