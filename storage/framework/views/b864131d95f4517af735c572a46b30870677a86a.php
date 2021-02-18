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
    <div class="circle_mypage_email_edit_content">
        <form action="<?php echo e(route('circle.mypage.email.send')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>メールアドレス変更</h1>
            <div class="form">
                <div class="left">
                    <span>現在のメールアドレス</span>
                </div>
                <div class="right">
                    <span><?php echo e(Auth::guard('circle')->user()->email); ?></span>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>変更後のメールアドレス</span>
                </div>
                <div class="right">
                    <input type="text" name="email" value="<?php echo e(old('email')); ?>" size="39">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>    
                </div>
            </div>    
            <div class="button">
                <input type="submit" value="認証メール送信" class="button_1">
                <br><br>
                <a href="<?php echo e(route('circle.mypage')); ?>" class="button_2">マイページへ</a>    
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/mypage/email.blade.php ENDPATH**/ ?>