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
use Tannhatcms\Theme8anime\Controllers\ThemeBaseController;

use Illuminate\Support\Facades\Cache;

class Theme8animeController extends ThemeBaseController
{
    public function index(Request $request)
    {
        if ($request['search'] || $request['filter']) {
            $data = Movie::when(!empty($request['filter']['category']), function ($movie) {
                $movie->whereHas('categories', function ($categories) {
                    $categories->where('id', request('filter')['category']);
                });
            })->when(!empty($request['filter']['region']), function ($movie) {
                $movie->whereHas('regions', function ($regions) {
                    $regions->where('id', request('filter')['region']);
                });
            })->when(!empty($request['filter']['year']), function ($movie) {
                $movie->where('publish_year', request('filter')['year']);
            })->when(!empty($request['filter']['type']), function ($movie) {
                $movie->where('type', request('filter')['type']);
            })->when(!empty($request['search']), function ($query) {
                $query->where(function ($query) {
                    $key = request('search');
                    
                     $keys   = vn_to_str($key);
                     $keys   = str_replace('+', '-', $keys  );
                    $query->where('name', 'like', '%' . $key . '%')
                        ->orWhere('origin_name', 'like', '%' . $key  . '%')->orWhere('slug', 'like', '%' . $keys   . '%')->orWhere('content', 'like', '%' . $key . '%');
                });
            })->when(!empty($request['filter']['sort']), function ($movie) {
                if (request('filter')['sort'] == 'create') {
                    return $movie->orderBy('created_at', 'desc');
                }
                if (request('filter')['sort'] == 'update') {
                    return $movie->orderBy('updated_at', 'desc');
                }
                if (request('filter')['sort'] == 'year') {
                    return $movie->orderBy('publish_year', 'desc');
                }
                if (request('filter')['sort'] == 'view') {
                    return $movie->orderBy('view_total', 'desc');
                }
            })->paginate(25);

            return view('themes::theme8anime.catalog', [
                'data' => $data,
                'search' => $request['search'],
                'section_name' => "Tìm kiếm phim: $request->search",
                'is_index' => false
            ]);
        }
        $trending_this_week = Cache::get('trending_this_week');
        if(is_null($trending_this_week)) {
            $trending_this_week = Movie::orderBy('view_week', 'desc')->limit(1)->get()->first();
            Cache::put('trending_this_week', $trending_this_week, setting('site_cache_ttl', 5 * 60));
        }
        return view('themes::theme8anime.index', [
            'title' => Setting::get('site_homepage_title'),
            'is_index' => true,
            'trending_this_week' => $trending_this_week
        ]);
    }

