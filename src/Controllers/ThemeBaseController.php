<?php

namespace Tannhatcms\Theme8anime\Controllers;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;
use Ophim\Core\Models\Actor;
use Ophim\Core\Models\Catalog;
use Ophim\Core\Models\Category;
use Ophim\Core\Models\Director;
use Ophim\Core\Models\Episode;
use Ophim\Core\Models\Movie;
use Ophim\Core\Models\Region;
use Ophim\Core\Models\Tag;

use Illuminate\Support\Facades\Cache;

class ThemeBaseController
{

    public function getMovieOverview(Request $request, $movie)
    {
        /** @var Movie */
        $movie = Movie::fromCache()->find($movie);

        if (is_null($movie)) abort(404);
      
        $movie->generateSeoTags();
        $preview = false;
        if ($request['preview']){
            $preview = true;
        }else{
            $movie->increment('view_total', 1);
            $movie->increment('view_day', 1);
            $movie->increment('view_week', 1);
            $movie->increment('view_month', 1);
            $movie->increment('view_year', 1);
        }
        $movie_related_cache_key = 'movie_related.' . $movie->id;
        $movie_related = Cache::get($movie_related_cache_key);
        if(is_null($movie_related)) {
            $movie_related = $movie->categories[0]->movies()->inRandomOrder()->limit(12)->get();
            Cache::put($movie_related_cache_key, $movie_related, setting('site_cache_ttl', 5 * 60));
        }
        return view('themes::theme8anime.single', [
            'currentMovie' => $movie,
            'title' => $movie->getTitle(),
            'movie_related' => $movie_related,
            'preview' => $preview,
            'is_index' => false 
        ]);
    }

    public function getEpisode(Request $request, $movie, $slug, $id)
    {
        $movie = Movie::fromCache()->find($movie);
        if (is_null($movie)) abort(404);
        $movie = $movie->load('episodes');
        if (is_null($movie)) abort(404);
        /** @var Episode */
        $episode = $movie->episodes->when($id, function ($collection, $id) {
            return $collection->where('id', $id);
        })->firstWhere('slug', $slug);

        if (is_null($episode)) abort(404);

        $episode->generateSeoTags();
        $preview = false;
        if ($request['preview']){
            $preview = true;
        }else{
            $movie->increment('view_total', 1);
            $movie->increment('view_day', 1);
            $movie->increment('view_week', 1);
            $movie->increment('view_month', 1);
            $movie->increment('view_year', 1);
        }
        $movie_related_cache_key = 'movie_related.' . $movie->id;
        $movie_related = Cache::get($movie_related_cache_key);
        if(is_null($movie_related)) {
            $movie_related = $movie->categories[0]->movies()->inRandomOrder()->limit(12)->get();
            Cache::put($movie_related_cache_key, $movie_related, setting('site_cache_ttl', 5 * 60));
        }

        return view('themes::theme8anime.episode', [
            'currentMovie' => $movie,
            'movie_related' => $movie_related,
            'episode' => $episode,
            'title' => $episode->getTitle(),
            'preview' => $preview,
            'is_index' => false
        ]);
    }

    public function reportEpisode(Request $request, $movie, $slug, $id)
    {
        $movie = Movie::fromCache()->find($movie)->load('episodes');

        $episode = $movie->episodes->when($id, function ($collection, $id) {
            return $collection->where('id', $id);
        })->firstWhere('slug', $slug);

        $episode->update([
            'report_message' => request('message', ''),
            'has_report' => true
        ]);

        return response()->json(['status' => 'success']);
    }

    public function rateMovie(Request $request, $movie)
    {

        $movie = Movie::fromCache()->find($movie);

        $movie->refresh()->increment('rating_count', 1, [
            'rating_star' => $movie->rating_star +  ((int) request('rating') - $movie->rating_star) / ($movie->rating_count + 1)
        ]);

        return response()->json(['status' => 'success', 'rating_count' => $movie->rating_count, 'rating_star' => number_format($movie->rating_star ?? 0, 1) ]);
    }

