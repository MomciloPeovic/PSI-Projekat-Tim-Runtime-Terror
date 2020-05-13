<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deadline;

class AdminController extends Controller {
    public function __construct(){

    }

    public function index(){
        return view('admin.deadlines');
    }

    public function addDeadline(){
        return view('admin.addDeadline');
    }

    public function addDeadlinePost(Request $request){
        Deadline::insert([
            'start' => $request->start,
            'end' => $request->end
        ]);

        return redirect()->action('AdminController@deadlines');
    }

    public function deadlines(){
        $deadlines = Deadline::all();
        return view('admin.deadlines', [
            'deadlines' => $deadlines
        ]);
    }
}