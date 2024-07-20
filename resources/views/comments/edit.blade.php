@extends('layouts.app')

@section('title', 'コメント編集')

@section('content')

<div class="container">
    <h1>コメント編集</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="comment">コメント内容</label>
            <textarea name="comment" id="comment" cols="30" rows="10" class="form-control" required>{{ old('comment', $comment->comment) }}</textarea>
        </div>
        <div class="d-flex">
            <button type="submit" class="btn btn-primary mr-2">更新</button>
            <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
        </div>
    </form>


</div>

@endsection