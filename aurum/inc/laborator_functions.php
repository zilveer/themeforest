<?php
/**
 *	Aurum WordPress Theme
 *
 *	Laborator.co
 *	www.laborator.co
 */


# GET/POST getter
function get($var)
{
	return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
}

function lab_get( $var ) {
	return isset($_GET[$var]) ? $_GET[$var] : (isset($_REQUEST[$var]) ? $_REQUEST[$var] : '');
}

function post($var)
{
	return isset($_POST[$var]) ? $_POST[$var] : null;
}

function cookie($var)
{
	return isset($_COOKIE[$var]) ? $_COOKIE[$var] : null;
}


# Generate From-To numbers borders
function generate_from_to($from, $to, $current_page, $max_num_pages, $numbers_to_show = 5)
{
	if($numbers_to_show > $max_num_pages)
		$numbers_to_show = $max_num_pages;


	$add_sub_1 = round($numbers_to_show/2);
	$add_sub_2 = round($numbers_to_show - $add_sub_1);

	$from = $current_page - $add_sub_1;
	$to = $current_page + $add_sub_2;

	$limits_exceeded_l = FALSE;
	$limits_exceeded_r = FALSE;

	if($from < 1)
	{
		$from = 1;
		$limits_exceeded_l = TRUE;
	}

	if($to > $max_num_pages)
	{
		$to = $max_num_pages;
		$limits_exceeded_r = TRUE;
	}


	if($limits_exceeded_l)
	{
		$from = 1;
		$to = $numbers_to_show;
	}
	else
	if($limits_exceeded_r)
	{
		$from = $max_num_pages - $numbers_to_show + 1;
		$to = $max_num_pages;
	}
	else
	{
		$from += 1;
	}

	if($from < 1)
		$from = 1;

	if($to > $max_num_pages)
	{
		$to = $max_num_pages;
	}

	return array($from, $to);
}

# Laborator Pagination
function laborator_show_pagination($current_page, $max_num_pages, $from, $to, $pagination_position = 'full', $numbers_to_show = 5)
{
	$current_page = $current_page ? $current_page : 1;

	?>
	<div class="clear"></div>

	<!-- pagination -->
	<ul class="pagination<?php echo $pagination_position ? " pagination-{$pagination_position}" : ''; ?>">

	<?php if($current_page > 1): ?>
		<li class="first_page"><a href="<?php echo get_pagenum_link(1); ?>"><?php _e('&laquo; First', 'aurum'); ?></a></li>
	<?php endif; ?>

	<?php if($current_page > 2): ?>
		<li class="first_page"><a href="<?php echo get_pagenum_link($current_page - 1); ?>"><?php _e('Previous', 'aurum'); ?></a></li>
	<?php endif; ?>

	<?php

	if($from > floor($numbers_to_show / 2))
	{
		?>
		<li><a href="<?php echo get_pagenum_link(1); ?>"><?php echo 1; ?></a></li>
		<li class="dots"><span>...</span></li>
		<?php
	}

	for($i=$from; $i<=$to; $i++):

		$link_to_page = get_pagenum_link($i);
		$is_active = $current_page == $i;

	?>
		<li<?php echo $is_active ? ' class="active"' : ''; ?>><a href="<?php echo $link_to_page; ?>"><?php echo $i; ?></a></li>
	<?php
	endfor;


	if($max_num_pages > $to)
	{
		if($max_num_pages != $i):
		?>
			<li class="dots"><span>...</span></li>
		<?php
		endif;

		?>
		<li><a href="<?php echo get_pagenum_link($max_num_pages); ?>"><?php echo $max_num_pages; ?></a></li>
		<?php
	}
	?>

	<?php if($current_page + 1 <= $max_num_pages): ?>
		<li class="last_page"><a href="<?php echo get_pagenum_link($current_page + 1); ?>"><?php _e('Next', 'aurum'); ?></a></li>
	<?php endif; ?>

	<?php if($current_page < $max_num_pages): ?>
		<li class="last_page"><a href="<?php echo get_pagenum_link($max_num_pages); ?>"><?php _e('Last &raquo;', 'aurum'); ?></a></li>
	<?php endif; ?>
	</ul>
	<!-- end: pagination -->
	<?php

	# Deprecated (the above function displays pagination)
	if(false):

		posts_nav_link();

	endif;
}



# Get SMOF data
$data_cached            = array();
$smof_filters           = array();
$data                   = function_exists('of_get_options') ? of_get_options() : array();
$data_iteration_count   = 0;

