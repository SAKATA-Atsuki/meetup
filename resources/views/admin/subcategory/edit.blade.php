<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カテゴリ2編集</title>
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
    <div class="admin_form_content">
        <form action="{{ route('admin.subcategory.edit.check') }}" method="POST">
            @csrf
            <h1>カテゴリ2編集</h1>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <span>{{ $subcategory['id'] }}</span>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    @php
                        if (old('circle_category_id') == null) {
                            $circle_category_id = $subcategory['circle_category_id'];
                        } else {
                            $circle_category_id = old('circle_category_id');
                        }
                    @endphp
                    @foreach (config('master.circle_category') as $index => $value)
                        <input type="radio" name="circle_category_id" value="{{ $index }}" @if ($circle_category_id == $index) checked @endif>{{ $value }}　
                    @endforeach
                    @error('circle_category_id')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>名前</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="@if(old('name') == null){{ $subcategory['name'] }}@else{{ old('name') }}@endif" size="39">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="id" value="{{ $subcategory['id'] }}">
                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <a href="{{ route('admin.subcategory', ['page' => $page, 'order' => $order]) }}" class="button_2">カテゴリ2一覧へ</a>    
            </div>
        </form>
    </div>
</body>
</html>