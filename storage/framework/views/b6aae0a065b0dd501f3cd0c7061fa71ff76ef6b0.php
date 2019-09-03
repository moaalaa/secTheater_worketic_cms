<?php $__env->startSection('content'); ?>
    <div class="cats-listing" id="cat-list">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <section class="wt-haslayout wt-dbsectionspace la-editcategory">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 float-left">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle">
                            <h2><?php echo e(trans('lang.edit_cat')); ?></h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <?php echo Form::open(['url' => url('admin/categories/update-cats/'.$cats->id.''),
                                'class' =>'wt-formtheme wt-formprojectinfo wt-formcategory', 'id' => 'categories'] ); ?>

                                <fieldset>
                                    <div class="form-group">
                                        <?php echo Form::text( 'category_title', e($cats['title']), ['class' =>'form-control'] ); ?>

                                        <span class="form-group-description"><?php echo e(trans('lang.desc')); ?></span>
                                    </div>
                                    <div class="form-group">
                                        <?php echo Form::textarea( 'category_abstract', e($cats['abstract']), ['class' =>'form-control',
                                        'placeholder' => trans('lang.ph_desc')] ); ?>

                                        <span class="form-group-description"><?php echo e(trans('lang.cat_desc')); ?></span>
                                    </div>
                                    <div class="wt-settingscontent">
                                        <?php if(!empty($cats['image'])): ?>
                                            <div class="wt-formtheme wt-userform">
                                                <div v-if="this.uploaded_image">
                                                    <upload-image
                                                        :id="'cat_image'"
                                                        :img_ref="'cat_img'"
                                                        :url="'<?php echo e(url('admin/categories/upload-temp-image')); ?>'"
                                                        :name="'uploaded_image'"
                                                        >
                                                    </upload-image>
                                                    <?php echo Form::hidden( 'uploaded_image', '', ['id'=>'hidden_img'] ); ?>

                                                </div>
                                                <div class="form-group" v-else>
                                                    <ul class="wt-attachfile">
                                                        <li>
                                                            <span><?php echo e($cats['image']); ?></span>
                                                            <em><?php echo e(trans('lang.file_size')); ?> <span data-dz-size></span>
                                                                <a class="dz-remove" href="javascript:void();" v-on:click.prevent="removeImage('hidden_img')" >
                                                                    <span class="lnr lnr-cross"></span>
                                                                </a>
                                                            </em>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" name="uploaded_image" id="hidden_img" value="<?php echo e($cats['image']); ?>">
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <div class = "wt-formtheme wt-userform">
                                                <upload-image
                                                    :id="'cat_image'"
                                                    :img_ref="'cat_ref'"
                                                    :url="'<?php echo e(url('admin/categories/upload-temp-image')); ?>'"
                                                    :name="'uploaded_image'"
                                                    >
                                                </upload-image>
                                                <?php echo Form::hidden( 'uploaded_image', '', ['id'=>'hidden_img'] ); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group wt-btnarea">
                                        <?php echo Form::submit(trans('lang.update_cat'), ['class' => 'wt-btn']); ?>

                                    </div>
                                </fieldset>
                            <?php echo Form::close();; ?>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>