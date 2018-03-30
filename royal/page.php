<?php 
	get_header();
?>

<?php 

	$l = et_page_config();

?>

<?php do_action( 'et_page_heading' ); ?>

	<div class="container content-page">
		<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?> sidebar-mobile-<?php esc_attr_e( $l['sidebar-mobile'] ); ?>">
			<div class="row">

				<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
					<?php if(have_posts()): while(have_posts()) : the_post(); ?>
						
						<?php the_content(); ?>

						<div class="post-navigation">
							<?php wp_link_pages(); ?>
						</div>
						
						<?php if ($post->ID != 0 && current_user_can('edit_post', $post->ID)): ?>
							<?php edit_post_link( __('Edit this', ET_DOMAIN), '<p class="edit-link">', '</p>' ); ?>
						<?php endif ?>

					<?php endwhile; else: ?>

						<h3><?php _e('No pages were found!', ET_DOMAIN) ?></h3>

					<?php endif; ?>

				</div>

				<?php get_sidebar(); ?>

			</div><!-- end row-fluid -->

		</div>
	</div><!-- end container -->

<?php
	get_footer();
?>
