@extends('front-end.master', ['body_class' => 'wt-innerbgcolor'])

@section('title', 'Posts List')

@section('description', 'Posts List Page')

@section('content')
    
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
                            <li class="active">{{ trans('lang.posts') }}</li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wt-haslayout wt-main-section" id="user_profile">
        <div class="wt-haslayout">
            <div class="container">
                <div class="row">
                    <div id="wt-twocolumns" class="wt-twocolumns wt-haslayout">
                        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-xl-4 float-left">
                            @include('front-end.posts.filters', ['categories' => $categories])
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 col-xl-8 float-left">
                            <div class="wt-userlistingtitle">
                                @if ($posts->isNotEmpty())
                                    <span>
                                        {{ $posts->count() }} of {{ $allPostsCount }} {{ trans('lang.results') }} 
                                    </span>
                                @endif
                            </div>
                            <div class="wt-companysinfoholder">
                                <div class="row">
                                    @if ($posts->isNotEmpty())
                                        @foreach ($posts as $post)
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-6">


                                                <div class="card mb-3">
                                                    <img src="{{ $post->imagePath }}" class="card-img-top" alt="{{ $post->title }}" style="height: 15rem !important;">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{ $post->title }}</h5>
                                                        <p class="card-text">
                                                            {{ str_limit($post->body, 100, '...') }}
                                                        </p>
                                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-link">{{ trans('lang.read_more') }}</a>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                        @if ( method_exists($posts,'links') )
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 la-postpagintaion">
                                                {{ $posts->links('pagination.custom') }}
                                            </div>
                                        @endif
                                    @else
                                        @include('errors.no-record')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
