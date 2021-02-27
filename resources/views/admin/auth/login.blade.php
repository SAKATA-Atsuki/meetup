<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理者ログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset("ritsumeikan.jpeg") }}" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('admin') }}">立命館大学<br>新入生・サークル交流サイト　管理画面</a>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="admin_login_content">
        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <h1>管理者ログイン</h1>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="login_id" value="{{ old('login_id') }}" size="39">
                    @error('login_id')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form">
                <div class="left">
                    <span>パスワード</span>
                </div>
                <div class="right">
                    <input type="password" name="password" value="{{ old('password') }}" size="39">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="button">
                <input type="submit" value="ログイン" class="button_1">
            </div>
        </form>
    </div>
</body>
</html>