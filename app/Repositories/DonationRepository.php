<?php

namespace App\Repositories;

use App\Donation;
use App\Http\Requests\DonationRequest;
use App\Repositories\Interfaces\DonationRepositoryInterface;

class DonationRepository implements DonationRepositoryInterface
{
    /**
     * Get's a donation by it's ID
     *
     * @param int
     * @return model
     */
    public function get(Donation $donation)
    {
        return Donation::findOrFail($donation);
    }

    /**
     * Create a new donation
     *
     * @param Donation
     * @return model
     */
    public function create(DonationRequest $request)
    {
        return Donation::create($request->validated());
    }

    /**
     * Get's all donations.
     *
     * @return collection
     */
    public function all()
    {
        return Donation::all();
    }

    /**
     * Deletes a donation.
     *
     * @param Donation
     */
    public function delete(Donation $donation)
    {
        Donation::destroy($donation);
    }

    /**
     * Updates a donation.
     *
     * @param Donation
     * @param DonationRequest
     */
    public function update(DonationRequest $request, $id)
    {
        // dd(Donation::findOrFail($id));
        Donation::findOrFail($id)->update($request->validated());
    }
}
