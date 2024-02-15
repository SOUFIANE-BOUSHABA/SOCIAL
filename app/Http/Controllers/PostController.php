<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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
        $comments=Comment::all();
        $userId = Auth::id();
        $user=User::select('name')->where('id', $userId)->first();
        foreach ($posts as $post) {
             $post->likesCount = $this->CountLike($post->id);
        }

        $commentN=new CommentController();
           //  $commentN->getNumberOfcomment();
       # dd($commentN->getNumberOfcomment());
        // foreach ($comments as $comment)
        // {
        //   $post->comment = $comments->CountComment($post_id);
        // }
        return view('front-office.home',compact('user','posts'))->with('userId',$userId);
    }

    // function for adding new post
    Public function AddPost(Request $request)
    {
        $this->validate($request, [
             'content' => 'required|string|max:255'
        ]); 
        $userId = Auth::id();
      
        $post = new Post([
            'user_id' =>$userId,
            'content' =>$request->content
         ]);
        $post->save();  
     

        return redirect()->back()->with('success', 'Post add success!');
    }

public function DeletePost($id)
{  
    Comment::where('post_id', $id)->delete(); 
    Like::where('post_id', $id)->delete(); 
    Post::destroy($id);
    return redirect()->back()->with('success', 'Post delete success!');
}
    public function CountLike($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $likesCount = $post->likes->count(); 
        } else {
            $likesCount = 0;
        }
        return  $likesCount ;
    }

public function PostLike(Request $request,$id)
{
    $postId =$id; 
    $userId = Auth::id();
    
  
    if ($postId) {
        
        $like = Like::where('user_id', $userId)
                    ->where('post_id', $postId)
                    ->first();
        
        if ($like) {
            $like->delete();
            $likesCount = $this->CountLike($postId); 
            return redirect()->back()->with('likesCount', $likesCount)->with('success', 'Post unliked successfully');
        } else {
            Like::create(['user_id' => $userId, 'post_id' => $postId]);
            $likesCount = $this->CountLike($postId);
            return redirect()->back()->with('likesCount', $likesCount)->with('success', 'Post liked successfully');
        }
    } else {
        
        dd($postId);
    }
}




}