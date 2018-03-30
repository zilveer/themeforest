<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Included by loop.php
 * It is used only on page with posts list: blog, archive, search
 *
 */

global $apollo13;

$blog_variant = $apollo13->get_option('blog', 'blog_variant');

//depending on blog variant we display this part in different order
if($blog_variant === 'variant_1'){
    echo '<h2 class="post-title"><a href="'. esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>';

    a13_top_image_video( true );
}
else{
    a13_top_image_video( true );

    if($blog_variant === 'variant_short_list'){
        echo '<div class="short_column">';
    }

    echo '<h2 class="post-title"><a href="'. esc_url(get_permalink()) . '">' . get_the_title() . '</a></h2>';
}


//post content till 'read more' tag
echo '<div class="real-content">';

if($apollo13->get_option('blog', 'excerpt_type') == 'auto' || is_search()){
    if(strpos($post->post_content, '<!--more-->')){
        the_content(__('Read more ...', 'fame' ));
    }
    else{
        the_excerpt();
    }
}
//manual post cutting
else{
    the_content(__('Read more ...', 'fame' ));
}

//we don't clear here in short_list variant
if($blog_variant !== 'variant_short_list'){
    echo '<div class="clear"></div>';
}

//end of real-content
echo '</div>';


a13_post_meta();


//short_list variant - close of column and clear
if($blog_variant === 'variant_short_list'){
    echo '</div><div class="clear"></div>';
}