function get_data($var = '')
{
	global $data, $data_cached, $data_iteration_count;

	$data_iteration_count++;

	if( ! function_exists('of_get_options'))
		return null;

	if(isset($data_cached[$var]))
	{
		return apply_filters("get_data_{$var}", $data_cached[$var]);
	}

	if( ! empty($var) && isset($data[$var]))
	{
		$data_cached[$var] = $data[$var];

		return apply_filters("get_data_{$var}", $data[$var]);
	}

	return null;
}


# Compress Text Function
function compress_text($buffer)
{
	/* remove comments */
	$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	/* remove tabs, spaces, newlines, etc. */
	$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '	', '	', '	'), '', $buffer);
	return $buffer;
}


# Load Font Style
function laborator_load_font_style()
{
	global $custom_css;

	$api_url           = '//fonts.googleapis.com/css?family=';

	$font_variants 	   = '300italic,400italic,700italic,300,400,700';

	$primary_font      = 'Roboto:' . $font_variants;
	$secondary_font    = 'Roboto+Condensed:' . $font_variants;

	# Custom Font
	$_font_primary      = get_data('font_primary');
	$_font_secondary    = get_data('font_secondary');

	$primary_font_replaced = $secondary_font_replaced = 0;

	if($_font_primary && $_font_primary != 'none' && $_font_primary != 'Use default')
	{
		$primary_font_replaced = 1;
		$primary_font = $_font_primary . ':' . $font_variants . '';
	}

	if($_font_secondary && $_font_secondary != 'none' && $_font_secondary != 'Use default')
	{
		$secondary_font_replaced = 1;
		$secondary_font = $_font_secondary . ':' . $font_variants;
	}

	$custom_primary_font_url   = get_data('custom_primary_font_url');
	$custom_primary_font_name  = get_data('custom_primary_font_name');

	$custom_heading_font_url   = get_data('custom_heading_font_url');
	$custom_heading_font_name  = get_data('custom_heading_font_name');

	if($custom_primary_font_url && $custom_primary_font_name)
	{
		$primary_font_replaced    = 2;
		$primary_font             = $custom_primary_font_url;
		$_font_primary            = $custom_primary_font_name;
	}

	if($custom_heading_font_url && $custom_heading_font_name)
	{
		$secondary_font_replaced    = 2;
		$secondary_font             = $custom_heading_font_url;
		$_font_secondary            = $custom_heading_font_name;
	}
	
	
	$primary_subset = apply_filters( 'aurum_primary_google_font_subset', 'latin' );
	$secondary_subset = apply_filters( 'aurum_secondary_google_font_subset', 'latin' );
	
	$primary_font .= '&subset=' . $primary_subset;
	$secondary_subset .= '&subset=' . $secondary_subset;

	wp_enqueue_style('primary-font', strstr($primary_font, "://") ? $primary_font : ($api_url . $primary_font));
	wp_enqueue_style('heading-font', strstr($secondary_font, "://") ? $secondary_font : ($api_url . $secondary_font));

	ob_start();

	if($primary_font_replaced):
	?>
	.primary-font,
	body,
	p,
	.view-cart td .btn,
	.woocommerce .cart-bottom-details .shipping_calculator .shipping-calculator-button {
		font-family: <?php echo $primary_font_replaced == 1 ? "'{$_font_primary}', sans-serif" : $_font_primary; ?>;
	}
	<?php
	endif;

	if($secondary_font_replaced):
	?>
	.heading-font,
	header.site-header,
	header.site-header .logo.text-logo a,
	header.mobile-menu .mobile-logo .logo.text-logo a,
	footer.site-footer,
	footer.site-footer .footer-widgets .sidebar.widget_search #searchsubmit.btn-bordered,
	.contact-page .contact-form label,
	.view-cart th,
	.view-cart td,
	.view-cart td.price,
	.login-button,
	.coupon-env .coupon-enter,
	.my-account .my-account-tabs,
	.woocommerce .shop-item .item-info span,
	.woocommerce .quantity.buttons_added input.input-text,
	.shop-item-single .item-details-single.product-type-external .single_add_to_cart_button.button.btn-bordered,
	.shop-item-single .item-info.summary .variations .label,
	.shop-item-single .item-info.summary .variations div.variation-select,
	.shop-item-single .item-info.summary input.add-to-cart,
	.shop-item-single .item-info.summary .price,
	.shop-item-single .item-info.summary form.cart .button,
	.shop-item-single .item-info.summary .product_meta > span,
	.shop-item-single .item-info.summary .product_meta .wcml_currency_switcher,
	.your-order .order-list li,
	section.blog .post .comments .comment + .comment-respond #cancel-comment-reply-link,
	section.blog .post .comments .comment-respond label,
	section.blog .post .comments .comment-respond #submit.btn-bordered,
	section.blog .post-password-form label,
	section.blog .post-password-form input[type="submit"].btn-bordered,
	.sidebar .sidebar-entry,
	.sidebar .sidebar-entry select,
	.sidebar .sidebar-entry.widget_search #searchsubmit.btn-bordered,
	.sidebar .sidebar-entry.widget_product_search #searchsubmit.btn-bordered,
	.sidebar .sidebar-entry.widget_wysija .wysija-submit.btn-bordered,
	.sidebar .sidebar-entry .product_list_widget li > .quantity,
	.sidebar .sidebar-entry .product_list_widget li > .amount,
	.sidebar .sidebar-entry .product_list_widget li .variation,
	.sidebar .sidebar-entry .product_list_widget li .star-rating,
	.sidebar .sidebar-entry.widget_shopping_cart .total,
	.sidebar .sidebar-entry.widget_shopping_cart .buttons .button.btn-bordered,
	.sidebar .sidebar-entry .price_slider_wrapper .price_slider_amount .button.btn-bordered,
	.sidebar .sidebar-list li,
	.bordered-block .lost-password,
	h1,
	h2,
	h3,
	h4,
	h5,
	h6,
	.btn.btn-bordered,
	.dropdown-menu,
	.nav-tabs > li > a,
	.alert,
	.form-control,
	.banner .button_outer .button_inner .banner-content strong,
	.table > thead > tr > th,
	.tooltip-inner,
	.search .search-header,
	.page-container .wpb_content_element.wpb_tabs .ui-tabs .wpb_tabs_nav li a,
	.page-container .wpb_content_element.wpb_tour .wpb_tabs_nav li a,
	.page-container .wpb_content_element.lab_wpb_image_banner .banner-text-content,
	.page-container .wpb_content_element.alert p,
	.page-container .wpb_content_element.lab_wpb_products_carousel .products-loading,
	.page-container .wpb_content_element.lab_wpb_testimonials .testimonials-inner .testimonial-entry .testimonial-blockquote,
	.page-container .feature-tab .title,
	.page-container .vc_progress_bar .vc_single_bar .vc_label,
	.top-menu div.lang-switcher #lang_sel a,
	.top-menu div.currency-switcher .wcml_currency_switcher li,
	.pagination > a,
	.pagination > span,
	.breadcrumb span,
	.woocommerce .page-title small p,
	.woocommerce .commentlist .comment_container .comment-details .meta,
	.woocommerce #review_form_wrapper .comment-form-rating label,
	.woocommerce #review_form_wrapper .form-submit [type="submit"].btn-bordered,
	.woocommerce .shop_attributes th,
	.woocommerce .shop_attributes td,
	.woocommerce dl.variation dt,
	.woocommerce dl.variation dd,
	.woocommerce .cart_totals table tr td,
	.woocommerce .cart_totals table tr th,
	.woocommerce .cross-sells .product-item .product-details .price,
	.woocommerce .order-details-list li,
	.woocommerce .bacs_details li,
	.woocommerce .digital-downloads li .count,
	.woocommerce legend,
	.woocommerce .yith-wcwl-add-to-wishlist .yith-wcwl-add-button .add_to_wishlist.btn-bordered,
	.woocommerce .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a.btn-bordered,
	.woocommerce .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a.btn-bordered,
	.wishlist_table tbody tr .product-stock-status span,
	.wishlist_table tbody tr .add_to_cart.btn-bordered,
	#yith-wcwl-popup-message,
	.shop-empty-cart-page .cart-empty-title p a,
	.woocommerce-message,
	.woocommerce-error,
	.woocommerce-info,
	.woocommerce-message .button.btn-bordered,
	.woocommerce-error .button.btn-bordered,
	.woocommerce-info .button.btn-bordered,
	.header-menu .lab-mini-cart .total {
		font-family: <?php echo $secondary_font_replaced == 1 ? "'{$_font_secondary}', sans-serif" : $_font_secondary; ?>;
	}
	<?php
	endif;
	$custom_css = ob_get_clean();

	if($custom_css)
	{
		$custom_css = compress_text("<style>{$custom_css}</style>");
		add_action('wp_print_scripts', create_function('', 'global $custom_css; echo $custom_css;'));
	}
}


