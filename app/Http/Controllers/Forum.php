<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum as DBForum;
use App\Models\Forum_comments as DBForum_comments;
use App\Models\Forum_posts as DBForum_posts;
use App\Models\User as DBUser;
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
        $forum->upvotes = $request->upvote;
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
        $posts = DBForum_posts::where('forum_id', $id)->orderBy('isPinned', 'desc')->orderBy('created_at', 'desc')->get();
        foreach ($posts as $post){
            $post->user = DBUser::find($post->user_id);
            $post->comments = DBForum_comments::where('post_id', $post->id)->orderBy('created_at', 'desc')->get();
            foreach ($post->comments as $comment){
                $comment->user = DBUser::find($comment->user_id);
            }
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
}
