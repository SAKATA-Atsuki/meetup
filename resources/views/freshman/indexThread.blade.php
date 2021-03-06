<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生詳細</title>
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
            @if (Auth::guard('freshman')->check())
                <p>{{ Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei }}　様</p>
                <div class="button">
                    <a href="{{ route('freshman.mypage') }}" class="button_1">マイページ</a>
                    <a href="{{ route('freshman.logout') }}" class="button_2">ログアウト</a>    
                </div>
            @elseif (Auth::guard('circle')->check())
                <p>{{ Auth::guard('circle')->user()->name }}　様</p>
                <div class="button">
                    <a href="{{ route('circle.mypage') }}" class="button_3">マイページ</a>
                    <a href="{{ route('circle.logout') }}" class="button_4">ログアウト</a>    
                </div>
            @endif
        </div>
    </div>
    <div class="freshman_content">
        <a href="{{ route('circle.thread', ['id' => $id, 'pg' => $pg, 'page' => $page]) }}" class="button_1">< スレッド一覧へ</a>    
        <div class="name">
            <span>{{ $freshman['nickname'] }}</span>
        </div>
        <span>{{ $freshman->getCampusName() }}</span>
        <div class="introduction">
            <span class="title">自己紹介</span>
            <span class="content">{!! nl2br(e($freshman['introduction'])) !!}</span>
        </div>
    </div>
</body>
</html>