<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>管理画面</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset("ritsumeikan.jpeg")); ?>" type="image/x-icon">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('admin')); ?>">立命館大学<br>新入生・サークル交流サイト　管理画面</a>
        </div>
        <div class="right">
            <p><?php echo e(Auth::guard('admin')->user()->name); ?>　様</p>
            <div class="button">
                <a href="<?php echo e(route('admin.logout')); ?>" class="button_5">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="admin_home_content">
        <div class="buttons">
            <a href="<?php echo e(route('admin.campus')); ?>" class="button">キャンパス一覧</a>
            <a href="<?php echo e(route('admin.subcategory')); ?>" class="button">カテゴリ2一覧</a>
            <a href="<?php echo e(route('admin.freshman')); ?>" class="button">新入生一覧</a>
            <a href="<?php echo e(route('admin.circle')); ?>" class="button">サークル一覧</a>
        </div>
        <div class="buttons">
            <a href="<?php echo e(route('admin.thread')); ?>" class="button">スレッド一覧</a>
            <a href="<?php echo e(route('admin.message')); ?>" class="button">メッセージ一覧</a>
            <a href="<?php echo e(route('admin.favorite')); ?>" class="button">お気に入り一覧</a>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/home.blade.php ENDPATH**/ ?>