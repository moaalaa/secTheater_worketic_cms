<?php $__env->startSection('title', $post->title); ?>

<?php $__env->startSection('description', $post->body); ?>

<?php $__env->startSection('content'); ?>
    
<div id="posts-app">

    

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
                            <li><a href="<?php echo e(route('posts.index')); ?>"><?php echo e(trans('lang.posts')); ?></a></li>
                            <li class="active"><?php echo e($post->title); ?></li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wt-main-section wt-haslayout la-profile-holder" id="post_profile">
        <div class="container">
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-4">
                    <div class="card">
                        <img src="<?php echo e($post->imagePath); ?>" class="card-img-top" alt="<?php echo e($post->title); ?>">
                        <div class="card-body" style="line-height: 2;">
                            <div class="card-title"><h3><?php echo e($post->title); ?></h3></div>
                            <div class="card-text"><?php echo $post->body; ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-4">
                    <comments-list class="mb-5" :post="<?php echo e($post); ?>" :comments="<?php echo e($post->comments); ?>"></comments-list>

                    <new-comment test="test" :post="<?php echo e($post); ?>" v-if="$signedIn"></new-comment>
                    <div class="alert alert-success" v-else>You Must Be LoggedIn To Join Post Discussion</div>

                </div>
                
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.master', ['body_class' => 'wt-innerbgcolor'] , \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>