<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>キャンパス一覧</title>
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
    <div class="admin_search">
        <form action="{{ route('admin.campus') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="{{ $session_admin_campus_search['id'] }}" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="{{ $session_admin_campus_search['free'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_campus_result">
        <a href="{{ route('admin.campus.register', ['page' => $page]) }}" class="button_1">新規登録</a>    
        <div class="title">
            <span class="id">
                ID
                @if ($order == 1)
                    <a href="{{ route('admin.campus', ['page' => $page, 'order' => 2]) }}"><i class="far fa-caret-square-up"></i></a>
                @else
                    <a href="{{ route('admin.campus', ['page' => $page, 'order' => 1]) }}"><i class="far fa-caret-square-down"></i></a>
                @endif
            </span>
            <span class="name">キャンパス名</span>
            <span class="created_at">登録日時</span>
            <span class="edit">編集</span>
            <span class="delete">削除</span>
        </div>
        @foreach ($campuses as $campus)
            <div class="content">
                <span class="id">{{ $campus['id'] }}</span>
                <a href="{{ route('admin.campus.detail', ['id' => $campus['id'], 'page' => $page]) }}" class="name">{{ $campus['name'] }}</a>
                <span class="created_at">{{ $campus['created_at'] }}</span>
                <a href="{{ route('admin.campus.edit', ['id' => $campus['id'], 'page' => $page]) }}" class="edit">編集</a>
                <a href="{{ route('admin.campus.delete', ['id' => $campus['id'], 'page' => $page]) }}" class="delete">削除</a>
            </div>
        @endforeach
    </div>
    <div class="admin_button">
        @if (count($campuses))
            @if ($campuses->onFirstPage())
                <span class="left_off"></span>
            @else
                <a href="{{ $campuses->appends(['order' => $order])->previousPageUrl() }}" class="prev">< 前へ</a>
                <a href="{{ $campuses->appends(['order' => $order])->previousPageUrl() }}" class="left_on">{{ $campuses->currentPage() - 1 }}</a>
            @endif
            <span class="center">{{ $campuses->currentPage() }}</span>
            @if ($campuses->hasMorePages())
                <a href="{{ $campuses->appends(['order' => $order])->nextPageUrl() }}" class="right_on">{{ $campuses->currentPage() + 1 }}</a>
                <a href="{{ $campuses->appends(['order' => $order])->nextPageUrl() }}" class="next">次へ ></a>
            @else
                <span class="right_off"></span>
            @endif
        @endif
    </div>
</body>
</html>