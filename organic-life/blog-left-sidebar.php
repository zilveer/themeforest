<?php 
/**
* Template Name: Blog Left Sidebar 
*/
get_header();?>

<section id="main" class="container">
    <div class="row">

    	<div id="sidebar" class="col-md-4" role="complementary">
            <?php get_template_part( 'my-profile'); ?>
            <div class="sidebar-inner">
                <aside class="widget-area">
                    <?php dynamic_sidebar( 'sidebar' ); ?>
                </aside>
            </div>
        </div> <!-- #sidebar -->

        <div id="content" class="site-content col-md-8" role="main">
            <?php

            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array('post_type' => 'post','paged' => $paged);
            query_posts($args); 

            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    get_template_part( 'post-format/content', get_post_format() );
                endwhile;
            else:
                get_template_part( 'post-format/content', 'none' );
            endif;

            ?>

            <div class="btn btn-style pull-left"><?php next_posts_link( '&laquo; Older Posts' ); ?></div>
            <div class="btn btn-style pull-right"><?php previous_posts_link( 'Newer Posts &raquo;' ); ?></div>
        </div>

    </div> <!-- .row -->
</section> <!-- .container -->

<?php get_footer();