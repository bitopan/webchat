<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConferenceController extends Controller
{
    public function index(Request $request){
        $data['room'] = $request->room;
        $data['username'] = $request->username;
        $data['password'] = $request->password;

        return view('conference', compact('data'));

    }

    public function create(){
        return view('conference.create');
    }
}
