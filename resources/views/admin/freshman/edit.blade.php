<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生編集</title>
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
        <form action="{{ route('admin.freshman.edit.check') }}" method="POST">
            @csrf
            <h1>新入生編集</h1>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <span>{{ $freshman['id'] }}</span>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>氏名</span>
                </div>
                <div class="right">
                    姓<input type="text" name="name_sei" value="@if(old('name_sei') == null){{ $freshman['name_sei'] }}@else{{ old('name_sei') }}@endif" size="15">　名<input type="text" name="name_mei" value="@if(old('name_mei') == null){{ $freshman['name_mei'] }}@else{{ old('name_mei') }}@endif" size="15">
                    @error('name_sei')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @error('name_mei')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>ニックネーム</span>
                </div>
                <div class="right">
                    <input type="text" name="nickname" value="@if(old('nickname') == null){{ $freshman['nickname'] }}@else{{ old('nickname') }}@endif" size="39">
                    @error('nickname')
                        <p class="error">{{ $message }}</p>
                    @enderror    
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>性別</span>
                </div>
                <div class="right">
                    @php
                        if (old('gender') == null) {
                            $gender = $freshman['gender'];
                        } else {
                            $gender = old('gender');
                        }
                    @endphp
                    @foreach (config('master.gender') as $index => $value)
                        <input type="radio" name="gender" value="{{ $index }}" @if ($gender == $index) checked @endif>{{ $value }}　
                    @endforeach
                    @error('gender')
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
                            $campus_id = $freshman['campus_id'];
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
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <input type="text" name="email" value="@if(old('email') == null){{ $freshman['email'] }}@else{{ old('email') }}@endif" size="39">
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
                    <span>自己紹介</span>
                </div>
                <div class="right">
                    <textarea name="introduction" cols="38" rows="7">@if(old('introduction') == null){{ $freshman['introduction'] }}@else{{ old('introduction') }}@endif</textarea>
                </div>
            </div>
            <div class="button">
                <input type="hidden" name="id" value="{{ $freshman['id'] }}">
                <input type="hidden" name="page" value="{{ $page }}">
                <input type="hidden" name="order" value="{{ $order }}">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <a href="{{ route('admin.freshman', ['page' => $page, 'order' => $order]) }}" class="button_2">新入生一覧へ</a>    
            </div>
        </form>
    </div>
</body>
</html>