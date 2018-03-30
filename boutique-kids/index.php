<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage boutique
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<!-- boutique template: index.php -->
<?php
// show the text from the current page.
$queried_object = get_queried_object();
if ( $queried_object && isset( $queried_object->ID ) && $queried_object->ID > 0 && $queried_object->ID == get_option( 'page_for_posts' ) ) {
	global $post;
	$args = array( 'p' => $queried_object->ID );
	$post = get_post( $queried_object->ID );
	setup_postdata( $post );
	// $page = get_page(get_option('page_for_posts'));
	// if(strlen(trim($page->post_content))>0){
	if ( is_callable( 'boutique_page_metabox::get_page_style' ) && boutique_page_metabox::get_page_style( $queried_object->ID ) == 4 ) {
		// hide the heading
	} else {
		do_action( 'boutique_page_header_before' );
		?> <h1><?php
			the_title();
			// echo htmlspecialchars($page->post_title);?></h1>
		<?php // echo do_shortcode($page->post_content);
		do_action( 'boutique_page_header_after' );
	}
	$content = get_the_content();
	if ( strlen( trim( $content ) ) ) {
		?> <div class="page_title_text"> <?php
		the_content();
		?>
		</div>
		<?php

	}
}

if ( have_posts() ) : ?>

<?php // boutique_content_nav( 'nav-above' ); ?>

<?php /* Start the Loop */ ?>
<div id="the-loop">
<?php while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?>
</div>
<div class="clear"></div>
<?php boutique_content_nav( 'nav-below' ); ?>

<?php else : ?>

<div id="post-0" class="post no-results not-found">
    <div class="entry-header">
        <h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'boutique-kids' ); ?></h1>
    </div><!-- .entry-header -->

    <div class="entry-content">
        <p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'boutique-kids' ); ?></p>
        <?php get_search_form(); ?>
    </div><!-- .entry-content -->
</div><!-- #post-0 -->

<?php endif; ?>

<?php get_footer(); ?>
