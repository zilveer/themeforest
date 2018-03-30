<?php

	/**********************************************************************
	***********************************************************************
	COUPON FUNCTIONS
	**********************************************************************/
load_theme_textdomain('couponxl', get_template_directory() . '/languages');

function couponxl_set_start_offer(){
	global $wpdb;
	$current_version = 35;
	$version = get_option( 'couponxl_version' );
	if( empty( $version ) ){
		$version = 0;
	}

	if( $version < 22 ){
		$wpdb->query( "DELETE FROM {$wpdb->postmeta} WHERE meta_key = 'offer_start' AND ( meta_value = '' OR meta_value = '-1' )" );
		$results = $wpdb->get_results( "SELECT posts.ID AS ID FROM {$wpdb->posts} as posts WHERE posts.post_type = 'offer' AND posts.ID NOT IN ( SELECT post_id FROM {$wpdb->postmeta} as postmeta WHERE postmeta.meta_key = 'offer_start' AND postmeta.meta_value != '-1' )" );
		if( !empty( $results ) ){
			foreach( $results as $result ){
				update_post_meta( $result->ID, "offer_start", current_time( 'timestamp' ) );
			}
		}
		$results = $wpdb->get_results( "SELECT posts.ID AS ID FROM {$wpdb->posts} as posts WHERE posts.post_type = 'offer' AND posts.ID NOT IN ( SELECT post_id FROM {$wpdb->postmeta} as postmeta WHERE postmeta.meta_key = 'offer_expire' AND ( postmeta.meta_value != '-1' OR postmeta.meta_value = '-1' ) )" );
		if( !empty( $results ) ){
			foreach( $results as $result ){
				update_post_meta( $result->ID, "offer_expire", '-1' );
			}
		}
	}

	if( $version < 28 ){
		$wpdb->query( "UPDATE {$wpdb->postmeta} SET meta_value = '99999999999' WHERE meta_key = 'offer_expire' AND meta_value = -1" );
	}

	update_option( 'couponxl_version', $current_version );
}
add_action( 'init', 'couponxl_set_start_offer' );


function couponxl_requred_plugins(){
	$plugins = array(
		array(
				'name'                 => esc_html__( 'Redux Options', 'couponxl' ),
				'slug'                 => 'redux-framework',
				'source'               => get_template_directory() . '/lib/plugins/redux-framework.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => esc_html__( 'Smeta', 'couponxl' ),
				'slug'                 => 'smeta',
				'source'               => get_template_directory() . '/lib/plugins/smeta.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => esc_html__( 'Social Connect', 'couponxl' ),
				'slug'                 => 'social-connect',
				'source'               => get_template_directory() . '/lib/plugins/social-connect.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => esc_html__( 'User Avatars', 'couponxl' ),
				'slug'                 => 'wp-user-avatar',
				'source'               => get_template_directory() . '/lib/plugins/wp-user-avatar.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => esc_html__( 'CouponXL CPT', 'couponxl' ),
				'slug'                 => 'couponxl-cpt',
				'source'               => get_template_directory() . '/lib/plugins/couponxl-cpt.zip',
				'required'             => true,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => '',
		),
		array(
				'name'                 => esc_html__( 'Envato Market', 'couponxl' ),
				'slug'                 => 'envato-market',
				'source'			   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required'             => false,
				'version'              => '',
				'force_activation'     => false,
				'force_deactivation'   => false,
				'external_url'         => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
			'domain'           => 'couponxl',
			'default_path'     => '',
			'parent_menu_slug' => 'themes.php',
			'parent_url_slug'  => 'themes.php',
			'menu'             => 'install-required-plugins',
			'has_notices'      => true,
			'is_automatic'     => false,
			'message'          => ''
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'couponxl_requred_plugins' );

if (!isset($content_width)){
	$content_width = 1920;
}

/* do shortcodes in the excerpt */
add_filter('the_excerpt', 'do_shortcode');


/* include custom made widgets */
function couponxl_widgets_init(){
	
	register_sidebar(array(
		'name' => __('Blog Sidebar', 'couponxl') ,
		'id' => 'sidebar-blog',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the right side of the blog.', 'couponxl')
	));
	
	register_sidebar(array(
		'name' => __('Page Sidebar Right', 'couponxl') ,
		'id' => 'sidebar-right',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the right side of the page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Page Sidebar Left', 'couponxl') ,
		'id' => 'sidebar-left',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the left side of the page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Coupon Page Sidebar', 'couponxl') ,
		'id' => 'sidebar-coupon',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the left side of the coupon listing page.', 'couponxl')
	));	

	register_sidebar(array(
		'name' => __('Deal Page Sidebar', 'couponxl') ,
		'id' => 'sidebar-deal',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the left side of the deal listing page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Offer Sidebar', 'couponxl') ,
		'id' => 'sidebar-offer',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the right side of the offer single page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Popular Page Sidebar', 'couponxl') ,
		'id' => 'sidebar-popular',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the left side of the popular listing page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Search Sidebar', 'couponxl') ,
		'id' => 'sidebar-search',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears on the left side of the search page.', 'couponxl')
	));	
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 1', 'couponxl') ,
		'id' => 'sidebar-bottom-1',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears at the bottom of the page.', 'couponxl')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 2', 'couponxl') ,
		'id' => 'sidebar-bottom-2',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears at the bottom of the page.', 'couponxl')
	));
	
	register_sidebar(array(
		'name' => __('Bottom Sidebar 3', 'couponxl') ,
		'id' => 'sidebar-bottom-3',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Appears at the bottom of the page.', 'couponxl')
	));

	register_sidebar(array(
		'name' => __('Home Sidebar 1', 'couponxl') ,
		'id' => 'home-sidebar-1',
		'before_widget' => '<div class="widget white-block %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
		'description' => __('Used for the widget area on home page.', 'couponxl')
	));	

	$home_sidebars = couponxl_get_option( 'home_sidebars' );
	if( empty( $home_sidebars ) ){
		$home_sidebars = 2;
	}

	for( $i=1; $i <= $home_sidebars; $i++ ){
		register_sidebar(array(
			'name' => __('Home Sidebar ', 'couponxl').$i,
			'id' => 'home-sidebar-'.$i,
			'before_widget' => '<div class="widget white-block %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
			'description' => __('Used for the widget area on home page.', 'couponxl')
		));
	}	

	$mega_menu_sidebars = couponxl_get_option( 'mega_menu_sidebars' );
	if( empty( $mega_menu_sidebars ) ){
		$mega_menu_sidebars = 5;
	}

	for( $i=1; $i <= $mega_menu_sidebars; $i++ ){
		register_sidebar(array(
			'name' => __('Mega Menu Sidebar ', 'couponxl').$i,
			'id' => 'mega-menu-'.$i,
			'before_widget' => '<li class="widget white-block %2$s">',
			'after_widget' => '</li>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
			'description' => __('This will be shown as the dropdown menu in the navigation.', 'couponxl')
		));
	}	
}

add_action('widgets_init', 'couponxl_widgets_init');

function couponxl_register_click( $offer_id ){
	$offer_clicks = get_post_meta( $offer_id, 'offer_clicks', true );
	if( empty( $offer_clicks ) ){
		$offer_clicks = 1;
	}
	else{
		$offer_clicks++;
	}
	update_post_meta( $offer_id, 'offer_clicks', $offer_clicks );
}

function couponxl_store_url(){
	if( isset( $_GET['rs'] ) ){
		$store_link = get_post_meta( $_GET['rs'], 'store_link', true );
		if( !empty( $store_link ) ){
			wp_redirect( $store_link );
		}
		else{
			wp_redirect( get_permalink( $_GET['rs'] ) );	
		}
	}
	/* redirect to external deal link */
	if( isset( $_GET['rd'] ) ){
		$deal_link = get_post_meta( $_GET['rd'], 'deal_link', true );
		if( !empty( $deal_link ) ){
			wp_redirect( $deal_link );
		}
	}
}
add_action( 'template_redirect', 'couponxl_store_url', 0 );

function couponxl_wp_title( $title, $sep ) {
	global $paged, $page, $couponxl_slugs;

	if ( is_feed() ){
		return $title;
	}
	if( is_page() && get_page_template_slug( get_the_ID() ) == 'page-tpl_my_profile.php' ){
		return $title;
	}

	$keyword = get_query_var( $couponxl_slugs['keyword'] );
	if( !empty( $keyword ) ){
		$title = str_replace( '_', ' ', urldecode( $keyword ) )." $sep ".$title;
	}

	$offer_store = get_query_var( $couponxl_slugs['offer_store'] );
	if( !empty( $offer_store ) ){
		$title = get_the_title( $offer_store )." $sep ".$title;
	}

	$location = get_query_var( $couponxl_slugs['location'] );
	if( !empty( $location ) ){
		$term = get_term_by( 'slug', $location, 'location' );
		$title = $term->name." $sep ".$title;
	}

	$offer_cat = get_query_var( $couponxl_slugs['offer_cat'] );
	if( !empty( $offer_cat ) ){
		$term = get_term_by( 'slug', $offer_cat, 'offer_cat' );
		$title = $term->name." $sep ".$title;
	}

	return $title;
}
add_filter( 'wp_title', 'couponxl_wp_title', 10, 2 );

if( !function_exists('couponxl_wp_title_new') ){
function couponxl_wp_title_new( $title ){
	global $paged, $page, $couponxl_slugs;
	if ( is_feed() ){
		return $title;
	}
	if( is_page() && get_page_template_slug( get_the_ID() ) == 'page-tpl_profile.php' ){
		return $title;
	}

	$keyword = get_query_var( $couponxl_slugs['keyword'] );
	if( !empty( $keyword ) && empty( $_POST[$couponxl_slugs['keyword']] ) ){
		$title['title'] = str_replace( '_', ' ', urldecode( $keyword ) );
	}

	$offer_store = get_query_var( $couponxl_slugs['offer_store'] );
	if( !empty( $offer_store ) && empty( $_POST[$couponxl_slugs['offer_store']] ) ){
		$title['title'] = get_the_title( $offer_store );
	}

	$location = get_query_var( $couponxl_slugs['location'] );
	if( !empty( $location ) && empty( $_POST[$couponxl_slugs['location']] ) ){
		$term = get_term_by( 'slug', $location , 'location' );
		if( !empty( $term ) && !is_wp_error( $term ) ){
			$title['title'] = $term->name;
		}
	}

	$offer_cat = get_query_var( $couponxl_slugs['offer_cat'] );
	if( !empty( $offer_cat ) && empty( $_POST[$couponxl_slugs['offer_cat']] ) ){
		$term = get_term_by( 'slug', $offer_cat, 'offer_cat' );
		if( !empty( $term ) && !is_wp_error( $term ) ){
			$title['title'] = $term->name;
		}
	}
	return $title;
}
add_filter( 'document_title_parts', 'couponxl_wp_title_new', 10 );
}

function couponxl_set_direction() {
	global $wp_locale, $wp_styles;

	$_user_id = get_current_user_id();
	$direction = couponxl_get_option( 'direction' );
	if( empty( $direction ) ){
		$direction = 'ltr';
	}

	if ( $direction ) {
		update_user_meta( $_user_id, 'rtladminbar', $direction );
	} else {
		$direction = get_user_meta( $_user_id, 'rtladminbar', true );
		if ( false === $direction )
			$direction = isset( $wp_locale->text_direction ) ? $wp_locale->text_direction : 'ltr' ;
	}

	$wp_locale->text_direction = $direction;
	if ( ! is_a( $wp_styles, 'WP_Styles' ) ) {
		$wp_styles = new WP_Styles();
	}
	$wp_styles->text_direction = $direction;
}
add_action( 'init', 'couponxl_set_direction' );

/* -------------------------------------------------------PERMALINKS------------------------------------------------------- */

function couponxl_get_slug_by_tpl( $template_name ){
	$page = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name . '.php'
	));
	if(!empty($page)){
		return $page[0]->post_name;
	}
	else{
		return "";
	}
}

/* get url by page template */
function couponxl_get_permalink_by_tpl( $template_name ){
	$page = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name . '.php'
	));
	if(!empty($page)){
		return get_permalink( $page[0]->ID );
	}
	else{
		return "javascript:;";
	}
}

/* --------------------------------------------------------REGISTER & LOGIN---------------------------------------------------*/

/*common for gmap and for culture gallery*/
function couponxl_confirm_hash( $length = 100 ) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}

/* --------------------------------------------------------USER COLUMNS---------------------------------------------------*/
/* add user activation user status to the columns */
function couponxl_active_column($columns) {
    $columns['active'] = __( 'Activation Status', 'couponxl' );
    $columns['user_agent'] = __( 'User Is Agent?', 'couponxl' );
    $columns['earnings_sent'] = __( 'Earnings Sent', 'couponxl' );
    $columns['earnings_due'] = __( 'Earnings Due', 'couponxl' );
    $columns['sales'] = __( 'Sales', 'couponxl' );
    $columns['purchases'] = __( 'Purchases', 'couponxl' );
    return $columns;
}
add_filter('manage_users_columns', 'couponxl_active_column');
 
/* add user activation user status data to the columns */
function couponxl_active_column_content( $value, $column_name, $user_id ){
	if ( 'active' == $column_name ){
		$usermeta = get_user_meta( $user_id, 'user_active_status', true );
		if( empty( $usermeta ) ||  $usermeta == "active" ){
			return __( 'Activated', 'couponxl' );
		}
		else{
			return __( 'Need Confirmation', 'couponxl' );
		}
	}
	else if( 'user_agent' == $column_name ){
		$user_agent = get_user_meta( $user_id, 'user_agent', true );
		if( $user_agent == 'yes' ){
			return __( 'Yes', 'couponxl' );
		}
	}
	else if( 'earnings_sent' == $column_name ){
		$earnings = couponxl_user_earnings( $user_id );
		return couponxl_format_price_number( $earnings['paid'] );
	}
	else if( 'earnings_due' == $column_name ){
		$earnings = couponxl_user_earnings( $user_id );
		return couponxl_format_price_number( $earnings['not_paid'] );
	}
	else if( 'sales' == $column_name ){
		$earnings = couponxl_user_earnings( $user_id );
		return $earnings['sales'];
	}
	else if( 'purchases' == $column_name ){
		return $count_purchases = couponxl_count_post_type( 'voucher', array(
			'meta_query' => array(
				array(
					'key' => 'voucher_buyer_id',
					'value' => $user_id,
					'compare' => '='
				)
			)
		));
	}	
    return $value;
}
add_action('manage_users_custom_column',  'couponxl_active_column_content', 10, 3);

function couponxler_edit_user_status( $user ){
	$user_active_status = get_user_meta( $user->ID, 'user_active_status', true );
	$user_agent = get_user_meta( $user->ID, 'user_agent', true );
    ?>
        <h3><?php _e( 'User Status', 'couponxl' ) ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="user_active_status"><?php _e( 'User Status', 'couponxl' ); ?></label></th>
                <td>
                	<select name="user_active_status">
                		<option <?php echo !empty( $user_active_status ) && $user_active_status != 'active' ? 'selected="selected"' : '' ?> value="inactive"><?php _e( 'Inactive', 'couponxl' ) ?></option>
                		<option <?php echo empty( $user_active_status ) || $user_active_status == 'active' ? 'selected="selected"' : '' ?> value="active"><?php _e( 'Active', 'couponxl' ) ?></option>
                	</select>
                </td>
            </tr>
        </table>

        <h3><?php _e( 'User Agent', 'couponxl' ) ?></h3>

        <table class="form-table">
            <tr>
                <th><label for="user_agent"><?php _e( 'User Can Manage Offers?', 'couponxl' ); ?></label></th>
                <td>
                	<select name="user_agent">
                		<option <?php echo $user_agent != 'yes'  ? 'selected="selected"' : '' ?> value="yes"><?php _e( 'Yes', 'couponxl' ) ?></option>
                		<option <?php echo empty( $user_agent ) || $user_agent == 'no' ? 'selected="selected"' : '' ?> value="no"><?php _e( 'No', 'couponxl' ) ?></option>
                	</select>
                </td>
            </tr>
        </table>          
    <?php
}
add_action( 'show_user_profile', 'couponxler_edit_user_status' );
add_action( 'edit_user_profile', 'couponxler_edit_user_status' );

function couponxler_save_user_meta( $user_id ){
	update_user_meta( $user_id,'user_active_status', sanitize_text_field($_POST['user_active_status']) );    
	update_user_meta( $user_id,'user_agent', sanitize_text_field($_POST['user_agent']) );    
}
add_action( 'personal_options_update', 'couponxler_save_user_meta' );
add_action( 'edit_user_profile_update', 'couponxler_save_user_meta' );


/* --------------------------------------------------------DISABLE BAR---------------------------------------------------*/
function couponxl_remove_admin_bar() {
	$user_ID = get_current_user_id();
	$user_agent = get_user_meta( $user_ID, 'user_agent', true );	
	if (!current_user_can('administrator') && !is_admin() && ( !$user_agent || $user_agent == 'no' ) ) {
		show_admin_bar(false);
	}
}
add_action('after_setup_theme', 'couponxl_remove_admin_bar');



/* get number of custom posts by post type */
function couponxl_custom_post_count( $type ){
	$num_posts = wp_count_posts( $type );

	return intval( $num_posts->publish );
}


/* total_defaults */
function couponxl_defaults( $id ){	
	$defaults = array(
		'terms' => '',
		'show_notification_bar' => 'no',
		'search_sidebar_location' => 'left',
		'notification_txt' => '',
		'notification_bg_color' => '#DA1B36',
		'notification_font_color' => '#ffffff',
		'notification_bar_closeable' => 'no',
		'direction' => 'ltr',
		'theme_usage' => 'all',
		'home_sidebars' => 2,
		'seo_keywords' => '',
		'seo_description' => '',
		'trans_offer_type' => 'offer_type',
		'trans_offer_cat' => 'offer_cat',
		'trans_offer_tag' => 'offer_tag',
		'trans_location' => 'location',
		'trans_offer_store' => 'offer_store',
		'trans_offer_view' => 'offer_view',
		'trans_offer_sort' => 'offer_sort',
		'trans_keyword' => 'keyword',
		'trans_store' => 'store',
		'trans_letter' => 'letter',
		'trans_offer' => 'offer',
		'trans_coupon' => 'coupon',
		'trans_deal' => 'deal',
		'trans_confirmation_slug' => 'confirmation_slug',
		'trans_username' => 'username',
		'trans_subpage' => 'subpage',
		'trans_offer_id' => 'offer_id',
		'trans_action' => 'action',
		'main_color' => '#5b0f70',
		'main_color_font' => '#ffffff',
		'body_bg_color' => '#f4f4f4',	
		'button_light_green_bg_color' => '#5ba835',
		'button_light_green_font_color' => '#ffffff',
		'button_light_green_bg_color_hvr' => '#448722',
		'button_light_green_font_color_hvr' => '#ffffff',
		'slider_auto_rotate' => 'no',
		'slider_speed' => '4000',
		'initial_location' => '',
		'titles_font' => 'Montserrat',
		'text_font' => 'Open Sans',
		'site_favicon' => array( 'url' => '' ),
		'show_top_bar' => 'no',
		'top_bar_facebook_link' => '',
		'top_bar_twitter_link' => '',
		'top_bar_google_link' => '',	
		'top_bar_location_placeholder' => __( 'Location ( New Yor, Chicago, ... )', 'couponxl' ),
		'top_bar_store_placeholder' => __( 'Store ( Addidas, nike, ... )', 'couponxl' ),
		'keyword_search_placeholder' => __('Search for... ( 20% off, great deal,... )', 'couponxl'),
		'site_logo' => array( 'url' => '' ),
		'site_logo_padding' => '',
		'enable_sticky' => 'no',
		'navigation_font' => 'Montserrat',
		'site_navigation_padding' => '',
		'mega_menu_sidebars' => '5',
		'mega_menu_min_height' => '',
		'show_to_top' => 'no',	
		'footer_copyrights' => '',	
		'footer_facebook' => '',
		'footer_twitter' => '',
		'footer_google' => '',
		'show_big_map' => 'no',
		'big_map_source' => 'store',
		'big_map_height' => '40px',
		'home_page_bg_image' => array( 'url' => '' ),
		'home_page_bg_image_repeat' => 'no-repeat',
		'home_page_bg_image_size' => 'auto',
		'home_page_show_title' => 'yes',
		'home_page_title' => '',
		'home_page_subtitle' => '',	
		'home_page_show_search' => 'yes',	
		'home_page_search_location_placeholder' => __( 'Location ( New York, Chicago... )', 'couponxl' ),
		'home_page_search_location_desc' => __( 'Example: Detroit US, Washington DC ...', 'couponxl' ),
		'home_page_search_store_placeholder' => __( 'What are you looking for?', 'couponxl' ),
		'home_page_search_store_desc' => __( 'Example: Wallmart, Nike, Reebok, Dell, Apple, Addidas ...', 'couponxl' ),		
		'home_page_slider_items' => array(),
		'home_page_main_title_font_color' => '#ffffff',
		'home_page_search_input_bg_color' => '#ffffff',
		'home_page_search_input_border_color' => '#ffffff',
		'home_page_search_input_placeholder_color' => '#2f3336',
		'home_page_search_input_font_color' => '#2f3336',
		'home_page_search_input_font_color_focus' => '#ffffff',
		'home_page_search_input_bg_color_focus' => '',
		'home_page_search_input_border_color_focus' => '#ffffff',
		'home_page_search_dropdown_bg_color' => '#ffffff',
		'home_page_search_dropdown_font_color' => '#202020',
		'home_page_search_dropdown_font_color_hvr' => '#202020',
		'home_page_search_dropdown_bg_color_hvr' => '#d4d4d4',
		'page_title_bg_color' => '#5b0f70',
		'page_title_bg_image' => array( 'url' => '' ),
		'page_title_bg_image_repeat' => 'no-repeat',
		'page_title_bg_image_size' => 'auto',
		'page_title_font_color' => '#ffffff',		
		'blog_subtitle' => '',
		'offer_subtitle' => '',
		'show_breadcrumbs' => 'no',
		'breadcrumbs_bg_color' => '',
		'breadcrumbs_font_color' => '',
		'breadcrumbs_link_font_color' => '',
		'breadcrumbs_link_font_color_hvr' => '',
		'contact_mail' => '',
		'contact_form_subject' => '',
		'contact_map' => '',
		'contact_map_max_zoom' => '',
		'contact_map_scroll_zoom' => 'no',
		'show_search_slider' => 'yes',
		'default_offer_listing' => 'grid',
		'stores_per_page' => '10',  
		'offers_per_page' => '10',
		'store_no_offers_message' => '',
		'search_no_offers_message' => '',
		'search_page_offer_type_filter_title' => __( 'I\'m looking for', 'couponxl' ),
		'search_page_category_filter_title' => __( 'Category', 'couponxl' ),
		'search_page_location_filter_title' => __( 'Location', 'couponxl' ),
		'search_show_count' => 'yes',
		'search_include_empty' => 'yes',
		'search_visible_categories_count' => '6',
		'search_visible_locations_count' => '6',
		'show_filter_bar' => 'yes',
		'deal_show_bought' => 'yes',
		'deal_show_similar' => 'yes',		
		'similar_offers' => '2',
		'deal_show_author' => 'yes',
		'deal_map_max_zoom' => '',
		'deal_owner_price_shared' => '',
		'deal_owner_price_not_shared' => '',
		'deal_submit_price' => '',
		'coupon_modal_content' => 'content',
		'coupon_show_similar' => 'yes',
		'coupon_similar_offers' => '2',
		'coupon_show_author' => 'yes',
		'coupon_submit_price' => '',
		'unlimited_expire' => 'no',
		'date_ranges' => '',
		'registration_message' => '',
		'registration_subject' => '',
		'lost_password_message' => '',
		'lost_password_subject' => '',
		'email_sender' => '',
		'name_sender' => '',
		'discussion_form_subject' => '',
		'discussion_form_mail' => '',
		'discussion_form_mail_name' => '',
		'paypal_mode' => '',
		'unit' => '',
		'main_unit_abbr' => '',
		'unit_position' => '',
		'paypal_username' => '',
		'paypal_password' => '',
		'paypal_signature' => '',
		'pk_client_id' => '',
		'sk_client_id' => '',
		'ap_client_id' => '',
		'skrill_owner_mail' => '',
		'skrill_secret_word' => '',
		'skrill_api_mqi_password' => '',
		'mollie_id' => '',
		'ideal_mode' => 'live',
		'payu_merchant_key' => '',
		'payu_merchant_salt' => '',
		'payu_mode' => 'secure',
		'mail_chimp_api' => '',
		'mail_chimp_list_id' => '',
		'twitter-username' => '',
		'twitter-oauth_access_token' => '',
		'twitter-oauth_access_token_secret' => '',
		'twitter-consumer_key' => '',
		'twitter-consumer_secret' => '',
		'new_offer_email' => ''
	);
	
	if( isset( $defaults[$id] ) ){
		return $defaults[$id];
	}
	else{
		
		return '';
	}
}

