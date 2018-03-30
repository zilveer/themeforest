<?php
/**
 * The template for displaying Author posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package omni
 */

global $crum_set__blog_image_size;
global $crum_set__blog_style;

$blog_style           = cs_get_customize_option( 'blog_style' );
$crum_set__blog_style = $blog_style;

if ( empty( $blog_style ) ) {
	$blog_style = 'large-list';
}

if ( 'two-columns' === $blog_style ) {
	$columns_number = cs_get_customize_option( 'grid_columns' );

	if ( null === $columns_number ) {
		$columns_number = '2';
	}
	set_query_var( 'columns_number', $columns_number );
}

$page_sidebar = cs_get_customize_option( 'archive_sidebar' );

if ( isset( $page_sidebar ) && ( 'left' === $page_sidebar ) ) {
	$sidebar_class = 'pull-right';
} else {
	$sidebar_class = '';
}
$posts_animation = cs_get_customize_option( 'blog_posts_animation' );
if ( isset( $posts_animation ) && ! ( 'none' === $posts_animation ) ) {
	$animation_class = 'wow ' . $posts_animation;
} else {
	$animation_class = '';
}
$show_date         = cs_get_customize_option( 'blog_date_display' );
$show_meta         = cs_get_customize_option( 'blog_meta_display' );
$show_excerpt      = cs_get_customize_option( 'blog_excerpt_display' );
$blog_excerpt_type = cs_get_customize_option( 'blog_excerpt_type' );
$excerpt_length    = cs_get_customize_option( 'excerpt_length' );

set_query_var( 'posts_animation', $animation_class );
set_query_var( 'show_date', $show_date );
set_query_var( 'show_meta', $show_meta );
set_query_var( 'show_excerpt', $show_excerpt );
set_query_var( 'blog_excerpt_type', $blog_excerpt_type );
set_query_var( 'excerpt_length', $excerpt_length );

get_header(); ?>

<section class="blog-section">
	<div class="container">
		<div class="new-block">
			<header class="row page-tagline">
				<div class="col-md-6 col-md-offset-3">
					<?php
					the_archive_title( '<h1 class="title">', '</h1>' );
					?>
				</div>
			</header>
			<!-- .page-header -->
			<div class="row">
				<?php if ( isset( $page_sidebar ) && ( 'none' === $page_sidebar ) ) { ?>

				<div id="content" class="col-md-12 col-sm-12 col-xs-12">

					<?php } else { ?>

					<div id="content" class="col-md-8 col-sm-8 col-xs-12 <?php echo esc_attr( $sidebar_class ); ?>">

						<?php } ?>

						<?php get_template_part( 'template-parts/authorbox' ); ?>

						<?php if ( have_posts() ) : ?>

							<?php if ( 'two-columns' === $blog_style ) {
								echo '<div class="grid row">';
							} ?>
							<?php /* Start the Loop */ ?>
							<?php while ( have_posts() ) : the_post(); ?>

								<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */

								$format = get_post_format();
								if ( false === $format ) {
									$format = 'standard';
								}

								get_template_part( 'post-formats/format', $format );

								?>

							<?php endwhile; ?>

							<?php if ( 'two-columns' === $blog_style ) {
								echo '</div>';
							} ?>

							<?php crum_posts_navigation(); ?>

						<?php else : ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>

					</div>
					<!-- end content -->

					<?php if ( ! ( 'none' === $page_sidebar ) ) {
						get_sidebar();
					} ?>
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>
</section><!-- end blog-section -->

<?php get_footer(); ?>
