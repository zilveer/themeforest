<?php
// Template Name: Portfolio Two Column

get_header();
global $bd_data; ?>

    <div id="page-title">
        <div class="bd-container">
            <div class="bd-page-title">
                <h1><?php the_title(); ?></h1>
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
                <?php
                    if(is_front_page()){
                        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
                    } else {
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    }
                    $args = array(
                        'post_type'         => 'wportfolio',
                        'paged'             => $paged,
                        'posts_per_page'    => bdayh_get_option( 'wportfolio_items' ),
                    );
                    $pcats = get_post_meta( get_the_ID(), 'new_bd_portfolio_category', true );
                    if( $pcats && $pcats[0] == 0 ){
                        unset($pcats[0]);
                    }
                    if($pcats){
                        $args['tax_query'][] = array(
                            'taxonomy'      => 'portfolio_category',
                            'field'         => 'ID',
                            'terms'         => $pcats
                        );
                    }
                    $gallery = new WP_Query( $args );
                    if( is_array( $gallery->posts ) && !empty( $gallery->posts ) ){
                        foreach( $gallery->posts as $gallery_post ){
                            $post_taxs = wp_get_post_terms( $gallery_post->ID, 'portfolio_category', array( "fields" => "all" ) );
                            if( is_array( $post_taxs ) && !empty( $post_taxs ) ){
                                foreach( $post_taxs as $post_tax ){
                                    if( is_array( $pcats ) && !empty( $pcats ) && in_array( $post_tax->term_id, $pcats ) ){
                                        $portfolio_taxs[urldecode( $post_tax->slug )] = $post_tax->name;
                                    }
                                    if( empty( $pcats ) || !isset( $pcats ) ){
                                        $portfolio_taxs[urldecode( $post_tax->slug )] = $post_tax->name;
                                    }
                                }
                            }
                        }
                    }
                    if( is_array( $portfolio_taxs ) ) {
                        asort( $portfolio_taxs );
                    }
                    $portfolio_category = get_terms( 'portfolio_category' );
                    if( is_array( $portfolio_taxs ) && !empty( $portfolio_taxs ) ){
                        if( bdayh_get_option( 'folio_filter' ) ) {
                            ?>
                            <div id="options">
                                <ul id="filters" class="portfolio-tabs option-set" data-option-key="filter">
                                    <li><a href="#filter" data-option-value="*" class="selected"><?php echo __('Show All', 'bd'); ?></a></li>
                                    <?php foreach($portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name): ?>
                                        <li><a data-option-value=".<?php echo $portfolio_tax_slug; ?>" href="#filter"><?php echo $portfolio_tax_name; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div><!-- #filters -->
                            <div class="clear"></div>
                        <?php } } ?>

                <div id="contain" class="folio-2col folio-items">
                <?php
                    while($gallery->have_posts()): $gallery->the_post();

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
                                    if( $post_type == 'post_image' ) { bd_wp_thumb( '800', '600', 'lightbox', '' );
                                    } elseif( $post_type == 'post_slider' ) { bd_wp_gallery( '800', '600' );
                                    } elseif( $post_type == 'post_video' ) {
                                        $img_w          = '800';
                                        $img_h          = '600';
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
                                <h3 class="tite"><a href="<?php echo $permalink; ?>"><?php the_title(); ?></a> <span class="cate"><?php echo get_the_term_list($post->ID, 'portfolio_category', '', ', ', ''); ?></span></h3>
                            </div><!-- .inner-desc -->
                        </div><!-- .folio-item -->
                <?php endwhile; ?>
                </div><!-- .folio-items -->

            </div><!-- .bd-container -->
            <div class="clear"></div>
            <div class="bd-container"><?php bd_wpagination( $gallery->max_num_pages, $range = 2 ); ?></div>
        </div><!-- #folio-main -->
        <div id="loading"  class="rotating-plane"></div>
    </div>
    <!-- .folio-container -->
    <div class="clear"></div>
<?php
get_footer();