/* get option from theme options */
function couponxl_get_option($id){
	global $couponxl_options;
	if( isset( $couponxl_options[$id] ) ){
		$value = $couponxl_options[$id];
		if( isset( $value ) ){
			return apply_filters( 'couponxl_get_options', $value, $id );
		}
		else{
			return apply_filters( 'couponxl_get_options', '', $id );
		}
	}
	else{
		return apply_filters( 'couponxl_get_options', couponxl_defaults( $id ), $id );
	}	
}

	/* setup neccessary theme support, add image sizes */
function couponxl_setup(){
	add_theme_support('automatic-feed-links');
	add_theme_support( "title-tag" );
	add_theme_support('html5', array(
		'comment-form',
		'comment-list'
	));
	register_nav_menu('top-navigation', __('Top Navigation', 'couponxl'));
	register_nav_menu('widget-navigation', __('Widget Navigation', 'couponxl'));
	
	add_theme_support('post-thumbnails',array( 'post', 'pages', 'store', 'offer' ));
	
	set_post_thumbnail_size(848, 477, true);
	if (function_exists('add_image_size')){
		add_image_size( 'shop_logo', 150 );
		add_image_size( 'offer-box', 400, 225, true );
	}

	add_theme_support('custom-header');
	add_theme_support('custom-background');
	add_theme_support('post-formats',array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ));
	add_editor_style();
}
add_action('after_setup_theme', 'couponxl_setup');

/* get ratings of the couponxler */
function couponxl_get_rate_average( $post_id ){
	global $wpdb;
	$average = 0;
	$result = array(
		'count' => 0,
		'sum' => 0
	);
	$ratings = get_post_meta( $post_id, 'couponxl_rating' );
	if( !empty( $ratings ) ){
		foreach( $ratings as $rating ){
			$temp = explode( '|', $rating );
			$result['sum'] += $temp[1];
			$result['count'] += 1;
		}
	}

	return $result;
}

function couponxl_calculate_ratings( $post_id ){
	$rate = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';

	$result = couponxl_get_rate_average( $post_id );
	
	if( $result['count'] > 0 ) {
		$average = get_post_meta( $post_id, 'couponxl_average_rate', true );
		if( $average <= 0.25 ){
			$rate = '<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 0.75 ){
			$rate = '<i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 1.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 1.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 2.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 2.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 3.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 3.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average <= 4.25 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
		}
		else if( $average < 4.75 ){
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i>';
		}
		else{
			$rate = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
		}
	}

	$votes = $result['count'].' '.( ( $result['count'] == 1 ) ? __( 'rate', 'couponxl' ) : __( 'rates', 'couponxl' ) );

	return $rate.' <span> ('.$votes.')</span>';
}

/* get ratings of the couponxl */
function couponxl_get_ratings( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$rate = couponxl_calculate_ratings( $post_id );

	return '<div class="item-ratings" data-post_id="'.$post_id.'">
				'.$rate.'
			</div>';
}

function couponxl_write_ratings(){
	global $wpdb;
	$rate = $_POST['rate'];
	$post_id = $_POST['post_id'];
	$result = couponxl_get_rate_average( $post_id );
	$avg = get_post_meta( $post_id, 'couponxl_average_rate', true );
	$check_vote = $wpdb->get_results( "SELECT * FROM {$wpdb->postmeta} WHERE post_id='".$post_id."' AND meta_key='couponxl_rating' AND meta_value LIKE '".$_SERVER['REMOTE_ADDR']."%'" );
	if( !empty( $check_vote ) ){
		$check_vote = $check_vote[0];
		$temp = explode( '|', $check_vote->meta_value );
		$old_value = $temp[1];
		$result['sum'] -= $old_value;
		$result['count'] -= 1;
		delete_post_meta( $post_id, 'couponxl_rating', $check_vote->meta_value  );
	}
	$wpdb->insert( 
		$wpdb->postmeta,
		array( 
			'post_id' => $post_id,
			'meta_key' => 'couponxl_rating',
			'meta_value' => $_SERVER['REMOTE_ADDR'].'|'.$rate
		), 
		array( 
			'%d',
			'%s',
			'%s'
		) 
	);
	//add_post_meta( $post_id, 'couponxl_rating', $_SERVER['REMOTE_ADDR'].'|'.$rate );
	
	$average = 0;
	$average = number_format( ( $result['sum'] + $rate ) / ( $result['count'] + 1 ), 2 );
	update_post_meta( $post_id, 'couponxl_average_rate', $average );
	
	$rate = couponxl_calculate_ratings( $post_id );

	echo $rate;
	die();
}
add_action('wp_ajax_write_rate', 'couponxl_write_ratings');
add_action('wp_ajax_nopriv_write_rate', 'couponxl_write_ratings');

