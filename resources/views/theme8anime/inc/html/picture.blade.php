  @php
  if(isset($width) && isset($height)){
    $thumbnail_url = get_theme_option('home_url').thumbnail_url($src, $slug, $width, $height);
  }else{
    $thumbnail_url = get_theme_option('home_url').thumbnail_url($src, $slug, 0, 0);
  }

  @endphp
  <picture>
        <!--[if IE 9]><video style="display: none;><![endif]-->
            <source data-srcset="{{$thumbnail_url}}.webp" type="image/webp">
        <!--[if IE 9]></video><![endif]-->
       <img 
        src="{{ get_theme_option('home_url') }}/themes/8anime/images/share-icons.gif" 
        data-src="{{$thumbnail_url}}.png" 
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
    </picture>