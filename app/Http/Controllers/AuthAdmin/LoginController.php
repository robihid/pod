<?php
namespace App\Http\Controllers\AuthAdmin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller {
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
	/**
	 * Where to redirect users after login.
	 *
	 * @var string
	 */
	protected $redirectTo = '/';
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest:admin')->except(['logout']);
	}
	/**
	 * Show the application's login form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showLoginForm() {
		return view('authAdmin.login');
	}
	/**
	 * Handle a login request to the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
	 */
	public function login(Request $request) {
		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required|min:6',
		]);
		$credential = [
			'email' => $request->email,
			'password' => $request->password,
		];
		// Attempt to log the user in
		if (Auth::guard('admin')->attempt($credential, $request->member)) {
			// If login succesful, then redirect to their intended location
			return redirect()->intended(route('admin.home'));
		}
		// If Unsuccessful, then redirect back to the login with the form data
		return redirect()->back()->withInput($request->only('email', 'remember'));
	}
}