/* setup neccessary styles and scripts */
function couponxl_scripts_styles(){
	/* ENQUEUE STYLES */
	/* FONT AWESOME */
	wp_enqueue_style( 'couponxl-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	/* BOOTSTRAP */
	wp_enqueue_style( 'couponxl-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	if( get_page_template_slug() == 'page-tpl_my_profile.php' ){
		/* BOOTSTRAP TABLES */
		wp_enqueue_style( 'couponxl-bootstrap-table', get_template_directory_uri() . '/css/bootstrap-table.min.css' );
		/* DATE TIME PICKER */
		wp_enqueue_style( 'couponxl-calendar', get_template_directory_uri() . '/css/jquery.datetimepicker.css' );
	}

	$navigation_font = couponxl_get_option( 'navigation_font' );
	$titles_font = couponxl_get_option( 'titles_font' );
	$text_font = couponxl_get_option( 'text_font' );
	$protocol = is_ssl() ? 'https' : 'http';
	if( !empty( $navigation_font ) ){
		wp_enqueue_style( 'couponxl-navigation-font', $protocol."://fonts.googleapis.com/css?family=".str_replace( " ", "+", $navigation_font ).":100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" );
	}
	if( !empty( $titles_font ) ){
		wp_enqueue_style( 'couponxl-title-font', $protocol."://fonts.googleapis.com/css?family=".str_replace( " ", "+", $titles_font ).":100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" );
	}
	if( $text_font ){
		wp_enqueue_style( 'couponxl-text-font', $protocol."://fonts.googleapis.com/css?family=".str_replace( " ", "+", $text_font ).":100,300,400,700,900,100italic,300italic,400italic,700italic,900italic" );
	}

	/* ENQUEUE STYLES */
	wp_enqueue_script('jquery');
	/* BOOTSTRAP */
	wp_enqueue_script( 'couponxl-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', false, false, true );
	wp_enqueue_script( 'couponxl-bootstrap-multilevel-js', get_template_directory_uri() . '/js/bootstrap-dropdown-multilevel.js', false, false, true );	

	if( get_page_template_slug() == 'page-tpl_my_profile.php' ){
		wp_enqueue_script('jquery-ui-datepicker');
		wp_enqueue_script('jquery-ui-sortable');		
		/* BOOTSTRAP TABLES */
		wp_enqueue_script( 'couponxl-bootstrap-table',  get_template_directory_uri() . '/js/bootstrap-table.min.js', false, false, true );
		wp_localize_script( 'couponxl-bootstrap-table', 'couponxl_tabe_strings', array(
			'search' => __( 'Search', 'couponxl' ),
			'no_records' => __( 'No matching records found', 'couponxl' ),
		) );		
		/* DATE TIME PICKER */
		wp_enqueue_script( 'couponxl-datetimepicker',  get_template_directory_uri() . '/js/jquery.datetimepicker.js', false, false, true );

		/* IMAGE UPLOADS */
		wp_enqueue_media();
		wp_enqueue_script('couponxl-image-uploads', get_template_directory_uri() . '/js/front-uploader.js', false, false, true );		

		/* STEPS */
		wp_enqueue_style( 'couponxl-steps', get_template_directory_uri() . '/css/jquery.steps.css' );
		wp_enqueue_script('couponxl-steps', get_template_directory_uri() . '/js/jquery.steps.min.js', false, false, true );				
	}
	
	
	if (is_singular() && comments_open() && get_option('thread_comments')){
		wp_enqueue_script('comment-reply');
	}
		
	wp_enqueue_script( 'couponxl-zeroclipboard',  get_template_directory_uri() . '/js/ZeroClipboard.min.js', false, false, true );
	wp_enqueue_script( 'couponxl-responsive-slides',  get_template_directory_uri() . '/js/responsiveslides.min.js', false, false, true );

	wp_enqueue_script( 'couponxl-cookie',  get_template_directory_uri() . '/js/jquery.cookie.js', false, false, true );
		
	if( is_singular('offer') ){
		wp_enqueue_script( 'couponxl-countdown',  get_template_directory_uri() . '/js/countdown.js', false, false, true );
	}

	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_script( 'couponxl-googlemap', $protocol.'://maps.googleapis.com/maps/api/js?sensor=false', false, false, true );	


	wp_enqueue_script( 'couponxl-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', false, false, true );
	wp_enqueue_script( 'couponxl-masonry', get_template_directory_uri() . '/js/masonry.js', false, false, true );


	wp_enqueue_script( 'couponxl-stripe', 'https://checkout.stripe.com/checkout.js', false, false, true );

	wp_enqueue_script( 'couponxl-custom', get_template_directory_uri() . '/js/custom.js', false, false, true );
	wp_localize_script( 'couponxl-custom', 'couponxl_data', array(
		'url' => get_template_directory_uri(),
		'email_friend' => __( 'Friend\'s email address', 'couponxl' ),
		'steps_cancel' => __( 'Cancel', 'couponxl' ),
		'steps_finish' => __( 'Finish', 'couponxl' ),
		'steps_next' => __( 'Next', 'couponxl' ),
		'steps_previous' => __( 'Previous', 'couponxl' ),
		'steps_loading' => __( 'Loading...', 'couponxl' ),
		'contact_map_max_zoom' => couponxl_get_option( 'contact_map_max_zoom' ),
		'deal_map_max_zoom' => couponxl_get_option( 'deal_map_max_zoom' )
	) );

}
add_action('wp_enqueue_scripts', 'couponxl_scripts_styles', 2 );

function couponxl_load_color_schema(){
	/* LOAD MAIN STYLE */
	wp_enqueue_style('couponxl-style', get_stylesheet_uri() , array());
	ob_start();
	include( locate_template( 'css/main-color.css.php' ) );
	$custom_css = ob_get_contents();
	ob_end_clean();
	wp_add_inline_style( 'couponxl-style', $custom_css );	
}
add_action('wp_enqueue_scripts', 'couponxl_load_color_schema', 4 );

function couponxl_admin_resources(){
	global $post;
	wp_enqueue_style( 'couponxl-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	if( ( isset( $_GET['post_type'] ) && $_GET['post_type'] == 'voucher' ) || ( isset( $post ) && $post->post_type == 'offer' ) ){
		wp_enqueue_script( 'couponxl-admin-voucher-pay', get_template_directory_uri() . '/js/admin.js', false, false, true );
		wp_enqueue_style( 'couponxl-admin-voucher', get_template_directory_uri() . '/css/admin.css' );
	}

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_script( 'jquery-ui-sortable' );
	wp_enqueue_script( 'jquery-ui-dialog' );

	wp_enqueue_style( 'couponxl-jquery-ui', 'http://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_style('couponxl-shortcodes-style', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_script('couponxl-multidropdown', get_template_directory_uri() . '/js/multidropdown.js', false, false, true);
	wp_enqueue_media();

	if( strpos( $_SERVER['REQUEST_URI'], 'widget' ) !== false ){
		wp_enqueue_script('couponxl-shortcodes', get_template_directory_uri() . '/js/shortcodes.js', false, false, true);
	}	
}
add_action( 'admin_enqueue_scripts', 'couponxl_admin_resources' );

/* format date and time that will be shown on comments, blogs, cars .... */
function couponxl_format_post_date($date, $format){
	return date($format, strtotime($date));
}

/* add admin-ajax */
function couponxl_custom_head(){
	echo '<script type="text/javascript">var ajaxurl = \'' . admin_url('admin-ajax.php') . '\';</script>';
}
add_action('wp_head', 'couponxl_custom_head');

function couponxl_smeta_images( $meta_key, $post_id, $default ){
	if(class_exists('SM_Frontend')){
		global $sm;
		return $result = $sm->sm_get_meta($meta_key, $post_id);
	}
	else{		
		return $default;
	}
}

/* return list of the all custom post type shops */
function couponxl_get_custom_list( $post_type, $args = array(), $orderby = '', $direction = 'right' ){
	$post_array = array();
	$args = array( 'post_type' => $post_type, 'post_status' => 'publish', 'posts_per_page' => -1 ) + $args;
	if( !empty( $orderby ) ){
		$args['orderby'] = $orderby;
		$args['order'] = 'ASC';
	}
	$posts = get_posts( $args );
	
	foreach( $posts as $post ){
		if( $direction == 'right' ){
			$post_array[$post->ID] = $post->post_title;
		}
		else{
			$post_array[$post->post_title] = $post->ID;	
		}
	}
	
	return $post_array;
}

function couponxl_get_custom_tax_list( $taxonomy, $direction = 'right' ){
	$terms = get_terms( $taxonomy );
	$term_list = array();
	if( !empty( $terms ) ){
		foreach( $terms as $term ){
			if( $direction == 'right' ){
				$term_list[$term->slug] = $term->name;
			}
			else{
				$term_list[$term->name] = $term->slug;
			}
		}
	}

	return $term_list;
}


function couponxl_get_users_select(){
	$users = get_users(array(
		'orderby' => 'nicename'
	));

	$users_array = array();

	foreach( $users as $user ){
		$user_data = get_userdata( $user->ID );
		$users_array[$user->ID] = $user_data->user_nicename;
	}

	return $users_array;
}

function couponxl_count_post_type( $post_type, $args = array() ){
	$args = array( 'post_type' => $post_type, 'post_status' => 'publish', 'posts_per_page' => -1 ) + $args;
	$posts = get_posts( $args );
	wp_reset_query();
	return count( $posts );
}

function couponxl_coupon_button( $post_id = '', $is_shortcode = false ){
	global $couponxl_slugs;
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}
	
	if( $is_shortcode || is_front_page() ){
		$base_permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
	}
	else{
		$base_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}

	$paged = '';
	if( strpos( $base_permalink, '/page' ) ){
		$paged = explode( '/page', $base_permalink );
		$base_permalink = $paged[0];
	}
	if( get_query_var( $couponxl_slugs['coupon'] ) && get_option('permalink_structure') ){
		$end = strrpos( $base_permalink, $couponxl_slugs['coupon'] );
		$base_permalink = substr( $base_permalink, 0, $end );
	}	
	$coupon_type = get_post_meta( $post_id, 'coupon_type', true );
	$affiliate_link = get_post_meta( $post_id, 'coupon_link', true );
	$coupon_link = 'javascript:;';
	$target = '';		
	if( !empty( $affiliate_link ) ){
		if( !empty( $paged[1] ) ){
			$coupon_link .= 'page'.$paged[1];
		}
		$coupon_link = esc_url( $coupon_link );
		$coupon_link .= '#cpn-'.$post_id;
		$target = 'target="_blank"';
	}

	$button = '<a href="'.$coupon_link.'" data-affiliate="'.esc_url( $affiliate_link ).'" data-offer_id="'.esc_attr( $post_id ).'" class="btn show-code" '.$target.'>';

	switch( $coupon_type ){
		case 'code': 
			$button .= '
				<i class="fa fa-scissors coupon-type"></i>
				'.__( 'SHOW CODE', 'couponxl' );
			break;
		case 'sale':
			$button .= '
				<i class="fa fa-chain coupon-type"></i>
				'.__( 'CHECK SALE', 'couponxl' );
			break;		
		case 'printable':
			$button .= '
				<i class="fa fa-print coupon-type"></i>
				'.__( 'SHOW COUPON', 'couponxl' );
			break;		
	}

	$button .= '</a>';

	return $button;
}

/* add custom meta fields using smeta to post types. */
if( !function_exists('couponxl_custom_meta_boxes') ){
function couponxl_custom_meta_boxes(){
	/* page meta */
	$page_meta = array(
		array(
			'id' => 'page_subtitle',
			'name' => __( 'Page Subtitle', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input page subtitle', 'couponxl' )
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Page Subtitle', 'couponxl' ),
		'pages' => 'page',
		'fields' => $page_meta,
	);	

	/* common fields for the deals and for the coupons */
	$offer_meta = array(
		array(
			'id' => 'offer_type',
			'name' => __( 'Offer type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'coupon' => __( 'Coupon', 'couponxl' ),
				'deal' => __( 'Deal', 'couponxl' )
			),
			'desc' => __( 'Choose type of offer between coupon and deal.', 'couponxl' )
		),
		array(
			'id' => 'offer_start',
			'name' => __( 'Start date', 'couponxl' ),
			'type' => 'datetime_unix',
			'desc' => __( 'Set start date and time for the offer.', 'couponxl' )
		),		
		array(
			'id' => 'offer_expire',
			'name' => __( 'Expire date', 'couponxl' ),
			'type' => 'datetime_unix',
			'desc' => __( 'Set expire date and time for the offer or leave empty for unlimited last.', 'couponxl' )
		),
		array(
			'id' => 'offer_in_slider',
			'name' => __('Offer In Slider','carell'),
			'type' => 'select',
			'options' => array(
				'no' => __( 'No', 'couponxl' ),
				'yes' => __( 'Yes', 'couponxl' )
			),
			'desc' => __( 'Put this offer in the slider on the listing pages.', 'couponxl' )
		),
		array(
			'id' => 'offer_store',
			'name' => __( 'Offer Store', 'couponxl' ),
			'type' => 'post_type_ajax',
			'post_type' => 'store',
			'additional' => array(
				'orderby' => 'title',
				'order' => 'DESC'
			),
			'desc' => __( 'Select store of the offer.', 'couponxl' )
		),		

		array(
			'id' => 'offer_initial_payment',
			'name' => __( 'Initial payment', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'paid' => __( 'Paid', 'couponxl' ),
				'not_paid' => __( 'Not Paid', 'couponxl' ),
			),
			'desc' => __( 'Is submission fee of this offer paid or not.', 'couponxl' )
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Offer Common Data', 'couponxl' ),
		'pages' => 'offer',
		'fields' => $offer_meta,
	);

	$offer_requests = array(
		array(
			'id' => 'offer_new_category',
			'name' => __( 'New category request', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'Request for new category is listed here.', 'couponxl' )
		),
		array(
			'id' => 'offer_new_location',
			'name' => __( 'New location request', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'Request for new location is listed here.', 'couponxl' )
		),
		array(
			'id' => 'offer_new_store',
			'name' => __( 'New store request', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'Request for new store is listed here.', 'couponxl' )
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Offer Requests', 'couponxl' ),
		'pages' => 'offer',
		'fields' => $offer_requests,
	);	

	
	/* custom meta fields for the offer as coupon */
	$coupon_meta = array(
		array(
			'id' => 'coupon_type',
			'name' => __( 'Coupon type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'code' => __( 'Coupon With Code', 'couponxl' ),
				'sale' => __( 'Coupon For Sale', 'couponxl' ),
				'printable' => __( 'Printable Coupon', 'couponxl' )
			),
			'desc' => __( 'Choose type of the coupon.', 'couponxl' )
		),
		array(
			'id' => 'coupon_code',
			'name' => __( 'Coupon Code', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input coupon code.', 'couponxl' )
		),
		array(
			'id' => 'coupon_sale',
			'name' => __( 'Coupon Sale Link', 'couponxl' ),
			'type'	=> 'text',
			'desc' => __( 'Input sale link.', 'couponxl' )
		),
		array(
			'id' => 'coupon_image',
			'name' => __( 'Coupon Image', 'couponxl' ),
			'type' => 'image',
			'desc' => __( 'Upload printable coupon image.', 'couponxl' )
		),
		array(
			'id' => 'coupon_link',
			'name' => __( 'Coupon Affiliate Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input affiliate link which will be opened once the coupon is clicked.', 'couponxl' )
		),
		array(
			'id' => 'coupon_link_with_code',
			'name' => __( 'Coupon Store Link With Code', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link to the store with code included, which will be displayed on the coupon popup window', 'couponxl' )
		),

	);
	$meta_boxes[] = array(
		'title' => __( 'Coupon Information', 'couponxl' ),
		'pages' => 'offer',
		'fields' => $coupon_meta,
	);

	$deal_meta = array(
		array(
			'id' => 'deal_items',
			'name' => __( 'Deal Items', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input number of deal items or services which will be available for purchase.', 'couponxl' )
		),
		array(
			'id' => 'deal_item_vouchers',
			'name' => __( 'Deal Items Vouchers', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'If you want to serve predefined vouchers instead of random generated ones, input them here one in a row and make sure that you have same amount of these vouchers as the number of items.', 'couponxl' )
		),		
		array(
			'id' => 'deal_price',
			'name' => __( 'Deal Price', 'couponxl' ),
			'type'	=> 'text',
			'desc' => __( 'Input real price of the deal without currency simbol. If this value is decimal than use . as decimal separator and max two decimal places.', 'couponxl' )
		),
		array(
			'id' => 'deal_sale_price',
			'name' => __( 'Deal Sale Price', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input sale price of the deal without currency simbol ( auto updated by the percentage change in the next field ). If this value is decimal than use . as decimal separator and max two decimal places.', 'couponxl' )
		),
		array(
			'id' => 'deal_discount',
			'name' => __( 'Deal Discount', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input discount percentage number with the % sign after number ( auto updated by the sale price change in the previous field ).', 'couponxl' )
		),
		array(
			'id' => 'deal_status',
			'name' => __( 'Deal Status', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'has_items' => __( 'Has Items', 'couponxl' ),
				'sold_out' => __( 'Sold Out', 'couponxl' ),
			),
			'desc' => __( 'Manually set status of the deal ( this is auto populated depending on the items left to sell ).', 'couponxl' )
		),		
		array(
			'id' => 'deal_voucher_expire',
			'name' => __( 'Deal Vouchers Expire Date', 'couponxl' ),
			'type' => 'datetime_unix',
			'desc' => __( 'Set expire date and time for vouchers generated after purchase or leave empty for unlimited last ( How much time voucher is valid after purchase? ).', 'couponxl' )
		),
		array(
			'id' => 'deal_in_short',
			'name' => __( 'Short Description', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'Input description which will appear in the deal single page sidebar.', 'couponxl' )
		),
		array(
			'id' => 'deal_markers',
			'name' => __( 'Deal markers', 'couponxl' ),
			'type' => 'group',
			'fields' => array(
				array(
					'id' => 'deal_marker_longitude',
					'name' => __( 'Place Longitude', 'couponxl' ),
					'type' => 'text'
				),	
				array(
					'id' => 'deal_marker_latitude',
					'name' => __( 'Place Latitude', 'couponxl' ),
					'type' => 'text'
				),
			),
			'repeatable' => 1,
			'desc' => __( 'Set places where customers can use their vauchers. Use Longitude & Latitude for google map markers, to findlong/lat ', 'couponxl' ).'<a href="http://www.latlong.net/" target="_blank">'.__( 'use this link', 'couponxl' ).'</a>.'
		),
		array(
			'id' => 'deal_images',
			'name' => __( 'Deal Images', 'couponxl' ),
			'type' => 'image',
			'repeatable' => 1,
			'desc' => __( 'Choose images for the deal. Drag and drop to change their order.', 'couponxl' ),
		),
		array(
			'id' => 'deal_type',
			'name' => __( 'Select deal type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'shared' => __( 'Website Offer', 'couponxl' ),
				'not_shared' => __( 'Store Offer', 'couonxl' )
			),
			'desc' => __( 'Website Offer - Sell discounted products and services trough website.', 'couponxl' ).'<br />'.__( 'Store Offer - Sell discounted products and services trough your store.', 'couponxl' ),
		),
		array(
			'id' => 'deal_link',
			'name' => __( 'Deal Affiliate Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input affiliate link for the deal in order to avoid payment over this website.', 'couponxl' ),
		),		
		array(
			'id' => 'deal_owner_price',
			'name' => __( 'Set site owner part', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input fixed number or number with percentage. Percentage is calculated based on the sale price of the deal.', 'couponxl' )
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Deal Information', 'couponxl' ),
		'pages' => 'offer',
		'fields' => $deal_meta,
	);
	
	/* store custom meta fields */
	$store_meta = array(
		array(
			'id' => 'store_link',
			'name' => __( 'Store Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link to the store site.', 'couponxl' )
		),
		array(
			'id' => 'store_facebook',
			'name' => __( 'Store Facebook Page Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link to the store facebok page.', 'couponxl' )
		),
		array(
			'id' => 'store_twitter',
			'name' => __( 'Store Twitter Page Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link to the store twitter page.', 'couponxl' )
		),
		array(
			'id' => 'store_google',
			'name' => __( 'Store Google+ Page Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link to the store google+ page.', 'couponxl' )
		),
		array(
			'id' => 'store_gmap_marker',
			'name' => __( 'Store Google Map Marker', 'couponxl' ),
			'type' => 'image',
			'desc' => __( 'Select store google map marker.', 'couponxl' )
		),
		array(
			'id' => 'store_gmap_longitude',
			'name' => __( 'Store Google Map Longitude', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Select store google map longitude.', 'couponxl' )
		),
		array(
			'id' => 'store_gmap_latitude',
			'name' => __( 'Store Google Map Latitude', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Select store google map atitude.', 'couponxl' )
		),
	);
	$meta_boxes[] = array(
		'title' => __( 'Store information', 'couponxl' ),
		'pages' => 'store',
		'fields' => $store_meta,
	);	

	/* VOUCHER META FIELDS */
	$voucher_meta = array(
		array(
			'id' => 'voucher_deal',
			'name' => __( 'Voucher For Deal', 'couponxl' ),
			'type' => 'post_type_ajax',
			'post_type' => 'offer',
			'additional' =>	array( 
				'meta_query' => array(
					'key' => 'offer_type',
					'value' => 'deal',
					'compare' => '='
				) 
			),
			'desc' => __( 'Select deal for which the voucher is generated ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_code',
			'name' => __( 'Voucher Code', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input voucher code ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_status',
			'name' => __( 'Voucher Status', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'not_used' => __( 'Not Used', 'couponxl' ),
				'used' => __( 'Used', 'couponxl' )
			),
			'desc' => __( 'Input voucher status ( this is also controled by the deal submitter ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_payer_id',
			'name' => __( 'Voucher Payer ID', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'PayPal ID of the buyer ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_seller_id',
			'name' => __( 'Voucher Seller', 'couponxl' ),
			'type' => 'select',
			'options' => couponxl_get_users_select(),
			'desc' => __( 'Select deal submitter ( this is auto populated on voucher generation ).', 'couponxl' )
		),		
		array(
			'id' => 'voucher_transaction_id',
			'name' => __( 'Voucher Transaction ID', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'PayPal transaction ID ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_type',
			'name' => __( 'Voucher Type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'not_shared' => __( 'Store Offer', 'couponxl' ),
				'shared' => __( 'Website Offer', 'couponxl' ),
			),
			'desc' => __( 'This is defined by the deal type ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_owner_share',
			'name' => __( 'Voucher Site Owner Share', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Amount which stays to site owner ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_seller_share',
			'name' => __( 'Voucher Deal Submitter Share', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Amount which will be sent to deal submitter ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_buyer_id',
			'name' => __( 'Voucher Buyer', 'couponxl' ),
			'type' => 'select',
			'options' => couponxl_get_users_select(),
			'desc' => __( 'Select deal buyer ( this is auto populated on voucher generation ).', 'couponxl' )
		),
		array(
			'id' => 'voucher_payment_status',
			'name' => __( 'Voucher Deal Submitter Payment Status', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'not_paid' => __( 'Payment Not Sent', 'couponxl' ),
				'paid' => __( 'Payment Sent', 'couponxl' )
			),
			'desc' => __( 'If the deal type is shared and the amount which goes to deal submitter is not sent this has value Payment Not Sent.', 'couponxl' )
		),		
	);
	$meta_boxes[] = array(
		'title' => __( 'Voucher information', 'couponxl' ),
		'pages' => 'voucher',
		'fields' => $voucher_meta,
	);	

	$post_meta_standard = array(
		array(
			'id' => 'iframe_standard',
			'name' => __( 'Embed URL', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input custom URL which will be embeded as the blog post media.', 'couponxl' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Standard Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_standard,
	);	
	
	$post_meta_gallery = array(
		array(
			'id' => 'gallery_images',
			'name' => __( 'Gallery Images', 'couponxl' ),
			'type' => 'image',
			'repeatable' => 1,
			'desc' => __( 'Add images for the gallery post format. Drag and drop to change their order.', 'couponxl' )
		)
	);

	$meta_boxes[] = array(
		'title' => __( 'Gallery Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_gallery,
	);	
	
	
	$post_meta_audio = array(
		array(
			'id' => 'iframe_audio',
			'name' => __( 'Audio URL', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input url to the audio source which will be media for the audio post format.', 'couponxl' )
		),
		
		array(
			'id' => 'audio_type',
			'name' => __( 'Audio Type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'embed' => __( 'Embed', 'couponxl' ),
				'direct' => __( 'Direct Link', 'couponxl' )
			),
			'desc' => __( 'Select format of the audio URL ( Direct Link - for mp3, Embed - for the links from SoundCloud, MixCloud,... ).', 'couponxl' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Audio Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_audio,
	);
	
	$post_meta_video = array(
		array(
			'id' => 'video',
			'name' => __( 'Video URL', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input url to the video source which will be media for the audio post format.', 'couponxl' )
		),
		array(
			'id' => 'video_type',
			'name' => __( 'Video Type', 'couponxl' ),
			'type' => 'select',
			'options' => array(
				'remote' => __( 'Embed', 'couponxl' ),
				'self' => __( 'Direct Link', 'couponxl' ),				
			),
			'desc' => __( 'Select format of the video URL ( Direct Link - for ogg, mp4..., Embed - for the links from YouTube, Vimeo,... ).', 'couponxl' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Video Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_video,
	);
	
	$post_meta_quote = array(
		array(
			'id' => 'blockquote',
			'name' => __( 'Input Quotation', 'couponxl' ),
			'type' => 'textarea',
			'desc' => __( 'Input quote as blog media for the quote post format.', 'couponxl' )
		),
		array(
			'id' => 'cite',
			'name' => __( 'Input Quoted Person\'s Name', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input quoted person\'s name for the quote post format.', 'couponxl' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Quote Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_quote,
	);	

	$post_meta_link = array(
		array(
			'id' => 'link',
			'name' => __( 'Input Link', 'couponxl' ),
			'type' => 'text',
			'desc' => __( 'Input link as blog media for the link post format.', 'couponxl' )
		),
	);
	
	$meta_boxes[] = array(
		'title' => __( 'Link Post Information', 'couponxl' ),
		'pages' => 'post',
		'fields' => $post_meta_link,
	);

	return $meta_boxes;
}

add_filter('sm_meta_boxes', 'couponxl_custom_meta_boxes');
}

/* transform color form hex to rgb */
function couponxl_hex2rgb( $hex ) {
	$hex = str_replace("#", "", $hex);

	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	return $r.", ".$g.", ".$b; 
}

/* format remaining time */
function couponxl_remaining_time( $expire_timestamp, $left_red = 'right' ){
	if( !empty( $expire_timestamp ) && $expire_timestamp != '99999999999' ){
		$diff = $expire_timestamp - current_time( 'timestamp' );

		if( $diff > 0 ){
		
			$secondsInAMinute = 60;
			$secondsInAnHour  = 60 * $secondsInAMinute;
			$secondsInADay    = 24 * $secondsInAnHour;

			/* extract days */
			$days = floor( $diff / $secondsInADay );

			/* extract hours */
			$hourSeconds = $diff % $secondsInADay;
			$hours = floor( $hourSeconds / $secondsInAnHour );

			/* extract minutes */
			$minuteSeconds = $hourSeconds % $secondsInAnHour;
			$minutes = floor( $minuteSeconds / $secondsInAMinute );

			/* extract the remaining seconds */
			$remainingSeconds = $minuteSeconds % $secondsInAMinute;
			$seconds = ceil( $remainingSeconds );	
		
			if( $days > 0 ){
				if( $days == 1 ){
					$remaining = '1 '.__( 'day', 'couponxl' );
				}
				else{
					$remaining = $days.' '.__( 'days', 'couponxl' );
				}
			}
			else if( $hours > 0 ){
				if( $hours == 1 ){
					$remaining = '1 '.__( 'hour', 'couponxl' );
				}
				else{
					$remaining = $hours.' '.__( 'hours', 'couponxl' );
				}
			}
			else if( $minutes > 0 ){
				if( $minutes == 1 ){
					$remaining = '1 '.__( 'minute', 'couponxl' );
				}
				else{
					$remaining = $minutes.' '.__( 'minutes', 'couponxl' );
				}
			}
			else if( $seconds > 0 ){
				if( $seconds == 1 ){
					$remaining = '1 '.__( 'second', 'couponxl' );
				}
				else{
					$remaining = $seconds.' '.__( 'seconds', 'couponxl' );
				}
			}
		}
		else{
			$remaining = __( 'Expired', 'couponxl' );
		}
	}
	else{
		$remaining = __( 'Unlimited Time', 'couponxl' );
	}
	
	if( $left_red == 'right' ){
		return __( 'Expires in: ', 'couponxl' ).'<span class="red-meta">'.$remaining.'</span>';
	}
	else{
		return '<span class="red-meta">'.__( 'Expires in: ', 'couponxl' ).'</span>'.$remaining;
	}
}

/* check if expired */
function couponxl_is_expired( $expire_timestamp ){
	if( current_time( 'timestamp' ) > $expire_timestamp ){
		return true;
	}
	else{
		return false;
	}
}

/* on post save add 0 clicks */
function couponxl_save_post_meta( $post_id, $post ){
	if( $post->post_type == 'offer' ){
		$post_type = get_post_type_object( $post->post_type );
		
		/* Check if the current user has permission to edit the post. */
		if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ){
			return $post_id;
		}
		
		/* Check autosave */
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		
		$meta_value = get_post_meta( $post_id, 'offer_clicks', true );
		if( empty( $meta_value ) ){
			add_post_meta( $post_id, 'offer_clicks', '0', true );
		}
	}
}
add_action( 'save_post', 'couponxl_save_post_meta', 10, 2 );

/* custom walker class to create main top and bottom navigation */
class couponxl_walker extends Walker_Nav_Menu {
  
	/**
	* @see Walker::start_lvl()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param int $depth Depth of page. Used for padding.
	*/
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
	}

	/**
	* @see Walker::start_el()
	* @since 3.0.0
	*
	* @param string $output Passed by reference. Used to append additional content.
	* @param object $item Menu item data object.
	* @param int $depth Depth of menu item. Used for padding.
	* @param int $current_page Menu item ID.
	* @param object $args
	*/
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		/**
		* Dividers, Headers or Disabled
		* =============================
		* Determine whether the item is a Divider, Header, Disabled or regular
		* menu item. To prevent errors we use the strcasecmp() function to so a
		* comparison that is not case sensitive. The strcasecmp() function returns
		* a 0 if the strings are equal.
		*/
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} 
		else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} 
		else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} 
		else {

			$mega_menu_custom = get_post_meta( $item->ID, 'mega-menu-set', true );

			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			if( !empty( $mega_menu_custom ) ){
				$classes[] = 'mega_menu_li';
			}
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			if ( $args->has_children ){
				$class_names .= ' dropdown';
			}
			
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .'>';

			$atts = array();
			$atts['title'] = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel'] = ! empty( $item->xfn )	? $item->xfn	: '';

			// If item has_children add atts to a.
			$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			if ( $args->has_children ) {
				$atts['data-toggle']	= 'dropdown';
				$atts['class']	= 'dropdown-toggle';
				$atts['data-hover']	= 'dropdown';
				$atts['aria-haspopup']	= 'true';
			} 

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;

			/*
			* Glyphicons
			* ===========
			* Since the the menu item is NOT a Divider or Header we check the see
			* if there is a value in the attr_title property. If the attr_title
			* property is NOT null we apply it as the class name for the glyphicon.
			*/

			$item_output .= '<a'. $attributes .'>';
			if ( ! empty( $item->attr_title ) ){
				$item_output .= '<div class="menu-tooltip">'.$item->attr_title.'</div>';
			}

			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			if( !empty( $mega_menu_custom ) ){
				$registered_widgets = wp_get_sidebars_widgets();
				$count = count( $registered_widgets[$mega_menu_custom] );
				$item_output .= ' <i class="fa fa-angle-down"></i>';
				$item_output .= '</a>';
				$mega_menu_min_height = couponxl_get_option( 'mega_menu_min_height' );
				$style = '';
				if( !empty( $mega_menu_min_height ) ){
					$style = 'style="height: '.esc_attr( $mega_menu_min_height ).'"';
				}
				$item_output .= '<ul class="list-unstyled mega_menu col-'.$count.'" '.$style.'>';
				ob_start();
				if( is_active_sidebar( $mega_menu_custom ) ){
					dynamic_sidebar( $mega_menu_custom );
				}
				$item_output .= ob_get_contents();
				ob_end_clean();
				$item_output .= '</ul>';
			}
			else{
				if( $args->has_children && 0 === $depth ){
					$item_output .= ' <i class="fa fa-angle-down"></i>';
				}
				$item_output .= '</a>';
			}
			$item_output .= $args->after;
			
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	/**
	* Traverse elements to create list from elements.
	*
	* Display one element if the element doesn't have any children otherwise,
	* display the element and its children. Will only traverse up to the max
	* depth and no ignore elements under that depth.
	*
	* This method shouldn't be called directly, use the walk() method instead.
	*
	* @see Walker::start_el()
	* @since 2.5.0
	*
	* @param object $element Data object
	* @param array $children_elements List of elements to continue traversing.
	* @param int $max_depth Max depth to traverse.
	* @param int $depth Depth of current element.
	* @param array $args
	* @param string $output Passed by reference. Used to append additional content.
	* @return null Null on failure with no changes to parameters.
	*/
	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
		if ( ! $element )
			return;

		$id_field = $this->db_fields['id'];

		// Display this element.
		if ( is_object( $args[0] ) ){
		   $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

	/**
	* Menu Fallback
	* =============
	* If this function is assigned to the wp_nav_menu's fallback_cb variable
	* and a manu has not been assigned to the theme location in the WordPress
	* menu manager the function with display nothing to a non-logged in user,
	* and will add a link to the WordPress menu manager if logged in as an admin.
	*
	* @param array $args passed from the wp_nav_menu function.
	*
	*/
	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id ){
					$fb_output .= ' id="' . $container_id . '"';
				}

				if ( $container_class ){
					$fb_output .= ' class="' . $container_class . '"';
				}

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id ){
				$fb_output .= ' id="' . $menu_id . '"';
			}

			if ( $menu_class ){
				$fb_output .= ' class="' . $menu_class . '"';
			}

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
			$fb_output .= '</ul>';

			if ( $container ){
				$fb_output .= '</' . $container . '>';
			}

			echo $fb_output;
		}
	}
}

/* set sizes for cloud widget */
function couponxl_custom_tag_cloud_widget($args) {
	$args['largest'] = 18; //largest tag
	$args['smallest'] = 10; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'couponxl_custom_tag_cloud_widget' );

/* format wp_link_pages so it has the right css applied to it */
function couponxl_link_pages(){
	$post_pages = wp_link_pages( 
		array(
			'before' 		   => '',
			'after' 		   => '',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'next_or_number'   => 'number',
			'nextpagelink'     => __( '&raquo;', 'couponxl' ),
			'previouspagelink' => __( '&laquo;', 'couponxl' ),			
			'separator'        => ' ',
			'echo'			   => 0
		) 
	);
	/* format pages that are not current ones */
	$post_pages = str_replace( '<a', '<li><a', $post_pages );
	$post_pages = str_replace( '</span></a>', '</a></li>', $post_pages );
	$post_pages = str_replace( '><span>', '>', $post_pages );
	
	/* format current page */
	$post_pages = str_replace( '<span>', '<li class="active"><a href="javascript:;">', $post_pages );
	$post_pages = str_replace( '</span>', '</a></li>', $post_pages );
	
	return $post_pages;
}

/* create tags list */
function couponxl_tags_list(){
	$tags = get_the_tags();
	$tag_list = array();
	if( !empty( $tags ) ){
		foreach( $tags as $tag ){
			$tag_list[] = '<a href="'.esc_url( get_tag_link( $tag->term_id ) ).'">'.$tag->name.'</a>';
		}
	}
	return join( ', ', $tag_list );
}

function couponxl_taxonomy( $taxonomy, $num = '', $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$offers_cats_array = array();

	$terms = get_the_terms( $post_id, $taxonomy );
	if( empty( $num ) ){
		$num = count( $terms );
	}
	if( !empty( $terms ) ){
		for( $i=0; $i<$num; $i++ ){
			$term = array_shift( $terms );
			$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
			$offers_cats_array[] = '<a href="'.esc_url( couponxl_append_query_string( $permalink, array( $taxonomy => $term->slug ), array( 'all' ) ) ).'">'.$term->name.'</a>';
		}
	}

	return join( ' ', $offers_cats_array );
}

function couponxl_offer_tags( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$offer_tags_array = array();

	$terms = get_the_terms( $post_id, 'offer_tag' );
	if( !empty( $terms ) ){
		foreach( $terms as $term ){
			$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
			$offer_tags_array[] = '<a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'offer_tag' => $term->slug ), array() ) ).'">'.$term->name.'</a>';
		}
	}

	return join( ', ', $offer_tags_array );
}


/* limit excerpt */
function couponxl_the_excerpt(){
	$excerpt = get_the_excerpt();
	if( strlen( $excerpt ) > 167 ){
		$excerpt = substr( $excerpt, 0 , 167 );
		$excerpt = substr( $excerpt, 0, strripos ( $excerpt, " " ) );
		$excerpt = $excerpt . '...' ;
	}
	
	return '<p>'.$excerpt.'</p>';
}


/* create categories list */
function couponxl_categories_list(){
	$category_list = get_the_category();
	$categories = array();
	if( !empty( $category_list ) ){
		foreach( $category_list as $category ){
			$categories[] = '<a href="'.esc_url( get_category_link( $category->term_id ) ).'">'.$category->name.'</a>';
		}
	}
	
	return join( ', ', $categories );
}

/* format pagination so it has correct style applied to it */
function couponxl_format_pagination( $page_links ){
	global $couponxl_slugs;
	$list = '';
	if( !empty( $page_links ) ){
		foreach( $page_links as $page_link ){
			if( strpos( $page_link, 'page-numbers current' ) !== false ){
				$page_link = str_replace( "<span class='page-numbers current'>", '<a href="javascript:;">', $page_link );
				$page_link = str_replace( '</span>', '</a>', $page_link );
				$list .= '<li class="active">'.$page_link.'</li>';
			}
			else{
				if( get_query_var( $couponxl_slugs['coupon'] ) && get_option('permalink_structure') ){
					$page_link = preg_replace( '#coupon\\/(.*?)/#i', '', $page_link, -1 );
				}
				else{
					$page_link = preg_replace( '#(&\\#038\\;'.$couponxl_slugs['coupon'].'|&'.$couponxl_slugs['coupon'].')=(.*?)&#i', '&', $page_link );
					$page_link = preg_replace( '#(&\\#038\\;'.$couponxl_slugs['coupon'].'|&'.$couponxl_slugs['coupon'].')=(.*?)\'#i', '\'', $page_link );
				}				
				$list .= '<li>'.$page_link.'</li>';
			}
			
		}
	}
	
	return $list;
}

/*generate random password*/
function couponxl_random_string( $length = 10 ) {
	$characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random = '';
	for ($i = 0; $i < $length; $i++) {
		$random .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random;
}


/* add the ... at the end of the excerpt */
function couponxl_new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'couponxl_new_excerpt_more');

/* create options for the select box in the category icon select */
function couponxl_icons_list( $value ){
	$icons_list = couponxl_awesome_icons_list();
	
	$select_data = '';
	
	foreach( $icons_list as $key => $label){
		$select_data .= '<option value="'.esc_attr( $key ).'" '.( $value == $key ? 'selected="selected"' : '' ).'>'.$label.'</option>';
	}
	
	return $select_data;
}

function couponxl_send_contact(){
	$errors = array();
	$name = isset( $_POST['name'] ) ? esc_sql( $_POST['name'] ) : '';
	$email = isset( $_POST['email'] ) ? esc_sql( $_POST['email'] ) : '';
	$message = isset( $_POST['message'] ) ? esc_sql( $_POST['message'] ) : '';
	if( !isset( $_POST['captcha'] ) ){
		if( !empty( $name ) && !empty( $email ) && !empty( $message ) ){
			if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
				$email_to = couponxl_get_option( 'contact_mail' );
				$subject = couponxl_get_option( 'contact_form_subject' );
				if( !empty( $email_to ) ){
					$message = "
						".__( 'Name: ', 'couponxl' )." {$name} \n
						".__( 'Email: ', 'couponxl' )." {$email} \n
						".__( 'Message: ', 'couponxl' )."\n {$message} \n
					";
					$info = @wp_mail( $email_to, $subject, $message );
					if( $info ){
						echo json_encode(array(
							'success' => __( 'Your message was successfully submitted.', 'couponxl' ),
						));
						die();
					}
					else{
						echo json_encode(array(
							'error' => __( 'Unexpected error while attempting to send e-mail.', 'couponxl' ),
						));
						die();
					}
				}
				else{
					echo json_encode(array(
						'error' => __( 'Message is not send since the recepient email is not yet set.', 'couponxl' ),
					));
					die();
				}
			}
			else{
				echo json_encode(array(
					'error' => __( 'Email is not valid.', 'couponxl' ),
				));
				die();
			}
		}
		else{
			echo json_encode(array(
				'error' => __( 'All fields are required.', 'couponxl' ),
			));
			die();
		}
	}
	else{
		echo json_encode(array(
			'error' => __( 'Captcha is wrong.', 'couponxl' ),
		));
		die();
	}
}
add_action('wp_ajax_contact', 'couponxl_send_contact');
add_action('wp_ajax_nopriv_contact', 'couponxl_send_contact');


function couponxl_send_subscription( $email = '' ){
	$email = !empty( $email ) ? $email : $_POST["email"];
	$response = array();	
	if( filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		require_once( locate_template( 'includes/mailchimp.php' ) );
		$chimp_api = couponxl_get_option("mail_chimp_api");
		$chimp_list_id = couponxl_get_option("mail_chimp_list_id");
		if( !empty( $chimp_api ) && !empty( $chimp_list_id ) ){
			$mc = new MailChimp( $chimp_api );
			$result = $mc->call('lists/subscribe', array(
				'id'                => $chimp_list_id,
				'email'             => array( 'email' => $email )
			));
			
			if( $result === false) {
				$response['error'] = __( 'There was an error contacting the API, please try again.', 'couponxl' );
			}
			else if( isset($result['status']) && $result['status'] == 'error' ){
				$response['error'] = $result['error'];
			}
			else{
				$response['success'] = __( 'You have successfully subscribed to the newsletter.', 'couponxl' );
			}
			
		}
		else{
			$response['error'] = __( 'API data are not yet set.', 'couponxl' );
		}
	}
	else{
		$response['error'] = __( 'Email is empty or invalid.', 'couponxl' );
	}
	
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_subscribe', 'couponxl_send_subscription');
add_action('wp_ajax_nopriv_subscribe', 'couponxl_send_subscription');


/* gte list of the popular shops */
function couponxl_popular_stores( $limit ){
	global $wpdb;
	$popular_stores = array();
	$query = "SELECT posts.ID, postmeta1.meta_value, SUM(postmeta2.meta_value) as clicks_sum 
				FROM {$wpdb->posts} as posts
				INNER JOIN {$wpdb->postmeta} as postmeta1 ON posts.ID = postmeta1.meta_value
				INNER JOIN {$wpdb->postmeta} as postmeta2 ON postmeta1.post_id = postmeta2.post_id 
				WHERE postmeta1.meta_key = 'offer_store' AND    postmeta2.meta_key = 'offer_clicks' 
				GROUP BY postmeta1.meta_value ORDER BY clicks_sum DESC LIMIT {$limit}";
	$results = $wpdb->get_results( $query );
	if( !empty( $results ) ){
		$popular_stores = $results;
	}
	return $popular_stores;
}

function couponxl_get_avatar_url( $get_avatar ){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
	if( empty( $matches[1] ) ){
		preg_match("/src=\"(.*?)\"/i", $get_avatar, $matches);
	}
    return $matches[1];
}

function couponxl_embed_html( $html ) {
    return '<div class="video-container">' . $html . '</div>';
}
add_filter( 'embed_oembed_html', 'couponxl_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'couponxl_embed_html' ); // Jetpack

function couponxl_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	$add_below = ''; 
	?>
	<!-- comment-1 -->
	<div class="media <?php echo $depth > 1 ? 'left-padding' : ''; ?>">
		<div class="comment-inner">
			<?php 
			$avatar = couponxl_get_avatar_url( get_avatar( $comment, 75 ) );
			if( !empty( $avatar ) ): ?>
				<a class="pull-left" href="javascript:;">
					<img src="<?php echo esc_url( $avatar ); ?>" class="media-object comment-avatar" title="" alt="">
				</a>
			<?php endif; ?>
			<div class="media-body comment-body">
				<div class="pull-left">
					<h4><?php comment_author(); ?></h4>
					<span><?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . __( ' ago', 'couponxl' ); ?></span>
				</div>
				<div class="pull-right">
					<?php
						comment_reply_link( 
							array_merge( 
								$args, 
								array( 
									'reply_text' => '<span class="fa fa-reply"></span>', 
									'add_below' => $add_below, 
									'depth' => $depth, 
									'max_depth' => $args['max_depth'] 
								) 
							) 
						);
					?>
				</div>
				<div class="clearfix"></div>
				<?php 
				if ($comment->comment_approved != '0'){
				?>
					<p><?php echo get_comment_text(); ?></p>
				<?php 
				}
				else{ ?>
					<p><?php _e('Your comment is awaiting moderation.', 'couponxl'); ?></p>
				<?php
				}
				?>				
			</div>
		</div>
	</div>
	<!-- .comment-1 -->	
	<?php  
}

function couponxl_end_comments(){
	return "";
}

/* check if the blog has any media */
function couponxl_has_media(){
	$post_format = get_post_format();
	switch( $post_format ){
		case 'aside' : 
			return has_post_thumbnail() ? true : false; break;
			
		case 'audio' :
			$iframe_audio = get_post_meta( get_the_ID(), 'iframe_audio', true );
			if( !empty( $iframe_audio ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		case 'chat' : 
			return has_post_thumbnail() ? true : false; break;
		
		case 'gallery' :
			$post_meta = get_post_custom();
			$gallery_images = couponxl_smeta_images( 'gallery_images', get_the_ID(), array() );		
			if( !empty( $gallery_images ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}			
			else{
				return false;
			}
			break;
			
		case 'image':
			return has_post_thumbnail() ? true : false; break;
			
		case 'link' :
			$link = get_post_meta( get_the_ID(), 'link', true );
			if( !empty( $link ) ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		case 'quote' :
			$blockquote = get_post_meta( get_the_ID(), 'blockquote', true );
			$cite = get_post_meta( get_the_ID(), 'cite', true );
			if( !empty( $blockquote ) || !empty( $cite ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
		
		case 'status' :
			return has_post_thumbnail() ? true : false; break;
	
		case 'video' :
			$video = get_post_meta( get_the_ID(), 'video', true );
			if( !empty( $video ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
			
		default: 
			$iframe_standard = get_post_meta( get_the_ID(), 'iframe_standard', true );
			if( !empty( $iframe_standard ) ){
				return true;
			}
			else if( has_post_thumbnail() ){
				return true;
			}
			else{
				return false;
			}
			break;
	}	
}

function couponxl_store_logo( $store_id = '', $echo = true ){
	if( empty( $store_id ) ){
		$store_id = get_the_ID();
	}
    if( has_post_thumbnail( $store_id ) ){
    	if( $echo ){
        	echo get_the_post_thumbnail( $store_id, 'shop_logo', array( 'class' => 'img-responsive' ) );
        }
        else{
        	return get_the_post_thumbnail( $store_id, 'shop_logo', array( 'class' => 'img-responsive' ) );
        }
    }
}

function couponxl_calculate_owner_part( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$owned_part = '';

	$deal_sale_price = get_post_meta( $post_id, 'deal_sale_price', true );
	$deal_owner_price = get_post_meta( $post_id, 'deal_owner_price', true );
	$deal_type = get_post_meta( $post_id, 'deal_type', true );

	if( empty( $deal_owner_price ) ){
		if( $deal_type = 'shared' ){
			$deal_owner_price = couponxl_get_option( 'deal_owner_price_shared' );
		}
		else{
			$deal_owner_price = couponxl_get_option( 'deal_owner_price_not_shared' );	
		}
	}

	if( stristr( $deal_owner_price, '%' ) ){
		$deal_owner_price = str_replace( '%', '', $deal_owner_price );
		$deal_owner_price = round( ($deal_owner_price / 100) * $deal_sale_price, 2 );
	}	

	return $deal_owner_price;
}

function couponxl_get_deal_amount( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$deal_type = get_post_meta( $post_id, 'deal_type', true );
	$deal_sale_price = get_post_meta( $post_id, 'deal_sale_price', true );

	if( $deal_type == 'shared' ){
		return $deal_sale_price;
	}
	else{
		return couponxl_calculate_owner_part( $post_id );
	}
}


function couponxl_get_deal_price( $post_id = '' ){
	if( empty( $post_id ) ){
		$post_id = get_the_ID();
	}

	$deal_type = get_post_meta( $post_id, 'deal_type', true );
	$deal_price = get_post_meta( $post_id, 'deal_price', true );
	$deal_sale_price = get_post_meta( $post_id, 'deal_sale_price', true );

	if( $deal_type == 'shared' ){
		return '<h2 class="price">'.couponxl_format_price_number( $deal_sale_price ).' <span class="price-sale">'.couponxl_format_price_number( $deal_price ).'</span></h2>';
	}
	else{
		$owned_part = couponxl_calculate_owner_part( $post_id );
		return '<h2 class="price">'.couponxl_format_price_number( $owned_part ).'</h2>';	
	}
}


/* MANAGE RATINGS */
function couponxl_ratings_box() {

	$screens = array( 'offer', 'post' );

	foreach ( $screens as $screen ) {
		add_meta_box(
			'couponxl_ratings',
			__( 'Manage Ratings', 'couponxl' ),
			'couponxl_ratings_box_populate',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'couponxl_ratings_box' );

function couponxl_ratings_box_populate( $post ){
	$couponxl_ratings = get_post_meta( $post->ID, 'couponxl_rating' );

	echo '<textarea name="ratings" style="min-height: 300px; width: 100%">'.join("\n", $couponxl_ratings).'</textarea>';
}

function couponxl_save_ratings( $post_id ) {
	global $wpdb;
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && ( 'code' == $_POST['post_type'] || 'daily_offer' == $_POST['post_type'] ) ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( ! isset( $_POST['ratings'] ) ) {
		return;
	}

	if( !empty( $_POST['ratings'] ) ){

		$ratings = explode( "\n", $_POST['ratings'] );
		delete_post_meta( $post_id, 'couponxl_rating' );
		delete_post_meta( $post_id, 'couponxl_average_rate' );
		$sum = 0;
		foreach( $ratings as $rate ){			
			if( strpos( $rate, "|" ) ){
				$temp = explode( "|", $rate );
				$sum += $temp[1];
				$wpdb->insert( 
					$wpdb->postmeta,
					array( 
						'post_id' => $post_id,
						'meta_key' => 'couponxl_rating',
						'meta_value' => $rate
					), 
					array( 
						'%d',
						'%s',
						'%s'
					) 
				);
			}		
		}
		add_post_meta( $post_id, 'couponxl_average_rate', $sum / sizeof( $ratings ) );
	}
}
add_action( 'save_post', 'couponxl_save_ratings' );


function couponxl_get_deepest_taxonomy( $source ){
	$organize_list = array();
	if( sizeof( $source ) == 1 ){
		return array_pop( $source );
	}
	sort_terms_hierarchicaly( $source, $organize_list );
	$organize_list = (array)$organize_list;
	if( !empty( $organize_list ) ){
		$last_item = array_pop( $organize_list );
		if( empty( $last_item->children ) ){
			return $last_item;
		}
		else{
			return couponxl_deepest_taxonomy( $last_item->children );
		}
	}
}

function couponxl_deepest_taxonomy( $children ){
	$last_item = array_pop( $children );
	if( empty( $last_item->children ) ){
		return $last_item;
	}
	else{
		$last_one = couponxl_deepest_taxonomy( $last_item->children );
	}
	return $last_one;
}


function sort_terms_hierarchicaly(Array &$cats, Array &$into, $parentId = 0){
    foreach ($cats as $i => $cat) {
        if ($cat->parent == $parentId) {
            $into[$cat->term_id] = $cat;
            unset($cats[$i]);
        }
    }

    foreach ($into as $topCat) {
        $topCat->children = array();
        sort_terms_hierarchicaly($cats, $topCat->children, $topCat->term_id);
    }
}

function couponxl_get_organized( $taxonomy ){
	$categories = get_terms( $taxonomy, array('hide_empty' => false));
	$taxonomy_organized = array();
	sort_terms_hierarchicaly($categories, $taxonomy_organized);
	$taxonomy_organized =  (array) $taxonomy_organized;

	if( $taxonomy == 'offer_cat' ){
		$sortby = couponxl_get_option( 'all_categories_sortby' );
		$sort = couponxl_get_option( 'all_categories_sort' );
	}
	else{
		$sortby = couponxl_get_option( 'all_locations_sortby' );
		$sort = couponxl_get_option( 'all_locations_sort' );
	}


	if( $sort == 'asc' ){
		switch( $sortby ){
			case 'name' : usort( $taxonomy_organized, "couponxl_organized_sort_name_asc" ); break;
			case 'slug' : usort( $taxonomy_organized, "couponxl_organized_sort_slug_asc" ); break;
			case 'count' : usort( $taxonomy_organized, "couponxl_organized_sort_count_asc" ); break;
			default : usort( $taxonomy_organized, "couponxl_organized_sort_name_asc" ); break;
		}
		
	}
	else{
		switch( $sortby ){
			case 'name' : usort( $taxonomy_organized, "couponxl_organized_sort_name_desc" ); break;
			case 'slug' : usort( $taxonomy_organized, "couponxl_organized_sort_slug_desc" ); break;
			case 'count' : usort( $taxonomy_organized, "couponxl_organized_sort_count_desc" ); break;
			default : usort( $taxonomy_organized, "couponxl_organized_sort_name_desc" ); break;
		}
	}
	return $taxonomy_organized;

}


function couponxl_organized_sort_name_asc( $a, $b ){
    return strcmp( $a->name, $b->name );
}


function couponxl_organized_sort_name_desc( $a, $b ){
    return strcmp( $b->name, $a->name );
}


function couponxl_organized_sort_slug_asc( $a, $b ){
    return strcmp( $a->slug, $b->slug );
}



function couponxl_organized_sort_slug_desc( $a, $b ){
    return strcmp( $b->slug, $a->slug );
}



function couponxl_organized_sort_count_asc( $a, $b ){
    return strcmp( $a->count, $b->count );
}



function couponxl_organized_sort_count_desc( $a, $b ){
    return strcmp( $b->count, $a->count );
}



function couponxl_display_select_tree( $cat, $selected = '', $level = 0 ){
	if( !empty( $cat->children ) ){
		echo '<option value="" disabled>'.str_repeat( '&nbsp;&nbsp;', $level ).''.$cat->name.'</option>';
		$level++;
		foreach( $cat->children as $key => $child ){
			couponxl_display_select_tree( $child, $selected, $level );
		}
	}
	else{
		echo '<option value="'.$cat->term_id.'" '.( $cat->term_id == $selected ? 'selected="selected"' : '' ).'>'.str_repeat( '&nbsp;&nbsp;', $level ).''.$cat->name.'</option>';
	}
}



function couponxl_display_indent_select_tree( $term, $categories, $indent ){
	echo '<option style="padding-left:'.( 10*$indent ).'px;" value="'.esc_attr( $term->slug ).'" '.( in_array( $term->slug, $categories ) ? 'selected="selected"' : '' ).'>'.$term->name.'</option>';	
	if( !empty( $term->children ) ){
		$indent++;
		foreach( $term->children as $key => $child ){
			couponxl_display_indent_select_tree( $child, $categories, $indent );
		}
	}
}



function couponxl_display_tree( $cat, $taxonomy ){
	echo '<ul class="list-unstyled">';
	foreach( $cat->children as $key => $child ){
		echo '<li>
				<a href="'.esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( $taxonomy => $child->slug ), array() ) ).'">'.$child->name.'</a>
				<span class="count">'.$child->count.'</span>';
				if( !empty( $child->children ) ){
					couponxl_display_tree( $child, $taxonomy );
				}				
		echo '</li>';
	}
    echo '</ul>';

}



function couponxl_ucfirst( $string ){
	$strlen = mb_strlen( $string );
	$firstChar = mb_substr( $string, 0, 1 );
	$then = mb_substr($string, 1, $strlen - 1 );
	return mb_strtoupper( $firstChar ) . $then;
}



function couponxl_search_options(){
	$search_by = esc_sql( $_POST['search_by'] );
	$value = mb_strtolower( esc_sql( $_POST['val'] ) );
	global $wpdb, $couponxl_slugs;
	$list = array();	
	if( $search_by == $couponxl_slugs['location'] ){
		$locations = get_terms( 'location', array(
			'name__like' => $value,
			'hide_empty' => false
		) );
		if( !empty( $locations ) ){
			foreach( $locations as $location ){
				if( mb_strpos( mb_strtolower( $location->name ), $value ) === 0 ){
					$name = str_replace( couponxl_ucfirst($value), '<strong>'.couponxl_ucfirst($value).'</strong>', $location->name );
					$list[] = array(
						'name' => $name,
						'slug' => $location->slug,
					);
				}
			}
		}
		else{
			$list[] = array(
				'name' => __( 'We could not find that location', 'couponxl' ),
				'slug' => '',
			);
		}
	}
	else if( $search_by == $couponxl_slugs['offer_store'] ){
		$stores = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT ID, post_title FROM {$wpdb->posts} AS posts WHERE posts.post_type = 'store' AND posts.post_status = 'publish' AND posts.post_title LIKE %s",
				"%$value%"
			)
		);
		if( !empty( $stores ) ){
			foreach( $stores as $store ){
				if( mb_strpos( mb_strtolower( $store->post_title ), $value ) === 0 ){
					$post_title = str_replace( couponxl_ucfirst($value), '<strong>'.couponxl_ucfirst($value).'</strong>', $store->post_title );
					$list[] = array(
						'name' => $post_title,
						'slug' => $store->ID,
					);
				}
			}
		}
		else{
			$list[] = array(
				'name' => __( 'We could not find that store', 'couponxl' ),
				'slug' => '',
			);
		}		
	}
	echo json_encode( $list );
	die();
}
add_action('wp_ajax_search_options', 'couponxl_search_options');
add_action('wp_ajax_nopriv_search_options', 'couponxl_search_options');


function couponxl_show_code(){
	$offer_id = esc_sql( $_POST['offer_id'] );
	couponxl_register_click( $offer_id );
	$offer = get_post( $offer_id );
	$offer_modal = '';
	if( !empty( $offer ) ){
		$offer_store = get_post_meta( $offer_id, 'offer_store', true );
		$coupon_type = get_post_meta( $offer_id, 'coupon_type', true );

		$coupon_link_with_code = get_post_meta( $offer_id, 'coupon_link_with_code', true );

		$store_link = get_post_meta( $offer_store, 'store_link', true );
		?>
        <?php if( !empty( $store_link ) ): ?>
            <a href="<?php echo esc_url( add_query_arg( array( 'rs' => $offer_store ), get_permalink( $offer_store ) ) ) ?>" target="_blank">
        <?php endif; ?>
			<?php couponxl_store_logo( $offer_store ); ?>
        <?php if( !empty( $store_link ) ): ?>
            </a>
        <?php endif; ?>			

		<hr>

		<h4><?php echo $offer->post_title; ?></h4>
		<?php
		if( $coupon_type == 'code' ){
			$coupon_code = get_post_meta( $offer_id, 'coupon_code', true );
			echo '<input type="text" class="coupon-code-modal" readonly="readonly" value="'.esc_attr( $coupon_code ).'" />';
			echo '<p class="coupon-code-copied" data-aftertext="'.__( 'Code is copied.', 'couponxl' ).'">'.__( 'Click the code to auto copy.', 'couponxl' ).'</p>';
		}
		else if( $coupon_type == 'printable' ){
			$coupon_image = get_post_meta( $offer_id, 'coupon_image', true );
			echo wp_get_attachment_image( $coupon_image, 'full', 0, array( 'class' => 'coupon-print-image' ) );
			echo '<a class="coupon-code-modal print" href="javascript:print();">'.__( 'PRINT', 'couponxl' ).'</a>';
		}
		else if( $coupon_type == 'sale' ){
			$coupon_sale = get_post_meta( $offer_id, 'coupon_sale', true );
			echo '<a class="coupon-code-modal" href="'.esc_url( $coupon_sale ).'" target="_blank">'.__( 'SEE SALE', 'couponxl' ).'</a>';
		}		
		?>

        <ul class="list-unstyled list-inline store-social-networks">
            <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $offer_id ) ) ?>" class="share" target="_blank">
                    <i class="fa fa-facebook"></i>
                </a>
            </li>
            <li>
                <a href="http://twitter.com/intent/tweet?source=<?php echo esc_attr( get_bloginfo('name') ) ?>&amp;text=<?php echo urlencode( get_permalink( $offer_id ) ) ?>" class="share" target="_blank">
                    <i class="fa fa-twitter"></i>
                </a>
            </li>
            <li>
                <a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $offer_id ) ) ?>" class="share" target="_blank">
                    <i class="fa fa-google-plus"></i>
                </a>
            </li>                     
        </ul>

		<?php 
		$coupon_modal_content = couponxl_get_option( 'coupon_modal_content' );
		if( $coupon_modal_content == 'content' ){
			echo apply_filters( 'the_content', $offer->post_content );	
		}
		else{
			echo $offer->post_excerpt;	
		}
		?>

		<div class="code-footer">
			<a href="<?php echo get_permalink( $offer_store ) ?>">
				<?php echo __( 'See all ', 'couponxl' ).get_the_title( $offer_store ).__( ' Coupons & Deals', 'couponxl' ); ?>
			</a>
			<?php if( !empty( $coupon_link_with_code ) ): ?>
				<a href="<?php echo esc_url( $coupon_link_with_code ) ?>" class="store-with-code">
					<?php _e( 'Visit Store With Code', 'couponxl' ) ?>
				</a>
			<?php endif; ?>
		</div>

		<?php
	}
	die();
}
add_action('wp_ajax_show_code', 'couponxl_show_code');
add_action('wp_ajax_nopriv_show_code', 'couponxl_show_code');

function couponxl_deal_voucher_count( $offer_id = '' ){
	if( empty( $offer_id ) ){
		$offer_id = get_the_ID();
	}
	global $wpdb;
	$deal_vouchers = $wpdb->get_results(
		$wpdb->prepare(
			"SELECT COUNT(*) AS vouchers FROM {$wpdb->postmeta} WHERE meta_key = 'voucher_deal' AND meta_value = %d",
			$offer_id
		)
	);
	$deal_vouchers = array_shift( $deal_vouchers );	

	return $deal_vouchers->vouchers;
}


function couponxl_check_offer( $offer_id = '', $offer_type = 'coupon' ){
	if( empty( $offer_id ) ){
		$offer_id = get_the_ID();
	}
	$deal_vouchers = couponxl_deal_voucher_count( $offer_id );

	$offer_start = get_post_meta( $offer_id, 'offer_start', true );
	$offer_expire = get_post_meta( $offer_id, 'offer_expire', true );
	$current_time = current_time( 'timestamp' );

	$available = true;

	if( !empty( $offer_start ) && $offer_start > $current_time ){
		$available = false;
	}
	else if( !empty( $offer_expire ) && $offer_expire < $current_time ){
		$available = false;
	}

	if( $offer_type = 'deal' ){
		$deal_items = get_post_meta( $offer_id, 'deal_items', true );
		if( $deal_items - $deal_vouchers <= 0 ){
			$available = false;
		}
	}

	return $available;
}

/* PAYPAL */
function couponxl_generate_paypal_link( $amount, $title, $desc, $uniq, $cancelUrl, $returnUrl ){
	$paypal = new PayPal(array(
		'username' => couponxl_get_option( 'paypal_username' ),
		'password' => couponxl_get_option( 'paypal_password' ),
		'signature' => couponxl_get_option( 'paypal_signature' ),
		'cancelUrl' => $cancelUrl,
		'returnUrl' => $returnUrl,
	));	

	$pdata = array(
		'PAYMENTREQUEST_0_PAYMENTACTION' => "SALE",
		'L_PAYMENTREQUEST_0_NAME0' => $title,
		'L_PAYMENTREQUEST_0_NUMBER0' => $uniq,
		'L_PAYMENTREQUEST_0_DESC0' => __( 'Buying Deal', 'couonxl' ),
		'L_PAYMENTREQUEST_0_AMT0' => $amount,
		'L_PAYMENTREQUEST_0_QTY0' => 1,
		'NOSHIPPING' => 1,
		'PAYMENTREQUEST_0_CURRENCYCODE' => couponxl_get_option( 'main_unit_abbr' ),
		'PAYMENTREQUEST_0_AMT' => $amount
	);

	$response = $paypal->SetExpressCheckout( $pdata );
	return $response;
}


function couponxl_offer_submit_paypal_link( $offer_id, $action = 'add' ){
	$offer_type = get_post_meta( $offer_id, 'offer_type', true );
	if( $offer_type == 'coupon' ){
		$subpage = 'my_coupons';
		$amount = couponxl_get_option( 'coupon_submit_price' );
	}
	else{
		$subpage = 'my_deals';
		$amount = couponxl_get_option( 'deal_submit_price' );
	}

	$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );

	if( $action == 'add' ){
		$link_text = __( 'this link', 'couponxl' );
	}
	else{
		$link_text = __( 'Not paid', 'couponxl' );
		$action = 'add';
	}

	$response = couponxl_buy_pay_link(
		$offer_id,
		$link_text,
		__( 'Processing...', 'couponxl' ),
		$permalink,
		add_query_arg( array( 'subpage' => $subpage, 'action' => $action, 'paypal' => 'yes', 'subaction' => 'remove_offer', 'offer_id' => $offer_id ), $permalink ),
		add_query_arg( array( 'subpage' => $subpage, 'action' => $action, 'paypal' => 'yes', 'subaction' => 'paid_offer', 'offer_id' => $offer_id ), $permalink ),
		$amount,
		false
	);

	return $response;
}

function couponxl_offer_paypal_link_ajax(){
	$offer_id = $_POST['offer_id'];
	$response = couponxl_offer_submit_paypal_link( $offer_id );
	echo json_encode( $response );
	die();
}
add_action('wp_ajax_offer_paypal_link', 'couponxl_offer_paypal_link_ajax');
add_action('wp_ajax_nopriv_offer_paypal_link', 'couponxl_offer_paypal_link_ajax');


function couponxl_skrill_form( $amount, $currency, $offer_id, $offer_title, $return_url, $status_url ){
	return '
	<form class="hidden" action="https://www.moneybookers.com/app/payment.pl" method="post">
		<input type="hidden" name="pay_to_email" value="'.esc_attr( couponxl_get_option( 'skrill_owner_mail' ) ).'"/>
		<input type="hidden" name="status_url" value="'.esc_url( $status_url ).'"/> 
		<input type="hidden" name="language" value="EN"/>
		<input type="hidden" name="return_url" value="'.esc_url( $return_url ).'"/>
		<input type="hidden" name="amount" value="'.esc_attr( $amount ).'"/>
		<input type="hidden" name="currency" value="'.esc_attr( $currency ).'"/>	
		<input type="hidden" name="detail1_text " value="'.esc_attr( $offer_title ).'"/>	
	</form>
	';
}

function couponxl_ideal_form( $amount, $currency, $offer_id, $offer_title, $return_url, $status_url ){
	$mollie_id = couponxl_get_option( 'mollie_id' );
	$iDEAL = new Couponxl_Mollie_iDEAL_Payment ( $mollie_id );
	if( couponxl_get_option( 'ideal_mode' ) == 'test' ){
		$iDEAL->setTestmode(true);
	}
	$form = '';
	$bank_array = $iDEAL->getBanks();
	if( $bank_array ){
		$form = '<form method="post" class="ideal-payment">
			<select name="bank_id">
				<option value="">'.__( 'Select Your Bank', 'couponxl' ).'</option>';
		foreach( $bank_array as $bank_id => $bank_name ){
			$form .= '<option value="'.esc_attr( $bank_id ).'">'.$bank_name.'</option>';
		}
		$form .= '</select>';
		$form .= '<input type="hidden" name="currency" value="'.esc_attr( $currency ).'"/>
				  <input type="hidden" name="return_url" value="'.esc_url( $return_url ).'"/>
				  <input type="hidden" name="status_url" value="'.esc_url( $status_url ).'"/> 
				  <input type="hidden" name="offer_id" value="'.esc_attr( $offer_id ).'"/> 
				  <input type="hidden" name="action" value="ideal_link"/> 
				  </form>';
	}

	return $form;
}

function couponxl_payu_form( $offer_id = '', $return_url = '', $is_submit = false ){
	
	if( empty( $offer_id ) ){
		$offer_id = $_POST['offer_id'];
	}
	if( empty( $return_url ) ){
		$return_url = $_POST['return_url'];
	}
	if( empty( $return_url ) ){
		$return_url = $_POST['return_url'];
	}

	$return = '';
	$check_offer_availability = couponxl_check_offer( $offer_id );
	if( $check_offer_availability || $is_submit ){
		$buyer_id = get_current_user_id();
		$offer = get_post( $offer_id );
		if( $is_submit ){
			$offer_type = get_post_meta( $offer_id, 'offer_type', true );
			if( $offer_type == 'coupon' ){
				$amount = couponxl_get_option( 'coupon_submit_price' );
			}
			else{
				$amount = couponxl_get_option( 'deal_submit_price' );
			}			
		}
		else{
			$amount = couponxl_get_deal_amount( $offer_id );
		}
		$first_name = get_user_meta( $buyer_id, 'first_name', true );
		$phone_number = get_user_meta( $buyer_id, 'phone_number', true );
		if( isset( $_POST['payu_name'] ) ){
			$first_name = $_POST['payu_name'];
			update_user_meta( $buyer_id, 'first_name', $first_name );
		}
		if( isset( $_POST['payu_phone'] ) ){
			$phone_number = $_POST['payu_phone'];
			update_user_meta( $buyer_id, 'phone_number', $phone_number );
		}		
		if( empty( $first_name ) || empty( $phone_number ) ){
			$return = '
				<form class="payu-form payu-additional">
					'.( empty( $first_name ) ? '
						<div class="input-group">
							<label for="payu_name">FIRST NAME <span class="required">*</span></label>
							<input type="text" id="payu_name" name="payu_name" class="form-control">
						</div>' 
						: '' 
					).'
					'.( empty( $phone_number ) ? '
						<div class="input-group">
							<label for="payu_phone">'.__( 'PHONE NUMBER', 'couponxl' ).' <span class="required">*</span></label>
							<input type="text" id="payu_phone" name="payu_phone" class="form-control">
						</div>' 
						: '' 
					).'
					<input type="hidden" name="offer_id" value="'.esc_attr( $offer_id ).'">
					<input type="hidden" name="return_url" value="'.esc_url( $return_url ).'">
					<input type="hidden" name="status_url" value="'.esc_url( $return_url ).'">
					<input type="hidden" name="action" value="payu_additional" />
					<a href="javascript:;" class="payu-additional-info btn">'.__( 'Process', 'couponxl' ).'</a>
				</form>
			';
		}
		else{
			$current_user = wp_get_current_user();
			$payu_merchant_key = couponxl_get_option( 'payu_merchant_key' );
			$payu_merchant_salt = couponxl_get_option( 'payu_merchant_salt' );

			$values = array(
				'key' => $payu_merchant_key,
				'txnid' => substr(hash('sha256', mt_rand() . microtime()), 0, 20),
				'amount' => $amount,
				'productinfo' => $is_submit ? __( 'Submitting Offer', 'couonxl' ) : get_the_title( $offer_id ),
				'firstname' => $first_name,
				'email' => $current_user->user_email
			);

			$values['productinfo'] = str_replace( '%', '', $values['productinfo'] );

			$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
			$hashVarsSeq = explode('|', $hashSequence);
			$hash_string = '';	
			foreach($hashVarsSeq as $hash_var) {
				$hash_string .= isset($values[$hash_var]) ? $values[$hash_var] : '';
				$hash_string .= '|';
			}
			$hash_string .= $payu_merchant_salt;

			$hash = strtolower(hash('sha512', $hash_string));

			$return = '
				<form class="payu-form '.( !empty( $_POST['offer_id'] ) ? 'payu-submit' : 'payu-submit-click' ).'" action="https://'.( couponxl_get_option( 'payu_mode' ) ).'.payu.in/_payment" method="post">
					<input type="hidden" name="amount" value="'.esc_attr( $values['amount'] ).'" />
					<input type="hidden" name="productinfo" value="'.$values['productinfo'].'" />
					<input type="hidden" name="firstname" value="'.esc_attr( $values['firstname'] ).'" />
					<input type="hidden" name="email" value="'.esc_attr( $values['email'] ).'" />
					<input type="hidden" name="surl" value="'.esc_url( $return_url ).'" />
					<input type="hidden" name="furl" value="'.esc_url( $return_url ).'" />	
					<input type="hidden" name="service_provider" value="payu_paisa" />	
					<input type="hidden" name="key" value="'.esc_attr( $payu_merchant_key ).'" />
					<input type="hidden" name="hash" value="'.$hash.'"/>
					<input type="hidden" name="txnid" value="'.esc_attr( $values['txnid'] ).'" />
					<input type="hidden" name="phone" value="'.esc_attr( $phone_number ).'" />
				</form>
			';
		}
	}
	if( !empty( $_POST ) && empty( $_POST['offer_type'] ) ){
		echo $return;
		die();
	}
	else{
		return $return;
	}
}
add_action('wp_ajax_payu_additional', 'couponxl_payu_form');
add_action('wp_ajax_nopriv_payu_additional', 'couponxl_payu_form');

function couponxl_buy_pay_link( $offer_id, $buy_now, $generating, $permalink, $success_redirect, $cancel_redirect, $amount, $btn = true ){
	$offer = get_post( $offer_id );
	$payments_available = array();

	$currency = couponxl_get_option( 'main_unit_abbr' );
	
	$pk_client_id = couponxl_get_option( 'pk_client_id' );
	if( !empty( $pk_client_id ) ){
		$payments_available['stripe'] = 'j';
	}

	$paypal_username = couponxl_get_option( 'paypal_username' );
	if( !empty( $paypal_username ) ){
		$response = couponxl_generate_paypal_link( 
			$amount, 
			$offer->post_title, 
			$offer->post_excerpt, 
			uniqid( '', true ), 
			$success_redirect,
			$cancel_redirect
		);				
		$payments_available['paypal'] = !isset( $response['error'] ) ? $response['url'] : 'javascript:;';
	}

	$skrill_owner_mail = couponxl_get_option( 'skrill_owner_mail' );
	if( !empty( $skrill_owner_mail ) ){
		$payments_available['skrill'] = 'j';
	}


	$mollie_id = couponxl_get_option( 'mollie_id' );
	if( !empty( $mollie_id ) ){
		$payments_available['ideal'] = 'j';
	}

	$payu_merchant_key = couponxl_get_option( 'payu_merchant_key' );
	if( !empty( $payu_merchant_key ) ){
		$payments_available['payu'] = 'j';
	}

	if( count( $payments_available ) == '1' ){
		if( !empty( $payments_available['paypal'] ) ){
			echo '<a href="'.$payments_available['paypal'].'" class="btn">'.$buy_now.'</a>';
		}
		else if( !empty( $payments_available['stripe'] ) ){
			$pk_client_id = couponxl_get_option( 'pk_client_id' );
			$site_logo = couponxl_get_option( 'site_logo' );
			$stripe_amount = $amount * 100;
			echo '<a href="javascript:;" class="'.( $btn ? 'btn' : '' ).' stripe-payment" data-genearting_string="'.esc_attr( $generating ).'"  data-pk="'.esc_attr( $pk_client_id ).'" data-offer_id="'.esc_attr( $offer_id ).'" data-name="'.esc_attr( $offer->post_title ).'" data-description="'.esc_attr( $offer->post_excerpt ).'" data-amount="'.esc_attr( $stripe_amount ).'" data-currency="'.esc_attr( $currency ).'">'.$buy_now.'</a>';
		}
		else if( !empty( $payments_available['skrill'] ) ){
			if( $btn ){
				$buyer_id = get_current_user_id();
				$return_url = add_query_arg( array( 'skrill_return' => '1' ), get_permalink( $offer_id ) );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), home_url('/').'index.php' );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'skrill_return' => '1' ), $return_permalink );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), home_url('/').'index.php' );
			}
			echo '<a href="javascript:;" class="'.( $btn ? 'btn' : '' ).' skrill-payment">'.$buy_now.'</a>'.couponxl_skrill_form( $amount, $currency, $offer_id, $offer->post_title, $return_url, $status_url );
		}
		else if( !empty( $payments_available['ideal'] ) ){
			if( $btn ){
				$buyer_id = get_current_user_id();
				$return_url = add_query_arg( array( 'ideal_return' => '1' ), get_permalink( $offer_id ) );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), home_url('/').'index.php' );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'ideal_return' => '1' ), $return_permalink );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), home_url('/').'index.php' );
			}
			echo couponxl_ideal_form( $amount, $currency, $offer_id, $offer->post_title, $return_url, $status_url ).'<a href="javascript:;" class="'.( $btn ? 'btn' : '' ).' submit-ideal-payment" data-genearting_string="'.esc_attr( $generating ).'">'.$buy_now.'</a>';
		}
		else if( !empty( $payments_available['payu'] ) ){
			$buyer_id = get_current_user_id();
			$is_submit = false;
			if( $btn ){
				$return_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), get_permalink( $offer_id ) );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), $return_permalink );
				$is_submit = true;
			}
			echo '<a href="javascript:;" class="'.( $btn ? 'btn' : '' ).' payu-initiate">'.$buy_now.'</a>'.couponxl_payu_form( $offer_id, $return_url, $is_submit );
		}		
	}
	else{
		$modal = '';
		if( !empty( $payments_available['paypal'] ) ){
			$modal .= '<div class="payment-method"><a href="'.$payments_available['paypal'].'"><img src="'.get_template_directory_uri().'/images/paypal.png" alt="" /></a></div>';
		}
		if( !empty( $payments_available['stripe'] ) ){
			$pk_client_id = couponxl_get_option( 'pk_client_id' );
			$site_logo = couponxl_get_option( 'site_logo' );
			$stripe_amount = $amount * 100;
			$modal .= '<div class="payment-method"><a href="javascript:;" class="stripe-payment" data-genearting_string="'.esc_attr( $generating ).'" data-pk="'.esc_attr( $pk_client_id ).'" data-offer_id="'.esc_attr( $offer_id ).'" data-image="'.esc_url( $site_logo['url'] ).'" data-name="'.esc_attr( $offer->post_title ).'" data-description="'.esc_attr( $offer->post_excerpt ).'" data-amount="'.$stripe_amount.'" data-currency="'.esc_attr( $currency ).'">
				<img src="'.get_template_directory_uri().'/images/stripe.png" alt="" />
			</a></div>';
		}
		if( !empty( $payments_available['skrill'] ) ){
			if( $btn ){
				$buyer_id = get_current_user_id();
				$return_url = add_query_arg( array( 'skrill_return' => '1' ), get_permalink( $offer_id ) );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), home_url('/').'index.php' );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'skrill_return' => '1' ), $return_permalink );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), home_url('/').'index.php' );
			}
			$modal .= '<div class="payment-method"><a href="javascript:;" class="skrill-payment">
				<img src="'.get_template_directory_uri().'/images/skrill.png" alt="" />
			</a>'.couponxl_skrill_form( $amount, $currency, $offer_id, $offer->post_title, $return_url, $status_url ).'</div>';
		}
		if( !empty( $payments_available['ideal'] ) ){
			if( $btn ){
				$buyer_id = get_current_user_id();
				$return_url = add_query_arg( array( 'ideal_return' => '1' ), get_permalink( $offer_id ) );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), home_url('/').'index.php' );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'ideal_return' => '1' ), $return_permalink );
				$status_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), home_url('/').'index.php' );
			}

			$modal .= '<div class="payment-method"><a href="javascript:;" class="submit-ideal-payment" data-genearting_string="'.esc_attr( $generating ).'">
				<img src="'.get_template_directory_uri().'/images/ideal.png" alt="" />
			</a>'.couponxl_ideal_form( $amount, $currency, $offer_id, $offer->post_title, $return_url, $status_url ).'</div>';
		}
		if( !empty( $payments_available['payu'] ) ){
			$buyer_id = get_current_user_id();
			$is_submit = false;
			if( $btn ){
				$return_url = add_query_arg( array( 'id_offer' => $offer_id, 'buyer_id' => $buyer_id ), get_permalink( $offer_id ) );
			}
			else{
				$return_permalink = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				$return_url = add_query_arg( array( 'id_offer' => $offer_id, 'submit_offer' => '1' ), $return_permalink );
				$is_submit = true;
			}

			$modal .= '<div class="payment-method"><a href="javascript:;" class="payu-initiate">
				<img src="'.get_template_directory_uri().'/images/payu.png" alt="" />
			</a>'.couponxl_payu_form( $offer_id, $return_url, $is_submit ).'</div>';
		}
		$modal .= '<hr/><h4>'.__( 'Select your payment method above.', 'couponxl' ).'</h4>';
		echo '<a href="javascript:;" class="'.( $btn ? 'btn' : '' ).' modal-payment">'.$buy_now.'</a><div class="modal-payments-holder">'.$modal.'</div>';
	}
}

