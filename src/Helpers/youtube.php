<?php
/**
 * Get Youtube video ID from URL
 *
 * @param string $url
 * @return mixed Youtube video ID or FALSE if not found
 */
if (!function_exists('getYoutubeIdFromUrl')) {
    function getYoutubeIdFromUrl($url) {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $matches);
            if (!empty($matches)) {
                return $matches[1];
            }
        return false;
    }
}