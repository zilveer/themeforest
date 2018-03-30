<?php

get_header();

?>
<div class="container">

	<div class="<?php echo esc_attr( barcelona_row_class() ); ?>">

		<main id="main" class="<?php echo esc_attr( barcelona_main_class() ); ?>">
		<?php

			$barcelona_mod_post_meta = barcelona_get_option( 'post_meta_choices' );

			include( locate_template( 'includes/modules/module-'. barcelona_get_option( 'posts_layout' ) .'.php' ) );

			barcelona_pagination( barcelona_get_option( 'pagination' ) );

		?>
		</main>

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</div><!-- .container -->
<?php

get_footer();