function couponxl_generate_paypal_offer_link( $offer_id = '' ){
	if( empty( $offer_id ) ){
		$offer_id = get_the_ID();
	}

	$deal_link = get_post_meta( $offer_id, 'deal_link', true );
	if( !empty( $deal_link ) ){
		echo '<a href="'.esc_url( add_query_arg( array( 'rd' => get_the_ID() ), get_permalink() ) ).'" class="btn" target="_blank" rel="nofollow">'.__( 'BUY NOW', 'couponxl' ).'</a>';
	}
	else if( is_user_logged_in() ){
		$check_offer_availability = couponxl_check_offer( $offer_id );
		$permalink = get_permalink( $offer_id );

		if( $check_offer_availability && empty( $deal_link ) ){
			$amount = couponxl_get_deal_amount( $offer_id );
			echo couponxl_buy_pay_link(
				$offer_id,
				__( 'BUY NOW', 'couponxl' ),
				__( 'Generating voucher, please wait', 'couponxl' ),
				$permalink,
				esc_url( add_query_arg( array( 'cancel' => 'true' ), $permalink ) ),
				$permalink,
				$amount			
			);
		}
		else{
			echo '<a href="javascript:;" class="btn disabled">'.__( 'BUY NOW', 'couponxl' ).'</a>';
		}
	}
	else{
		echo '<a href="'.( esc_url( add_query_arg( array( 'redirect' => urlencode( get_permalink( $offer_id ) ) ), couponxl_get_permalink_by_tpl( 'page-tpl_login' ) ) ) ).'" class="btn">'.__( 'BUY NOW', 'couponxl' ).'</a>';
	}
}

