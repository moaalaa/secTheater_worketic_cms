@extends('back-end.master')
@section('content')
    <div class="cats-listing" id="cat-list">
        @if (Session::has('message'))
            <div class="flash_msg">
                <flash_messages :message_class="'success'" :time ='5' :message="'{{{ Session::get('message') }}}'" v-cloak></flash_messages>
            </div>
        @elseif (Session::has('error'))
            <div class="flash_msg">
                <flash_messages :message_class="'danger'" :time ='5' :message="'{{{ Session::get('error') }}}'" v-cloak></flash_messages>
            </div>
        @endif
        <section class="wt-haslayout wt-dbsectionspace la-editcategory">
            <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-8 float-left">
                        <div class="wt-dashboardbox la-post-box">
                            <div class="wt-dashboardboxtitle">
                                <h2>{{{ trans('lang.edit_post') }}}</h2>
                            </div>
                            <div class="wt-dashboardboxcontent">
                                {!! Form::open([ 'url' => route('admin.posts.update', $post), 'method' => 'PATCH', 'class' =>'wt-formtheme wt-formprojectinfo wt-formpost', 'id'=> 'posts', 'files' => true ]) !!}
                                    <fieldset>
                                        <div class="form-group">
                                            <label class="form-group-label">{{ trans('lang.title') }}</label>
                                            {!! Form::text( 'title', $post->title, ['class' =>'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => trans('lang.title')] ) !!}
                                            @if ($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="form-group-label">{{{ trans('lang.body') }}}</label>
                                            {!! Form::textarea( 'body', $post->body, ['class' =>'form-control', 'placeholder' => trans('lang.body')] ) !!}
                                        </div>
                                        <div class="form-group">
                                            <label class="form-group-label">{{{ trans('lang.categories') }}}</label>
                                            <select name="category_id" class="form-control" id="category_id" required>
                                                <option selected disabled> {{ trans('lang.categories') }} </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="wt-settingscontent">
                                                <div class = "wt-formtheme wt-userform">
                                                    <input type="file" name="image" id="image">
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="form-group">
                                            <img src="{{ $post->imagePath }}" alt="{{ $post->title }}" width="200" >
                                        </div>
                                        <div class="form-group wt-btnarea">
                                            {!! Form::submit(trans('lang.edit'), ['class' => 'wt-btn']) !!}
                                        </div>
                                    </fieldset>
                                {!! Form::close(); !!}
                            </div>
                        </div>
                    </div>
            </div>
        </section>
    </div>
@endsection