# Show Header Top Bar (depended by position)
function laborator_display_header_top_bar($widget)
{
	global $current_user;

	if(preg_match("/^menu-([0-9]+)/i", $widget, $matches))
	{
		$menu_id = $matches[1];

		wp_nav_menu(
			array(
				'menu'       	=> $menu_id,
				'container'     => 'nav',
				'menu_class'    => '',
				'items_wrap'    => '%3$s'
			)
		);
	}
	else
	if($widget == 'laborator_cart_totals' && function_exists('WC'))
	{
		?>
		<nav>
			<li>
				<a href="<?php echo WC()->cart->get_cart_url(); ?>"><?php echo sprintf(__('Cart totals: <span id="cart-totals">%s</span>', 'aurum'), WC()->cart->get_cart_total()); ?></a>
			</li>
		</nav>
		<?php
	}
	else
	if($widget == 'laborator_social_networks')
 	{
		echo do_shortcode('[lab_social_networks]');
	}
	else
	if($widget == 'laborator_account_links_and_date' && function_exists('WC'))
	{
		$registration_enabled = get_option('woocommerce_enable_myaccount_registration') == 'yes';
		$account_link = get_permalink(wc_get_page_id('myaccount'));

		?>
		<nav>
			<li class="single-entry">
				<?php if($current_user->ID > 0): ?>
					<?php echo sprintf('<a href="%1$s">' . __('My Account Details', 'aurum') . '</a>', $account_link); ?>
				<?php elseif($registration_enabled): ?>
					<?php echo sprintf('<a href="%1$s">' . __('Login', 'aurum') . '</a> ' . __( 'or', 'aurum' ) . ' <a href="%1$s">' . __('Register', 'aurum') . '</a>', $account_link); ?>
				<?php else: ?>
					<?php echo sprintf(__('<a href="%1$s">Customer Login</a>', 'aurum'), $account_link); ?>
				<?php endif; ?>

				<span class="sep">|</span> <span><?php echo date_i18n(get_option('date_format')); ?></span>
			</li>
		</nav>
		<?php
	}
	elseif($widget == 'laborator_current_date' && function_exists('WC'))
	{
		?>
		<nav>
			<li class="single-entry">
				<span class="up"><?php echo date_i18n(get_option('date_format')); ?></span>

			</li>
		</nav>
		<?php
	}
	else
	if($widget == 'wpml_lang_currency_switcher')
	{
		wp_enqueue_script('bootstrap-select');

		?>
		<div class="top-ctr">
			<div class="lang-switcher">
				<?php echo do_action('icl_language_selector'); ?>
			</div>
			<div class="currency-switcher">
				<?php echo do_shortcode('[currency_switcher]'); ?>
			</div>
		</div>
		<?php
	}
	else
	if($widget == 'wpml_lang_switcher')
	{
		?>
		<div class="lang-switcher">
			<?php echo do_action('icl_language_selector'); ?>
		</div>
		<?php
	}
	else
	if($widget == 'wpml_currency_switcher')
	{
		wp_enqueue_script('bootstrap-select');

		?>
		<div class="currency-switcher">
			<?php echo do_shortcode('[currency_switcher]'); ?>
		</div>
		<?php
	}
	else
	if($widget == 'navxt_breadcrubms')
	{
		if(function_exists('bcn_display'))
		{
			echo '<div class="breadcrumb">';
		    bcn_display();
			echo '</div>';
		}
	}
	else
	if( $widget == 'wc_currency_switcher' ) {
		
		?>
		<div class="top-bar-currency-switcher">
			<?php echo do_shortcode( '[woocs width="200px"]' ); ?>
		</div>
		<?php
	}
}



