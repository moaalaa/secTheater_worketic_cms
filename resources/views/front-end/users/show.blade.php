@extends('front-end.master', ['body_class' => 'wt-innerbgcolor'])

@section('title', $user->full_name)
@section('description', $user->profile->description)

@section('content')
    @php $breadcrumbs = Breadcrumbs::generate('showUserProfile', $user->slug); @endphp

    <div class="wt-haslayout wt-innerbannerholder">
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-xs-12 col-sm-12 col-md-8 push-md-2 col-lg-6 push-lg-3">
                    <div class="wt-innerbannercontent">
                    <div class="wt-title"><h2>{{ Helper::getUserName($user->id) }}</h2></div>
                    @if (!empty($show_breadcrumbs) && $show_breadcrumbs === 'true')
                        <ol class="wt-breadcrumb">
                            @foreach ($breadcrumbs as $breadcrumb)
                                @if ($breadcrumb->url && !$loop->last)
                                    <li><a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a></li>
                                @else
                                    <li class="active">{{{ $breadcrumb->title }}}</li>
                                @endif
                            @endforeach
                        </ol>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wt-main-section wt-haslayout la-profile-holder" id="user_profile">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                    <div class="wt-comsingleimg">
                        <figure><img src="{{{ asset(Helper::getUserProfileBanner($user->id)) }}}" alt="{{{ trans('lang.company_banner') }}}"></figure>
                    </div>
                </div>
                
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                    <aside id="wt-sidebar" class="wt-sidebar">
                        <div class="wt-proposalsr wt-proposalsrvtwo">
                            <div class="wt-widgetcontent wt-companysinfo" style="padding-top: inherit; margin-top: inherit;">
                                <figure><img src="{{{ asset(Helper::getProfileImage($user->id)) }}}" alt="{{ trans('lang.img') }}"></figure>
                                <div class="wt-title">
                                    <h2>{{{ $user->full_name }}}</h2>
                                </div>
                            </div>                                  
                        </div>
                    </aside>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 ">
                    <div class="wt-userlistingholder wt-haslayout">
                        <div class="wt-comcontent">
                            <div class="wt-title">
                                <h3>{{ trans('lang.about') }} “{{{ $user->full_name }}}”</h3>
                            </div>
                            <div class="wt-description">
                                @php echo htmlspecialchars_decode(stripslashes($user->profile->description)); @endphp
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var popupMeta = {
            width: 400,
            height: 400
        }
        $(document).on('click', '.social-share', function(event){
            event.preventDefault();

            var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
                hPosition = Math.floor(($(window).height() - popupMeta.height) / 2);

            var url = $(this).attr('href');
            var popup = window.open(url, 'Social Share',
                'width='+popupMeta.width+',height='+popupMeta.height+
                ',left='+vPosition+',top='+hPosition+
                ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1');

            if (popup) {
                popup.focus();
                return false;
            }
        })
    </script>
@endpush
