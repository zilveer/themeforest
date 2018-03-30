<?php 
/**
 * The template for displaying all pages
 *
 * @package Houzez
 * @since 	Houzez 1.0
 * @author  Waqas Riaz
**/
global $post;
$sticky_sidebar = houzez_option('sticky_sidebar');
?>

<?php get_header(); ?>
	<?php get_template_part( 'template-parts/page', 'title' ); ?>

	<section class="section-detail-content default-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
					<div class="page-main">
						<div class="article-detail">
							<?php
							// Start the loop.
							while ( have_posts() ) : the_post();

								// Include the page content template.
								get_template_part( 'content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

								// End the loop.
							endwhile;
							?>
						</div>
					</div>
				</div>

				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 container-sidebar <?php if( isset( $sticky_sidebar['page_sidebar'] ) && $sticky_sidebar['page_sidebar'] != 0 ){ echo 'houzez_sticky'; }?>">
					<aside id="sidebar" class="sidebar-white">
						<?php
						if( is_active_sidebar( 'page-sidebar' ) ) {
							dynamic_sidebar( 'page-sidebar' );
						}
						?>
					</aside>
				</div>

			</div>
		</div>
	</section>

<?php get_footer(); ?>