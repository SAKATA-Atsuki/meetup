<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>サークル詳細</title>
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
        <h1>サークル詳細</h1>
        <div class="check">
            <div class="left">
                <span>ID</span>
            </div>
            <div class="right">
                <span>{{ $circle['id'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>サークル名</span>
            </div>
            <div class="right">
                <span>{{ $circle['name'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>キャンパス</span>
            </div>
            <div class="right">
                <span>{{ $circle->getCampusName() }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ1</span>
            </div>
            <div class="right">
                <span>
                    @foreach (config('master.circle_category') as $index => $value)
                        @if ($circle['circle_category_id'] == $index) {{ $value }} @endif
                    @endforeach
                </span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ2</span>
            </div>
            <div class="right">
                <span>{{ $circle->getCircleSubcategoryName() }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>メールアドレス</span>
            </div>
            <div class="right">
                <span>{{ $circle['email'] }}</span>
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
                <span>{!! nl2br(e($circle['introduction'])) !!}</span>
            </div>
        </div>
        <div class="button">
            <a href="{{ route('admin.circle', ['page' => $page, 'order' => $order]) }}" class="button_2">サークル一覧へ</a>   
        </div>
    </div>
</body>
</html>