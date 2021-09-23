<!DOCTYPE html>
<html lang="ja">
<head>
<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>   
    <title>Twitter Profile</title>
</head>
<body>
<?php $__env->startSection('content'); ?>
    <section class="section_profile">
        <div class="profile_wrapper">
        <?php echo $__env->make('nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="profile_box">
                <div class="profile_partition">
                    <form action="/edit-page/image"method="POST"  enctype="multipart/form-data" accept="image/png, image/jpeg,image/jpg">
                    <?php echo csrf_field(); ?>
                    <img class="profile_images_size twitter_top_menu-image twitter-profile_image " src="<?php echo e(asset('/storage/images/'.$user->product_image)); ?>" alt="">
                        <p> 
                            <label for="image">Profile_image:</label>
                            <input type="file" name="image" class="input-file"
                            id="image">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button" for="image">
                    </form>

                    <form action="/edit" method="POST">
                        <?php echo csrf_field(); ?>
                        <p>
                            <label for="name">name：</label>
                            <input id="name" type="text" name="name" value="<?php echo e($user->name); ?>">
                        </p>
                        
                        <p>
                            <label for="mention">mention：</label>
                            <input id="mention" type="text" name="mention" value="<?php echo e($user->mention); ?>">
                            <?php $__errorArgs = ['mention'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </p>
                        <p>
                            <label for="password">新しいパスワード：</label>
                            <input id="password" type="text"  name="password"  autocomplete="new-password" >
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </p>
                        <p>
                            <label for="password_confirmation">新しいパスワード(確認)：</label>
                            <input id="password-confirm" type="text"  name="password_confirmation"  autocomplete="new-password">
                        </p>
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>
                    <form action="<?php echo e(route('email.change')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <p>
                            <label for="email">E-mail：</label>
                            <input id="email" type="text" name="email" value="<?php echo e($user->email); ?>">
                            
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </p>
                        <!---メールアドレスが変わらない場合--->
                        <!---メールが送られたメッセージ--->
                        <?php if(session('flash_message')): ?>
                        <div class="flash_message alert-success text-center py-1 my-1">
                            <?php echo e(session('flash_message')); ?>

                        </div>
                        <?php endif; ?>
                        
                        <input type="submit" name="edit" value="変更" class="edit_button">
                    </form>
                </div>  
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
        
</body>
</html>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/twitter/resources/views/profile.blade.php ENDPATH**/ ?>