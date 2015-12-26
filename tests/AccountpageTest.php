<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountpageTest extends TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    public function testAccountPageRedirectWhenNotLoggedIn()
    {
        $response = $this->visit('/account')
                         ->seePageIs('/login');
    }

    public function testAccountPageDisplayWhenLoggedIn()
    {
        $user = factory(App\User::class)->make();

        $this->actingAs($user)
             ->visit('/account')
             ->see($user->username); 
    }

}
