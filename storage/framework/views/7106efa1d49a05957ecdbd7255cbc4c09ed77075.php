<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド詳細</title>
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
    <div class="circle_thread_message_content">
        <a href="<?php echo e(route('circle.thread', ['id' => $circle['id'], 'pg' => $pg, 'page' => $page])); ?>" class="button_1">< スレッド一覧へ</a>    
        <div class="name">
            <span><?php echo e($circle['name']); ?></span>
            <?php if(Auth::guard('freshman')->check()): ?>
                <?php if(count($favorite) == 0): ?>
                    <a href="<?php echo e(route('circle.thread.message.favorite', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page])); ?>" class="button_2"><i class="far fa-heart"></i> お気に入り追加</a>
                <?php else: ?>
                    <a href="<?php echo e(route('circle.thread.message.unfavorite', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page])); ?>" class="button_3"><i class="fas fa-heart"></i> お気に入り済み</a>
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
    <div class="circle_thread_message_title">
        <div class="content">
            <span class="title"><?php echo e($thread['title']); ?></span>
            <br>
            <?php if($thread['freshman_id'] == null): ?>
                <span>作成者　<span class="circle"><?php echo e($thread->getCircleName()); ?></span></span>
                <br>
                <span>作成日時　<?php echo e($thread['created_at']); ?></span>
            <?php else: ?>
                <span>作成者　<a href="<?php echo e(route('circle.thread.message.freshman', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'freshman_id' => $thread['freshman_id']])); ?>" class="freshman"><?php echo e($thread->getFreshmanNickname()); ?></a></span>
                <br>
                <span>作成日時　<?php echo e($thread['created_at']); ?></span>
            <?php endif; ?>    
        </div>
    </div>
    <div class="circle_thread_message_list">
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <?php if($message['deleted_at'] == null): ?>
                    <div class="top">
                        <?php if($message['freshman_id'] == null): ?>
                            <span class="circle"><?php echo e($message->getCircleName()); ?></span>
                            <?php if(Auth::guard('circle')->check()): ?>
                                <?php if(Auth::guard('circle')->user()->id == $message['circle_id']): ?>
                                    <a href="<?php echo e(route('circle.thread.message.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'message_id' => $message['id']])); ?>" class="trash"><i class="fas fa-trash-alt"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <a href="<?php echo e(route('circle.thread.message.freshman', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'freshman_id' => $message['freshman_id']])); ?>" class="freshman"><?php echo e($message->getFreshmanNickname()); ?></a>
                            <?php if(Auth::guard('freshman')->check()): ?>
                                <?php if(Auth::guard('freshman')->user()->id == $message['freshman_id']): ?>
                                    <a href="<?php echo e(route('circle.thread.message.delete', ['id' => $circle['id'], 'pg' => $pg, 'thread_id' => $thread['id'], 'page' => $page, 'message_id' => $message['id']])); ?>" class="trash"><i class="fas fa-trash-alt"></i></a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>    
                    </div>
                    <span><?php echo e($message['created_at']); ?></span>
                    <div class="message">
                        <span><?php echo nl2br(e($message['content'])); ?></span>
                    </div>
                <?php else: ?>
                    <p>削除されました。</p>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if(Auth::guard('freshman')->check()): ?>
            <form action="<?php echo e(route('circle.thread.message.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="form">
                    <textarea name="content" cols="133" rows="10"></textarea>
                    <?php $__errorArgs = ['content'];
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
                <div class="button">
                    <input type="hidden" name="id" value="<?php echo e($circle['id']); ?>">
                    <input type="hidden" name="pg" value="<?php echo e($pg); ?>">
                    <input type="hidden" name="thread_id" value="<?php echo e($thread['id']); ?>">
                    <input type="hidden" name="page" value="<?php echo e($page); ?>">
                    <input type="submit" value="投稿する" class="button_1">
                </div>        
            </form>
        <?php endif; ?>
        <?php if(Auth::guard('circle')->check()): ?>
            <?php if(Auth::guard('circle')->user()->id == $circle['id']): ?>
                <form action="<?php echo e(route('circle.thread.message.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form">
                        <textarea name="content" cols="133" rows="10"></textarea>
                        <?php $__errorArgs = ['content'];
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
                    <div class="button">
                        <input type="hidden" name="id" value="<?php echo e($circle['id']); ?>">
                        <input type="hidden" name="pg" value="<?php echo e($pg); ?>">
                        <input type="hidden" name="thread_id" value="<?php echo e($thread['id']); ?>">
                        <input type="hidden" name="page" value="<?php echo e($page); ?>">
                        <input type="submit" value="投稿する" class="button_1">
                    </div>        
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/circle/thread/message.blade.php ENDPATH**/ ?>