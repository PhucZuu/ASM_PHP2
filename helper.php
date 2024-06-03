<?php 

const PATH_ASSET = __DIR__ ."/assets/";

if (!function_exists('show_uploads')) {
    function show_uploads($path) {
        return $_ENV['BASE_URL']. '/assets/' . $path;
    }
}

if (!function_exists('asset')) {
    function asset($path) {
        return $_ENV['BASE_URL'] . $path;
    }
}

if (!function_exists('url')) {
    function url($uri) {
        return $_ENV['BASE_URL'] . $uri;
    }
}