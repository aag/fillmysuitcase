<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AccountpageTest extends \Tests\TestCase {

    use DatabaseMigrations;

    public function testAccountPageRedirectWhenNotLoggedIn()
    {
        $response = $this->visit('/account')
                         ->seePageIs('/login');
    }

    public function testAccountPageDisplayWhenLoggedIn()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
             ->visit('/account')
             ->see('Change Password'); 
    }

}
