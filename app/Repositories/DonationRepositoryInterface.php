<?php

namespace App\Repositories;

interface DonationRepositoryInterface
{

    /**
     * Get's a donation by it's ID
     *
     * @param int
     */
    public function get($donation_id);

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
    public function delete($donation_id);

    /**
     * Updates a donation.
     *
     * @param int
     * @param array
     */
    public function update($donation_id, array $post_data);
}
