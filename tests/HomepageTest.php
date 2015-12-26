<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomepageTest extends TestCase {

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
