<?php if(auth()->guard()->check()): ?>
    <div id="wt-sidebarwrapper" class="wt-sidebarwrapper">
        <div id="wt-btnmenutoggle" class="wt-btnmenutoggle">
            <span class="menu-icon">
                <em></em>
                <em></em>
                <em></em>
            </span>
        </div>
        <?php
            $user = !empty(Auth::user()) ? Auth::user() : '';
            $role = !empty($user) ? $user->getRoleNames()->first() : array();
            $profile = \App\User::find($user->id)->profile;
            $setting = \App\SiteManagement::getMetaValue('footer_settings');
            $copyright = !empty($setting) ? $setting['copyright'] : 'All Rights Reserved';
        ?>
        <div id="wt-verticalscrollbar" class="wt-verticalscrollbar">
            <div class="wt-companysdetails wt-usersidebar">
                <figure class="wt-companysimg">
                    <img src="<?php echo e(asset(Helper::getUserProfileBanner($user->id, 'small'))); ?>" alt="<?php echo e(trans('lang.profile_banner')); ?>">
                </figure>
                <div class="wt-companysinfo">
                    <figure><img src="<?php echo e(asset(Helper::getProfileImage($user->id))); ?>" alt="<?php echo e(trans('lang.profile_photo')); ?>"></figure>
                    <div class="wt-title">
                        <h2>
                            <a href="<?php echo e($role != 'admin' ? url($role.'/dashboard') : 'javascript:void()'); ?>">
                                <?php echo e(!empty(Auth::user()) ? Helper::getUserName(Auth::user()->id) : 'No Name'); ?>

                            </a>
                        </h2>
                        <span><?php echo e(!empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Auth::user()->getRoleNames()->first()); ?></span>
                    </div>

                    <div class="wt-btnarea"><a href="<?php echo e(url(route('showUserProfile', ['slug' => Auth::user()->slug]))); ?>" class="wt-btn"><?php echo e(trans('lang.view_profile')); ?></a></div>
                </div>
            </div>
            <nav id="wt-navdashboard" class="wt-navdashboard">
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
                            <a href="javascript:void(0)">
                                <i class="ti-settings"></i>
                                <span><?php echo e(trans('lang.settings')); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><hr><a href="<?php echo e(route('adminProfile')); ?>"><?php echo e(trans('lang.acc_settings')); ?></a></li>
                                <li><hr><a href="<?php echo e(url('admin/settings')); ?>"><?php echo e(trans('lang.general_settings')); ?></a></li>
                                <li><hr><a href="<?php echo e(route('resetPassword')); ?>"><?php echo e(trans('lang.reset_pass')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if($role === 'user'): ?>
                        <li class="menu-item-has-children">
                            <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                            <a href="javascript:void(0)">
                                <i class="ti-settings"></i>
                                <span><?php echo e(trans('lang.settings')); ?></span>
                            </a>
                            <ul class="sub-menu">
                                <li><hr><a href="<?php echo e(route('userProfile')); ?>"><?php echo e(trans('lang.acc_settings')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                            
                    <li>
                        <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();">
                            <i class="lnr lnr-exit"></i><?php echo e(trans('lang.logout')); ?>

                        </a>
                        <form id="dashboard-logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </li>
                </ul>
            </nav>
            <div class="wt-navdashboard-footer">
                <span><?php echo e($copyright); ?></span>
                <span class="version-area"><?php echo e(config('app.version')); ?></span>
            </div>
        </div>
    </div>
<?php endif; ?>
