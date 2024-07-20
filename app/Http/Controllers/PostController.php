<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function index()
    {

        //postsテーブルから全ての投稿を取得し、 userリレーションシップをロード
        $posts = Post::with(['user', 'likes'])->get();

        //posts.indexビューにデータを渡す
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->email === 'guest@example.com') {
                Session::flash('error', 'ゲストユーザーは投稿できません');
            } else {
                return view('posts.create');
            }
        } else {
            Session::flash('error', 'ゲストユーザーは投稿できません');
        }
        return redirect()->back();
    }
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'comment' => 'required',
        ]);

        //投稿を保存
        Post::create([
            'title' => $request->title,
            'comment' => $request->comment,
            'user_id' => Auth::id(),
        ]);

        //フラッシュメッセージを設定・リダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が作成されました');
    }

    public function show(Post $post)
    {
        //単一の投稿を表示
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        //編集画面を表示
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request,  Post $post)
    {
        //バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'comment' => 'required',
        ]);

        //投稿を更新
        $post->update([
            'title' => $request->title,
            'comment' => $request->comment,
        ]);

        // フラッシュメッセージを設定・リダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が更新されました');
    }

    public function destroy(Post $post)
    {
        //投稿を削除
        $post->delete();

        //フラッシュメッセージを設定・リダイレクト
        return redirect()->route('posts.index')->with('success', '投稿が削除されました');
    }
}
