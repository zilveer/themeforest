<?php
/**
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

get_header();

$pagetitle = sprintf( __( 'Search Results for: &ldquo;%s&rdquo;', 'thb_text_domain' ), '<span>' . get_search_query() . '</span>' );

?>

<div class="wrapper">

	<header class="pageheader">
		<h1><?php echo $pagetitle; ?></h1>
	</header>

	<?php thb_page_before(); ?>

	<?php thb_page_start(); ?>

	<?php
		if( have_posts()) : ?>
		<?php
			get_template_part("loop/search");
		else : ?>

		<div class="thb-text">
			<p class="sorry"><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'thb_text_domain' ); ?></p>
			<div class="search_404">
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>

	<?php thb_page_end(); ?>

	<?php thb_page_after(); ?>

	<?php thb_archives_sidebar(); ?>

</div>

<?php get_footer(); ?>