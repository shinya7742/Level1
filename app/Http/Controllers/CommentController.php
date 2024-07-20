<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Like;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::with('user', 'post')->get();
        return view('comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($postId)
    {
        if (Auth::check()) {

            $user = Auth::user();
            if ($user->email === 'guest@example.com') {
                Session::flash('error', 'ゲストユーザーは返信できません');
            } else {
                $post = Post::findOrFail($postId);
                return view('comments.create', compact('post'));
            }
        } else {
            Session::flash('error', 'ゲストユーザーはいいねできません');
        }
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::check()) {

            $user = Auth::user();
            if ($user->email === 'guest@example.com') {
                Session::flash('error', 'ゲストユーザーは返信できません');
            } else {
                $request->validate([
                    'post_id' => 'required|exists:posts,id',
                    'comment' => 'required',
                ]);

                Comment::create([
                    'post_id' => $request->post_id,
                    'user_id' => Auth::id(),
                    'comment' => $request->comment,
                ]);


                return redirect()->route('posts.index', $request->post_id)
                    ->with('success', 'コメントが追加されました');
            }
        } else {
            Session::flash('error', 'ゲストユーザーは返信できません');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return view('comments.show', compact('comment'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        return view('comments.edit', compact('comment'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        $request->validate([
            'comment' => 'required',
        ]);

        $comment->update($request->only('comment'));

        return redirect()->route('posts.show', $comment->post_id)
            ->with('success', 'コメントが更新されました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.index')
            ->with('success', 'コメントが削除されました');
    }
}
