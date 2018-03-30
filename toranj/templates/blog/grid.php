<?php
/**
 *  grid blog template
 * 
 * @package toranj
 * @author owwwlab
 */
?>

<!-- Page main wrapper -->
<div id="main-content" class="blog-grid dark-template">

	<!-- Page sidebar -->
	<div class="page-side">
		<div class="inner-wrapper vcenter-wrapper">
			<div class="side-content vcenter">
				<div class="title">
					<?php
					if( get_option('page_for_posts') ) {
						$blog_page_id = get_option('page_for_posts');
						echo get_the_title($blog_page_id);
					}else{
						_e('Blog', 'toranj');
					}
					?>
				</div>
				<?php echo ot_get_option('grid_blog_sidebar_content',''); ?>
			</div>
		</div>
	</div>
	<!-- /Page sidebar -->

	<!-- Page main content-->
	<div class="page-main blog-list">

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
		
		<div class="grid-blog-list">
			<?php 
			if ( have_posts() ) : while( have_posts() ) : the_post();

				include(locate_template(OWLAB_TEMPLATES . '/blog/format.php'));

			endwhile; endif; 
			?>
		</div><!--/ grid-blog-list -->

		<div id="columns-separator"></div>
		
		<?php owlab_blog_grid_paging_nav(); ?>

	</div><!-- /page-main blog-list-->

</div><!-- /main-content -->