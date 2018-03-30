<?php
/*
 * Template Name: Blog Masonery column 3
 */
?>

<?php get_header(); ?>

<section id="main" class="container">

    <div class="subtitle">
        <div class="row">
            <div class="col-xs-6 col-sm-6">
                <h2><?php the_title(); ?></h2>
            </div>    
            <div class="col-xs-6 col-sm-6">
                <?php themeum_breadcrumbs(); ?>
            </div>
        </div>
    </div>

    <div class="row">

        <div id="content" class="site-content col-md-12" role="main">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('post_type' => 'post','paged' => $paged);
            $posts = new WP_Query($args);
            ?>

            <?php if ( $posts->have_posts() ) : ?>
            <div id="themeum-area" class="masonery_area masonery-column-3 row">
                <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <div class="themeum-post-item col-sm-6 col-md-4 masonery-post">
                        <?php get_template_part( 'post-format/content', get_post_format() ); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php else: ?>
                <div class="clearfix">
                    <?php get_template_part( 'post-format/content', 'none' ); ?>
                </div>
            <?php endif; ?>

            <?php
                $allposts = wp_count_posts('post');
                $max_posts = get_option('posts_per_page');
            ?>
            
            <?php if ($allposts->publish > $max_posts ) {  ?>
                <div class="clearfix load-wrap">
                    <span class="ajax-loader">Ajax Loader</span>
                    <div class="clearfix"></div>
                    <a id="post-loadmore" class="load-more btn btn-primary" data-per_page="<?php echo $max_posts; ?>" data-url="<?php echo get_template_directory_uri().'/post-loadmore.php'; ?>" data-total_posts="<?php echo $allposts->publish; ?>" data-col_grid="4" href="#"><?php _e('Load More', 'themeum') ;?></a>
                </div>
            <?php } ?>


        </div> <!-- #content -->
    </div> <!-- .row -->
</section> <!--/#page-->

<?php get_footer();