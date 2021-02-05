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
                    url: "<?php echo e(route('top.category')); ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        circle_category_id: circle_category_id
                    }
                })
                .done(function(data) {
                    // optionタグを全て削除
                    $('select[name="circle_subcategory_id"] option').remove();
                    $('select[name="circle_subcategory_id"]').append($('<option>').attr('value', '').text('--------------------'));

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
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="circle_category_id" value="<?php echo e($index); ?>" <?php if($data['circle_category_id'] == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ2</span>
                </div>
                <div class="right">
                    <select name="circle_subcategory_id">
                        <option value="">--------------------</option>
                        <?php if (! ($data['circle_category_id'] == '')): ?>
                            <?php $__currentLoopData = $circle_subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circle_subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($circle_subcategory['id']); ?>" <?php if($data['circle_subcategory_id'] == $circle_subcategory['id']): ?> selected <?php endif; ?>><?php echo e($circle_subcategory['name']); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
                        <?php endif; ?>
                    </select>
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="top_result">
        <div class="title">
            <p class="name">サークル名</p>
            <p class="campus">キャンパス</p>
            <p class="circle_category">カテゴリ1</p>
            <p class="circle_subcategory">カテゴリ2</p>
        </div>
        <?php $__currentLoopData = $circles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $circle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <p class="name"><a href=""><?php echo e($circle['name']); ?></a></p>
                <p class="campus"><?php echo e($circle->getCampusName()); ?></p>
                <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($circle['circle_category_id'] == $index): ?>
                        <p class="circle_category"><?php echo e($value); ?></p>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <p class="circle_subcategory"><?php echo e($circle->getCircleSubcategoryName()); ?></p>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($circles)): ?>
            <div class="button">
                <ul class="pagination">
                    <?php if($circles->onFirstPage()): ?>
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    <?php else: ?>
                        <li><a href="<?php echo e($circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->previousPageUrl()); ?>">&lt;</a></li>
                        <li><a href="<?php echo e($circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->previousPageUrl()); ?>"><?php echo e($circles->currentPage() - 1); ?></a></li>
                    <?php endif; ?>
                    <li><span class="active"><?php echo e($circles->currentPage()); ?></span></li>
                    <?php if($circles->hasMorePages()): ?>
                        <li><a href="<?php echo e($circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->nextPageUrl()); ?>"><?php echo e($circles->currentPage() + 1); ?></a></li>
                        <li><a href="<?php echo e($circles->appends(['name' => $data['name'], 'campus_id' => $data['campus_id'], 'circle_category_id' => $data['circle_category_id'], 'circle_subcategory_id' => $data['circle_subcategory_id']])->nextPageUrl()); ?>">&gt;</a></li>
                    <?php else: ?>
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/index.blade.php ENDPATH**/ ?>