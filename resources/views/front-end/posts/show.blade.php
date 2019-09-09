@extends('front-end.master', ['body_class' => 'wt-innerbgcolor'] )

@section('title', $post->title)

@section('description', $post->body)

@section('content')
    
<div id="posts-app">

    {{-- Banner --}}

    <div class="wt-haslayout wt-innerbannerholder" style="background-image:url({{ asset('/images/bannerimg/img-02.jpg') }})">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                        <div class="wt-title">
                            <h2>{{ trans('lang.posts') }}</h2>
                        </div>

                        <ol class="wt-breadcrumb">
                            <li><a href="/">{{ trans('lang.home') }}</a></li>
                            <li><a href="{{ route('posts.index') }}">{{ trans('lang.posts') }}</a></li>
                            <li class="active">{{ $post->title }}</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wt-main-section wt-haslayout la-profile-holder" id="post_profile">
        <div class="container">
            <div class="row">
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-4">
                    <div class="card">
                        <img src="{{ $post->imagePath }}" class="card-img-top" alt="{{ $post->title }}">
                        <div class="card-body" style="line-height: 2;">
                            <div class="card-title"><h3>{{ $post->title }}</h3></div>
                            <div class="card-text">{!! $post->body !!}</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                
                <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2 col-xl-2 mb-4"></div>
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8 mb-4">
                    <comments-list class="mb-5" :post="{{ $post }}" :comments="{{ $post->comments }}"></comments-list>

                    <new-comment test="test" :post="{{ $post }}" v-if="$signedIn"></new-comment>
                    <div class="alert alert-success" v-else>You Must Be LoggedIn To Join Post Discussion</div>

                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
