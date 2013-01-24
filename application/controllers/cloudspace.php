<?php

class Cloudspace_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The CloudSpace Controller
	|--------------------------------------------------------------------------
	|
	| This controller processes all requests within the Vapour OS once the user is authenticated.
	|
	*/

	public $restful = true;
	
	public function __construct()
	{
		$this->filter('before', 'auth');
		$this->filter('before', 'csrf')->on('post');
		parent::__construct();
	}

	public function get_index()
	{
		$user = Auth::user();
		return View::make('cloudspace.index')
					->with('user', $user);
	}
	
	public function post_upload()
	{
		$files = Input::file($qqfile);
		foreach($files as $file)
		{
			printf($file);
		}
        return array('success'=>true);
	}

}