<footer class="Footer">
    <div class="Container">
        @if(get_theme_option('ads_footer'))
            {!! get_theme_option('ads_footer') !!}
        @endif
        {!! get_theme_option('footer') !!}
    </div>
</footer>
