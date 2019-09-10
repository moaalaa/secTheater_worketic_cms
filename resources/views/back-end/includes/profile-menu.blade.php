<nav id="wt-profiledashboard" class="wt-usernav">
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
                    <a href="{{{ route('adminProfile') }}}">
                        <i class="ti-settings"></i>
                        <span>{{ trans('lang.settings') }}</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{{ route('adminProfile') }}}">{{ trans('lang.acc_settings') }}</a></li>
                        <li><a href="{{{ route('settings') }}}">{{ trans('lang.general_settings') }}</a></li>
                        <li><a href="{{{ route('resetPassword') }}}">{{ trans('lang.reset_pass') }}</a></li>
                    </ul>
                </li>
            @endif
            @if ($role === 'user')
                <li>
                    <a href="{{ route('showUserProfile', auth()->user()->slug) }}">
                        <i class="ti-user"></i>
                        <span>{{ trans('lang.view_profile') }}</span>
                    </a>
                </li>
                <li class="menu-item-has-children">
                    <span class="wt-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>
                    <a href="javascript:void(0);">
                        <i class="ti-settings"></i>
                        <span>{{ trans('lang.settings') }}</span>
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{{ route('userProfile') }}}">{{ trans('lang.acc_settings') }}</a></li>
                    </ul>
                </li>
            @endif
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('profile-logout-form').submit();">
                    <i class="lnr lnr-exit"></i>
                    {{{trans('lang.logout')}}}
                </a>
                <form id="profile-logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
