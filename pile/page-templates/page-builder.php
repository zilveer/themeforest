<?php
/**
 * Template Name: Page Builder
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header();

$current_post = get_post();

$builder_meta = get_post_meta( $current_post->ID, '_pile_page_builder', true );

$builder_meta = json_decode( $builder_meta );
$order        = 0;

// Let there be heroes
// we add the "page" param so that one can create a template-parts/hero-page.php in a child theme and to use that instead
get_template_part( 'template-parts/hero', 'page' );

$has_image = has_post_thumbnail();

do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content wrapper">
		<div class="content-width">

			<?php do_action('pile_page_custom_css');

			if ( post_password_required() ) {

				echo get_the_password_form();

			} else {
				get_template_part( 'template-parts/content-builder' );
			}

			/* Restore original Post Data */
			wp_reset_postdata(); ?>

		</div><!-- .container.cf -->
	</div><!-- .site-content -->
<?php

do_action('pile_djax_container_end' );

get_footer();