if( !function_exists('couponxl_format_price_number') ){
	function couponxl_format_price_number( $price ){
		if( !is_numeric( $price ) ){
			return $price;
		}
		$unit_position = couponxl_get_option( 'unit_position' );
		$unit = couponxl_get_option( 'unit' );

		if( $unit_position == 'front' ){
			return $unit.number_format( $price, 2 );
		}
		else{
			return number_format( $price, 2 ).$unit;
		}
	}
}

function couponxl_generate_voucher( $length = 10 ){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    global $wpdb;
    $random_string = '';
    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }

    $exists = $wpdb->get_results( $wpdb->prepare(
    	"SELECT * FROM {$wpdb->postmeta} WHERE meta_key = 'voucher_code' AND meta_value = %s",
    	$random_string
    ) );
    $exists = array_shift( $exists );
    if( !empty( $exists ) ){
    	$random_string = couponxl_generate_voucher();
    }
    else{
    	return $random_string;	
    }
}



function couponxl_get_voucher_code( $offer, $transaction_id = '', $voucher_buyer_id = '' ){
	$offer_id = $offer->ID;
	if( empty( $voucher_buyer_id ) ){
		$voucher_buyer_id = get_current_user_id();
	}
	$deal_item_vouchers = get_post_meta( $offer_id, 'deal_item_vouchers', true );
	$voucher_exists = '';
	if( !empty( $transaction_id ) ){
		$voucher_exists = get_posts(array(
			'post_type' => 'voucher',
			'posts_per_page' => -1,
			'post_status' => 'publish',
			'meta_query' => array(
				array(
					'key' => 'transaction_id',
					'value' => $transaction_id,
					'compare' => '='
				)
			)
		));
	}
	if( empty( $voucher_exists ) ){
		if( !empty( $deal_item_vouchers ) ){
			$deal_item_vouchers = explode( "\n", $deal_item_vouchers );
			if( !empty( $deal_item_vouchers[0] ) ){
				$voucher_code = array_shift( $deal_item_vouchers );
				update_post_meta( $offer_id, 'deal_item_vouchers', join( "\n", $deal_item_vouchers ) );
			}
			else{
				$voucher_code = couponxl_generate_voucher();		
			}
		}
		else{
			$voucher_code = couponxl_generate_voucher();
		}
		$voucher_id = wp_insert_post(array(
			'post_title' => __( 'Voucher: ', 'couponxl' ).$voucher_code,
			'post_status' => 'publish',
			'post_type' => 'voucher'
		));

		$voucher_type = get_post_meta( $offer_id, 'deal_type', true );
		$deal_sale_price = get_post_meta( $offer_id, 'deal_sale_price', true );
		$voucher_owner_share = couponxl_calculate_owner_part( $offer_id );
		$voucher_payment_status = 'paid';

		$voucher_seller_share = '';
		if( $voucher_type == 'shared' ){
			$voucher_seller_share = $deal_sale_price - $voucher_owner_share;
			$voucher_payment_status = 'not_paid';
		}
		update_post_meta( $voucher_id, 'voucher_deal', $offer_id );
		update_post_meta( $voucher_id, 'voucher_code', $voucher_code );
		update_post_meta( $voucher_id, 'voucher_status', 'not_used' );		
		update_post_meta( $voucher_id, 'voucher_payer_id', isset( $_GET['PayerID'] ) ? $_GET['PayerID'] : '' );
		update_post_meta( $voucher_id, 'voucher_transaction_id', $transaction_id );
		update_post_meta( $voucher_id, 'voucher_type', $voucher_type );
		update_post_meta( $voucher_id, 'voucher_owner_share', $voucher_owner_share );
		update_post_meta( $voucher_id, 'voucher_seller_share', $voucher_seller_share );
		update_post_meta( $voucher_id, 'voucher_buyer_id', $voucher_buyer_id );
		update_post_meta( $voucher_id, 'voucher_seller_id', $offer->post_author );
		update_post_meta( $voucher_id, 'voucher_payment_status', $voucher_payment_status );	

	    $headers   = array();
	    $headers[] = "MIME-Version: 1.0";
	    $headers[] = "Content-Type: text/html; charset=UTF-8"; 

		$user = get_userdata($voucher_buyer_id);
		$to = $user->user_email;
		$from_mail = couponxl_get_option( 'email_sender' );
	    $from_name = couponxl_get_option( 'name_sender' );
		$headers[] = "From: ".$from_name." <".$from_mail.">";

		$deal_voucher_expire = get_post_meta( $offer->ID, 'deal_voucher_expire', true );
		$message = couponxl_get_option( 'purchase_message' );
		$message = str_replace( array( '%TITLE%', '%VOUCHER%' ), array( $offer->post_title, $voucher_code ), $message );
		$message_expire_part = couponxl_get_option( 'purchase_message_expire' );
		if( !empty( $deal_voucher_expire ) ){
			$deal_voucher_expire = date_i18n( 'F j, Y H:i', $deal_voucher_expire );
			$message .= str_replace( '%EXPIRE%', $deal_voucher_expire, $message_expire_part );
		}

		$subject = couponxl_get_option( 'purchase_message_subject' );

	    $info = @wp_mail( $to, $subject, $message, $headers );

	    $deal_in_short = get_post_meta( $offer_id, 'deal_in_short', true );
	    $offer_store = get_post_meta( $offer_id, 'offer_store', true );

		return __( 'Thank you for your purchase. Your voucher code is: ', 'couponxl' ).'<strong>'.$voucher_code.'<a href="javascript:;" class="print-voucher pull-right">'.__( 'Print', 'couponxl' ).'</a>
		<ul class="voucher-print list-unstyled">
			<li>'.__( 'Voucher ID: ', 'couponxl' ).'<br/><span>'.$voucher_code.'</span></li>
			<li>'.__( 'Voucher For Deal: ', 'couponxl' ).'<br/><span>'.$offer->post_title.'</span></li>
			'.( !empty( $deal_voucher_expire ) ? '<li>'.__( 'Valid until: ', 'couponxl' ).'<span>'.$deal_voucher_expire.'</span></li>' : '' ).'
			'.( !empty( $deal_in_short ) ? '<li>'.__( 'Deal Short Description: ', 'couponxl' ).'<br/><span>'.$deal_in_short.'</span></li>' : '' ).'
			<li><div class="voucher_store_logo">'.couponxl_store_logo( $offer_store, false ).'</div></li>
		</ul></strong>';
	}
	else{
		return __( 'Transaction is already used', 'couponxl' );
	}
}


function couponxl_do_express_checkout( $permalink, $title, $amount ){
	$paypal = new PayPal(array(
		'username' => couponxl_get_option( 'paypal_username' ),
		'password' => couponxl_get_option( 'paypal_password' ),
		'signature' => couponxl_get_option( 'paypal_signature' ),
		'cancelUrl' => add_query_arg( array( 'cancel' => 'true' ), $permalink ),
		'returnUrl' => $permalink,
	));	

	$pdata = array(
		'TOKEN' => $_GET['token'],
		'PAYERID' => $_GET['PayerID'],				
		'PAYMENTREQUEST_0_PAYMENTACTION' => "SALE",
		'L_PAYMENTREQUEST_0_NAME0' => $title,
		'L_PAYMENTREQUEST_0_NUMBER0' => uniqid( '', true ),
		'L_PAYMENTREQUEST_0_DESC0' => __( 'Buying Deal', 'couonxl' ),
		'L_PAYMENTREQUEST_0_AMT0' => $amount,
		'L_PAYMENTREQUEST_0_QTY0' => 1,
		'NOSHIPPING' => 1,
		'PAYMENTREQUEST_0_CURRENCYCODE' => couponxl_get_option( 'main_unit_abbr' ),
		'PAYMENTREQUEST_0_AMT' => $amount
	);

	$response = $paypal->DoExpressCheckoutPayment( $pdata );

	return $response;
}


function couponxl_check_submission( $offer_id ){
	$offer_type = get_post_meta( $offer_id, 'offer_type', true );

	if( $offer_type == 'coupon' ){
		$subpage = 'my_coupons';
		$amount = couponxl_get_option( 'coupon_submit_price' );
	}
	else{
		$subpage = 'my_deals';
		$amount = couponxl_get_option( 'deal_submit_price' );
	}

	$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );

	$response = couponxl_do_express_checkout( $permalink, get_the_title( $offer_id ), $amount );
	if( !isset( $response['error'] ) && !isset( $response['L_ERRORCODE0'] ) ){
		update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );
		return '<div class="alert alert-success">'.__( 'Your offer is submited and it will be reviewed as soon as possible.', 'couponxl' ).'</div>';
	}
	else if( isset( $response['L_ERRORCODE0'] ) && $response['L_ERRORCODE0'] === '11607' ){
		return '<div class="alert alert-danger">'.__( 'You have already purchased this deal with this transaction ID. Check your purchases to find voucher.', 'couponxl' ).'</div>';
	}
	else{
		return '<div class="alert alert-danger">'.__( 'There was an error processing yor request. Please contact administration of the site with this error message: <br /><strong>', 'couponxl' ).$response['error'].'</strong></div>';
	}	
}

function couponxl_check_shopping(){
	if( !empty( $_GET['token'] ) && !empty( $_GET['PayerID'] ) ){
		$offer_id = get_the_ID();
		$offer = get_post( $offer_id );

		$check_offer_availability = couponxl_check_offer( $offer_id );
		$permalink = get_permalink( $offer_id );

		if( $check_offer_availability ){
			$amount = couponxl_get_deal_amount( $offer_id );

			$response = couponxl_do_express_checkout( $permalink, get_the_title(), $amount );

			if( !isset( $response['error'] ) && !isset( $response['L_ERRORCODE0'] ) ){
				$voucher_code = couponxl_get_voucher_code( $offer, $response['PAYMENTINFO_0_TRANSACTIONID'] );

				echo '<div class="alert alert-success clearfix">'.$voucher_code.'</strong></div>';
			}
			else if( isset( $response['L_ERRORCODE0'] ) && $response['L_ERRORCODE0'] === '11607' ){
				echo '<div class="alert alert-danger">'.__( 'You have already purchased this deal with this transaction ID. Check your purchases to find voucher.', 'couponxl' ).'</div>';
			}
			else{
				echo '<div class="alert alert-danger">'.__( 'There was an error processing yor request. Please contact administration of the site with this error message: <br /><strong>', 'couponxl' ).$response['error'].'</strong></div>';
			}
		}
		else{
			//make refnd
		}
	}
	else if( !empty( $_GET['skrill_return'] ) ){
		$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );
		echo '<div class="alert alert-info">'.
				   __( 'Thank you for your purchase.<br />Once Skrill confirms payment you will receive your voucher on the list of your ', 'couponxl').'
				  <a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_purchases' ), array( 'all' ) ) ).'">'.
				  	__('purchases', 'couponxl' ).'.
				  </a>
			  </div>';
	}
	else if( !empty( $_GET['ideal_return'] ) ){
		$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );
		echo '<div class="alert alert-info">'.
				   __( 'Thank you for your purchase.<br />Once iDEAL confirms payment you will receive your voucher on the list of your ', 'couponxl').'
				  <a href="'.esc_url( couponxl_append_query_string( $permalink, array( 'subpage' => 'my_purchases' ), array( 'all' ) ) ).'">'.
				  	__('purchases', 'couponxl' ).'.
				  </a>
			  </div>';
	}
	else if( isset( $_POST['hash'] ) ){
		$status = $_POST["status"];
		$firstname = $_POST["firstname"];
		$amount = $_POST["amount"];
		$txnid = $_POST["txnid"];
		$posted_hash = $_POST["hash"];
		$key = $_POST["key"];
		$productinfo = $_POST["productinfo"];
		$email = $_POST["email"];
		$offer_id = $_GET['id_offer'];
		$salt = couponxl_get_option( 'payu_merchant_salt' );

		$offer = get_post( $offer_id );

		$check_offer_availability = couponxl_check_offer( $offer_id );
		if( $check_offer_availability ){

			$retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
			$hash = hash( "sha512", $retHashSeq );

			if ( $hash != $posted_hash ) {
				echo '<div class="alert alert-danger">'.__( 'Invalid Transaction. Please try again', 'couponxl' ).'</strong></div>';
			}
			else {
				$voucher_code = couponxl_get_voucher_code( $offer );
				echo '<div class="alert alert-success clearfix">'.$voucher_code.'</strong></div>';
			}
		}
		else{
			echo '<div class="alert alert-danger">'.__( 'Offer is no longer available', 'couponxl' ).'</strong></div>';
		}
	}
}

