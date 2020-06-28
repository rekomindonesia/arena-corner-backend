<?php

namespace App\Http\Controller;

use Illuminate\Http\Request;

/**
 * 
 */
class AuthController extends Controller
{
	
	public function login(){
		return view('auth.login');
	}

	function __construct(argument)
	{
		# code...
	}
}