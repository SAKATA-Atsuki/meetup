<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド一覧</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
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
                    <a href="" class="button_1">マイページ</a>
                    <a href="<?php echo e(route('freshman.logout')); ?>" class="button_2">ログアウト</a>    
                </div>
            <?php elseif(Auth::guard('circle')->check()): ?>
                <p><?php echo e(Auth::guard('circle')->user()->name); ?>　様</p>
                <div class="button">
                    <a href="" class="button_3">マイページ</a>
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
    <div class="circle_thread_content">
        <a href="<?php echo e(route('circle', ['id' => $circle['id'], 'pg' => $pg])); ?>" class="button_1">< サークル詳細へ</a>    
        <div class="name">
            <span><?php echo e($circle['name']); ?></span>
            <?php if(Auth::guard('freshman')->check()): ?>
                <?php if(count($favorite) == 0): ?>
                    <a href="<?php echo e(route('circle.thread.favorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page])); ?>" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                <?php else: ?>
                    <a href="<?php echo e(route('circle.thread.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page])); ?>" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <span><?php echo e($circle->getCampusName()); ?></span>
        <?php $__currentLoopData = config('master.circle_category'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($circle['circle_category_id'] == $index): ?>
                <span>　<?php echo e($value); ?>　</span>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <span><?php echo e($circle->getCircleSubcategoryName()); ?></span>
    </div>
    <div class="circle_thread_search">
        <form action="" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form">
                <div class="left">
                    <span>スレッドタイトル</span>
                </div>
                <div class="right">
                    <input type="text" name="title" value="<?php echo e($session_circle_thread_search['title']); ?>" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="circle_thread_result">
        <?php if(Auth::guard('freshman')->check()): ?>
            <a href="<?php echo e(route('circle.thread.register', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page])); ?>" class="button_1">スレッド作成</a>    
        <?php endif; ?>
        <?php if(Auth::guard('circle')->check()): ?>
            <?php if(Auth::guard('circle')->user()->id == $circle['id']): ?>
                <a href="<?php echo e(route('circle.thread.register', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page])); ?>" class="button_1">スレッド作成</a>    
            <?php endif; ?>
        <?php endif; ?>
        <div class="title">
            <p class="thread_title">スレッドタイトル</p>
            <p class="number">メッセージ数</p>
            <p class="author">作成者</p>
        </div>
        <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <p class="thread_title"><a href="<?php echo e(route('circle.thread.message', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page])); ?>">
                    <?php if(mb_strlen($thread['title']) > 25): ?>
                        <?php echo e(mb_substr($thread['title'], 0, 25)); ?>…
                    <?php else: ?>
                        <?php echo e($thread['title']); ?>

                    <?php endif; ?>
                </a></p>
                <p class="number"><?php echo e(count(App\Models\Message::where('thread_id', $thread['id'])->get())); ?></p>
                <?php if($thread['freshman_id'] == null): ?>
                    <p class="author circle"><?php echo e($thread->getCircleName()); ?></p>
                <?php else: ?>
                    <p class="author"><a href="<?php echo e(route('circle.thread.freshman', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page, 'freshman_id' => $thread['freshman_id']])); ?>" class="freshman"><?php echo e($thread->getFreshmanNickname()); ?></a></p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(count($threads)): ?>
            <div class="button">
                <ul class="pagination">
                    <?php if($threads->onFirstPage()): ?>
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    <?php else: ?>
                        <li><a href="<?php echo e($threads->appends(['id' => $circle['id'], 'pg' => $pg])->previousPageUrl()); ?>">&lt;</a></li>
                        <li><a href="<?php echo e($threads->appends(['id' => $circle['id'], 'pg' => $pg])->previousPageUrl()); ?>"><?php echo e($threads->currentPage() - 1); ?></a></li>
                    <?php endif; ?>
                    <li><span class="active"><?php echo e($threads->currentPage()); ?></span></li>
                    <?php if($threads->hasMorePages()): ?>
                        <li><a href="<?php echo e($threads->appends(['id' => $circle['id'], 'pg' => $pg])->nextPageUrl()); ?>"><?php echo e($threads->currentPage() + 1); ?></a></li>
                        <li><a href="<?php echo e($threads->appends(['id' => $circle['id'], 'pg' => $pg])->nextPageUrl()); ?>">&gt;</a></li>
                    <?php else: ?>
                        <li><span>　</span></li>
                        <li><span>　</span></li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/thread/index.blade.php ENDPATH**/ ?>