# Share Network Story
function share_story_network_link($network, $id, $simptips = true)
{
	global $post;
	
	$title     = urlencode( get_the_title() );
	$excerpt   = urlencode( aurum_clean_excerpt( get_the_excerpt(), true ) );
	$permalink = urlencode( get_permalink() );
	$url       = urlencode( get_permalink() );


	$networks = array(
		'fb' => array(
			'url'		=> 'https://www.facebook.com/sharer.php?u=' . $permalink,
			'tooltip'	=> __('Facebook', 'aurum'),
			'icon'		=> 'fa-facebook'
		),

		'tw' => array(
			'url'		=> 'https://twitter.com/home?status=' . $title . ' – ' . $permalink,
			'tooltip'	=> __('Twitter', 'aurum'),
			'icon'		 => 'fa-twitter'
		),

		'gp' => array(
			'url'		=> 'https://plus.google.com/share?url=' . $permalink,
			'tooltip'	=> __('Google+', 'aurum'),
			'icon'		 => 'fa-google-plus'
		),

		'tlr' => array(
			'url'		=> 'http://www.tumblr.com/share/link?url=' . $permalink . '&name=' . $title . '&description=' . $excerpt,
			'tooltip'	=> __('Tumblr', 'aurum'),
			'icon'		 => 'fa-tumblr'
		),

		'lin' => array(
			'url'		=> 'https://linkedin.com/shareArticle?mini=true&url=' . $permalink . '&title=' . $title,
			'tooltip'	=> __('LinkedIn', 'aurum'),
			'icon'		 => 'fa-linkedin'
		),

		'pi' => array(
			'url'		=> 'https://pinterest.com/pin/create/button/?url=' . $permalink . '&description=' . urlencode( get_the_title() ) . '&' . ($id ? ('media=' . wp_get_attachment_url( get_post_thumbnail_id($id) )) : ''),
			'tooltip'	=> __('Pinterest', 'aurum'),
			'icon'	 	 => 'fa-pinterest'
		),

		'vk' => array(
			'url'		=> 'https://vkontakte.ru/share.php?url=' . $permalink,
			'tooltip'	=> __('VKontakte', 'aurum'),
			'icon'	 	 => 'fa-vk'
		),

		'em' => array(
			'url'		=> 'mailto:?subject=' . urlencode( get_the_title() ) . '&amp;body=' . get_permalink(),
			'tooltip'	=> __('Email', 'aurum'),
			'icon'		 => 'fa-envelope'
		),
	);

	$network_entry = $networks[ $network ];
	$icon_class = ( strpos( $network_entry['icon'], 'fa-' ) === 0 ? 'fa ' : 'entypo entypo-' ) .  $network_entry['icon'];
	?>
	<a class="<?php echo str_replace( 'fa-', '', $network_entry['icon'] ); ?>" href="<?php echo $network_entry['url']; ?>" target="_blank">
		<?php if ( apply_filters( 'aurum_shop_product_single_share', false ) ) : ?>
		<i class="<?php echo $icon_class; ?>"></i>
		<?php else: ?>
		<?php echo $network_entry['tooltip']; ?>
		<?php endif; ?>
	</a>
	<?php
}


