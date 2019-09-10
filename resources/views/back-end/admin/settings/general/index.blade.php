{!! Form::open(['url' => '', 'class' =>'wt-formtheme wt-userform', 'id' =>'general-setting-form', '@submit.prevent'=>'submitGeneralSettings'])!!}
    <div class="wt-location wt-tabsinfo">
        <div class="wt-tabscontenttitle">
            <h2>{{{ trans('lang.site_title') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-formtheme wt-userform">
                <div class="form-group">
                    {!! Form::text('settings[0][title]', e($title), array('class' => 'form-control', 'placeholder'=>trans('lang.site_title'))) !!}
                </div>
            </div>
        </div>
    </div>
    
    @include('back-end.admin.settings.general.logo')
    @include('back-end.admin.settings.general.favicon') 
    
    <div class="wt-securitysettings wt-tabsinfo wt-haslayout">
        <div class="wt-tabscontenttitle">
                <h2>{{{ trans('lang.color_setting') }}}</h2>
        </div>
        <div class="wt-settingscontent">
            <div class="wt-description">
                <p>{{{ trans('lang.color_setting_note') }}}</p>
            </div>
            <ul class="wt-accountinfo">
                <li>
                    <switch_button v-model="enable_theme_color">
                        <span v-if="enable_theme_color">{{{ trans('lang.primary_color') }}}</span>
                        <span v-else>{{{ trans('lang.custom_color') }}}</span>
                    </switch_button>
                    <input type="hidden" :value="enable_theme_color" name="settings[0][enable_theme_color]">
                </li>
            </ul>
            <div class="form-group la-color-picker" v-if="enable_theme_color">
                <verte display="widget" v-model="primary_color" menuPosition="left" model="hex"></verte>
                <input type="hidden" name="settings[0][primary_color]" :value="primary_color">
            </div>
        </div>
    </div>
    
    <div class="wt-updatall la-updateall-holder">
        <i class="ti-announcement"></i>
        <span>{{{ trans('lang.save_changes_note') }}}</span>
        {!! Form::submit(trans('lang.btn_save'),['class' => 'wt-btn']) !!}
    </div>
{!! Form::close() !!}
