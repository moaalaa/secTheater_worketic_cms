<?php if(Schema::hasTable('site_managements')): ?>
    <?php
        $settings = array();
        $setting = \App\SiteManagement::getMetaValue('settings');
        $logo = !empty($setting[0]['logo']) ? Helper::getHeaderLogo($setting[0]['logo']) : '/images/logo.png';
        $inner_header = !empty(Route::getCurrentRoute()) && Route::getCurrentRoute()->uri() != '/' ? 'wt-headervtwo' : '';
        $type = Helper::getAccessType();
    ?>
<?php endif; ?>
<header id="wt-header" class="wt-header wt-haslayout <?php echo e($inner_header); ?>">
    <div class="wt-navigationarea">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?php if(auth()->guard()->check()): ?>
                        <?php echo e(Helper::displayEmailWarning()); ?>

                    <?php endif; ?>
                    <?php if(!empty($logo) || Schema::hasTable('site_managements')): ?>
                        <strong class="wt-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset($logo)); ?>" alt="<?php echo e(trans('Logo')); ?>"></a></strong>
                    <?php endif; ?>

                    <div class="wt-rightarea">
                        <nav id="wt-nav" class="wt-nav navbar-expand-lg">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <i class="lnr lnr-menu"></i>
                            </button>
                            <div class="collapse navbar-collapse wt-navigation" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li>
                                        <a href="<?php echo e(route('posts.index')); ?>">
                                            <?php echo e(trans('lang.posts')); ?>

                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                        <?php if(auth()->guard()->guest()): ?>
                            <div class="wt-loginarea">
                                <div class="wt-loginoption">
                                    <a href="javascript:void(0);" id="wt-loginbtn" class="wt-loginbtn"><?php echo e(trans('lang.login')); ?></a>
                                    <div class="wt-loginformhold" <?php if($errors->has('email') || $errors->has('password')): ?> style="display: block;" <?php endif; ?>>
                                        <div class="wt-loginheader">
                                            <span><?php echo e(trans('lang.login')); ?></span>
                                            <a href="javascript:;"><i class="fa fa-times"></i></a>
                                        </div>
                                        <form method="POST" action="<?php echo e(route('login')); ?>" class="wt-formtheme wt-loginform do-login-form">
                                            <?php echo csrf_field(); ?>
                                            <fieldset>
                                                <div class="form-group">
                                                    <input id="email" type="email" name="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                                        placeholder="Email" required autofocus>
                                                    <?php if($errors->has('email')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <input id="password" type="password" name="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>"
                                                        placeholder="Password" required>
                                                    <?php if($errors->has('password')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                                    </span>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="wt-logininfo">
                                                        <button type="submit" class="wt-btn do-login-button"><?php echo e(trans('lang.login')); ?></button>
                                                    <span class="wt-checkbox">
                                                        <input id="remember" type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                                        <label for="remember"><?php echo e(trans('lang.remember')); ?></label>
                                                    </span>
                                                </div>
                                            </fieldset>
                                            <div class="wt-loginfooterinfo">
                                                <?php if(Route::has('password.request')): ?>
                                                    <a href="<?php echo e(route('password.request')); ?>" class="wt-forgot-password"><?php echo e(trans('lang.forget_pass')); ?></a>
                                                <?php endif; ?>
                                                <a href="<?php echo e(route('register')); ?>"><?php echo e(trans('lang.create_account')); ?></a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <a href="<?php echo e(route('register')); ?>" class="wt-btn"><?php echo e(trans('lang.join_now')); ?></a>
                            </div>
                        <?php endif; ?>
                        <?php if(auth()->guard()->check()): ?>
                            <?php
                                $user = !empty(Auth::user()) ? Auth::user() : '';
                                $role = !empty($user) ? $user->getRoleNames()->first() : array();
                                $profile = \App\User::find($user->id)->profile;
                                $user_image = !empty($profile) ? $profile->avater : '';
                                $profile_image = !empty($user_image) ? '/uploads/users/'.$user->id.'/'.$user_image : 'images/user-login.png';
                                
                            ?>
                                <div class="wt-userlogedin">
                                    <figure class="wt-userimg">
                                        <img src="<?php echo e(asset($profile_image)); ?>" alt="<?php echo e(trans('lang.user_avatar')); ?>">
                                    </figure>
                                    <div class="wt-username">
                                        <h3><?php echo e(Helper::getUserName(Auth::user()->id)); ?></h3>
                                        <span><?php echo e($user->roles()->first()->name); ?></span>
                                    </div>
                                    <?php echo $__env->make('back-end.includes.profile-menu', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