function couponxl_verify_skrill(){
	if( isset( $_POST['merchant_id'] ) ){	
		$skrill_secret_word = couponxl_get_option( 'skrill_secret_word' );
		$concatFields = $_POST['merchant_id']
		    .$_POST['transaction_id']
		    .strtoupper(md5($skrill_secret_word))
		    .$_POST['mb_amount']
		    .$_POST['mb_currency']
		    .$_POST['status'];

		$MBEmail = couponxl_get_option( 'skrill_owner_mail' );

		if ( strtoupper( md5($concatFields) ) == $_POST['md5sig'] && $_POST['status'] == 2 && $_POST['pay_to_email'] == $MBEmail ){
			if( isset( $_GET['id_offer'] ) ){
				if( isset( $_GET['submit_offer'] ) ){
					update_post_meta( $_GET['id_offer'], 'offer_initial_payment', 'paid' );
				}
				else{			
		    		$offer = get_post( $_GET['id_offer'] );
		    		if( !empty( $offer ) ){
		    			$buyer_id = $_GET['buyer_id'];
				    	couponxl_get_voucher_code( $offer, $_POST['transaction_id'], $buyer_id );
		    		}
		    	}
		    }
		}
		else{
		}
	}
}
add_action('init', 'couponxl_verify_skrill', 0 );

function couponxl_process_stripe( $amount, $token ){
    $response = wp_remote_post( 'https://api.stripe.com/v1/charges', array(
        'method' => 'POST',
        'timeout' => 45,
        'redirection' => 5,
        'httpversion' => '1.0',
        'blocking' => true,
        'headers' => array(
        	'Authorization' => 'Bearer '.couponxl_get_option( 'sk_client_id' )
    	),
        'body' => array(
            'amount' => $amount*100,
            'currency' => strtolower( couponxl_get_option( 'main_unit_abbr' ) ),
            'card' => $token['id'],
            'receipt_email' => $token['email'],
        ),
        'cookies' => array()
    ));

    return $response;
}

function couponxl_submit_with_stripe(){
	$token = $_POST['token'];
	$offer_id = $_POST['offer_id'];
	$offer = get_post( $offer_id );	
	$payment_for = isset( $_POST['payment_for'] ) ? $_POST['payment_for'] : '';

	if( !empty( $offer ) ){
		$offer_type = get_post_meta( $offer_id, 'offer_type', true );
		if( $offer_type == 'coupon' ){
			$amount = couponxl_get_option( 'coupon_submit_price' );
		}
		else{
			$amount = couponxl_get_option( 'deal_submit_price' );
		}		
		$response = couponxl_process_stripe( $amount, $token );
	    if ( is_wp_error( $response ) ) {
	        $error_message = $response->get_error_message();
	        echo '<div class="alert alert-danger">'.__( 'Something went wrong: ', 'couponxl' ).$error_message.'</div>';
	    } 
	    else{           
	        $data = json_decode( $response['body'], true );
	        if( empty( $data['error'] ) ){
	            if( $payment_for == 'submission-list' ){
	            	update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );
	            	echo __( 'Pending', 'couponxl' );
	            }
	            else{
	            	update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );
	            	echo '<div class="alert alert-success">'.__( 'Your offer is submited and it will be reviewed as soon as possible.', 'couponxl' ).'</div>';	
	            }
	        }
	        else{
	        	echo '<div class="alert alert-danger">'.$data['error_description'].'</div>';
	        }
	    } 		
	}
	die();
	
}
add_action('wp_ajax_submit_with_stripe', 'couponxl_submit_with_stripe');
add_action('wp_ajax_nopriv_submit_with_stripe', 'couponxl_submit_with_stripe');

function couponxl_pay_with_stripe(){
	$token = $_POST['token'];
	$offer_id = $_POST['offer_id'];
	$offer = get_post( $offer_id );

	if( !empty( $offer ) ){
		$check_offer_availability = couponxl_check_offer( $offer_id );
		if( $check_offer_availability ){
			$buyer_id = get_current_user_id();
			$amount = couponxl_get_deal_amount( $offer_id );
			$response = couponxl_process_stripe( $amount, $token );
		    if ( is_wp_error( $response ) ) {
		        $error_message = $response->get_error_message();
		        echo '<div class="alert alert-danger">'.__( 'Something went wrong: ', 'couponxl' ).$error_message.'</div>';
		    } 
		    else{           
		        $data = json_decode( $response['body'], true );
		        if( empty( $data['error'] ) ){
		            $voucher_code = couponxl_get_voucher_code( $offer );
		            echo '<div class="alert alert-success clearfix">'.$voucher_code.'</div>';
		        }
		        else{
		        	echo '<div class="alert alert-danger">'.$data['error_description'].'</div>';
		        }
		    } 		    
		}
		else{
			echo '<div class="alert alert-danger">'.__( 'Offer is not available, no charges are deducted from your card', 'couponxl' ).'</div>';
		}
	}
	die();
}
add_action('wp_ajax_pay_with_stripe', 'couponxl_pay_with_stripe');
add_action('wp_ajax_nopriv_pay_with_stripe', 'couponxl_pay_with_stripe');

function couponxl_pay_with_ideal_link(){
	$offer_id = $_POST['offer_id'];
	$bank_id = $_POST['bank_id'];
	$currency = $_POST['currency'];
	$return_url = $_POST['return_url'];
	$status_url = $_POST['status_url'];

	$offer = get_post( $offer_id );

	if( !empty( $offer ) ){
		$check_offer_availability = couponxl_check_offer( $offer_id );
		if( $check_offer_availability ){

			$amount = couponxl_get_deal_amount( $offer_id );
			if( $amount ){
				$mollie_id = couponxl_get_option( 'mollie_id' );
				$iDEAL = new Couponxl_Mollie_iDEAL_Payment ( $mollie_id );
				if( couponxl_get_option( 'ideal_mode' ) == 'test' ){
					$iDEAL->setTestmode(true);
				}				

				$payment = $iDEAL->createPayment( $bank_id, $amount*100,  __( 'Buying Deal', 'couonxl' ), $return_url, $status_url );

				if( $payment ){
					echo $iDEAL->getBankURL();
				}
				else{
					echo '<div class="alert alert-danger no-margin">'.__( 'Could not retrive bank URL', 'couponxl' ).' '.$iDEAL->getErrorMessage().'</div>';
				}

			}
			else{
				echo '<div class="alert alert-danger no-margin">'.__( 'Amount is empty', 'couponxl' ).'</div>';
			}	    
		}
		else{
			echo '<div class="alert alert-danger">'.__( 'Offer is not available', 'couponxl' ).'</div>';
		}
	}
	die();
}
add_action('wp_ajax_ideal_link', 'couponxl_pay_with_ideal_link');
add_action('wp_ajax_nopriv_ideal_link', 'couponxl_pay_with_ideal_link');

function couponxl_submit_with_ideal(){
	$offer_id = $_POST['offer_id'];
	$bank_id = $_POST['bank_id'];
	$return_url = $_POST['return_url'];
	$status_url = $_POST['status_url'];
	$offer = get_post( $offer_id );	

	if( !empty( $offer ) ){
		$offer_type = get_post_meta( $offer_id, 'offer_type', true );
		if( $offer_type == 'coupon' ){
			$amount = couponxl_get_option( 'coupon_submit_price' );
		}
		else{
			$amount = couponxl_get_option( 'deal_submit_price' );
		}		

		if( $amount ){
			$mollie_id = couponxl_get_option( 'mollie_id' );
			$iDEAL = new Couponxl_Mollie_iDEAL_Payment ( $mollie_id );
			if( couponxl_get_option( 'ideal_mode' ) == 'test' ){
				$iDEAL->setTestmode(true);
			}			

			$payment = $iDEAL->createPayment( $bank_id, $amount*100,  __( 'Submitting Offer', 'couonxl' ), $return_url, $status_url );

			if( $payment ){
				echo $iDEAL->getBankURL();
			}
			else{
				echo '<div class="alert alert-danger no-margin">'.__( 'Could not retrive bank URL', 'couponxl' ).' '.$iDEAL->getErrorMessage().'</div>';
			}

		}	
	}
	die();
	
}
add_action('wp_ajax_submit_with_ideal', 'couponxl_submit_with_ideal');
add_action('wp_ajax_nopriv_submit_with_ideal', 'couponxl_submit_with_ideal');


function couponxl_verify_ideal(){
	if( isset( $_GET['transaction_id'] ) ){	
		$mollie_id = couponxl_get_option( 'mollie_id' );
		$iDEAL = new Couponxl_Mollie_iDEAL_Payment( $mollie_id );
		if( couponxl_get_option( 'ideal_mode' ) == 'test' ){
			$iDEAL->setTestmode(true);
		}		
		$iDEAL->checkPayment($_GET['transaction_id']);

		if ( $iDEAL->getPaidStatus() ){
			if( isset( $_GET['id_offer'] ) ){
				if( isset( $_GET['submit_offer'] ) ){
					update_post_meta( $_GET['id_offer'], 'offer_initial_payment', 'paid' );
				}
				else{			
		    		$offer = get_post( $_GET['id_offer'] );
		    		if( !empty( $offer ) ){
		    			$buyer_id = $_GET['buyer_id'];
				    	couponxl_get_voucher_code( $offer, $_GET['transaction_id'], $buyer_id );
		    		}
		    	}
		    }
		}
	}

}
add_action('init', 'couponxl_verify_ideal', 0 );


/* CUSTOM STORE COLUMNS */

