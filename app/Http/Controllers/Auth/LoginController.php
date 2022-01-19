<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\Frontend\Auth\UserLoggedOut;


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
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'user';

    public function index()
    {
        return view('auth.login');
    }

    public function log_in(Request $request)
    {
        $this->validateLogin($request);


        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            $request->session()->put('login_attempts', 1);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->send_LoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    protected function send_LoginResponse(Request $request)
    {

        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        $this->authenticated($request, $this->guard('user')->user());



        $user = $this->guard('user')->user();

        if ($user->status == 0) {
            $this->guard()->logout();

            return redirect()->route('user.signup')->with('status', '');
        }

        if ($user->status !== 0 && $user->signup_steps !== 3) {
            $this->guard()->logout();

            return redirect()->route('user.signup');
        }

        if ($user->status !== 0 && $user->signup_steps !== 3) {
            $this->guard()->logout();

            return redirect()->route('user.signup');
        }


        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        return redirect('/');
    }

    public function log_out(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->invalidate();

        return redirect('/login');
    }

    public function __construct()
    {
        $this->middleware('guest:user')->except('log_out');
    }

    protected function validateLogin(Request $request)
    {

        $rules = [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ];

        if (request()->session()->has('login_attempts')) {
            $attempts = request()->session()->get('login_attempts');

            if ($attempts == 1) {
            }
        }

        $this->validate($request, $rules);
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = \Lang::get('auth.throttle', ['seconds' => $seconds]);

        $errors = ['errors' => [$this->username() => $message], 'session' => request()->session()->get('login_attempts'), 'seconds' => $seconds];

        if ($request->expectsJson()) {
            return response()->json($errors, 423);
        }

        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
    }
}
