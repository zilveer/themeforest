<?php
/*
Template Name: 100% Width - Single Footer
*/
?>

<?php get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
        
        <div class="page_full_width">
            <div class="entry-content">
                <div class="">
                    
					<?php the_content(); ?>
    
                </div>
            </div><!-- .entry-content -->
        </div>

    <?php endwhile; // end of the loop. ?>

<!--Mobile trigger footer widgets-->
<?php global $theretailer_theme_options; ?>

<?php if ( 	(!$theretailer_theme_options['dark_footer_all_site']) ||
			($theretailer_theme_options['dark_footer_all_site'] == 0) ) : ?>
				<div class="trigger-footer-widget-area">
					<i class="getbowtied-icon-more-retailer"></i>
				</div>
<?php endif; ?>

<div class="gbtr_widgets_footer_wrapper">

<?php get_template_part("dark_footer"); ?>

<?php get_footer(); ?>