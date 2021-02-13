<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カテゴリ2一覧</title>
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
        <form action="{{ route('admin.subcategory') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="{{ $session_admin_subcategory_search['id'] }}" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    @foreach (config('master.circle_category') as $index => $value)
                        <input type="radio" name="circle_category_id" value="{{ $index }}" @if ($session_admin_subcategory_search['circle_category_id'] == $index) checked @endif>{{ $value }}　
                    @endforeach
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="{{ $session_admin_subcategory_search['free'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_subcategory_result">
        <a href="{{ route('admin.subcategory.register', ['page' => $page, 'order' => $order]) }}" class="button_1">新規登録</a>    
        <div class="title">
            <span class="id">
                ID
                @if ($order == 1)
                    <a href="{{ route('admin.subcategory', ['page' => $page, 'order' => 2]) }}"><i class="far fa-caret-square-up"></i></a>
                @else
                    <a href="{{ route('admin.subcategory', ['page' => $page, 'order' => 1]) }}"><i class="far fa-caret-square-down"></i></a>
                @endif
            </span>
            <span class="name">名前</span>
            <span class="category">カテゴリ1</span>
            <span class="created_at">登録日時</span>
            <span class="edit">編集</span>
            <span class="delete">削除</span>
        </div>
        @foreach ($subcategories as $subcategory)
            <div class="content">
                <span class="id">{{ $subcategory['id'] }}</span>
                <a href="{{ route('admin.subcategory.detail', ['id' => $subcategory['id'], 'page' => $page, 'order' => $order]) }}" class="name">{{ $subcategory['name'] }}</a>
                <span class="category">
                    @foreach (config('master.circle_category') as $index => $value)
                        @if ($subcategory['circle_category_id'] == $index) {{ $value }} @endif
                    @endforeach
                </span>
                <span class="created_at">{{ $subcategory['created_at'] }}</span>
                <a href="{{ route('admin.subcategory.edit', ['id' => $subcategory['id'], 'page' => $page, 'order' => $order]) }}" class="edit">編集</a>
                <a href="{{ route('admin.subcategory.delete', ['id' => $subcategory['id'], 'page' => $page, 'order' => $order]) }}" class="delete">削除</a>
            </div>
        @endforeach
    </div>
    <div class="admin_button">
        @if (count($subcategories))
            @if ($subcategories->onFirstPage())
                <span class="left_off"></span>
            @else
                <a href="{{ $subcategories->appends(['order' => $order])->previousPageUrl() }}" class="prev">< 前へ</a>
                <a href="{{ $subcategories->appends(['order' => $order])->previousPageUrl() }}" class="left_on">{{ $subcategories->currentPage() - 1 }}</a>
            @endif
            <span class="center">{{ $subcategories->currentPage() }}</span>
            @if ($subcategories->hasMorePages())
                <a href="{{ $subcategories->appends(['order' => $order])->nextPageUrl() }}" class="right_on">{{ $subcategories->currentPage() + 1 }}</a>
                <a href="{{ $subcategories->appends(['order' => $order])->nextPageUrl() }}" class="next">次へ ></a>
            @else
                <span class="right_off"></span>
            @endif
        @endif
    </div>
</body>
</html>