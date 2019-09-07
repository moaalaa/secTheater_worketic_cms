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
                <div class="col-xl-2"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-8 float-left">
                        <div class="wt-dashboardbox la-post-box">
                            <div class="wt-dashboardboxtitle">
                                <h2><?php echo e(trans('lang.edit_post')); ?></h2>
                            </div>
                            <div class="wt-dashboardboxcontent">
                                <?php echo Form::open([ 'url' => route('admin.posts.update', $post), 'method' => 'PATCH', 'class' =>'wt-formtheme wt-formprojectinfo wt-formpost', 'id'=> 'posts', 'files' => true ]); ?>

                                    <fieldset>
                                        <div class="form-group">
                                            <label class="form-group-label"><?php echo e(trans('lang.title')); ?></label>
                                            <?php echo Form::text( 'title', $post->title, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.title')] ); ?>

                                            <?php if($errors->has('title')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('title')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-group-label"><?php echo e(trans('lang.body')); ?></label>
                                            <?php echo Form::textarea( 'body', $post->body, ['class' =>'form-control', 'placeholder' => trans('lang.body')] ); ?>

                                        </div>
                                        <div class="form-group">
                                            <label class="form-group-label"><?php echo e(trans('lang.categories')); ?></label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                <option selected disabled> <?php echo e(trans('lang.categories')); ?> </option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e($post->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->title); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="wt-settingscontent">
                                                <div class = "wt-formtheme wt-userform">
                                                    <input type="file" name="image" id="image">
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <img src="<?php echo e($post->imagePath); ?>" alt="<?php echo e($post->title); ?>" width="200" >
                                        </div>
                                        <div class="form-group wt-btnarea">
                                            <?php echo Form::submit(trans('lang.edit'), ['class' => 'wt-btn']); ?>

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

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>