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
    <div class="freshman_check_content">
        <h1>新入生登録</h1>
        <div class="check">
            <div class="left">
                <span>氏名</span>
            </div>
            <div class="right">
                <span>{{ $data['name_sei'] }}　{{ $data['name_mei'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>ニックネーム</span>
            </div>
            <div class="right">
                <span>{{ $data['nickname'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>性別</span>
            </div>
            <div class="right">
                <span>
                    @foreach (config('master.gender') as $index => $value)
                        @if ($data['gender'] == $index) {{ $value }} @endif
                    @endforeach
                </span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>キャンパス</span>
            </div>
            <div class="right">
                <span>{{ $campus['name'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>メールアドレス</span>
            </div>
            <div class="right">
                <span>{{ $data['email'] }}</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>パスワード</span>
            </div>
            <div class="right">
                <span>セキュリティのため非表示</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>自己紹介</span>
            </div>
            <div class="right">
                <span>{!! nl2br(e($data['introduction'])) !!}</span>
            </div>
        </div>
        <div class="button">
            <form action="{{ route('freshman.register.store') }}" method="POST">
                @csrf
                <input type="hidden" name="name_sei" value="{{ $data['name_sei'] }}">
                <input type="hidden" name="name_mei" value="{{ $data['name_mei'] }}">
                <input type="hidden" name="nickname" value="{{ $data['nickname'] }}">
                <input type="hidden" name="gender" value="{{ $data['gender'] }}">
                <input type="hidden" name="campus_id" value="{{ $data['campus_id'] }}">
                <input type="hidden" name="email" value="{{ $data['email'] }}">
                <input type="hidden" name="password" value="{{ $data['password'] }}">
                <input type="hidden" name="introduction" value="{{ $data['introduction'] }}">
                <input type="submit" value="登録する" class="button_1">
                <br><br>
                <input type="submit" name="back" value="前に戻る" class="button_1">
            </form>
        </div>
    </div>
</body>
</html>