<?php if( Schema::hasTable('site_managements')): ?>
    <?php
        $footer = \App\SiteManagement::getMetaValue('footer_settings');
        $search_menu = \App\SiteManagement::getMetaValue('search_menu');
        $menu_title = DB::table('site_managements')->select('meta_value')->where('meta_key', 'menu_title')->get()->first();
    ?>
    <footer id="wt-footer" class="wt-footer wt-haslayout">
        <?php if(!empty($footer)): ?>
            <div class="wt-footerholder wt-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="wt-footerlogohold">
                                <?php if(!empty($footer['footer_logo'])): ?>
                                    <strong class="wt-logo"><a href="<?php echo e(url('/')); ?>"><img src="<?php echo e(asset(\App\Helper::getFooterLogo($footer['footer_logo']))); ?>" alt="company logo here"></a></strong>
                                <?php endif; ?>
                                <?php if(!empty($footer['description'])): ?>
                                    <div class="wt-description">
                                        <p><?php echo e(str_limit($footer['description'], 150)); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php Helper::displaySocials(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        
    </footer>
<?php endif; ?>
