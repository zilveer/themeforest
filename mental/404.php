<?php
/**
 * The template for displaying 404 pages (Not Found)
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

	<?php if ( ! get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/mobile-header' ) ?>

	<?php if ( get_mental_option( 'show_topmenu' ) ) get_template_part( 'blocks/topmenu' ); ?>

	<?php if ( get_mental_option( 'show_header' ) ): ?>

		<?php azl_get_template_part('blocks/header', '', array('title' => __( 'Page not found', 'mental' ))); ?>

	<?php endif ?>

	<div class="section">
		<section>
			<div class="container">

				<div class="<?php echo ( get_mental_option( 'sidebar_show_on', '', '404' ) ? 'col-md-8' : 'col-md-12' ) ?>
					<?php echo ( get_mental_option( 'sidebar_show_on', '', '404' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">
					<h2>
						<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'mental' ); ?></a>
					</h2>
				</div>

				<?php if ( get_mental_option( 'sidebar_show_on', '', '404' ) ): ?>
					<div
						class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
						<?php get_template_part( 'sidebar' ) ?>
					</div>
				<?php endif ?>

			</div>
	   </section>
   </div>

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>
<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
