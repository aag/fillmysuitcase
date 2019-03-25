<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ListpageTest extends \Tests\TestCase {

    use DatabaseMigrations;

    public function testListPageRedirectWhenNotLoggedIn()
    {
        $this->get('/list')
            ->assertRedirect('/login');
    }

    public function testListPageDisplayWhenLoggedIn()
    {
        $user = factory(User::class)->make();

        $this->actingAs($user)
             ->get('/list')
             ->assertSee($user->username); 
    }

}
