<!DOCTYPE html>
<html lang="ja">
<head>
<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
    <title>Twitter TOP</title>
</head>
<body>

<?php $__env->startSection('content'); ?>
    <section class="section_wrapper">
        <div class="twitter_top_wrapper">
            <div class="twitter_top_box" >
                <!--<span class="twitter_image"><a href="/">
                <img class="twitter_logo" src="<?php echo e(asset('image/twitter_logo.svg')); ?>" alt="" ></a></span>-->
                <?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="card"></div>
                <div class="twitter_top_inwrapper">
                    <div class="twitter_top_title">
                        <p>Tweets</p>
                    </div>
                    <div class="twitter_top_input-field">
                        <div class="twitter_top_input-field-top">
                            <div class="tweet_profile">
                                <img class="twitter-profile_image2" src="<?php echo e(asset('/storage/images/'.$user->product_image)); ?>" alt="">
                            </div>
                            <form method="POST" action="/create" class="tweet_area">
                            <?php echo csrf_field(); ?>
                            <div class="tweet_area">
                                <textarea class="tweet_text" id="tweet" name="tweet" placeholder="hello"></textarea>
                            </div>
                            <div class="follow">
                                <div class="following">
                                    <a href="/users-follow" name="follow_number" class="follow_number"><?php echo e($follow_count); ?></a>
                                    <label for="follow_number" class="follow_label">フォロー中</label>
                                </div>
                                <div class="followering">
                                    <a href="/users-follower" name="follower_number" class="follower_number"><?php echo e($follower_count); ?></a>
                                    <label for="follower_number" class="follower_label">フォロワー</label>
                                </div>
                            </div>
                            <div class="tweet_button-first">
                                <button class="button_inner-first" type="submit">投稿</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="space">.</div>
            <div class="twitter_top_inbox">
                <?php $__currentLoopData = $following_tweets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $twitter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <form method="POST" action="/delete/<?php echo e($twitter->id); ?>">
                <div class="top_inbox_inner">
                    <img class="twitter-profile_image2" src="<?php echo e(asset('/storage/images/'.$twitter->user->product_image)); ?>"alt="">
                    <p class="twitter_username" ><?php echo e($twitter->user->name); ?></p>
                    <p class="mention" ><?php echo e('@'.$twitter->user->mention); ?></p>
                    <p class="tweet_date" ><?php echo e($twitter->created_at); ?></p>
                    <div class="tweet_area tweet_area_under">
                        <?php echo csrf_field(); ?>
                        <div class="tweet_text2"  placeholder="hello" id="tweet2" readonly ><?php echo e($twitter->tweet); ?></div>
                        
                        <!--投稿のidが自身の場合のみdeleteボタン表示-->
                        <?php if($twitter->user->id === $user_id): ?>
                        <div class="delete_button">
                            <button class="delete_button_inner"  type="submit">削除</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/twitter/resources/views/top.blade.php ENDPATH**/ ?>