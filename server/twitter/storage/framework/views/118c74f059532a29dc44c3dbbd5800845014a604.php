<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">
</head>
<body>
    <div>
        <header>
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <button
                class="navbar-toggler"
                type="button"
                data-mdb-toggle="collapse"
                data-mdb-target="#navbarExample01"
                aria-controls="navbarExample01"
                aria-expanded="false"
                aria-label="Toggle navigation"
                >
                <i class="fas fa-bars"></i>
                </button>
                <?php if(Auth::check()): ?>

                    <?php if(Auth::id() == $user->id): ?>
                        <div class="collapse navbar-collapse" id="navbarExample01">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 pd-l ">
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/">Home</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/edit-page">Profile</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users-follow">Follow</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users-follower">Follower</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/users">Users</a>
                            </li>
                            <li class="nav-item active ">
                            <a class="nav-link text-light" aria-current="page" href="/favorite">Favorite</a>
                            </li>
                    <?php endif; ?>

                <?php endif; ?>   
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto pd-r">
                    <!-- Authentication Links -->
                    <?php if(auth()->guard()->guest()): ?>
                        <li class="nav-item ">
                            <a class="nav-link self-color text-light " href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a>
                        </li>
                        <?php if(Route::has('register')): ?>
                            <li class="nav-item ">
                                <a class="nav-link self-color text-light " href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <?php echo e(Auth::user()->name); ?>

                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item self-color" href="<?php echo e(route('logout')); ?>"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <?php echo e(__('Logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                    <?php echo csrf_field(); ?>
                                </form>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
                </div>
            </div>
            </nav>
        </header>
        <!-- Navbar -->
        <main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
            <?php echo $__env->yieldContent('top'); ?>
        </main>
    </div>
</body>
</html>
<?php /**PATH /var/www/twitter/resources/views/layouts/app.blade.php ENDPATH**/ ?>