# Page Path
function laborator_page_path($post)
{
	$page_path = array(__('Home', 'aurum'));

	$page_hierarchy = array($post->post_title);

	if($post->post_parent)
	{
		laborator_page_path_recursive($post, $page_hierarchy);
	}

	$page_hierarchy = array_reverse($page_hierarchy);
	$page_path = array_merge($page_path, $page_hierarchy);

	return implode(' &raquo ', $page_path);
}

function laborator_page_path_recursive($post, & $hierarchy)
{
	$parent = get_post($post->post_parent);

	array_push($hierarchy, $parent->post_title);

	if($parent->post_parent)
		laborator_page_path_recursive($parent, $hierarchy);
}


# In case when GET_FIELD function doesn't exists
add_action( 'init', 'aurum_get_field_fn_check' );

function aurum_get_field_fn_check() {
	if ( ! function_exists( 'get_field' ) && ! is_admin() ) {
		function get_field( $field_id, $post_id = null ) {
			global $post;
	
			if(is_numeric($post_id))
				$post = get_post($post_id);
	
			return $post->{$field_id};
		}
	}
}


# Has transparent header
function has_transparent_header()
{
	return get_field('enable_transparent_header');
}



# Get SVG
function lab_get_svg($svg_path, $id = null, $size = array(24, 24), $is_asset = true)
{	
	if($is_asset)
		$svg_path = get_template_directory() . '/assets/' .  $svg_path;

	if( ! $id)
		$id = sanitize_title(basename($svg_path));

	if(is_numeric($size))
		$size = array($size, $size);

	ob_start();

	echo file_get_contents($svg_path);

	$svg = ob_get_clean();

	$svg = preg_replace(
		array(
			'/^.*<svg/s',
			'/id=".*?"/i',
			'/width=".*?"/',
			'/height=".*?"/'
		),
		array(
			'<svg', 'id="'.$id.'"',
			'width="'.$size[0].'px"',
			'height="'.$size[0].'px"'
		),
		$svg
	);

	return $svg;
}



# Check if page is fullwidth
add_action('wp', 'lab_check_fullwidth_page');

