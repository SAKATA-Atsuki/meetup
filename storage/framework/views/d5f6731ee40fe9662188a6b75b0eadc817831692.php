<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生詳細</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('top')); ?>">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <?php if(Auth::guard('freshman')->check()): ?>
                <p><?php echo e(Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei); ?>　様</p>
                <div class="button">
                    <a href="<?php echo e(route('freshman.mypage')); ?>" class="button_1">マイページ</a>
                    <a href="<?php echo e(route('freshman.logout')); ?>" class="button_2">ログアウト</a>    
                </div>
            <?php elseif(Auth::guard('circle')->check()): ?>
                <p><?php echo e(Auth::guard('circle')->user()->name); ?>　様</p>
                <div class="button">
                    <a href="<?php echo e(route('circle.mypage')); ?>" class="button_3">マイページ</a>
                    <a href="<?php echo e(route('circle.logout')); ?>" class="button_4">ログアウト</a>    
                </div>
            <?php else: ?>
                <div class="form">
                    <div class="freshman">
                        <div class="button">
                            <a href="<?php echo e(route('freshman.login')); ?>" class="button_1">新入生ログイン</a>
                            <a href="<?php echo e(route('freshman.register')); ?>" class="button_2">新入生登録</a>    
                        </div>    
                    </div>
                    <div class="circle">
                        <div class="button">
                            <a href="<?php echo e(route('circle.login')); ?>" class="button_1">サークルログイン</a>
                            <a href="<?php echo e(route('circle.register')); ?>" class="button_2">サークル登録</a>    
                        </div>    
                    </div>    
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="freshman_content">
        <a href="<?php echo e(route('circle.thread', ['id' => $id, 'pg' => $pg, 'page' => $page])); ?>" class="button_1">< スレッド一覧へ</a>    
        <div class="name">
            <span><?php echo e($freshman['nickname']); ?></span>
        </div>
        <span><?php echo e($freshman->getCampusName()); ?></span>
        <div class="introduction">
            <span class="title">自己紹介</span>
            <span class="content"><?php echo nl2br(e($freshman['introduction'])); ?></span>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/freshman/indexThread.blade.php ENDPATH**/ ?>