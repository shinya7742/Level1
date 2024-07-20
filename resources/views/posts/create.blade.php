@extends('layouts.app')

@section('title', '新しい投稿を作成')

@section('content')

<div class="container">
    <h1 class="my-4">新しい投稿を作成</h1>

    <!-- 投稿フォーム -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">タイトル</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="comment">内容</label>
                    <textarea class="form-control" id="comment" name="comment" rows="4" required></textarea>
                </div>
                <div class="d-flex">
                    <button type="submit" class="btn btn-primary mr-2">投稿</button>
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection