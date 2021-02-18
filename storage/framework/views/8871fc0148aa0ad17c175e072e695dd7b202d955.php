<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド削除</title>
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
    <div class="circle_thread_delete_content">
        <form action="<?php echo e(route('circle.thread.delete')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>スレッド削除</h1>
            <p>本当に削除しますか？</p>
            <div class="button">
                <input type="hidden" name="id" value="<?php echo e($data['id']); ?>">
                <input type="hidden" name="pg" value="<?php echo e($data['pg']); ?>">
                <input type="hidden" name="thread_id" value="<?php echo e($data['thread_id']); ?>">
                <input type="hidden" name="page" value="<?php echo e($data['page']); ?>">
                <input type="submit" value="削除する" class="button_1">
                <br><br>
                <a href="<?php echo e(route('circle.thread.message', ['id' => $data['id'], 'pg' => $data['pg'], 'thread_id' => $data['thread_id'], 'page' => $data['page']])); ?>" class="button_2">スレッド詳細へ</a>    
            </div>    
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/thread/deleteThread.blade.php ENDPATH**/ ?>