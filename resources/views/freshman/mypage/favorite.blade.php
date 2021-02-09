<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お気に入りしたサークル</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('top') }}">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <p>{{ Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei }}　様</p>
            <div class="button">
                <a href="{{ route('freshman.logout') }}" class="button_2">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="freshman_mypage_favorite_content">
        <a href="{{ route('freshman.mypage') }}" class="button_1">< マイページへ</a>    
        <div class="title">
            <p class="name">サークル名</p>
            <p class="campus">キャンパス</p>
            <p class="circle_category">カテゴリ1</p>
            <p class="circle_subcategory">カテゴリ2</p>
        </div>
        @foreach ($favorites as $favorite)
            <div class="content">
                <p class="name"><a href="{{ route('freshman.mypage.favorite.circle', ['id' => $favorite['circle_id']]) }}">
                    {{ $favorite->getCircleName() }}
                </a></p>
                <p class="campus">{{ App\Models\Campus::find($favorite->getCircleCampusId())->name }}</p>
                @foreach (config('master.circle_category') as $index => $value)
                    @if ($favorite->getCircleCircleCategoryId() == $index)
                        <p class="circle_category">{{ $value }}</p>
                    @endif
                @endforeach
                <p class="circle_subcategory">{{ App\Models\Circle_subcategory::find($favorite->getCircleCircleSubcategoryId())->name }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>