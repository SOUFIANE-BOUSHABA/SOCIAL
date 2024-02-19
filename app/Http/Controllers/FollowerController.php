<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    //

    public function follow($userId)
    {
        $existingFollower = Follower::where([
            ['user_id', $userId],
            ['follower_id', auth()->id()],
        ])->first();
        
            
        if ($existingFollower) {
            Follower::destroy($existingFollower->id);
        } else {
            Follower::create([
                'user_id' => $userId,
                'follower_id' => auth()->id(),
            ]);
        }
    
        return back();
    }

    public function followers($userId){
       $user=User::findOrFail($userId);
       $users = $user->followers;
       return view('front-office.followers', compact('users'));
    }

  
}
