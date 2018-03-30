<?php
// [os_social_buttons]
function shortcode_os_social_buttons_func( $atts ) {
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );

    global $wp;
    $url = get_permalink();
    $text = urlencode(get_the_title());
    $icons_uri = get_template_directory_uri().'/assets/images/socialicons';
    $img_to_pin = has_post_thumbnail() ? wp_get_attachment_url( get_post_thumbnail_id() ) : "";

    $html = '<div class="os_social">';
    $html.= '<a class="os_social_twitter_share" href="http://twitter.com/share?url='.$url.'&amp;text='.$text.'" target="_blank"><img src="'.$icons_uri.'/twitter.png" title="Twitter" class="os_social" alt="Tweet about this on Twitter"></a>';

    $pinterest_code = '//www.pinterest.com/pin/create/button/?url='.$url.'&amp;media='.$img_to_pin.'&amp;description='.$text;
    $html.= '<a class="os_social_pinterest_share" target="_blank" href="'.$pinterest_code.'"><img src="'.$icons_uri.'/pinterest.png" title="Pinterest" class="os_social" alt="Pin on Pinterest"></a>';
    $html.= '<a class="os_social_linkedin_share" href="http://www.linkedin.com/shareArticle?mini=true&amp;url='.$url.'" target="_blank"><img src="'.$icons_uri.'/linkedin.png" title="Linkedin" class="os_social" alt="Share on LinkedIn"></a>';
    $html.= '<a class="os_social_google_share" href="https://plus.google.com/share?url='.$url.'" target="_blank"><img src="'.$icons_uri.'/google.png" title="Google+" class="os_social" alt="Share on Google+"></a>';
    $html.= '<a class="os_social_email_share" href="mailto:?Subject='.$text.'&amp;Body=%20'.$url.'"><img src="'.$icons_uri.'/email.png" title="Email" class="os_social" alt="Email this to someone"></a>';
    $html.= '<a class="os_social_facebook_share" href="http://www.facebook.com/sharer.php?u='.$url.'" target="_blank"><img src="'.$icons_uri.'/facebook.png" title="Facebook" class="os_social" alt="Share on Facebook"></a>';
    $html.= '<a class="os_social_vk_share" href="http://vkontakte.ru/share.php?url='.$url.'" target="_blank"><img src="'.$icons_uri.'/vkontakte.png" title="Vkontakte" class="os_social" alt="Share on Vkontakte"></a>';
    $html.= '<a class="os_social_vk_share" href="http://www.odnoklassniki.ru/dk?st.cmd=addShare&st._surl='.$url.'" target="_blank"><img src="'.$icons_uri.'/vkontakte.png" title="Vkontakte" class="os_social" alt="Share on Vkontakte"></a>';
    $html.= '</div>';
    return $html;
}
add_shortcode( 'os_social_buttons', 'shortcode_os_social_buttons_func' );




// Featured Posts Slider shortcode
function shortcode_os_featured_slider($atts){
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );
    $args = array( 'numberposts' => -1, 'post_status' => 'publish', 'meta_key' => 'is_featured_post', 'meta_value' => true, 'ignore_sticky_posts' => 1 );
    $osetin_featured_posts_query = new WP_Query( $args );
    $html = '<div class="featured-posts-slider-w featured-posts hidden-xs hidden-sm">';
        $html.= '<div class="featured-posts-slider-i">';
            $html.= '<div class="featured-posts-label">'.__('Featured', 'pluto').'</div>';
            $html.= '<div class="featured-posts-slider-contents side-padded-content">';
                while ($osetin_featured_posts_query->have_posts()) : $osetin_featured_posts_query->the_post();
                    $html.= os_load_template_part( 'featured-content', get_post_format() );
                endwhile;
                wp_reset_postdata();
            $html.= '</div>';
            $html.= '<div class="featured-posts-slider-controls">';
                $html.= '<a href="#" class="featured-post-control-up"><i class="os-icon-angle-up"></i></a>';
                $html.= '<a href="#" class="featured-post-control-down"><i class="os-icon-angle-down"></i></a>';
            $html.= '</div>';
        $html.= '</div>';
    $html.= '</div>';
    return $html;
}
add_shortcode( 'os_featured_slider', 'shortcode_os_featured_slider' );



// Featured Posts Carousel shortcode
function shortcode_os_featured_carousel($atts){
    $a = shortcode_atts( array(
        'foo' => 'something',
        'bar' => 'something else',
    ), $atts );
    $args = array( 'numberposts' => -1, 'post_status' => 'publish', 'meta_key' => 'is_featured_post', 'meta_value' => true, 'ignore_sticky_posts' => 1 );
    $osetin_featured_posts_query = new WP_Query( $args );

    $html = '<div class="featured-carousel owl-carousel">';
    while ($osetin_featured_posts_query->have_posts()) : $osetin_featured_posts_query->the_post();
        $html .= os_load_template_part( 'featured-carousel-content', get_post_format() );
    endwhile;
    wp_reset_postdata();
    $html .= '</div>';
    return $html;
}
add_shortcode( 'os_featured_carousel', 'shortcode_os_featured_carousel' );