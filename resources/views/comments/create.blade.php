@extends('layouts.app')

@section('title', 'コメント追加')

@section('content')

<div class="container">
    <h1>コメントを追加</h1>

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