    public function getMovieOfCategory(Request $request, $slug)
    {
        /** @var Category */
        $category = Category::fromCache()->find($slug);

        if (is_null($category)) abort(404);

        $category->generateSeoTags();

        $movies = $category->movies()->orderBy('created_at', 'desc')->paginate(25);

        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'category' => $category,
            'title' => $category->seo_title ?: $category->getTitle(),
            'section_name' => "Phim thể loại $category->name",
            'is_index' => false
        ]);
    }

    public function getMovieOfRegion(Request $request, $slug)
    {
        /** @var Region */
        $region = Region::fromCache()->find($slug);

        if (is_null($region)) abort(404);

        $region->generateSeoTags();

        $movies = $region->movies()->orderBy('created_at', 'desc')->paginate(25);

        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'region' => $region,
            'title' => $region->seo_title ?: $region->getTitle(),
            'section_name' => "Phim quốc gia $region->name",
            'is_index' => false
        ]);
    }

    public function getMovieOfActor(Request $request, $slug)
    {
        /** @var Actor */
        $actor = Actor::fromCache()->find($slug);

        if (is_null($actor)) abort(404);

        $actor->generateSeoTags();

        $movies = $actor->movies()->orderBy('created_at', 'desc')->paginate(25);

        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'person' => $actor,
            'title' => $actor->getTitle(),
            'section_name' => "Diễn viên $actor->name",
            'is_index' => false
        ]);
    }

    public function getMovieOfDirector(Request $request, $slug)
    {
        /** @var Director */
        $director = Director::fromCache()->find($slug);

        if (is_null($director)) abort(404);

        $director->generateSeoTags();

        $movies = $director->movies()->orderBy('created_at', 'desc')->paginate(25);

        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'person' => $director,
            'title' => $director->getTitle(),
            'section_name' => "Đạo diễn $director->name",
            'is_index' => false
        ]);
    }

    public function getMovieOfTag(Request $request, $slug)
    {
        /** @var Tag */
        $tag = Tag::fromCache()->find($slug);

        if (is_null($tag)) abort(404);

        $tag->generateSeoTags();

        $movies = $tag->movies()->orderBy('created_at', 'desc')->paginate(25);
        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'tag' => $tag,
            'title' => $tag->getTitle(),
            'section_name' => "Tags: $tag->name",
            'is_index' => false
        ]);
    }

    public function getMovieOfType(Request $request, $slug)
    {
        /** @var Catalog */
        $catalog = Catalog::fromCache()->find($slug);

        if (is_null($catalog)) abort(404);

        $catalog->generateSeoTags();

        $cache_key = 'catalog.' . $catalog->id . '.page.' . $request['page'];
        $movies = Cache::get($cache_key);
        if(is_null($movies)) {
            $value = explode('|', trim($catalog->value));
            [$relation_config, $field, $val, $sortKey, $alg] = array_merge($value, ['', 'is_copyright', 0, 'created_at', 'desc']);
            $relation_config = explode(',', $relation_config);

            [$relation_table, $relation_field, $relation_val] = array_merge($relation_config, ['', '', '']);
            try {
                $movies = \Ophim\Core\Models\Movie::when($relation_table, function ($query) use ($relation_table, $relation_field, $relation_val, $field, $val) {
                    $query->whereHas($relation_table, function ($rel) use ($relation_field, $relation_val, $field, $val) {
                        $rel->where($relation_field, $relation_val)->where(array_combine(explode(",", $field), explode(",", $val)));
                    });
                })->when(!$relation_table, function ($query) use ($field, $val) {
                    $query->where(array_combine(explode(",", $field), explode(",", $val)));
                })
                ->orderBy($sortKey, $alg)
                ->paginate($catalog->paginate);

                Cache::put($cache_key, $movies, setting('site_cache_ttl', 5 * 60));
            } catch (\Exception $e) {}
        }

        return view('themes::theme8anime.catalog', [
            'data' => $movies,
            'section_name' => "Danh sách $catalog->name",
            'is_index' => false
        ]);
    }
}
