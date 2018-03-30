<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

    // The Regular Expression filter
    $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
    $has_url =  false;

    //uses post content as link, and title as link text
    $content = get_the_content();

    // Check if there is a url in the text
    if(preg_match($reg_exUrl, $content, $url)) {
        $content = $url[0];
        $has_url = true;
    }

    echo '<h2 class="post-title"><a href="'. esc_url(( $has_url ) ? $content : apply_filters( 'the_permalink', get_permalink() )) . '">' . get_the_title() . '</a></h2><i class="post-format-icon fa fa-link"></i>';

    a13_post_meta();