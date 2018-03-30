<?php
/**
 * Created by PhpStorm.
 * User: phuongth
 * Date: 2/26/15
 * Time: 4:00 PM
 */


add_filter('widget_categories_args','zorka_widget_categories_args');
function zorka_widget_categories_args($cat_args) {
    include_once( get_template_directory() . '/lib/walkers/zorka-category.php' );
    $cat_args['walker'] = new zorka_Walker_Category;
    return $cat_args;
}


add_filter('post_thumbnail_html','zorka_post_thumbnail_html',99,5);
function zorka_post_thumbnail_html($html,$post_id,$post_thumbnail_id,$size,$attr) {
    global $zorka_archive_loop;
    $arrImages = wp_get_attachment_image_src( $post_thumbnail_id, $size );
    $image = $arrImages[0];

    global $_wp_additional_image_sizes;
    $width = '';
    $height = '';
    if (isset($size) && isset($_wp_additional_image_sizes[$size])) {
        $width = 'width="'. $_wp_additional_image_sizes[$size]['width'].'"';
        $height = 'height="'. $_wp_additional_image_sizes[$size]['height'] .'"';
    }

    if (isset($zorka_archive_loop['image-style']) && $zorka_archive_loop['image-style'] == 'small') {
        return zorka_get_image_hover($image,get_permalink($post_id),get_the_title($post_id),$size);
    }
    $post_type = get_post_type($post_id);

    switch($post_type){
        case "post":{
            $html = zorka_get_image_hover($image,get_permalink($post_id),get_the_title($post_id),$size);
        }
        default :
            return $html;
            break;
    }

    return $html;
}

if (!function_exists('zorka_search_form')) {
    function zorka_search_form( $form ) {
        $form =  '<form role="search" class="zorka-search-form" method="get" id="searchform" action="' . home_url( '/' ) . '">
                <input type="text" value="' . get_search_query() . '" name="s" id="s"  placeholder="'.__("Search...",'zorka').'">
                <button type="submit"><i class="pe-7s-search"></i></button>
     		</form>';
        return $form;
    }
    add_filter( 'get_search_form', 'zorka_search_form' );
}

if (!function_exists('zorka_search_posts_filter')) {
    function zorka_search_posts_filter( $query ){
        if (!is_admin() && $query->is_search && !is_post_type_archive( 'product' )){
            $query->set('post_type',array('post'));
        }
        return $query;
    }
    add_filter('pre_get_posts','zorka_search_posts_filter');
}

/* -----------------------------------------------------------------------------
 * Add Site Title
 * -------------------------------------------------------------------------- */
if ( ! function_exists( 'zorka_wp_title' )) {
    function zorka_wp_title( $title, $sep ) {
        global $paged, $page,$wp_version;

        if (version_compare($wp_version,'4.1','>=')){
            return $title;
        }

        if ( is_feed() ) {
            return $title;
        }

        // Add the site name.
        $title .= get_bloginfo( 'name' );

        // Add the site description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) ) {
            $title = "$title $sep $site_description";
        }

        // Add a page number if necessary.
        if ( $paged >= 2 || $page >= 2 ) {
            $title = "$title $sep " . sprintf( esc_html__('Page %s', 'zorka' ), max( $paged, $page ) );
        }

        return $title;
    }
    add_filter( 'wp_title', 'zorka_wp_title',10,2 );
}


add_filter('wp_generate_tag_cloud', 'zorka_tag_cloud',10,3);

function zorka_tag_cloud($tag_string){
    return preg_replace("/style='font-size:.+pt;'/", '', $tag_string);
}


add_filter( 'script_loader_src', 'zorka_remove_src_version' );
add_filter( 'style_loader_src', 'zorka_remove_src_version' );

function zorka_remove_src_version ( $src ) {
	if ((strpos($src, '.js?') === false) && (strpos($src, '.css?') === false)) {
		return $src;
	}
    $pos_ver = strpos($src,'?');
    if ($pos_ver === false) {
        return $src;
    }
    return substr($src, 0, $pos_ver);
}


add_filter('xmenu_filter_after','zorka_header_menu_search_filter');
function zorka_header_menu_search_filter($arg) {
	global $zorka_data;
	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}

	if (($header_layout == '3') || ($header_layout == '6') || ($header_layout == '7') || ($header_layout == '8') || ($header_layout == '9')) {
		return $arg;
	}

	return '<li class="x-menu-item search-menu"><a class="icon-search-menu" href="#"><span class="pe-7s-search"></span></a></li>';
}

