<div class="row movie-update">
    <div class="col-right">
        <div id="tabs-movie">
            <ul class="tabs-movie-block">
                @foreach ($movie_update_right as $key => $item)
                    <li class="tab-movie"><a href="#tabs-{{ $key }}" rel="nofollow"
                            title="{{ $item['label'] }}">{{ $item['label'] }}</a>
                    </li>
                @endforeach
            </ul>
            @foreach ($movie_update_right as $key => $item)
                <div class="clear"></div>
                <h2 class="hidden">{{ $item['label'] }}</h2>
                <ul class="tab-content" id="tabs-{{ $key }}">
                    @foreach ($item['data'] as $movie)
                        <li class="movie">
                            <a class="movie-link" title="{{ $movie['name'] }}" href="{{ $movie->getUrl() }}">
                                <div class="thumbn"
                                    style="background-image: url('{{ $movie['thumb_url'] }}');">
                                </div>
                                <div class="meta"><span class="name-vn link">{{ $movie['name'] }}</span>
                                    <span class="name-en">{{ $movie['origin_name'] }}</span></div>
                            </a>
                            <div class="eps">
                                {{ $movie['episode_current']}}
                            </div>
                            <div class="clear"></div>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </div>
    </div>
</div>
