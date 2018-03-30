<?php
/*
 * The template for displaying Blog Posts
 */

global $custom_query;

if ( isset( $custom_query->query['blog_style'] ) ) {
	$blog_style = $custom_query->query['blog_style'];
} else {
	$blog_style = media_center_blog_style();
}

get_header(); 
?>
<!-- ============================================================= SECTION - BLOG ============================================================= -->
<section id="blog">
	<div class="container inner-top-xs inner-bottom-xs no-sidebar">
		<div class="row">
			
			<div class="col-md-9 center-block">
				
				<?php

					if ( $blog_style == 'grid-view' ) {
						get_template_part( 'templates/blog-style/style-grid' );
					} else if( $blog_style == 'list-view' ) {
						get_template_part( 'templates/blog-style/style-list' );
					} else {
						get_template_part( 'templates/blog-style/style-normal' );
					}
				
					media_center_blog_pagination( 'nav-below' ); 
				?>

			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-class -->
</section><!-- /#blog -->
<!-- ============================================================= SECTION - BLOG : END ============================================================= -->
<?php get_footer();