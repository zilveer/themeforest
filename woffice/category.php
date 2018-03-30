<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 */
get_header(); ?>

	<div id="left-content">

		<?php  //GET THEME HEADER CONTENT
		$title = sprintf( __( 'Category Archives: <span>%s</span>', 'woffice' ), single_cat_title( '', false ));
		woffice_title($title); ?> 	

		<!-- START THE CONTENT CONTAINER -->
		<div id="content-container">

			<!-- START CONTENT -->
			<div id="content">

                <?php
                $blog_layout = 'classic';
                $content_type = 'content';
                if(get_post_type() == 'post'){
                    $blog_layout = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('blog_layout') : '';
                    echo ($blog_layout == "masonry") ? '<div id="directory" class="masonry-layout">' : '';
	                $content_type = ($blog_layout == "masonry") ? 'content-masonry' : 'content';
                }
                ?>

				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php // We check for the role : 
						if (woffice_is_user_allowed()) { ?>
							<?php get_template_part( $content_type ); ?>
						<?php } ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

                <?php echo ($blog_layout == "masonry") ? '</div>' : ''; ?>

				<!-- THE NAVIGATION --> 
				<?php woffice_paging_nav(); ?>
			</div>
				
		</div><!-- END #content-container -->
		
		<?php woffice_scroll_top(); ?>

	</div><!-- END #left-content -->

<?php 
get_footer();
