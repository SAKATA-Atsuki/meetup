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
    <div class="circle_thread_content">
        <a href="{{ route('circle', ['id' => $circle['id'], 'pg' => $pg]) }}" class="button_1">< サークル詳細へ</a>    
        <div class="name">
            <span>{{ $circle['name'] }}</span>
            @if (Auth::guard('freshman')->check())
                @if (count($favorite) == 0)
                    <a href="{{ route('circle.thread.favorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                    <a href="{{ route('circle.thread.favorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_4"><i class="far fa-heart"></i></a>
                @else
                    <a href="{{ route('circle.thread.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
                    <a href="{{ route('circle.thread.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_4"><i class="fas fa-heart"></i></a>
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
    <div class="circle_thread_search">
        <form action="{{ route('circle.thread') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>スレッドタイトル</span>
                </div>
                <div class="right">
                    <input type="text" name="title" value="{{ $session_circle_thread_search['title'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="id" value="{{ $circle['id'] }}">
                <input type="hidden" name="pg" value="{{ $pg }}">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="circle_thread_result">
        @if (Auth::guard('freshman')->check())
            <a href="{{ route('circle.thread.register', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_1">スレッド作成</a>    
        @endif
        @if (Auth::guard('circle')->check())
            @if (Auth::guard('circle')->user()->id == $circle['id'])
                <a href="{{ route('circle.thread.register', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_1">スレッド作成</a>    
            @endif
        @endif
        <div class="title">
            <p class="thread_title">スレッドタイトル</p>
            <p class="number">メッセージ数</p>
            <p class="author">作成者</p>
        </div>
        @foreach ($threads as $thread)
            <div class="content">
                <p class="thread_title"><a href="{{ route('circle.thread.message', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page]) }}">
                    @if (mb_strlen($thread['title']) > 25)
                        {{ mb_substr($thread['title'], 0, 25) }}…
                    @else
                        {{ $thread['title'] }}
                    @endif
                </a></p>
                <p class="number">{{ count(App\Models\Message::where('thread_id', $thread['id'])->get()) }}</p>
                @if ($thread['freshman_id'] == null)
                    <p class="author circle">{{ $thread->getCircleName() }}</p>
                @else
                    @if (App\Models\Freshman::find($thread['freshman_id']))
                        <p class="author"><a href="{{ route('circle.thread.freshman', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page, 'freshman_id' => $thread['freshman_id']]) }}" class="freshman">{{ $thread->getFreshmanNickname() }}</a></p>
                    @else
                        <p class="author freshman">{{ $thread->getFreshmanNickname() }}</p>
                    @endif
                @endif
            </div>
        @endforeach
        @if (count($threads))
            <div class="button">
                <ul class="pagination">
                    @if ($threads->onFirstPage())
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    @else
                        <li><a href="{{ $threads->appends(['id' => $circle['id'], 'pg' => $pg])->previousPageUrl() }}">&lt;</a></li>
                        <li><a href="{{ $threads->appends(['id' => $circle['id'], 'pg' => $pg])->previousPageUrl() }}">{{ $threads->currentPage() - 1 }}</a></li>
                    @endif
                    <li><span class="active">{{ $threads->currentPage() }}</span></li>
                    @if ($threads->hasMorePages())
                        <li><a href="{{ $threads->appends(['id' => $circle['id'], 'pg' => $pg])->nextPageUrl() }}">{{ $threads->currentPage() + 1 }}</a></li>
                        <li><a href="{{ $threads->appends(['id' => $circle['id'], 'pg' => $pg])->nextPageUrl() }}">&gt;</a></li>
                    @else
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    @endif
                </ul>
            </div>
        @endif
    </div>
</body>
</html>