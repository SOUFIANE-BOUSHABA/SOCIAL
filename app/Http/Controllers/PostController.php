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

    public function Findunername($onerid){
        $oner=User::where('id',$onerid)->value('name');
        return $oner;
    }
    public function home(){


        $posts = Post::all();
        // $comments=Comment::all();
        $userId = Auth::id();
        $user=User::select('name')->where('id', $userId)->first();

        // dd($posts[0]->user->name);

         foreach ($posts as $post) {
            $post->onerpost = $this->Findunername($post->user_id);
            $post->likesCount = $this->CountLike($post->id);
       }

    //     foreach ($posts as $post) {
    //          $post->likesCount = $this->CountLike($post->id);
    //     }
    //    $commentN=new CommentController(); 


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
        $iduser = Auth::id();
        $post = Post::where('id', $id)->where('user_id', $iduser)->first();
    
        if($post){
            Comment::where('post_id', $id)->delete();
            Like::where('post_id', $id)->delete();
            $post->delete();
            return redirect()->back()->with('success', 'Post delete success!');
        }else{
            return 'Post not found or you do not have permission to delete this post.';
        }
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






}
