<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生登録</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
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
    <div class="freshman_auth_content">
        <form action="{{ route('freshman.register.store') }}" method="POST">
            @csrf
            <h1>新入生登録</h1>
            <div class="form">
                <div class="left">
                    <span>認証コード</span>
                </div>
                <div class="right">
                    <input type="text" name="auth_code" value="{{ old('auth_code') }}" size="39">
                    @error('auth_code')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="button">
                <input type="submit" value="登録する" class="button_1">
                {{-- <br><br>
                <a href="{{ route('freshman.mypage') }}" class="button_2">マイページへ</a>     --}}
            </div>
        </form>
    </div>
</body>
</html>