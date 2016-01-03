<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class AccountController extends Controller {

    /**
     * Shows a form to the user to edit their own account
     * information.
     * 
     * @access public
     * @param Request $request
     * @return void
     */
    public function getEdit(Request $request)
    {
        $user = Auth::user();
        
        $username = $request->old('username', $user->username);
        $email = $request->old('email', $user->email);

        return view('account.edit', [
            'user' => $user,
            'username' => $username,
            'email' => $email,
        ]);
    }

    /**
     * Handles the user edit info form submission.  If it includes
     * invalid user data, the user is shown the form again with error
     * messages.
     * 
     * @access public
     * @param Request $request
     * @return void
     */
    public function postEditInfo(Request $request)
    {
        $user = Auth::user();
        $credentials = [
            'email' => $user->email,
            'password' => $request->input('info_current_password'),
        ];

        if (Auth::validate($credentials)) {
            $changedInfo = $user->getChangedProperties(
                $request->only('username', 'email')
            );
            $changedRules = array_intersect_key(
                User::getInfoValidationRules(),
                $changedInfo
            );
            $this->validate($request, $changedRules);

            $user->fill($changedInfo);
            $user->save();

            return redirect()->route('account.getedit')
                ->with('success-message', 'Your account information has been updated.');
        } else {
            return redirect()->route('account.getedit')
                ->exceptInput('info_current_password')
                ->withErrors([
                    'info_current_password' => 'Incorrect current password'
                ]);
        }
    }

    /**
     * Handles the user change password form submission.  If it includes
     * invalid user data, the user is shown the form again with error
     * messages.
     * 
     * @access public
     * @param Request $request
     * @return void
     */
    public function postChangePassword(Request $request)
    {
        $user = Auth::user();
        $credentials = [
            'email' => $user->email,
            'password' => $request->input('password_current_password'),
        ];

        if (Auth::validate($credentials)) {
            $this->validate($request, User::getPasswordValidationRules());

            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('account.getedit')
                ->with('success-message', 'Your password has been changed.');
        } else {
            return redirect()->route('account.getedit')
                ->exceptInput('password_current_password')
                ->withErrors(
                    ['password_current_password' => 'Incorrect current password']
                );
        }
    }

    /**
     * Displays a confirmation form to the user to delete their
     * own account.
     * 
     * @access public
     * @return void
     */
    public function getDelete()
    {
        $user = Auth::user();
        return view('account.delete', array('user' => $user));
    }

    /**
     * Checks that the submitted password is valid for the current user,
     * and if so, deletes the account and logs out the user.
     * 
     * @access public
     * @param Request $request
     * @return void
     */
    public function postDelete(Request $request)
    {
        $user = Auth::user();
        $credentials = [
            'email' => $user->email,
            'password' => $request->input('password'),
        ];

        if (Auth::validate($credentials)) {
            Auth::logout();

            $user->delete();

            return redirect()->route('root')
                ->with('success-message', 'Your account has been deleted.');
        } else {
            return redirect()->route('account.getdelete')
                ->exceptInput('password')
                ->withErrors(array('password' => 'Incorrect password'));
        }
    }

}

