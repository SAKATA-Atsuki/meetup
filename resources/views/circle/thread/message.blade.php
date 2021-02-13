<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド詳細</title>
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
    <div class="circle_thread_message_content">
        <a href="{{ route('circle.thread', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page]) }}" class="button_1">< スレッド一覧へ</a>    
        <div class="name">
            <span>{{ $circle['name'] }}</span>
            @if (Auth::guard('freshman')->check())
                @if (count($favorite) == 0)
                    <a href="{{ route('circle.thread.message.favorite', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page]) }}" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                @else
                    <a href="{{ route('circle.thread.message.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page]) }}" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
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
    <div class="circle_thread_message_title">
        <div class="content">
            <div class="top">
                <span class="title">{{ $thread['title'] }}</span>
                @if (Auth::guard('freshman')->check())
                    @if (Auth::guard('freshman')->user()->id == $thread['freshman_id'])
                        <a href="{{ route('circle.thread.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'freshman_id' => $thread['freshman_id']]) }}" class="trash"><i class="fas fa-trash-alt"></i></a>
                    @endif
                @endif
                @if (Auth::guard('circle')->check())
                    @if (Auth::guard('circle')->user()->id == $thread['circle_id'])
                        <a href="{{ route('circle.thread.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id']]) }}" class="trash"><i class="fas fa-trash-alt"></i></a>
                    @endif
                @endif
            </div>
            @if ($thread['freshman_id'] == null)
                <span>作成者　<span class="circle">{{ $thread->getCircleName() }}</span></span>
                <br>
                <span>作成日時　{{ $thread['created_at'] }}</span>
            @else
                @if (App\Models\Freshman::find($thread['freshman_id']))
                    <span>作成者　<a href="{{ route('circle.thread.message.freshman', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'freshman_id' => $thread['freshman_id']]) }}" class="freshman">{{ $thread->getFreshmanNickname() }}</a></span>
                @else
                    <span>作成者　<span class="freshman">{{ $thread->getFreshmanNickname() }}</span></span>
                @endif
                <br>
                <span>作成日時　{{ $thread['created_at'] }}</span>
            @endif    
        </div>
    </div>
    <div class="circle_thread_message_list">
        @foreach ($messages as $message)
            <div class="content">
                @if ($message['deleted_at'] == null)
                    <div class="top">
                        @if ($message['freshman_id'] == null)
                            <span class="circle">{{ $message->getCircleName() }}</span>
                        @else
                            @if (App\Models\Freshman::find($message['freshman_id']))
                                <a href="{{ route('circle.thread.message.freshman', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'freshman_id' => $message['freshman_id']]) }}" class="freshman">{{ $message->getFreshmanNickname() }}</a>
                            @else
                                <span class="freshman">{{ $message->getFreshmanNickname() }}</span>
                            @endif
                        @endif    
                        @if (Auth::guard('freshman')->check())
                            @if (Auth::guard('freshman')->user()->id == $message['freshman_id'])
                                <a href="{{ route('circle.thread.message.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'message_id' => $message['id'], 'freshman_id' => $message['freshman_id']]) }}" class="trash"><i class="fas fa-trash-alt"></i></a>
                            @endif
                        @endif
                        @if (Auth::guard('circle')->check())
                            @if (Auth::guard('circle')->user()->id == $message['circle_id'])
                                <a href="{{ route('circle.thread.message.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'message_id' => $message['id']]) }}" class="trash"><i class="fas fa-trash-alt"></i></a>
                            @endif
                        @endif
                    </div>
                    <span>{{ $message['created_at'] }}</span>
                    <div class="message">
                        <span>{!! nl2br(e($message['content'])) !!}</span>
                    </div>
                @else
                    <p>削除されました。</p>
                @endif
            </div>
        @endforeach
        @if (Auth::guard('freshman')->check())
            <form action="{{ route('circle.thread.message.store') }}" method="POST">
                @csrf
                <div class="form">
                    <textarea name="content" cols="133" rows="10"></textarea>
                    @error('content')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div class="button">
                    <input type="hidden" name="id" value="{{ $circle['id'] }}">
                    <input type="hidden" name="pg" value="{{ $pg }}">
                    <input type="hidden" name="thread_id" value="{{ $thread['id'] }}">
                    <input type="hidden" name="page" value="{{ $page }}">
                    <input type="submit" value="投稿する" class="button_1">
                </div>        
            </form>
        @endif
        @if (Auth::guard('circle')->check())
            @if (Auth::guard('circle')->user()->id == $circle['id'])
                <form action="{{ route('circle.thread.message.store') }}" method="POST">
                    @csrf
                    <div class="form">
                        <textarea name="content" cols="133" rows="10"></textarea>
                        @error('content')
                            <p class="error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="button">
                        <input type="hidden" name="id" value="{{ $circle['id'] }}">
                        <input type="hidden" name="pg" value="{{ $pg }}">
                        <input type="hidden" name="thread_id" value="{{ $thread['id'] }}">
                        <input type="hidden" name="page" value="{{ $page }}">
                        <input type="submit" value="投稿する" class="button_1">
                    </div>        
                </form>
            @endif
        @endif
    </div>
</body>
</html>