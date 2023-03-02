@extends('themes::layout8')
@php
    $menu = \Ophim\Core\Models\Menu::getTree();
    $logo = get_theme_option('logo_url');
    $title = isset($title) ? $title : setting('site_homepage_title', '');

@endphp
@push('header')
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" type="text/css">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com/">
    <link href="{{ asset('/themes/8anime/css/base.css') }}?v={{ config('theme8anime.version') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('/themes/8anime/css/m.min.css') }}?v={{ config('theme8anime.version') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript">
	setTimeout(function(){
        var wpse326013 = document.createElement('link');
        wpse326013.rel = 'stylesheet';
        wpse326013.href = 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css';
        wpse326013.type = 'text/css';
        var godefer = document.getElementsByTagName('link')[0];
        godefer.parentNode.insertBefore(wpse326013, godefer);
        var wpse326013_2 = document.createElement('link');
        wpse326013_2.rel = 'stylesheet';
        wpse326013_2.href = 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css';
        wpse326013_2.type = 'text/css';
        var godefer2 = document.getElementsByTagName('link')[0];
        godefer2.parentNode.insertBefore(wpse326013_2, godefer2);
    }, 500);
    </script>
    <noscript>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" />
</noscript>
@endpush

@push('body_attributes')
data-page="page_home"
@endpush
@section('body')
@if( get_theme_option('PreloadControl')== 1)
<div id="sixanime"></div>
@endif
@include('themes::theme8anime.inc.menu')               
<div id="header" class="header-home ">
    <div class="container">
        <div id="mobile_menu">
            <i class="fa fa-bars"></i>
        </div>
        <a href="/" id="logo" title="{{ $title }}">
            @if ($logo)
                <img src="{{ $logo }}" width="100%" height="auto" alt="{{ $title }}">
            @endif
            <div class="clearfix"></div>
        </a>
        <div id="search">
            <div class="search-content">
                <form action="/search" autocomplete="off">
                    <a href="/filter" class="filter-icon">Filter</a>
                    <input type="text" class="form-control search-input" name="keyword" id="searching" placeholder="Search anime..." required>
                    <button type="submit" class="search-icon"><i class="fas fa-search"></i></button>
                </form>
                <div class="nav search-result-pop" id="search-suggest" style="display: none;">
                    <div class="loading-relative" id="search-loading" style="display: none;">
                        <div class="loading">
                            <div class="span1"></div>
                            <div class="span2"></div>
                            <div class="span3"></div>
                        </div>
                    </div>
                    <div class="result" style="display:none;"></div>
                </div>
            </div>
        </div>
        @include('themes::theme8anime.inc.headergroup')
        <div class="clearfix"></div>
    </div>
</div>

<div class="header-setting">
    @include('themes::theme8anime.inc.view_header')
    <div class="clearfix"></div>
</div>
    <div id="anime-trending">
        <div class="container">
            <section class="block_area block_area_trending">
                    <div class="block_area-header">
                        <div class="bah-heading">
                            <h2 class="cat-heading">Trending</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="block_area-content">
                        <div class="trending-list" id="trending-home">
                            <div class="swiper-container swiper-container-initialized swiper-container-horizontal">
                                <div class="swiper-wrapper">			
                                    @include('themes::theme8anime.inc.view_trending')					                                    
                                </div>
                                <div class="clearfix"></div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
                            <div class="trending-navi">
                                <div class="navi-next swiper-button-disabled" tabindex="-1" role="button" aria-label="Next slide" aria-disabled="true"><i class="fas fa-angle-right"></i></div>
                                <div class="navi-prev swiper-button-disabled" tabindex="-1" role="button" aria-label="Previous slide" aria-disabled="true"><i class="fas fa-angle-left"></i></div>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    
            <div id="footer" data-settings="{&quot;auto_play&quot;:1,&quot;auto_next&quot;:1,&quot;auto_load_comments&quot;:0,&quot;enable_dub&quot;:0,&quot;anime_name&quot;:&quot;jp&quot;,&quot;play_original_audio&quot;:0}">
                <div id="footer-about">
                    <div class="container">
                        <div class="footer-top">
                            <a href="/" title="{{ $title }}" rel="home" class="footer-logo">
                                @if ($logo)
                                    <img src="{{ $logo }}" alt="{{ $title }}">
                                @endif
                                <div class="clearfix"></div>
                            </a>
        @include('themes::theme8anime.inc.view_footer')
        {!! get_theme_option('footer') !!}
                        <div class="about-text">
                            {{ $title }}
                             không lưu trữ bất kỳ tệp nào trên máy chủ của chúng tôi, chúng tôi chỉ chia sẻ liên kết tới phương tiện được lưu trữ trên các dịch vụ của bên thứ ba.</div>
                        <p class="copyright">Copyright ©
                            {!! date("Y")  !!} {{ $title }}
                             . All Rights Reserved</p>
                    </div>
                </div>
            </div>        
            <div id="mask-overlay"></div>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/app.min.js') }}?v=0.0000002"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/common.js') }}"></script>
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/movie.js') }}?v=0.0000001"></script>
            <link rel="stylesheet" href="{{ asset('/themes/8anime/css/jquery-ui.css') }}">
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
            <script type="text/javascript" src="{{ asset('/themes/8anime/js/function.js') }}?v=0.0000001"></script>
            <div style="display:none;">
    </div>
    </div>                
