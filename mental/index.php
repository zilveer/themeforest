<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call
?>

<?php get_header(); ?>

<?php if ( get_mental_option( 'show_menubar' ) ) { get_template_part( 'blocks/menubar' ); } ?>

<div id="main" role="main">

	<?php $footer_parallax_effect = ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) )? true : false ; ?>

	<?php if ( $footer_parallax_effect ): ?>
	<div class="parallax-footer">
	<?php endif ?>

	<?php get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ): get_template_part( 'blocks/topmenu' );
	elseif ( get_mental_option( 'show_header' ) ): ?>

		<div id="header">
			<header>
				<h1><?php _e( 'Latest Posts', 'mental' ); ?></h1>
			</header>
		</div>

	<?php endif ?>

	<div class="section">
		<section>
			<div class="container">

				<div class="row blog-list">
					<div class="<?php echo get_mental_option( 'sidebar_show_on', '', 'archive' ) ? 'col-md-8' : 'col-md-12' ?>
						<?php echo ( get_mental_option( 'sidebar_show_on', '', 'archive' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">

						<?php get_template_part( 'blocks/loop' ); ?>

						<?php the_mental_pagination(); ?>

					</div>
					<?php if ( get_mental_option( 'sidebar_show_on', '', 'archive' ) ): ?>
						<div
							class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
							<?php get_template_part( 'sidebar' ) ?>
						</div>
					<?php endif ?>
				</div>

			</div>
			<!-- container -->
		</section>
	</div>
	<!-- section -->

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>

	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
