<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tournament;

class TournamentController extends Controller
{
    public function index()
    {
        return view('tournaments', [
			'tournaments' => Tournament::all()
		]);        
    }
}
