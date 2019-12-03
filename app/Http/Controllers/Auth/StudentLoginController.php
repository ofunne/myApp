<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StudentLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:student');
	}

    public function showLoginForm(){
    	return view('auth.student-login');
	}
	
	public function username(){
		return username;
	}

    public function login(Request $request){
    	//Validate the form data
    	$this->validate($request, [
    		'username' => 'required', 
    		'password' => 'required|min:6'
    	]);

    	//Attempt to log the user in
    	if (Auth::guard('student')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
    		//If successfull, then redirect to intended location
    		return redirect()->intended(route('student.dashboard'));
    	}    	

    	//If unsuccessful, then redirect to login with form data
    	return redirect()->back()->withInput($request->only('username', 'remember'));
    }
}
