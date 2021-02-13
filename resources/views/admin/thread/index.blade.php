<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド一覧</title>
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
        <form action="{{ route('admin.thread') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="{{ $session_admin_thread_search['id'] }}" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>サークルID</span>
                </div>
                <div class="right">
                    <input type="text" name="circle_id" value="{{ $session_admin_thread_search['circle_id'] }}" size="39">
                </div>
            </div>  
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="{{ $session_admin_thread_search['free'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_thread_result">
        <div class="title">
            <span class="id">
                ID
                @if ($order == 1)
                    <a href="{{ route('admin.thread', ['page' => $page, 'order' => 2]) }}"><i class="far fa-caret-square-up"></i></a>
                @else
                    <a href="{{ route('admin.thread', ['page' => $page, 'order' => 1]) }}"><i class="far fa-caret-square-down"></i></a>
                @endif
            </span>
            <span class="thread_title">タイトル</span>
            <span class="circle">サークル</span>
            <span class="author">作成者</span>
            <span class="created_at">登録日時</span>
            <span class="delete">削除</span>
        </div>
        @foreach ($threads as $thread)
            <div class="content">
                <span class="id">{{ $thread['id'] }}</span>
                <a href="{{ route('admin.thread.detail', ['id' => $thread['id'], 'page' => $page, 'order' => $order]) }}" class="thread_title">{{ $thread['title'] }}</a>
                <span class="circle">{{ $thread->getCircleName() }}</span>
                @if ($thread['freshman_id'] == null)
                    <span class="author">{{ $thread->getCircleName() }}</span>
                @else
                    <span class="author">{{ $thread->getFreshmanNickname() }}</span>
                @endif
                <span class="created_at">{{ $thread['created_at'] }}</span>
                <a href="{{ route('admin.thread.delete', ['id' => $thread['id'], 'page' => $page, 'order' => $order]) }}" class="delete">削除</a>
            </div>
        @endforeach
    </div>
    <div class="admin_button">
        @if (count($threads))
            @if ($threads->onFirstPage())
                <span class="left_off"></span>
            @else
                <a href="{{ $threads->appends(['order' => $order])->previousPageUrl() }}" class="prev">< 前へ</a>
                <a href="{{ $threads->appends(['order' => $order])->previousPageUrl() }}" class="left_on">{{ $threads->currentPage() - 1 }}</a>
            @endif
            <span class="center">{{ $threads->currentPage() }}</span>
            @if ($threads->hasMorePages())
                <a href="{{ $threads->appends(['order' => $order])->nextPageUrl() }}" class="right_on">{{ $threads->currentPage() + 1 }}</a>
                <a href="{{ $threads->appends(['order' => $order])->nextPageUrl() }}" class="next">次へ ></a>
            @else
                <span class="right_off"></span>
            @endif
        @endif
    </div>
</body>
</html>