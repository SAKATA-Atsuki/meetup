<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>プロフィール変更</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset("ritsumeikan.jpeg")); ?>" type="image/x-icon">
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
    <div class="circle_mypage_profile_check_content">
        <h1>プロフィール変更</h1>
        <div class="check">
            <div class="left">
                <span>サークル名</span>
            </div>
            <div class="right">
                <span><?php echo e($data['name']); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>キャンパス</span>
            </div>
            <div class="right">
                <span><?php echo e($campus['name']); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ1</span>
            </div>
            <div class="right">
                <span>
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($data['circle_category_id'] == $index): ?> <?php echo e($value); ?> <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>カテゴリ2</span>
            </div>
            <div class="right">
                <span><?php echo e($circle_subcategory['name']); ?></span>
            </div>
        </div>
        <div class="check">
            <div class="left">
                <span>サークル紹介</span>
            </div>
            <div class="right">
                <span><?php echo nl2br(e($data['introduction'])); ?></span>
            </div>
        </div>
        <div class="button">
            <form action="<?php echo e(route('circle.mypage.profile.update')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="name" value="<?php echo e($data['name']); ?>">
                <input type="hidden" name="campus_id" value="<?php echo e($data['campus_id']); ?>">
                <input type="hidden" name="circle_category_id" value="<?php echo e($data['circle_category_id']); ?>">
                <input type="hidden" name="circle_subcategory_id" value="<?php echo e($data['circle_subcategory_id']); ?>">
                <input type="hidden" name="introduction" value="<?php echo e($data['introduction']); ?>">
                <input type="submit" value="変更する" class="button_1">
                <br><br>
                <input type="submit" name="back" value="前に戻る" class="button_1">
            </form>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/mypage/check.blade.php ENDPATH**/ ?>