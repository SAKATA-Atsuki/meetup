<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サークルログイン</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset("ritsumeikan.jpeg") }}" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('top') }}">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="circle_login_content">
        <form action="{{ route('circle.login') }}" method="POST">
            @csrf
            <h1>サークルログイン</h1>
            <div class="form">
                <div class="left">
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <input type="text" name="email" value="{{ old('email') }}" size="39" placeholder="ab0123cd@ed.ritsumei.ac.jp">
                    @error('email')
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
                    <br>
                    <a href="{{ route('circle.password.request') }}">パスワードを忘れた方はこちら</a>
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