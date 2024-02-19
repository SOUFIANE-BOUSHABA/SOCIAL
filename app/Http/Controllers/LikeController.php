<?php

namespace App\Http\Controllers;

use App\Notifications\PostLiked;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class LikeController extends Controller
{
    public function CountLike($postId)
    {
        $post = Post::find($postId);
        if ($post) {
            $likesCount = $post->likes->count();
        } else {
            $likesCount = 0;
        }
        return  $likesCount;
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
                
                $liker = auth()->user();
                $post = Post::find($postId);

                Notification::send($post->user, new PostLiked($liker, $post));
                
                return redirect()->back()->with('likesCount', $likesCount)->with('success', 'Post liked successfully');
            }
        } else {
            
        }
    }
    
    
}
