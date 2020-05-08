<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	public function login()
	{
		return view('users.login');
	}

	public function verifyLogin(Request $request)
	{
		$credentials = $request->only('email', 'password');

		if (Auth::attempt($credentials))
			echo "success";
		else
			echo "failed";
	}

	public function authenticate(Request $request)
	{
		$credentials = $request->only('email', 'password');
		if (Auth::attempt($credentials)) {
			// Authentication passed...
			return redirect()->intended('dashboard');
		}
	}

	public function register()
	{
		$player = new Player();

		$player->email = "momcilo.peovic@gmail.com";
		$player->name = "neko";
		$player->surname = "neko";
		$player->birth_date = "2020-03-03";
		$player->password = bcrypt("asd");
		$player->save();

		//return view('register');
	}
}
