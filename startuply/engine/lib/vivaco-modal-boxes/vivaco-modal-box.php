<?php

// add_filter('acf/settings/save_json', 'my_acf_json_save_point');
//
// function my_acf_json_save_point( $path ) {
//
//     // update path
//     $path = get_template_directory() . '/css';
//
//
//     // return
//     return $path;
//
// }

function startuply_acf_custom_post_type() {

	$labels = array(
		'name'                => _x( 'Vivaco Modals', 'Post Type General Name', 'vivaco' ),
		'singular_name'       => _x( 'Vivaco Modals', 'Post Type Singular Name', 'vivaco' ),
		'menu_name'           => __( 'Vivaco Modals', 'vivaco' ),
		'parent_item_colon'   => __( 'Parent Popup', 'vivaco' ),
		'all_items'           => __( 'All Popups', 'vivaco' ),
		'view_item'           => __( 'View Popup', 'vivaco' ),
		'add_new_item'        => __( 'Add New Popup', 'vivaco' ),
		'add_new'             => __( 'Add New', 'vivaco' ),
		'edit_item'           => __( 'Edit Popup', 'vivaco' ),
		'update_item'         => __( 'Update Popup', 'vivaco' ),
		'search_items'        => __( 'Search Popups', 'vivaco' ),
		'not_found'           => __( 'Not Found', 'vivaco' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'vivaco' ),
	);

	$args = array(
		'label'               => __( 'Vivaco Modals', 'vivaco' ),
		'description'         => __( 'Vivaco Modals', 'vivaco' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
		'rewrite' => array('slug' => 'vivaco-modals'),
	);

	register_post_type( 'vivaco-modals', $args );
}
add_action( 'init', 'startuply_acf_custom_post_type', 0 );


function startuply_acf_modalbox_show(){

	global $post;

	$args = array(
		'posts_per_page' => 100000,
		'post_type' => 'vivaco-modals',
		'post_status' => 'publish',
		'orderby' => 'post_date',
		'order' => 'DESC',
	);
	$all_popups = get_posts($args);

	$pops_to_display = null;

	$current_url = startuply_current_url(null, 'no');

	if(!empty($all_popups)) {
		foreach ($all_popups as $key => $popup) {

			$show_on = get_field('vivaco_show_on', $popup->ID);

				$urls = get_field('vivaco_urls', $popup->ID);
			$urls_exclude = get_field('vivaco_urls_exclude', $popup->ID);

			if($show_on == 'all'){
				$pops_to_display[$popup->ID] = $popup->ID;
			}

			if($show_on == 'front'){
				$current_url = esc_url_raw(trim($current_url));
				$front = esc_url_raw(trim(get_home_url())).'/';
				if($current_url == $front) {
					$pops_to_display[$popup->ID] = $popup->ID;
				}
			}

			if($show_on == 'exc_front'){
				$current_url = esc_url_raw(trim($current_url));
				$front = esc_url_raw(trim(get_home_url())).'/';
				if($current_url != $front) {
					$pops_to_display[$popup->ID] = $popup->ID;
				}
			}

			//Specified Urls
			if($show_on != 'all' && $show_on != 'front' && $urls != ''){
				$urls = explode("\n", $urls);
				foreach ($urls as $key => $value) {
					$current_url = esc_url_raw(trim($current_url));
					$current_url = str_replace('www.', '', $current_url);
					$match_url = esc_url_raw(trim($value));
					$match_url = str_replace('www.', '', $match_url);

					if(strcmp(trim($current_url), trim($match_url)) == 0){
						$pops_to_display[$popup->ID] = $popup->ID;
					}
				}
			}

			// Specified Categories
			// if($show_on == 'cats'){
			// 	foreach ($cats as $key => $cat) {
			// 		if(isset($cats['is_category']) && $cats['is_category'] == 'yes'){
			// 			if(is_category($cat) && get_query_var('cat') == $cat){
			// 				$pops_to_display[$popup->ID] = $popup->ID;
			// 			}
			// 		}
			// 		if(isset($cats['in_category']) && $cats['in_category'] == 'yes'){
			// 			if(in_category($cat) && is_single()){
			// 				$pops_to_display[$popup->ID] = $popup->ID;
			// 			}
			// 		}
			// 	}
			// }

			// Exclude Pop-up
			if($urls_exclude != ''){
				$urls_exclude = explode("\n", $urls_exclude);
				foreach ($urls_exclude as $key => $exurl) {
					$current_url = esc_url_raw(trim($current_url));
					$current_url = str_replace('www.', '', $current_url);
					$ex_match_url = esc_url_raw(trim($exurl));
					$ex_match_url = str_replace('www.', '', $ex_match_url);
					if(strcmp(trim($current_url), trim($ex_match_url)) == 0){
						unset($pops_to_display[$popup->ID]);
					}

				}
			}
		}
	}


	if(!empty($pops_to_display)){
		foreach ($pops_to_display as $key => $popup) {

			echo startuply_acf_create_popup($popup);
		}
	}
}

add_action('wp_footer', 'startuply_acf_modalbox_show', 1);

// if($backend_popups == 'enable'){
// 	add_action('admin_footer', 'cjpopups_show', 1);
// }

function startuply_acf_create_popup($post_id){

		$hide_bg = 	$data_timeout = $data_lock_scroll = $modal_overlay = $hide_class = $data_cookie = $data_trigger = $data_key = $modal_background = $data_scroll = $custom_size_css = $modalWindowClass = '';

		$post = get_post($post_id);
		$popup_id = 'vivaco-'.$post->ID;
		$modalWindowClass = 'modal-window ' . $popup_id;
		$popup_title = $post->post_title;
		$popup_content = do_shortcode(wpautop($post->post_content, true));
		$html_before = do_shortcode(wpautop(get_field('vivaco_raw_before', $post->ID), true));
		$html_after = do_shortcode(wpautop(get_field('vivaco_raw_after', $post->ID), true));

		$lock_scroll = get_field('vivaco_dis_page_scroll', $post->ID);
		$hide_desktop = get_field('vivaco_hide_desktop', $post->ID);
		$hide_tablets = get_field('vivaco_hide_tablets', $post->ID);
		$hide_phones = get_field('vivaco_hide_phones', $post->ID);

		$trigger = get_field('vivaco_trigger', $post->ID);
		$size = get_field('vivaco_size', $post->ID);
		$position = get_field('vivaco_position', $post->ID);
		$overlay = get_field('vivaco_overlay', $post->ID);
		$background = get_field('vivaco_background', $post->ID);
		$animation = get_field('vivaco_start_animation', $post->ID);
		$animation_stop = get_field('vivaco_stop_animation', $post->ID);
		$duration = get_field('vivaco_duration', $post->ID);


		$popup_cookie_days = get_field('vivaco_cookie_expire', $post->ID);

		$cookie_trigger = get_field( 'vivaco_cookie_trigger', $post->ID);
		$cookie_key = get_field('vivaco_cookie_key', $post->ID);

		if($cookie_trigger == 'open' || $cookie_trigger == 'close') {

			if($popup_cookie_days > 0){
				$popup_cookie_days = get_field('vivaco_cookie_expire', $post->ID);
			}else{
				$popup_cookie_days = 0;
			}

			$cookie_key = !empty($cookie_key) ? $cookie_key : 'hide';

			$data_cookie = 'data-cookie="'.$popup_cookie_days.'"';
			$data_trigger = 'data-cookie-trigger="'.$cookie_trigger.'"';
			$data_key = 'data-cookie-key="'.$cookie_key.'"';
		}

		if( $trigger == 'scroll' ) {
				$trigger_scroll = get_field( 'vivaco_trigger_scroll', $post->ID);
				$data_scroll = 'data-scroll="'.$trigger_scroll.'"';
		}

		if( $trigger == 'timeout' ) {
				$trigger_timeout = get_field( 'vivaco_trigger_timeout', $post->ID) * 1000;
				$data_timeout = 'data-timeout="'.$trigger_timeout.'"';
		}

		if( $trigger == 'load' ) {
				$data_timeout = 'data-timeout="100"';
		}

		if( $trigger == 'button' ) {
				$data_timeout = '';
		}

		if( $lock_scroll == true ) {
				$data_lock_scroll = 'data-scroll-lock="1"';
		}

		if( $overlay == 'no' ) {
			$data_overlay = 'data-overlay="0"';
		} else {
			$data_overlay = 'data-overlay="1"';
		}


		//------------------------------DSIGN---------------------------------------
		$modal_size = ($size == 'normal') ? '' : $size;
		$modal_position = ($position == 'center') ? '' : $position;

		if ($modal_size == 'custom'){
			$custom_size = get_field('vivaco_custom_size', $post->ID);
			$tmp = explode('x', strtolower($custom_size));
			//$custom_size_css = 'style="width:' . $tmp[0] . '; height:' . $tmp[1] .';" ';
			$custom_size_css = '.' . $popup_id .' .modal-box {width:' . $tmp[0] . 'px; height:' . $tmp[1] .'px;}';
		}

		if( $overlay == 'color' ) {

			$overlay_color = get_field('vivaco_overlay_color', $post->ID) ? get_field('vivaco_overlay_color', $post->ID) : '#000000';
			$overlay_color_opacity = get_field('vivaco_overlay_color_opacity', $post->ID) ? (get_field('vivaco_overlay_color_opacity', $post->ID)/100) : 0;

			//$modal_overlay = ' style="background-color:'.esc_attr($overlay_color);
			$modal_overlay = ' style="background-color:rgba(' . hex2rgb($overlay_color) . ',' . esc_attr($overlay_color_opacity) .');"';

		}

		if( $overlay == 'image' ) {
			$overlay_image = get_field( 'vivaco_overlay_image', $post->ID);
			$modal_overlay = ' style="background:url('.remove_base_url(esc_attr($overlay_image['url'])).')"';
		}

		if( $overlay == 'no' ) {;
			$modalWindowClass .= ' no-overlay';
		}

		if( $background == 'color' ) {
			$background_color = get_field( 'vivaco_background_color', $post->ID);
			$modal_background = ' style="background-color:'.esc_attr($background_color).';border:0;"';
		}

		if( $background == 'image' ) {
			$background_image = get_field( 'vivaco_background_image', $post->ID);
			$modal_background = ' style="background:url('.remove_base_url(esc_attr($background_image['url'])).'); background-size: cover; border:0;"';
		}

		if( $background == 'hide_bg' ) {
			$hide_bg = 'hide_bg';
		}

		if( $hide_desktop == true) {
			$hide_class = "hide_desktop ";
		}
		if( $hide_tablets == true) {
			$hide_class .= "hide_tablet ";
		}
		if( $hide_phones == true) {
			$hide_class .= "hide_phone ";
		}

		$modalWindowClass .= " " . $hide_class;



		if(!empty($animation)) {
			if ($animation == 'no') {
				$data_animation = 'data-animation="fadeIn" data-duration="300"';
			}
			else {
				$data_duration = !empty($duration) ? $duration/1000 : '0.5';
				$modal_animation = 'animated '.$animation;
				$data_animation = 'data-animation="'.$animation.'" data-duration="'.$data_duration.'"';

				$custom_size_css .='.' . $popup_id .' .modal-box {-webkit-animation-duration: '.$data_duration.'s;-moz-animation-duration: '.$data_duration.'s;-ms-animation-duration: '.$data_duration.'s;-o-animation-duration: '.$data_duration.'s;animation-duration: '.$data_duration.'s;}';
			}
		}



		// if(!empty($animation_stop)) {
		// 	$modal_animation = 'animated fadeIn';
		// 	$data_animation_out = 'data-animation-out="'.$animation_stop.'"';
		// }

		$display[] = $html_before;
		$display[] = '<div class="' . $modalWindowClass . '" data-modal="'.$popup_id.'" '.$data_scroll.' '.$data_timeout.' ' . $data_lock_scroll . ' ' . $data_overlay . ' ' .$modal_overlay.'>';
		$display[] = '<div class="'.$hide_class.'modal-box '.$modal_size.' '.$modal_position.' '.$modal_animation.' '.$hide_bg.'" '.$modal_background.' '.$data_animation.' '.$data_cookie.' '.$data_trigger.' '.$data_key.'>';
		$display[] = '<span class="close-btn icon icon-office-52"></span>';
		//$display[] = '<h2>'. $popup_title .'</h2>';
		//$display[] = '<hr>';
		$display[] = $popup_content;
		$display[] = '</div>';
		$display[] = '</div>';
		$display[] = $html_after;
		$display[] = "<style>" . $custom_size_css . "</style>\r\n"; //REFACTOR / FIX THIS

//
// 	if(!isset($_COOKIE[$popup_cookie_name]) && $time_test == 'pass' && $role_test == 'pass'){
// 		return implode('', $display);
// 	}
	return implode('', $display);
		// return 'Post id ' . $post_id;
}
