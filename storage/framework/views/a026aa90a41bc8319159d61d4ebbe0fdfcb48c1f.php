<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生登録フォーム</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('top')); ?>">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
        </div>
    </div>
    <div class="freshman_register_content">
        <form action="<?php echo e(route('freshman.register')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>新入生登録</h1>
            <div class="form">
                <div class="left">
                    <span>氏名</span>
                </div>
                <div class="right">
                    姓<input type="text" name="name_sei" value="<?php echo e(old('name_sei')); ?>" size="15">　名<input type="text" name="name_mei" value="<?php echo e(old('name_mei')); ?>" size="15">
                    <?php $__errorArgs = ['name_sei'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="error"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php $__errorArgs = ['name_mei'];
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
            <div class="form">
                <div class="left">
                    <span>ニックネーム</span>
                </div>
                <div class="right">
                    <input type="text" name="nickname" value="<?php echo e(old('nickname')); ?>" size="39">
                    <?php $__errorArgs = ['nickname'];
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
            <div class="form">
                <div class="left">
                    <span>性別</span>
                </div>
                <div class="right">
                    <?php $__currentLoopData = config('master.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="gender" value="<?php echo e($index); ?>" <?php if(old('gender') == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__errorArgs = ['gender'];
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
            <div class="form">
                <div class="left">
                    <span>キャンパス</span>
                </div>
                <div class="right">
                    <select name="campus_id">
                        <option value="">--------------------</option>
                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($campus['id']); ?>" <?php if(old('campus_id') == $campus['id']): ?> selected <?php endif; ?>><?php echo e($campus['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php $__errorArgs = ['campus_id'];
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
            <div class="form">
                <div class="left">
                    <span>メールアドレス</span>
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
            <div class="form">
                <div class="left">
                    <span>パスワード</span>
                </div>
                <div class="right">
                    <input type="password" name="password" value="<?php echo e(old('password')); ?>" size="39">
                    <?php $__errorArgs = ['password'];
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
            <div class="form">
                <div class="left">
                    <span>パスワード確認</span>
                </div>
                <div class="right">
                    <input type="password" name="password_check" value="<?php echo e(old('password_check')); ?>" size="39">
                    <?php $__errorArgs = ['password_check'];
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
            <div class="form">
                <div class="left">
                    <span>自己紹介</span>
                </div>
                <div class="right">
                    <textarea name="introduction" cols="38" rows="7"><?php echo e(old('introduction')); ?></textarea>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="確認画面へ" class="button_1">
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/freshman/auth/register.blade.php ENDPATH**/ ?>