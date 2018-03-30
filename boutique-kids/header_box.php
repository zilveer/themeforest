<?php

$queried_object = get_queried_object();
if( $queried_object && !isset($queried_object->ID) && !empty($queried_object->name) && $queried_object->name == 'product' && function_exists('woocommerce_get_page_id') && woocommerce_get_page_id('shop')){
	// manually set woocommerce page id because sometimes it doesn't set if we land on the /shop/ rewrite url
	$queried_object->ID = woocommerce_get_page_id('shop');
}
if ( $queried_object && empty( $queried_object->ID ) && get_option( 'page_on_front' ) ) {
	// default to home page settings if nothing selected.
	// hmm actually we should just display the default settings from the customizer.
	// todo: refactor this so we pass the theme defaults onto the below function without a queried object id
	// for pages like 404 etc..
	$queried_object->ID = get_option( 'page_on_front' );
}

$current_display_option = 1; // inherit by default: todo - move this into theme config area.
$default_text1 = get_bloginfo( 'name' );
$default_text2 = get_bloginfo( 'description' );

if(is_search()) {
	$default_text1 = esc_html__( 'Search Results', 'boutique-kids' );
	$default_text2 = '';
}else if(is_404()){
	$default_text1 = esc_html__( 'Page Not Found', 'boutique-kids' );
	$default_text2 = esc_html__( 'Something Went Wrong', 'boutique-kids' );
}else if(function_exists('is_cart') && is_cart()){
	$default_text1 = esc_html__( 'Shopping Cart', 'boutique-kids' );
	$default_text2 = '';
}else if(function_exists('is_checkout') && is_checkout()){
	$default_text1 = esc_html__( 'Checkout', 'boutique-kids' );
	$default_text2 = '';
}else if(!empty($queried_object->term_id)){
	$queried_object->ID = 'term'.$queried_object->term_id;
	$default_text1 = $queried_object->name;
	$default_text2 = $queried_object->description;
}else{
	$default_text1 = get_the_title();
}

if ( $queried_object && !empty( $queried_object->ID) ) {
	$details = get_post_meta( $queried_object->ID, 'boutique_post_title_details', true );
	if ( ! is_array( $details ) ) {
		$details = array();
	}
	$details            = apply_filters( 'boutique_page_title', $details, $queried_object->ID );
	$default_post_style = get_theme_mod( 'boutique_page_header_display', 1 );
	$current_display_option = empty( $details['display'] ) ? $default_post_style : $details['display'];
	if ( $current_display_option == 3 ) {
		// we hide this header box for ths page.

	} else {
		if ( $current_display_option == 1 ) {
			// we inherit settings from any parent pages
			// (e.g. for a blog post we show the parent 'blog' title)
			if ( ! empty( $queried_object->post_type ) ) {
				switch ( $queried_object->post_type ) {
					case 'post':
						// display data/settings from the parent blog page.
						$post_page_id = get_option( 'page_for_posts' );
						if ( $post_page_id ) {
							$details = get_post_meta( $post_page_id, 'boutique_post_title_details', true );
							if ( ! is_array( $details ) ) {
								$details = array();
							}
							$details                = apply_filters( 'boutique_page_title', $details, $post_page_id );
							$current_display_option = empty( $details['display'] ) ? $default_post_style : $details['display'];
						}
						break;
					case 'product':
						// display data/settings from the parent blog page.
						if(!empty($queried_object->post_parent)){
							$details = get_post_meta( $queried_object->post_parent, 'boutique_post_title_details', true );
							if ( ! is_array( $details ) ) {
								$details = array();
							}
							$details                = apply_filters( 'boutique_page_title', $details, $queried_object->post_parent, $queried_object->ID );
							$current_display_option = empty( $details['display'] ) ? $default_post_style : $details['display'];
						}else if( function_exists('woocommerce_get_page_id') && woocommerce_get_page_id('shop')){
							$details = get_post_meta( woocommerce_get_page_id('shop'), 'boutique_post_title_details', true );
							if ( ! is_array( $details ) ) {
								$details = array();
							}
							$details                = apply_filters( 'boutique_page_title', $details, woocommerce_get_page_id('shop') );
							$current_display_option = empty( $details['display'] ) ? $default_post_style : $details['display'];
						}
						break;
					default:
						if(!empty($queried_object->post_parent)){
							$details = get_post_meta( $queried_object->post_parent, 'boutique_post_title_details', true );
							if ( ! is_array( $details ) ) {
								$details = array();
							}
							$details                = apply_filters( 'boutique_page_title', $details, $queried_object->post_parent, $queried_object->ID );
							$current_display_option = empty( $details['display'] ) ? $default_post_style : $details['display'];
						}
				}
			}else if( !empty($queried_object->name)){

			}
		}
		$default_text1 = isset( $details['text'] ) ? $details['text'] : $default_text1;
		$default_text2 = isset( $details['description'] ) ? $details['description'] : $default_text2;
	}
}
if(!isset($details['breadcrumb'])){
	$details['breadcrumb'] = get_theme_mod( 'boutique_header_show_breadcrumb', 1 );
}
$has_breadcrumb = false;
if ( $current_display_option != 3 ) {
	?>
	<div id="boutique_page_header">
		<?php if(!empty($default_text1) || !empty($default_text2)) { ?>
			<div id="boutique_top_title">
				<h1><?php echo esc_html( $default_text1 ); ?></h1>
				<span></span>
				<h2><?php echo esc_html( $default_text2 ); ?></h2>
			</div>
			<?php
		}
		if ( function_exists( 'breadcrumb_trail' ) && $details['breadcrumb'] ) {
			$has_breadcrumb = true;
			?>
			<div id="boutique_top_breadcrumb" class="inner-wrap">
				<?php breadcrumb_trail(); ?>
			</div>
		<?php } ?>
	</div>
<?php }