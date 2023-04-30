<?php
namespace Tannhatcms\AnimeAjax\Controllers;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;
//use Ophim\Core\Models\Actor;
use Ophim\Core\Models\Catalog;
//use Ophim\Core\Models\Category;
//use Ophim\Core\Models\Director;
//use Ophim\Core\Models\Episode;
use Ophim\Core\Models\Movie;
//use Ophim\Core\Models\Region;
//use Ophim\Core\Models\Tag;


use Illuminate\Support\Facades\Cache;

class AnimeAjaxController
{
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
    
    public function reportEpisode(Request $request)
    {
        $movie = Movie::fromCache()->find($request->movie ?: $request->movie_id);
        if (is_null($movie)) abort(404);
        $movie = $movie->load('episodes');
        $episode = $movie->episodes->when($request->id, function ($collection, $id) {
            return $collection->where('id', $id);
        })->firstWhere('slug', $request->episode);

        $episode->update([
            'report_message' => request('message', ''),
            'has_report' => true
        ]);

        return response()->json(['status' => 'success']);
    }

    public function rateMovie(Request $request)
    {
        $movie = Movie::fromCache()->find($request->movie ?: $request->id);
        $movie->refresh()->increment('rating_count', 1, [
            'rating_star' => $movie->rating_star +  ((int) request('rating') - $movie->rating_star) / ($movie->rating_count + 1)
        ]);

        return response()->json(['status' => 'success', 'rating_count' => $movie->rating_count, 'rating_star' => number_format($movie->rating_star ?? 0, 1) ]);
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