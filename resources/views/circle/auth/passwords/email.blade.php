<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サークルパスワードリセット</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('top') }}">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="circle_password_reset_content">
        <form action="{{ route('circle.password.email') }}" method="POST">
            @csrf
            <h1>パスワードリセット</h1>
            @if (session('status'))
                <p class="success">{{ session('status') }}</p>
            @endif
            <div class="form">
                <div class="left">
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <input type="text" name="email" value="{{ old('email') }}" size="39">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="button">
                <input type="submit" value="メールを送信" class="button_1">
            </div>
        </form>
    </div>
</body>
</html>