add_filter( 'manage_edit-store_columns', 'couponxl_custom_store_columns' );
function couponxl_custom_store_columns($columns) {
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array(
			"store_logo" => __( 'Store Logo', 'coupon' ),
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}

/* opulate offer custom columns */
add_action( 'manage_store_posts_custom_column', 'couponxl_custom_store_columns_populate', 10, 2 );
function couponxl_custom_store_columns_populate( $column, $post_id ) {
	if( $column == 'store_logo' ){
		echo couponxl_store_logo( $post_id );
	}
}


/* CUSTOM OFFER COLUMNS */
add_filter( 'manage_edit-offer_columns', 'couponxl_custom_offer_columns' );
function couponxl_custom_offer_columns($columns) {
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array(
			"offer_store" => __( 'Store', 'coupon' ),
			"offer_type" => __( 'Type', 'coupon' ),
			"offer_expire" => __( 'Expire Date', 'coupon' ),
			"offer_average_rate" => __( 'Ratings', 'coupon' ),
			"offer_category" => __( 'Category', 'coupon' ),
			"offer_in_slider" => __( 'In Slider', 'coupon' ),
			"offer_clicks" => __( 'Clicks', 'coupon' )
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}

/* opulate offer custom columns */
add_action( 'manage_offer_posts_custom_column', 'couponxl_custom_offer_columns_populate', 10, 2 );
function couponxl_custom_offer_columns_populate( $column, $post_id ) {
	switch ( $column ) {
		case 'offer_store' :
			$offer_store = get_post_meta( $post_id, 'offer_store', true );
			if( !empty( $offer_store ) ){
				echo get_the_title( $offer_store );
			}
			else{
				echo '';
			}
			break;
		case 'offer_type' :
			$offer_type =  get_post_meta( $post_id, 'offer_type', true );
			if( $offer_type == 'deal' ){
				_e( 'Deal', 'couponxl' );
			}
			else{
				_e( 'Coupon', 'couponxl' );
			}
			break;
		case 'offer_expire' :
			$offer_expire = get_post_meta( $post_id, 'offer_expire', true );
			if( !empty( $offer_expire ) && $offer_expire !== '99999999999' ){
				echo date_i18n( 'F j, Y', $offer_expire );
			}
			else if( $offer_expire == '99999999999' ){
				_e( 'Unlimited', 'couponxl' );
			}
			break;
		case 'offer_average_rate' :
			echo couponxl_get_ratings( $post_id );
			break;
		case 'offer_category':
			$terms = get_the_terms( $post_id, 'offer_cat' );
			global $couponxl_slugs;
			if( !empty( $terms ) ){
				$last = couponxl_get_deepest_taxonomy( $terms );
				$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
				echo '<a href="'.esc_url( add_query_arg( array( $couponxl_slugs['offer_cat'] => $last->slug ), $permalink ) ).'" target="_blank">'.$last->name.'</a>';
			}
			break;
		case 'offer_in_slider':
			$offer_in_slider = get_post_meta( $post_id, 'offer_in_slider', true );
			if( $offer_in_slider == 'yes' ){
				_e( 'Yes', 'couponxl' );
			}
			else{
				_e( 'No', 'couponxl' );
			}
			break;
		case 'offer_clicks' : 
			echo get_post_meta( $post_id, 'offer_clicks', true );
			break;
	}
}

/* sorting columns offers */
add_filter( 'manage_edit-offer_sortable_columns', 'couponxl_sorting_offer_columns' );
function couponxl_sorting_offer_columns($columns) {
	$custom = array(
		'offer_store'	=> 'offer_store',
		'offer_type'	=> 'offer_type',
		'offer_expire'	=> 'offer_expire',
		'offer_average_rate'	=> 'offer_average_rate',
		'offer_in_slider'	=> 'offer_in_slider',
		'offer_clicks'	=> 'offer_clicks',
	);
	return wp_parse_args( $custom, $columns );
}


/* sort offers */
add_action( 'pre_get_posts', 'couponxl_sort_offer_columns' );
function couponxl_sort_offer_columns( $query ){
	if( ! is_admin() ){
		return;	
	}

	$orderby = $query->get( 'orderby');
	if( $orderby == 'offer_expire' || $orderby == 'offer_store' || $orderby == 'offer_average_rate' || $orderby == 'offer_clicks' ){
		if( $orderby == 'offer_average_rate' ){
			$orderby = 'couponxl_average_rate';
		}
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value_num' );
	}
	else if( $orderby == 'offer_type' || $orderby == 'offer_in_slider' ){
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value' );
	}
}

/* VOUCHER COLUMNS */
add_filter( 'manage_edit-voucher_columns', 'couponxl_custom_voucher_columns' );
function couponxl_custom_voucher_columns($columns) {
	$columns = 
		array_slice($columns, 0, count($columns) - 1, true) + 
		array(
			"voucher_deal" => __( 'Deal', 'coupon' ),
			"voucher_code" => __( 'Voucher Code', 'coupon' ),
			"voucher_owner_share" => __( 'Owner Share', 'coupon' ),
			"voucher_seller_share" => __( 'Seller Share', 'coupon' ),
			"voucher_buyer_id" => __( 'Buyer', 'coupon' ),
			"voucher_payment_status" => __( 'Pay To Seller', 'coupon' ),
		) + 
		array_slice($columns, count($columns) - 1, count($columns) - 1, true) ;	
	return $columns;
}

/* opulate offer custom columns */
add_action( 'manage_voucher_posts_custom_column', 'couponxl_custom_voucher_columns_populate', 10, 2 );
function couponxl_custom_voucher_columns_populate( $column, $post_id ) {
	switch ( $column ) {
		case 'voucher_deal' :
			$voucher_deal = get_post_meta( $post_id, 'voucher_deal', true );
			if( !empty( $voucher_deal ) ){
				echo get_the_title( $voucher_deal );
			}
			else{
				echo '';
			}
			break;
		case 'voucher_code' :
			echo get_post_meta( $post_id, 'voucher_code', true );
			break;
		case 'voucher_owner_share' :
			echo couponxl_format_price_number( get_post_meta( $post_id, 'voucher_owner_share', true ) );
			break;
		case 'voucher_seller_share' :
			echo couponxl_format_price_number( get_post_meta( $post_id, 'voucher_seller_share', true ) );
			break;
		case 'voucher_buyer_id' : 
			$voucher_buyer_id = get_post_meta( $post_id, 'voucher_buyer_id', true );
			$user_data = get_userdata( $voucher_buyer_id );
			if( $user_data ){
				if( !empty( $user_data->user_nicename ) ){
					echo $user_data->user_nicename;
				}
				else{
					echo $user_data->user_login;
				}
			}
			break;
		case 'voucher_payment_status':
			$voucher_payment_status = get_post_meta( $post_id, 'voucher_payment_status', true );
			$voucher_type = get_post_meta( $post_id, 'voucher_type', true );
			if( $voucher_payment_status == 'not_paid' ){
				echo '<a href="javascript:;" class="button button-primary button-large couponxl_pay_seller" data-voucher-id="'.$post_id.'">'.__( 'Pay Seller', 'couponxl' ).'</a>';
			}
			else{
				if( $voucher_type == 'shared' ){
					_e( 'Paid', 'couponxl' );
				}
			}
			break;
	}
}

/* sorting columns offers */
add_filter( 'manage_edit-voucher_sortable_columns', 'couponxl_sorting_voucher_columns' );
function couponxl_sorting_voucher_columns($columns) {
	$custom = array(
		'voucher_deal'	=> 'voucher_deal',
		'voucher_code'	=> 'voucher_code',
		'voucher_owner_share'	=> 'voucher_owner_share',
		'voucher_seller_share'	=> 'voucher_seller_share',
		'voucher_buyer_id'	=> 'voucher_buyer_id',
		'voucher_payment_status'	=> 'voucher_payment_status',
	);
	return wp_parse_args( $custom, $columns );
}

/* sort offers */
add_action( 'pre_get_posts', 'couponxl_sort_voucher_columns' );
function couponxl_sort_voucher_columns( $query ){
	if( ! is_admin() ){
		return;	
	}

	$orderby = $query->get( 'orderby');
	if( $orderby == 'voucher_deal' || $orderby == 'voucher_owner_share' || $orderby == 'voucher_seller_share' || $orderby == 'voucher_buyer_id' ){
		$query->set( 'meta_key', $orderby );
		$query->set( 'orderby', 'meta_value_num' );
	}
}

function couponxl_pay_sellers( $bulk_posts = array(), $echo = 'yes' ){
	$response = array(
		'error' => array()
	);
	/* PAY ALL SELLERS WITH PAYPAL */
	if( !empty( $bulk_posts['paypal'] ) ){
		$paypal = new PayPal(array(
			'username' => couponxl_get_option( 'paypal_username' ),
			'password' => couponxl_get_option( 'paypal_password' ),
			'signature' => couponxl_get_option( 'paypal_signature' ),
			'cancelUrl' => '',
			'returnUrl' => '',
		));

		$pdata = array(
			'RECEIVERTYPE' => 'EmailAddress',				
			'CURRENCYCODE' => couponxl_get_option( 'main_unit_abbr' ),
		);
		$counter = 0;
		foreach( $bulk_posts['paypal'] as $email => $payment_data ){
			$pdata['L_EMAIL'.$counter] = $email;
			$pdata['L_AMT'.$counter] = $payment_data['amount'];
			$counter++;
		}

		$details = $paypal->MassPay( $pdata );
		if( !empty( $details['error'] ) ){
			$response['error'][] =  $payment_data['user'].' - '.$details['error'];
		}
		else{
        	if( !empty( $payment_data['voucher_ids'] ) ){
        		foreach( $payment_data['voucher_ids'] as $voucher_id ){
        			update_post_meta( $voucher_id, 'voucher_payment_status', 'paid' );
        		}
        	}
			$response['success'][] = $payment_data['user'].' - '.__( 'Payment Sent', 'couponxl' );
		}
	}

	/* PAY ALL SELLERS WITH STRIPE */
	if( !empty( $bulk_posts['stripe'] ) ){
		foreach( $bulk_posts['stripe'] as $stripe_user_id => $payment_data ){
		    $post_response = wp_remote_post( 'https://api.stripe.com/v1/transfers', array(
		        'method' => 'POST',
		        'timeout' => 45,
		        'redirection' => 5,
		        'httpversion' => '1.0',
		        'blocking' => true,
		        'headers' => array(
		        	'Authorization' => 'Bearer '.couponxl_get_option( 'sk_client_id' )
		        ),
		        'body' => array(
		            'amount' => $payment_data['amount']*100,
		            'destination' => $stripe_user_id,
		            'currency' => strtolower( couponxl_get_option( 'main_unit_abbr' ) )
		        ),
		        'cookies' => array()
		    ));

		    if ( is_wp_error( $post_response ) ) {
		        $error_message = $post_response->get_error_message();
		        $response['error'][] =  "Something went wrong: $error_message";
		    }
		    else{
		        $data = json_decode( $post_response['body'], true );
		        if( empty( $data['error'] ) ){		        	
		        	if( !empty( $payment_data['voucher_ids'] ) ){
		        		foreach( $payment_data['voucher_ids'] as $voucher_id ){
		        			update_post_meta( $voucher_id, 'voucher_payment_status', 'paid' );
		        		}
		        	}
		        	$response['success'][] =  $payment_data['user'].' - '.__( 'Payment Sent', 'couponxl' );
		        }
		        else{
		        	$response['error'][] =  $payment_data['user'].' - '.$data['error']['message'];
		        }		    	
		    }
		}
	}

	/* PAY ALL SELLERS WITH SKRILL */
	if( !empty( $bulk_posts['skrill'] ) ){
		$base_url = 'https://www.moneybookers.com/app/pay.pl';
		$skrill_api_mqi_password = couponxl_get_option( 'skrill_api_mqi_password' );
		$skrill_owner_mail = couponxl_get_option( 'skrill_owner_mail' );
		if( !empty( $skrill_api_mqi_password ) && !empty( $skrill_owner_mail ) ){
			foreach( $bulk_posts['skrill'] as $skrill_account => $payment_data ){
				$query = http_build_query(array(
			            'action' => 'prepare',
			            'email' => $skrill_owner_mail,
			            'password' => md5( $skrill_api_mqi_password ),
			            'amount' => $payment_data['amount'],
			            'currency' => strtolower( couponxl_get_option( 'main_unit_abbr' ) ),
			            'bnf_email' => $skrill_account,
			            'subject' => __( 'Seller Share', 'couponxl' ),
			            'note' => __( 'Seller share payout', 'couponxl' )
				));

			    $post_response = wp_remote_get( $base_url.'?'.$query );
			    if ( is_wp_error( $post_response ) ) {
			        $error_message = $post_response->get_error_message();
			        $response['error'][] =  "Something went wrong: $error_message";
			    }
			    else{
			        $data = simplexml_load_string( $post_response['body'] );
			        if( empty( $data->error ) ){
					    $post_response = wp_remote_get( $base_url.'?action=transfer&sid='.$data->sid );
					    $data = simplexml_load_string( $post_response['body'] );
					    if( empty( $data->error ) ){
				        	if( !empty( $payment_data['voucher_ids'] ) ){
				        		foreach( $payment_data['voucher_ids'] as $voucher_id ){
				        			update_post_meta( $voucher_id, 'voucher_payment_status', 'paid' );
				        		}
				        	}
				        	$response['success'][] =  $payment_data['user'].' - '.__( 'Payment Sent', 'couponxl' );					    	
					    }
					    else{
					    	$response['error'][] =  $payment_data['user'].' - '.$data->error->error_msg;
					    }
			        }
			        else{
			        	$response['error'][] =  $payment_data['user'].' - '.$data->error->error_msg;
			        }		    	
			    }			    
			}
		}
	}

	if( $echo == 'yes' ){
		$response['finish'] = __( 'Payments processed', 'couponxl' );
		echo json_encode( $response );
		die();
	}
	else{
		set_transient( 'voucher_action_'.get_current_user_id(), $response );
	}
}

function custom_bulk_admin_notices() {
	global $post_type, $pagenow;
	$voucher_messages = get_transient( 'voucher_action_'.get_current_user_id() );
	delete_transient( 'voucher_action_'.get_current_user_id() );
	if($pagenow == 'edit.php' && $post_type == 'voucher' ) {
		if( !empty( $voucher_messages['error'] ) ){
			foreach( $voucher_messages['error'] as $message ){
				if( !empty( $message ) ){
					echo '<div class="error"><p>'.$message.'</p></div>';
				}
			}
		}
		if( !empty( $voucher_messages['success'] ) ){
			foreach( $voucher_messages['success'] as $message ){
				if( !empty( $message ) ){
					echo '<div class="updated"><p>'.$message.'</p></div>';
				}
			}
		}		
	}

	$couponxl_cpt = couponxl_plugin_get_version( 'couponxl-cpt' );
	$smeta = couponxl_plugin_get_version( 'smeta' );

	if( $couponxl_cpt !== '1.1' ){
	    echo '<div id="message" class="error notice">
	        <p>'.esc_html__( 'Reinstall Coupon XL Custom Post Types plugin ( delete it and theme will offer you to install it again )', 'couponxxl' ).'.</p>
	    </div>';
	}

	if( $smeta !== '1.2' ){
	    echo '<div id="message" class="error notice">
	        <p>'.esc_html__( 'Reinstall Smeta plugin ( delete it and theme will offer you to install it again )', 'couponxxl' ).'.</p>
	    </div>';
	}
}
add_action('admin_notices', 'custom_bulk_admin_notices');


if( !function_exists('couponxl_plugin_get_version') ){
function couponxl_plugin_get_version( $plugin_name ) {
	if ( ! function_exists( 'get_plugins' ) ){
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}
	$plugin_path = WP_PLUGIN_DIR.'/'.$plugin_name.'/'.$plugin_name.'.php';
	if( file_exists( $plugin_path ) ){
		$plugin_data = get_plugin_data( $plugin_path );
	}
	else{
		$plugin_data['Version'] = '0.0';
	}
	return $plugin_data['Version'];
}
}


/* CUSTOM FILTER */
function couponxl_custom_filter() {
    global $typenow;
    global $wp_query;
    if ( $typenow=='voucher' ) {
    	?>
    	<select name="filter_payment">
    		<option value=""><?php _e( 'Show All', 'couponxl' ) ?></option>
    		<option value="paid" <?php echo isset( $_GET['filter_payment'] ) && $_GET['filter_payment'] == 'paid' ? 'selected="selected"' : ''; ?>><?php _e( 'Show Only Payed', 'couponxl' ) ?></option>
    		<option value="not_paid" <?php echo isset( $_GET['filter_payment'] ) && $_GET['filter_payment'] == 'not_paid' ? 'selected="selected"' : ''; ?>><?php _e( 'Show Only Not Payed', 'couponxl' ) ?></option>
    	</select>
    	<?php
    }
}
add_action('restrict_manage_posts','couponxl_custom_filter');



function couponxl_payment_filter( $query ) {
    global $pagenow;
    $qv = &$query->query_vars;
    if ( $pagenow=='edit.php' && isset( $_REQUEST['filter_payment'] ) ) {
        $qv['meta_key'] = 'voucher_payment_status';
        $qv['meta_value'] = $_REQUEST['filter_payment'];
    }
}
add_filter('parse_query','couponxl_payment_filter');


function couponxl_pay_all_sellers( $vouchers = array(), $echo = 'yes' ){
	global $wpdb;
	$sellers = array(
		'paypal' => array(),
		'stripe' => array(),
		'skrill' => array()
	);
	$args = array(
		'post_type' => 'voucher',
		'posts_per_page' => -1,
		'post_status' => 'publish',
		'meta_query' => array(
			array(
				'key' => 'voucher_payment_status',
				'value' => 'not_paid',
				'compare' => '='
			)
		)
	);
	if( !empty( $_POST['voucher_id'] ) ){
		$voucher = get_post( $_POST['voucher_id'] );
		if( !empty( $voucher ) ){
			$args['post__in'] = array( $_POST['voucher_id'] );
		}
	}
	else if( !empty( $vouchers ) ){
		$args['post__in'] = $vouchers;
	}
	$vouchers = get_posts( $args );
	if( !empty( $vouchers ) ){
		foreach( $vouchers as $voucher ){
			$voucher_seller_id = get_post_meta( $voucher->ID, 'voucher_seller_id', true );
			$seller_payout_method = get_user_meta( $voucher_seller_id, 'seller_payout_method', true );
			if( !empty( $seller_payout_method ) ){
				switch( $seller_payout_method ){
					case 'paypal' : 
						$seller_paypal_account = get_user_meta( $voucher_seller_id, 'seller_paypal_account', true );
						if( empty( $sellers[$seller_payout_method][$seller_paypal_account] ) ){
							$sellers[$seller_payout_method][$seller_paypal_account] = array(
								'amount' => 0,
								'voucher_ids' => array(),
								'user' => get_the_author_meta( 'user_login', $voucher_seller_id )
							);
						}
						$sellers[$seller_payout_method][$seller_paypal_account]['amount'] += get_post_meta( $voucher->ID, 'voucher_seller_share', true );
						$sellers[$seller_payout_method][$seller_paypal_account]['voucher_ids'][] = $voucher->ID;
						break;
					case 'stripe':
						$seller_stripe_data = get_user_meta( $voucher_seller_id, 'seller_stripe_data', true );
						if( empty( $sellers[$seller_payout_method][$seller_stripe_data['stripe_user_id']] ) ){
							$sellers[$seller_payout_method][$seller_stripe_data['stripe_user_id']] = array(
								'amount' => 0,
								'voucher_ids' => array(),
								'user' => get_the_author_meta( 'user_login', $voucher_seller_id )
							);
						}
						$sellers[$seller_payout_method][$seller_stripe_data['stripe_user_id']]['amount'] += get_post_meta( $voucher->ID, 'voucher_seller_share', true );
						$sellers[$seller_payout_method][$seller_stripe_data['stripe_user_id']]['voucher_ids'][] = $voucher->ID;
						break;
					case 'skrill':
						$seller_skrill_account = get_user_meta( $voucher_seller_id, 'seller_skrill_account', true );
						if( empty( $sellers[$seller_payout_method][$seller_skrill_account] ) ){
							$sellers[$seller_payout_method][$seller_skrill_account] = array(
								'amount' => 0,
								'voucher_ids' => array(),
								'user' => get_the_author_meta( 'user_login', $voucher_seller_id )
							);
						}
						$sellers[$seller_payout_method][$seller_skrill_account]['amount'] += get_post_meta( $voucher->ID, 'voucher_seller_share', true );
						$sellers[$seller_payout_method][$seller_skrill_account]['voucher_ids'][] = $voucher->ID;						
				}
			}
		}
	}

	couponxl_pay_sellers( $sellers, $echo );
}
add_action('wp_ajax_pay_all_sellers', 'couponxl_pay_all_sellers');
add_action('wp_ajax_nopriv_pay_all_sellers', 'couponxl_pay_all_sellers');

/* CUSTOM MESSAGES */
function couponxl_login_errors( $message ) {
	global $errors;
 	if( isset( $errors->errors['invalid_username'] ) ){
 		$message = __( 'Invalid username', 'couponxl' );
 	}
	else if ( isset( $errors->errors['incorrect_password'] ) ){
		$message = __( 'Invalid password', 'couponxl' );
	}

	return $message;	
}
add_filter( 'login_errors', 'couponxl_login_errors' );



function couponxl_return_tweets( $count = 1 ){
	include_once( locate_template( 'includes/twitter_api.php' ) );
	$username = couponxl_get_option( 'twitter-username' );
	$oauth_access_token = couponxl_get_option( 'twitter-oauth_access_token' );
	$oauth_access_token_secret = couponxl_get_option( 'twitter-oauth_access_token_secret' );
	$consumer_key = couponxl_get_option( 'twitter-consumer_key' );
	$consumer_secret = couponxl_get_option( 'twitter-consumer_secret' );
		
	if( !empty( $username ) && !empty( $oauth_access_token ) && !empty( $oauth_access_token_secret ) && !empty( $consumer_key ) && !empty( $consumer_secret ) ){		
		$cache_file = dirname(__FILE__).'/includes/'.'twitter-cache.txt';
		if( !file_exists( $cache_file ) ){
			file_put_contents( $cache_file, '' );
		}
		$modified = filemtime( $cache_file );
		$now = time();
		$interval = 600; // ten minutes

		$response = json_decode( file_get_contents( $cache_file ), true );

		if ( !$modified || empty( $response ) || ( ( $now - $modified ) > $interval ) || !empty( $response['errors'] ) || !empty( $response['error'] ) ) {
			$settings = array(
				'oauth_access_token' => $oauth_access_token,
				'oauth_access_token_secret' => $oauth_access_token_secret,
				'consumer_key' => $consumer_key,
				'consumer_secret' => $consumer_secret,
				'username' => $username,
				'tweets' => $count
			);
			
			$twitter = new TwitterAPIExchange( $settings );
			$response = $twitter->get_tweets();

			if ( $response ) {
				$cache_static = fopen( $cache_file, 'w' );
				fwrite( $cache_static, json_encode( $response ) );
				fclose( $cache_static );
			}
		}
	}
	else{
		$response = array( 'error' => 'NOK' );
	}
	return $response;
}

function couponxl_parse_url( $url ){
	if( stripos( $url, 'youtube' ) ){
		$temp = explode( '?v=', $url );
		return 'https://www.youtube.com/embed/'.$temp[1];
	}
	else if( stripos( $url, 'vimeo' ) ){
		$temp = explode( 'vimeo.com/', $url );
		return '//player.vimeo.com/video/'.$temp[1];
	}
	else{
		return $url;
	}
}


/* DISCUSSION SYSTEM */

function couponxl_prepare_discussion_names( $offer_discussion_old ){
	$reg_exUrl = "/%user_[^%]*%/";
	if( preg_match_all( $reg_exUrl, $offer_discussion_old, $matches ) ) {
		foreach( $matches[0] as $match ){
			$user_id = str_replace( array( '%', 'user_'), '', $match );
			$user = get_userdata( $user_id );
	    	$offer_discussion_old =  str_replace( $match, $user->user_nicename, $offer_discussion_old );
	    }
	}

	$reg_time = "/#[^#]*#/";
	if( preg_match_all( $reg_time, $offer_discussion_old, $matches ) ) {
		foreach( $matches[0] as $match ){
			$time = str_replace( '#', '', $match );
			$time = date_i18n( 'M j, Y - H:i:s', $time );
	    	$offer_discussion_old =  str_replace( $match, '<span>('.$time.')</span>', $offer_discussion_old );
	    }
	}	

	return $offer_discussion_old;
}



function couponxl_new_offer( $offer_id ){
	$to = couponxl_get_option( 'new_offer_email' );
	$message = __('New offer has been submited. You can edit it ','couponxl' ).get_edit_post_link( $offer_id, ''  );

    $info = @wp_mail( $to, __( 'New offer submited', 'couponxl' ), $message);

    return $info;
}


function couponxl_send_admin_message( $message, $user_id = '' ){	
    $headers   = array();
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=UTF-8"; 

	if( !empty( $user_id ) ){
		$user = get_userdata($user_id);
		$to = $user->user_email;
		$from_mail = couponxl_get_option( 'discussion_form_mail' );
		$from_name = couponxl_get_option( 'discussion_form_mail_name' );
		$headers[] = "From: ".$from_name." <".$from_mail.">";
	}
	else{
		$to = couponxl_get_option( 'discussion_form_mail' );
	}

	$subject = couponxl_get_option( 'discussion_form_subject' );

    $info = @wp_mail( $to, $subject, $message, $headers );

    return $info;
}


function couponxl_add_meta_box() {
	add_meta_box(
		'offer_discussion',
		__( 'Offer Discussion', 'couponxl' ),
		'couponxl_discussion_meta',
		'offer'
	);
}
add_action( 'add_meta_boxes', 'couponxl_add_meta_box' );



function couponxl_discussion_meta( $post ) {
	$offer_discussion_old = get_post_meta( $post->ID, 'offer_discussion', true );
	if( !empty( $offer_discussion_old ) ){
		echo '<h4>'.__( 'Previous discussion', 'couponxl' ).'</h4>';
	}
	$offer_discussion_old = couponxl_prepare_discussion_names( $offer_discussion_old );
	echo apply_filters( 'the_content', $offer_discussion_old );	
	?>
	<div class="field">
		<div class="field-title">
			<label for="offer_discussion"><?php _e( 'Respond to author', 'couponxl' ); ?></label>
		</div>
		<div class="field-item">
			<textarea id="offer_discussion" name="offer_discussion" style="min-height: 300px; width: 100%"></textarea>
		</div>
	</div>
	<div class="field">
		<div class="field-title">
			<label for="offer_discussion_clear"><?php _e( 'Clear Discussion', 'couponxl' ); ?></label>
		</div>
		<div class="field-item">
			<select id="offer_discussion_clear" name="offer_discussion_clear">
				<option value="no"><?php _e( 'No', 'couponxl' ) ?></option>
				<option value="yes"><?php _e( 'Yes', 'couponxl' ) ?></option>
			</select>
		</div>
	</div>	
	<?php
}

function couponxl_save_meta_box_data( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	if ( ! isset( $_POST['offer_discussion'] ) ) {
		return;
	}

	$offer_discussion = sanitize_text_field( $_POST['offer_discussion'] );
	$offer_discussion_clear = sanitize_text_field( $_POST['offer_discussion_clear'] );
	if( $offer_discussion_clear == 'yes' ){
		delete_post_meta( $post_id, 'offer_discussion' );	
	}	
	if( !empty( $offer_discussion ) ){
		// Sanitize user input.
		$offer_discussion_old = get_post_meta( $post_id, 'offer_discussion', true );
		$offer_discussion_old .= "<strong>%user_".get_current_user_id()."% #".current_time( 'timestamp' )."#:</strong>\n".$offer_discussion."\n\n";
		update_post_meta( $post_id, 'offer_discussion', $offer_discussion_old );
		$info = couponxl_send_admin_message( $offer_discussion, $post->post_author );
	}
}
add_action( 'save_post', 'couponxl_save_meta_box_data', 10, 2 );

/* VOUCHER STATUS */
function couponxl_voucher_status(){
	$voucher_id = esc_sql( $_POST['voucher_id'] );
	$status = esc_sql( $_POST['status'] );
	update_post_meta( $voucher_id, 'voucher_status', $status );
	$voucher_deal = get_post_meta( $voucher_id, 'voucher_deal', true );
	$deal_voucher_expire = get_post_meta( $voucher_deal, 'deal_voucher_expire', true );
	if( !empty( $deal_voucher_expire ) && $deal_voucher_expire <= current_time( 'timestamp' ) ){
		$status = __( 'Expired', 'couponxl' );
	}
	else{
		if( $status == 'used' ){
			$status = __( 'Used', 'couponxl' );
		}
		else{
			$status = __( 'Not Used', 'couponxl' );	
		}
	}

	echo $status;
	die();
}
add_action('wp_ajax_voucher_status', 'couponxl_voucher_status');
add_action('wp_ajax_nopriv_voucher_status', 'couponxl_voucher_status');


/* AAJX AVATAR CHANGE */
function couponxl_change_avatar(){
	global $wp_user_avatar;
	$user_id = get_current_user_id();
	$wp_user_avatar->wpua_action_process_option_update( $user_id );
	echo couponxl_get_avatar_url( get_avatar( $user_id, 55 ) );
	die();
}
add_action('wp_ajax_change_avatar', 'couponxl_change_avatar');
add_action('wp_ajax_nopriv_change_avatar', 'couponxl_change_avatar');



function couponxl_get_breadcrumbs(){
	global $offer_type, $offer_cat, $location;
	$breadcrumb = '';
	if( is_front_page() ){
		return '';
	}
	$breadcrumb .= '<ul class="breadcrumb">';
	if( is_home() ){
		$breadcrumb .= '<li><a href="'.home_url().'">'.__( 'Home', 'couponxl' ).'</a></li><li>'.__( 'Blog', 'couponxl' ).'</li>';
	}
	else{
		$blog_page = get_option( 'page_for_posts' );
		$blog_url = get_permalink( $blog_page );
		if( !is_home() ){
			$breadcrumb .= '<li><a href="'.home_url().'">'.__( 'Home', 'couponxl' ).'</a></li>';
		}	
		if( is_category() ){
			$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
			$breadcrumb .= '<li>'.single_cat_title( '', false ).'</li>';
		}
		else if( is_404() ){
			$breadcrumb .= '<li>'.__( '404 Page Doesn\'t exists', 'couponxl' ).'</li>';
		}
		else if( is_tag() ){
			$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
			$breadcrumb .= '<li>'.__('Search by tag: ', 'couponxl'). get_query_var('tag').'</li>';
		}
		else if( is_author() ){
			$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
			$breadcrumb .= '<li>'.__('Posts by', 'couponxl').'</li>';
		}
		else if( is_archive() ){
			$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
			$breadcrumb .= '<li>'.__('Archive for:', 'couponxl'). single_month_title(' ',false).'</li>';
		}
		else if( is_search() ){
			$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
			$breadcrumb .= '<li>'.__('Search results for: ', 'couponxl').' '. get_search_query().'</li>';
		}
		else if( is_singular('offer') ){
			$terms = get_the_terms( get_the_ID(), 'offer_cat' );
			if( !empty( $terms ) ){
				$last = array_pop( $terms );
				$breadcrumb .= '<li><a href="'.esc_url( couponxl_append_query_string( couponxl_get_permalink_by_tpl( 'page-tpl_search_page' ), array( 'offer_cat' => $last->slug ), array('all') ) ).'">'.$last->name.'</a></li>';
			}
			$breadcrumb .= '<li>'.get_the_title().'</li>';
		}
		else{
			$page_template = get_page_template_slug();
			if( $page_template == 'page-tpl_search_page.php' ){
				if( empty( $offer_type ) ){
					$breadcrumb .= '<li>'.__( 'Deals and coupons ', 'couponxl' );
				}
				else if( $offer_type == 'deal' ){
					$breadcrumb .= '<li>'.__( 'Deals ', 'couponxl' );
				}
				else{
					$breadcrumb .= '<li>'.__( 'Coupons ', 'couponxl' );
				}		

				if( !empty( $offer_cat ) ){
					$offer_cat_term = get_term_by( 'slug', esc_sql( $offer_cat ), 'offer_cat' );
					if( !empty( $offer_cat_term ) ){
						$breadcrumb .= __( 'from category ', 'couponxl' );
						$breadcrumb .= $offer_cat_term->name." ";
					}
				}

				if( !empty( $location ) ){
					$location_term = get_term_by( 'slug', esc_sql( $location ), 'location' );
					if( !empty( $location_term ) ){
						$breadcrumb .= __( 'located in ', 'couponxl' );
						$breadcrumb .= $location_term->name;
					}
				}

				$breadcrumb .= '</li>';
			}
			else{
				if( is_singular( 'store' ) ){
					$all_stores = couponxl_get_permalink_by_tpl( 'page-tpl_all_stores.php' );
					if( stristr( $all_stores, 'http' ) ){
						$breadcrumb .= '<li><a href="'.esc_url( $all_stores ).'">'.__( 'All Stores', 'couponxl' ).'</a></li>';
					}
				}
				if( is_singular( 'post' ) ){
					$breadcrumb .= '<li><a href="'.esc_url( $blog_url ).'">'.__( 'Blog', 'couponxl' ).'</a></li>';
				}
				$breadcrumb .= '<li>'.get_the_title().'</li>';
			}
		}
	}
	$breadcrumb .= '</ul>';

	return $breadcrumb;
}


add_filter( 'ajax_query_attachments_args', 'couponxl_filter_images', 10, 1 );
function couponxl_filter_images($query = array()) {
	$has_memebers_page = couponxl_get_permalink_by_tpl( 'page-tpl_my_profile' );
	if( $has_memebers_page !== 'javascript:;' ){
    	$query['author'] = get_current_user_id();
    }
    return $query;
}


add_action( 'admin_init', 'couponxl_non_admin_users' );
function couponxl_non_admin_users() {
	$user_ID = get_current_user_id();
	$user_agent = get_user_meta( $user_ID, 'user_agent', true );
	if ( ! current_user_can( 'manage_options' ) && !stristr( $_SERVER['PHP_SELF'], 'admin-ajax.php' ) && !stristr( $_SERVER['PHP_SELF'], 'async-upload.php' ) && ( !$user_agent || $user_agent == 'no' )) {
		wp_redirect( home_url() );
		exit;
	}
}


/* DASHBOARD */
//add_action( 'wp_dashboard_setup', 'couponxl_dashboard_overview' );
function couponxl_dashboard_overview() {
	add_meta_box('couponxl_coupon_overall', __( 'Coupon', 'couponxl' ), 'couponxl_coupon_overall', 'dashboard', 'side', 'high');
	add_meta_box('couponxl_deal_overall', __( 'Deal', 'couponxl' ), 'couponxl_deal_overall', 'dashboard', 'side', 'high');
	add_meta_box('couponxl_user_overall', __( 'User', 'couponxl' ), 'couponxl_user_overall', 'dashboard', 'side', 'high');
	add_meta_box('couponxl_earnings_overall', __( 'Earnings', 'couponxl' ), 'couponxl_earnings_overall', 'dashboard', 'side', 'high');
}

function couponxl_coupon_overall(){
	/* COUNT COUPONS */
    $coupons_valid = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_start',
				'value' => current_time( 'timestamp' ),
				'compare' => '<='
			),
			array(
				'key' => 'offer_expire',
				'value' => current_time( 'timestamp' ),
				'compare' => '>='
			),
            array(
            	'key' => 'offer_type',
            	'value' => 'coupon',
            	'compare' => '='
            )
        )
    ) );

    $coupons_expired = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			array(
				'key' => 'offer_expire',
				'value' => current_time( 'timestamp' ),
				'compare' => '<'
			),
            array(
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
            	'key' => 'offer_type',
            	'value' => 'coupon',
            	'compare' => '='
            )
        )
    ));

    $coupons_scheduled = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			array(
				'key' => 'offer_start',
				'value' => current_time( 'timestamp' ),
				'compare' => '>'
			),
            array(
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
            	'key' => 'offer_type',
            	'value' => 'coupon',
            	'compare' => '='
            )
        )
    )); 

    $total_coupons = $coupons_valid + $coupons_expired;
    
	echo '
		<ul class="couponxl-overall-stats">
			<li>'.__( 'Valid Coupons:', 'couponxl' ).'<span class="value">'.$coupons_valid.'</span></li>
			<li>'.__( 'Expired Coupons:', 'couponxl' ).'<span class="value">'.$coupons_expired.'</span></li>
			<li>'.__( 'Scheduled Coupons:', 'couponxl' ).'<span class="value">'.$coupons_scheduled.'</span></li>
			<li>'.__( 'Total Coupons:', 'couponxl' ).'<span class="value">'.$total_coupons.'</span></li>
		</ul>
	';
}

function couponxl_deal_overall(){
    /* COUNT DEALS */
    $deals_valid = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_start',
				'value' => current_time( 'timestamp' ),
				'compare' => '<='
			),
			array(
				'key' => 'offer_expire',
				'value' => current_time( 'timestamp' ),
				'compare' => '>='
			),
            array(
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
            	'key' => 'offer_type',
            	'value' => 'deal',
            	'compare' => '='
            )
        )
    ) );

    $deals_expired = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			'relation' => 'AND',
			array(
				'key' => 'offer_expire',
				'value' => current_time( 'timestamp' ),
				'compare' => '<'
			),
            array(
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
            	'key' => 'offer_type',
            	'value' => 'deal',
            	'compare' => '='
            ) 
        )
    ));

    $deals_scheduled = couponxl_count_post_type( 'offer', array(
    	'meta_query' => array(
			array(
				'key' => 'offer_start',
				'value' => current_time( 'timestamp' ),
				'compare' => '>'
			),
            array(
                'key' => 'deal_status',
                'value' => 'has_items',
                'compare' => '='
            ),
            array(
            	'key' => 'offer_type',
            	'value' => 'deal',
            	'compare' => '='
            ) 			
        )
    )); 

    $total_deals = $deals_valid + $deals_expired;

	echo '
		<ul class="couponxl-overall-stats">
			<li>'.__( 'Valid Deals:', 'couponxl' ).'<span class="value">'.$deals_valid.'</span></li>
			<li>'.__( 'Expired Deals:', 'couponxl' ).'<span class="value">'.$deals_expired.'</span></li>
			<li>'.__( 'Scheduled Deals:', 'couponxl' ).'<span class="value">'.$deals_scheduled.'</span></li>
			<li>'.__( 'Total Deals:', 'couponxl' ).'<span class="value">'.$total_deals.'</span></li>
		</ul>
	';
}

