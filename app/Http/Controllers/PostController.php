<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // function for display all user posts

    public function home(){
        $posts = Post::all();
        $userId = Auth::id();
        $user=User::select('name')->where('id', $userId)->first();
        dd($user);
        //$posts=Post::select('id','content')->where('user_id',$userId)->get();       
        return view('front-office.home',compact('user','posts'));
    }

    // function for adding new post
    Public function AddPost(Request $request)
    {
     
        $this->validate($request, [
             'content' => 'required|string|max:255'
        ]); 

        $userId = Auth::id();
       # dd($userId,$request->content);

        $post = new Post([
            'user_id' =>$userId,
            'content' =>$request->content
         ]);

        $post->save();  

        // $post =[
        //  "user" => "User::select('name')->where('id', $userId)->first()",
        //  "content" => "Post::select('content')->where('user_id', $userId)->first()",
        // ];

        return redirect()->back()->with('success', 'Post add success!');
    }
// function for delete post
    public function DeletePost($id)
    {
       // dd($id);
        Post::destroy($id);
        return redirect()->back()->with('success', 'Post delete success!');
    }
    
    public function TchickLike()
    {

    }
    public function MakeLike()
    {

    }
    public function DeletLike()
    {

    }
    // public function PostLike(Request $request)
    // {
    //     $postId = $request->id;
    //     $userId = Auth::id();
    //     $like = Like::select('post_id')->where('user_id', $userId)->where('post_id', $postId)->first();   
        
    //     if ($like) {
           
    //         $like->delete();
           
    //         return redirect()->back()->with('success', 'unliked successfully');
    //     } else {
           
    //         Like::create(['user_id' => $userId, 'post_id' => $postId]);
         
    //         return redirect()->back()->with('success', 'Post liked successfully');
    //     }
    // }
    


    public function PostLike(Request $request)
{
    $postId = $request->id;
    $userId = Auth::id();
 // dd($userId,$postId);

    $like = Like::where('user_id', $userId)
                ->where('post_id', $postId)
                ->first();
    if ($like) {
        $like->delete();
        return redirect()->back()->with('success', 'Post unliked successfully');
    } else {
        Like::create(['user_id' => $userId, 'post_id' => $postId]);
        return redirect()->back()->with('success', 'Post liked successfully');
    }
}
}