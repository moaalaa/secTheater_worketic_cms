<div class="wt-tabscontenttitle">
    <h2><?php echo e(trans('lang.add_socials')); ?></h2>
</div>
<?php echo $__env->make('back-end.admin.settings.footer.socials', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'footer-setting-form', '@submit.prevent'=>'submitFooterSettings']); ?>

        
        <?php echo $__env->make('back-end.admin.settings.footer.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="wt-location wt-tabsinfo">
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.about_us_note')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <?php echo Form::textarea('footer[description]', e($footer_desc), array('class' => 'form-control')); ?>

                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.copyright_text')); ?></h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        <?php echo Form::text('footer[copyright]', e($footer_copyright), array('class' => 'form-control')); ?>

                    </div>
                </div>
            </div>

        </div>
        <div class="wt-updatall la-updateall-holder">
            <i class="ti-announcement"></i>
            <span><?php echo e(trans('lang.save_changes_note')); ?></span>
            <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

        </div>
        
    <?php echo Form::close(); ?>

