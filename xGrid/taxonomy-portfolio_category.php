<?php
get_header();
global $post, $bd_data; ?>

    <div id="page-title">
        <div class="bd-container">
            <div class="bd-page-title">
                <h1><?php single_cat_title(); ?></h1>
            </div>
            <!-- .bd-page-title -->
            <div id="crumbs">
                <?php bd_crumbs(); ?>
            </div>
            <!-- #crumbs -->
        </div>
    </div>
    <!-- #page-title -->

    <div class="folio-container loading">
        <div id="folio-main">
            <div class="bd-container">
                <div id="contain" class="folio-4col folio-items">
                    <?php
                        while(have_posts()): the_post();

                            $permalink      = get_permalink();
                            $item_classes   = '';
                            $item_cats      = get_the_terms( $post->ID, 'portfolio_category' );

                            if($item_cats){
                                foreach( $item_cats as $item_cat ){
                                    $item_classes .= urldecode($item_cat->slug) . ' ';
                                }
                            }
                    ?>
                        <div class="folio-item portfolio-item <?php echo $item_classes; ?>" data-categories="<?php echo $item_classes; ?>">
                            <div class="inner-media">
                                <?php
                                    if( get_post_meta( get_the_ID(), 'new_bd_wportfolio_post_type', true ) ){
                                        $post_type = get_post_meta(get_the_ID(), 'new_bd_wportfolio_post_type', true);
                                        if( $post_type == 'post_image' ) { bd_wp_thumb( '400', '300', 'lightbox', '' );
                                        } elseif( $post_type == 'post_slider' ) { bd_wp_gallery( '400', '300' );
                                        } elseif( $post_type == 'post_video' ) {
                                            $img_w          = '400';
                                            $img_h          = '300';
                                            $type           = get_post_meta($post->ID, 'new_bd_wportfolio_video_type', true);
                                            $id             = get_post_meta($post->ID, 'new_bd_video_url', true);
                                            if($type == 'youtube'){ echo '<div class="post-image video-box"><iframe src="http://www.youtube.com/embed/'. $id .'?rel=0" frameborder="0" allowfullscreen></iframe></div>'."\n";
                                            } elseif($type == 'vimeo') { echo '<div class="post-image video-box"><iframe src="http://player.vimeo.com/video/'. $id .'?title=0&amp;byline=0&amp;portrait=0&amp;color=ba0d16" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>'."\n";
                                            } elseif($type == 'daily') { echo '<div class="post-image video-box"><iframe frameborder="0" src="http://www.dailymotion.com/embed/video/'. $id .'?logo=0"></iframe></div>'."\n"; }
                                        } else { }
                                    }
                                ?>
                            </div><!-- .inner-media -->
                            <div class="inner-desc">
                                <h3 class="tite"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a></h3>
                            </div><!-- .inner-desc -->
                        </div><!-- .folio-item -->
                    <?php endwhile; ?>
                </div><!-- .folio-items -->
            </div><!-- .bd-container -->
            <div class="clear"></div>
            <div class="bd-container"><?php bd_wpagination( $gallery->max_num_pages, $range = 2 ); ?></div>
        </div><!-- #folio-main -->
        <div id="loading" class="rotating-plane"></div>
    </div>
    <!-- .folio-container -->
    <div class="clear"></div>
<?php
get_footer();