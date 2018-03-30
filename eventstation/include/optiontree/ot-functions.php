<?php
/*----- GOOGLE FONT CORE SETTINGS START -----*/
$eventstation_font_list = array();
function eventstation_google_webfont() {
	global $eventstation_font_list;
	$options = array( 
		array( 
			'option' => "theme_one_font", 
			'default' => "Roboto"
		),
		array( 
			'option' => "theme_two_font", 
			'default' => "Roboto Slab"
		),
		array( 
			'option' => "body_text", 
			'default' => ""
		),
		array( 
			'option' => "h1_font", 
			'default' => ""
		),
		array( 
			'option' => "h2_font", 
			'default' => ""
		),
		array( 
			'option' => "h3_font", 
			'default' => ""
		),
		array( 
			'option' => "h4_font", 
			'default' => ""
		),
		array( 
			'option' => "h5_font", 
			'default' => ""
		),
		array( 
			'option' => "h6_font", 
			'default' => ""
		),
		array( 
			'option' => "input_font", 
			'default' => ""
		),
		array( 
			'option' => "input_placeholder_font", 
			'default' => ""
		),
		array( 
			'option' => "button_font", 
			'default' => ""
		),
		array( 
			'option' => "header_default_menu_font", 
			'default' => ""
		),
		array( 
			'option' => "header_default_submenu_font", 
			'default' => ""
		),
		array( 
			'option' => "header_alternative_menu_font", 
			'default' => ""
		),
		array( 
			'option' => "header_alternative_submenu_font", 
			'default' => ""
		),
		array( 
			'option' => "blog_posts_title_font", 
			'default' => ""
		),
		array( 
			'option' => "blog_posts_title_hover_font", 
			'default' => ""
		),
		array( 
			'option' => "blog_posts_content_font", 
			'default' => ""
		),
		array( 
			'option' => "blog_page_title_excerpt_font", 
			'default' => ""
		),
		array( 
			'option' => "single_posts_title_font", 
			'default' => ""
		),
		array( 
			'option' => "single_posts_content_font", 
			'default' => ""
		),
		array( 
			'option' => "single_page_title_excerpt_font", 
			'default' => ""
		),
		array( 
			'option' => "single_posts_bottom_element_title_font", 
			'default' => ""
		),
		array( 
			'option' => "page_title_font", 
			'default' => ""
		),
		array( 
			'option' => "page_title_excerpt_font", 
			'default' => ""
		),
		array( 
			'option' => "page_content_font", 
			'default' => ""
		),
		array( 
			'option' => "404_page_title", 
			'default' => ""
		),
		array( 
			'option' => "404_page_text", 
			'default' => ""
		),
		array( 
			'option' => "404_page_icon", 
			'default' => ""
		),
	);
	
	$import = '';	
	
	$language = 'latin,latin-ext';
	$font_language = ot_get_option('fonts_languages');

	if ( 'cyrillic' == $font_language )
		$language .= ',cyrillic,cyrillic-ext';
	elseif ( 'greek' == $font_language )
		$language .= ',greek,greek-ext';
	elseif ( 'vietnamese' == $font_language )
		$language .= ',vietnamese';
			
	$url_check = is_ssl() ? 'https' : 'http';

	foreach($options as $option) {
		$array = ot_get_option($option['option']);
		
		if (!empty($array['font-family'])) { 
			if (!in_array($array['font-family'], $eventstation_font_list)) {
				array_push($eventstation_font_list, $array['font-family']);
			}
		} else if ($option['default']) {
			if (!in_array($option['default'], $eventstation_font_list)) {
				array_push($eventstation_font_list, $option['default']);
			}
		}
	}
	
	$fonts_list_unique = array_unique($eventstation_font_list);
		
	foreach($fonts_list_unique as $fonts) {
		$cssfont = str_replace(' ', '+', $fonts);
		$query_args = array(
			'family' => $cssfont.':200,300,400,500,600,700',
			'subset' => $language,
		);
		$font_url = add_query_arg( $query_args, "$url_check://fonts.googleapis.com/css" );
		$import .= "<link href='".$font_url."' rel='stylesheet' type='text/css'>\n";
	}
	return $import;
}

