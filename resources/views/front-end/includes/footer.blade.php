@if( Schema::hasTable('site_managements'))
    @php
        $footer = \App\SiteManagement::getMetaValue('footer_settings');
        $search_menu = \App\SiteManagement::getMetaValue('search_menu');
        $menu_title = DB::table('site_managements')->select('meta_value')->where('meta_key', 'menu_title')->get()->first();
    @endphp
    <footer id="wt-footer" class="wt-footer wt-haslayout">
        @if (!empty($footer))
            <div class="wt-footerholder wt-haslayout">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="wt-footerlogohold">
                                @if (!empty($footer['footer_logo']))
                                    <strong class="wt-logo"><a href="{{{ url('/') }}}"><img src="{{{ asset(\App\Helper::getFooterLogo($footer['footer_logo'])) }}}" alt="company logo here"></a></strong>
                                @endif
                                @if (!empty($footer['description']))
                                    <div class="wt-description">
                                        <p>{{{ str_limit($footer['description'], 150)  }}}</p>
                                    </div>
                                @endif
                                @php Helper::displaySocials(); @endphp
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
    </footer>
@endif
