<?php $__env->startSection('title', 'Posts List'); ?>

<?php $__env->startSection('description', 'Posts List Page'); ?>

<?php $__env->startSection('content'); ?>
    
    

    <div class="wt-haslayout wt-innerbannerholder" style="background-image:url(<?php echo e(asset('/images/bannerimg/img-02.jpg')); ?>)">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2><?php echo e(trans('lang.posts')); ?></h2>
                        </div>

                        <ol class="wt-breadcrumb">
                            <li><a href="/"><?php echo e(trans('lang.home')); ?></a></li>
                            <li class="active"><?php echo e(trans('lang.posts')); ?></li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wt-haslayout wt-main-section" id="user_profile">
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            <?php echo $__env->make('front-end.posts.filters', ['categories' => $categories], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingtitle">
                                <?php if($posts->isNotEmpty()): ?>
                                    <span>
                                        <?php echo e($posts->count()); ?> of <?php echo e($allPostsCount); ?> <?php echo e(trans('lang.results')); ?> 
                                        
                                        
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="wt-companysinfoholder">
                                <div class="row">
                                    <?php if($posts->isNotEmpty()): ?>
                                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6">


                                                <div class="card mb-3">
                                                    <img src="<?php echo e($post->imagePath); ?>" class="card-img-top" alt="<?php echo e($post->title); ?>" style="height: 15rem !important;">
                                                    <div class="card-body">
                                                        <h5 class="card-title"><?php echo e($post->title); ?></h5>
                                                        <p class="card-text">
                                                            <?php echo e(str_limit($post->body, 100, '...')); ?>

                                                        </p>
                                                        <a href="<?php echo e(route('posts.show', $post)); ?>" class="btn btn-link"><?php echo e(trans('lang.read_more')); ?></a>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if( method_exists($posts,'links') ): ?>
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 la-postpagintaion">
                                                <?php echo e($posts->links('pagination.custom')); ?>

                                            </div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <?php echo $__env->make('errors.no-record', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.master', ['body_class' => 'wt-innerbgcolor'], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>