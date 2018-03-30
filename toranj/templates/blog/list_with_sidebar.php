<?php
/**
 *  Simple list with sidebar template for blog
 * 
 * @package toranj
 * @author owwwlab
 */
?>
<!-- page main wrapper -->
<div id="main-content" class="blog-list"> <!-- attention to the classname -->
	<div class="page-wrapper regular-page">
		<div class="container">

			<!-- page title -->
			<div class="row mb-medium">
				<div class="col-md-12">
					<h2 class="section-title double-title">
						<?php
						if( get_option('page_for_posts') ) {
							$blog_page_id = get_option('page_for_posts');
							echo get_the_title($blog_page_id);
						}else{
							_e('Blog', 'toranj');
						}
						?>
					</h2>
				</div>
			</div>
			<!--/ page title -->

			<div class="row mb-large">

				<!-- main blog list content -->
				<div class="col-md-8" role="main">

					<?php if ( is_category() ):?>
					<div class="filtered-list">
						<i class="fa fa-folder"></i>&nbsp;
						<?php printf( __( 'Category Archives for %s', 'toranj' ), single_cat_title( '', false ) );?>
					</div>
					<?php elseif ( is_tag() ): ?>
					<div class="filtered-list">
						<i class="fa fa-tag"></i>&nbsp;
						<?php printf( __( 'Tag Archives for %s', 'toranj' ), single_tag_title( '', false ) );?>
					</div>
					<?php elseif ( is_author() ): ?>
					<div class="filtered-list">
						<i class="fa fa-user"></i>&nbsp;
						<?php printf( __( 'All posts by %s', 'toranj' ), get_the_author() ); ?>
					</div>
					<?php elseif ( is_archive() ): ?>
					<div class="filtered-list">
						<i class="fa fa-clock-o"></i>&nbsp;
						<?php if ( is_day() ) {
							printf( __( 'Daily Archives for %s', 'toranj' ), get_the_date() );
						} elseif ( is_month() ) {
							printf( __( 'Monthly Archives for %s', 'toranj' ), get_the_date( _x( 'F Y', 'Monthly archives date format', 'toranj' ) ) );
						} elseif ( is_year() ) {
							printf( __( 'Yearly Archives for %s', 'toranj' ), get_the_date( _x( 'Y', 'Yearly archives date format', 'toranj' ) ) );
						} else {
							_e( 'Archives', 'toranj' );
						}?>
					</div>
					<?php endif; ?>

					
					<?php 
					if ( have_posts() ) : while( have_posts() ) : the_post();

						include(locate_template(OWLAB_TEMPLATES . '/blog/format.php'));

					endwhile; endif; 
					?>
				</div>
				<!-- /main blog list content -->

				<div class="col-md-4" role="complementary">
					<?php dynamic_sidebar( 'sidebar-1' ); ?>
				</div>

			</div>

			<div class="row">
				<div class="col-md-12">
					
					<!-- blog navigation -->
					<hr/>
					<?php owlab_blog_grid_paging_nav(); ?>
					<!--/ blog navigation -->

					<!-- back to top -->
					<hr/>
					<a class="back-to-top" href="#"></a>
					<!-- back to top -->
					
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page main wrapper -->