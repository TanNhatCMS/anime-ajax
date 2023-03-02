<aside class="widget-area" role="complementary">
    {{-- <div class="Dvr-300">
    </div> --}}
    @if(get_theme_option('home_comment_facebook'))
        <div class="Wdgt" id="comments">
            <div class="Title">Hỏi/đáp Anime</div>
            <div class="Comment Wrt" id="respond">
                <div style="width: 100%; background-color: #fff" class="fb-comments fb_iframe_widget" data-lazy="true" data-href="{{get_theme_option('home_url')}}" data-numposts="3" data-width="100%" data-colorscheme="light" data-order-by="reverse_time"></div>
            </div>
        </div>
    @endif
    @if($tops)
        @foreach ($tops as $item)
            @include('themes::theme8anime.inc.aside.' . $item['template'])
        @endforeach
    @endif
    @if($movie_update_right)
        @include('themes::theme8anime.inc.aside.top_col_movies_right')
    @endif
   
    {{-- <div class="Dvr-300">
    </div> --}}
    <div class="tag-list-main"></div>
</aside>