@endsection

       
<?php include('../view/view.boxes.php'); ?>
		        <div id="main-wrapper" >
		            <div class="container">
				<div id="main-content">
                    <section class="block_area block_area-promotions">
                        <div class="block_area-header">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">Latest Episodes</h2>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="block_area-content block_area-promotions-list">
                            <div class="screen-items">
                                <?php            
                                                   // Get All Slider Data
                                                   $stmt = "SELECT * FROM `episodes` ORDER BY id DESC LIMIT 10";
                                                            $sth = $conn->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                                            $sth->execute();
                                                            $data = $sth->fetchAll();

                                                    foreach($data as $animeslider):   
                                                        $id = $animeslider['anime_id'];

                                                    // Get Slider Data info   
                                                    $stmt = "SELECT * FROM `info` WHERE slug = '$id'";
                                                            $sth = $conn->prepare($stmt, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                                                            $sth->execute();
                                                            $anime = $sth->fetch(); 


                                      ?>
                                    <div class="item">
                                        <a class="screen-item-thumbnail" href="/watch/<?php echo $animeslider['anime_id'] ?>-episode-<?php echo $animeslider['episode'] ?>" title="<?php echo $animeslider['title'] ?>">
                                            <span class="icon-play"><i class="fas fa-play"></i></span>
                                            <img src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/uploads/episodes/<?php echo $anime['slug'] ?>/<?php echo str_replace(' ', '%20', $animeslider['image']); ?>"
                                                 class="sit-img">
                                            <div class="tick ml-1 mb-1">
                                                <div class="tick-item-eps">
                                                    <span class="badge badge-primary color-white">
                                            <?php
                                                        if( strpos($anime['type'], 'Movie' ) !== false ){
                                                                 echo "MOVIE";
                                                                    }else if( strpos($anime['type'], 'OVA' ) !== false ){
                                                                 echo "OVA";
                                                                 }else if( strpos($anime['type'], 'ONA' ) !== false ){
                                                                 echo "ONA";
                                                                 }else if( strpos($anime['type'], 'Special' ) !== false ){
                                                                 echo "SPECIAL";
                                                                 }else{
                                                                 echo "TV SERIES";
                                                                 }  
                                            ?>
                                                    </span>
                                                    <span class="badge badge-danger color-white">
                                                        <?php
                                                        if( strpos($anime['title'], '(D' ) !== false ){
                                                                 echo 'DUB';
                                                                    }else{
                                                                        echo 'SUB';
                                                                 } 
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>     
                                        </a>
                                        <div class="screen-item-info">
                                            <small style="text-overflow: ellipsis; overflow: hidden; white-space: nowrap;"><?php
                                                        if( strpos($anime['type'], 'Movie' ) !== false ){
                                                                 echo "The Movie";
                                                                    }else if( strpos($anime['type'], 'OVA' ) !== false ){
                                                                 echo "Episode ".$animeslider['episode'];
                                                                 }else if( strpos($anime['type'], 'ONA' ) !== false ){
                                                                 echo "Episode ".$animeslider['episode'];
                                                                 }else if( strpos($anime['type'], 'Special' ) !== false ){
                                                                 echo "Episode ".$animeslider['episode'];
                                                                 }else{
                                                                 echo "Episode ".$animeslider['episode'];
                                                                 }  
                                            ?> <span class="dot"></span> <?php echo $anime['runtime'] ?></small>
                                            <h3 class="sii-title text-left"><?php echo $animeslider['title'] ?></h3>
                                            <small><?php echo mb_substr($anime['title'], 0, 30, "utf8"); ?></small>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                <?php endforeach; ?>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>

                    <section class="block_area block_area_home">
                        <div class="block_area-header">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">Latest Subbed</h2>
                            </div>
                            <div class="float-right viewmore">
							<a class="btn" href="/latest-subbed">View more<i class="fas fa-angle-right ml-2"></i></a>
							</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="block_area-content block_area-list film_list film_list-grid">
                                <div class="film_list-wrap">
						<?php 
								$stmt = $conn->query("SELECT * FROM info WHERE title NOT LIKE '%(Dub)%' ORDER By ep_update_date DESC LIMIT 12");
								while($row = $stmt->fetch()):
								   							
						?>
								                                    <div class="flw-item">
                                        <div class="film-poster">
											 <div class="tick ltr">
                                                <div class="tick-item-<?php
											if( strpos($row['title'], '(D' ) !== false ){
													 echo 'dub';
														}else{
															echo 'sub';
													 } 
											?>  tick-eps amp-algn"><?php
											if( strpos($row['title'], '(D' ) !== false ){
													 echo 'DUB';
														}else{
															echo 'SUB';
													 } 
											?></div>
											</div>
                                            <div class="tick rtl">
                                                <div class="tick-item tick-eps amp-algn">
                                                    EP <?php echo $row['total_episode']; ?><?php
                                                        if( strpos($row['status'], 'Completed' ) !== false ){
                                                                 echo "/".$row['total_episode'];
                                                                    }else{
                                                                        echo "";
                                                                 } 
                                                        ?>
                                                </div>
                                            </div>
                                            <img class="film-poster-img lazyload" data-src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/uploads/images/<?php echo $row['slug'] ?>/<?php echo str_replace(' ', '%20', $row['image']); ?>" src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/theme/6anime/assets/images/no_poster.jpg" alt="<?php if(empty($row['title'])){
											 echo 'N/A';
											}else{
												echo $row['title'];
												} ?>">
                                            <a class="film-poster-ahref tooltipEl" animeid="<?php echo $row['id'] ?>" href="/anime/<?php echo $row['slug'] ?>" title="<?php echo $row['title'] ?>" data-jname="<?php if(empty($row['title'])){
                                             echo 'N/A';
                                            }else{
                                                echo $row['title'];
                                                } ?>"><i class="fas fa-play"></i></a>
                                        </div>
                                        <div class="film-detail">
                                            <h3 class="film-name">
                                            <a class="dynamic-name tooltipEl" animeid="<?php echo $row['id'] ?>" href="/anime/<?php echo $row['slug'] ?>" title="<?php echo $row['title'] ?>" data-jname="<?php echo $row['title'] ?>"></a>
											</h3>
                                           <div class="fd-infor">
													<span class="fdi-item"><?php if(empty($row['type'])){
											 echo 'N/A';
											}else{
												echo str_replace("Anime","",$row['type']);
												} ?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item"><?php echo $row['status'] ?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item"><?php if(empty($row['release'])){
							 echo 'N/A';
							}else{
								echo $row['release'];
								} ?></span>
													</div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
