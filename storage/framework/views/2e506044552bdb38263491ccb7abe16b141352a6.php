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
            <p><?php echo e(Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei); ?>　様</p>
            <div class="button">
                <a href="<?php echo e(route('freshman.logout')); ?>" class="button_2">ログアウト</a>    
            </div>
        </div>
    </div>
    <div class="freshman_mypage_content">
        <div class="profile">
            <div class="check">
                <div class="left">
                    <span>氏名</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('freshman')->user()->name_sei); ?>　<?php echo e(Auth::guard('freshman')->user()->name_mei); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>ニックネーム</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('freshman')->user()->nickname); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>性別</span>
                </div>
                <div class="right">
                    <span>
                        <?php $__currentLoopData = config('master.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(Auth::guard('freshman')->user()->gender == $index): ?> <?php echo e($value); ?> <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>キャンパス</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('freshman')->user()->getCampusName()); ?></span>
                </div>
            </div>
            <div class="check">
                <div class="left">
                    <span>メールアドレス</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('freshman')->user()->email); ?></span>
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
                    <span>自己紹介</span>
                </div>
                <div class="right">
                    <span><?php echo nl2br(e(Auth::guard('freshman')->user()->introduction)); ?></span>
                </div>
            </div>    
        </div>
        <div class="buttons">
            <a href="<?php echo e(route('freshman.mypage.favorite')); ?>" class="button">お気に入りしたサークル</a>    
            <a href="<?php echo e(route('freshman.mypage.profile')); ?>" class="button">プロフィール変更</a>    
            <a href="<?php echo e(route('freshman.mypage.email')); ?>" class="button">メールアドレス変更</a>    
            <a href="<?php echo e(route('freshman.mypage.password')); ?>" class="button">パスワード変更</a>    
            <a href="<?php echo e(route('freshman.mypage.withdrawal')); ?>" class="button">退会</a>    
        </div>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/freshman/mypage/index.blade.php ENDPATH**/ ?>