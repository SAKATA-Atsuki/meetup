<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>新入生編集</title>
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
    <div class="admin_form_content">
        <form action="<?php echo e(route('admin.freshman.edit.check')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>新入生編集</h1>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <span><?php echo e($freshman['id']); ?></span>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>氏名</span>
                </div>
                <div class="right">
                    姓<input type="text" name="name_sei" value="<?php if(old('name_sei') == null): ?><?php echo e($freshman['name_sei']); ?><?php else: ?><?php echo e(old('name_sei')); ?><?php endif; ?>" size="15">　名<input type="text" name="name_mei" value="<?php if(old('name_mei') == null): ?><?php echo e($freshman['name_mei']); ?><?php else: ?><?php echo e(old('name_mei')); ?><?php endif; ?>" size="15">
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
                    <input type="text" name="nickname" value="<?php if(old('nickname') == null): ?><?php echo e($freshman['nickname']); ?><?php else: ?><?php echo e(old('nickname')); ?><?php endif; ?>" size="39">
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
                    <?php
                        if (old('gender') == null) {
                            $gender = $freshman['gender'];
                        } else {
                            $gender = old('gender');
                        }
                    ?>
                    <?php $__currentLoopData = config('master.gender'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="gender" value="<?php echo e($index); ?>" <?php if($gender == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
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
                    <?php
                        if (old('campus_id') == null) {
                            $campus_id = $freshman['campus_id'];
                        } else {
                            $campus_id = old('campus_id');
                        }
                    ?>
                    <select name="campus_id">
                        <option value="">--------------------</option>
                        <?php $__currentLoopData = $campuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $campus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($campus['id']); ?>" <?php if($campus_id == $campus['id']): ?> selected <?php endif; ?>><?php echo e($campus['name']); ?></option>
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
                    <input type="text" name="email" value="<?php if(old('email') == null): ?><?php echo e($freshman['email']); ?><?php else: ?><?php echo e(old('email')); ?><?php endif; ?>" size="39">
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
                    <textarea name="introduction" cols="38" rows="7"><?php if(old('introduction') == null): ?><?php echo e($freshman['introduction']); ?><?php else: ?><?php echo e(old('introduction')); ?><?php endif; ?></textarea>
                </div>
            </div>
            <div class="button">
                <input type="hidden" name="id" value="<?php echo e($freshman['id']); ?>">
                <input type="hidden" name="page" value="<?php echo e($page); ?>">
                <input type="hidden" name="order" value="<?php echo e($order); ?>">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <a href="<?php echo e(route('admin.freshman', ['page' => $page, 'order' => $order])); ?>" class="button_2">新入生一覧へ</a>    
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/freshman/edit.blade.php ENDPATH**/ ?>