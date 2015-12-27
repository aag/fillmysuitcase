<?php

namespace Tests\Integration;

use App\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends \Tests\TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    public function testMaxItemsPerUser()
    {
        $user = factory(User::class)->make();
        $user->save();

        $items = [];
        $numItemsToAdd = $user->getNumMaxItems();
        for ($i = 0; $i < $numItemsToAdd; $i++) {
            $item = new Item(['name' => str_random(8)]);
            $items[] = $item;
        }

        $user->items()->saveMany($items);
        $this->assertTrue($user->hasMaxItems());
    }

    public function testJustUnderMaxItemsPerUser()
    {
        $user = factory(User::class)->make();
        $user->save();

        $items = [];
        $numItemsToAdd = $user->getNumMaxItems() - 1;
        for ($i = 0; $i < $numItemsToAdd; $i++) {
            $item = new Item(['name' => str_random(8)]);
            $items[] = $item;
        }

        $user->items()->saveMany($items);
        $this->assertFalse($user->hasMaxItems());
    }

}
