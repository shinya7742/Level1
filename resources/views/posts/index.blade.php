@extends('layouts.app')

@section('title', '投稿一覧')

@section('content')


<h3>投稿一覧</h3>

<!-- フラッシュメッセージの表示 -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<!-- 投稿一覧を表示 -->
@if ($posts->isEmpty())
<p>投稿がありません</p>
<a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">新しい投稿を作成</a>
@else
<div class="card">
    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-2">新しい投稿を作成</a>
    <div class="card-body">

        @foreach ($posts as $post)
        <div class="post-container">
            <div class="whitesmoke">
                <div class="d-flex">
                    <p class="mb-0 mr-2"><strong>タイトル：</strong></p>
                    <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                </div>
                <div class="mt-3">
                    <p>{{ $post->comment }}</p>
                </div>

                <div>
                    <small>投稿者: {{ $post->user->name }} | 投稿日: {{$post->created_at }}</small>
                    <a href="{{ route('comments.create', $post->id) }}">返信</a>

                    <!-- いいねの実装 -->
                    <div>
                        @if($post->isLikeByAuthUser())
                        <form action="{{ route('likes.destroy', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-sm"><span>&#x1F44D;</span><span class="badge">{{ $post->likes->count() }}</span></button>
                        </form>
                        @else
                        <form action="{{ route('likes.store', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm"><span>&#x1F44D;</span><span class="badge">{{ $post->likes->count() }}</span></button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>



            @if (Auth::id() == $post->user_id)
            <div class="d-flex mt-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary btn-sm mr-2">編集</a>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('削除してよろしいですか?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                </form>
            </div>
            @endif
        </div>



        <!-- コメント一覧 -->
        <div class="mt-3">
            @foreach ($post->comments as $comment)
            <div class="comment-card">
                <div class="ms-4" mt-3>
                    <div>
                        <p>>>{{ $post->title }}</p>
                    </div>

                    <div mt-2>
                        <p>{{ $comment->comment }}</p>
                    </div>

                    <div>
                        <small>投稿者: {{ $comment->user->name }} | 投稿日: {{$comment->created_at }}</small>
                    </div>

                    <!-- いいねの実装 -->
                    <div>
                        @if($post->isLikeByAuthUser())
                        <form action="{{ route('likes.destroy', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-sm"><span>&#x1F44D;</span><span class="badge">{{ $post->likes->count() }}</span></button>
                        </form>
                        @else
                        <form action="{{ route('likes.store', ['id' => $post->id]) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm"><span>&#x1F44D;</span><span class="badge">{{ $post->likes->count() }}</span></button>
                        </form>
                        @endif
                    </div>

                    @if (Auth::id() == $comment->user_id)
                    <div class="d-flex mt-2">
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-sm mr-2">編集</a>
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('削除してよろしいですか?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">削除</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>
@endif
</div>

@endsection