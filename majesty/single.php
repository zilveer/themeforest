<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage majesty
 * @since majesty 1.0
 */
 
get_header(); ?>

	<div class="padding-100">	
		<div class="container">
			<div class="row">
				<?php
					$post_layout = get_post_meta( get_the_ID(), '_sama_post_layout', true );
					$css = 'col-md-9';
					if ( $post_layout == 'leftsidebar' ) {
						get_sidebar();
					}
					if ( $post_layout == 'fullwidth' ) {
						$css = 'col-md-12';
					}
				?>
				<main id="main" class="site-main">
					<div class="blog-main-content <?php echo esc_attr( $css ); ?>">
						<?php 
							if ( have_posts() ) :
							
								while ( have_posts() ) : the_post();
							
									get_template_part( 'content', get_post_format() );
									
									// Pagination  FOR NEXT AND PERVIOUS POST
									sama_post_nav();
									
									if ( comments_open() || get_comments_number() ) {
										comments_template();
									}
									
								endwhile;
								
							else :
							
								get_template_part( 'content', 'none' );
							
							endif;
						?>
					</div>
				</main>
				<?php 
					if ( $post_layout == 'rightsidebar' || $post_layout == '2sidebar' || empty( $post_layout ) ) {
						get_sidebar();
					}
				?>
			</div>
		</div>
	</div>	
	<!-- # Content End #  -->
<?php get_footer(); ?>