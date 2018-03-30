<?php /* template name: Portfolio Page */ ?>

<?php get_header(); ?>

<?php get_template_part( 'nav' ); ?>

<main role="main">

	<section>

		<div class="section-inner <?php esc_attr_e( retro_text_color( $post->ID ) ); ?>" style="background-color: <?php esc_attr_e( retro_get_background_color( $post->ID ) ); ?>; <?php if ( isset( $image ) ) echo 'background-image: url(' . $image . ');'; ?>">


			<?php get_template_part( 'part', 'portfolio' ); ?>

		</div>

	</section>

</main>

<?php get_footer(); ?>