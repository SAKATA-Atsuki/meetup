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
                    url: "{{ route('circle.mypage.profile.category') }}",
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
    <title>プロフィール変更</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset("ritsumeikan.jpeg") }}" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('top') }}">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <p>{{ Auth::guard('circle')->user()->name }}　様</p>
            <div class="button">
                <a href="{{ route('circle.logout') }}" class="button_4">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="circle_mypage_profile_edit_content">
        <form action="{{ route('circle.mypage.profile.check') }}" method="POST">
            @csrf
            <h1>プロフィール変更</h1>
            <div class="form">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="@if(old('name') == null){{ Auth::guard('circle')->user()->name }}@else{{ old('name') }}@endif" size="39">
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
                            $campus_id = Auth::guard('circle')->user()->campus_id;
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
                            $circle_category_id = Auth::guard('circle')->user()->circle_category_id;
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
                            $circle_subcategory_id = Auth::guard('circle')->user()->circle_subcategory_id;
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
                    <span>サークル紹介</span>
                </div>
                <div class="right">
                    <textarea name="introduction" cols="38" rows="7">@if(old('introduction') == null){{ Auth::guard('circle')->user()->introduction }}@else{{ old('introduction') }}@endif</textarea>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <a href="{{ route('circle.mypage') }}" class="button_2">マイページへ</a>    
            </div>
        </form>
    </div>
</body>
</html>