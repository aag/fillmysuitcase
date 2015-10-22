<?php

class UserController extends BaseController {
    /**
     * Attempt a login with the credentials in the POST.
     */
    public function login()
    {
        $username = Input::get('username');
        $password = Input::get('password');
        $stayLoggedIn = Input::get('remember');

        if (Auth::attempt(array('username' => $username, 'password' => $password), $stayLoggedIn) ||
            Auth::attempt(array('email' => $username, 'password' => $password), $stayLoggedIn)) {

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
        if (Auth::user())
        {
            return Redirect::route('listpage');
        }

        return View::make('user.login');
    }

    /**
     * Log out the current user.
     */
    public function logout()
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
        $inputs = Input::only('username', 'email', 'password');
        $user = new User($inputs);
        $userValid = $user->isValid($inputs);

        $passInputs = Input::only('password', 'password_confirmation');
        $passValid = $user->passwordValid($passInputs);

        if ($userValid && $passValid && $user->save())
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
        $userValid = $user->isValidUpdate($inputs);
        $user->fill($inputs);

        $passInputs = Input::only('password', 'password_confirmation');
        $passValid = empty($passInputs['password']) ||
                        $user->passwordValid($passInputs);

        if ($passValid) {
            $user->password = $passInputs['password'];
        }
        
        if ($userValid && $passValid && $user->save())
        {
            return View::make('user.edit', [
                'user' => $user,
                'updated' => true,
            ]);
        }
        else
        {
            return Redirect::route('user.edit')
                                ->withInput()
                                ->withErrors($user->errors());
        }
    }

    /**
     * showDeleteForm displays a confirmation form to the user to delete their
     * own account.
     * 
     * @access public
     * @return void
     */
    public function showDeleteForm()
    {
        $user = Auth::user();
        return View::make('user.delete', array('user' => $user));
    }

    /**
     * delete checks that the submitted password is valid for the current user,
     * and if so, deletes the account and logs out the user.
     * 
     * @access public
     * @return void
     */
    public function delete()
    {
        $user = Auth::user();
        $password = Input::get('password');

        if ($user->isPassword($password)) {
            Auth::logout();

            $user->delete();

            return Redirect::route('root')
                                ->with('success-message', 'Your account has been deleted.');
        } else {
            return Redirect::route('user.delete')
                                ->exceptInput('password')
                                ->withErrors(array('' => 'Incorrect password'));
        }
    }

}

