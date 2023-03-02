
<img src="{{ get_theme_option('home_url') }}/themes/8anime/images/share-icons.gif"
    data-src="{{ $src }}"
    @isset($alt)
    alt="{{ $alt }}"
    @endisset

    @isset($width)
    width="{{ $width }}" 
    @endisset

    @isset($height)
    height="{{ $height }}" 
    @endisset

    @if(isset($class))
        class="{{$class}} lazyload"
        @else
        class="lazyload"
    @endisset

    @isset($title)
    title="{{ $title }}" 
    @endisset
    
    />