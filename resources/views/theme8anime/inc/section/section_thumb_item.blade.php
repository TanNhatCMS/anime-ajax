<li class="TPostMv">
    <article id="post-{{ $movie->id }}"
        class="TPost C post-{{ $movie->id }} post type-post status-publish format-standard has-post-thumbnail hentry">
        <a href="{{ $movie->getUrl() }}" class="item-summary">
             
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
            <h4>{{ $movie->origin_name }}</h4>
            <h3>{{ $movie->name }}</h3>
        </a>
        <div class="TPMvCn anmt">
            <div class="Title">{{ $movie->name }}</div>
            <p class="Info">
                <span class="Vote AAIco-star">{{ number_format($movie->rating_star ?? 0, 1) }}</span>
                <span class="Time AAIco-access_time">{{ $movie->episode_time }}</span>
                <span class="Date AAIco-date_range">{{ $movie->publish_year }}</span>
            </p>
            <div class="Description">
                <p>{!! mb_substr(strip_tags($movie->content), 0, 142, 'utf-8') !!}...</p>
                <p class="Director AAIco-videocam">
                    <span>Đạo diễn:</span>
                    {{ count($movie->directors) ? $movie->directors->first()['name'] : 'N/A' }}
                </p>
                <p class="Genre AAIco-movie_creation">
                    <span>Thể loại:</span>
                    {!! count($movie->categories)
                        ? '<a href="' .
                            $movie->categories->first()->getUrl() .
                            '" title="' .
                            $movie->categories->first()['name'] .
                            '">' .
                            $movie->categories->first()['name'] .
                            '</a>'
                        : 'N/A' !!}
                </p>
                <p class="Actors AAIco-person">
                    <span>Diễn viên:</span>
                    {{ count($movie->actors) ? $movie->actors->first()['name'] : 'N/A' }} <i
                        class="Button STPa AAIco-more_horiz"></i>
                </p>
            </div>
        </div>
    </article>
</li>
