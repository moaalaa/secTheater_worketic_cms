<div class="wt-location wt-tabsinfo">
    <div class="wt-tabscontenttitle">
        <h2><?php echo e(trans('lang.banner_photo')); ?></h2>
    </div>
    <div class="wt-settingscontent">
        <?php if(!empty($banner)): ?> 
            <?php $image = '/uploads/users/'.Auth::user()->id.'/'.$banner; ?>
            <div class="wt-formtheme wt-userform">
                <div v-if="this.uploaded_banner">
                    <upload-image :id="'banner_id'" :img_ref="'banner_ref'" :url="'<?php echo e(url('user/upload-temp-image')); ?>'" :name="'hidden_banner_image'">
                    </upload-image>
                </div>
                <div class="wt-uploadingbox" v-else>
                    <figure><img src="<?php echo e(asset($image)); ?>" alt="<?php echo e(trans('lang.profile_photo')); ?>"></figure>
                    <div class="wt-uploadingbar">
                        <div class="dz-filename"><?php echo e($banner); ?></div>
                        <em><?php echo e(trans('lang.file_size')); ?><a href="javascript:void(0);" class="lnr lnr-cross" v-on:click.prevent="removeBanner('hidden_banner')"></a></em>
                    </div>
                </div>
                <input type="hidden" name="hidden_banner_image" id="hidden_banner" value="<?php echo e($banner); ?>">
            </div>
        <?php else: ?>
            <div class="wt-formtheme wt-userform">
                <upload-image :id="'banner_id'" :img_ref="'banner_ref'" :url="'<?php echo e(url('user/upload-temp-image')); ?>'" :name="'hidden_banner_image'">
                </upload-image>
                <input type="hidden" name="hidden_banner_image" id="hidden_banner">
            </div>
        <?php endif; ?>
    </div>
</div>