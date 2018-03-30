<?php // Plumtree Layouts for Themes

add_action( 'add_meta_boxes', 'pt_layouts_metabox' );

add_action( 'save_post', 'pt_layouts_save' );

function pt_layouts_metabox() {
	$screen = 'page';
    add_meta_box( 'layout_id', __( 'Layout Settings', 'plumtree' ), 'pt_layout_metabox_contents', $screen, 'side');
}

function pt_layout_metabox_contents($post) {
	wp_nonce_field( basename( __FILE__ ), 'pt_layout_nonce' );
	// Get theme-supported theme layouts
	$post_layouts = pt_get_default_layouts();

  // Use get_post_meta to retrieve an existing value from the database and use the value for the form
  $current_layout = pt_get_post_layout( $post->ID ); ?>
	<div class="post-layout">
		<p><?php esc_html__( 'Specify a custom page layout for this content.', 'plumtree' ) ?></p>
		<input type="radio" name="pt_post_layout" id="post-layout-default" value="default" <?php checked( $current_layout, "default" )?> />
		<label for="post_layout_default"><?php esc_html_e( 'Default Set in Handy Store Theme Options','plumtree') ?></label><br /><br />
			<?php foreach ( $post_layouts as $layout => $key ) {
				$selected = '';
				if ( $current_layout != '' && ($current_layout == $key['value']) ) {
					$selected = ' of-radio-img-selected';
				} ?>
			<input type="radio" id="post-layout-<?php echo esc_attr( $key['value'] ); ?>" class="of-radio-img-radio" value="<?php echo esc_attr( $key['value'] ); ?>" name="pt_post_layout" <?php checked( $current_layout, $key['value'] ); ?> />
			<div class="of-radio-img-label">post-layout-<?php echo esc_attr( $key['value'] ); ?></div>
			<img src="<?php echo esc_url( $key['icon'] ); ?>" alt="<?php echo esc_attr( $key['label'] ); ?>" class="of-radio-img-img<?php echo esc_attr($selected); ?>" onclick="document.getElementById('<?php echo 'post-layout-'. esc_attr( $key['value'] );?>').checked=true;" />
	<?php }
	echo '</div>';
	echo '<script>jQuery(document).ready(function($) {
		$("#post-layout-default").next().click(function(){
			$(this).parent().find(".of-radio-img-img").removeClass("of-radio-img-selected");
			$(this).parent().find(".of-radio-img-radio").prop("checked", false);
			$(this).parent().find("#post-layout-default").prop("checked", true);
		});
		$(".of-radio-img-img").click(function(){
			$(this).parent().find("#post-layout-default").prop("checked", false);
			$(this).parent().find(".of-radio-img-img").removeClass("of-radio-img-selected");
			$(this).addClass("of-radio-img-selected");
		});
		$(".of-radio-img-label").hide();
		$(".of-radio-img-img").show();
		$(".of-radio-img-radio").hide(); });</script>';
};

function pt_layouts_save ( $post_id) {

	/* Verify the nonce for the post formats meta box. */
	if ( !isset( $_POST['pt_layout_nonce'] ) || !wp_verify_nonce( $_POST['pt_layout_nonce'], basename( __FILE__ ) ) )
		return $post_id;

	if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id))
            return $post_id;
    } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
    };

    $old_layout = pt_get_post_layout( $post_id );
    $new_layout = esc_attr( $_POST["pt_post_layout"]);

    if ($new_layout && $new_layout != $old_layout) {
            update_post_meta( $post_id, '-pt-layout', $new_layout ); }

};

function pt_get_default_layouts() {

	$layouts = get_theme_support( 'plumtree-layouts' );

	if (isset( $layouts[0] )){
		return $layouts[0];
	} else {
		__('Specify some layouts first!', 'plumtree');};
};

function pt_get_post_layout( $post_id ) {
	/* Get the post layout. */
	$layout = get_post_meta( $post_id, '-pt-layout', true );
	/* Return the layout if one is found.  Otherwise, return 'default'. */
	return ( !empty( $layout ) ? $layout : 'default' );
		return $layout;
}

