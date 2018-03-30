<?php
$meta = get_post_meta( $post->ID, 'stream', true );
?>

<section id="<?php echo $post->post_name; ?>">
		
	<div class="section-inner <?php esc_attr_e( retro_text_color( $post->ID ) ); ?>" style="background-color: <?php esc_attr_e( retro_get_background_color( $post->ID ) ); ?>">

		<?php if ( isset( $meta['kind'] ) && $meta['kind'] == 'slider' ) : ?>

			<?php get_template_part( 'part', 'slider' ); ?>

		<?php elseif ( isset( $meta['kind'] ) && $meta['kind'] == 'about' ) : ?>

			<?php get_template_part( 'part', 'about' ); ?>			

		<?php elseif ( isset( $meta['kind'] ) && $meta['kind'] == 'contact' ) : ?>

			<?php get_template_part( 'part', 'contact' ); ?>				
		
		<?php elseif ( isset( $meta['kind'] ) && $meta['kind'] == 'stream' ) : ?>

			<?php if ( isset( $meta['fetch'] ) && $meta['fetch'] == 'portfolio' ) {

				if ( isset( $meta['portfolio'] ) ) {
					
					$id = (int) $meta['portfolio'];
					
					$retro_portfolio_args = array(
						'portfolio_id' => $id,
						'post_type' => 'portfolio-' . $id,
						'posts_per_page' => op_theme_opt( 'portfolio-number' )
					);
									
					require( locate_template( 'part-portfolio.php' ) );

				}
				
			}

			?>

			<?php if ( isset( $meta['fetch'] ) && $meta['fetch'] == 'article' ) { 

				$retro_blog_args = array(
					'posts_per_page' => op_theme_opt( 'article-number' )
				);

				$retro_blog_query = new WP_Query( $retro_blog_args );

				?>

				<hr class="top-dashed"> 

				<div class="container">

					<div class="row clear">
						
						<?php get_template_part( 'section', 'title' ); ?>

					</div><!-- row -->

					<div class="clear">

						<div class="blog-list col col-12 tablet-full mobile-full">

							<?php if ( $retro_blog_query->have_posts() ) : ?>

							    <ul class="row clear">

									<?php while ( $retro_blog_query->have_posts() ) : ?>
									    
									<?php $retro_blog_query->the_post(); ?>

									<?php get_template_part( 'part', 'article' ); ?>

									<?php endwhile; ?>

							    </ul>

							    <?php if ( is_page_template( 'template-home.php' ) ) : ?>
							    
							    	<div class="more-posts">

							    		<a href="<?php echo esc_url( ( $i = get_option('page_for_posts') ) ? get_permalink( $i ) : home_url('/') ); ?>"><?php _e( 'Show all posts', 'openframe' ); ?></a>
							    	
							    	</div>
							    
							    <?php endif; ?>	

							<?php endif; ?>

						</div> 

					</div>     

				</div>

				<hr class="bottom-dashed"> 

				<?php wp_reset_postdata(); ?>

			<?php } ?>

		<?php else : ?>

			<hr class="top-dashed"> 

			<div class="container">

				<div class="row clear">
					
					<?php get_template_part( 'section', 'title' ); ?>

				</div><!-- row -->

				<?php the_content(); ?>

			</div>
			
			<hr class="bottom-dashed"> 

		<?php endif; ?>

	</div>

</section>