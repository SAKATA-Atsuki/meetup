<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>キャンパス登録</title>
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
        <h1>キャンパス登録</h1>
        <div class="check">
            <div class="left">
                <span>ID</span>
            </div>
            <div class="right">
                <span>登録後に自動採番</span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>キャンパス名</span>
            </div>
            <div class="right">
                <span><?php echo e($data['name']); ?></span>
            </div>
        </div>
        <div class="button">
            <form action="<?php echo e(route('admin.campus.register.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="page" value="<?php echo e($data['page']); ?>">
                <input type="hidden" name="order" value="<?php echo e($data['order']); ?>">
                <input type="hidden" name="name" value="<?php echo e($data['name']); ?>">
                <input type="submit" value="登録する" class="button_1">
                <br><br>
                <input type="submit" name="back" value="前に戻る" class="button_1">
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/campus/checkRegister.blade.php ENDPATH**/ ?>