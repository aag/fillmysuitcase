<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationTest extends \Tests\TestCase {

    use DatabaseMigrations;

    public function testGuestNavigation()
    {
        $this->get('/')
            ->assertSee('Log In')
            ->assertSee('href="/login"')
            ->assertDontSee('My List')
            ->assertDontSee('/list');
    }

    public function testUserListNavigation()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertSee('My List')
            ->assertSee('/list')
            ->assertDontSee('Login')
            ->assertDontSee('href="/login"');
    }

    public function testUserAccountNavigation()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertSee($user->username)
            ->assertSee('href="/account"');
    }

    public function testUserAccountLogOut()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->get('/')
            ->assertSee('Log Out')
            ->assertSee('href="/logout"');
    }

}
