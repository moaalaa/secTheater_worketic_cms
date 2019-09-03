<nav id="wt-profiledashboard" class="wt-usernav">
        <ul>
            <?php if($role === 'admin'): ?>
                
                <li>
                    <a href="<?php echo e(route('userListing')); ?>">
                        <i class="ti-user"></i>
                        <span><?php echo e(trans('lang.manage_users')); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo e(route('emailTemplates')); ?>">
                        <i class="ti-email"></i>
                        <span><?php echo e(trans('lang.email_templates')); ?></span>
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                    <a href="<?php echo e(route('pages')); ?>">
                        <i class="ti-layers"></i>
                        <span><?php echo e(trans('lang.pages')); ?></span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="<?php echo e(route('pages')); ?>"><?php echo e(trans('lang.all_pages')); ?></a></li>
                        <li><a href="<?php echo e(route('createPage')); ?>"><?php echo e(trans('lang.add_pages')); ?></a></li>
                    </ul>
                </li>
               
                <li>
                    <a href="<?php echo e(route('homePageSettings')); ?>">
                        <i class="ti-home"></i>
                        <span><?php echo e(trans('lang.home_page_settings')); ?></span>
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
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="ti-layers"></i></span>
                    <a href="<?php echo e(route('categories')); ?>">
                        <i class="ti-layers"></i>
                        <span><?php echo e(trans('lang.taxonomies')); ?></span>
                    </a>
                    <ul class="sub-menu">
                        
                        <li><a href="<?php echo e(route('categories')); ?>"><?php echo e(trans('lang.cate')); ?></a></li>
                        <li><a href="<?php echo e(route('admin.posts.adminIndex')); ?>"><?php echo e(trans('lang.posts')); ?></a></li>
                        
                        <li><a href="<?php echo e(route('languages')); ?>"><?php echo e(trans('lang.langs')); ?></a></li>
                        <li><a href="<?php echo e(route('locations')); ?>"><?php echo e(trans('lang.locations')); ?></a></li>
                        
                        
                        
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
