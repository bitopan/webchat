<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    public function usersWithStatus(){
        $allusers = User::all();

        $users = array();
        foreach ($allusers as $user) {
            $users[] = array("id"=>$user->id, "name"=>$user->name, "status"=>$user->isOnline());
        }

        return response()->json($users);
    }
}
