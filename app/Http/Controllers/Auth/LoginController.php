<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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
  protected $redirectTo = RouteServiceProvider::HOME;
  protected $maxAttempts = 3;
  protected $decayMinutes = 2;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

  /**
   * Get the failed login response instance.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Symfony\Component\HttpFoundation\Response
   *
   * @throws \Illuminate\Validation\ValidationException
   */
  protected function sendFailedLoginResponse(Request $request)
  {
    throw ValidationException::withMessages([
      'username' => [trans('auth.failed')],
    ]);
  }
  /**
   * Get the login username to be used by the controller.
   *
   * @return string
   */
  public function username()
  {
    $login = request()->input('username');
    if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
      $field = 'email';
    } else {
      $field = 'username';
    }
    request()->merge([$field => $login]);
    return $field;
  }

  public function throttleKey(Request $request)
  {
    return $request->input('username');
  }
}
