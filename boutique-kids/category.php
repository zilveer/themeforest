<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<!-- boutique template: category.php ! -->
<div id="primary">
	<div id="content" role="main">

		<?php if ( function_exists( 'breadcrumb_trail' ) && apply_filters( 'boutique_show_category_breadcrumb', true ) ) {
			breadcrumb_trail();
		} 
		if ( have_posts() ) :

			if ( apply_filters( 'boutique_show_category_title', true ) ) {
				?>

				<div class="page-header">
					<?php do_action( 'boutique_page_header_before' ); ?>
					<h1 class="page-title"><?php
						printf( esc_html__( 'Category: %s', 'boutique-kids' ), '<span>' . single_cat_title( '', false ) . '</span>' );
						?></h1>
					<?php do_action( 'boutique_page_header_after' ); ?>
				</div>

				<?php
			}
			// See if there is a category featured image.
			if ( function_exists( 'dtbaker_featured_image_url' ) && apply_filters( 'boutique_show_category_image', true ) ) {
				$url = dtbaker_featured_image_url( array( 'size' => 'large' ) );
				if ( ! empty( $url ) ) {
					?>
					<div class="category_image">
						<div class="dtbaker_photo_border">
							<div><img src="<?php echo esc_attr( $url ); ?>"/></div>
						</div>
					</div>
					<?php
				}
			}
			$category_description = category_description();
			if ( ! empty( $category_description ) && apply_filters( 'boutique_show_category_description', true ) ) {
				echo wp_kses_post( apply_filters( 'category_archive_meta', '<div class="page_title_text category-archive-meta">' . $category_description . '</div>' ) );
			}

			/* boutique_content_nav( 'nav-above' ); */

			/* Start the Loop */

			while ( have_posts() ) : the_post(); ?>

				<?php
				/*
			Include the Post-Format-specific template for the content.
				 * If you want to overload this in a child theme then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

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

	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>
