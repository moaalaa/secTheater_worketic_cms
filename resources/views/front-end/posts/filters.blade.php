{!! Form::open(['url' => route('posts.index'), 'method' => 'get', 'class' => 'wt-formtheme wt-formsearch']) !!}
    
    <aside id="wt-sidebar" class="wt-sidebar">
        
        {{-- Search Block --}}
        <div class="wt-widget wt-startsearch">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.start_search') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <div class="wt-formtheme wt-formsearch">
                    <fieldset>
                        <div class="form-group">
                            <input type="text" name="keyword" class="form-control" placeholder="{{ trans('lang.ph_search_posts') }}" value="{{ isset($keyword) ? $keyword : '' }}">
                            <button type="submit" class="wt-searchgbtn"><i class="lnr lnr-magnifier"></i></button>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgettitle">
                <h2>{{ trans('lang.cats') }}</h2>
            </div>
            <div class="wt-widgetcontent">
                <fieldset>
                    <div class="wt-checkboxholder wt-verticalscrollbar">
                        @foreach ($categories as $category)
                            <span class="wt-checkbox">
                                {{-- {{ $checked }}  --}}
                                <input id="cat-{{ $category->id }}" type="checkbox" name="categoriesFilter[]" value="{{ $category->id }}" {{ in_array($category->id, $categoriesFilter) ? 'checked' : '' }}>
                                <label for="cat-{{ $category->id }}"> {{ $category->title }}</label>
                            </span>
                        @endforeach
                    </div>
                
                </fieldset>
            </div>
        </div>
        
        <div class="wt-widget wt-effectiveholder">
            <div class="wt-widgetcontent">
                <div class="wt-applyfilters">
                    <span>{{ trans('lang.apply_filter') }}<br> {{ trans('lang.changes_by_you') }}</span>
                    {!! Form::submit(trans('lang.btn_apply_filters'), ['class' => 'wt-btn']) !!}
                </div>
            </div>
        </div>
    </aside>
{!! form::close(); !!}