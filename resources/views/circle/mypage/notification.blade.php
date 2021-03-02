<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メール通知設定</title>
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
            <p>{{ Auth::guard('circle')->user()->name }}　様</p>
            <div class="button">
                <a href="{{ route('circle.logout') }}" class="button_4">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="circle_mypage_notification_content">
        <h1>メール通知設定</h1>
        @if (count($reject))
            <p>現在の設定：受信拒否</p>
        @else
            <p>現在の設定：受信許可</p>
        @endif
        <div class="button">
            @if (count($reject))
                <a href="{{ route('circle.mypage.permit') }}" class="button_1">受信を許可する</a>  
            @else
                <a href="{{ route('circle.mypage.reject') }}" class="button_1">受信を拒否する</a>    
            @endif
            <br>
            <a href="{{ route('circle.mypage') }}" class="button_1">マイページへ</a>        
        </div>
    </div>
</body>
</html>