<ins class="adsbygoogle"
     @isset($ad_style)
     style="{!! $ad_style !!}"
     @endisset
     @sset($ad_client)
     data-ad-client="{!! $ad_client !!}"
     @endif
     @isset($ad_slot)
     data-ad-slot="{!! $ad_slot !!}"
     @endisset
     @isset($ad_format)
     data-ad-format="{!! $ad_format !!}"
     @endisset
     @isset($ad_full_width_responsive)
     data-full-width-responsive="{!! $ad_full_width_responsive !!}"
    @endisset
>
</ins>
<script>
    (adsbygoogle = window.adsbygoogle || []).push({});
</script>