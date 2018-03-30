<?php
/**
 * @package WordPress
 * @subpackage Chocolate
 */

get_header();
?>

<?php get_sidebar(); ?>

<?php if ( have_posts() ) : ?>

	<div class="article_box col_l">
		<div class="article_t"></div>
		<div class="article search_title">
			<h1 class="page-title search_title"><?php printf( __( 'Search Results for: %s', LANGUAGE_ZONE ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</div>
		<div class="article_b"></div>
	</div>

	<div id="content">
		<div id="multicol">

		<?php
		global $paged, $post, $wp_query;
		$paged = $wp_query->query_vars['paged'];
		?> 

		<?php while ( have_posts() ) : the_post(); ?>

		<?php
		switch( $post->post_type ) {

			case 'dt_gallery_plus': 
				get_template_part('gallery-plus-album-display');
				if ( post_password_required() ) {
					break;
				}
				get_template_part('gallery-plus-photos-display');
				break;

			case 'dt_portfolio':
				$GLOBALS['is_portfolio'] = 1;
				get_template_part('portfolio-album-display');
				$GLOBALS['is_portfolio'] = 0;
				break;

			default:
				get_template_part('content', 'blog');
		}
		?>

		<?php endwhile; ?>

		</div>

		<?php dt_pagenavi(); ?>

	</div>

<?php else : ?>

	<div class="article_box col_l">
		<div class="article_t"></div>
		<div class="article search_title">
			<h1 class="page-title"><?php _e( 'Nothing Found', LANGUAGE_ZONE ); ?></h1>
		</div>
		<div class="article_b"></div>
	</div>

<?php endif; ?>

<?php get_footer(); ?>