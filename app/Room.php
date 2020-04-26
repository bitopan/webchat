<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Room;

class Room extends Model
{
    

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    
}
