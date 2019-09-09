<?php $__env->startSection('content'); ?>
    <section class="wt-haslayout wt-dbsectionspace wt-insightuser" id="dashboard">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="wt-insightsitemholder">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="wt-insightsitem wt-dashboardbox <?php echo e($notify_class); ?>">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_new_message_icon, 'book')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.new_msgs')); ?></h3>
                                        <a href="<?php echo e(url('message-center')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(!empty($enable_package) && $enable_package === 'true'): ?>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                                <div class="wt-insightsitem wt-dashboardbox user_current_package">
                                    <countdown
                                    date="<?php echo e($expiry_date); ?>"
                                    :image_url="'<?php echo e(Helper::getDashExpiryImages('uploads/settings/icon',$latest_package_expiry_icon, 'img-21.png')); ?>'"
                                    :title="'<?php echo e(trans('lang.check_pkg_expiry')); ?>'"
                                    :package_url="'<?php echo e(url('dashboard/packages/employer')); ?>'"
                                    :current_package="'<?php echo e($package->title); ?>'"
                                    >
                                    </countdown>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
                            <div class="wt-insightsitem wt-dashboardbox">
                                <figure class="wt-userlistingimg">
                                    <?php echo e(Helper::getImages('uploads/settings/icon',$latest_saved_item_icon, 'lnr lnr-heart')); ?>

                                </figure>
                                <div class="wt-insightdetails">
                                    <div class="wt-title">
                                        <h3><?php echo e(trans('lang.view_saved_items')); ?></h3>
                                        <a href="<?php echo e(url('employer/saved-items')); ?>"><?php echo e(trans('lang.click_view')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
        
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>