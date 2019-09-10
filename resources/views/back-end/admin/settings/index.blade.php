@extends(file_exists(resource_path('views/extend/back-end/master.blade.php')) ? 'extend.back-end.master' : 'back-end.master')
@section('content')
    <div class="wt-haslayout wt-manage-account wt-dbsectionspace la-admin-setting" id="settings">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 float-left">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">
                    <div class="wt-dashboardtabs">
                        <ul class="wt-tabstitle nav navbar-nav">
                            <li class="nav-item">
                                <a class="{{{ \Request::route()->getName()==='settings/#wt-general'? 'active': '' }}}" data-toggle="tab" href="#wt-general">{{ trans('lang.general_settings') }}</a>
                            </li>

                            <li class="nav-item">
                                <a class="{{{ \Request::route()->getName()==='settings/#wt-footer'? 'active': '' }}}" data-toggle="tab" href="#wt-footer">{{ trans('lang.footer_settings') }}</a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="wt-tabscontent tab-content">
                        <div class="wt-securityhold tab-pane active la-general-setting" id="wt-general">
                            @include('back-end.admin.settings.general.index')
                        </div>
                        <div class="wt-securityhold tab-pane la-footer-setting" id="wt-footer">
                            @include('back-end.admin.settings.footer.index')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
