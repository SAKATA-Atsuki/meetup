<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>プロフィール変更フォーム</title>
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
    <div class="circle_mypage_profile_edit_content">
        <form action="<?php echo e(route('circle.mypage.profile.check', ['id' => Auth::guard('circle')->user()->id])); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <h1>プロフィール変更</h1>
            <div class="form">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="<?php if(old('name') == null): ?><?php echo e($circle['name']); ?><?php else: ?><?php echo e(old('name')); ?><?php endif; ?>" size="39">
                    <?php $__errorArgs = ['name'];
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
                            $campus_id = $circle['campus_id'];
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
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    <?php
                        if (old('circle_category_id') == null) {
                            $circle_category_id = $circle['circle_category_id'];
                        } else {
                            $circle_category_id = old('circle_category_id');
                        }
                    ?>
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="circle_category_id" value="<?php echo e($index); ?>" <?php if($circle_category_id == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__errorArgs = ['circle_category_id'];
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
                    <span>カテゴリ2</span>
                </div>
                <div class="right">
                    <?php
                        if (old('circle_subcategory_id') == null) {
                            $circle_subcategory_id = $circle['circle_subcategory_id'];
                        } else {
                            $circle_subcategory_id = old('circle_subcategory_id');
                        }
                    ?>
                    <select name="circle_subcategory_id">
                        <?php if(old('circle_subcategory_id') == 0): ?>
                            <option value="">--------------------</option>
                        <?php else: ?>
                            <?php $__currentLoopData = $circle_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circle_subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($circle_subcategory['id']); ?>" <?php if($circle_subcategory_id == $circle_subcategory['id']): ?> selected <?php endif; ?>><?php echo e($circle_subcategory['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        <?php endif; ?>
                    </select>
                    <?php $__errorArgs = ['circle_subcategory_id'];
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
                    <span>サークル紹介</span>
                </div>
                <div class="right">
                    <textarea name="introduction" cols="38" rows="7"><?php if(old('introduction') == null): ?><?php echo e($circle['introduction']); ?><?php else: ?><?php echo e(old('introduction')); ?><?php endif; ?></textarea>
                </div>
            </div>
            <div class="button">
                <input type="submit" value="確認画面へ" class="button_1">
                <br><br>
                <input type="submit" name="back" value="マイページへ" class="button_1">
            </div>
        </form>
    </div>
</body>
</html>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/mypage/profile.blade.php ENDPATH**/ ?>