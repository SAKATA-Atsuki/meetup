<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>カテゴリ2一覧</title>
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
    <div class="admin_search">
        <form action="<?php echo e(route('admin.subcategory')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="<?php echo e($session_admin_subcategory_search['id']); ?>" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>カテゴリ1</span>
                </div>
                <div class="right">
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <input type="radio" name="circle_category_id" value="<?php echo e($index); ?>" <?php if($session_admin_subcategory_search['circle_category_id'] == $index): ?> checked <?php endif; ?>><?php echo e($value); ?>　
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="<?php echo e($session_admin_subcategory_search['free']); ?>" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="<?php echo e($order); ?>">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_subcategory_result">
        <a href="<?php echo e(route('admin.subcategory.register', ['page' => $page])); ?>" class="button_1">新規登録</a>    
        <div class="title">
            <span class="id">
                ID
                <?php if($order == 1): ?>
                    <a href="<?php echo e(route('admin.subcategory', ['page' => $page, 'order' => 2])); ?>"><i class="far fa-caret-square-up"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('admin.subcategory', ['page' => $page, 'order' => 1])); ?>"><i class="far fa-caret-square-down"></i></a>
                <?php endif; ?>
            </span>
            <span class="category">カテゴリ1</span>
            <span class="name">名前</span>
            <span class="created_at">登録日時</span>
            <span class="edit">編集</span>
            <span class="delete">削除</span>
        </div>
        <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <span class="id"><?php echo e($subcategory['id']); ?></span>
                <span class="category">
                    <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($subcategory['circle_category_id'] == $index): ?> <?php echo e($value); ?> <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </span>
                <a href="<?php echo e(route('admin.subcategory.detail', ['id' => $subcategory['id'], 'page' => $page])); ?>" class="name"><?php echo e($subcategory['name']); ?></a>
                <span class="created_at"><?php echo e($subcategory['created_at']); ?></span>
                <a href="<?php echo e(route('admin.subcategory.edit', ['id' => $subcategory['id'], 'page' => $page])); ?>" class="edit">編集</a>
                <a href="<?php echo e(route('admin.subcategory.delete', ['id' => $subcategory['id'], 'page' => $page])); ?>" class="delete">削除</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="admin_button">
        <?php if(count($subcategories)): ?>
            <?php if($subcategories->onFirstPage()): ?>
                <span class="left_off"></span>
            <?php else: ?>
                <a href="<?php echo e($subcategories->appends(['order' => $order])->previousPageUrl()); ?>" class="prev">< 前へ</a>
                <a href="<?php echo e($subcategories->appends(['order' => $order])->previousPageUrl()); ?>" class="left_on"><?php echo e($subcategories->currentPage() - 1); ?></a>
            <?php endif; ?>
            <span class="center"><?php echo e($subcategories->currentPage()); ?></span>
            <?php if($subcategories->hasMorePages()): ?>
                <a href="<?php echo e($subcategories->appends(['order' => $order])->nextPageUrl()); ?>" class="right_on"><?php echo e($subcategories->currentPage() + 1); ?></a>
                <a href="<?php echo e($subcategories->appends(['order' => $order])->nextPageUrl()); ?>" class="next">次へ ></a>
            <?php else: ?>
                <span class="right_off"></span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/subcategory/index.blade.php ENDPATH**/ ?>