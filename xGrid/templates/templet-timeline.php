<?php
//Template Name: Timeline
get_header();
global $bd_data;

/* Sidebar */
if(get_post_meta($post->ID, 'bd_full_width', true)){
    $post_full      = ' post_full_width';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'left'){
    $post_po        = ' post_sidebar_left';
}
elseif(get_post_meta($post->ID, 'bd_sidebar_position', true) == 'right'){
    $post_po        = ' post_sidebar_right';
}

$bd_criteria_display = get_post_meta(get_the_ID(), 'bd_criteria_display', true); ?>

    <div class="bd-container <?php echo $post_po; echo $post_full; ?>">
        <div class="bd-main">
            <div class="page-title"><h2> <?php the_title();?> </h2></div>
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>">
                    <div class="entry-content bottom40">
                        <?php

                        the_content();

                        $where = apply_filters( 'getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" );
                        $join = apply_filters( 'getarchives_join', '' );
                        $query = "SELECT YEAR(post_date) AS `year`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date) ORDER BY post_date DESC";
                        $key = md5($query);
                        $cache = wp_cache_get( 'wp_get_archives' , 'general');
                        if ( !isset( $cache[ $key ] ) ) {
                            $arcresults = $wpdb->get_results($query);
                            $cache[ $key ] = $arcresults;
                            wp_cache_set( 'wp_get_archives', $cache, 'general' );
                        } else {
                            $arcresults = $cache[ $key ];
                        }

                        if ($arcresults)
                        {
                            foreach ( (array) $arcresults as $arcresult)
                            {
                                $bdBlogCats = bdayh_get_option( 'custom_cat_timeline' );
                                if( empty( $bdBlogCats ) ) $bdBlogCats = '';

                                $year = (int) $arcresult->year;
                                $query = new WP_Query( 'year='.$year.'&no_found_rows=1&posts_per_page=100&category__in='.$bdBlogCats.'');

                                if( $query->have_posts() ) {
                                    ?><h2 class="timeline-title"><b class="btn"><?php echo $arcresult->year ?></b>
                                    </h2><?php
                                }
                                ?>

                                <ul class="timeline-list">
                                    <?php while ( $query->have_posts() ) : $query->the_post()?>
                                        <li class="timeline-item">
                                            <div class="timeline-date"><span><?php the_time(get_option('date_format')); ?></span></div>
                                            <div class="timeline-link"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'bd' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></div>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>

                                <div class="clear bottom24"> </div>
                            <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div><!-- .bd-main-->
        <?php get_sidebar(); ?>
    </div><!-- .bd-container -->
<?php get_footer(); ?>