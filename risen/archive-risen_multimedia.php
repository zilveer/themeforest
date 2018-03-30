<?php
/*
 * Multimedia Date Archives
 *
 * This shows archives by year, month and day:
 *
 * /multimedia-items (all - redirects to page using Multimedia template)
 * /multimedia-items/2012 (year)
 * /multimedia-items/2012/01 (month)
 * /multimedia-items/2012/01/01 (day)
 *
 * Note that date archives are not supported in WordPress 3.3 (when this them was made) so this feature was added (refer to functions.php).
 * Thanks to MillaN at Dev4Press: http://www.dev4press.com/2012/tutorials/wordpress/practical/url-rewriting-custom-post-types-date-archive/
 *
 * Posts per page is set with option_posts_per_page filter (see functions.php), not by modifying query here.
 * Refer to this for reason: http://wordpress.org/support/topic/custom-post-type-taxonomy-pagination
 */

// Redirect to page using Multimedia template if no year/month/date used in URL
// This is to avoid duplicate content (and template version allows content at top, featured image, etc.)
$multimedia_page = risen_get_page_by_template( 'tpl-multimedia.php' );
if ( ! empty( $multimedia_page->ID ) && ! is_year() && ! is_month() && ! is_day() ) {
	$multimedia_page_url = get_permalink( $multimedia_page->ID );
	wp_redirect( $multimedia_page_url, 301 );
	exit;
}

// Get ID of page with Multimedia template
$tpl_page_id = risen_get_page_id_by_template( 'tpl-multimedia.php' );

// Header
get_template_part( 'header', 'multimedia-archive');

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'multimedia', $tpl_page_id ) ) : ?> class="has-sidebar"<?php endif; ?>>

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
					if ( ! empty( $date ) ) { // this is a year, month or day archive
						$title = str_ireplace( '[date]', $date, risen_option( 'multimedia_archive_title' ) ); // title format from Theme Options						
					} else { // this is not a year, month or date archive (this will not be necessary if the Multimedia page template is used)
						$title = ! empty( $multimedia_page->post_title ) ? $multimedia_page->post_title : risen_option( 'multimedia_word_plural' ); // if no Multimedia page, use value on theme options
					}					
					echo apply_filters( 'the_title', $title );
					
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>

			<?php get_template_part( 'loop', 'multimedia' ); // loop and show each item ?>

			<?php risen_posts_nav( false, sprintf( _x( '<span>&larr;</span> Newer %s', 'multimedia plural', 'risen' ), risen_option( 'multimedia_word_plural' ) ), sprintf( _x( 'Older %s <span>&rarr;</span>', 'multimedia plural', 'risen' ), risen_option( 'multimedia_word_plural' ) ) ); ?>
				
			<?php if ( ! have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no items to show.', 'risen' ); ?></p>
			<?php endif; ?>

		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'multimedia', $tpl_page_id ); ?>

<?php get_footer(); ?>