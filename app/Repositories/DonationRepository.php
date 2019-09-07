<?php

namespace App\Repositories;

use App\Donation;

class DonationRepository implements DonationRepositoryInterface
{
    /**
     * Get's a donation by it's ID
     *
     * @param int
     * @return collection
     */
    public function get($donation_id)
    {
        return Donation::find($donation_id);
    }

    /**
     * Get's all donations.
     *
     * @return mixed
     */
    public function all()
    {
        return Donation::all();
    }

    /**
     * Deletes a donation.
     *
     * @param int
     */
    public function delete($donation_id)
    {
        Donation::destroy($donation_id);
    }

    /**
     * Updates a donation.
     *
     * @param int
     * @param array
     */
    public function update($donation_id, array $post_data)
    {
        Donation::find($donation_id)->update($post_data);
    }
}
