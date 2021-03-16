<?php

namespace app\Helpers;

class LinkParser {
    public function __construct() {
    }

    public static function parse($str) {
        return LinkParser::replace(strip_tags($str));
    }

    public static function replace($text) {
        $reg_exUrl = "/(http|https)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
        preg_match_all($reg_exUrl, $text, $matches);
        $usedPatterns = [];
        foreach ($matches[0] as $pattern) {
            if (!array_key_exists($pattern, $usedPatterns)) {
                $usedPatterns[$pattern] = true;
                $target = "_blank";
                if (stristr($pattern, config('app.url')) !== false) {
                    $target = "_self";
                }
                $text = str_replace($pattern, "<a href='" .$pattern . "' rel='noopener noreferrer' target='$target'>$pattern</a> ", $text);
            }
        }
        return $text;
    }
}