<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Listify
 */

get_header(); ?>

	<div <?php echo apply_filters( 'listify_cover', 'page-cover' ); ?>>
		<div class="cover-wrapper">
			<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'listify' ); ?></h1>
		</div>
	</div>

	<div id="primary" class="container">
		<div class="row content-area">

			<main id="main" class="site-main col-md-10 col-md-offset-1 col-xs-12" role="main">

				<?php get_template_part( 'content', 'none' ); ?>

			</main>

		</div>
	</div>

<?php get_footer(); ?>
