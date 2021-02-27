<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サークル編集</title>
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
        <h1>サークル編集</h1>
        <div class="check">
            <div class="left">
                <span>ID</span>
            </div>
            <div class="right">
                <span>{{ $data['id'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>サークル名</span>
            </div>
            <div class="right">
                <span>{{ $data['name'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>キャンパス</span>
            </div>
            <div class="right">
                <span>{{ $campus['name'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ1</span>
            </div>
            <div class="right">
                <span>
                    @foreach (config('master.circle_category') as $index => $value)
                        @if ($data['circle_category_id'] == $index) {{ $value }} @endif
                    @endforeach
                </span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ2</span>
            </div>
            <div class="right">
                <span>{{ $circle_subcategory['name'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>メールアドレス</span>
            </div>
            <div class="right">
                <span>{{ $data['email'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>パスワード</span>
            </div>
            <div class="right">
                <span>セキュリティのため非表示</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>サークル紹介</span>
            </div>
            <div class="right">
                <span>{!! nl2br(e($data['introduction'])) !!}</span>
            </div>
        </div>
        <div class="button">
            <form action="{{ route('admin.circle.edit.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $data['id'] }}">
                <input type="hidden" name="page" value="{{ $data['page'] }}">
                <input type="hidden" name="order" value="{{ $data['order'] }}">
                <input type="hidden" name="name" value="{{ $data['name'] }}">
                <input type="hidden" name="campus_id" value="{{ $data['campus_id'] }}">
                <input type="hidden" name="circle_category_id" value="{{ $data['circle_category_id'] }}">
                <input type="hidden" name="circle_subcategory_id" value="{{ $data['circle_subcategory_id'] }}">
                <input type="hidden" name="email" value="{{ $data['email'] }}">
                <input type="hidden" name="password" value="{{ $data['password'] }}">
                <input type="hidden" name="introduction" value="{{ $data['introduction'] }}">
                <input type="submit" value="編集する" class="button_1">
                <br><br>
                <input type="submit" name="back" value="前に戻る" class="button_1">
            </form>
        </div>
    </div>
</body>
</html>