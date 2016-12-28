<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Sheria\UserActivationLibrary;
use App\Notifications\newUserLogin;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserActivationLibrary $userActivationLibrary)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->userActivationLibrary = $userActivationLibrary;
    }
    /**
     * overides authenticated method in Illuminate\Foundation\Auth\AuthenticatesUsers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticated(Request $request, $user)
    {
        if (!$user->activated) {
            $this->userActivationLibrary->sendActivationMail($user);
            auth()->logout();
            return back()->with('activationWarning', true);
          }
        if ($user->is_active == 0) {
            auth()->logout();
            return redirect($this->redirectPath());
          }
        $this->newLogin($request->ip(), $user);
        return back();
    }
    public function activateUser($token)
    {
        if ($user = $this->userActivationLibrary->activateUser($token)) {
            auth()->login($user);
            return redirect($this->redirectPath());
        }
        abort(404);
    }
    private function newLogin($ip, $user)
    {
      $user->notify(new newUserLogin($ip));
    }

}
