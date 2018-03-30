<?php
/*
 * Blog Archive Template (Year, Month or Day)
 */
 
// Get ID of page with Multimedia template
$tpl_page_id = risen_get_page_id_by_template( 'tpl-blog.php' );

// Header
get_template_part( 'header', 'blog-archive');

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'blog', $tpl_page_id ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<header class="title-with-right">
				<h1 class="page-title">
					<?php

					// If a year, month of day is used, form the date
					if ( is_day() ) {
						$date = @get_the_date(); // @ to suppress error if date is incorrect (such a URL using a future date w/no posts)
					} else if ( is_month() ) {
						$date = @get_the_date( _x( 'F Y', 'monthly archives date format', 'risen' ) );
					} else if ( is_year() ) {
						$date = @get_the_date( _x( 'Y', 'yearly archives date format', 'risen' ) );
					}
					
					// Output the page title
					$title = str_ireplace( '[date]', $date, risen_option( 'blog_archive_title' ) ); // title format from Theme Options						
					echo apply_filters( 'the_title', $title );
					
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>

			<?php get_template_part( 'loop', 'blog' ); // loop and show each item ?>

			<?php risen_posts_nav( false, __( '<span>&larr;</span> Newer Posts', 'risen' ), __( 'Older Posts <span>&rarr;</span>', 'risen' ) ); // prev/next page links ?>
				
			<?php if ( ! have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no posts for this date.', 'risen' ); ?></p>
			<?php endif; ?>

		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'blog', $tpl_page_id ); ?>

<?php get_footer(); ?>