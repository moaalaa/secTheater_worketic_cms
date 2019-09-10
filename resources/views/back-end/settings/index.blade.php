@extends('back-end.master')
@section('content')
    <div class="freelancer-profile wt-dbsectionspace la-user-details" id="user_profile">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9">
                <div class="wt-dashboardbox wt-dashboardtabsholder wt-accountsettingholder">

                    @include('back-end.settings.tabs')

                    <div class="wt-tabscontent tab-content">
                        @if (Session::has('message'))
                            <div class="flash_msg">
                                <flash_messages :message_class="'success'" :time='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul class="wt-jobalerts">
                                @foreach ($errors->all() as $error)
                                    <div class="flash_msg">
                                        <flash_messages :message_class="'danger'" :time='10' :message="'{{{ $error }}}'" v-cloak></flash_messages>
                                    </div>
                                @endforeach
                            </ul>
                        @endif
                        <div class="wt-personalskillshold tab-pane active show">
                            {!! Form::open(['url' => '', 'class' =>'wt-userform', 'id' => 'user_data', '@submit.prevent' => 'submitUserProfile']) !!}
                                <div class="wt-yourdetails wt-tabsinfo">
                                    <div class="wt-tabscontenttitle">
                                        <h2>{{{ trans('lang.your_details') }}}</h2>
                                    </div>
                                    <div class="lara-detail-form">
                                        <fieldset>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'first_name', e(Auth::user()->first_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph_first_name')]) !!}
                                            </div>
                                            <div class="form-group form-group-half">
                                                {!! Form::text( 'last_name', e(Auth::user()->last_name), ['class' =>'form-control', 'placeholder' => trans('lang.ph_last_name')]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::email('email', e(Auth::user()->email), array('class' => 'form-control', 'placeholder' => trans('lang.ph_email'))) !!}
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="wt-profilephoto wt-tabsinfo">
                                    @include('back-end.settings.profile_photo')
                                </div>
                                <div class="wt-bannerphoto wt-tabsinfo">
                                    @include('back-end.settings.profile_banner')
                                </div>
                                <div class="wt-updatall la-updateall-holder">
                                    <i class="ti-announcement"></i>
                                    <span>{{{ trans('lang.save_changes_note') }}}</span> {!! Form::submit(trans('lang.btn_save_update'),
                                    ['class' => 'wt-btn', 'id'=>'submit-profile']) !!}
                                </div>
                            {!! form::close(); !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
