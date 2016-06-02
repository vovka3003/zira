<?php
/**
 * Zira project
 * helper.php
 * (c)2015 http://dro1d.ru
 */

namespace Zira;

class Helper {
    protected static $_add_language_to_url = true;

    public static function setAddingLanguageToUrl($add_language_to_url) {
        self::$_add_language_to_url = $add_language_to_url;
    }

    public static function html($str) {
        return htmlspecialchars($str, ENT_QUOTES);
    }

    public static function url($path,$absolute=false,$detect_protocol=false) {
        $url = '';
        if ($absolute && $detect_protocol) {
            $port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80;
            $protocol = $port == 443 ? 'https:' : 'http:';
            $url .= $protocol;
        }
        if ($absolute) $url .= '//' . $_SERVER['HTTP_HOST'];
        $base_url = trim(BASE_URL,'/');
        if (!empty($base_url)) $url .= '/'.$base_url;
        if (!Config::get('clean_url')) {
            $url .= '/index.php';
        }
        $path=trim($path,'/');

        if (self::$_add_language_to_url &&
            Locale::getLanguage() &&
            Config::get('languages') &&
            count(Config::get('languages'))>1 &&
            (Locale::getLanguage()!=Config::get('language') || !empty($path))
        ) {
            $url .= '/'.Locale::getLanguage();
        }

        $url .= '/'.$path;
        if ($url != '/') $url = rtrim($url,'/');

        return $url;
    }

    public static function baseUrl($url,$absolute=false,$detect_protocol=false) {
        $prefix = '';
        if ($absolute && $detect_protocol) {
            $port = isset($_SERVER['SERVER_PORT']) ? $_SERVER['SERVER_PORT'] : 80;
            $protocol = $port == 443 ? 'https:' : 'http:';
            $prefix .= $protocol;
        }
        if ($absolute) $prefix .= '//' . $_SERVER['HTTP_HOST'];
        return $prefix . rtrim(BASE_URL,'/') . '/' .ltrim($url,'/');
    }

    public static function assetUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . ASSETS_DIR . '/' .$url;
    }

    public static function assetThemeUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . THEMES_DIR . '/' . View::getTheme() . '/' . ASSETS_DIR . '/' .$url;
    }

    public static function cssUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . ASSETS_DIR . '/' . CSS_DIR . '/' .$url;
    }

    public static function cssThemeUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . THEMES_DIR . '/' . View::getTheme() . '/' . ASSETS_DIR . '/' . CSS_DIR . '/' .$url;
    }

    public static function jsUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . ASSETS_DIR . '/' . JS_DIR . '/' .$url;
    }

    public static function jsThemeUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . THEMES_DIR . '/' . View::getTheme() . '/' . ASSETS_DIR . '/' . JS_DIR . '/' .$url;
    }

    public static function imgUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . ASSETS_DIR . '/' . IMAGES_DIR . '/' .$url;
    }

    public static function imgThemeUrl($url) {
        return rtrim(BASE_URL,'/') . '/' . THEMES_DIR . '/' . View::getTheme() . '/' . ASSETS_DIR . '/' . IMAGES_DIR . '/' .$url;
    }

    public static function tag_short($name, array $attributes = null) {
        if (!$attributes) $attributes = array();
        $html = '<'.self::html($name);
        foreach($attributes as $k=>$v) {
            $html .= ' '.self::html($k) . '="' . self::html($v) . '"';
        }
        $html .= ' />';
        return $html;
    }

    public static function tag_open($name, array $attributes = null) {
        if (!$attributes) $attributes = array();
        $html = '<'.self::html($name);
        foreach($attributes as $k=>$v) {
            $html .= ' '.self::html($k) . '="' . self::html($v) . '"';
        }
        $html .= '>';
        return $html;
    }

    public static function tag_close($name) {
        return '</'.self::html($name).'>';
    }

    public static function tag($name, $value = null, array $attributes = null) {
        $html = self::tag_open($name, $attributes);
        if ($value!==null) $html .= self::html($value);
        $html .= self::tag_close($name);
        return $html;
    }

    public static function nl2br($str) {
        return nl2br(trim($str));
    }
}