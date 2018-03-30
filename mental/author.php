<?php
/**
 * The template for displaying Author archive pages
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

		<?php
			if ( have_posts() ): the_post();
				$title = __( 'Author Archives for ', 'mental' ).get_the_author();
				rewind_posts();
				azl_get_template_part('blocks/header', '', array('title' => $title));
			endif;
		?>

	<?php else: ?>

		<div class="section">
			<section>
				<div class="container text-center">
					<?php if ( have_posts() ): the_post(); ?>

						<h1><?php _e( 'Author Archives for ', 'mental' );
							echo get_the_author(); ?></h1>

						<?php if ( get_the_author_meta( 'description' ) ) : ?>

							<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>

							<h2><?php _e( 'About ', 'mental' );
								echo get_the_author(); ?></h2>

							<?php echo wpautop( get_the_author_meta( 'description' ) ); ?>

						<?php endif; ?>
						<?php rewind_posts(); ?>

					<?php endif; ?>
				</div>
			</section>
		</div>

	<?php endif ?>

	<div class="section">
		<section>
			<div class="container">

				<div class="row blog-list">
					<div class="<?php echo get_mental_option( 'sidebar_show_on', '', 'author' ) ? 'col-md-8' : 'col-md-12' ?>
						<?php echo ( get_mental_option( 'sidebar_show_on', '', 'author' ) && get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-push-4' : '' ?>">

						<?php get_template_part( 'blocks/loop' ); ?>

						<?php the_mental_pagination(); ?>

					</div>
					<?php if ( get_mental_option( 'sidebar_show_on', '', 'author' ) ): ?>
						<div class="col-md-3 <?php echo ( get_mental_option( 'sidebar_position' ) == 'left' ) ? 'col-md-pull-8' : 'col-md-offset-1' ?>">
							<?php get_template_part( 'sidebar' ); ?>
						</div>
					<?php endif ?>
				</div>

			</div><!-- container -->
		</section>
	</div><!-- section -->

<?php if ( $footer_parallax_effect ): ?>
	</div>
<?php endif ?>
	<?php if ( get_mental_option( 'footer_show' ) ) get_template_part( 'blocks/widget-footer' ) ?>

</div> <!-- main -->

<?php get_footer(); ?>
