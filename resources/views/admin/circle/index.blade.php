<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
        $(function() {
            // 種別が変更されたとき
            $('input[name="circle_category_id"]').change(function() {
                var circle_category_id = $(this).val();

                // circle_category_idの値を渡す
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "{{ route('admin.circle.category') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        circle_category_id: circle_category_id
                    }
                })
                .done(function(data) {
                    // optionタグを全て削除
                    $('select[name="circle_subcategory_id"] option').remove();
                    $('select[name="circle_subcategory_id"]').append($('<option>').attr('value', '').text('--------------------'));

                    // 返ってきたdataをそれぞれoptionタグとして追加
                    $.each(data, function(id, name) {
                        $('select[name="circle_subcategory_id"]').append($('<option>').attr('value', id).text(name));
                    })
                })
                .fail(function() {
                    console.log("失敗");
                })
            })
        })
    </script>
    <title>サークル一覧</title>
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
    <div class="admin_search">
        <form action="{{ route('admin.circle') }}" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="{{ $session_admin_circle_search['id'] }}" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>キャンパス</span>
                </div>
                <div class="right">
                    <select name="campus_id">
                        <option value="">--------------------</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus['id'] }}" @if ($session_admin_circle_search['campus_id'] == $campus['id']) selected @endif>{{ $campus['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    @foreach (config('master.circle_category') as $index => $value)
                        <input type="radio" name="circle_category_id" value="{{ $index }}" @if ($session_admin_circle_search['circle_category_id'] == $index) checked @endif>{{ $value }}　
                    @endforeach
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ2</span>
                </div>
                <div class="right">
                    <select name="circle_subcategory_id">
                        <option value="">--------------------</option>
                        @unless ($session_admin_circle_search['circle_category_id'] == '')
                            @foreach ($circle_subcategories as $circle_subcategory)
                                <option value="{{ $circle_subcategory['id'] }}" @if ($session_admin_circle_search['circle_subcategory_id'] == $circle_subcategory['id']) selected @endif>{{ $circle_subcategory['name'] }}</option>
                            @endforeach    
                        @endunless
                    </select>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="{{ $session_admin_circle_search['free'] }}" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_circle_result">
        <a href="{{ route('admin.circle.register', ['page' => $page, 'order' => $order]) }}" class="button_1">新規登録</a>    
        <div class="title">
            <span class="id">
                ID
                @if ($order == 1)
                    <a href="{{ route('admin.circle', ['page' => $page, 'order' => 2]) }}"><i class="far fa-caret-square-up"></i></a>
                @else
                    <a href="{{ route('admin.circle', ['page' => $page, 'order' => 1]) }}"><i class="far fa-caret-square-down"></i></a>
                @endif
            </span>
            <span class="name">サークル名</span>
            <span class="campus">キャンパス</span>
            <span class="category">カテゴリ1</span>
            <span class="subcategory">カテゴリ2</span>
            <span class="created_at">登録日時</span>
            <span class="edit">編集</span>
            <span class="delete">削除</span>
        </div>
        @foreach ($circles as $circle)
            <div class="content">
                <span class="id">{{ $circle['id'] }}</span>
                <a href="{{ route('admin.circle.detail', ['id' => $circle['id'], 'page' => $page, 'order' => $order]) }}" class="name">{{ $circle['name'] }}</a>
                <span class="campus">{{ $circle->getCampusName() }}</span>
                <span class="category">
                    @foreach (config('master.circle_category') as $index => $value)
                        @if ($circle['circle_category_id'] == $index) {{ $value }} @endif
                    @endforeach
                </span>
                <span class="subcategory">{{ $circle->getCircleSubcategoryName() }}</span>
                <span class="created_at">{{ $circle['created_at'] }}</span>
                <a href="{{ route('admin.circle.edit', ['id' => $circle['id'], 'page' => $page, 'order' => $order]) }}" class="edit">編集</a>
                <a href="{{ route('admin.circle.delete', ['id' => $circle['id'], 'page' => $page, 'order' => $order]) }}" class="delete">削除</a>
            </div>
        @endforeach
    </div>
    <div class="admin_button">
        @if (count($circles))
            @if ($circles->onFirstPage())
                <span class="left_off"></span>
            @else
                <a href="{{ $circles->appends(['order' => $order])->previousPageUrl() }}" class="prev">< 前へ</a>
                <a href="{{ $circles->appends(['order' => $order])->previousPageUrl() }}" class="left_on">{{ $circles->currentPage() - 1 }}</a>
            @endif
            <span class="center">{{ $circles->currentPage() }}</span>
            @if ($circles->hasMorePages())
                <a href="{{ $circles->appends(['order' => $order])->nextPageUrl() }}" class="right_on">{{ $circles->currentPage() + 1 }}</a>
                <a href="{{ $circles->appends(['order' => $order])->nextPageUrl() }}" class="next">次へ ></a>
            @else
                <span class="right_off"></span>
            @endif
        @endif
    </div>
</body>
</html>