<?php endwhile; ?>

								                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>
					<section class="block_area block_area_home">
                        <div class="block_area-header">
                            <div class="float-left bah-heading mr-4">
                                <h2 class="cat-heading">Latest Dubbed</h2>
                            </div>
                            <div class="float-right viewmore">
							<a class="btn" href="/latest-dubbed">View more<i class="fas fa-angle-right ml-2"></i></a>
							</div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="tab-content">
                            <div class="block_area-content block_area-list film_list film_list-grid">
                                <div class="film_list-wrap">
						<?php 
								$stmt = $conn->query("SELECT * FROM info WHERE title LIKE '%(Dub)%' ORDER By ep_update_date DESC LIMIT 12");
								while($row = $stmt->fetch()):
								   							
						?>
								                                    <div class="flw-item">
                                        <div class="film-poster">
											 <div class="tick ltr">
                                                <div class="tick-item-<?php
											if( strpos($row['title'], '(D' ) !== false ){
													 echo 'dub';
														}else{
															echo 'sub';
													 } 
											?>  tick-eps amp-algn"><?php
											if( strpos($row['title'], '(D' ) !== false ){
													 echo 'DUB';
														}else{
															echo 'SUB';
													 } 
											?></div>
											</div>
                                            <div class="tick rtl">
                                                <div class="tick-item tick-eps amp-algn">
                                                    EP <?php echo $row['total_episode']; ?><?php
                                                        if( strpos($row['status'], 'Completed' ) !== false ){
                                                                 echo "/".$row['total_episode'];
                                                                    }else{
                                                                        echo "";
                                                                 } 
                                                        ?>
                                                </div>
                                            </div>
                                            <img class="film-poster-img lazyload" data-src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/uploads/images/<?php echo $row['slug'] ?>/<?php echo str_replace(' ', '%20', $row['image']); ?>" src="<?php echo 'http://'.$_SERVER['HTTP_HOST']; ?>/theme/6anime/assets/images/no_poster.jpg" alt="<?php if(empty($row['title'])){
											 echo 'N/A';
											}else{
												echo $row['title'];
												} ?>">
                                            <a class="film-poster-ahref tooltipEl" animeid="<?php echo $row['id'] ?>" href="/anime/<?php echo $row['slug'] ?>" title="<?php echo $row['title'] ?>" data-jname="<?php if(empty($row['title'])){
                                             echo 'N/A';
                                            }else{
                                                echo $row['title'];
                                                } ?>"><i class="fas fa-play"></i></a>
                                        </div>
                                        <div class="film-detail">
                                            <h3 class="film-name">
                                            <a class="dynamic-name tooltipEl" animeid="<?php echo $row['id'] ?>" href="/anime/<?php echo $row['slug'] ?>" title="<?php echo $row['title'] ?>" data-jname="<?php echo $row['title'] ?>"></a>
											</h3>
                                           <div class="fd-infor">
													<span class="fdi-item"><?php if(empty($row['type'])){
											 echo 'N/A';
											}else{
												echo str_replace("Anime","",$row['type']);
												} ?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item"><?php echo $row['status'] ?></span>
                                                    <span class="dot"></span>
                                                    <span class="fdi-item"><?php if(empty($row['release'])){
							 echo 'N/A';
							}else{
								echo $row['release'];
								} ?></span>
													</div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
