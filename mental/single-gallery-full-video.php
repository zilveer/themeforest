<?php
/**
 * Single Gallery item template for video format
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

	<div class="section st-no-padding">
		<section>

			<div class="container-fullwidth-video container-fullheight">

				<?php if ( have_posts() ): the_post(); ?>

					<?php echo get_post_video( get_the_content() ) ?>

				<?php endif ?>

			</div>

		</section>
	</div>
	<!-- section -->

</div> <!-- main -->

<?php get_footer(); ?>