/**Option Tree Array Font Select Value Control**/
function eventstation_type_echo($array_value, $important = false, $default = false) {
	global $eventstation_font_list;
	
	if(!empty($array_value)) {
		//Font Family Array
		if (!empty($array_value['font-family'])) { 
			echo "font-family: '" . $array_value['font-family'] . "';\n";
		}
		else if ($default) {
			echo "font-family: '" . $default . "';\n";
		}
		//Font Color Array
		if (!empty($array_value['font-color'])) { 
			echo "color: " . $array_value['font-color'] . ";\n";
		}
		//Font Style Array
		if (!empty($array_value['font-style'])) { 
			echo "font-style: " . $array_value['font-style'] . ";\n";
		}
		//Font Variant Array
		if (!empty($array_value['font-variant'])) { 
			echo "font-variant: " . $array_value['font-variant'] . ";\n";
		}
		//Font Weight Array
		if (!empty($array_value['font-weight'])) { 
			echo "font-weight: " . $array_value['font-weight'] . ";\n";
		}
		//Font Size Array
		if (!empty($array_value['font-size'])) { 
			
			if ($important) {
				echo "font-size: " . $array_value['font-size'] . "!important;\n";
			} else {
				echo "font-size: " . $array_value['font-size'] . "!important;\n";
			}
		}
		//Font Decoration Array
		if (!empty($array_value['text-decoration'])) { 
				echo "text-decoration: " . $array_value['text-decoration'] . " !important;\n";
		}
		//Font Transform Array
		if (!empty($array_value['text-transform'])) { 
				echo "text-transform: " . $array_value['text-transform'] . " !important;\n";
		}
		//Font Height Array
		if (!empty($array_value['line-height'])) { 
				echo "line-height: " . $array_value['line-height'] . " !important;\n";
		}
		//Font Spacing Array
		if (!empty($array_value['letter-spacing'])) { 
				echo "letter-spacing: " . $array_value['letter-spacing'] . " !important;\n";
		}
	}
	if(empty($array_value) && !empty($default)) {
		echo "font-family: '" . $default . "';\n";
	}
}
/*----- GOOGLE FONT CORE SETTINGS END -----*/

/*----- BACKGROUND TYPE START -----*/
function eventstation_bg_type( $background_settings, $background_class, $identifier){ 
	$background_settings = ot_get_option( $background_settings, array() );  
		if($background_settings['background-color'] | $background_settings['background-repeat'] | $background_settings['background-attachment'] | $background_settings['background-position'] | $background_settings['background-image'] ){
			echo $identifier.$background_class;

			if( !empty( $background_settings['background-color'] ) ) {
				echo "background-color: " . $background_settings['background-color'] . ";";
			}

			if( !empty( $background_settings['background-repeat'] ) ) {
				echo "background-repeat: " . $background_settings['background-repeat'] . ";";
			}

			if( !empty( $background_settings['background-attachment'] ) ) {
				echo "background-attachment: " . $background_settings['background-attachment'] . ";";
			}

			if( !empty( $background_settings['background-position'] ) ) {
				echo "background-position: " . $background_settings['background-position'] . ";";
			}

			if( !empty( $background_settings['background-image'] ) ) {
				echo "background-image: url(" . $background_settings['background-image'] . ");";
			}

			if( !empty( $background_settings['background-size'] ) ) {
				echo "background-size: " . $background_settings['background-size'] . ";";
			}
	} 
} 
/*----- BACKGROUND TYPE END -----*/

/*----- OPTIONTREE THEME NAME START -----*/
function eventstation_options_name() {
	$web_site = esc_url( 'http://gloriatheme.com' );
	$web_site_title = esc_attr( "Gloria Theme" );
	$html = '<a href="' . esc_url( $web_site ) . '" target="_blank">' . esc_attr( $web_site_title ) . '</a>';
	return $html;
}
add_filter( 'ot_header_version_text', 'eventstation_options_name', 10, 2 );
/*----- OPTIONTREE THEME NAME END -----*/

/*----- OPTIONTREE UPLOAD NAME START -----*/
function eventstation_upload_name() {
	return esc_html__('Send to Theme Options', 'eventstation');
}
add_filter( 'ot_upload_text', 'eventstation_upload_name', 10, 2 );
/*----- OPTIONTREE UPLOAD NAME END -----*/

