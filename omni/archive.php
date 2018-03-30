<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

global $crum_set__blog_image_size;
global $crum_set__blog_style;

get_header();

$crum_set__blog_style = cs_get_customize_option( 'blog_style' );
$page_sidebar         = cs_get_customize_option( 'archive_sidebar' );

$blog_page_meta = get_post_meta( get_the_ID(), '_custom_page_options', true );

$posts_animation = cs_get_customize_option( 'blog_posts_animation' );
if ( isset( $blog_page_meta['meta_blog_posts_animation'] ) && ! empty( $blog_page_meta['meta_blog_posts_animation'] ) && ! ( 'default' === $blog_page_meta['meta_blog_posts_animation'] ) ) {
	$posts_animation = $blog_page_meta['meta_blog_posts_animation'];
}
if ( isset( $posts_animation ) && ! ( 'none' === $posts_animation ) ) {
	$animation_class = 'wow ' . $posts_animation;
} else {
	$animation_class = '';
}

$show_date = cs_get_customize_option( 'blog_date_display' );
if ( isset( $blog_page_meta['meta_show_date'] ) && ! empty( $blog_page_meta['meta_show_date'] ) && ! ( 'default' === $blog_page_meta['meta_show_date'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_date'] ) {
		$show_date = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_date'] ) {
		$show_date = false;
	}
}

$show_meta = cs_get_customize_option( 'blog_meta_display' );
if ( isset( $blog_page_meta['meta_show_meta'] ) && ! empty( $blog_page_meta['meta_show_meta'] ) && ! ( 'default' === $blog_page_meta['meta_show_meta'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_meta'] ) {
		$show_meta = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_meta'] ) {
		$show_meta = false;
	}
}

$show_excerpt = cs_get_customize_option( 'blog_excerpt_display' );
if ( isset( $blog_page_meta['meta_show_excerpt'] ) && ! empty( $blog_page_meta['meta_show_excerpt'] ) && ! ( 'default' === $blog_page_meta['meta_show_excerpt'] ) ) {
	if ( 'enable' === $blog_page_meta['meta_show_excerpt'] ) {
		$show_excerpt = true;
	} elseif ( 'disable' === $blog_page_meta['meta_show_excerpt'] ) {
		$show_excerpt = false;
	}
}

$blog_excerpt_type = cs_get_customize_option( 'blog_excerpt_type' );

$excerpt_length = cs_get_customize_option( 'excerpt_length' );
if ( isset( $blog_page_meta['meta_excerpt_length'] ) && ! empty( $blog_page_meta['meta_excerpt_length'] ) && ! ( 'default' === $blog_page_meta['meta_excerpt_length'] ) ) {
	$excerpt_length = $blog_page_meta['meta_excerpt_length'];
}


if ( 'full' === $crum_set__blog_style ) {
	$content_width             = 1040;
	$crum_set__blog_image_size = 'large';
}
if ( 'image-side' === $crum_set__blog_style ) {
	$content_width             = 1040;
	$crum_set__blog_image_size = 'medium';
} elseif ( 'none' === $page_sidebar ) {
	$content_width             = 1140;
	$crum_set__blog_image_size = 'large';
} else {
	$crum_set__blog_image_size = 'medium';
}

set_query_var( 'posts_animation', $animation_class );
set_query_var( 'show_date', $show_date );
set_query_var( 'show_meta', $show_meta );
set_query_var( 'show_excerpt', $show_excerpt );
set_query_var( 'blog_excerpt_type', $blog_excerpt_type );
set_query_var( 'excerpt_length', $excerpt_length );


if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}

?>

<div class="container blog-container">
	<div class="new-block">

		<header class="row page-tagline">
			<div class="col-md-6 col-md-offset-3">
				<?php
				the_archive_title( '<h1 class="title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</div>
		</header>
		<!-- .page-header -->

		<div class="row">

			<?php
			if ( ( 'none' === $page_sidebar ) && isset( $page_sidebar ) ) {

				echo '<div class=" col-md-12 col-sm-12 col-xs-12">';

			} else {

				echo '<div class=" col-md-8 blog-content-column ' . esc_attr( $sidebar_class ) . '">';
			} ?>

			<div id="primary" class="content-area">
				<main id="main" class="site-main" role="main">
					<?php if ( have_posts() ) : ?>

						<?php if ( is_home() && ! is_front_page() ) : ?>
							<header>
								<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
							</header>
						<?php endif; ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called format-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							$format = get_post_format();
							if ( false === $format ) {
								$format = 'standard';
							}

							get_template_part( 'post-formats/format', $format );
							?>

						<?php endwhile; ?>

						<?php crum_posts_navigation(); ?>

					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>

				</main>
				<!-- #main -->
			</div>
			<!-- #primary -->

			<?php echo '</div>'; ?>

			<!-- end content -->

			<?php
			if ( 'none' !== $page_sidebar ) {
				get_sidebar();
			}
			?>
			<div class="clear"></div>
		</div>
		<!-- end row -->
	</div>
	<!-- end container -->
</div><!-- end blog-section -->

<?php get_footer(); ?>
