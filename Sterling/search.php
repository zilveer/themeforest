<?php get_header(); ?>

<?php get_template_part( 'template-part-page-slider', 'childtheme' ); ?>

<section id="content-container" class="clearfix">
    <div id="main-wrap" class="main-wrap-slider clearfix">
        <div class="page_content">
            <ol class="search-list">
                <?php
                    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <li><strong><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></strong><br />
                        <?php
                            ob_start();
                            the_content();
                            $old_content = ob_get_clean();
                            echo substr( strip_tags( $old_content ), 0, 300 ) . '&hellip;';
                        ?>
                        </li>

                    <?php endwhile; echo '</ol>'; else: ?>
                        <?php global $ttso; echo stripslashes( html_entity_decode($ttso->st_results_fallback) ); ?>
                    <?php endif;

            if ( function_exists( 'wp_pagenavi' ) )
                wp_pagenavi(); ?>
        </div><!-- end .page_content-->

        <aside class="sidebar right-sidebar">
            <?php generated_dynamic_sidebar( 'Search Results Sidebar' ); ?>
        </aside><!-- end .sidebar-->
    </div><!-- end #main-wrap -->

<?php get_footer(); ?>