<?php

class User_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The User Controller
	|--------------------------------------------------------------------------
	|
	| This controller processes all authentication and registration requests before a user enters their session.
	|
	*/

	public $restful = true;

	public function get_register()
	{
		return View::make('user.register');
	}

	public function post_register()
	{
		// validation
		$rules = array(
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed|between:4,16'
		);
		
		$messages = array(
			'same'    => 'The :attribute and :other must match.',
			'size'    => 'The :attribute must be exactly :size.',
			'between' => 'The :attribute must be between :min - :max.',
			'in'      => 'The :attribute must be one of the following types: :values',
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails())
		{
			return Redirect::to('user/register')->with_errors($validation);
		}
		
		$email = Input::get('email');
		$password = Input::get('password');
		
		// register
		try {
			$user = new User();
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->save();
			Auth::login($user);
		
			return Redirect::to('cloudspace');
		}  catch( Exception $e ) {
			Session::flash('status_error', 'An error occurred while creating a new user - please try again.');
			return Redirect::to('/');
		}
	}

	public function get_login()
	{
		return View::make('user.login');
	}

	public function post_login()
	{
		// validation
		$rules = array(
			'email' => 'required|email|exists:users',
			'password' => 'required|between:4,16'
		);
		
		$messages = array(
			'same'    => 'The :attribute and :other must match.',
			'size'    => 'The :attribute must be exactly :size.',
			'between' => 'The :attribute must be between :min - :max.',
			'in'      => 'The :attribute must be one of the following types: :values',
			'exists'  => 'The :attribute does not exist in our records.'
		);

		$validation = Validator::make(Input::all(), $rules, $messages);

		if ($validation->fails())
		{
			return Redirect::to('user/login')->with_errors($validation);
		}
		
		// login
		$credentials  = array(
			'username' => Input::get('email'),
			'password' => Input::get('password')
		);
		
		if ( Auth::attempt($credentials ) )
		{
			return Redirect::to('cloudspace');
		}
		else
		{
			return Redirect::to('user/login')->with('login_errors', true);
		}
	}

	public function get_logout()
	{
		Auth::logout();
        return Redirect::to('/');
	}

}