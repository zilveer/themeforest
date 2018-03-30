<?php
/*
	* The template for displaying single
*/
get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
	
		<?php
			$values_layout_select = get_post_custom( get_the_ID() );
			$hide_page_title = get_post_meta( get_the_ID(), 'page_title', true);
			$heading_navigation_hide = get_post_meta( get_the_ID(), 'heading_navigation_hide', true);
			$no_fluid_layout = get_post_meta( get_the_ID(), 'no_fluid_layout', true);
			$post_excerpt_two = get_post_meta( get_the_ID(), "excerpt_two_meta_box_text", true );
		?>
		
		<?php
			$page_heading_navigation = ot_get_option( 'page_heading_navigation' );
			if( $page_heading_navigation == "on" or !$page_heading_navigation == "off" ) {
				if( $heading_navigation_hide == "on" or !$heading_navigation_hide == "off" ) {
					eventstation_heading_navigation();
				} else { ?>
				<?php eventstation_no_header_code(); ?>
		<?php
				}
			} else { ?>
				<?php eventstation_no_header_code(); ?>
		<?php } ?>

			<?php eventstation_site_sub_content_start(); ?>
				<?php if( $no_fluid_layout == "on" ) : ?>
					<?php eventstation_container_fluid_before(); ?>
					<?php eventstation_alternative_row_before(); ?>
				<?php endif; ?>
						<?php eventstation_post_content_area_start(); ?>
							<div class="page-content page-list">
								<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>				
									<div class="page-header">
									<?php 
										$page_title = ot_get_option( 'page_title' );
										if( $page_title == "on" or !$page_title == "off" ) {
									?>
										<?php if( $hide_page_title == "on" or !$hide_page_title == "off" ) { ?>
											<h2><?php the_title(); ?></h2>
										<?php } ?>
									<?php } ?>
										<?php
											$page_title_excerpt = ot_get_option( 'page_title_excerpt' );
											if( $page_title_excerpt == "on" or !$page_title_excerpt == "off" ) {
												if( !empty( $post_excerpt_two ) ) {
										?>
												<div class="post-excerpt-two">
													<?php echo esc_attr( $post_excerpt_two ); ?>
												</div>
											<?php } ?>
										<?php } ?>
									</div>									
									
									<div class="page-content-bottom">
										<?php the_content(); ?>
									</div>
									<?php
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'eventstation' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );
										edit_post_link( esc_html__( 'Edit Page', 'eventstation' ), '<span class="edit-link">', '</span>' );
									?>
								</article>
							</div>
					<?php
							$page_comment_area = ot_get_option( 'page_comment_area' );
							if( $page_comment_area == "on" or !$page_comment_area == "off" ) {
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
							}
						?>
						<?php eventstation_content_area_end(); ?>
						
						<?php get_sidebar(); ?> 
						
				<?php if( $no_fluid_layout == "on" ) : ?>
					<?php eventstation_alternative_row_after(); ?>
					<?php eventstation_container_fluid_after(); ?>
				<?php endif; ?>
			<?php eventstation_site_sub_content_end(); ?>
	
	<?php endwhile; ?>
						
<?php get_footer();