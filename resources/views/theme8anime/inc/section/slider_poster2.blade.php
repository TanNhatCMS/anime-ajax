<div class="MovieListSldCn">
    <div class="MovieListSld owl-carousel">
        @foreach ($item['data'] as $movie)
            <div class="TPostMv">
                <div class="TPost D">
                    <a href="{{$movie->getUrl()}}">
                        <div class="Image">
                            <figure class="Objf">
                                @includeWhen(filter_var($movie->poster_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.img',  [
                                    'src' => $movie->poster_url,
                                    'alt' => $movie->name,
                                    'class' => 'TPostBg',
                                    'title' => $movie->name,
                                    'title' => $movie->name.' - '.$movie->origin_name. ' ('.$movie->publish_year.')',
                                ])
                                @includeUnless(filter_var($movie->poster_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.picture',  [
                                    'src' => $movie->poster_url,
                                    'alt' => $movie->name,
                                    'class' => 'TPostBg',
                                    'title' => $movie->name,
                                    'slug' => $movie->slug,
                                ])
                                <div class="Title">{{$movie->name}}</div>
                            </figure>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
