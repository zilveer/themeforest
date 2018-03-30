<?php
/**
 * The Link Post Type Template
 */
?>

<?php
if ( is_singular() ) {
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grve-single-post' ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<div id="grve-post-content">
			<?php blade_grve_print_post_simple_title(); ?>
			<?php blade_grve_print_post_image_meta(); ?>
			<?php blade_grve_print_post_date_meta(); ?>
			<div itemprop="articleBody">
				<?php the_content(); ?>
			</div>
		</div>
	</article>

<?php
} else {

	$blog_style = blade_grve_option( 'blog_style', 'large' );
	$grve_post_class = blade_grve_get_post_class( 'grve-label-post' );
	$grve_link = get_post_meta( get_the_ID(), 'grve_post_link_url', true );
	$new_window = get_post_meta( get_the_ID(), 'grve_post_link_new_window', true );

	if( empty( $grve_link ) ) {
		$grve_link = get_permalink();
	}

	$grve_target = '_self';
	if( !empty( $new_window ) ) {
		$grve_target = '_blank';
	}

	$bg_color = blade_grve_post_meta( 'grve_post_link_bg_color', 'primary-1' );
	$bg_hover_color = blade_grve_post_meta( 'grve_post_link_bg_hover_color', 'black' );

	$link_classes = array();
	$link_classes[] = 'grve-bg-' . $bg_color;
	$link_classes[] = 'grve-bg-hover-' . $bg_hover_color;
	$link_class_string = implode( ' ', $link_classes );

	$title_color = 'white';
	$title_hover_color = 'white';
	$title_classes = array( 'grve-post-title' );
	if( 'white' == $bg_color ){
		$title_color = 'black';
	}
	if( 'white' == $bg_hover_color ){
		$title_hover_color = 'black';
	}
	$title_classes[] = 'grve-text-' . $title_color;
	$title_classes[] = 'grve-text-hover-' . $title_hover_color;
	$title_class_string = implode( ' ', $title_classes );

	global $allowedposttags;
	$mytags = $allowedposttags;
	unset($mytags['a']);
	unset($mytags['img']);
	unset($mytags['p']);

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $grve_post_class ); ?> itemscope itemType="http://schema.org/BlogPosting">
		<?php do_action( 'blade_grve_inner_post_loop_item_before' ); ?>
		<a href="<?php echo esc_url( $grve_link ); ?>" target="<?php echo esc_attr( $grve_target ); ?>" class="<?php echo esc_attr( $link_class_string ); ?>" rel="bookmark">
			<?php blade_grve_print_post_image_meta(); ?>
			<?php blade_grve_print_post_date_meta(); ?>
			<?php blade_grve_loop_post_title( $title_class_string ); ?>
			<p itemprop="articleBody"><?php echo wp_kses( get_the_content(), $mytags ); ?></p>
			<div class="grve-subtitle"><?php echo esc_url( $grve_link ); ?></div>
		</a>
		<?php do_action( 'blade_grve_inner_post_loop_item_after' ); ?>

	</article>

<?php

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
