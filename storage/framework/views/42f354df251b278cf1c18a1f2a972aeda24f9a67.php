<?php echo Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'general-setting-form', '@submit.prevent'=>'submitGeneralSettings']); ?>

    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2><?php echo e(trans('lang.site_title')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    <?php echo Form::text('settings[0][title]', e($title), array('class' => 'form-control', 'placeholder'=>trans('lang.site_title'))); ?>

                </div>
            </div>
        </div>
    </div>
    
    <?php echo $__env->make('back-end.admin.settings.general.logo', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <?php echo $__env->make('back-end.admin.settings.general.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
    
    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
        <div class="wt-tabscontenttitle">
                <h2><?php echo e(trans('lang.color_setting')); ?></h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p><?php echo e(trans('lang.color_setting_note')); ?></p>
            </div>
            <ul class="wt-accountinfo">
                <li>
                    <switch_button v-model="enable_theme_color">
                        <span v-if="enable_theme_color"><?php echo e(trans('lang.primary_color')); ?></span>
                        <span v-else><?php echo e(trans('lang.custom_color')); ?></span>
                    </switch_button>
                    <input type="hidden" :value="enable_theme_color" name="settings[0][enable_theme_color]">
                </li>
            </ul>
            <div class="form-group la-color-picker" v-if="enable_theme_color">
                <verte display="widget" v-model="primary_color" menuPosition="left" model="hex"></verte>
                <input type="hidden" name="settings[0][primary_color]" :value="primary_color">
            </div>
        </div>
    </div>
    
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span><?php echo e(trans('lang.save_changes_note')); ?></span>
        <?php echo Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']); ?>

    </div>
<?php echo Form::close(); ?>

