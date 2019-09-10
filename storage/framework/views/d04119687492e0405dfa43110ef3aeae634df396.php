<?php $__env->startSection('content'); ?>
<?php



    $roles          = Spatie\Permission\Models\Role::all()->toArray();
    $register_form = App\SiteManagement::getMetaValue('reg_form_settings');
    $reg_one_title = !empty($register_form) && !empty($register_form[0]['step1-title']) ? $register_form[0]['step1-title'] : trans('lang.join_for_good');
    $reg_one_subtitle = !empty($register_form) && !empty($register_form[0]['step1-subtitle']) ? $register_form[0]['step1-subtitle'] : trans('lang.join_for_good_reason');
    $reg_two_title = !empty($register_form) && !empty($register_form[0]['step2-title']) ? $register_form[0]['step2-title'] : trans('lang.pro_info');
    $reg_two_subtitle = !empty($register_form) && !empty($register_form[0]['step2-subtitle']) ? $register_form[0]['step2-subtitle'] : '';
    $term_note = !empty($register_form) && !empty($register_form[0]['step2-term-note']) ? $register_form[0]['step2-term-note'] : trans('lang.agree_terms');
    $reg_three_title = !empty($register_form) && !empty($register_form[0]['step3-title']) ? $register_form[0]['step3-title'] : trans('lang.almost_there');
    $reg_three_subtitle = !empty($register_form) && !empty($register_form[0]['step3-subtitle']) ? $register_form[0]['step3-subtitle'] : trans('lang.acc_almost_created_note');
    $register_image = !empty($register_form) && !empty($register_form[0]['register_image']) ? '/uploads/settings/home/'.$register_form[0]['register_image'] : 'images/work.jpg';
    $reg_page = !empty($register_form) && !empty($register_form[0]['step3-page']) ? $register_form[0]['step3-page'] : '';
    $reg_four_title = !empty($register_form) && !empty($register_form[0]['step4-title']) ? $register_form[0]['step4-title'] : trans('lang.congrats');
    $reg_four_subtitle = !empty($register_form) && !empty($register_form[0]['step4-subtitle']) ? $register_form[0]['step4-subtitle'] : trans('lang.acc_creation_note');
    $show_emplyr_inn_sec = !empty($register_form) && !empty($register_form[0]['show_emplyr_inn_sec']) ? $register_form[0]['show_emplyr_inn_sec'] : 'true';
    $show_reg_form_banner = !empty($register_form) && !empty($register_form[0]['show_reg_form_banner']) ? $register_form[0]['show_reg_form_banner'] : 'true';
    $reg_form_banner = !empty($register_form) && !empty($register_form[0]['reg_form_banner']) ? $register_form[0]['reg_form_banner'] : null;
    $breadcrumbs_settings = \App\SiteManagement::getMetaValue('show_breadcrumb');
    $show_breadcrumbs = !empty($breadcrumbs_settings) ? $breadcrumbs_settings : 'true';
