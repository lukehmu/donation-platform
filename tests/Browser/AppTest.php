<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AppTest extends DuskTestCase
{
    /**
     * Test that Vue has successfully loaded
     *
     * @return void
     */
    public function testLaravelLoaded()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Laravel Vue Donation');
        });
    }

    /**
     * Test that Vue has successfully loaded
     *
     * @return void
     */
    public function testVueLoaded()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('One-off');
        });
    }
}
