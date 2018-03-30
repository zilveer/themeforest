<?php

$main_tag   = 'h1';
$style_attr = '';
$blog_id    = absint( get_option( 'page_for_posts' ) );
$shop_id = absint( get_option( 'woocommerce_shop_page_id', 0 ) );

// custom bg
$bg_id = get_the_ID();

if ( is_home() || is_singular( 'post' ) ) {
	$bg_id = $blog_id;
}

// woocommerce
if ( is_woocommerce_active() && is_woocommerce() ) {
	$bg_id = $shop_id;
}

$style_array = array();

if ( get_field( 'background_image', $bg_id ) ) {
	$style_array = array(
		'background-image'      => get_field( 'background_image', $bg_id ),
		'background-position'   => get_field( 'background_image_horizontal_position', $bg_id ) . ' ' . get_field( 'background_image_vertical_position', $bg_id ),
		'background-repeat'     => get_field( 'background_image_repeat', $bg_id ),
		'background-attachment' => get_field( 'background_image_attachment', $bg_id ),
	);
}

$style_array['background-color'] = get_field( 'background_color', $bg_id );

$style_attr = buildpress_create_style_attr( $style_array );

?>
<div class="main-title<?php echo( 'small-title-area' === get_theme_mod( 'main_title_mode', 'big-title-area' ) ? '  main-title--small' : '' ) ?>"<?php echo $style_attr; ?>>
	<div class="container">
		<?php
		$subtitle = false;

		if ( is_home() || ( is_single() && 'post' === get_post_type() ) ) {
			$title    = get_the_title( $blog_id );
			$subtitle = get_field( 'subtitle', $blog_id );

			if ( is_single() ) {
				$main_tag = 'h2';
			}
		} elseif ( is_category() ) {
			$title = __( 'Category' , 'buildpress_wp') . ': ' . single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = __( 'Tag' , 'buildpress_wp') . ': ' . single_tag_title( '', false );
		} elseif ( is_search() ) {
			$title = __( 'Search Results For' , 'buildpress_wp') . ' &quot;' . get_search_query() . '&quot;';
		} elseif ( is_404() ) {
			$title = __( 'Error 404' , 'buildpress_wp');
		} elseif ( 'portfolio' == get_post_type() ) {
			if ( 'generic-title' === get_theme_mod( 'projects_title_mode', 'generic-title' ) ) {
				$title    = get_theme_mod( 'projects_title', 'Projects' );
			} else {
				$title    = get_the_title();
			}
			$subtitle = get_theme_mod( 'projects_subtitle', 'WHAT WE HAVE DONE SO FAR' );

		} elseif ( is_woocommerce_active() && is_woocommerce() ) {
			ob_start();
			woocommerce_page_title();
			$title    = ob_get_clean();
			$subtitle = get_field( 'subtitle', (int)get_option( 'woocommerce_shop_page_id' ) );

			if ( is_product() ) {
				$main_tag = 'h2';
			}

		} else {
			$title    = get_the_title();
			$subtitle = get_field( 'subtitle' );
		}

		?>
		<<?php echo $main_tag; ?> class="main-title__primary"><?php echo $title; ?></<?php echo $main_tag; ?>>

		<?php if ( $subtitle ): ?>
			<h3 class="main-title__secondary"><?php echo $subtitle; ?></h3>
		<?php endif; ?>

	</div>
</div>