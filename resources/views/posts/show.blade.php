@extends('layouts.app')

@section('title', '投稿詳細')

@section('content')

<div class="container">

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

    <h3 class="mt-5">タイトル：{{ $post->title }} の投稿詳細</h3>
    <div class="card mb-2">
        <div class="card-body">
            <div class="d-flex">
                <p class="mb-0 mr-2"><strong>タイトル：</strong></p>
                <p>{{ $post->title }}</p>
            </div>
            <p>{{ $post->comment }}</p>
            <small>投稿者: {{ $post->user->name }} | 投稿日: {{ $post->created_at }}</small>
        </div>
    </div>

    @foreach ($post->comments as $comment)
    <div class="card mb-2">
        <div class="card-body">
            <p>>>{{ $post->title }}</p>
            <p>{{ $comment->comment }}</p>
            <small>投稿者: {{ $comment->user->name }} | 投稿日: {{ $comment->created_at }}</small>

        </div>
    </div>
    @endforeach
    <h3>コメントを追加</h3>
    <form action="{{ route('comments.store') }}" method="POST">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <div class="form-group">
            <label for="comment">コメント</label>
            <textarea name="comment" id="comment" cols="30" rows="5" class="form-control" required></textarea>
        </div>
        <div class="d-flex">
            <button class="btn btn-primary mr-2" type="submit">追加</button>
            <a href="{{ route('posts.index') }}" class="btn btn-primary">戻る</a>
        </div>
    </form>


</div>

@endsection