<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deadline;
use App\DeadlineType;
use App\Player;

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

    public function getPendingRegs(){
        $users = Player::all();
        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function pendingRegs($id){
        $user = Player::where('id', $id)->first();
        return view('admin.reg', [
            'user' => $user
        ]);
    }

    public function pendingRegsPost(Request $request){
        Player::where('id', $request->id)->update([
            'rating' => $request->rating,
            'confirmed' => $request->confirm
        ]);

        Player::where('confirmed', 2)->delete();
        
        return redirect()->action('AdminController@getPendingRegs');
    }
}