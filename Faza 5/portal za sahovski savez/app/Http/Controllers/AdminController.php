<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deadline;
use App\DeadlineType;

class AdminController extends Controller {
    public function __construct(){

    }

    public function index(){
        return view('admin.deadlines', ['deadlines'=>Deadline::all()]);
    }

    public function addDeadline(){
        return view('admin.addDeadline', ['deadlineTypes'=>DeadlineType::all()]);
    }

    public function addDeadlinePost(Request $request){
        Deadline::insert([
            'start' => $request->start,
            'end' => $request->end,
            'deadline_type_id' => $request->tip
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