/*----- OPTIONTREE HEADER NAME START -----*/
function eventstation_option_tree_logo() {
	$web_site = esc_url( 'http://gloriatheme.com/' );
	$web_site_title = esc_attr( "Gloria Theme Web Site" );
	$html = '<li id="option-tree-logo"><span><a href="' . esc_url( $web_site ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/admin/assets/images/admin/panel-header-logo.png" alt="' . esc_attr( $web_site_title ) . '" /></a></span>';
	$theme_version = wp_get_theme();
	$html .= '<span class="theme-version"><span>' . $theme_version->get( 'Name' ) . '</span>' . $theme_version->get( 'Version' ) . '</span></li>';
	echo $html;
}
add_filter( 'ot_header_logo_link', 'eventstation_option_tree_logo' );
/*----- OPTIONTREE HEADER NAME END -----*/

/*----- OPTIONTREE HEADER LINKS START -----*/
function eventstation_header_list() {
	$support_site = esc_url( 'https://gloriatheme.ticksy.com/' );
	$support_site_title = esc_attr( "Ticket System" );
	$html = '<li id="option-tree-version"><span><a href="' . esc_url( $support_site ) . '" target="_blank">' . esc_attr( $support_site_title ) . '</a></span></li>';
	echo $html;
}
add_filter( 'ot_header_list', 'eventstation_header_list' );
/*----- OPTIONTREE HEADER LINKS END -----*/

/*----- SUPPORT TAB CONTENT START -----*/
function eventstation_support_tab_content() {
	$support_site = esc_url( 'https://gloriatheme.ticksy.com/' );
	$video_site = esc_url( 'https://www.youtube.com/channel/UCQ33nDAYSrv_IdPH71q33iQ' );
	$portfolio_url = esc_url( 'https://themeforest.net/user/gloriatheme/portfolio?ref=GloriaTheme' );
	$themeforest_download = esc_url( 'https://themeforest.net/downloads' );
	$web_site = esc_url( 'http://gloriatheme.com/' );
	$web_site_title = esc_attr( "Gloria Theme Web Site" );
	
	$html = '<div class="support-content">';
		$html .= '<div class="support-top-content">';
			$html .= '<a href="' . esc_url( $web_site ) . '" target="_blank"><img src="' . get_template_directory_uri() . '/admin/assets/images/admin/gloria-panel.png" alt="' . esc_attr( $web_site_title ) . '" /></a>';
			$html .= '<p>' . esc_html__( "Thank you so much for purchasing one of 'Gloria Theme' themes and template. You can create a support ticket to Gloria Theme themes. Our support team will respond your ticket support within 24-48 hours. We dont work weekends. Our technical support team will respond within working hours to ticket.", "eventstation" ) . '</p>';
		$html .= '</div>';
		$html .= '<div class="support-row">';
			/***-- COLUMN START --***/
			$html .= '<div class="support-col">';
				$html .= '<div class="support-col-content">';
					$html .= '<h4><span class="dashicons dashicons-tickets-alt"></span>'  . esc_html__( 'Ticket System', 'eventstation' ) . '</h4>';
					$html .= '<p>' . esc_html__( "We know what it's like to need support. This is the reason why our customers are the top priority and we treat every issue with utmost seriousness. The team is working hard to help every customer, to keep the theme's documentation up to date, to produce video tutorials and to develop new ways to make everything easier.", "eventstation" ) . '</p>';
					$html .= '<a href="' . esc_url( $support_site ) . '" target="_blank" class="button button-primary save">' . esc_html__( 'Open Ticket', 'eventstation' ) . '</a>';
				$html .= '</div>';
			$html .= '</div>';
			/***-- COLUMN END --***/
			/***-- COLUMN START --***/
			$html .= '<div class="support-col">';
				$html .= '<div class="support-col-content">';
					$html .= '<h4><span class="dashicons dashicons-media-document"></span>' . esc_html__( 'Documentation', 'eventstation' ) . '</h4>';
					$html .= '<p>' . esc_html__( "Open the file you've downloaded from themeforest. You can open the index.html located in the documentation folder with your browser. All the details about the usage of the theme are included in this file.", "eventstation" ) . '</p>';
					$html .= '<a href="' . esc_url( $themeforest_download ) . '" target="_blank" class="button button-primary save">' . esc_html__( 'Theme Files Download', 'eventstation' ) . '</a>';
				$html .= '</div>';
			$html .= '</div>';
			/***-- COLUMN END --***/
			/***-- COLUMN START --***/
			$html .= '<div class="support-col">';
				$html .= '<div class="support-col-content">';
					$html .= '<h4><span class="dashicons dashicons-format-video"></span>' . esc_html__( 'Video Guide', 'eventstation' ) . '</h4>';
					$html .= '<p>' . esc_html__( 'We believe that the easiest way to learn is watching a video tutorial. We have a growing library of narrated video tutorials to help you do just that.', 'eventstation' ) . '</p>';
					$html .= '<a href="' . esc_url( $video_site ) . '" target="_blank" class="button button-primary save">' . esc_html__( 'View Videos', 'eventstation' ) . '</a>';
				$html .= '</div>';
			$html .= '</div>';
			/***-- COLUMN END --***/
			/***-- COLUMN START --***/
			$html .= '<div class="support-col">';
				$html .= '<div class="support-col-content">';
					$html .= '<h4><span class="dashicons dashicons-admin-appearance"></span>' . esc_html__( 'Our Other Themes', 'eventstation' ) . '</h4>';
					$html .= '<p>' . esc_html__( 'Your roads which you are already familiar with are not enough for you to act. What you need is probably newer and more different brain cell... The way how to adapt to new digital world has already started going further and further and is catching up with the people who are advancing along that road.', 'eventstation' ) . '</p>';
					$html .= '<a href="' . esc_url( $portfolio_url ) . '" target="_blank" class="button button-primary save">' . esc_html__( 'All Themes', 'eventstation' ) . '</a>';
				$html .= '</div>';
			$html .= '</div>';
			/***-- COLUMN END --***/
		$html .= '</div>';
	$html .= '</div>';
	
	return $html;
}
/*----- SUPPORT TAB CONTENT END -----*/

/*----- FONT FAMILY DROPDOWN START -----*/
function eventstation_fontfamily_dropwon( $array, $field_id ) {
	if ( $field_id == "theme_one_font" ) {
		$array = array( 'font-family');
	}
	
	if ( $field_id == "theme_two_font" ) {
		$array = array( 'font-family');
	}
	
	return $array;
}
add_filter( 'ot_recognized_typography_fields', 'eventstation_fontfamily_dropwon', 10, 2 );
/*----- FONT FAMILY DROPDOWN END -----*/

/*----- CREATE SIDEBAR START -----*/
function eventstation_sidebar_setup() {
		$sidebars = ot_get_option('custom_sidebars');
		if(!empty($sidebars)) {
			foreach($sidebars as $sidebar) {
				register_sidebar( array(
					'id' => 'sidebar-'.$sidebar['id'],
					'name' => $sidebar['title'],
					'before_widget' => '<aside id="%1$s" class="widget-box animate anim-fadeIn %2$s">',
					'after_widget' => '</aside>',
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4></div>',
				));
			}
		}
	}
add_action( 'after_setup_theme', 'eventstation_sidebar_setup' );

if ( ! function_exists( 'ot_type_sidebar_select_category' ) ) {
	function ot_type_sidebar_select_category( $args = array() ) {
		extract( $args );
		$has_desc = $field_desc ? true : false;
		$args = array(
			'type' => 'post',
			'child_of' => 0,
			'parent' => '',
			'orderby' => 'name',
			'order' => 'ASC',
			'hide_empty' => 0,
			'hierarchical' => 0,
			'taxonomy' => 'category',
			'pad_counts' => false
		);
		$categories = get_terms( 'category', array( 'hide_empty' => false ) );
		foreach ($categories as $category) {
			$field_id = 'sidebar_select_'.$category->term_id;
			$field_name = 'option_tree[sidebar_select_'.$category->term_id.']';
			$field_value = ot_get_option($field_id);
			echo '<div class="format-setting type-sidebar-select has-desc">';
				echo '<div class="description">' . esc_html__( "You can the select sidebar for", 'eventstation' ) . ' "' . esc_attr( $category->name ) . '."</div>';
				echo '<div class="format-setting-inner">';
					echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . esc_attr( $field_class ) . '">';

					$sidebars = $GLOBALS['wp_registered_sidebars'];

					if ( ! empty( $sidebars ) ) {
					echo '<option value="">-- ' . esc_html__( 'Choose One', 'eventstation' ) . ' --</option>';
					foreach ( $sidebars as $sidebar ) {
						echo '<option value="' . esc_attr( $sidebar['id'] ) . '"' . selected( $field_value, $sidebar['id'], false ) . '>' . esc_attr( $sidebar['name'] ) . '</option>';
					}
					} else {
						echo '<option value="">' . esc_html__( 'No Sidebars Found', 'eventstation' ) . '</option>';
					}
					echo '</select>';
				echo '</div>';
			echo '</div>';
		}
	}
}
/*----- CREATE SIDEBAR END -----*/

/*----- OPTION TREE MENU ORDER START -----*/
add_filter( 'ot_theme_options_parent_slug', '__return_false' );
/*----- OPTION TREE MENU ORDER END -----*/