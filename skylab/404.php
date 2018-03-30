<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */

get_header(); ?>
	<?php $header_background_for_blog = ot_get_option( 'header_background_for_blog' ); ?>
	<?php if ( ! empty( $header_background_for_blog ) ) { ?>
	<?php $parallax_header_background_for_blog = ot_get_option( 'parallax_header_background_for_blog' ); ?>
	<div class="entry-header-wrapper" style="background-image: url(<?php echo esc_url( $header_background_for_blog ); ?>);" <?php if ( ! empty( $parallax_header_background_for_blog ) ) { ?>data-600-top="background-position:50% 75%;" data--600-top="background-position:50% 25%;" data-smooth-scrolling="on"<?php } ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php _e( 'Not Found', 'mega' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } else { ?>
		<div class="entry-header-wrapper">
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php _e( 'Not Found', 'mega' ); ?></h1>
		</header><!-- .entry-header -->
	</div>
	<?php } ?>

	<div id="main" class="clearfix">

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location.', 'mega' ); ?></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
	
<?php get_footer(); ?>