function couponxl_user_overall(){
    /* COUNT USERS */
    $result = count_users();
    $total_users = 0;
    if( !empty( $result['avail_roles']['editor'] ) ){
    	$total_users = $result['avail_roles']['editor'];
   	}	
   	global $wpdb;
 
	$date = date('Y-m-d', current_time( 'timestamp' ));

	$morning = new DateTime($date. ' 00:00:00');
	$night = new DateTime($date.' 23:59:59'); 
	$m = $morning->format('Y-m-d H:i:s');
	$n = $night->format('Y-m-d H:i:s');

	$sql = $wpdb->prepare("SELECT COUNT(*) AS users_count FROM ".$wpdb->users." WHERE 1=1 AND CAST(user_registered AS DATE) BETWEEN %s AND %s ORDER BY user_login ASC",$m,$n);

	$users = $wpdb->get_results($sql);
	$users = array_shift($users);

    $users_today = $users->users_count;


    $date = date('Y-m-d', current_time( 'timestamp' ) - 86400);
	$morning = new DateTime($date. ' 00:00:00');
	$night = new DateTime($date.' 23:59:59'); 
	$m = $morning->format('Y-m-d H:i:s');
	$n = $night->format('Y-m-d H:i:s');

	$sql = $wpdb->prepare("SELECT COUNT(*) AS users_count FROM ".$wpdb->users." WHERE 1=1 AND CAST(user_registered AS DATE) BETWEEN %s AND %s ORDER BY user_login ASC",$m,$n);

	$users = $wpdb->get_results($sql);
	$users = array_shift($users);

    $users_yesterday = $users->users_count;
	echo '
		<ul class="couponxl-overall-stats">
			<li>'.__( 'Registered Users Today:', 'couponxl' ).'<span class="value">'.$users_today.'</span></li>
			<li>'.__( 'Registered Users Yesterday:', 'couponxl' ).'<span class="value">'.$users_yesterday.'</span></li>
			<li>'.__( 'Total Users:', 'couponxl' ).'<span class="value">'.$total_users.'</span></li>
		</ul>
	';
}

function couponxl_earnings_overall(){
    /* COUNT TOTAL EARNINGS */
    $per_coupon = couponxl_get_option( 'coupon_submit_price' );
    $coupon_earnings = __( 'Disabled', 'couponxl' );
    if( !empty( $per_coupon ) ){
	    $coupon_paid_submissions = couponxl_count_post_type( 'offer', array(
	    	'meta_query' => array(
	    		'relation' => 'AND',
	    		array(
	    			'key' => 'offer_type',
	    			'value' => 'coupon',
	    			'compare' => '='
	    		),
	    		array(
	    			'key' => 'offer_initial_payment',
	    			'value' => 'paid',
	    			'compare' => '='
	    		)
	    	)
	    ));
	    $coupon_earnings = $per_coupon * $coupon_paid_submissions;
	}

    $per_deal = couponxl_get_option( 'deal_submit_price' );
    $deal_sub_earnings = __( 'Disabled', 'couponxl' );
    if( !empty( $per_deal ) ){
	    $deal_paid_submissions = couponxl_count_post_type( 'offer', array(
	    	'meta_query' => array(
	    		'relation' => 'AND',
	    		array(
	    			'key' => 'offer_type',
	    			'value' => 'deal',
	    			'compare' => '='
	    		),
	    		array(
	    			'key' => 'offer_initial_payment',
	    			'value' => 'paid',
	    			'compare' => '='
	    		)
	    	)
	    ));
	    $deal_sub_earnings = $per_deal * $deal_paid_submissions;
	}

	$vouchers_earnings = 0;
	$vouchers = get_posts(array(
		'post_type' => 'voucher',
		'posts_per_page' => -1,
		'post_status' => 'publish',
	));

	if( !empty( $vouchers ) ){
		foreach( $vouchers as $voucher ){
			$vouchers_earnings += get_post_meta( $voucher->ID, 'voucher_owner_share', true );
		}
	}

	$total_earnings = $coupon_earnings + $deal_sub_earnings + $vouchers_earnings;

	echo '
		<ul class="couponxl-overall-stats">
			<li>'.__( 'Coupon Subbmission Earnings:', 'couponxl' ).'<span class="value">'.couponxl_format_price_number( $coupon_earnings ).'</span></li>
			<li>'.__( 'Deals Submission Earnings:', 'couponxl' ).'<span class="value">'.couponxl_format_price_number( $deal_sub_earnings ).'</span></li>
			<li>'.__( 'Deal Vouchers Sell Earnings:', 'couponxl' ).'<span class="value">'.couponxl_format_price_number( $vouchers_earnings ).'</span></li>
			<li>'.__( 'Total Earnings:', 'couponxl' ).'<span class="value">'.couponxl_format_price_number( $total_earnings ).'</span></li>
		</ul>
	';
}

$couponxl_term_count = array(
	'offer_cat' => array(),
	'location' => array()
);
function couponxl_custom_term_count( $offer_type, $term, $taxonomy ){
	global $couponxl_term_count;
	if( empty( $couponxl_term_count[$taxonomy] ) ){
		global $wpdb, $offer_type, $offer_cat, $location, $offer_tag, $offer_store, $keyword;
		$query = "SELECT terms1.term_id as ID, COUNT(posts.ID) AS posts 
					FROM {$wpdb->posts} AS posts 
					LEFT JOIN {$wpdb->postmeta} AS postmeta1 ON posts.ID = postmeta1.post_id 
					LEFT JOIN {$wpdb->postmeta} AS postmeta2 ON postmeta1.post_id = postmeta2.post_id 
					LEFT JOIN {$wpdb->postmeta} AS postmeta3 ON postmeta2.post_id = postmeta3.post_id 
					LEFT JOIN {$wpdb->term_relationships} AS termsrel1 ON posts.ID = termsrel1.object_id 
					LEFT JOIN {$wpdb->terms} AS terms1 ON termsrel1.term_taxonomy_id = terms1.term_id 
					LEFT JOIN {$wpdb->term_taxonomy} AS tax ON termsrel1.term_taxonomy_id = tax.term_taxonomy_id ";
		if( !empty( $offer_type ) ){
			$query .= "LEFT JOIN {$wpdb->postmeta} AS postmeta4 ON postmeta3.post_id = postmeta4.post_id ";
		}
		if( !empty( $offer_store ) ){
			if( !empty( $offer_type ) ){
				$query .= "LEFT JOIN {$wpdb->postmeta} AS postmeta5 ON postmeta4.post_id = postmeta5.post_id ";
			}
			else{
				$query .= "LEFT JOIN {$wpdb->postmeta} AS postmeta5 ON postmeta3.post_id = postmeta5.post_id ";	
			}
		}
		if( ( !empty( $offer_cat ) && $taxonomy == 'location' ) || ( !empty( $location ) && $taxonomy == 'offer_cat' ) ){
			$query .= "LEFT JOIN {$wpdb->term_relationships} AS termsrel2 ON posts.ID = termsrel2.object_id  ";
			$query .= "LEFT JOIN {$wpdb->terms} AS terms2 ON termsrel2.term_taxonomy_id = terms2.term_id ";
			$query .= "LEFT JOIN {$wpdb->term_taxonomy} AS tax2 ON termsrel2.term_taxonomy_id = tax2.term_taxonomy_id ";
		}
		$query .= "
					WHERE posts.post_type = 'offer' 
					AND postmeta1.meta_key = 'offer_start' 
					AND postmeta1.meta_value <= ".current_time( 'timestamp' )." 
					AND postmeta2.meta_key = 'offer_expire' 
					AND postmeta2.meta_value >= ".current_time( 'timestamp' )." 
					AND postmeta3.meta_key = 'deal_status' 
					AND postmeta3.meta_value != 'sold_out' 
					AND tax.taxonomy = '".esc_sql( $taxonomy )."' 
					";
		if( !empty( $offer_type ) ){
			$query .= "AND postmeta4.meta_key = 'offer_type' AND postmeta4.meta_value = '".esc_sql( $offer_type )."' ";
		}
		if( !empty( $offer_store ) ){
			$query .= "AND postmeta5.meta_key = 'offer_store' AND postmeta5.meta_value = '".esc_sql( $offer_store )."' ";
		}
		if( !empty( $keyword ) ){
			$keywords = explode( " ", $keyword );
			$query .= "AND ";
			for( $i=0; $i<sizeof( $keywords ); $i++ ){
				$query .= "( posts.post_title LIKE '%".esc_sql( $keywords[$i] )."%' OR posts.post_content LIKE '%".esc_sql( $keywords[$i] )."%' ) ";
				if( $i<sizeof( $keywords )-1 ){
					$query .= "AND ";
				}
			}
		}
		if( ( !empty( $offer_cat ) && $taxonomy == 'location' ) || ( !empty( $location ) && $taxonomy == 'offer_cat' ) ){
			$slug = $taxonomy == 'offer_cat' ? $location : $offer_cat;
			$query .= "AND terms2.slug = '".esc_sql( $slug )."' ";
			$tax2 = $taxonomy == 'offer_cat' ? 'location' : 'offer_cat';
			$query .= "AND tax2.taxonomy = '".esc_sql( $tax2 )."' ";
		}
		$query .= "GROUP BY terms1.term_id";

		$couponxl_term_count[$taxonomy] = $wpdb->get_results( $query );

	}

	$count = 0;
	if( !empty( $term ) ){
		foreach( $couponxl_term_count[$taxonomy] as $key => $item ){
			if( $item->ID == $term->term_id ){
				$count = $item->posts;
				unset( $couponxl_term_count[$taxonomy][$key] );
				break;
			}
		}	
	}

	return '<span class="count">'.$count.'</span>';

}

function couponxl_shortcode_style( $style_css ){
 	return '<script>jQuery(document).ready( function($){ $("head").append( \''.str_replace( array( "\n", "\r" ), " ", $style_css).'\' ); });</script>';
}


function couponxl_mime_types($mimes){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'couponxl_mime_types');

/* PERMALINKS MANIPULATION */
global $couponxl_slugs;
$couponxl_slugs = array(
	'offer_type' => 'offer_type',
	'offer_cat' => 'offer_cat',
	'offer_tag' => 'offer_tag',
	'location' => 'location',
	'offer_store' => 'offer_store',
	'store' => 'store',
	'offer_view' => 'offer_view',
	'offer_sort' => 'offer_sort',
	'keyword' => 'keyword',
	'deal' => 'deal',
	'coupon' => 'coupon',
	'letter' => 'letter',
	'confirmation_hash' => 'confirmation_hash',
	'username' => 'username',
	'subpage' => 'subpage',
	'offer_id' => 'offer_id',
	'action' => 'action'
);

function couponxl_get_couponxl_slugs(){
	global $couponxl_slugs;
	foreach( $couponxl_slugs as &$slug ){
		$trans = couponxl_get_option( 'trans_'.$slug );
		if( !empty( $trans ) ){
			$slug = $trans;
		}
	}
}
add_action( 'init', 'couponxl_get_couponxl_slugs', 1, 0);


function couponxl_append_query_string( $permalink, $include = array(), $exclude = array( 'coupon' ) ){
	global $couponxl_slugs;
	global $wp;
	if ( !$permalink ){
		$permalink = get_permalink();
	}

	// Map endpoint to options
	if ( get_option( 'permalink_structure' ) ) {
		if ( strstr( $permalink, '?' ) ) {
			$query_string = '?' . parse_url( $permalink, PHP_URL_QUERY );
			$permalink    = current( explode( '?', $permalink ) );
		} else {
			$query_string = '';
		}

		$permalink = trailingslashit( $permalink );
		if( !empty( $include ) ){
			foreach( $include as $arg => $value ){
				$permalink .= $couponxl_slugs[$arg].'/'.$value.'/';
			}
		}
		foreach( $couponxl_slugs as $slug => $trans_slug ){
			if( isset( $wp->query_vars[$trans_slug] ) && !isset( $include[$slug] ) && !in_array( $slug, $exclude ) && !in_array( 'all', $exclude ) ){
				$permalink .= $trans_slug.'/'.$wp->query_vars[$trans_slug].'/';
			}
		}
		$permalink .= $query_string;
	} 
	else {
		if( !empty( $include ) ){
			foreach( $include as $arg => $value ){
				$permalink = esc_url( add_query_arg( array( $couponxl_slugs[$arg] => $value ), $permalink ) );
			}
		}
		foreach( $couponxl_slugs as $slug => $trans_slug ){
			if( isset( $wp->query_vars[$trans_slug] ) && !isset( $include[$slug] ) && !in_array( $slug, $exclude ) && !in_array( 'all', $exclude ) ){
				$permalink = esc_url( add_query_arg( array( $trans_slug => $wp->query_vars[$trans_slug] ), $permalink ) );
			}
		}		
		
	}	

	return $permalink;
}


function couponxl_add_rewrite_rules() {
    global $wp_rewrite;
    global $couponxl_slugs;
    $new_rules = array();
    $custom_rules = array();
	for( $i=count( $couponxl_slugs ); $i>=1; $i-- ){
		$key = str_repeat( '('.join('|', $couponxl_slugs).')/(.+?)/', $i );

		$key_1 = '([^/]*)/'.$key.'(page)/(.+?)/?$';
		$key_2 = '([^/]*)/'.$key.'?$';
		$rewrite_to = 'index.php?pagename='.$wp_rewrite->preg_index( 1 );
		
		for( $k=2; $k<=($i*2)+1; $k+=2 ){
			$rewrite_to .= '&' . $wp_rewrite->preg_index( $k ) . '=' . $wp_rewrite->preg_index( $k+1 );
		}

		$custom_rules[$key_1] = $rewrite_to.'&paged='.$wp_rewrite->preg_index( $k+1 );
		$custom_rules[$key_2] = $rewrite_to;

	}

    $wp_rewrite->rules = $custom_rules + $wp_rewrite->rules ;
}
add_action( 'generate_rewrite_rules', 'couponxl_add_rewrite_rules' );


function couponxl_rewrite_tag() {
	global $couponxl_slugs;
	foreach( $couponxl_slugs as $slug ){
		add_rewrite_tag('%'.$slug.'%', '([^&]+)');
	}
	add_rewrite_endpoint( $couponxl_slugs['offer_type'], EP_ALL );
	add_rewrite_endpoint( $couponxl_slugs['coupon'], EP_ALL );
}
add_action('init', 'couponxl_rewrite_tag', 2, 0);

function couponxl_store_pagination() {
	global $couponxl_slugs;
  	if ( is_singular('store') ) {
	    global $wp_query;
	    $page = (int) $wp_query->get('paged');
	    $offer_type = $wp_query->get( $couponxl_slugs['offer_type'] );

	    if( $offer_type && strpos( $offer_type, 'paged' ) ){
	    	$temp = explode( '/paged/', $offer_type );
	    	if( strpos( $temp[0], '/'.$couponxl_slugs['coupon'].'/' ) ){
	    		$temp2 = explode( '/'.$couponxl_slugs['coupon'].'/', $temp[0] );
	    		$wp_query->set( $couponxl_slugs['offer_type'], $temp2[0] );
	    	}
	    	else{
      			$wp_query->set( $couponxl_slugs['offer_type'], $temp[0] );
      		}
      		$wp_query->set( 'page', $temp[1] );
      		$wp_query->set( 'paged', $temp[1] );
	    }
	    else if( $offer_type && strpos( $offer_type, '/'.$couponxl_slugs['coupon'].'/' ) ){
	    	$temp = explode( '/'.$couponxl_slugs['coupon'].'/', $offer_type );
	    	$wp_query->set( $couponxl_slugs['offer_type'], $temp[0] );
	    }
	    else if ( $page > 1 ) {
    		// convert 'page' to 'paged'
      		$wp_query->set( 'page', 1 );
      		$wp_query->set( 'paged', $page );
    	}
    	// prevent redirect
    	remove_action( 'template_redirect', 'redirect_canonical' );
  	}
}
add_action('template_redirect', 'couponxl_store_pagination', 0 );

function couponxl_store_pagenum_link( $link ) { 
    if( !is_singular('store') )
        return $link;    // Do nothing unless on a search

    // Attempt to parse the page number from the provided URL
    if( !preg_match( '#/paged/(\d+)#', $link, $matches ) )
        return $link;

    // Return a re-formed URL
    $temp = explode( '/paged', $link );
    return $temp[0];
}
add_filter( 'get_pagenum_link', 'couponxl_store_pagenum_link' );

function couponxl_register(){
	global $couponxl_slugs;

	$first_name = isset( $_POST['first_name'] ) ? esc_sql( $_POST['first_name'] ) : '';
	$last_name = isset( $_POST['last_name'] ) ? esc_sql( $_POST['last_name'] ) : '';
	$email = isset( $_POST['email'] ) ? esc_sql( $_POST['email'] ) : '';
	$username = isset( $_POST['username'] ) ? esc_sql( $_POST['username'] ) : '';
	$password = isset( $_POST['password'] ) ? esc_sql( $_POST['password'] ) : '';
	$repeat_password = isset( $_POST['repeat_password'] ) ? esc_sql( $_POST['repeat_password'] ) : '';
	$message = '';

	if( isset( $_POST['register_field'] ) ){
	    if( wp_verify_nonce($_POST['register_field'], 'register') ){
	        if( !isset( $_POST['captcha'] ) ){
	            if( !empty( $first_name ) && !empty( $last_name ) && !empty( $email ) && !empty( $username ) && !empty( $password ) && !empty( $repeat_password ) ){
	                if( filter_var($email, FILTER_VALIDATE_EMAIL) ){
	                	if( stristr( $username, " " ) === false && stristr( $username, "." ) === false ){
		                    if( $password ==  $repeat_password ){
		                        if( !username_exists( $username ) ){
		                            if( !email_exists( $email ) ){
		                                $user_id = wp_insert_user(array(
		                                    'user_login'  => $username,
		                                    'user_pass'   => $password,
		                                    'user_email'  => $email
		                                ));
		                                if( !is_wp_error($user_id) ) {
		                                	wp_new_user_notification( $user_id, null, 'admin' );
		                                    wp_update_user(array(
		                                        'ID' => $user_id,
		                                        'role' => 'editor'
		                                    ));
		                                    $confirmation_hash = couponxl_confirm_hash();
		                                    update_user_meta( $user_id, "first_name",  $first_name );
		                                    update_user_meta( $user_id, "last_name",  $last_name );
		                                    update_user_meta( $user_id, 'user_active_status', 'inactive' );
		                                    update_user_meta( $user_id, 'confirmation_hash', $confirmation_hash );

		                                    $confirmation_message = couponxl_get_option( 'registration_message' );
		                                    $confirmation_link = couponxl_get_permalink_by_tpl( 'page-tpl_register' );
		                                    $confirmation_link = couponxl_append_query_string( $confirmation_link,  array( 'username' => $username, 'confirmation_hash' => $confirmation_hash ) );
		                                    
		                                    $confirmation_message = str_replace( '%LINK%', $confirmation_link, $confirmation_message );

		                                    $registration_subject = couponxl_get_option( 'registration_subject' );

		                                    $email_sender = couponxl_get_option( 'email_sender' );
		                                    $name_sender = couponxl_get_option( 'name_sender' );
		                                    $headers   = array();
		                                    $headers[] = "MIME-Version: 1.0";
		                                    $headers[] = "Content-Type: text/html; charset=UTF-8"; 
		                                    $headers[] = "From: ".$name_sender." <".$email_sender.">";

		                                    $info = wp_mail( $email, $registration_subject, $confirmation_message, $headers );
		                                    if( $info ){
		                                        $message = '<div class="alert alert-success">'.__( 'Thank you for registering, an email to confirm your email address is sent to your inbox.', 'couponxl' ).'</div>';
		                                        $success = true;
		                                    }
		                                    else{
		                                        $message = '<div class="alert alert-danger">'.__( 'There was an error trying to send an email', 'couponxl' ).'</div>';  
		                                    }
		                                }
		                                else{
		                                    $message = '<div class="alert alert-danger">'.__( 'There was an error while trying to register you', 'couponxl' ).'</div>';
		                                }
		                            }
		                            else{
		                                $message = '<div class="alert alert-danger">'.__( 'Email is already registered', 'couponxl' ).'</div>';
		                            }
		                        }
		                        else{
		                            $message = '<div class="alert alert-danger">'.__( 'Username is already registered', 'couponxl' ).'</div>';
		                        }
		                    }
		                    else{
		                        $message = '<div class="alert alert-danger">'.__( 'Provided passwords do not match', 'couponxl' ).'</div>';    
		                    }
		                }
	                    else{
	                        $message = '<div class="alert alert-danger">'.__( 'Username can not hold empty spaces or dots', 'couponxl' ).'</div>';    
	                    }		                    
	                }
	                else{
	                    $message = '<div class="alert alert-danger">'.__( 'Email address is invalid', 'couponxl' ).'</div>';
	                }
	            }
	            else{
	                $message = '<div class="alert alert-danger">'.__( 'All fields are required', 'couponxl' ).'</div>';
	            }
	        }
	        else{
	            $message = '<div class="alert alert-danger">'.__( 'Captcha is wrong', 'couponxl' ).'</div>';
	        }
	    }
	    else{
	        $message = '<div class="alert alert-danger">'.__( 'You do not permission for your action', 'couponxl' ).'</div>';
	    }
	}

	echo json_encode(array(
		'message' => $message,
	));
	die();
}
add_action('wp_ajax_register', 'couponxl_register');
add_action('wp_ajax_nopriv_register', 'couponxl_register');

function couponxl_safe_sql(){
	global $wpdb;
	$wpdb->query( 'SET SESSION SQL_BIG_SELECTS=1' );
}
add_action( 'init', 'couponxl_safe_sql' );


function couponxl_user_earnings( $user_id ){
	$earnings = array(
		'sales' => 0,
		'not_paid' => 0,
		'paid' => 0
	);
	$vouchers = get_posts(array(
		'post_type' => 'voucher',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' => 'voucher_seller_id',
				'value' => $user_id,
				'compare' => '='
			)
		)
	));
	$earnings['sales'] = count( $vouchers );

	if( !empty( $vouchers ) ){
		foreach( $vouchers as $voucher ){
			$voucher_type = get_post_meta( $voucher->ID, 'voucher_type', true );
			$voucher_payment_status = get_post_meta( $voucher->ID, 'voucher_payment_status', true );
			$voucher_seller_share = get_post_meta( $voucher->ID, 'voucher_seller_share', true );
			if( $voucher_type == 'shared' ){
				if( $voucher_payment_status == 'paid' ){
					$earnings['paid'] += $voucher_seller_share;
				}
				else{
					$earnings['not_paid'] += $voucher_seller_share;
				}
			}
		}
	}

	return $earnings;
}

/* VOUCHER STATUS */
function couponxl_send_friend(){
	$frinds_email = isset( $_POST['frinds_email'] )  ? $_POST['frinds_email'] : '';
	$offer_id = isset( $_POST['offer_id'] )  ? $_POST['offer_id'] : '';
	$your_message = isset( $_POST['your_message'] )  ? $_POST['your_message'] : '';
	if( !empty( $frinds_email ) && filter_var( $frinds_email, FILTER_VALIDATE_EMAIL ) ){
	    $headers   = array();
	    $headers[] = "MIME-Version: 1.0";
	    $headers[] = "Content-Type: text/html; charset=UTF-8"; 

		$from_mail = couponxl_get_option( 'email_sender' );
	    $from_name = couponxl_get_option( 'name_sender' );
		$headers[] = "From: ".$from_name." <".$from_mail.">";
		$subject = couponxl_get_option( 'send_friend_subject' );

		$your_message .="<br/>
-------------------------<br/>
".get_permalink( $offer_id )."
";

	    $info = @wp_mail( $frinds_email, $subject, $your_message, $headers );
	    if( $info ){
			echo '<div class="alert alert-success">'.__( 'Your message has beens sent', 'couponxl' ).'</div>';
		}
		else{
			echo '<div class="alert alert-danger">'.__( 'There was an error sending your mail', 'couponxl' ).'</div>';
		}
	}
	else{
		echo '<div class="alert alert-danger">'.__( 'Email is invalid', 'couponxl' ).'</div>';
	}

	die();
}
add_action('wp_ajax_send_friend', 'couponxl_send_friend');
add_action('wp_ajax_nopriv_send_friend', 'couponxl_send_friend');

require_once( locate_template( 'includes/class-tgm-plugin-activation.php' ) );
require_once( locate_template( 'includes/google-fonts.php' ) );
require_once( locate_template( 'includes/awesome-icons.php' ) );
require_once( locate_template( 'includes/offer-cat-icon.php' ) );
require_once( locate_template( 'includes/widgets.php' ) );
require_once( locate_template( 'includes/mollie.php' ) );
require_once( locate_template( 'includes/paypal.class.php' ) );
require_once( locate_template( 'includes/redux-extension/redux-extensions.php' ) );
require_once( locate_template( 'includes/theme-options.php' ) );
require_once( locate_template( 'includes/custom-bulk.php' ) );
require_once( locate_template( 'includes/twitter_api.php' ) );
require_once( locate_template( 'includes/menu-extender.php' ) );
require_once( locate_template( 'includes/import/import.php' ) );
require_once get_template_directory() .'/includes/radium-one-click-demo-install/init.php';
if( is_admin() ){
	require_once( locate_template( 'includes/shortcodes.php' ) );
}
foreach ( glob( dirname(__FILE__).DIRECTORY_SEPARATOR."includes".DIRECTORY_SEPARATOR ."shortcodes".DIRECTORY_SEPARATOR ."*.php" ) as $filename ){
	require_once( locate_template( 'includes/shortcodes/'.basename( $filename ) ) );
}

?>