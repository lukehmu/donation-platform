<?php

namespace App\Repositories;

use App\Donation;
use App\Jobs\SyncDonations;
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
    public function get($id)
    {
        return Donation::findOrFail($id);
    }

    /**
     * Create a new donation
     *
     * @param Donation
     * @return model
     */
    public function create(DonationRequest $request)
    {
        $donation = Donation::create($request->validated());
        SyncDonations::dispatch($donation);
        return $donation;
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
    public function delete($id)
    {
        Donation::destroy($id);
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
