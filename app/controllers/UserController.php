<?php

class UserController extends BaseController {
    /**
     * Attempt a login with the credentials in the POST.
     */
    public function doLogin()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $stay_logged_in = Input::get('remember');

        if (Auth::attempt(array('username' => $username, 'password' => $password), $stay_logged_in)) {
            return Redirect::route('root');
        } else {
            return Redirect::route('login')
                                ->exceptInput('password')
                                ->withErrors(array('' => 'Username or password invalid.'));

        }
    }

    /**
     * Show the login form to the user.
     */
    public function showLogin()
    {
        $user = new User();
        return View::make('user.login', array('user' => $user));
    }

    /**
     * Log out the current user.
     */
    public function doLogout()
    {
        if (Auth::user())
        {
            Auth::logout();
        }

        return Redirect::route('root');
    }
    
    /**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
        $user = new User();

        return View::make('user.create', array('user' => $user));
	}

	/**
	 * Store a newly created user in the DB.
	 *
	 * @return Response
	 */
	public function store()
	{
        $inputs = Input::only('username', 'email', 'password', 'password_confirmation');
        $user = new User($inputs);

        // The save fails if the inputs don't pass validation due to Ardent.
        if ($user->save())
        {
            Auth::login($user);
            return Redirect::route('root');
        }
        else
        {
            return Redirect::route('createuser')
                                ->withInput()
                                ->withErrors($user->errors());
        }
	}

    /**
     * Show the password reset form to the user.
     *
	 * @return Response
     */
    public function showPasswordReset()
    {
        return View::make('user.sendpasswordreset', array('token' => 'ATOKEN'));
    }

    /**
     * Send the password reset email.
     *
	 * @return Response
     */
    public function sendPasswordEmail()
    {
        $credentials = array('email' => Input::get('email'));
        return Password::remind($credentials,  function($message, $user)
        {
                $message->subject('FillMySuitcase Password Reset');
        });
    }

    /**
     * Show the form with password fields so the user can type a new password.
     *
     * @return Response
     */
    public function showSetPassword($token)
    {
        return View::make('user.setpassword')
                        ->with('token', $token);
    }

    /**
     * Take the user's password reset inputs and save the new password.
     *
     * @return Response
     */
    public function doSetPassword($token)
    {
        $credentials = array('email' => Input::get('email'));

        return Password::reset($credentials, function($user, $password)
        {
            $user->password = $password;
            $user->password_confirmation = $password;
            $user->save();

            Session::flash('success-message', 'Your password has been reset successfully.');
            return Redirect::route('login');
        });
    }

}

