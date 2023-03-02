@if (count($recommendations))
    <div class="MovieListTopCn">
        <div class="MovieListTop owl-carousel">
            @foreach ($recommendations ?? [] as $movie)
                <li class="TPostMv">
                    <article id="post-{{ $movie->id }}"
                        class="TPost C post-{{ $movie->id }} post type-post status-publish format-standard has-post-thumbnail hentry">
                        <a href="{{ $movie->getUrl() }}">
                            <div class="Image">
                                <figure class="Objf TpMvPlay AAIco-play_arrow">
                                    @includeWhen(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.img',  [
                                            'width' => 215,
                                            'height' => 320,
                                            'src' => $movie->thumb_url,
                                            'alt' => $movie->name.' - '.$movie->origin_name. ' ('.$movie->publish_year.')',
                                            'class' => 'attachment-thumbnail size-thumbnail wp-post-image',
                                            'title' => $movie->name.' - '.$movie->origin_name. ' ('.$movie->publish_year.')',
                                    ])
                                    @includeUnless(filter_var($movie->thumb_url, FILTER_VALIDATE_URL) ,'themes::theme8anime.inc.html.picture',  [
                                            'width' => 215,
                                            'height' => 320,
                                            'src' => $movie->thumb_url,
                                            'alt' => $movie->name.' - '.$movie->origin_name. ' ('.$movie->publish_year.')',
                                            'class' => 'attachment-thumbnail size-thumbnail wp-post-image',
                                            'title' => $movie->name.' - '.$movie->origin_name. ' ('.$movie->publish_year.')',
                                            'slug' => $movie->slug,
                                    ])
                                </figure>
                                <div class="item-badge">
                                    @if($movie->status !='trailer') 
                                        <span class="item-badge-episode">{{ str_replace(array("Hoàn Tất", "(", ")"), array("Tập" , "", ""), $movie->episode_current) }}</span>
                                    @endif
                                    @if($movie->status =='completed')         
                                        <span class="item-badge-status">Hoàn Tất</span>
                                    @elseif($movie->status =='trailer')         
                                        <span class="item-badge-status">Sắp Chiếu</span>
                                    @endif
                                </div>
                            </div>
                            <h2 class="Title">{{ $movie->name }}</h2> <span class="Year">{{ $movie->origin_name }}
                                ({{ $movie->publish_year }})
                            </span>
                        </a>
                    </article>
                </li>
            @endforeach
        </div>
    </div>
@endif
