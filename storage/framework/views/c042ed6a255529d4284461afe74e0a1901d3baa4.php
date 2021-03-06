<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お気に入りしたサークル</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('top')); ?>">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <p><?php echo e(Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei); ?>　様</p>
            <div class="button">
                <a href="<?php echo e(route('freshman.logout')); ?>" class="button_2">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="freshman_mypage_circle_content">
        <a href="<?php echo e(route('freshman.mypage.favorite')); ?>" class="button_1">< サークル一覧へ</a>    
        <div class="name">
            <span><?php echo e($circle['name']); ?></span>
            <?php if(count($favorite) == 0): ?>
                <a href="<?php echo e(route('freshman.mypage.favorite.circle.favorite', ['id' => $circle['id']])); ?>" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                <a href="<?php echo e(route('freshman.mypage.favorite.circle.favorite', ['id' => $circle['id']])); ?>" class="button_4"><i class="far fa-heart"></i></a>
            <?php else: ?>
                <a href="<?php echo e(route('freshman.mypage.favorite.circle.unfavorite', ['id' => $circle['id']])); ?>" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
                <a href="<?php echo e(route('freshman.mypage.favorite.circle.unfavorite', ['id' => $circle['id']])); ?>" class="button_4"><i class="fas fa-heart"></i></a>
            <?php endif; ?>
        </div>
        <span><?php echo e($circle->getCampusName()); ?></span>
        <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($circle['circle_category_id'] == $index): ?>
                <span>　<?php echo e($value); ?>　</span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <span><?php echo e($circle->getCircleSubcategoryName()); ?></span>
        <div class="introduction">
            <span class="title">サークル紹介</span>
            <span class="content"><?php echo nl2br(e($circle['introduction'])); ?></span>
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/freshman/mypage/circle.blade.php ENDPATH**/ ?>