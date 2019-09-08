<?php

namespace App\Repositories\Interfaces;

use App\Donation;
use App\Http\Requests\DonationRequest;

interface DonationRepositoryInterface
{

    /**
     * Get's a donation by it's ID
     *
     * @param Donation
     */
    public function get($id);

    /**
     * Create a new donation
     *
     * @param Donation
     */
    public function create(DonationRequest $request);

    /**
     * Get's all donations.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a donation.
     *
     * @param int
     */
    public function delete($id);

    /**
     * Updates a donation.
     *
     * @param DonationRequest
     * @param int
     */
    public function update(DonationRequest $request, $id);
}
