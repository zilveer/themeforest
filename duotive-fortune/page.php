<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Page - Full width and no comments
 */
get_header(); ?>
    <section id="content" class="clearfix">
    	<div class="content-header-sep"></div>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="page page-full">                 	
	            <?php the_content(); ?>
            <!-- end of page -->
            </div>
        <?php endwhile; ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>

