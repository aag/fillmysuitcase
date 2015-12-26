<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListpageTest extends TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    public function testListPageRedirectWhenNotLoggedIn()
    {
        $response = $this->visit('/list')
                         ->seePageIs('/login');
    }

    public function testListPageDisplayWhenLoggedIn()
    {
        $user = factory(App\User::class)->make();

        $this->actingAs($user)
             ->visit('/list')
             ->see($user->username); 
    }

}
