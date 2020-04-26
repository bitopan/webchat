<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Room;
use Str;
use Auth;

class RoomController extends Controller
{
    public function getRoomsByUser($id){
        $user = User::find($id);
        $rooms = $user->rooms;

        return response()->json($rooms);
    }

    public function createRoom(){
        $user = Auth::user();
        $room = new Room();
        $room->name = Str::random(9);
        $room->user_id = $user->id;
        $room->save();
        $room->users()->attach($user->id);

        return response()->json($room);
    }

    public function joinRoom(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'name' => 'required'
        ]);
        
        $name = $request->input('name');
        $room = Room::where('name', '=', $name)->firstOrFail();
        $room->users()->attach($user->id);
        
        //$rooms = $user->rooms;
        //return respnse()->json($rooms);

        return redirect('/home');
    }
}
