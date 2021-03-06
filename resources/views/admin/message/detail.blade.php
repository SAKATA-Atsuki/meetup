<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージ詳細</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset("ritsumeikan.jpeg") }}" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('admin') }}">立命館大学<br>新入生・サークル交流サイト　管理画面</a>
        </div>
        <div class="right">
            <p>{{ Auth::guard('admin')->user()->name }}　様</p>
            <div class="button">
                <a href="{{ route('admin.logout') }}" class="button_5">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="admin_check_content">
        <h1>メッセージ詳細</h1>
        <div class="check">
            <div class="left">
                <span>ID</span>
            </div>
            <div class="right">
                <span>{{ $message['id'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>メッセージ</span>
            </div>
            <div class="right">
                <span>{!! nl2br(e($message['content'])) !!}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>スレッド</span>
            </div>
            <div class="right">
                <span>{{ $message->getThreadTitle() }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>作成者</span>
            </div>
            <div class="right">
                @if ($message['freshman_id'] == null)
                    <span>{{ $message->getCircleName() }}</span>
                @else
                    <span>{{ $message->getFreshmanNickname() }}</span>
                @endif
            </div>
        </div>
        <div class="button">
            <a href="{{ route('admin.message', ['page' => $page, 'order' => $order]) }}" class="button_2">メッセージ一覧へ</a>   
        </div>
    </div>
</body>
</html>