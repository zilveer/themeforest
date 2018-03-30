<?php
/**
 * Slide Set
 */

global $bd_data;

if( bdayh_get_option( 'slideset_speed' ) ){
    $slider_speed       = bdayh_get_option( 'slideset_speed' );
} else {
    $slider_speed       = '6666';
}

if( bdayh_get_option( 'slideset_animation' ) ){
    $slider_animation   = bdayh_get_option( 'slideset_animation' );
} else {
    $slider_animation   = '555';
}


if ( bdayh_get_option( 'slideset_show' ) ){
    $slider_display     = bdayh_get_option( 'slideset_display' );

    if(array_key_exists('slideset_category',$bd_data))
    {
        $slider_cat         = $bd_data ['slideset_category'];
    }

    if(array_key_exists('slideset_tag',$bd_data))
    {
        $slider_tag         = $bd_data ['slideset_tag'];
    }

    if( bdayh_get_option( 'slideset_bumber' ) ) {
        $slider_nub         = bdayh_get_option( 'slideset_bumber' );
    } else {
        $slider_nub         = '4';
    }


    if ($slider_display == 'lates'){

        $query = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );


    } elseif( $slider_display == 'category' ){

        $query = new WP_Query( array( 'cat' => $slider_cat, 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );

    } elseif( $slider_display == 'tag' ){

        $query = new WP_Query( array( 'tag' => $slider_tag, 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );

    } elseif( $slider_display  == 'post' ){

        $posts_var = explode (',' , bdayh_get_option( 'bd_the_slideset_posts' ) );
        $query = new WP_Query( array( 'post_type' => 'post', 'post__in' => $posts_var, 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );


    } elseif( $slider_display  == 'page' ){

        $pages_var = explode (',' , bdayh_get_option( 'bd_the_slideset_pages' ) );
        $query = new WP_Query( array( 'post_type' => 'page', 'post__in' => $pages_var, 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );

    } else {

        $query = new WP_Query( array( 'ignore_sticky_posts' => 1, 'posts_per_page' => $slider_nub, 'no_found_rows' => true, 'cache_results' => false ) );
        update_post_thumbnail_cache( $query );
    }

?>

<div class="slide-set">
    <div id="slide-set" class="slideset-warpper flexslider">
        <ul class="slides bd-post-carousel unstyled">
            <?php $size = "bd-related"; if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); if ( has_post_thumbnail() ) { ?>
                <li class="slide-inner">
                    <?php bd_wp_thumb( '480', '384', '', '' ); ?>

                    <div class="slide-set-header">
                        <div class="slide-set-header-content">
                            <?php
                            if( bdayh_get_option( 'slideset_date' ) ) {
                                if( bdayh_get_option('date_format') ) {
                                    echo "<span itemprop='datePublished' class='date updated'> <i class='fa fa-calendar'></i>"; the_time( bdayh_get_option('date_format') ); echo "</span>";
                                } else { echo "<span itemprop='datePublished' class='date updated'> <i class='fa fa-calendar'></i>"; the_time('F j, Y');  echo "</span>"; }
                            }
                            ?>

                            <?php the_title( '<span itemprop="name" class="ss-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></span>' ); ?>
                        </div>
                    </div>

                    <div class="slide-set-footer">

                        <div class="slide-set-footer-content">
                            <?php if( bdayh_get_option( 'slideset_cate' ) ) { ?>
                                <span class="ss-cate">
                                    <i class="fa fa-folder"></i>
                                    <?php the_category(', '); ?>
                                </span>
                            <?php } ?>

                            <?php if( bdayh_get_option( 'slideset_comments' ) ) { ?>
                                <span class="ss-comment"><i class="fa fa-comments-o"></i> <?php comments_popup_link( bd_wplang('no_comments') , bd_wplang('comment'), '%'.bd_wplang('comments'), bd_wplang('comments_link'), bd_wplang('comments_closed') ); ?></span>
                            <?php } ?>

                        </div>
                    </div>

                </li>
            <?php } endwhile; else: endif; wp_reset_postdata(); wp_reset_query(); ?>
        </ul>
    </div>
</div>
    <script>
        jQuery(document).ready(function() {
            jQuery('.bd-post-carousel').slick({
                speed          : 600,
                slide          : 'li',
                autoplay       : true,
                autoplaySpeed  : 4000,
                slidesToShow   : 4,
                slidesToScroll : 1,
                responsive     : [
                    { breakpoint : 1500, settings : { speed : 500, slide : 'li', slidesToShow : 4 } },
                    { breakpoint : 1200, settings : { speed : 500, slide : 'li', slidesToShow : 3 } },
                    { breakpoint : 979,  settings : { speed : 500, slide : 'li', slidesToShow : 2 } },
                    { breakpoint : 550,  settings : { speed : 500, slide : 'li', slidesToShow : 1 } }
                ]
            });
        });
    </script>

<?php } ?>