add_filter('xmenu_toggle_inner_after','zorka_header_menu_mobile_search_filter');
add_filter('menu_toggle_inner_after','zorka_header_menu_mobile_search_filter');
function zorka_header_menu_mobile_search_filter($arg) {
	global $zorka_data;
	ob_start();
	?>
	<?php if (isset($zorka_data['show-mini-cart-mobile']) && ($zorka_data['show-mini-cart-mobile'] == '1')): ?>
		<div class="mobile-mini-cart">
			<?php get_template_part('templates/header/mini','cart' ); ?>
		</div>
	<?php endif; ?>
	<?php if (!isset($zorka_data['show-search-button-mobile']) || ($zorka_data['show-search-button-mobile'] == '1')): ?>
		<div class="toggle-inner-search"><a class="icon-search-menu" href="#"><span class="pe-7s-search"></span></a></div>
	<?php endif; ?>
	<?php
	return ob_get_clean();
}

add_filter('xmenu_filter_before','zorka_header_menu_logo_filter');
function zorka_header_menu_logo_filter($arg) {
	global $zorka_data;
	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}
	if (($header_layout == '3') || ($header_layout == '9') || ($header_layout == '5')) {
		return $arg;
	}

	$logo_url = '';
	if (isset($zorka_data['site-logo'])) {
		$logo_url = $zorka_data['site-logo'];
	}

	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}
	switch ($header_layout) {
		case '2':
		case '4':
		case '7':
		case '8':
		case '10':
			if (isset($zorka_data['site-logo-white'])) {
				$logo_url = $zorka_data['site-logo-white'];
			}
			break;
	}

	ob_start();
	?>
	<a  href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" rel="home">
		<img src="<?php echo esc_url($logo_url); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?> - <?php bloginfo( 'description' ); ?>" />
	</a>
	<?php
	$logo_content = ob_get_clean();
	return '<li class="x-menu-item x-menu-item-logo">' . wp_kses_post($logo_content) .'</li>';
}

add_filter('xmenu_filter_before','zorka_header_menu_product_category_filter');
function zorka_header_menu_product_category_filter($arg) {
	global $zorka_data;
	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}
	if (($header_layout != '5')) {
		return $arg;
	}
	$category_content = '';
	$args_product = array(
		'echo' => 0,
		'taxonomy' => 'product_cat',
		'title_li' => ''
	);
	$category_content = wp_list_categories($args_product);

	return '<li class="x-menu-item-product-category"><span class="pe-7s-menu"></span><span class="product-category-text">' . esc_html__('Shop By Categories','zorka') . '</span><ul class="product-category-dropdown">' . wp_kses_post($category_content) .'</ul></li>';
}

add_filter('xmenu_nav_filter_after', 'zorka_xmenu_social_link_after_filter');
function zorka_xmenu_social_link_after_filter($args) {
	global $zorka_data;
	$header_layout = get_post_meta(get_the_ID(),'header-layout',true);
	if (!isset($header_layout) || $header_layout == 'none' || $header_layout == '') {
		$header_layout =  $zorka_data['header-layout'];
	}
	if (($header_layout != '6') && ($header_layout != '7') && ($header_layout != '8')) {
		return $args;
	}

	ob_start();
	get_template_part('templates/header/social','link' );
	return ob_get_clean();
}

add_filter('wp_nav_menu_args','zorka_main_menu_args_filter', 1);
function zorka_main_menu_args_filter($args){
	if (!isset($args['theme_location']) || (($args['theme_location'] != 'primary') && ($args['theme_location'] != 'left'))) {
		return $args;
	}
	ob_start();
	?>
	<div class="nav-menu-toggle-wrapper">
		<div class="nav-menu-toggle-inner">
			<div class="nav-menu-toggle-icon"> <span></span></div> <span><?php esc_html_e('Menu','zorka') ?></span>
		</div>
		<?php echo apply_filters('menu_toggle_inner_after',''); ?>
	</div>
	<?php
	$toggle = ob_get_clean();
	$args['items_wrap'] = wp_kses_post($toggle) .  $args['items_wrap'];
	return $args;
}