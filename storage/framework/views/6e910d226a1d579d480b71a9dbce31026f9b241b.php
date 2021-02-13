<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>メッセージ一覧</title>
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
        <form action="<?php echo e(route('admin.message')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form">
                <div class="left">
                    <span>ID</span>
                </div>
                <div class="right">
                    <input type="text" name="id" value="<?php echo e($session_admin_message_search['id']); ?>" size="39">
                </div>
            </div>    
            <div class="form">
                <div class="left">
                    <span>スレッドID</span>
                </div>
                <div class="right">
                    <input type="text" name="thread_id" value="<?php echo e($session_admin_message_search['thread_id']); ?>" size="39">
                </div>
            </div>  
            <div class="form">
                <div class="left">
                    <span>フリーワード</span>
                </div>
                <div class="right">
                    <input type="text" name="free" value="<?php echo e($session_admin_message_search['free']); ?>" size="39">
                </div>
            </div>    
            <div class="button">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="order" value="<?php echo e($order); ?>">
                <input type="submit" value="検索する" class="button_1">
            </div>
        </form>
    </div>
    <div class="admin_message_result">
        <div class="title">
            <span class="id">
                ID
                <?php if($order == 1): ?>
                    <a href="<?php echo e(route('admin.message', ['page' => $page, 'order' => 2])); ?>"><i class="far fa-caret-square-up"></i></a>
                <?php else: ?>
                    <a href="<?php echo e(route('admin.message', ['page' => $page, 'order' => 1])); ?>"><i class="far fa-caret-square-down"></i></a>
                <?php endif; ?>
            </span>
            <span class="message">メッセージ</span>
            <span class="thread_title">スレッド</span>
            <span class="author">作成者</span>
            <span class="created_at">登録日時</span>
            <span class="delete">削除</span>
        </div>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="content">
                <span class="id"><?php echo e($message['id']); ?></span>
                <a href="<?php echo e(route('admin.message.detail', ['id' => $message['id'], 'page' => $page, 'order' => $order])); ?>" class="message">
                    <?php if(mb_strlen($message['content']) > 13): ?>
                        <?php echo e(mb_substr($message['content'], 0, 13)); ?>…
                    <?php else: ?>
                        <?php echo e($message['content']); ?>

                    <?php endif; ?>
                </a>
                <span class="thread_title"><?php echo e($message->getThreadTitle()); ?></span>
                <?php if($message['freshman_id'] == null): ?>
                    <span class="author"><?php echo e($message->getCircleName()); ?></span>
                <?php else: ?>
                    <span class="author"><?php echo e($message->getFreshmanNickname()); ?></span>
                <?php endif; ?>
                <span class="created_at"><?php echo e($message['created_at']); ?></span>
                <a href="<?php echo e(route('admin.message.delete', ['id' => $message['id'], 'page' => $page, 'order' => $order])); ?>" class="delete">削除</a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="admin_button">
        <?php if(count($messages)): ?>
            <?php if($messages->onFirstPage()): ?>
                <span class="left_off"></span>
            <?php else: ?>
                <a href="<?php echo e($messages->appends(['order' => $order])->previousPageUrl()); ?>" class="prev">< 前へ</a>
                <a href="<?php echo e($messages->appends(['order' => $order])->previousPageUrl()); ?>" class="left_on"><?php echo e($messages->currentPage() - 1); ?></a>
            <?php endif; ?>
            <span class="center"><?php echo e($messages->currentPage()); ?></span>
            <?php if($messages->hasMorePages()): ?>
                <a href="<?php echo e($messages->appends(['order' => $order])->nextPageUrl()); ?>" class="right_on"><?php echo e($messages->currentPage() + 1); ?></a>
                <a href="<?php echo e($messages->appends(['order' => $order])->nextPageUrl()); ?>" class="next">次へ ></a>
            <?php else: ?>
                <span class="right_off"></span>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/meetup/resources/views/admin/message/index.blade.php ENDPATH**/ ?>