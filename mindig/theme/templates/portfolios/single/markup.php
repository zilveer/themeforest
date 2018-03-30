<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

$enable_thumbnail   = $portfolio->get( 'config-enable_thumbnail' );
$enable_title       = $portfolio->get( 'config-enable_title' );
$enable_categories  = $portfolio->get( 'config-enable_categories' );
$enable_extra_info  = $portfolio->get( 'config-enable_extra_info' );
$layout             = $portfolio->get( 'config-single_layout' );
$layout             = $layout != '' ? $layout : 'big_image';
$show_thumbnail     = $enable_thumbnail && has_post_thumbnail() ? true : false;
$testimonial_id     = $portfolio->get( 'show_testimonial' );
$testimonial        = '';
$testimonial_title  = $portfolio->get( 'testimonial-title' );
$title              = $portfolio->get( 'title' );
$excerpt            = $portfolio->get( 'excerpt' );
$socials            = $portfolio->get( 'share_socials' );
$show_share         = ! empty( $socials ) ? true : false ;
$share_title        = $portfolio->get( 'share_title' );
$share_socials      = $portfolio->get( 'share_socials' );
$path               = $this->locate_file( 'single', $layout );
$taxonomy           = $portfolio->config->taxonomy;
$gallery            = $portfolio->get('gallery');

if( ! function_exists( 'YIT_Testimonial' ) || $testimonial_id == -1 || empty( $testimonial_id ) ){
    $show_testimonial = false;
}else{
    $show_testimonial = true;
    $testimonial_query = new WP_Query(
        array(
            'p'              => $testimonial_id,
            'post_type'      => YIT_Testimonial()->testimonial_post_type,
            'posts_per_page' => 1
        )
    );

    $testimonial = $testimonial_query->posts[0];
}


$attachments_args = array(
    'post_type'      => 'attachment',
    'numberposts'    => -1,
    'post_status'    => 'any',
    'post_mime_type' => 'image',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post__not_in'   => array( get_post_thumbnail_id() )
);


if ( $gallery != '' ) {
    $attachments_args['post__in'] = array_filter( explode( ',', $gallery ) );
}else{
    $attachments_args['post_parent'] = get_the_ID();
}

$attachments = get_posts($attachments_args);

$extra_info_variables = array(
    'attachments'   => $attachments,
    'year'          => $portfolio->get( 'year' ),
    'customer'      => $portfolio->get( 'customer' ),
    'project'       => $portfolio->get( 'project' ),
    'website_url'   => $portfolio->get( 'website-url' ),
    'website'       => $portfolio->get( 'website' ),
    'budget'        => $portfolio->get( 'budget' )
);

if( file_exists( $path ) ){
    include( $path );
}