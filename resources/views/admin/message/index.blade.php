<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージ一覧</title>
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
        <form action="{{ route('admin.message') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="{{ $session_admin_message_search['id'] }}" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>スレッドID</span>
                </div>
                <div class="right">
                    <input type="text" name="thread_id" value="{{ $session_admin_message_search['thread_id'] }}" size="39">
                </div>
            </div>  
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="{{ $session_admin_message_search['free'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_message_result">
        <div class="title">
            <span class="id">
                ID
                @if ($order == 1)
                    <a href="{{ route('admin.message', ['page' => $page, 'order' => 2]) }}"><i class="far fa-caret-square-up"></i></a>
                @else
                    <a href="{{ route('admin.message', ['page' => $page, 'order' => 1]) }}"><i class="far fa-caret-square-down"></i></a>
                @endif
            </span>
            <span class="message">メッセージ</span>
            <span class="thread_title">スレッド</span>
            <span class="author">作成者</span>
            <span class="created_at">登録日時</span>
            <span class="delete">削除</span>
        </div>
        @foreach ($messages as $message)
            <div class="content">
                <span class="id">{{ $message['id'] }}</span>
                <a href="{{ route('admin.message.detail', ['id' => $message['id'], 'page' => $page, 'order' => $order]) }}" class="message">
                    @if (mb_strlen($message['content']) > 13)
                        {{ mb_substr($message['content'], 0, 13) }}…
                    @else
                        {{ $message['content'] }}
                    @endif
                </a>
                <span class="thread_title">{{ $message->getThreadTitle() }}</span>
                @if ($message['freshman_id'] == null)
                    <span class="author">{{ $message->getCircleName() }}</span>
                @else
                    <span class="author">{{ $message->getFreshmanNickname() }}</span>
                @endif
                <span class="created_at">{{ $message['created_at'] }}</span>
                <a href="{{ route('admin.message.delete', ['id' => $message['id'], 'page' => $page, 'order' => $order]) }}" class="delete">削除</a>
            </div>
        @endforeach
    </div>
    <div class="admin_button">
        @if (count($messages))
            @if ($messages->onFirstPage())
                <span class="left_off"></span>
            @else
                <a href="{{ $messages->appends(['order' => $order])->previousPageUrl() }}" class="prev">< 前へ</a>
                <a href="{{ $messages->appends(['order' => $order])->previousPageUrl() }}" class="left_on">{{ $messages->currentPage() - 1 }}</a>
            @endif
            <span class="center">{{ $messages->currentPage() }}</span>
            @if ($messages->hasMorePages())
                <a href="{{ $messages->appends(['order' => $order])->nextPageUrl() }}" class="right_on">{{ $messages->currentPage() + 1 }}</a>
                <a href="{{ $messages->appends(['order' => $order])->nextPageUrl() }}" class="next">次へ ></a>
            @else
                <span class="right_off"></span>
            @endif
        @endif
    </div>
</body>
</html>