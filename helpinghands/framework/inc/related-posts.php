<?php
/**
 * Related Posts
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
 
global $sd_data, $post;

$cats = get_the_category( $post->ID );
?>
<?php if ( $cats ) : ?>
	<div class="sd-related-posts">
		<h3><?php _e( 'RELATED POSTS', 'sd-framework' ); ?></h3>
		<div class="row">
			<?php
				$cat_id = array();
				
				foreach( $cats as $cat ) {
					$cat_id[] = $cat->term_id;	
				}
	
				$args = array(
					'ignore_sticky_posts' => true,
					'category__in'        => $cat_id,
					'post__not_in'        => array( $post->ID ),
					'posts_per_page'      => 3,
					'orderby'             => 'rand',
				);
	
			$sd_query = new WP_Query( $args );
	
			if ( $sd_query->have_posts() ) : while ( $sd_query->have_posts() ) : $sd_query->the_post(); ?>
				
				<div class="col-md-4">
					<h4>
						<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
							<?php the_title(); ?>
						</a>
					</h4>
					<?php 
						$post_cat = get_the_category(); 
						if ( $post_cat[0] ) {
							echo '<span>' . _x( 'in', 'Inside category', 'sd-framework' ) . ' <a href="' . get_category_link($post_cat[0]->term_id ). '" title="' . $post_cat[0]->cat_name . '">' . $post_cat[0]->cat_name . '</a></span>';
						}
					?>
				</div>
					
				
			<?php endwhile; endif;  wp_reset_postdata(); ?>
		</div>
		<!-- row -->
	</div>
	<!-- sd-related-posts -->
<?php endif; ?>