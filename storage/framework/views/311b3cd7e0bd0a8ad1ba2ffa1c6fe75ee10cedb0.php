<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
    <script type="text/javascript">
        $(function() {
            // 種別が変更されたとき
            $('input[name="circle_category_id"]').change(function() {
                var circle_category_id = $(this).val();

                // circle_category_idの値を渡す
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    url: "<?php echo e(route('circle.register.category')); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        circle_category_id: circle_category_id
                    }
                })
                .done(function(data) {
                    // optionタグを全て削除
                    $('select[name="circle_subcategory_id"] option').remove();

                    // 返ってきたdataをそれぞれoptionタグとして追加
                    $.each(data, function(id, name) {
                        $('select[name="circle_subcategory_id"]').append($('<option>').attr('value', id).text(name));
                    })
                })
                .fail(function() {
                    console.log("失敗");
                })
            })
        })
    </script>
    <title>立命館大学 - 新入生・サークル交流サイト</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
    <div class="header">
        <div class="left">
            <a href="<?php echo e(route('top')); ?>">立命館大学<br>新入生・サークル交流サイト</a>
        </div>
        <div class="right">
            <?php if(Auth::guard('freshman')->check()): ?>
                <p><?php echo e(Auth::guard('freshman')->user()->name_sei . Auth::guard('freshman')->user()->name_mei); ?>　様</p>
                <div class="button">
                    <a href="" class="button_1">アカウント設定</a>
                    <a href="<?php echo e(route('freshman.logout')); ?>" class="button_2">ログアウト</a>    
                </div>
            <?php elseif(Auth::guard('circle')->check()): ?>
                <p><?php echo e(Auth::guard('circle')->user()->name); ?>　様</p>
                <div class="button">
                    <a href="" class="button_3">アカウント設定</a>
                    <a href="<?php echo e(route('circle.logout')); ?>" class="button_4">ログアウト</a>    
                </div>
            <?php else: ?>
                <div class="form">
                    <div class="freshman">
                        <div class="button">
                            <a href="<?php echo e(route('freshman.login')); ?>" class="button_1">新入生ログイン</a>
                            <a href="<?php echo e(route('freshman.register')); ?>" class="button_2">新入生登録</a>    
                        </div>    
                    </div>
                    <div class="circle">
                        <div class="button">
                            <a href="<?php echo e(route('circle.login')); ?>" class="button_1">サークルログイン</a>
                            <a href="<?php echo e(route('circle.register')); ?>" class="button_2">サークル登録</a>    
                        </div>    
                    </div>    
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="top_search">
        <form action="" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form">
                <div class="left">
                    <span>サークル名</span>
                </div>
                <div class="right">
                    <input type="text" name="name" value="<?php echo e($data['name']); ?>" size="39">
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
                            <option value="<?php echo e($campus['id']); ?>" <?php if($data['campus_id'] == $campus['id']): ?> selected <?php endif; ?>><?php echo e($campus['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>種別</span>
                </div>
                <div class="right">
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="circle_category_id" value="<?php echo e($index); ?>" <?php if($data['circle_category_id'] == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>種目</span>
                </div>
                <div class="right">
                    <select name="circle_subcategory_id">
                        <?php if($data['circle_subcategory_id'] == 0): ?>
                            <option value="">--------------------</option>
                        <?php else: ?>
                            <?php $__currentLoopData = $circle_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circle_subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($circle_subcategory['id']); ?>" <?php if($data['circle_subcategory_id'] == $circle_subcategory['id']): ?> selected <?php endif; ?>><?php echo e($circle_subcategory['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        <?php endif; ?>
                    </select>
                </div>
            </div>    
            <div class="button">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/index.blade.php ENDPATH**/ ?>