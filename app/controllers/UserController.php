<?php

class UserController extends BaseController {
    /**
     * Attempt a login with the credentials in the POST.
     */
    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $stay_logged_in = Input::get('remember');

        // Workaround for Ardent. Auth::attempt() calls $user->save() to store
        // the reminder_token, but with Ardent validation rules, this fails.
        User::$rules = [];

        if (Auth::attempt(array('username' => $username, 'password' => $password), $stay_logged_in) ||
            Auth::attempt(array('email' => $username, 'password' => $password), $stay_logged_in)) {

            return Redirect::route('listpage');
        } else {
            return Redirect::route('login')
                                ->exceptInput('password')
                                ->withErrors(array('' => 'Username or password invalid.'));
        }
    }

    /**
     * Show the login form to the user.
     */
    public function showLoginForm()
    {
        return View::make('user.login');
    }

    /**
     * Log out the current user.
     */
    public function logout()
    {
        if (Auth::user())
        {
            // Workaround for Ardent. Auth::attempt() calls $user->save() to store
            // the reminder_token, but with Ardent validation rules, this fails.
            User::$rules = [];

            Auth::logout();
        }

        return Redirect::route('root');
    }
    
    /**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function showCreateForm()
	{
        return View::make('user.create');
	}

	/**
	 * Store a newly created user in the DB.
	 *
	 * @return Response
	 */
	public function storeNew()
	{
        $inputs = Input::only('username', 'email', 'password', 'password_confirmation');
        $passInputs = Input::only('password', 'password_confirmation');
        $user = new User($inputs);

        $passValid = $user->passwordValid($passInputs);
        
        // The save fails if the inputs don't pass validation due to Ardent.
        if ($passValid && $user->save())
        {
            Auth::login($user);
            return Redirect::route('listpage');
        }
        else
        {
            return Redirect::route('createuser')
                                ->withInput()
                                ->withErrors($user->errors());
        }
	}

    /**
     * showEditForm shows a form to the user to edit their own account
     * information.
     * 
     * @access public
     * @return void
     */
    public function showEditForm()
    {
        $user = Auth::user();
        return View::make('user.edit', array('user' => $user));
    }

    /**
     * storeEdit handles the user edit form submission.  If it includes
     * invalid user data, the user is shown the form again with error
     * messages.
     * 
     * @access public
     * @return void
     */
    public function storeEdit()
    {
        $user = Auth::user();
        $inputs = Input::only('username', 'email');
        $user->fill($inputs);

        $passInputs = Input::only('password', 'password_confirmation');
        $passValid = $user->passwordEmptyOrValid($passInputs);
        
        // The updateUniques() fails if the inputs don't pass validation due
        // to Ardent.
        if ($passValid && $user->updateUniques())
        {
            return View::make('user.edit', array('user' => $user));
        }
        else
        {
            return Redirect::route('user.edit')
                                ->withInput()
                                ->withErrors($user->errors());
        }
    }
}

