<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header(); 

// Get Options
$layout = ot_get_option( $dd_sn . 'archives_layout', 'fc' );

// Set vars
$dd_count = 0;
$dd_max_count = 4;

// Set vars (with sidebar)
if ( $layout == 'cs' ) {
	
	// In page vars
	$content_class = 'two-thirds column ';
	$blog_posts_class = 'blog-posts blog-listing blog-listing-style-2';
	$has_sidebar = true;

	// Template vars (globals)
	$dd_post_class = '';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '2';

// Set vars (without sidebar)
} else {

	// In page vars
	$content_class = '';
	$blog_posts_class = 'blog-posts blog-listing';
	$has_sidebar = false;

	// Template vars (globals)
	$dd_post_class = 'four columns ';
	$dd_thumb_size = 'dd-one-fourth';
	$dd_style = '1';

}

if ( is_tax( 'dd_causes_cats' ) ) {

	/**
	 * Causes - Options based on the parent listing options
	 */

	$parent_listing_id = dd_get_post_id( 'template', 'template-dd_causes.php' );

	$parent_listing_layout = get_post_meta( $parent_listing_id, $dd_sn . 'layout', true );
	$parent_listing_post_width = get_post_meta( $parent_listing_id, $dd_sn . 'post_width', true );

	if ( $layout == 'cs' ) {
		$blog_posts_class = 'causes causes-listing causes-listing-style-2';
	} else {
		$blog_posts_class = 'causes causes-listing';
	}

	// Set vars (with sidebar)
	if ( $parent_listing_layout == 'cs' ) {

		// In page vars
		$content_class = 'two-thirds column ';
		$blog_posts_class = 'causes causes-listing causes-listing-style-2';
		$has_sidebar = true;

		// Template vars (globals)
		$dd_post_class = '';
		$dd_thumb_size = 'dd-one-fourth';
		$dd_style = '2';

	// Set vars (without sidebar)
	} else {

		// In page vars
		$content_class = '';
		$blog_posts_class = 'causes causes-listing';
		$has_sidebar = false;

		// Template vars (globals)
		
		if ( $parent_listing_post_width == 'one_half' ) {
			$dd_post_class = 'eight columns ';
			$dd_thumb_size = 'dd-one-half';
			$dd_max_count = 2;
		} elseif ( $parent_listing_post_width == 'one_third' ) {
			$dd_post_class = 'one-third column ';
			$dd_thumb_size = 'dd-one-third';
			$dd_max_count = 3;
		} elseif ( $parent_listing_post_width == 'one_fourth' ) {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
			$dd_max_count = 4;
		} else {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
		}

		$dd_style = '1';

	}

} elseif ( is_tax( 'dd_staff_cats' ) ) {

	/**
	 * Staff - Options based on the parent listing options
	 */

	$parent_listing_id = dd_get_post_id( 'template', 'template-dd_staff.php' );

	$parent_listing_layout = get_post_meta( $parent_listing_id, $dd_sn . 'layout', true );
	$parent_listing_post_width = get_post_meta( $parent_listing_id, $dd_sn . 'post_width', true );

	if ( $parent_listing_layout == 'cs' ) {

		// In page vars
		$content_class = 'two-thirds column ';
		$blog_posts_class = 'staff-members staff-members-listing staff-members-listing-style-2';
		$has_sidebar = true;

		// Template vars (globals)
		$dd_post_class = '';
		$dd_thumb_size = 'dd-one-fourth';
		$dd_style = '2';

	} else {
		
		// In page vars
		$content_class = '';
		$blog_posts_class = 'staff-members staff-members-listing';
		$has_sidebar = false;

		// Template vars (globals)

		if ( $parent_listing_post_width == 'one_half' ) {
			$dd_post_class = 'eight columns ';
			$dd_thumb_size = 'dd-one-half';
			$dd_max_count = 2;
		} elseif ( $parent_listing_post_width == 'one_third' ) {
			$dd_post_class = 'one-third column ';
			$dd_thumb_size = 'dd-one-third';
			$dd_max_count = 3;
		} elseif ( $parent_listing_post_width == 'one_fourth' ) {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
			$dd_max_count = 4;
		} else {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
		}

		$dd_style = '1';

	}

} elseif ( get_post_type() == 'post' ) {

	/**
	 * Blog - Options based on the parent listing options
	 */

	$parent_listing_id = dd_get_post_id( 'template', 'template-blog.php' );

	$parent_listing_layout = get_post_meta( $parent_listing_id, $dd_sn . 'layout', true );
	$parent_listing_post_width = get_post_meta( $parent_listing_id, $dd_sn . 'post_width', true );

	if ( $parent_listing_layout == 'cs' ) {

		// In page vars
		$content_class = 'two-thirds column ';
		$blog_posts_class = 'blog-posts blog-posts-listing blog-listing-style-2';
		$has_sidebar = true;

		// Template vars (globals)
		$dd_post_class = '';
		$dd_thumb_size = 'dd-one-fourth';
		$dd_style = '2';

	} else {
		
		// In page vars
		$content_class = '';
		$blog_posts_class = 'blog-posts blog-posts-listing';
		$has_sidebar = false;

		// Template vars (globals)

		if ( $parent_listing_post_width == 'one_half' ) {
			$dd_post_class = 'eight columns ';
			$dd_thumb_size = 'dd-one-half';
			$dd_max_count = 2;
		} elseif ( $parent_listing_post_width == 'one_third' ) {
			$dd_post_class = 'one-third column ';
			$dd_thumb_size = 'dd-one-third';
			$dd_max_count = 3;
		} elseif ( $parent_listing_post_width == 'one_fourth' ) {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
			$dd_max_count = 4;
		} else {
			$dd_post_class = 'four columns ';
			$dd_thumb_size = 'dd-one-fourth';
		}

		$dd_style = '1';

	}

}



?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<div class="<?php echo $blog_posts_class; ?> clearfix">

				<?php

					if ( have_posts()) : while ( have_posts()) : the_post(); $dd_count++;
						
						if ( get_post_type() == 'dd_causes' ) {
							get_template_part( 'templates/causes' );
						} elseif ( get_post_type() == 'dd_staff' ) {
							get_template_part( 'templates/staff-members' );
						} else {
							get_template_part( 'templates/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
						}

					endwhile; else:

						?><div class="align-center"><?php _e( 'This archive is empty.', 'dd_string' ); ?></div><?php

					endif;

				?>

			</div><!-- .blog-posts -->

			<?php dd_theme_pagination();  ?>

		</div><!-- #content -->
	
		<?php 
			if ( $has_sidebar ) {

				if ( is_tax( 'dd_staff_cats' ) ) {
					get_sidebar( 'staff' );
				} elseif ( is_tax( 'dd_causes_cats' ) ) {
					get_sidebar( 'causes' );
				} else {
					get_sidebar();
				}

			}
		?>
		
	</div><!-- .container -->

<?php get_footer(); ?>