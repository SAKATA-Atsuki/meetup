<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>マイページ</title>
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
    <div class="circle_mypage_content">
        <div class="profile">
            <div class="check">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('circle')->user()->name); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>キャンパス</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('circle')->user()->getCampusName()); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    <span>
                        <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(Auth::guard('circle')->user()->circle_category_id == $index): ?> <?php echo e($value); ?> <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>カテゴリ2</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('circle')->user()->getCircleSubcategoryName()); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('circle')->user()->email); ?></span>
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
                    <span>サークル紹介</span>
                </div>
                <div class="right">
                    <span><?php echo nl2br(e(Auth::guard('circle')->user()->introduction)); ?></span>
                </div>
            </div>
        </div>
        <div class="buttons">
            <a href="<?php echo e(route('circle.mypage.profile')); ?>" class="button">プロフィール変更</a>    
            <a href="<?php echo e(route('circle.mypage.email')); ?>" class="button">メールアドレス変更</a>    
            <a href="<?php echo e(route('circle.mypage.password')); ?>" class="button">パスワード変更</a>    
            <a href="<?php echo e(route('circle.mypage.withdrawal')); ?>" class="button">退会</a>    
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/mypage/index.blade.php ENDPATH**/ ?>