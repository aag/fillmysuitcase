<?php

namespace Tests\Functional;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ItemendpointsTest extends \Tests\TestCase {

    use DatabaseMigrations;

    public function testCreateItem()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->post('/api/items', ['name' => 'create test'])
            ->assertJson([
                'name' => 'create test',
                'packed' => false,
            ]); 

        $userItems = $user->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('create test', $userItems->first()->name);
    }

    public function testCreateMoreThanMaxItems()
    {
        $user = factory(User::class)->create();

        $items = [];
        $numItemsToAdd = $user->getNumMaxItems();
        for ($i = 0; $i < $numItemsToAdd; $i++) {
            $item = new Item(['name' => str_random(8)]);
            $items[] = $item;
        }

        $user->items()->saveMany($items);

        $this->actingAs($user)
            ->post('/api/items', ['name' => 'create too many items test'])
            ->assertJson([
                'usermessage' => 'You cannot add any more items',
            ]) 
            ->assertStatus(500);

        $userItems = $user->items();

        $this->assertEquals($user->getNumMaxItems(), $userItems->count());
    }

    public function testEditItemName()
    {
        $item = new Item(['name' => 'edit name test']);

        $user = factory(User::class)->create();
        $user->items()->save($item);

        $this->actingAs($user)
            ->post("/api/items/{$item->id}", ['name' => 'EDITED NAME'])
            ->assertJson([
                'name' => 'EDITED NAME',
            ]); 

        $userItems = $user->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('EDITED NAME', $userItems->first()->name);
    }

    public function testEditItemNameAuthorization()
    {
        $item = new Item(['name' => 'edit name test']);

        $userWithItem = factory(User::class)->create();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->post("/api/items/{$item->id}", ['name' => 'EDITED NAME'])
            ->assertStatus(403);

        $userItems = $userWithItem->items();

        $this->assertEquals(1, $userItems->count());
        $this->assertEquals('edit name test', $userItems->first()->name);
    }

    public function testDeleteItem()
    {
        $item = new Item(['name' => 'delete test']);

        $user = factory(User::class)->create();
        $user->items()->save($item);

        $this->assertEquals(1, $user->items()->count());

        $this->actingAs($user)
            ->delete("/api/items/{$item->id}")
            ->assertStatus(200);

        $this->assertEquals(0, $user->items()->count());
    }

    public function testDeleteItemAuthorization()
    {
        $item = new Item(['name' => 'delete test']);

        $userWithItem = factory(User::class)->create();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->delete("/api/items/{$item->id}")
            ->assertStatus(403);

        $this->assertEquals(1, $userWithItem->items()->count());
    }

    public function testItemList()
    {
        $item1 = new Item(['name' => 'list test 1']);
        $item2 = new Item(['name' => 'list test 2']);
        $item3 = new Item(['name' => 'list test 3']);

        $user = factory(User::class)->create();
        $user->items()->saveMany([$item1, $item2, $item3]);

        $this->actingAs($user)
            ->get("/api/items")
            ->assertJsonFragment([
                'name' => 'list test 1',
                'name' => 'list test 2',
                'name' => 'list test 3',
            ]);
    }

    public function testShowItem()
    {
        $item = new Item(['name' => 'show test']);

        $user = factory(User::class)->create();
        $user->items()->save($item);

        $this->actingAs($user)
            ->get("/api/items/{$item->id}")
            ->assertJson([
                'name' => 'show test',
                'packed' => false,
            ]);
    }

    public function testShowItemAuthorization()
    {
        $item = new Item(['name' => 'show auth test']);

        $userWithItem = factory(User::class)->create();
        $userWithItem->items()->save($item);

        $userWithoutItem = factory(User::class)->make();

        $this->actingAs($userWithoutItem)
            ->get("/api/items/{$item->id}")
            ->assertDontSee('show auth test')
            ->assertStatus(403);
    }
}
