<?php
/** PAGE TEMPLATE **/
/**
 * Template Name: Page - With sidebar
 */
get_header(); ?>
    <section id="content" class="clearfix page-widh-sidebar">
    	<div class="content-header-sep"></div>
        <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
            <div class="page">                 	
	            <?php the_content(); ?>
            <!-- end of page -->
            </div>
        <?php endwhile; ?>
        <?php get_sidebar(); ?>
    <!-- end of content -->
    </section>
<?php get_footer(); ?>
