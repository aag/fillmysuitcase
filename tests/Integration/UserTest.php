<?php

namespace Tests\Integration;

use App\Models\Item;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Validator;

class UserTest extends \Tests\TestCase {

    use DatabaseMigrations, DatabaseTransactions;

    /**
     * Takes an array of user property names and values, then returns true
     * if the properties are valid according to the user validation rules, else
     * false.
     * 
     * @param array $properties 
     * @access public
     * @return bool
     */
    public function valid(array $properties)
    {
        $allUserValidationRules = User::getAllValidationRules();

        $validationRules = [];
        foreach ($properties as $name => $value) {
            if (isset($allUserValidationRules[$name])) {
                $validationRules[$name] = $allUserValidationRules[$name];
            }
        }

        $validator = Validator::make($properties, $validationRules);
        return $validator->passes();
    }

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

    public function testValidUsernameValidation()
    {
        $this->assertTrue($this->valid(['username' => 'Test Username']));
    }

    public function testEmptyUsernameIsInvalid()
    {
        $this->assertFalse($this->valid(['username' => '']));
    }

    public function testEmptyPasswordIsInvalid()
    {
        $this->assertFalse($this->valid(['password' => '']));
    }

    public function testShortPasswordIsInvalid()
    {
        $this->assertFalse($this->valid([
            'password' => 'abcde',
            'password_confirmation' => 'abcde'
        ]));
    }

    public function testUnconfirmedPasswordIsInvalid()
    {
        $this->assertFalse($this->valid([
            'password' => '1234567890',
            'password_confirmation' => ''
        ]));
    }

    public function testNonmatchingPasswordConfirmationIsInvalid()
    {
        $this->assertFalse($this->valid([
            'password' => '1234567890',
            'password_confirmation' => '0987654321'
        ]));
    }

    public function testEmptyEmailIsInvalid()
    {
        $this->assertFalse($this->valid([
            'email' => '',
        ]));
    }

    public function testNonEmailIsInvalid()
    {
        $this->assertFalse($this->valid([
            'email' => 'mail',
        ]));
    }

    public function testLongUtfPasswordIsValid()
    {
        $longPass = '☺♘✓"V:%§!$&@€()[]{}\/#*+~FrK;?s6F:=-L\BG$L\w*96l-c-o^$2R\'~rDzo#diWSR=l5*59~WoVfS/gq1aLTykRGP-J3iw;07}ate*Nd>gvnj$[EEDepDwz;mVud4/OL7g\'*)xM.E+5RvWzHH4';

        $this->assertTrue($this->valid([
            'password' => $longPass,
            'password_confirmation' => $longPass,
        ]));
    }
       
}
