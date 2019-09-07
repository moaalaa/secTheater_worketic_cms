<?php echo Form::open(['url' => route('posts.index'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch']); ?>

    
    <aside id="wt-sidebar" class="wt-sidebar">
        
        
        <div class="wt-widget wt-startsearch">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.start_search')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="<?php echo e(trans('lang.ph_search_posts')); ?>" value="<?php echo e(isset($keyword) ? $keyword : ''); ?>">
                            <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2><?php echo e(trans('lang.cats')); ?></h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="wt-checkboxholder wt-verticalscrollbar">
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="wt-checkbox">
                                
                                <input id="cat-<?php echo e($category->id); ?>" type="checkbox" name="categoriesFilter[]" value="<?php echo e($category->id); ?>" <?php echo e(in_array($category->id, $categoriesFilter) ? 'checked' : ''); ?>>
                                <label for="cat-<?php echo e($category->id); ?>"> <?php echo e($category->title); ?></label>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                
                </fieldset>
            </div>
        </div>
        
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgetcontent">
                <div class="wt-applyfilters">
                    <span><?php echo e(trans('lang.apply_filter')); ?><br> <?php echo e(trans('lang.changes_by_you')); ?></span>
                    <?php echo Form::submit(trans('lang.btn_apply_filters'), ['class' => 'wt-btn']); ?>

                </div>
            </div>
        </div>
    </aside>
<?php echo form::close();; ?>