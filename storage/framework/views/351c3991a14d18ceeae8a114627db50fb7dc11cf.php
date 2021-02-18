<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド詳細</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
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
    <div class="admin_check_content">
        <h1>スレッド詳細</h1>
        <div class="check">
            <div class="left">
                <span>ID</span>
            </div>
            <div class="right">
                <span><?php echo e($thread['id']); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>タイトル</span>
            </div>
            <div class="right">
                <span><?php echo e($thread['title']); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>サークル</span>
            </div>
            <div class="right">
                <span><?php echo e($thread->getCircleName()); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>作成者</span>
            </div>
            <div class="right">
                <?php if($thread['freshman_id'] == null): ?>
                    <span><?php echo e($thread->getCircleName()); ?></span>
                <?php else: ?>
                    <span><?php echo e($thread->getFreshmanNickname()); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="button">
            <a href="<?php echo e(route('admin.thread', ['page' => $page, 'order' => $order])); ?>" class="button_2">スレッド一覧へ</a>   
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/thread/detail.blade.php ENDPATH**/ ?>