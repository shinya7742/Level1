<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; // セッションファサードのインポート

class LikeController extends Controller
{

    /**
     * 引数のIDに紐づくリプライにLIKEする
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store($id)
    {
        if (Auth::check()) {

            $user = Auth::user();
            if ($user->email === 'guest@example.com') {
                Session::flash('error', 'ゲストユーザーはいいねできません');
            } else {
                Like::create([
                    'post_id' => $id,
                    'user_id' => Auth::id(),
                ]);

                Session::flash('success', '”いいね！”を登録しました');
            }
        } else {
            Session::flash('error', 'ゲストユーザーはいいねできません');
        }
        return redirect()->back();
    }

    /**
     * 引数のIDに紐づくリプライにUnlikeする
     *
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($id)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->email === 'guest@example.com') {
                Session::flash('error', 'ゲストユーザーはいいねできません');
            } else {
                $like = Like::where('post_id', $id)->where('user_id', Auth::id())->first();

                if ($like) {
                    $like->delete();
                    Session::flash('success', '”いいね！”を取り消しました');
                }
            }
        } else {
            Session::flash('error', 'ゲストユーザーはいいねできません');
        }

        return redirect()->back();
    }
}