?>
<?php if(!empty($show_reg_form_banner) && $show_reg_form_banner === 'true'): ?>
    <div class="wt-haslayout wt-innerbannerholder" style="background-image:url(<?php echo e(asset(Helper::getBannerImage('uploads/settings/home/'.$reg_form_banner))); ?>)">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2><?php echo e(trans('lang.join_for_free')); ?></h2>
                        </div>
                        <?php if(!empty($show_breadcrumbs) && $show_breadcrumbs === 'true'): ?>
                            <ol class="wt-breadcrumb">
                                <li><a href="<?php echo e(url('/')); ?>"><?php echo e(trans('lang.home')); ?></a></li>
                                <li class="wt-active"><?php echo e(trans('lang.join_now')); ?></li>
                            </ol>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="wt-haslayout wt-main-section">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-xs-12 col-sm-12 col-md-10 push-md-1 col-lg-8 push-lg-2" id="registration">
                <div class="preloader-section" v-if="loading" v-cloak>
                    <div class="preloader-holder">
                        <div class="loader"></div>
                    </div>
                </div>
                <div class="wt-registerformhold">
                    <div class="wt-registerformmain">
                        <div class="wt-joinforms">
                            <form method="POST" action="<?php echo e(url('register/form-step1-custom-errors')); ?>" class="wt-formtheme wt-formregister" @submit.prevent="checkStep1" id="register_form">
                                <?php echo csrf_field(); ?>
                                <fieldset class="wt-registerformgroup">
                                    <div class="wt-haslayout" v-if="step === 1" v-cloak>
                                        <div class="wt-registerhead">
                                            <div class="wt-title">
                                                <h3><?php echo e($reg_one_title); ?></h3>
                                            </div>
                                            <div class="wt-description">
                                                <p><?php echo e($reg_one_subtitle); ?></p>
                                            </div>
                                        </div>
                                        <ul class="wt-joinsteps">
                                            <li class="wt-active"><a href="javascrip:void(0);"><?php echo e(trans('lang.01')); ?></a></li>
                                            <li><a href="javascrip:void(0);"><?php echo e(trans('lang.02')); ?></a></li>
                                            <li><a href="javascrip:void(0);"><?php echo e(trans('lang.03')); ?></a></li>
                                            <li><a href="javascrip:void(0);"><?php echo e(trans('lang.04')); ?></a></li>
                                        </ul>
                                        <div class="form-group form-group-half">
                                            <input type="text" name="first_name" class="form-control" placeholder="<?php echo e(trans('lang.ph_first_name')); ?>" v-bind:class="{ 'is-invalid': form_step1.is_first_name_error }" v-model="first_name">
                                            <span class="help-block" v-if="form_step1.first_name_error">
                                                <strong v-cloak>{{form_step1.first_name_error}}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group form-group-half">
                                            <input type="text" name="last_name" class="form-control" placeholder="<?php echo e(trans('lang.ph_last_name')); ?>" v-bind:class="{ 'is-invalid': form_step1.is_last_name_error }" v-model="last_name">
                                            <span class="help-block" v-if="form_step1.last_name_error">
                                                <strong v-cloak>{{form_step1.last_name_error}}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <input id="user_email" type="email" class="form-control" name="email" placeholder="<?php echo e(trans('lang.ph_email')); ?>" value="<?php echo e(old('email')); ?>" v-bind:class="{ 'is-invalid': form_step1.is_email_error }" v-model="user_email">
                                            <span class="help-block" v-if="form_step1.email_error">
                                                <strong v-cloak>{{form_step1.email_error}}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="wt-btn"><?php echo e(trans('lang.btn_startnow')); ?></button>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="wt-haslayout" v-if="step === 2" v-cloak>
                                    <fieldset class="wt-registerformgroup">
                                        <div class="wt-registerhead">
                                            <div class="wt-title">
                                                <h3><?php echo e($reg_two_title); ?></h3>
                                            </div>
                                            <?php if(!empty($reg_two_subtitle)): ?>
                                                <div class="wt-description">
                                                    <p><?php echo e($reg_two_subtitle); ?></p>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <ul class="wt-joinsteps">
                                            <li class="wt-done-next"><a href="javascrip:void(0);"><i class="fa fa-check"></i></a></li>
                                            <li class="wt-active"><a href="javascrip:void(0);"><?php echo e(trans('lang.02')); ?></a></li>
                                            <li><a href="javascrip:void(0);"><?php echo e(trans('lang.03')); ?></a></li>
                                            <li><a href="javascrip:void(0);"><?php echo e(trans('lang.04')); ?></a></li>
                                        </ul>
                                        <?php if(!empty($locations)): ?>
                                            <div class="form-group">
                                                <span class="wt-select">
                                                    <?php echo Form::select('locations', $locations, null, array('placeholder' => trans('lang.select_locations'), 'v-bind:class' => '{ "is-invalid": form_step2.is_locations_error }')); ?>

                                                    <span class="help-block" v-if="form_step2.locations_error">
                                                        <strong v-cloak>{{form_step2.locations_error}}</strong>
                                                    </span>
                                                </span>
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group form-group-half">
                                            <input id="password" type="password" class="form-control" name="password" placeholder="<?php echo e(trans('lang.ph_pass')); ?>" v-bind:class="{ 'is-invalid': form_step2.is_password_error }">
                                            <span class="help-block" v-if="form_step2.password_error">
                                                <strong v-cloak>{{form_step2.password_error}}</strong>
                                            </span>
                                        </div>
                                        <div class="form-group form-group-half">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="<?php echo e(trans('lang.ph_retry_pass')); ?>" v-bind:class="{ 'is-invalid': form_step2.is_password_confirm_error }">
                                            <span class="help-block" v-if="form_step2.password_confirm_error">
                                                <strong v-cloak>{{form_step2.password_confirm_error}}</strong>
                                            </span>
                                        </div>
                                    </fieldset>
                                    <fieldset class="wt-termsconditions">
                                        <div class="wt-checkboxholder">
                                            <span class="wt-checkbox">
                                                <input id="termsconditions" type="checkbox" name="termsconditions" checked="">
                                                <label for="termsconditions"><span><?php echo e($term_note); ?></span></label>
                                                <span class="help-block" v-if="form_step2.termsconditions_error">
                                                    <strong style="color: red;" v-cloak><?php echo e(trans('lang.register_termsconditions_error')); ?></strong>
                                                </span>
                                            </span>
                                            <a href="#" @click.prevent="prev()" class="wt-btn"><?php echo e(trans('lang.previous')); ?></a>
                                            <a href="#" @click.prevent="checkStep2('<?php echo e(trans('lang.email_not_config')); ?>')" class="wt-btn"><?php echo e(trans('lang.continue')); ?></a>
                                        </div>
                                    </fieldset>
                                </div>
                            </form>
                            
                            <div class="wt-gotodashboard" v-if="step === 3" v-cloak>
                                <ul class="wt-joinsteps">
                                    <li class="wt-done-next"><a href="javascrip:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="wt-done-next"><a href="javascrip:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="wt-done-next"><a href="javascrip:void(0);"><i class="fa fa-check"></i></a></li>
                                    <li class="wt-done-next"><a href="javascrip:void(0);"><i class="fa fa-check"></i></a></li>
                                </ul>
                                <div class="wt-registerhead">
                                    <div class="wt-title">
                                        <h3><?php echo e($reg_four_title); ?></h3>
                                    </div>
                                    <div class="description">
                                        <p><?php echo e($reg_four_subtitle); ?></p>
                                    </div>
                                </div>
                                <a href="#" class="wt-btn" @click.prevent="loginRegisterUser()"><?php echo e(trans('lang.goto_dashboard')); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="wt-registerformfooter">
                        <span><?php echo e(trans('lang.have_account')); ?><a id="wt-lg" href="javascript:void(0);" @click.prevent='scrollTop()'><?php echo e(trans('lang.btn_login_now')); ?></a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('front-end.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>