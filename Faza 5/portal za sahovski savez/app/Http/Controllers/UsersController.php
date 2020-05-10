<?php

namespace App\Http\Controllers;

use App\Player;
use App\Admin;
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

		if (Auth::guard('player')->attempt($credentials)) {
			return redirect('/');
		} else if (Auth::guard('club')->attempt($credentials))
			return redirect('/');
		else if (Auth::guard('admin')->attempt($credentials))
			return redirect('/');
		else
			return view('users.login');
	}

	public function register()
	{
		return view('users.register');
	}

	public function registerPost(Request $request)
	{

		if ($request->password == $request->confirmPassword) {
			$player = new Player();
			$player->name = $request->name;
			$player->surname = $request->surname;
			$player->email = $request->email;
			$player->birth_date = $request->birth_date;
			$player->password = bcrypt($request->password);

			$player->save();

			return redirect('/');
		}

		return redirect('/korisnici/register');
	}

	public function logout()
	{
		if (Auth::guard('admin')->check())
			Auth::guard('admin')->logout();
		else if (Auth::guard('player')->check())
			Auth::guard('player')->logout();
		else if (Auth::guard('club')->check())
			Auth::guard('club')->logout();

		return redirect('/');
	}
}
