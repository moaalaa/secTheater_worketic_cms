@auth
    <div id="wt-sidebarwrapper" class="wt-sidebarwrapper">
        <div id="wt-btnmenutoggle" class="wt-btnmenutoggle">
            <span class="menu-icon">
                <em></em>
                <em></em>
                <em></em>
            </span>
        </div>
        @php
            $user = !empty(Auth::user()) ? Auth::user() : '';
            $role = !empty($user) ? $user->getRoleNames()->first() : array();
            $profile = \App\User::find($user->id)->profile;
            $setting = \App\SiteManagement::getMetaValue('footer_settings');
            $copyright = !empty($setting) ? $setting['copyright'] : 'All Rights Reserved';
        @endphp
        <div id="wt-verticalscrollbar" class="wt-verticalscrollbar">
            <div class="wt-companysdetails wt-usersidebar">
                <figure class="wt-companysimg">
                    <img src="{{{ asset(Helper::getUserProfileBanner($user->id, 'small')) }}}" alt="{{{ trans('lang.profile_banner') }}}">
                </figure>
                <div class="wt-companysinfo">
                    <figure><img src="{{{ asset(Helper::getProfileImage($user->id)) }}}" alt="{{{ trans('lang.profile_photo') }}}"></figure>
                    <div class="wt-title">
                        <h2>
                            <a href="{{{ $role != 'admin' ? url($role.'/dashboard') : 'javascript:void()' }}}">
                                {{{ !empty(Auth::user()) ? Helper::getUserName(Auth::user()->id) : 'No Name' }}}
                            </a>
                        </h2>
                        <span>{{{ !empty(Auth::user()->profile->tagline) ? str_limit(Auth::user()->profile->tagline, 26, '') : Auth::user()->getRoleNames()->first() }}}</span>
                    </div>

                    <div class="wt-btnarea"><a href="{{{ url(route('showUserProfile', ['slug' => Auth::user()->slug])) }}}" class="wt-btn">{{{ trans('lang.view_profile') }}}</a></div>
                </div>
            </div>
            <nav id="wt-navdashboard" class="wt-navdashboard">
                <ul>
                    @if ($role === 'admin')
                        <li>
                            <a href="{{{ route('admin.posts.adminIndex') }}}">
                                <i class="ti-briefcase"></i>
                                <span>{{ trans('lang.posts') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{{ route('categories') }}}">
                                <i class="ti-briefcase"></i>
                                <span>{{ trans('lang.cats') }}</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{{ route('userListing') }}}">
                                <i class="ti-user"></i>
                                <span>{{ trans('lang.manage_users') }}</span>
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                            <a href="javascript:void(0)">
                                <i class="ti-settings"></i>
                                <span>{{ trans('lang.settings') }}</span>
                            </a>
                            <ul class="sub-menu">
                                <li><hr><a href="{{{ route('adminProfile') }}}">{{ trans('lang.acc_settings') }}</a></li>
                                <li><hr><a href="{{{ url('admin/settings') }}}">{{ trans('lang.general_settings') }}</a></li>
                                <li><hr><a href="{{{ route('resetPassword') }}}">{{ trans('lang.reset_pass') }}</a></li>
                            </ul>
                        </li>
                    @endif
                    @if ($role === 'user')
                        <li class="menu-item-has-children">
                            <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                            <a href="javascript:void(0)">
                                <i class="ti-settings"></i>
                                <span>{{ trans('lang.settings') }}</span>
                            </a>
                            <ul class="sub-menu">
                                <li><hr><a href="{{{ route('userProfile') }}}">{{ trans('lang.acc_settings') }}</a></li>
                            </ul>
                        </li>
                    @endif
                            
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('dashboard-logout-form').submit();">
                            <i class="lnr lnr-exit"></i>{{{trans('lang.logout')}}}
                        </a>
                        <form id="dashboard-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </nav>
            <div class="wt-navdashboard-footer">
                <span>{{{ $copyright }}}</span>
                <span class="version-area">{{ config('app.version') }}</span>
            </div>
        </div>
    </div>
@endauth