function pt_show_layout() {
	global $wp_query;

	/* Set the layout to default. */
	$layout = 'two-col-right';

	/* Get vendor store pages */
	$vendor_shop = '';
	if ( class_exists('WCV_Vendors') ) {
		$vendor_shop = urldecode( get_query_var( 'vendor_shop' ) );
	}

	/* Page variable */
	$current_page = '';
	// if front page
	if (is_page() && is_front_page()) {
		$current_page = 'front_page';
	}
	// if simple page page
	elseif (is_page()) {
		$current_page = 'page';
	}
	// if single post
	elseif ( is_single() && !( class_exists('Woocommerce') && is_product() ) && !$vendor_shop ) {
		$current_page = 'single_post';
	}
	// if shop page
	elseif ( ( class_exists('Woocommerce') && is_shop() && !$vendor_shop ) ||
			 ( is_archive() && class_exists('Woocommerce') && is_shop() && !$vendor_shop ) ||
			 ( class_exists('Woocommerce') && is_product_category() ) ||
			 ( class_exists('Woocommerce') && is_product_tag() )
		   ) {
		$current_page = 'shop_page';
	}
	// if single product
	elseif ( ( class_exists('Woocommerce') && is_product() ) ||
			 ( is_singular() && class_exists('Woocommerce') && is_product() )
		   ) {
		$current_page = 'single_product';
	}
	// if vendor page
	elseif ( $vendor_shop && $vendor_shop !='' )
		     {
		$current_page = 'vendor_store';
	}
	// if blog pages (blog, archives, search, etc)
	elseif ( is_home() || is_category() || is_tag() || is_tax() || is_archive() || is_search() ) {
		$current_page = 'blog_page';
	}

	/* Get current layout */
	$post_id = $wp_query->get_queried_object_id();
    $current_post_layout = pt_get_post_layout( $post_id );

    /* Global layout options from admin panel */
    $global_shop_layout = (handy_get_option('shop_layout') != '') ? handy_get_option('shop_layout') : 'two-col-right';
    $global_product_layout = (handy_get_option('product_layout') != '') ? handy_get_option('product_layout') : 'two-col-right';
    $global_front_layout = (handy_get_option('front_layout') != '') ? handy_get_option('front_layout') : 'two-col-right';
    $global_page_layout = (handy_get_option('page_layout') != '') ? handy_get_option('page_layout') : 'two-col-right';
    $global_blog_layout = (handy_get_option('blog_layout') != '') ? handy_get_option('blog_layout') : 'two-col-right';
    $global_single_layout = (handy_get_option('single_layout') != '') ? handy_get_option('single_layout') : 'two-col-right';
    $global_vendor_layout = (handy_get_option('vendor_layout') != '') ? handy_get_option('vendor_layout') : 'two-col-right';

	switch ($current_page) {
		case 'front_page':
			if ( isset($global_front_layout) && $global_front_layout == $current_post_layout ) {
				$layout = $current_post_layout;
			} elseif ( isset($global_front_layout) && $current_post_layout === 'default' ) {
				$layout = $global_front_layout;
			} else {
				$layout = $current_post_layout;
			}
			break;
		case 'page':
			if ( isset($global_page_layout) && $global_page_layout == $current_post_layout ) {
				$layout = $current_post_layout;
			} elseif ( isset($global_page_layout) && $current_post_layout === 'default' ) {
				$layout = $global_page_layout;
			} else {
				$layout = $current_post_layout;
			}
			break;
		case 'single_post':
			$layout = $global_single_layout;
			break;
		case 'single_product':
			$layout = $global_product_layout;
			break;
		case 'vendor_store':
			$layout = $global_vendor_layout;
			break;
		case 'shop_page':
			if ( isset($global_shop_layout) && $global_shop_layout == $current_post_layout ) {
				$layout = $current_post_layout;
			} elseif ( isset($global_shop_layout) && $current_post_layout === 'default' ) {
				$layout = $global_shop_layout;
			} else {
				$layout = $current_post_layout;
			}
			break;
		case 'blog_page':
			if ( isset($global_blog_layout) && $global_blog_layout == $current_post_layout ) {
				$layout = $current_post_layout;
			} elseif ( isset($global_blog_layout) && $current_post_layout === 'default' ) {
				$layout = $global_blog_layout;
			} else {
				$layout = $current_post_layout;
			}
			break;
		default:
			$layout = $current_post_layout;
			if ($current_post_layout === 'default') {
				$layout = 'one-col';
			}
	}

	/* Return the layout and allow plugin/theme developers to override it. */
	return esc_attr( apply_filters( 'get_theme_layout', "layout-{$layout}" ) );
}

function pt_layout_body_class( $classes ) {

	/* Adds the layout to array of body classes. */
	$classes[] = sanitize_html_class( pt_show_layout() );

	/* Return the $classes array. */
	return $classes;
}
add_filter( 'body_class', 'pt_layout_body_class' );


function pt_script_enqueue_post($hook) {
    if( 'post.php' != $hook )
        return;
    wp_enqueue_style('pt-theme-options-css', get_template_directory_uri() . '/theme-options/css/optionsframework.css');
}
add_action( 'admin_enqueue_scripts', 'pt_script_enqueue_post' );

function pt_script_enqueue_new_post($hook) {
    if( 'post-new.php' != $hook )
        return;
    wp_enqueue_style('pt-theme-options-css', get_template_directory_uri() . '/theme-options/css/optionsframework.css');
}
add_action( 'admin_enqueue_scripts', 'pt_script_enqueue_new_post' );
