<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class FullUserFlowTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Delete all users from the database that have been created by this test.
     */
    private function deleteTestUsers()
    {
        $users = User::where('email', 'like', 'full_user_flow_test%')->get();
        foreach ($users as $user) {
            $user->delete();
        }
    }

    public function setUp(): void
    {
        parent::setUp();

        // Clean up any old users caused by previous test failures stopping the
        // test in the middle.
        $this->deleteTestUsers();
    }

    public function tearDown(): void
    {
        // Clean up the test user.
        $this->deleteTestUsers();

        parent::tearDown();
    }

    /**
     * A test that goes through the entire user flow from signup to
     * account deletion.
     *
     * @return void
     */
    public function testFullUserFlow()
    {
        $this->browse(function (Browser $browser) {
            // Generate information for a new user to be created during the
            // test.
            $uniqid = uniqid();
            $username = "Test $uniqid";
            $email = "full_user_flow_test+{$uniqid}@example.com";
            $password = "testpassword";

            // Go to homepage
            $browser->visit('/')
                    ->assertSee('Pack right for every trip.')

                    // Go to login page
                    ->click('@log-in-link')
                    ->assertSee('Log In')

                    // Go to registration page
                    ->click('@register-link')
                    ->assertSee('Create Account')
                    ->type('@username-input', $username)
                    ->type('@email-input', $email)
                    ->type('@password-input', $password)
                    ->type('@password-confirm-input', $password)
                    ->click('@submit-button')

                    // Add 3 items
                    ->assertSee('Your Packing List')
                    ->type('@new-item-input', 'Item 1')
                    ->click('@add-item-button')
                    ->waitFor('@unpacked-item-0')
                    ->assertInputValue('@unpacked-item-0', 'Item 1')
                    ->type('@new-item-input', 'Item 2')
                    ->click('@add-item-button')
                    ->waitFor('@unpacked-item-1')
                    ->assertInputValue('@unpacked-item-1', 'Item 2')
                    ->type('@new-item-input', 'Item 3')
                    ->click('@add-item-button')
                    ->waitFor('@unpacked-item-2')
                    ->assertInputValue('@unpacked-item-2', 'Item 3')

                    // Pack all 3 items
                    ->click('@unpacked-check-0')
                    ->waitFor('@packed-item-0')
                    ->assertSeeIn('@packed-item-0', 'Item 1')
                    ->click('@unpacked-check-0')
                    ->waitFor('@packed-item-1')
                    ->assertSeeIn('@packed-item-1', 'Item 2')
                    ->click('@unpacked-check-0')
                    ->waitFor('@packed-item-2')
                    ->assertSeeIn('@packed-item-2', 'Item 3')
                    ->assertSee('Bon voyage!')

                    // Unpack an item and pack it again
                    ->click('@packed-check-2')
                    ->waitFor('@unpacked-item-0')
                    ->assertInputValue('@unpacked-item-0', 'Item 3')
                    ->click('@unpacked-check-0')
                    ->waitFor('@packed-item-2')
                    ->assertSeeIn('@packed-item-2', 'Item 3')

                    // Reset packing list
                    ->click('@reset-button')
                    ->waitFor('@unpacked-item-0')
                    ->assertInputValue('@unpacked-item-0', 'Item 1')
                    ->assertInputValue('@unpacked-item-1', 'Item 2')
                    ->assertInputValue('@unpacked-item-2', 'Item 3')

                    // Delete Item 3
                    ->click('@delete-item-link-2')
                    ->click('@confirm-delete-button-2')
                    ->waitUntilMissing('@unpacked-item-2')

                    // Go to account page
                    ->click('@account-link')
                    ->assertSee('Edit Account Info')

                    // Delete account
                    ->click('@delete-account-link')
                    ->assertSee('Delete Account')
                    ->type('@password-input', $password)
                    ->click('@delete-account-button')
                    ->assertSee('Your account has been deleted.');
        });
    }
}
