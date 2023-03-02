<section class="Wdgt">
    <div class="Title"><div class="View AAIco-remove_red_eye">&nbsp; &nbsp;{{ $item['label'] }}</div></div>
    <ul class="MovieList">
        @foreach ($item['data'] as $movie)
            <li>
                <div class="TPost A">
                    <a rel="bookmark" href="{{ $movie->getUrl() }}">
                        <span class="Top">#{{ $loop->index + 1 }}<i></i></span>
                        <div class="Image">
                            <figure class="Objf TpMvPlay AAIco-play_arrow">
                                @includeWhen(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.img',  [
                                    'width' => 55,
                                    'height' => 85,
                                    'class' => 'attachment-img-mov-sm size-img-mov-sm wp-post-image',
                                    'src' => $movie->poster_url ?: $movie->thumb_url,
                                    'alt' => $movie->name.' - '.$movie->origin_name,
                                    'title' => $movie->name.' - '.$movie->origin_name,
                                    'slug' => $movie->slug,
                                ])
                                @includeUnless(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.picture',  [
                                    'width' => 55,
                                    'height' => 85,
                                    'class' => 'attachment-img-mov-sm size-img-mov-sm wp-post-image',
                                    'src' => $movie->poster_url ?: $movie->thumb_url,
                                    'alt' => $movie->name.' - '.$movie->origin_name,
                                    'title' => $movie->name.' - '.$movie->origin_name,
                                    'slug' => $movie->slug,
                                ])    
                            </figure>
                        </div>
                        <div class="Title">{{ $movie->name }}</div>
                    </a>
                    <p class="Info">
                        <span class="Vote AAIco-star">{{ number_format($movie->rating_star ?? 0, 1) }}</span>
                        <span class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
                        <span class="View AAIco-remove_red_eye">{{ $movie->view_total }}</span>
                        <br />
                        <span class="Qlty">{{ $movie->quality }} - {{ $movie->language }}</span>
                    </p>
                </div>
            </li>
        @endforeach
    </ul>
</section>
