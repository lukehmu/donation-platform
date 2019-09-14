<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DonationTest extends DuskTestCase
{

    use DatabaseMigrations;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->type('#donationAmountValue', '55');
            $browser->type('#fullName', 'Luke');
            $browser->type('#emailAddress', 'lukehmu+testing@electricputty.co.uk');
            $browser->press('#label-paymentType-card');
            $browser->whenAvailable('#button-payment-card', function ($button) {
                $button->press('#button-payment-card');
            });
            // this doesn't seem to be able to handle vue router...
            // $browser->waitUntilVueIsNot('donationID', null, '@Giftaid');
            // $browser->assertVueIsNot('donationID', null, '@routerView');
        });
    }
}
