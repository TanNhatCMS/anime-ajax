<section class="Wdgt" id="showChonLoc">
    <div class="Title">
        <div class="Lnk fa-film">&nbsp; &nbsp;{{ $item['label'] }}</div>
    </div>
    <ul class="MovieList block-movie">
        @foreach ($item['data'] as $movie)
        <li>
            <a title="{{ $movie->name }} - {{ $movie->origin_name }}" href="{{ $movie->getUrl() }}">
                @includeWhen(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.img',  [
                    'src' => $movie->poster_url ?: $movie->thumb_url,
                    'alt' => $movie->name.' - '.$movie->origin_name,
                    'title' => $movie->name.' - '.$movie->origin_name,
                ])
                @includeUnless(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.picture',  [
                    'src' => $movie->poster_url ?: $movie->thumb_url,
                    'alt' => $movie->name.' - '.$movie->origin_name,
                    'title' => $movie->name.' - '.$movie->origin_name,
                    'slug' => $movie->slug,
                ])
                <span>
                    <h3>{{ $movie->name }}</h3>
                    <h4>{{ $movie->origin_name }} ({{ $movie->publish_year }})</h4>
                </span>
            </a>
        </li>
        @endforeach
    </ul>
</section>
