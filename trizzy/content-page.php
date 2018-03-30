<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Trizzy
 */
?>
<div class="container page-container">
	<div <?php post_class("sixteen columns full-width"); ?>>
				<?php the_content(); ?>
				<?php wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'trizzy' ),
					'after'  => '</div>',
					) );
					?>
				<div class="clearfix"></div>
			<?php
			if(ot_get_option('pp_pagecomments','off') == 'on') {
			// If comments are open or we have at least one comment, load up the comment template
				if ( comments_open() || '0' != get_comments_number() ) :
					comments_template();
				endif;
				}
			?>

	</div><!-- #main -->
</div><!-- #primary -->
