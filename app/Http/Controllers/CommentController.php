<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LikeController; // Corrected namespace
use App\Models\Comment;

class CommentController extends Controller
{
    public $Numberofcomment ;
public function index($id_post)
{     
    $post = Post::find($id_post);
    $userId = Auth::id();
    $comments = Comment::where('post_id',$id_post)->get();
     #dd($comments->content);
    $user = User::select('name')->where('id', $userId)->first();
    $like=new LikeController();     
    $post->likesCount =$like->CountLike($id_post);
    
    return view('front-office.comment', compact('user','post','comments'))->with('userId',$userId); 
   
}
public function AddComment(Request $request,$id_post)
{
    $this->validate($request,[
        'content' => 'required|string|max:255'
   ]); 
   $userId = Auth::id();
   $comment = new Comment([
       'post_id' =>$id_post,
       'user_id' =>$userId,
       'content' =>$request->content
    ]);
    $comment->save();
     
   $this->Numberofcomment =  $this->CountComment($id_post);

    //  $view = new PostController();
    //  $view->home();
   #2---dd($this->Numberofcomment);
   return redirect()->back()->with('success', 'Comment add success!');
   
}


public function CountComment($post_id)
{
    $post = Post::find($post_id);
    if ($post) {
        $commentCount = $post->comments->count(); 
       // dd($commentCount);
    } else {
        $commentCount  = 0;
    }
    return  $commentCount ;

    #1---dd($commentCount);
}
 
public function getNumberOfcomment()
{
    return  $this->Numberofcomment ;
}


public function DeleteComment($_comment)
{         // dd(Comment::where('post_id', $id_post)->delete());
 
  $comment = Comment::findOrfail($_comment);
   $comment->delete();
    return redirect()->back()->with('success', 'Comments deleted successfully!');
}

}

