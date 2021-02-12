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
    <title>サークル編集</title>
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
        <form action="{{ route('admin.circle.edit.check') }}" method="POST">
            @csrf
            <h1>サークル編集</h1>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <span>{{ $circle['id'] }}</span>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="@if(old('name') == null){{ $circle->name }}@else{{ old('name') }}@endif" size="39">
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>キャンパス</span>
                </div>
                <div class="right">
                    @php
                        if (old('campus_id') == null) {
                            $campus_id = $circle->campus_id;
                        } else {
                            $campus_id = old('campus_id');
                        }
                    @endphp
                    <select name="campus_id">
                        <option value="">--------------------</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus['id'] }}" @if ($campus_id == $campus['id']) selected @endif>{{ $campus['name'] }}</option>
                        @endforeach
                    </select>
                    @error('campus_id')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    @php
                        if (old('circle_category_id') == null) {
                            $circle_category_id = $circle->circle_category_id;
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
                    <span>カテゴリ2</span>
                </div>
                <div class="right">
                    @php
                        if (old('circle_subcategory_id') == null) {
                            $circle_subcategory_id = $circle->circle_subcategory_id;
                        } else {
                            $circle_subcategory_id = old('circle_subcategory_id');
                        }
                    @endphp
                    <select name="circle_subcategory_id">
                        @foreach ($circle_subcategories as $circle_subcategory)
                            <option value="{{ $circle_subcategory['id'] }}" @if ($circle_subcategory_id == $circle_subcategory['id']) selected @endif>{{ $circle_subcategory['name'] }}</option>
                        @endforeach    
                    </select>
                    @error('circle_subcategory_id')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <input type="text" name="email" value="@if(old('email') == null){{ $circle['email'] }}@else{{ old('email') }}@endif" size="39">
                    @error('email')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>パスワード</span>
                </div>
                <div class="right">
                    <input type="password" name="password" value="{{ old('password') }}" size="39">
                    @error('password')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>パスワード確認</span>
                </div>
                <div class="right">
                    <input type="password" name="password_check" value="{{ old('password_check') }}" size="39">
                    @error('password_check')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>サークル紹介</span>
                </div>
                <div class="right">
                    <textarea name="introduction" cols="38" rows="7">@if(old('introduction') == null){{ $circle->introduction }}@else{{ old('introduction') }}@endif</textarea>
                </div>
            </div>
            <div class="button">
                <input type="hidden" name="id" value="{{ $circle['id'] }}">
                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <a href="{{ route('admin.circle', ['page' => $page, 'order' => $order]) }}" class="button_2">サークル一覧へ</a>    
            </div>
        </form>
    </div>
</body>
</html>