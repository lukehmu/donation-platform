<?php

namespace App\Http\Controllers;

use App\Donation;
use App\Http\Requests\DonationRequest;
use App\Repositories\Interfaces\DonationRepositoryInterface;

class DonationController extends Controller
{
    protected $donation;

    /**
     * DonationController constructor.
     *
     * @param DonationRepositoryInterface $donation
     */
    public function __construct(DonationRepositoryInterface $donation)
    {
        $this->donation = $donation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // learning about how repositories work
        $data = [
            'donations' => $this->donation->all()
        ];
        dd($data['donations']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DonationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonationRequest $request)
    {
        // leaving this more verbose version in for learning

        // $validated = $request->validated();
        // $donation = new Donation([
        //     'donationType' => $request->get('donationType'),
        //     'emailAddress' => $request->get('emailAddress'),
        //     'fullName' => $request->get('fullName'),
        //     'paymentType' => $request->get('paymentType'),
        //     'donationAmount' => $request->get('donationAmount'),
        // ]);
        // $donation->save();

        // Move validation to model
        // $donation = Donation::create($request->validated());

        // repository handles storing the new donation
        return $this->donation->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        $data = [
            'donation' => $this->donation->get($donation)
        ];
        dd($data['donation']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DonationRequest  $request
     * @param  \App\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(DonationRequest $request, $id)
    {
        return $this->donation->update($request, $id);
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