    public function search(Request $request)
    {
        if ($request['keyword'] || $request['filter']) {
            $data = Movie::when(!empty($request['filter']['category']), function ($movie) {
                $movie->whereHas('categories', function ($categories) {
                    $categories->where('id', request('filter')['category']);
                });
            })->when(!empty($request['filter']['region']), function ($movie) {
                $movie->whereHas('regions', function ($regions) {
                    $regions->where('id', request('filter')['region']);
                });
            })->when(!empty($request['filter']['year']), function ($movie) {
                $movie->where('publish_year', request('filter')['year']);
            })->when(!empty($request['filter']['type']), function ($movie) {
                $movie->where('type', request('filter')['type']);
            })->when(!empty($request['keyword']), function ($query) {
                $query->where(function ($query) {
                    $key = request('keyword');
                    
                     $keys   = vn_to_str($key);
                     $keys   = str_replace('+', '-', $keys  );
                    $query->where('name', 'like', '%' . $key . '%')
                        ->orWhere('origin_name', 'like', '%' . $key  . '%')->orWhere('slug', 'like', '%' . $keys   . '%')->orWhere('content', 'like', '%' . $key . '%');
                });
            })->when(!empty($request['filter']['sort']), function ($movie) {
                if (request('filter')['sort'] == 'create') {
                    return $movie->orderBy('created_at', 'desc');
                }
                if (request('filter')['sort'] == 'update') {
                    return $movie->orderBy('updated_at', 'desc');
                }
                if (request('filter')['sort'] == 'year') {
                    return $movie->orderBy('publish_year', 'desc');
                }
                if (request('filter')['sort'] == 'view') {
                    return $movie->orderBy('view_total', 'desc');
                }
            })->paginate(25);

            return view('themes::theme8anime.catalog', [
                'data' => $data,
                'search' => $request['keyword'],
                'section_name' => "Tìm kiếm phim: $request->search",
                'is_index' => false
            ]);
        }
        $trending_this_week = Cache::get('trending_this_week');
        if(is_null($trending_this_week)) {
            $trending_this_week = Movie::orderBy('view_week', 'desc')->limit(1)->get()->first();
            Cache::put('trending_this_week', $trending_this_week, setting('site_cache_ttl', 5 * 60));
        }
        return view('themes::theme8anime.index', [
            'title' => Setting::get('site_homepage_title'),
            'is_index' => true,
            'trending_this_week' => $trending_this_week
        ]);
    }
    public function ajax_search(Request $request)
        {
            if ($request['query'] ) {
            $data = Movie::when(!empty($request['query']), function ($query) {
                $query->where(function ($query) {
                            $x = str_replace(' ', '+', request('query'));
                            $x = str_replace('-', '+', $x);
                            $keys = explode('+', (string) $x);
                            foreach ($keys as $key) {
                                $query->where('name', 'like', '%' .$key . '%')
                                ->orWhere('origin_name', 'like', '%' .$key  . '%')->orWhere('slug', 'like', '%' . $key  . '%');
                            }
                });
            })->paginate(5);
            $output = '';
            foreach ($data as $movie) {
                $output .= '<a href="'.$movie->getUrl().'" class="nav-item">
                    <div class="film-poster">
                        <img data-src="'.$movie->thumb_url.'" class="film-poster-img lazyloaded" alt="'.$movie->name.'" src="'.$movie->thumb_url.'">
                    </div>
                    <div class="srp-detail">
                        <h3 class="film-name" data-jname="'.$movie->name.'">'.$movie->name.'</h3>
                        <div class="alias-name">'.$movie->origin_name.'</div>
                        <div class="film-infor">
                            <span>'.$movie->publish_year.'</span>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </a>';
            }
            $output .= '<a href="/search?keyword='.$request['query'].'" class="nav-item nav-bottom">
              Xem tất cả kết quả <i class="fa fa-angle-right ml-2"></i>
            </a>';
            return Response($output);
        }
    }
    public function home(Request $request)
    {
        
        $trending_this_week = Cache::get('trending_this_week');
        if(is_null($trending_this_week)) {
            $trending_this_week = Movie::orderBy('view_week', 'desc')->limit(1)->get()->first();
            Cache::put('trending_this_week', $trending_this_week, setting('site_cache_ttl', 5 * 60));
        }
        return view('themes::theme8anime.home', [
            'title' => Setting::get('site_homepage_title'),
            'is_index' => true,
            'trending_this_week' => $trending_this_week
        ]);
    }
    /*
    public function ajax_details(Request $request)
    { 
        $output = '';
        if(isset($request['animeid'])){
            return;
        }
        $row = Movie::where('id',$request['animeid'])->get();
        / Type
     if(empty($row['type'])){
        $type = 'N/A';
     }else{
        $type = str_replace("Anime","",$row['type']);
    } 

 // Description
    if(empty($row['description'])){
        $description = 'N/A';
     }else{
        $description = $row['description'];
    } 


    $output .='<div class="qtip-default qtip-pos-tl qtip-fixed qtip-pos-bl qtip-focus qtip-hover">
    <div class="qtip-tip" style="display: none;"><canvas></canvas></div>
    <div class="qtip-content" aria-atomic="true">
        <div class="pre-qtip-content">
    <div class="pre-qtip-title">'.$row["title"].'</div>
    <div class="pre-qtip-detail">
        <span class="pqd-li mr-3"><i class="fas fa-eye mr-1 text-warning"></i> '.$row["views"].'</span>
         <span class="pqd-li"><i class="fas fa-clock mr-1 text-warning"></i> '.$row["runtime"].'</span>   
        <span class="pqd-li badge badge-quality float-right ml-2">'.$type.'</span>
        <div class="clearfix"></div>
    </div>
    <div class="pre-qtip-description">'. mb_substr($description, 0, 50, "utf8")."...".'</div>
        <div class="pre-qtip-line">
        <span class="stick-text">'. mb_substr($row["othername"], 0, 50, "utf8")."...".'</span>
        </div>
    <div class="pre-qtip-line"> <span class="stick-text">'.$row["release"].'</span>
    </div>
    <div class="pre-qtip-line">
    <span class="stick-text">'.$row["status"].'</span></div>
    
</div>
</div></div>
';
        return Response($output);
    }
/*
$this->data['top_view_total'] = Movie::orderBy('view_total', 'desc')->limit(15)->get();
        $this->data['top_view_year'] = Movie::orderBy('view_year', 'desc')->limit(15)->get();
        $this->data['top_view_day'] = Movie::orderBy('view_day', 'desc')->limit(15)->get();
        $this->data['top_view_week'] = Movie::orderBy('view_week', 'desc')->limit(15)->get();
        $this->data['top_view_month'] = Movie::orderBy('view_month', 'desc')->limit(15)->get();
*/
}