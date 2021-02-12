<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>キャンパス削除</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
        <form action="{{ route('admin.campus.delete') }}" method="POST">
            @csrf
            <h1>キャンパス削除</h1>
            <p>本当に削除しますか？</p>
            <div class="button">
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <input type="hidden" name="order" value="{{ $data['order'] }}">
                <input type="submit" value="削除する" class="button_1">
                <br><br>
                <a href="{{ route('admin.campus', ['page' => $data['page'], 'order' => $data['order']]) }}" class="button_2">キャンパス一覧へ</a>    
            </div>    
        </form>
    </div>
</body>
</html>