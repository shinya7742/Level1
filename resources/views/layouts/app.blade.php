<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>投稿一覧</title>
    <style>
        .post-container {
            border-top: 1px solid #ced4da;
            border-bottom: 1px solid #ced4da;
            padding: 15px 0;
        }

        .comment-card {
            background-color: #e6e6e6;
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 10px;
        }

        .whitesmoke {
            background-color: #e6e6e6;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="min-h-screen">
        <nav class="navbar navbar-expand-lg header">
            <div class="container">
                <h1 class="navbar-brand">掲示板アプリ</h1>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        @auth
                        <li class="nav-item">
                            <p class="nav-link">ログイン中：{{ Auth::user()->name }}さん</p>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="btn btn-link nav-link" type="submit">ログアウト</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">ログイン</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">登録</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container mt-5">
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </div>
</body>

</html>