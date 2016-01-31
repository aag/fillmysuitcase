<?php

namespace Tests\Functional;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NavigationTest extends \Tests\TestCase {

    use DatabaseMigrations;

    public function testGuestNavigation()
    {
        $response = $this->visit('/')
            ->see('Login')
            ->see('href="/login"')
            ->dontSee('My List')
            ->dontSee('/list');
    }

    public function testUserListNavigation()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see('My List')
            ->see('/list')
            ->dontSee('Login')
            ->dontSee('href="/login"');
    }

    public function testUserAccountNavigation()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see($user->name)
            ->see('href="/account"');
    }

    public function testUserAccountLogOut()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->visit('/')
            ->see('Log Out')
            ->see('href="/logout"');
    }

}