function lab_check_fullwidth_page()
{
	global $post;

	if($post && $post->post_type == 'page')
	{
		$is_fullwidth = false;

		if(in_array($post->page_template, array('full-width-page.php')))
			$is_fullwidth = true;
		elseif(get_field('fullwidth_page'))
			$is_fullwidth = true;

		if($is_fullwidth)
		{
			define("IS_FULLWIDTH_PAGE", true);
		}
	}
}

function is_fullwidth_page()
{
	return defined('IS_FULLWIDTH_PAGE');
}



# Less Generator
function aurum_generate_less_style($files = array(), $vars = array())
{
	if( ! class_exists('Less_Parser'))
	{
		include_once THEMEDIR . 'inc/lib/lessphp/Less.php';
	}
	
	# Compile Less
	$less_options = array(
		'compress' => true
	);
	
	$css = '';
	
	try {
		
		$less = new Less_Parser($less_options);
		
		foreach($files as $file => $type)
		{
			if($type == 'parse')
			{
				$css_contents = file_get_contents($file);
				
				# Replace Vars
				foreach($vars as $var => $value)
				{
					if(trim($value))
					{
						$css_contents = preg_replace("/(@{$var}):\s*.*?;/", '$1: ' . $value . ';', $css_contents);
					}
				}
				
				$less->parse($css_contents);
			}
			else
			{
				$less->parseFile($file);
			}
		}
		
		$css = $less->getCss();
	}
	catch(Exception $e){
	}
	
	return $css;
}


function laborator_svg_get_size( $image_path ) {
	
	// SVG Support
	$pathinfo_image = pathinfo( $image_path );
	$extension = pathinfo( $image_path, PATHINFO_EXTENSION );
	
	$image_size = array( 1, 1 );
	
	if ( $extension == 'svg' && function_exists( 'simplexml_load_file' ) ) {
		$svgfile = simplexml_load_file( $image_path );
		
		if ( isset( $svgfile->rect ) ) {
			$width = reset( $svgfile->rect['width'] );
			$height = reset( $svgfile->rect['height'] );
			
			$image_size = array( $width, $height );
		} else {
			$svg_attrs = $svgfile->attributes();
			$image_size = array( intval( $svg_attrs['width'] ), intval( $svg_attrs['height'] ) );
		}
	}
	
	return $image_size;
}


// Immediate Return Function
function laborator_immediate_return_fn( $return ) {
	$return_fn = 'return "' . addslashes( $return ) . '";';
	
	if ( is_numeric( $return ) ) {
		$return_fn = "return {$return};";
	}
	return create_function( '', $return_fn );
}

// Show Cart 
function aurum_show_header_cart_icon( $size = array( 24, 24 ) ) {
	
	if(get_data('header_cart_info') && function_exists('WC')):
		
		$shop_cart_counter_ajax = get_data('shop_cart_counter_ajax');

		$cart_items_count = WC()->cart->get_cart_contents_count();
		$cart_icon = get_data('header_cart_info_icon');

		if( ! $cart_icon)
			$cart_icon = 1;

		if($shop_cart_counter_ajax)
		{
			$cart_items_count = 0;
		}
	?>
	<section class="cart-info">
		<a class="cart-counter<?php echo $cart_items_count ? ' has-notifications' : ''; echo $cart_items_count == 0 ? " cart-zero" : ''; ?>" href="<?php echo WC()->cart->get_cart_url(); ?>">
			<i class="cart-icon"><?php echo lab_get_svg("images/cart_{$cart_icon}.svg", 'cart-info-icon', $size ); ?></i>
			<strong><?php _e('Cart', 'aurum'); ?></strong>
			<span class="badge items-count"><?php echo $cart_items_count; ?></span>
		</a>
	</section>
	<?php
	endif;
}

// Default Value Set for Visual Composer Loop Parameter Type
function aurum_vc_loop_param_set_default_value( & $query, $field, $value = '' ) {
	
	if ( ! preg_match( '/(\|?)' . preg_quote( $field ) . ':/', $query ) ) {
		$query .= "|{$field}:{$value}";
	}
	
	return ltrim( '|', $query );
}

// Laborator Excerpt Clean
function aurum_clean_excerpt( $content, $strip_tags = false ) {
	$content = preg_replace( '#<style.*?>(.*?)</style>#i', '', $content );
	$content = preg_replace( '#<script.*?>(.*?)</script>#i', '', $content );
	return $strip_tags ? strip_tags( $content ) : $content;
}