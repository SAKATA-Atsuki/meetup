<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メールアドレス変更フォーム</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('top')); ?>">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <p><?php echo e(Auth::guard('circle')->user()->name); ?>　様</p>
            <div class="button">
                <a href="<?php echo e(route('circle.logout')); ?>" class="button_4">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="circle_mypage_withdrawal_content">
        <form action="<?php echo e(route('circle.mypage.withdrawal.delete')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>退会</h1>
            <p>本当に退会しますか？</p>
            <div class="button">
                <input type="submit" value="退会する" class="button_1">
                <br><br>
                <a href="<?php echo e(route('circle.mypage')); ?>" class="button_2">マイページへ</a>    
            </div>    
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/mypage/withdrawal.blade.php ENDPATH**/ ?>