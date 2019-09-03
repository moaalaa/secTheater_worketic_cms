<?php $__env->startSection('content'); ?>
    <div class="wt-haslayout wt-innerbannerholder">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title"><h2>Posts Listing</h2></div>
                        <?php if(!empty($show_breadcrumbs) && $show_breadcrumbs === 'true'): ?>
                            <ol class="wt-breadcrumb">
                                <li><a href="/">Home</a></li>
                                <li class="wt-active">Posts</li>
                            </ol>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-haslayout wt-main-section" id="jobs">
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-9 col-xl-9 float-left">
                            <div class="wt-companysinfoholder">
                                <div class="row">
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                            <div class="wt-companysdetails">
                                                <figure class="wt-companysimg">
                                                    <img src="<?php echo e(asset('/images/banner.jpg')); ?>" alt="<?php echo e(trans('lang.img')); ?>">
                                                </figure>
                                                <div class="wt-companysinfo">
                                                    <figure><img src="<?php echo e(asset(\App\Helper::getCategoryImage($category->image))); ?>" alt="<?php echo e($category->title); ?>"></figure>
                                                    <div class="wt-title">
                                                        <h2><?php echo e($category->title); ?></h2>
                                                    </div>
                                                    <div class="wt-description">
                                                        <p><?php echo e($category->abstract); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make(file_exists(resource_path('views/extend/front-end/master.blade.php')) ? 
'extend.front-end.master':
 'front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>