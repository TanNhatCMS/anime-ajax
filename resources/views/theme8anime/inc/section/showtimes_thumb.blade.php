@if(count($item['data']))
<section>
    <div class="Top mx-auto px-md-4 p-1 text-white text-center"  >
        <h1 style="width: 400px;">
            {{ $item['label'] }} 
        </h1>
    </div>
    <ul class="MovieList Rows AX A06 B04 C03 E20">
        @foreach ($item['data'] as $movie)
            @include('themes::theme8anime.inc.section.showtimes_thumb_item')
        @endforeach
    </ul>
</section>
@endif
