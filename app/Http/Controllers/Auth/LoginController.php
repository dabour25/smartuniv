<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
		$this->middleware('guest:admin')->except('logout');
		$this->middleware('guest:doctor')->except('logout');
		$this->middleware('guest:assistant')->except('logout');
		$this->middleware('guest:student')->except('logout');
    }
	
	public function getAdminlogin(){
        return view('auth.login', ['url' => 'admin']);
    }
	public function getDoctorlogin(){
        return view('auth.login', ['url' => 'doctor']);
    }
	public function getAssistantlogin(){
        return view('auth.login', ['url' => 'assistant']);
    }
	public function getStudentlogin(){
        return view('auth.login', ['url' => 'student']);
    }	
	
	
	public function adminLogin(Request $req)
    {
        $this->validate($req, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $req->email, 'password' => $req->password], $req->get('remember'))) {

            return redirect('/admin');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
	public function doctorLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/doctor');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
	public function assistantLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('assistant')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/doctor');
        }
        return back()->withInput($request->only('email', 'remember'));
    }
	public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/student');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
	 
	/*public function redirectTo(){   
		// User role
		$role = Auth::user()->role; 
		// Check user role
		switch ($role) {
			case 'sadmin':
					return '/admin';
				break;
			case 'admin':
					return '/admin';
				break;
			case 'student':
					return '/student';
				break;
			case 'doctor':
					return '/doctor';
				break; 
			case 'assistant':
					return '/doctor';
				break; 
			
			default:
					return '/'; 
				break;
		}
	}
	*/
}
