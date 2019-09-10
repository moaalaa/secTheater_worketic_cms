<?php $__env->startSection('content'); ?>
    <div class="posts-listing" id="post-list">
        <?php if(Session::has('message')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'<?php echo e(Session::get('message')); ?>'" v-cloak></flash_messages>
            </div>
        <?php elseif(Session::has('error')): ?>
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'<?php echo e(Session::get('error')); ?>'" v-cloak></flash_messages>
            </div>
        <?php endif; ?>
        <section class="wt-haslayout wt-dbsectionspace la-addnewposts">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-4 float-left">
                    <div class="wt-dashboardbox la-post-box">
                        <div class="wt-dashboardboxtitle">
                            <h2><?php echo e(trans('lang.add_post')); ?></h2>
                        </div>
                        <div class="wt-dashboardboxcontent">
                            <?php echo Form::open([ 'url' => route('admin.posts.store'), 'class' =>'wt-formtheme wt-formprojectinfo wt-formpost', 'id'=> 'posts', 'files' => true ]); ?>

                                <fieldset>
                                    <div class="form-group">
                                        <label class="form-group-label"><?php echo e(trans('lang.title')); ?></label>
                                        <?php echo Form::text( 'title', null, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.title')] ); ?>

                                        <?php if($errors->has('title')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('title')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-group-label"><?php echo e(trans('lang.body')); ?></label>
                                        <?php echo Form::textarea( 'body', null, ['class' =>'form-control', 'placeholder' => trans('lang.body')] ); ?>

                                    </div>
                                    <div class="form-group">
                                        <label class="form-group-label"><?php echo e(trans('lang.categories')); ?></label>
                                        <select name="category_id" class="form-control" id="category_id" required>
                                            <option selected disabled> <?php echo e(trans('lang.categories')); ?> </option>
                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($category->id); ?>"><?php echo e($category->title); ?></option>
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
                                    <div class="form-group wt-btnarea">
                                        <?php echo Form::submit(trans('lang.add'), ['class' => 'wt-btn']); ?>

                                    </div>
                                </fieldset>
                            <?php echo Form::close();; ?>

                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-8 float-right">
                    <div class="wt-dashboardbox">
                        <div class="wt-dashboardboxtitle wt-titlewithsearch">
                            <h2><?php echo e(trans('lang.posts')); ?></h2>
                            <?php echo Form::open(['url' => url('admin/posts/search'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch']); ?>

                            <fieldset>
                                <div class="form-group">
                                    <input type="text" name="keyword" value="" class="form-control" placeholder="<?php echo e(trans('lang.ph_search_posts')); ?>">
                                    <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                                </div>
                            </fieldset>
                            <?php echo Form::close(); ?>

                            <a href="javascript:void(0);" v-if="this.is_show" @click="deleteChecked('<?php echo e(trans('lang.ph_delete_confirm_title')); ?>', '<?php echo e(trans('lang.ph_post_delete_message')); ?>', '<?php echo e(route('admin.posts.multi-delete')); ?>',  '<?php echo e(route('admin.posts.adminIndex')); ?>', false)" class="wt-skilldel">
                                <i class="lnr lnr-trash"></i>
                                <span><?php echo e(trans('lang.del_select_rec')); ?></span>
                            </a>
                        </div>
                        <?php if($posts->count() > 0): ?>
                            <div class="wt-dashboardboxcontent wt-categoriescontentholder">
                                <table class="wt-tablecategories" id="checked-val">
                                    <thead>
                                        <tr>
                                            <th>
                                                <span class="wt-checkbox">
                                                    <input name="posts[]" id="wt-posts" @click="selectAll" type="checkbox" name="head">
                                                    <label for="wt-posts"></label>
                                                </span>
                                            </th>
                                            <th><?php echo e(trans('lang.name')); ?></th>
                                            <th><?php echo e(trans('lang.category')); ?></th>
                                            <th><?php echo e(trans('lang.action')); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $counter = 0; ?>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="del-<?php echo e($post->id); ?>">
                                                <td>
                                                    <span class="wt-checkbox">
                                                        <input name="posts[]" @click="selectRecord" value="<?php echo e($post->id); ?>" id="wt-check-<?php echo e($counter); ?>" type="checkbox" name="head">
                                                        <label for="wt-check-<?php echo e($counter); ?>"></label>
                                                    </span>
                                                </td>
                                                <td><?php echo e($post->title); ?></td>
                                                <td><?php echo e(optional($post->category)->title); ?></td>
                                                <td>
                                                    <div class="wt-actionbtn">
                                                        <a href="<?php echo e(route('admin.posts.edit', $post)); ?>" class="wt-addinfo wt-skillsaddinfo">
                                                            <i class="lnr lnr-pencil"></i>
                                                        </a>
                                                        <delete :title="'<?php echo e(trans("lang.ph_delete_confirm_title")); ?>'" :id="'<?php echo e($post->id); ?>'" :message="'<?php echo e(trans("lang.ph_post_delete_message")); ?>'" :url="'<?php echo e(route('admin.posts.destroy')); ?>'"></delete>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php $counter++; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                
                                <?php echo e($posts->links('pagination.custom')); ?>

                                
                            </div>
                        <?php else: ?>
                            <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('back-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>