<?php
/**
 * Portfolio archive grid layout
 *
 * @package		WordPress
 * @subpackage	Experience
 * @since		Experience 1.0
 **/ 

// Save theme options array to variable for use in this file
$experience_theme_array = experience_get_options();

if ( have_posts() ) : ?>			
	
	<?php // Get grid width setting
	if ( 
		isset( $experience_theme_array['portfolio-grid-width'] )
		&& $experience_theme_array['portfolio-grid-width'] == 'narrow-width'
	) {
		$grid_width = 'narrow-width';
	} elseif (
		isset( $experience_theme_array['portfolio-grid-width'] )
		&& $experience_theme_array['portfolio-grid-width'] == 'site-width'
	){
		$grid_width = 'site-width';
	} else {
		$grid_width = '';
	} ?>
	
	<!-- BEGIN .post-grid -->
	<div class="post-grid portfolio-grid post-container clearfix <?php echo esc_attr( $grid_width ); ?>">
	
		<?php while ( have_posts() ) : the_post(); ?>
			
			<?php // Set colour scheme
			if ( get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true ) != "" ) {		
				$color_scheme = 'color-scheme-'. get_post_meta( $post->ID, 'experience_portfolio_item_preview_color_scheme', true );
			} else {
				$color_scheme = '';
			} ?>
			
			<!-- BEGIN .post-grid-item -->
			<article class="post-grid-item ajax-item <?php echo esc_attr( $color_scheme ); ?>" ontouchstart="">
			
				<div class="post-grid-item-image">
				
					<?php // Background Image
					if ( has_post_thumbnail() ) {
						$background_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'experience-post-grid' );
						$background_image = $background_image[0];
					} else {
						$background_image = false;
					}					
					
					experience_get_background(	$background_image );?>		
				
				</div>
				
				<div class="post-grid-item-content">
					
					<span class="post-grid-item-content-bg"></span>
					
					<div class="holder">
					
						<div class="cont">
							
							<?php if ( $experience_theme_array['portfolio-grid-hide-title'] != '1' ) { ?>
								<h2><?php the_title(); ?></h2>
							<?php } ?>

						</div>							
					
					</div>					
					
					<div class="holder">
					
						<div class="cont">
							
							<?php if ( $experience_theme_array['portfolio-grid-link-type'] == 'title' ) { ?>
								<a href="<?php the_permalink(); ?>"><h2><?php the_title(); ?></h2></a>
							<?php } else { ?>
								<a class="vc_btn3" href="<?php the_permalink(); ?>"><?php esc_html_e( "View", 'experience' ); ?></a>							
							<?php } ?>
							
						</div>							
					
					</div>
					
				</div>
				
			</article>
			<!-- END .post-grid-item -->
			
		<?php endwhile; ?>
		
	</div>

<?php else :

	echo '<p>'. esc_html__( "There are no posts to display.", 'experience' ).'</p>';

endif;