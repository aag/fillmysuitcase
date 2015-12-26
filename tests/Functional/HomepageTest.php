<?php

namespace Tests\Functional;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends \Tests\TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    /**
     * A basic functional test of the homepage.
     *
     * @return void
     */
    public function testHomepageGetResponse()
    {
        $response = $this->visit('/')
                         ->assertResponseOk();
    }

}
