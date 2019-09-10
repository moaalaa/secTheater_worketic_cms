<nav id="wt-profiledashboard" class="wt-usernav">
        <ul>
            <?php if($role === 'admin'): ?>
                <li>
                    <a href="<?php echo e(route('admin.posts.adminIndex')); ?>">
                        <i class="ti-briefcase"></i>
                        <span><?php echo e(trans('lang.posts')); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('categories')); ?>">
                        <i class="ti-briefcase"></i>
                        <span><?php echo e(trans('lang.cats')); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('userListing')); ?>">
                        <i class="ti-user"></i>
                        <span><?php echo e(trans('lang.manage_users')); ?></span>
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                    <a href="<?php echo e(route('adminProfile')); ?>">
                        <i class="ti-settings"></i>
                        <span><?php echo e(trans('lang.settings')); ?></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo e(route('adminProfile')); ?>"><?php echo e(trans('lang.acc_settings')); ?></a></li>
                        <li><a href="<?php echo e(route('settings')); ?>"><?php echo e(trans('lang.general_settings')); ?></a></li>
                        <li><a href="<?php echo e(route('resetPassword')); ?>"><?php echo e(trans('lang.reset_pass')); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <?php if($role === 'user'): ?>
                <li>
                    <a href="<?php echo e(route('showUserProfile', auth()->user()->slug)); ?>">
                        <i class="ti-user"></i>
                        <span><?php echo e(trans('lang.view_profile')); ?></span>
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                    <a href="javascript:void(0);">
                        <i class="ti-settings"></i>
                        <span><?php echo e(trans('lang.settings')); ?></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo e(route('userProfile')); ?>"><?php echo e(trans('lang.acc_settings')); ?></a></li>
                    </ul>
                </li>
            <?php endif; ?>
            <li>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
                    <i class="lnr lnr-exit"></i>
                    <?php echo e(trans('lang.logout')); ?>

                </a>
                <form id="profile-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        </ul>
    </nav>