<?php endwhile; ?>

								                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </section>

                    <div class="clearfix"></div>
                </div>
               
		<div id="main-sidebar">
		<?php include('../view/view.genre.php'); ?>
		                    <section class="block_area block_area_sidebar block_area-realtime">
                        <div class="block_area-header">
                            <div class="float-left bah-heading mr-2">
                                <h2 class="cat-heading">Most Viewed</h2>
                            </div>
                            <div class="float-right bah-tab-min">
                                <ul class="nav nav-pills nav-fill nav-tabs anw-tabs">
                                    <li class="nav-item"><a data-toggle="tab" href="#today" class="nav-link active">Today</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#week" class="nav-link">Week</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#month" class="nav-link">Month</a></li>
                                    <li class="nav-item"><a data-toggle="tab" href="#alltime" class="nav-link">All</a></li>
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                        </div>
					
                        <div class="block_area-content">
                            <div class="cbox cbox-list cbox-realtime">
                                <div class="cbox-content">
                                    <div class="tab-content">
<?php include('../view/view.status.php'); ?>
									    <div class="clearfix"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </section>
					
    
                </div>				                <div class="clearfix"></div>
            </div>
        </div>


@push('scripts')
@endpush

@section('footer')
    
    {!! setting('site_scripts_google_analytics') !!}
@endsection
