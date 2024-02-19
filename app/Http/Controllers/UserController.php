<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //
    public function show(){
        $users = User::all();
        $users->each(function ($user) {
            $user->isFollowing = $user->followers()->where('follower_id', auth()->id())->exists();
        });
        return view('front-office.users' , compact('users'));
    }

    public function search($value){
        if($value == "AllUsersSearch") $users = User::paginate(9);
        else $users = User::where('name', 'like', "%$value%")->paginate(9);
        return view("front-office.search", compact('users'));
    }
    public function showProfile($userId)
    {
        $user = User::findOrFail($userId);
        $posts = Post::where('user_id', $user->id)
            ->with(['user', 'likes', 'comments'])
            ->withCount('likes', 'comments')
            ->get();

       $followersCount =Follower::where('user_id', $user->id)->count();
       $followingCount =Follower::where('follower_id', $user->id)->count();
        return view('front-office.profil', compact('user', 'posts' , 'followersCount' , 'followingCount'));
   
    }





    public function deleteAccount()
    {
        $user = Auth::user(); 
    
        if ($user) {
            User::destroy($user->id);
    
            Auth::logout();
            return redirect()->route('home')->with('success', 'Account deleted successfully.');
        }
        return redirect()->route('home')->with('error', 'Failed to delete account.');
    }
}
