<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生登録フォーム</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="{{ route('top') }}">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="freshman_register_content">
        <form action="{{ route('freshman.register') }}" method="POST">
            @csrf
            <h1>新入生登録</h1>
            <div class="form">
                <div class="left">
                    <span>氏名</span>
                </div>
                <div class="right">
                    姓<input type="text" name="name_sei" value="{{ old('name_sei') }}" size="15">　名<input type="text" name="name_mei" value="{{ old('name_mei') }}" size="15">
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
                    <input type="text" name="nickname" value="{{ old('nickname') }}" size="39">
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
                    @foreach (config('master.gender') as $index => $value)
                        <input type="radio" name="gender" value="{{ $index }}" @if (old('gender') == $index) checked @endif>{{ $value }}　
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
                    <select name="campus_id">
                        <option value="0" @if (old('campus_id') == 0) selected @endif>--------------------</option>
                        @foreach ($campuses as $campus)
                            <option value="{{ $campus['id'] }}" @if (old('campus_id') == $campus['id']) selected @endif>{{ $campus['name'] }}</option>
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
                    <input type="text" name="email" value="{{ old('email') }}" size="39">
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
                    <textarea name="introduction" cols="38" rows="7">{{ old('introduction') }}</textarea>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="確認画面へ" class="button_1">
            </div>
        </form>
    </div>
</body>
</html>