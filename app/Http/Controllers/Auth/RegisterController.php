<?php

namespace App\Http\Controllers\Auth;


//use App\Services\Users\UsersService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\Auth\UserRepository;
use App\Http\Requests\Auth\RegisterIndividualRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    protected function guard()
    {
        return Auth::guard('user');
    }

    use RegistersUsers;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $guard = 'user';

    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('auth.signup');
    }


    /**
     * @param RegisterIndividualRequest $request
     * @return \Illuminate\Http\Response
     */
    public function registrationIndividual(RegisterIndividualRequest $request)
    {
        $user = $this->userRepository->create($request->onlyValidated());

        return redirect()->route('user.login')->withAuthFlashSuccess($user->email);
    }

}
