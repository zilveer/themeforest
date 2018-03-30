<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @package Pile
 * @since   Pile 1.0
 */

get_header();

// ensure we have the right postdata
wp_reset_postdata(); ?>

<div id="djaxHero" class="djax-updatable djax--hidden"></div>

<?php do_action( 'pile_djax_container_start' ); ?>

	<div class="content-404">
		<h1 class="hN"><?php _e( 'Whoops!', 'pile' ); ?></h1>

		<p class="description"><?php printf( __( "The page you're looking for could have been deleted or never have existed*", 'pile' ), home_url() ); ?></p>
		<a class="return-home" href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ) ?>" rel="home">
			<?php printf( __( '&#8592; Return to the Home Page', 'pile' ), home_url() ); ?>
		</a>
	</div>
	<p class="description second"><?php printf( __( '*but you can hit space bar for another GIF', 'pile' ), home_url() ); ?></p>
	<div class="overlay overlay--color"></div>
	<div class="overlay overlay--shadow"></div>

<?php do_action( 'pile_djax_container_end' );

get_footer();