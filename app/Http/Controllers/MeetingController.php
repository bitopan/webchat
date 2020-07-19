<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Str;
use App\Room;

class MeetingController extends Controller
{
	private $room;
	private $username;
	private $password;

    public function create(){
    	$create = true;
    	$room = str_pad(rand(1, 999999999), 9, 0);
    	$password = str_pad(rand(1, 999999), 6, 0);

    	$data = array();

    	$data['create'] = $create;
    	$data["room"] = $room;
    	$data["password"] = $password;

    	return view('meeting.create', compact('data'));
    }
    public function join(Request $request){
    	$meeting = $request->meeting;
    	$password = base64_decode($request->password);
    	if($meeting && $password)
    		return view('meeting.join', ['meeting' => $meeting, 'password' => $password]);

    	return view('meeting.join');
    }

    public function invitation(){
    	return view('meeting.invitation');
    }

    public function meeting(Request $request){

    	$this->room = $request->meeting_id;
    	$this->password = $request->meeting_password;
    	$this->username = $request->name;

    	if($request->create == 1){
	        $room = new Room();
	        $room->name = $this->room;
	        //$room->user_id = Str::random(4);
	        $room->user_id = str_pad(rand(1, 999999), 5, 0);
	        $room->save();

	        $roomData = array();

	        $roomData['url'] = "https://chat.geekworkx.net";
	        $roomData['meeting_id'] = $this->room;
	        $roomData['password'] = $this->password;
	        $roomData['creator_code'] = $room->user_id;

	        return redirect('/invitation')
	        		->with('url', "https://chat.geekworkx.net/join-meeting?meeting=" . $this->room . "&password=" . base64_encode($this->password))
	        		->with('meeting_id', $this->room)
	        		->with('password', $this->password)
	        		->with('creator_code', $room->user_id)
	        		->with('username', $this->username);
    	}


    	$data = array();

    	$data['room'] = $this->room;
    	$data['username'] = $this->username;
    	$data['password'] = $this->password;


    	return view('meeting.meeting', compact('data'));

    }
}

