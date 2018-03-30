<?php

// FIX SINCE SHORTCODES DO NOT SHOW INSITE EXCERPTS
// from: http://themeshaper.com/forums/topic/shortcode-content-not-showing-up-in-search-results
// Replace wp_trim_excerpt with a commented out strip_shortcodes()
class BFIModuleImprovedTrimExcerpt {
    
    public static function run() {
        remove_filter('get_the_excerpt', 'wp_trim_excerpt');
        add_filter('get_the_excerpt', array(__CLASS__, 'implementTrim'));
    }
    
    public static function implementTrim($text = '') {
        $raw_excerpt = $text;
        if ( '' == $text ) {
            $text = get_the_content('');
            // $text = strip_shortcodes( $text );
    
            $text = apply_filters('the_content', $text);        
            $text = preg_replace('#<script[^>]*>.*?</script>#is', '', $text);
            $text = str_replace(']]>', ']]>', $text);
            $text = strip_tags($text);
            $excerpt_length = apply_filters('excerpt_length', 55);
            $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
            $words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
            if ( count($words) > $excerpt_length ) {
                array_pop($words);
                $text = implode(' ', $words);
                $text = $text . $excerpt_more;
            } else {
                $text = implode(' ', $words);
            }
        }
        return apply_filters('improved_trim_excerpt', $text, $raw_excerpt);
    }
}

BFIModuleImprovedTrimExcerpt::run();