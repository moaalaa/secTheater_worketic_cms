<div class="wt-tabscontenttitle">
    <h2>{{{ trans('lang.add_socials') }}}</h2>
</div>
@include('back-end.admin.settings.footer.socials')
{!! Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'footer-setting-form', '@submit.prevent'=>'submitFooterSettings']) !!}
        
        @include('back-end.admin.settings.footer.logo')
        <div class="wt-location wt-tabsinfo">
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.about_us_note') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::textarea('footer[description]', e($footer_desc), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.copyright_text') }}}</h2>
            </div>
            <div class="wt-settingscontent">
                <div class="wt-formtheme wt-userform">
                    <div class="form-group">
                        {!! Form::text('footer[copyright]', e($footer_copyright), array('class' => 'form-control')) !!}
                    </div>
                </div>
            </div>

        </div>
        <div class="wt-updatall la-updateall-holder">
            <i class="ti-announcement"></i>
            <span>{{{ trans('lang.save_changes_note') }}}</span>
            {!! Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']) !!}
        </div>
        
    {!! Form::close() !!}
