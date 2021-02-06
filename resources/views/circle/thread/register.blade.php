<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド作成フォーム</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
                    <a href="" class="button_1">マイページ</a>
                    <a href="{{ route('freshman.logout') }}" class="button_2">ログアウト</a>    
                </div>
            @elseif (Auth::guard('circle')->check())
                <p>{{ Auth::guard('circle')->user()->name }}　様</p>
                <div class="button">
                    <a href="" class="button_3">マイページ</a>
                    <a href="{{ route('circle.logout') }}" class="button_4">ログアウト</a>    
                </div>
            @else
                <div class="form">
                    <div class="freshman">
                        <div class="button">
                            <a href="{{ route('freshman.login') }}" class="button_1">新入生ログイン</a>
                            <a href="{{ route('freshman.register') }}" class="button_2">新入生登録</a>    
                        </div>    
                    </div>
                    <div class="circle">
                        <div class="button">
                            <a href="{{ route('circle.login') }}" class="button_1">サークルログイン</a>
                            <a href="{{ route('circle.register') }}" class="button_2">サークル登録</a>    
                        </div>    
                    </div>    
                </div>
            @endif
        </div>
    </div>
    <div class="circle_thread_register_content">
        <a href="{{ route('circle.thread', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_1">< スレッド一覧へ</a>    
        <div class="name">
            <span>{{ $circle['name'] }}</span>
            @if (Auth::guard('freshman')->check())
                @if (count($favorite) == 0)
                    <a href="{{ route('circle.thread.register.favorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                @else
                    <a href="{{ route('circle.thread.register.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
                @endif
            @endif
        </div>
        <span>{{ $circle->getCampusName() }}</span>
        @foreach (config('master.circle_category') as $index => $value)
            @if ($circle['circle_category_id'] == $index)
                <span>　{{ $value }}　</span>
            @endif
        @endforeach
        <span>{{ $circle->getCircleSubcategoryName() }}</span>
    </div>
    <form action="{{ route('circle.thread.register.store') }}" method="POST">
        @csrf
        <div class="circle_thread_register_form">
            <div class="left">
                <span>スレッドタイトル</span>
            </div>
            <div class="right">
                <input type="text" name="title" value="{{ old('title') }}" size="39">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>    
        </div>
        <div class="circle_thread_register_button">
            <input type="hidden" name="id" value="{{ $circle['id'] }}">
            <input type="hidden" name="pg" value="{{ $pg }}">
            <input type="submit" value="作成する" class="button_1">
        </div>    
    </form>
</body>
</html>