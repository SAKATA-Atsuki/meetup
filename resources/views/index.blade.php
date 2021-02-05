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
                    url: "{{ route('top.category') }}",
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
    <title>立命館大学 - 新入生・サークル交流サイト</title>
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
                    <a href="" class="button_1">アカウント設定</a>
                    <a href="{{ route('freshman.logout') }}" class="button_2">ログアウト</a>    
                </div>
            @elseif (Auth::guard('circle')->check())
                <p>{{ Auth::guard('circle')->user()->name }}　様</p>
                <div class="button">
                    <a href="" class="button_3">アカウント設定</a>
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
    <div class="top_search">
        <form action="" method="POST">
            @csrf
            <div class="form">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="{{ $data['name'] }}" size="39">
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
                            <option value="{{ $campus['id'] }}" @if ($data['campus_id'] == $campus['id']) selected @endif>{{ $campus['name'] }}</option>
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
                        <input type="radio" name="circle_category_id" value="{{ $index }}" @if ($data['circle_category_id'] == $index) checked @endif>{{ $value }}　
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
                        @unless ($data['circle_category_id'] == '')
                            @foreach ($circle_subcategories as $circle_subcategory)
                                <option value="{{ $circle_subcategory['id'] }}" @if ($data['circle_subcategory_id'] == $circle_subcategory['id']) selected @endif>{{ $circle_subcategory['name'] }}</option>
                            @endforeach    
                        @endunless
                    </select>
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="top_result">
        <div class="title">
            <p class="name">サークル名</p>
            <p class="campus">キャンパス</p>
            <p class="circle_category">カテゴリ1</p>
            <p class="circle_subcategory">カテゴリ2</p>
        </div>
        @foreach ($circles as $circle)
            <div class="content">
                <p class="name"><a href="">{{ $circle['name'] }}</a></p>
                <p class="campus">{{ $circle->getCampusName() }}</p>
                @foreach (config('master.circle_category') as $index => $value)
                    @if ($circle['circle_category_id'] == $index)
                        <p class="circle_category">{{ $value }}</p>
                    @endif
                @endforeach
                <p class="circle_subcategory">{{ $circle->getCircleSubcategoryName() }}</p>
            </div>
        @endforeach
        @if (count($circles))
            <div class="button">
                <ul class="pagination">
                    @if ($circles->onFirstPage())
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    @else
                        <li><a href="{{ $circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->previousPageUrl() }}">&lt;</a></li>
                        <li><a href="{{ $circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->previousPageUrl() }}">{{ $circles->currentPage() - 1 }}</a></li>
                    @endif
                    <li><span class="active">{{ $circles->currentPage() }}</span></li>
                    @if ($circles->hasMorePages())
                        <li><a href="{{ $circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->nextPageUrl() }}">{{ $circles->currentPage() + 1 }}</a></li>
                        <li><a href="{{ $circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->nextPageUrl() }}">&gt;</a></li>
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