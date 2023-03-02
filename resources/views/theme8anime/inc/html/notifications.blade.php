@php
$notifications = Cache::remember('site.tannhatcms.notifications', setting('site_cache_ttl', 5 * 60), function () {
    $mod_notifications =  json_decode(setting('tannhatcms.notifications', ''), true);
    return preg_split('/[\n\r]+/', $mod_notifications["mod_notifications"]);
});
@endphp

     

<style>
.container{clear:both;margin:auto;overflow:hidden;position:relative}
.slider-wrapper{margin-top:20px}
.slider-container .slider-single{height:100%;width:100%}
.slider-container{overflow:hidden;position:relative}
</style>
<div class="container">
    <div class="slider-wrapper">
        <div class="slider-container">
                @foreach ($notifications as $notification)
                        {!! $notification !!}
                @endforeach
        </div>
    </div>
</div>

