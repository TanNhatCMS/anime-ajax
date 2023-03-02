<?php

namespace Tannhatcms\Theme8anime;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class Theme8animeServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'theme8anime');
    }

    public function boot()
    {
        try {
            foreach (glob(__DIR__ . '/Helpers/*.php') as $filename) {
                require_once $filename;
            }
        } catch (\Exception $e) {
            //throw $e;
        }
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');
        
        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/8anime')
        ], '8anime-assets');
        $this->publishes([
            __DIR__ . '/../resources/views/errors' => base_path('resources/views/errors')
        ], '8anime-error-page');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            '8anime' => [
                'name' => '8Anime',
                'author' => '8anime.net',
                'package_name' => 'tannhatcms/theme-8anime',
                'publishes' => ['8anime-assets'],
                'version' => explode('@', \PackageVersions\Versions::getVersion('tannhatcms/theme-8anime') ?? 0)[0],
                'preview_image' => '/themes/8anime/images/screenshots.png',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Giới hạn đề cử',
                        'type' => 'number',
                        'hint' => 'Number',
                        'value' => 30,
                        'tab' => 'Danh sách'
                    ],
                    [
                        'name' => 'slider_recommended',
                        'label' => 'Danh sách đề cử tuỳ chỉnh',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (slider_poster|section_thumb)',
                        'value' => "",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'Danh sách'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Trang Chủ',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (slider_poster|section_thumb)',
                        'value' => "Anime Hot||is_copyright|0|6|/danh-sach/phim-moi|slider_poster\r\nAnime mới cập nhật||is_copyright|0|50|/danh-sach/phim-moi|section_thumb\r\nAnime sắp chiếu||status|trailer|9|/danh-sach/sap-chieu|section_thumb",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'Danh sách'
                    ],
                    [
                        'name' => 'hotest',
                        'label' => 'Danh sách hot',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_template (top_text|top_thumb|top_poster)',
                        'value' => "Top Anime bộ||type|series|view_total|desc|10|top_thumb\r\nTop Anime lẻ||type|single|view_total|desc|10|top_thumb",
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'Danh sách'
                    ],
                    [
                        'name' => 'movie_update_right',
                        'label' => 'Phim cập nhật- Cột bên phải',
                        'type' => 'code',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit',
                        'value' => "Phim lẻ mới||type|single|created_at|desc|11\r\nPhim bộ đang chiếu||type,status|series,ongoing|updated_at|desc|11\r\nPhim bộ hoàn thành||type,status|series,completed|updated_at|desc|11",
                        'attributes' => [
                            'rows' => 3
                        ],
                        'tab' => 'Danh sách'
                    ],
                   
                    [
                        'name' => 'additional_css',
                        'label' => 'CSS bổ sung',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Tuỳ chỉnh CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'thuộc tính Body',
                        'type' => 'text',
                        'value' => <<<EOT
                         data-rsssl="1" class="home blog wp-custom-logo NoBrdRa" style="background-image: url(/themes/8anime/images/background.png);" 
                         EOT,
                        'tab' => 'Tuỳ chỉnh CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Java Script Dầu trang',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Tuỳ chỉnh Java Script'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Java Script Body',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Tuỳ chỉnh Java Script'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Java Script Cuối Trang',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Tuỳ chỉnh Java Script'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Cuối trang',
                        'type' => 'code',
                        'value' => <<<EOT
                            <div class="MnBrCn BgA">
                                <div class="MnBr EcBgA">
                                    <div class="Container">
                                    <figure class="Logo">
                                        <a href="/"
                                        title="Blog Anime | Anime Mới | Xem Anime online | Anime HD | Anime Hay Vietsub"
                                        rel="home">
                                        <img title="Blog Anime | Anime Mới | Xem Anime online | Anime HD | Anime Hay Vietsub"
                                            src="https://8anime.net/storage/logo/logo.png" 
                                                                data-src="https://8anime.net/storage/logo/logo.png"
                                            alt="Blog Anime | Anime Mới | Xem Anime online | Anime HD | Anime Hay Vietsub">
                                        </a>
                                    </figure>
                                    <div class="Rght">
                                        <nav class="Menu">
                                            <ul>
                                            <li
                                                class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
                                                <a href="/">Fanpage 8Anime</a>
                                            </li>
                                            <li
                                                class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
                                                <a href="/">Gruop 8Anime</a>
                                            </li>
                                            <li
                                                class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item menu-item-home menu-item-490">
                                                <a href="mailto:luutru5901@gmail.com">Email</a>
                                            </li>
                    
                                            </ul>
                                        </nav>
                                        <ul class="ListSocial">
                                            <li>
                                                <a href="javascript:void(0)" class="Up AAIco-arrow_upward" title="Cuộn lên trên"></a>
                                            </li>
                                        </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="WebDescription">
                        Anime Vietsub HD | <a href="#" class="z-link" target="blank"
                            title="8Anime.Net | Xem Anime Online | Anime Hay | Anime Mới">Anime Vietsub HD</a>
                        <br>
                        <a href="https://8anime.net/" tag="" title="" target="_blank">Anime Vietsub</a>,
                        <a href="https://8anime.net/the-loai/mua-dong-2023" tag="" title="" target="_blank">Anime Mùa Đông 2023</a>,
                        <a href="#" tag="" title="" target="_blank">Anime HD</a>,
                        <a href="#" tag="" title="" target="_blank">Top Anime</a>,
                        </div>
                        <p class="Copy">
                            Copyright ® 2023 8Anime.Net. All Rights Reserved
                        </p>
                        EOT,
                        'tab' => 'Tuỳ chỉnh HTML'
                    ],
                    
                    [
                        'name' => 'hide_ads_boss',
                        'label' => 'Ẩn quảng cáo popup',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'show_ads_header',
                        'label' => 'Chèn quảng cáo đầu trang',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Quảng cáo',   
                       
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Quảng cáo đầu trang',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'hint' => 'code nhà cái',
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'show_ads_catfish',
                        'label' => 'Chèn quảng cáo nổi cuối trang',
                        'type' => 'switch', 
                        'color'    => 'primary',
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Quảng cáo nổi cuối trang',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_client_id',
                        'label' => 'Client id quảng cáo',
                        'type' => 'text',
                        'value' => 'ca-pub-1369658207103569',
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Quảng cáo nổi cuối trang',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_on_header',
                        'label' => 'Quảng cáo trên đầu trang',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_on_comment',
                        'label' => 'Quảng cáo trên bình luận',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'ads_footer',
                        'label' => 'Quảng cáo cuối trang',
                        'type' => 'code',
                        'value' => <<<EOT
                        EOT,
                        'attributes' => [
                            'rows' => 15
                        ],
                        'tab' => 'Quảng cáo'
                    ],
                    [
                        'name' => 'home_url',
                        'label' => 'URL Trang chủ',
                        'type' => 'url',
                        'hint' => 'http://8anime.net/',
                        'value' => 'http://8anime.net/',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'logo_url',
                        'label' => 'Logo URL',
                        'type' => 'url',
                        'hint' => '',
                        'value' => '',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'home_comment_facebook',
                        'label' => 'Bình luận Facebook Hỏi/đáp Anime',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'PreloadControl',
                        'label' => 'Bật/Tắt tải trước Trang',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'usercontrol',
                        'label' => 'Bật/Tắt người dùng',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'landingpagecontrol',
                        'label' => 'Chế độ trang đích',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Khác'
                    ],
                    [
                        'name' => 'maintenancecontrol',
                        'label' => 'Chế độ bảo trì',
                        'type' => 'switch', 
                        'color'    => 'primary', // May be any bootstrap color class or an hex color
                        'onLabel' => '✓',
                        'offLabel' => '✕',
                        'tab' => 'Khác'
                    ],

                ],
            ]
        ])]);
    }
}
