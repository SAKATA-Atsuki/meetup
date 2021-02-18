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
    <div class="freshman_mypage_favorite_content">
        <a href="<?php echo e(route('freshman.mypage')); ?>" class="button_1">< マイページへ</a>    
        <div class="title">
            <p class="name">サークル名</p>
            <p class="campus">キャンパス</p>
            <p class="circle_category">カテゴリ1</p>
            <p class="circle_subcategory">カテゴリ2</p>
        </div>
        <?php $__currentLoopData = $favorites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $favorite): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <p class="name"><a href="<?php echo e(route('freshman.mypage.favorite.circle', ['id' => $favorite['circle_id']])); ?>">
                    <?php echo e($favorite->getCircleName()); ?>

                </a></p>
                <p class="campus"><?php echo e(App\Models\Campus::find($favorite->getCircleCampusId())->name); ?></p>
                <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($favorite->getCircleCircleCategoryId() == $index): ?>
                        <p class="circle_category"><?php echo e($value); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <p class="circle_subcategory"><?php echo e(App\Models\Circle_subcategory::find($favorite->getCircleCircleSubcategoryId())->name); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/freshman/mypage/favorite.blade.php ENDPATH**/ ?>