<?php

return [
    'version' => explode('@', \PackageVersions\Versions::getVersion('tannhatcms/theme-8anime') ?? 0)[0],
    'driver' => 'gd',
    'sizes' => [
        'thumb' => [215, 320],
        'poster' => [0, 0],
        'thumbnail' => [150, 150], 
        'medium' => [400, 400],
        'larage' => [600, 600],
        '215x320' => [215, 320],
        '180x260' => [180, 260],//width="180" height="260"
        '55x85' => [55, 85],
    ], 
    'ads' => [
        'client_id' => 'ca-pub-1369658207103569', //Your Adsense client ID e.g. ca-pub-9508939161510421
        'responsive' => [
            'ad_slot' => 8119676320,
            'ad_format' => 'auto',
            'ad_full_width_responsive' => true,
            'ad_style' => 'display:block'
        ],
        'rectangle' => [
            'ad_slot' => 5301941293,
            'ad_style' => 'display:block',
            'ad_full_width_responsive' => true,
            'ad_format' => 'auto'
        ],
        'responsive1' => [
            'ad_slot' => 1111111111,
            'ad_format' => 'fluid',
            'ad_full_width_responsive' => true,
            'ad_style' => 'display:inline-block',
        ],
        'rectangle2' => [
            'ad_slot' => 2222222222,
            'ad_style' => 'display:inline-block;width:300px;height:250px',
            'ad_full_width_responsive' => false,
            'ad_format' => 'auto',
        ],
    ],
];
