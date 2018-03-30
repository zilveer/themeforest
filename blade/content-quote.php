<?php
/**
 * The Quote Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post grve-post-quote' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<div id="grve-post-content">
			<?php blade_grve_print_post_simple_title(); ?>
			<?php blade_grve_print_post_image_meta(); ?>
			<div itemprop="articleBody">
				<?php the_content(); ?>
			</div>
		</div>
	</article>

<?php
} else {
	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$grve_post_class = blade_grve_get_post_class( 'grve-label-post' );

	$bg_color = blade_grve_post_meta( 'grve_post_quote_bg_color', 'primary-1' );
	$bg_hover_color = blade_grve_post_meta( 'grve_post_quote_bg_hover_color', 'black' );

	$quote_classes = array();
	$quote_classes[] = 'grve-bg-' . $bg_color;
	$quote_classes[] = 'grve-bg-hover-' . $bg_hover_color;
	$quote_class_string = implode( ' ', $quote_classes );

	global $allowedposttags;
	$mytags = $allowedposttags;
	unset($mytags['a']);
	unset($mytags['img']);
	unset($mytags['p']);
	unset($mytags['blockquote']);
?>

	<!-- Article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'blade_grve_inner_post_loop_item_before' ); ?>

		<?php do_action( 'blade_grve_inner_post_loop_item_title_hidden' ); ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="<?php echo esc_attr( $quote_class_string ); ?>" rel="bookmark">
			<?php blade_grve_print_post_image_meta(); ?>
			<p class="grve-blog-quote-text" itemprop="articleBody"><?php echo wp_kses( get_the_content(), $mytags ); ?></p>
			<?php blade_grve_print_post_date(); ?>
			<?php blade_grve_print_post_date_meta( 'fallback' ); ?>
		</a>

		<?php do_action( 'blade_grve_inner_post_loop_item_after' ); ?>
	</article>
	<!-- End Article -->

<?php
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
