<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum as DBForum;
use App\Models\Forum_comments as DBForum_comments;
use App\Models\Forum_posts as DBForum_posts;
use App\Models\User as DBUser;
use App\Models\Upvotes as DBUpvotes;
use Illuminate\Support\Facades\Auth;

class Forum extends Controller
{
    /**
     * Display the list of Fourms avaliable in the site.
     * @return \Illuminate\Http\Response It will load the main site with the list of forums, and if a post is pinned it will show it with the first 300 characters
     */
    public function index() {
        $forums = DBForum::all();
        foreach ($forums as $forum){
            if ($forum->hasPinned){
                $forum->pinnedPost = DBForum_posts::where('forum_id', $forum->id)->where('isPinned', true)->first();
                $forum->pinnedPost->content = substr($forum->pinnedPost->content, 0, 300) . ' ...';
            } else {
                $forum->lastPost = DBForum_posts::where('forum_id', $forum->id)->orderBy('created_at', 'desc')->first();
            }
        }
        $admin = DBUser::where('id', Auth::id())->first();
        if ($admin && ($admin->role == 'admin' || $admin->role == 'superadmin')){
            $users = DBUser::all();
            return view('forum.index', ['forums' => $forums, 'admin' => true, 'users' => $users]);
        } else {
            return view('forum.index', ['forums' => $forums, 'admin' => false]);
        }
    }
    /**
     * It creates the forum in the database.
     * @return \Illuminate\Http\Response It will reload the page with the new forum created.
     */
    public function create(Request $request){
        $request->validate([
            'title' => 'required|max:100',
            'category' => 'required|max:100'
        ]);
        $forum = new DBForum;
        $forum->title = $request->title;
        $forum->category = $request->category;
        $forum->upvotes = $request->upvote == null ? 0 : 1;
        $forum->user_id = DBUser::where('id', $request->admin)->first()->id;
        $forum->save();
        return redirect()->route('forum');
    }

    /**
     * It shows the forum.
     * @param int $id The id of the forum to show.
     * @return \Illuminate\Http\Response It will load the forum with the posts and comments.
     */
    public function viewForum($id){
        $forum = DBForum::find($id);
        if (!$forum){
            abort(404);
        }
        $posts = DBForum_posts::where('forum_id', $id)->orderBy('isPinned', 'desc')->orderBy('created_at', 'desc')->get();
        foreach ($posts as $post){
            $post->user = DBUser::find($post->user_id);
            $post->comments = DBForum_comments::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
            if ($post->comments->count() > 0){
                $post->lastComment = $post->comments->first();
                $post->lastComment->user = DBUser::find($post->lastComment->user_id);
            } else {
                $post->nocoments = true;
            }
            foreach ($post->comments as $comment){
                $comment->user = DBUser::find($comment->user_id);
            }
            $post->upvotes = DBUpvotes::where('post_id', $post->id)->count();
            $post->upvoted = DBUpvotes::where('post_id', $post->id)->where('user_id', Auth::id())->count() > 0;
        }
        return view('forum.view', ['forum' => $forum, 'posts' => $posts]);
    }

    /**
     * It shows the view for creating a new post.
     * @param int $idforum The id of the forum to create the post.
     * @return \Illuminate\Http\Response It will load the view for creating a new post.
     */
    public function createPost_index($idforum){
        $forum = DBForum::find($idforum);
        return view('forum.createPost', ['forum' => $forum]);
    }

    public function createPost(Request $request){
        $request->validate([
            'title' => 'required|max:100',
        ]);
        try{
            $post = new DBForum_posts;
            $post->title = $request->title;
            $post->content = $request->content;
            //Check if inside the content there's a data:image/png;base64, or data:image/jpeg;base64, and if it is, save the image in the database
                $post->content = preg_replace_callback('<img src="data:image\/(png|jpeg);base64,([^"]+)">', function ($matches) {
                    $image = base64_decode($matches[2]);
                    $imageName = time() . '.png';
                    file_put_contents(public_path('images/forum/') . $imageName, $image);
                    //add class img-fluid to the image
                    return 'img src="/images/forum/' . $imageName . '" class="img-fluid"';
                }, $post->content);
            $post->forum_id = $request->forum_id;
            $post->user_id = Auth::id();
            $post->save();
            return response()->json(['success' => 'Post created successfully.']);
        } catch (\Exception $e){
            return response()->json(['error' => 'Error creating post.' . $e->getMessage()]);
        }
    }

    public function viewPost($idforum, $idpost) {
        $post = DBForum_posts::where('id', $idpost)->where('forum_id', $idforum)->first();
        if (!$post){
            abort(404);
        }
        $post->user = DBUser::find($post->user_id);
        $post->comments = DBForum_comments::where('post_id', $idpost)->orderBy('created_at', 'asc')->get();
        foreach ($post->comments as $comment){
            $comment->user = DBUser::find($comment->user_id);
        }
        $post->upvotes = DBUpvotes::where('post_id', $idpost)->count();
        $post->upvoted = DBUpvotes::where('post_id', $idpost)->where('user_id', Auth::id())->count() > 0;
        return view('forum.viewPost', ['post' => $post]);
    }

    public function deletePost(Request $request){
        $post = DBForum_posts::where('id', $request->post_id)->first();
        if ($post){
            $comments = DBForum_comments::where('post_id', $request->post_id)->get();
            foreach ($comments as $comment){
                $comment->delete();
            }
            try{
                $post->delete();
                return response()->json(['success' => 'Post deleted successfully.']);
            } catch (\Exception $e){
                return response()->json(['error' => 'Error deleting post.' . $e->getMessage()]);
            }
        } else {
            return response()->json(['error' => 'Post not found.']);
        }
    }

    public function createComment(Request $request){
        $request->validate([
            'content' => 'required|max:1000',
        ]);
        $post = DBForum_posts::where('id', $request->post_id)->first();
        if ($post){
            try{
                $comment = new DBForum_comments;
                $comment->content = $request->content;
                $comment->post_id = $request->post_id;
                $comment->user_id = Auth::id();
                $comment->forum_id = $post->forum_id;
                $comment->save();
                return response()->json(['success' => 'Comment created successfully.']);
            } catch (\Exception $e){
                return response()->json(['error' => 'Error creating comment.' . $e->getMessage()]);
            }
        } else {
            return response()->json(['error' => 'Post not found.']);
        }
    }

    public function upvote (Request $request){
        $upvote = new DBUpvotes;
        $upvote->post_id = $request->post_id;
        $upvote->user_id = Auth::id();
        $upvote->save();
        return response()->json(['success' => 'Upvote created successfully.']);
    }

    public function deleteUpvote (Request $request){
        $upvote = DBUpvotes::where('post_id', $request->post_id)->where('user_id', Auth::id())->first();
        if ($upvote){
            $upvote->delete();
        }
        return response()->json(['success' => 'Upvote deleted successfully.']);
    }
}
