@extends('themes::layout')
@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $logo = get_theme_option('logo_url');
    $title = isset($title) ? $title : setting('site_homepage_title', '');

@endphp

@push('header')
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" type="text/css">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com/">
    <link href="{{ asset('/themes/8anime/css/base.css') }}?v={{ config('theme8anime.version') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/themes/8anime/css/m.min.css') }}?v={{ config('theme8anime.version') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript">
	setTimeout(function(){
        var wpse326013 = document.createElement('link');
        wpse326013.rel = 'stylesheet';
        wpse326013.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css';
        wpse326013.type = 'text/css';
        var godefer = document.getElementsByTagName('link')[0];
        godefer.parentNode.insertBefore(wpse326013, godefer);
        var wpse326013_2 = document.createElement('link');
        wpse326013_2.rel = 'stylesheet';
        wpse326013_2.href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css';
        wpse326013_2.type = 'text/css';
        var godefer2 = document.getElementsByTagName('link')[0];
        godefer2.parentNode.insertBefore(wpse326013_2, godefer2);
    }, 500);
    </script>
    <noscript>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
</noscript>
@endpush
@push('body_attributes')
data-page="page_anime"
@endpush
@section('body')
@if( get_theme_option('PreloadControl')== 1)
<div id="sixanime"></div>
@endif
@include('themes::theme8anime.inc.menu')
<div id="header" class="header-home ">
    <div class="container">
        <div id="mobile_menu">
            <i class="fa fa-bars"></i>
        </div>
        <a href="/" id="logo" title="{{ $title }}">
            @if ($logo)
                <img src="{{ $logo }}" width="100%" height="auto" alt="{{ $title }}">
            @endif
            <div class="clearfix"></div>
        </a>
        <div id="search">
            <div class="search-content">
                <form action="/search" autocomplete="off">
                    <a href="/filter" class="filter-icon">Filter</a>
                    <input type="text" class="form-control search-input" name="keyword" id="searching" placeholder="Search anime..." required>
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
                <div class="nav search-result-pop" id="search-suggest" style="display: none;">
                    <div class="loading-relative" id="search-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                    <div class="result" style="display:none;"></div>
                </div>
            </div>
        </div>
        @include('themes::theme8anime.inc.headergroup')
<div class="clearfix"></div>
</div>
</div>

<div class="header-setting">
    @include('themes::theme8anime.inc.view_header')
    <div class="clearfix"></div>
    
    <div id="main-wrapper" class="layout-page layout-page-404">
    <div class="container">
    <div class="container-404 text-center">
    <div class="c4-big-img"><img src="{{ asset('/themes/8anime/images/404.png') }}"></div>
    <div class="c4-medium">Rất tiếc, chúng tôi không thể tìm thấy trang đó!</div>
    <div class="c4-small">Có thể đã xảy ra sự cố hoặc trang không còn tồn tại nữa.</div>
    <div class="c4-button">
    <a href="/" class="btn btn-radius btn-focus"><i class="fa fa-chevron-circle-left mr-2"></i>Quay lại trang chủ</a>
    </div>
    </div>
    <div class="clearfix"></div>
    </div>
    </div> 
            <div id="footer" data-settings="{&quot;auto_play&quot;:1,&quot;auto_next&quot;:1,&quot;auto_load_comments&quot;:0,&quot;enable_dub&quot;:0,&quot;anime_name&quot;:&quot;jp&quot;,&quot;play_original_audio&quot;:0}">
                <div id="footer-about">
                    <div class="container">
                        <div class="footer-top">
                            <a href="/" title="{{ $title }}" rel="home" class="footer-logo">
                                @if ($logo)
                                    <img src="{{ $logo }}" alt="{{ $title }}">
                                @endif
                                <div class="clearfix"></div>
                            </a>
        @include('themes::theme8anime.inc.view_footer')
        {!! get_theme_option('footer') !!}
                        <div class="about-text">
                            {{ $title }}
                             không lưu trữ bất kỳ tệp nào trên máy chủ của chúng tôi, chúng tôi chỉ chia sẻ liên kết tới phương tiện được lưu trữ trên các dịch vụ của bên thứ ba.</div>
                        <p class="copyright">Copyright ©
                            {!! date("Y")  !!} {{ $title }}
                             . All Rights Reserved</p>
                    </div>
                </div>
            </div>        
            <div id="mask-overlay"></div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/app.min.js') }}?v=0.0000002"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/common.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/movie.js') }}?v=0.0000001"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/function.js') }}?v=0.0000001"></script>
            <div style="display:none;">
    </div>
    </div>                
@endsection

@push('scripts')
@endpush

@section('footer')
    
    {!! setting('site_scripts_google_analytics') !!}
@endsection
