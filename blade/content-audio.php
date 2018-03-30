<?php
/**
 * The Audio Post Type Template
 */
?>

<?php
if ( is_singular() ) {
	$grve_disable_media = blade_grve_post_meta( 'grve_disable_media' );
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php
			if ( 'yes' != $grve_disable_media ) {
		?>
		<div id="grve-single-media">
			<div class="grve-container">
				<?php blade_grve_print_post_audio(); ?>
			</div>
		</div>
		<?php
			}
		?>
		<div id="grve-post-content">
			<?php blade_grve_print_post_simple_title(); ?>
			<div itemprop="articleBody">
				<?php the_content(); ?>
			</div>
		</div>

	</article>

<?php
} else {
	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$grve_post_class = blade_grve_get_post_class();
?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'blade_grve_inner_post_loop_item_before' ); ?>
		<?php blade_grve_print_post_feature_media( 'audio' ); ?>
		<div class="grve-post-content">
			<?php blade_grve_print_post_date_meta( 'fallback' ); ?>
			<?php blade_grve_print_post_meta_top(); ?>
			<?php do_action( 'blade_grve_inner_post_loop_item_title_link' ); ?>
			<div itemprop="articleBody">
				<?php blade_grve_print_post_excerpt(); ?>
			</div>
			<?php blade_grve_print_post_meta_bottom(); ?>
		</div>
		<?php do_action( 'blade_grve_inner_post_loop_item_after' ); ?>
	</article>
	<!-- End Article -->

<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
