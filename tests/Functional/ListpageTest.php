<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListpageTest extends \Tests\TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    public function testListPageRedirectWhenNotLoggedIn()
    {
        $response = $this->visit('/list')
                         ->seePageIs('/login');
    }

    public function testListPageDisplayWhenLoggedIn()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
             ->visit('/list')
             ->see($user->username); 
    }

}
