<?php 
/**
* Template Name: Blog Left Sidebar 
*/
get_header();?>

<section id="main">

   <?php get_template_part('lib/sub-header')?>

    <div class="container">
        <div class="row">

        	<div id="sidebar" class="col-md-4" role="complementary">
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
                endif; ?>
                <?php themeum_pagination(); ?>
            </div>

        </div> <!-- .row -->
    </div><!-- .container -->
</section> 

<?php get_footer();