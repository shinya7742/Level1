@extends('layouts.app')

@section('title', '投稿編集')

@section('content')

<h1 class="my-4">投稿編集</h1>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group">
        <label for="title">タイトル</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
    </div>
    <div class="form-group">
        <label for="comment">内容</label>
        <textarea class="form-control" id="comment" name="comment" rows="4" required>{{ $post->comment }}</textarea>
    </div>
    <div class="d-flex">
        <button type="submit" class="btn btn-primary mr-2">更新</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
    </div>
</form>

</div>

@endsection