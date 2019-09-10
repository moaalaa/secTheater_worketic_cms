<?php 
    $curr_user_id = !empty(Auth::user()) ? Auth::user()->id : '';
    $role_type = App\User::getUserRoleType($curr_user_id);
?>
<div class="wt-dashboardtabs">
    <ul class="wt-tabstitle nav navbar-nav">
        <?php if(!empty($role_type) && $role_type->name <> 'admin' ): ?>
            
            <li class="nav-item">
                <a class="<?php echo e(\Request::route()->getName() ==='userProfile'? 'active': ''); ?>" href="<?php echo e(route('userProfile')); ?>"><?php echo e(trans('lang.personal_details')); ?></a>
            </li>
            <li class="nav-item">
                <a class="<?php echo e(\Request::route()->getName() ==='deleteAccount'? 'active': ''); ?>" href="<?php echo e(route('deleteAccount')); ?>"><?php echo e(trans('lang.delete_account')); ?></a>
            </li>
        <?php endif; ?>
        <li class="nav-item">
            <a class="<?php echo e(\Request::route()->getName()==='resetPassword'? 'active': ''); ?>" href="<?php echo e(route('resetPassword')); ?>"><?php echo e(trans('lang.reset_pass')); ?></a>
        </li>
    </ul>
</div>