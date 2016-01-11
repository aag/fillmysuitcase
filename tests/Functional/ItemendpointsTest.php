<?php

namespace Tests\Functional;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemendpointsTest extends \Tests\TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    public function testCreateItem()
    {
        $user = factory(User::class)->make();
        $user->save();

        $this->actingAs($user)
            ->post('/item', ['name' => 'create test'])
            ->seeJson([
                'name' => 'create test',
                'packed' => false,
            ]); 

        $userItems = $user->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('create test', $userItems->first()->name);
    }

    public function testEditItemName()
    {
        $item = new Item(['name' => 'edit name test']);

        $user = factory(User::class)->make();
        $user->save();
        $user->items()->save($item);

        $this->actingAs($user)
            ->post("/item/{$item->id}", ['name' => 'EDITED NAME'])
            ->seeJson([
                'name' => 'EDITED NAME',
            ]); 

        $userItems = $user->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('EDITED NAME', $userItems->first()->name);
    }

    public function testEditItemNameAuthorization()
    {
        $item = new Item(['name' => 'edit name test']);

        $userWithItem = factory(User::class)->make();
        $userWithItem->save();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->post("/item/{$item->id}", ['name' => 'EDITED NAME'])
            ->assertResponseStatus(403);

        $userItems = $userWithItem->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('edit name test', $userItems->first()->name);
    }

    public function testDeleteItem()
    {
        $item = new Item(['name' => 'delete test']);

        $user = factory(User::class)->make();
        $user->save();
        $user->items()->save($item);

        $this->assertEquals(1, $user->items()->count());

        $this->actingAs($user)
            ->delete("/item/{$item->id}")
            ->assertResponseOk();

        $this->assertEquals(0, $user->items()->count());
    }

    public function testDeleteItemAuthorization()
    {
        $item = new Item(['name' => 'delete test']);

        $userWithItem = factory(User::class)->make();
        $userWithItem->save();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->delete("/item/{$item->id}")
            ->assertResponseStatus(403);

        $this->assertEquals(1, $userWithItem->items()->count());
    }

    public function testItemList()
    {
        $item1 = new Item(['name' => 'list test 1']);
        $item2 = new Item(['name' => 'list test 2']);
        $item3 = new Item(['name' => 'list test 3']);

        $user = factory(User::class)->make();
        $user->save();
        $user->items()->saveMany([$item1, $item2, $item3]);

        $this->actingAs($user)
            ->get("/item")
            ->seeJson([
                'name' => 'list test 1',
                'name' => 'list test 2',
                'name' => 'list test 3',
            ]);
    }

    public function testShowItem()
    {
        $item = new Item(['name' => 'show test']);

        $user = factory(User::class)->make();
        $user->save();
        $user->items()->save($item);

        $this->actingAs($user)
            ->get("/item/{$item->id}")
            ->seeJson([
                'name' => 'show test',
                'packed' => false,
            ]);
    }

    public function testShowItemAuthorization()
    {
        $item = new Item(['name' => 'show auth test']);

        $userWithItem = factory(User::class)->make();
        $userWithItem->save();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->get("/item/{$item->id}")
            ->dontSee('show auth test')
            ->assertResponseStatus(403);
    }
}
