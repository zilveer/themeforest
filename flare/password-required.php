<?php
/**
 * This special template is used only when a post is password protected and the correct password hasn't been provided.
 * 
 * @package BTP_Flare_Theme
 */
?>
<?php get_header(); ?>
	<?php the_post(); ?>	
	<?php get_template_part( 'precontent' ); ?>
	
	<div id="content" class="<?php echo btp_content_get_class(); ?>">
		<div id="content-inner">
		
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="entry-content">						
					<?php the_content(); ?>
				</div><!-- .entry-content -->
										
				<div class="entry-utility">		
					<?php edit_post_link( __( 'Edit', 'btp_theme' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->
			</article>
			
		</div><!-- #content-inner -->
		<div class="background"><div></div></div>
	</div><!-- #content -->

<?php get_footer(); ?>