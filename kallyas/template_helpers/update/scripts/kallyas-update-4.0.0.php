<?php
/**
 * Update Kallyas to 4.0.0
 *
 * @author 		ThemeFuzz
 * @category 	Admin
 * @version     4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function convert($size)
{
	$unit=array('b','kb','mb','gb','tb','pb');
	return @round($size/pow(1024,($i=(int)floor(log($size,1024)))),2).' '.$unit[$i];
}
$mem = memory_get_usage();

function zn_cnv_perform_updatev4( $step, $data ){

	$current_step = !empty( $data['v4_step'] ) ? $data['v4_step'] : false;

	// Convert theme options
	if( empty( $current_step ) ){
		// THIS IS THE FIRST STEP
		zn_cnv_v4_convert_theme_options();
		$data['v4_step'] = 'remove_comments_options';
		$response = array(
			'status' => 'ok',
			'step'	=> 'process_update',
			'data'	=> $data,
			'response_text' => 'Updated theme options'
		);

		ZN()->installer->zn_send_json( $response );
	}
	elseif( $current_step == 'remove_comments_options' ){

		zn_cnv_remove_comments_options();
		$data['v4_step'] = 'convert_pb_data';
		$response = array(
			'status' => 'ok',
			'step'	=> 'process_update',
			'data'	=> $data,
			'response_text' => 'Tweaked theme options'
		);

		ZN()->installer->zn_send_json( $response );
	}
	elseif( $current_step == 'convert_pb_data' ){

		$data['start'] = isset( $data['start'] ) ? (int)$data['start'] + 10 : 0;
		$data['limit'] = isset( $data['limit'] ) ? (int)$data['limit'] + 10 : 10;
		$data['current_post'] = isset( $data['current_post'] ) ? (int)$data['current_post'] : 0;

		$posts_data = zn_cnv_v4_get_posts_to_convert( $data['start'], $data['limit'] );

		if(
			is_array( $posts_data['posts'] ) &&
			!empty( $posts_data['count'] ) &&
			$posts_data['count'] > 0 &&
			$data['current_post'] < $posts_data['count']
		){
			// We have posts to convert
			$data['count'] = $posts_data['count'];

			// Start posts converting
			zn_cnv_v4_convert_pb_data( $data, $posts_data );
		}
		else{
			// All finished with posts ... move on
			$data['v4_step'] = 'convert_widgets';
			$response = array(
				'status' => 'ok',
				'step'	=> 'process_update',
				'data'	=> $data,
				'response_text' => 'Finished converting pagebuilder to new version'
			);

			ZN()->installer->zn_send_json( $response );
		}

	}
	elseif( $current_step == 'convert_widgets' ){
		// TODO : call the widgets convert functions
		zn_cnv_v4_convert_widgets();
		$response = array(
			'status' => 'ok',
			'step'	=> 'version_done',
			'data'	=> $data,
			'response_text' => 'Converted widgets'
		);

		ZN()->installer->zn_send_json( $response );
	}
}





function zn_cnv_v4_convert_theme_options(){
	// Change theme options
	$theme_options = get_option( 'zn_kallyas_options' );
	// The new options field will be 'zn_kallyas_optionsv4';

	$admin_options = ZN()->theme_options->get_theme_options();

	$new_options = array();
	foreach ($admin_options as $key => $value) {

		if( isset( $theme_options[$value['id']] ) ){
			$new_options[$value['parent']][$value['id']] = $theme_options[$value['id']];
		}
		elseif( isset( $value['std'] ) ){
			$new_options[$value['parent']][$value['id']] = $value['std'];
		}

	}

	// CONVERT FONT OPTIONS
	/** Google fonts **/
	if( !empty( $theme_options['g_fonts_subset'] ) ){

		// Convert font subsets to array
		$subsets = str_replace(' ', '', strtolower( $theme_options['g_fonts_subset'] ) );
		$subsets = explode(',', $subsets);

		$new_options['google_font_options']['zn_google_fonts_subsets'] = $subsets;
		unset( $subsets );
	}

	/** Convert loaded google fonts **/
	$loaded_fonts = array();

	// Some fonts are saved in the fonts key
	if( !empty( $theme_options['fonts'] ) ){
		if( is_array( $theme_options['fonts'] ) ){

			$normal_faces = array (
				'arial',
				'verdana',
				'trebuchet',
				'georgia',
				'times',
				'tahoma',
				'palatino',
				'helvetica'
			);

			foreach ( $theme_options['fonts'] as $key => $value) {
				if ( ! in_array( $value, $normal_faces ) ) {
					$loaded_fonts[$value]['font_family'] = $value;
					$loaded_fonts[$value]['font_variants'] = array();
				}
			}
		}
	}

	// Some fonts are saved in all_g_fonts key
	if( !empty( $theme_options['all_g_fonts'] ) ){

		if( is_array($theme_options['all_g_fonts']) ){
			foreach ($theme_options['all_g_fonts'] as $key => $value) {
				$loaded_fonts[$key]['font_family'] = $key;
				if( !empty( $value['variant'] ) ){
					$loaded_fonts[$key]['font_variants'] = $value['variant'];
				}
			}
		}
	}

	if( !empty( $loaded_fonts ) ){
		$new_options['google_font_options']['zn_google_fonts_setup'] = $loaded_fonts;
		unset( $loaded_fonts );
	}

	/** Convert all "typography" options to use the font option **/
	$typography_options = array(
		'logo_font' =>'general_options',
		'logo_hover' => 'general_options',
		'h1_typo' => 'font_options',
		'h2_typo' => 'font_options',
		'h3_typo' => 'font_options',
		'h4_typo' => 'font_options',
		'h5_typo' => 'font_options',
		'h6_typo' => 'font_options',
		'body_font' => 'font_options',
		'ga_font' => 'font_options',
		'footer_font' => 'font_options',
		'menu_font' => 'font_options',
	);

	foreach ($typography_options as $key => $value) {

		if( isset( $new_options[$value][$key] ) ){
			if ( isset( $theme_options[$key] ) ){
				$font_saved_data = $theme_options[$key];

				// Perform the line-height convert
				if( isset( $font_saved_data['height'] ) ){
					$font_saved_data['line-height'] = $font_saved_data['height'];
					unset($font_saved_data['height']);
				}

				// Perform the font-size convert
				if( isset( $font_saved_data['size'] ) ){
					$font_saved_data['font-size'] = $font_saved_data['size'];
					unset($font_saved_data['size']);
				}

				// Convert font family
				if( isset( $font_saved_data['face'] ) ){
					$font_saved_data['font-family'] = $font_saved_data['face'];
					unset($font_saved_data['face']);
				}
				// Special case when the font family is moved to fonts
				if( isset( $theme_options['fonts'][$key] ) ){
					$font_saved_data['font-family'] = $theme_options['fonts'][$key];
				}

				// Break the font style in font style and font weight
				if( isset( $font_saved_data['style'] ) ){
					// Normal and italic font
					if( $font_saved_data['style'] == 'normal' || $font_saved_data['style'] == 'italic' ){
						$font_saved_data['font-style'] = $font_saved_data['style'];
						$font_saved_data['font-weight'] = '400';
					}
					elseif( $font_saved_data['style'] == 'bold' ){
						$font_saved_data['font-style'] = 'normal';
						$font_saved_data['font-weight'] = '700';
					}
					elseif( $font_saved_data['style'] == 'bold italic' ){
						$font_saved_data['font-style'] = 'italic';
						$font_saved_data['font-weight'] = '700';
					}

					unset($font_saved_data['style']);
				}

				// Save the converted values
				$new_options[$value][$key] = $font_saved_data;

			}
		}
	}

	// These are all the options that contained an icon font
	$social_icon_options = array(
		'header_social_icon',
		'footer_social_icon',
		'cs_social_icon',
	);

	// Update header colors
	if( ! empty( $theme_options['header_social_icons'] ) ){
		foreach ( $theme_options['header_social_icons'] as $key => $value ) {
			if( ! empty( $value['header_social_icon'] ) ){
				$new_options['general_options']['header_social_icons'][$key]['header_social_color'] = zn_get_social_icon_color( $value['header_social_icon'] );
			}
			elseif( empty( $value['header_social_icon'] ) ){
				unset( $new_options['general_options']['header_social_icons'][$key] );
			}
		}
	}

	// Update footer colors
	if( ! empty( $theme_options['footer_social_icons'] ) ){
		foreach ( $theme_options['footer_social_icons'] as $key => $value ) {
			if( ! empty( $value['footer_social_icon'] ) ){

				$new_options['general_options']['footer_social_icons'][$key]['footer_social_color'] = zn_get_social_icon_color( $value['footer_social_icon'] );
			}
			elseif( empty( $value['footer_social_icon'] ) ){
				unset( $new_options['general_options']['footer_social_icons'][$key] );
			}
		}
	}

	// Update coming soon colors
	if( ! empty( $theme_options['cs_social_icons'] ) ){
		foreach ( $theme_options['cs_social_icons'] as $key => $value ) {
			if( ! empty( $value['cs_social_icon'] ) ){

				$new_options['coming_soon_options']['cs_social_icons'][$key]['cs_social_color'] = zn_get_social_icon_color( $value['cs_social_icon'] );
			}
			elseif( empty( $value['cs_social_icon'] ) ){
				unset( $new_options['general_options']['cs_social_icons'][$key] );
			}
		}
	}

	// Convert old PNG icons to the new font icons
	array_walk_recursive($new_options, 'update_social_icons_std', $social_icon_options);

	// Update unlimited sidebars to use the new location
	if( !empty( $theme_options['sidebar_generator'] ) ){
		$new_options['unlimited_sidebars']['unlimited_sidebars'] = $theme_options['sidebar_generator'];
	}

	// Convert sidebars config to use the new system
	// Post
	$post_sidebar_setup = array();
	if( !empty( $theme_options['default_sidebar_position'] ) ){
		$post_sidebar_setup['layout'] = $theme_options['default_sidebar_position'];
	}
	if( !empty( $theme_options['single_sidebar'] ) ){
		$post_sidebar_setup['sidebar'] = zn_sanitize_widget_id( $theme_options['single_sidebar'] );
	}
	$new_options['unlimited_sidebars']['single_sidebar'] = $post_sidebar_setup;

	// Page
	$page_sidebar_setup = array();
	if( !empty( $theme_options['page_sidebar_position'] ) ){
		$page_sidebar_setup['layout'] = $theme_options['page_sidebar_position'];
	}
	if( !empty( $theme_options['page_sidebar'] ) ){
		$page_sidebar_setup['sidebar'] = zn_sanitize_widget_id( $theme_options['page_sidebar'] );
	}
	$new_options['unlimited_sidebars']['page_sidebar'] = $page_sidebar_setup;

	// Archive
	$archive_sidebar_setup = array();
	if( !empty( $theme_options['archive_sidebar_position'] ) ){
		$archive_sidebar_setup['layout'] = $theme_options['archive_sidebar_position'];
	}
	if( !empty( $theme_options['archive_sidebar'] ) ){
		$archive_sidebar_setup['sidebar'] = zn_sanitize_widget_id( $theme_options['archive_sidebar'] );
	}
	$new_options['unlimited_sidebars']['archive_sidebar'] = $archive_sidebar_setup;

	// Blog default - It was not present in previous versions so we have to set it as archive sidebar
	$new_options['unlimited_sidebars']['blog_sidebar'] = $archive_sidebar_setup;

	// WooCommerce archive sidebars
	$woo_sidebar_setup = array();
	if( !empty( $theme_options['woo_arch_sidebar_position'] ) ){
		$woo_sidebar_setup['layout'] = $theme_options['woo_arch_sidebar_position'];
	}
	if( !empty( $theme_options['woo_arch_sidebar'] ) ){
		$woo_sidebar_setup['sidebar'] = zn_sanitize_widget_id( $theme_options['woo_arch_sidebar'] );
	}
	$new_options['unlimited_sidebars']['woo_archive_sidebar'] = $woo_sidebar_setup;

	// WooCommerce single sidebars
	$woo_single_sidebar_setup = array();
	if( !empty( $theme_options['woo_single_sidebar_position'] ) ){
		$woo_single_sidebar_setup['layout'] = $theme_options['woo_single_sidebar_position'];
	}
	if( !empty( $theme_options['woo_single_sidebar'] ) ){
		$woo_single_sidebar_setup['sidebar'] = zn_sanitize_widget_id( $theme_options['woo_single_sidebar'] );
	}
	$new_options['unlimited_sidebars']['woo_single_sidebar'] = $woo_single_sidebar_setup;


	// CONVERT CUSTOM CSS TO NEW OPTION TYPE
	if( isset( $theme_options['zn_custom_css'] ) ){
		update_option( 'zn_'.ZN()->theme_data['theme_id'].'_custom_css', $theme_options['zn_custom_css'], false );
	}


	// EXTRA TWEAKS
	// Set blog content to excerpt
	$new_options['blog_options']['sb_archive_content_type'] = 'excerpt';




	// Save the new options
	// TODO : Replace this field with the theme data field from config
	update_option( 'zn_kallyas_optionsv4', $new_options );
	generate_options_css($new_options);
	$theme_options = $new_options = null;
}

function zn_cnv_remove_comments_options(){

	$old_theme_options = get_option( 'zn_kallyas_options' );
	// If page comments were enabled gloablly
	if( !empty( $old_theme_options['zn_enable_page_comments'] ) && $old_theme_options['zn_enable_page_comments'] == 'no' ){
		// If comments location was set after pagebuilder
		global $wpdb;

		$wpdb->query(
			"
			    UPDATE $wpdb->posts
			    SET comment_status='closed'
			    WHERE post_type='post'
			    	OR post_type='page'
		    "
		);
	}

}

// Convert old social icons to the new system
function zn_get_social_icon_name( $social_icon ){

	// Here we map the old PNG icons to the new icon font family and font unicode
	$icons = array (
		"social-twitter" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue82f' ),
		"social-dribbble" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue820' ),
		"social-facebook" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue83f' ),
		"social-envato" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue86d' ),
		"social-flickr" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue822' ),
		"social-forrst" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue817' ),
		"social-gplus" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue808' ),
		"social-gplus2" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue808' ), /// Nu se gaseste in noul font
		"social-icloud" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue83c' ),
		"social-lastfm" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue846' ),
		"social-linkedin" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue828' ), // Nu seamana cu cea veche
		"social-myspace" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue838' ),
		"social-paypal" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue803' ),
		"social-piacasa" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue867' ), // Nu se gasea in kl-social-icons.css
		"social-pinterest" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue80e' ), // Nu seamana cu cea veche
		"social-reedit" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue81a' ), // Nu se gasea in kl-social-icons.css
		"social-rss" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue82d' ),
		"social-skype" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue82e' ),
		"social-stumbleupon" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue80c' ),
		"social-tumblr" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue84c' ),
		"social-vimeo" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue831' ),
		"social-wordpress" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue84e' ),
		"social-yahoo" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue834' ),
		"social-youtube" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue830' ),
		"social-blogger" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue81e' ),
		"social-deviantart" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue868' ),
		"social-digg" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue818' ),
		"social-foursquare" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue811' ),
		"social-friendfeed" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue869' ),
		"social-mail" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue836' ),
		"social-html5" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue812' ),
		"social-technorati" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue870' ),
		"social-soundcloud" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue84b' ),
		"social-quora" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue84a' ),
		"social-bebo" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue86c' ),
		"social-aim" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue801' ),
		"social-gosquared" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue86e' ),
		"social-dropbox" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue83d' ),
		"social-github" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue840' ),
		"social-spotify" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue819' ),
		"social-apple" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue81d' ),
		"social-instagram" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue859' ),
		"social-slideshare" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue86a' ),
		"social-yelp" => array( 'family' => 'kl-social-icons', 'unicode' => 'ue84f' ),
	);
	return (isset($icons[$social_icon]) ? $icons[$social_icon] : null);
}

// Convert old social icons to the new system
function zn_get_social_icon_color( $social_icon ){

	// Here we map the old PNG icons to the new icon font family and font unicode
	$icons = array (
		"social-twitter" => '#00bdec',
		"social-dribbble" => '#ef5b92',
		"social-facebook" => '#3b5998',
		"social-envato" => '', // NONE
		"social-flickr" => '#ea2698',
		"social-forrst" => '#366725',
		"social-gplus" => '#d94a39',
		"social-gplus2" => '#d94a39',
		"social-icloud" => '#666666',
		"social-lastfm" => '#d2013a',
		"social-linkedin" => '#1b92bd',
		"social-myspace" => '#003398',
		"social-paypal" => '#32689a',
		"social-piacasa" => '#8e5aa4',
		"social-pinterest" => '#cb2027',
		"social-reedit" => '#82a6ce',
		"social-rss" => '#ff7f00',
		"social-skype" => '#18b7f1',
		"social-stumbleupon" => '#229d3d',
		"social-tumblr" => '#38526d',
		"social-vimeo" => '#01557a',
		"social-wordpress" => '#454545',
		"social-yahoo" => '#ab64bc',
		"social-youtube" => '#d20800',
		"social-blogger" => '#FF7600',
		"social-deviantart" => '#768C82',
		"social-digg" => '#195695',
		"social-foursquare" => '#1B6CB4',
		"social-friendfeed" => '#2F72C4',
		"social-mail" => '#b5b5b5',
		"social-html5" => '#E44D26',
		"social-technorati" => '#55BB00',
		"social-soundcloud" => '#db5708',
		"social-quora" => '#852828',
		"social-bebo" => '#a03939',
		"social-aim" => '#cdae2d',
		"social-gosquared" => '#556065',
		"social-dropbox" => '#2d76be',
		"social-github" => '#667F8E',
		"social-spotify" => '#62aa29',
		"social-apple" => '#859dab',
		"social-instagram" => '#517FA4',
		"social-slideshare" => '#ED9D2C',
		"social-yelp" => '#C41200',
	);
	return (isset($icons[$social_icon]) ? $icons[$social_icon] : '#000');
}

/**
 * Update social icons
 * @param $item
 * @param $key
 * @param $social_icon_options
 */
function update_social_icons_std(&$item, $key, $social_icon_options)
{
	if( in_array($key, $social_icon_options) ) {
		$_item = zn_get_social_icon_name( $item );
		if(! is_null($_item)){
			$item = $_item;
		}
	}
}

/**
 *
 * @param $element_name
 * @return string
 */
function zn_convert_old_pb_name( $element_name ){
	$old_elements = array(
		'_accordion' => 'TH_Accordion',
		'_action_box' => 'TH_ActionBox',
		'_action_box_text' => 'TH_ActionBox',
		'_c_form' => 'ZnContactForm',
		'_call_banner' => 'TH_CallOutBanner',
		'_circ1' => 'TH_CircularContentStyle1',
		'_circ2' => 'TH_CircularContentStyle2',
		'_circle_title_box' => 'TH_CircleTitleTextBox',
		'_content_sidebar' => 'null',
		'_css_pannel' => 'TH_CSS3Panels',
		'_cute_slider' => 'TH_3DCuteSlider',
		'_fancyslider' => 'TH_FancySlider',
		'_features_element' => 'TH_FeaturesBoxes',
		'_features_element2' => 'TH_FeaturesBoxes2',
		'_flexslider' => 'TH_FlexSlider',
		'_flickrfeed' => 'TH_FlickrFeed',
		'_header_module' => 'TH_CustomSubHeaderLayout',
		'_historic' => 'TH_HistoricElement',
		'_hover_box' => 'TH_HoverBox',
		'_icarousel' => 'TH_ICarousel',
		'_image_box' => 'TH_ImageBox',
		'_image_box2' => 'TH_ImageBox2',
		'_image_gallery' => 'TH_ImageGallery',
		'_infobox' => 'TH_InfoBox',
		'_infobox2' => 'TH_InfoBox2',
		'_iosSlider' => 'TH_IosSlider',
		'_keyword' => 'TH_KeywordsElement',
		'_latest_posts' => 'TH_LatestPosts',
		'_latest_posts2' => 'TH_LatestPosts2',
		'_latest_posts3' => 'TH_LatestPosts3',
		'_latest_posts4' => 'TH_LatestPosts4',
		'_lslider' => 'TH_LaptopSlider',
		'_nivoslider' => 'TH_NivoSlider',
		'_partners_logos' => 'TH_PartnersLogos',
		'_pb_spacer_element' => 'TH_SpacerElement',
		'_photo_gallery' => 'TH_PhotoGallery',
		'_portfolio_carousel' => 'TH_PortfolioCarouselLayout',
		'_portfolio_category' => 'TH_PortfolioCategory',
		'_portfolio_sortable' => 'TH_PortfolioSortable',
		'_pslider' => 'TH_PortfolioSlider',
		'_recent_work' => 'TH_RecentWork',
		'_recent_work2' => 'TH_RecentWork2',
		'_rev_slider' => 'TH_RevolutionSlider',
		'_screenshoot_box' => 'TH_ScreenshotsBox',
		'_service_box' => 'TH_ServiceBox',
		'_service_box2' => 'TH_ServicesElement',
		'_shop_features' => 'TH_ShopFeatures',
		'_static1' => 'TH_StaticContentDefault',
		'_static2' => 'TH_StaticContentBoxes',
		'_static3' => 'TH_StaticContentVideo',
		'_static4' => 'ZN_MAPS_SINGLE',
		'_static4_multiple' => 'ZnGoogleMap',
		'_static5' => 'TH_StaticContentTextPop',
		'_static6' => 'TH_StaticContentProductLoupe',
		'_static7' => 'TH_StaticContentEventCountdown',
		'_static8' => 'TH_StaticContentVideoBackground',
		'_static9' => 'TH_StaticContentSimpleText',
		'_static10' => 'TH_StaticContentTextAndRegister',
		'_static11' => 'TH_StaticContentTextAndVideo',
		'_static12' => 'TH_StaticContentSimpleTextFullWidth',
		'_stats_box' => 'TH_StatsBox',
		'_step_box' => 'TH_StepsBox',
		'_step_box2' => 'TH_StepsBox2',
		'_step_box3' => 'TH_StepsBox3',
		'_tabs' => 'TH_HorizontalTabs',
		'_team_box' => 'TH_TeamBox',
		'_testimonial_box' => 'TH_TestimonialBox',
		'_testimonial_slider' => 'TH_TestimonialFader',
		'_testimonial_slider2' => 'TH_TestimonialSlider',
		'_text_box' => 'TH_TextBox',
		'_vertical_tabs' => 'TH_VerticalTabs',
		'_video_box' => 'TH_VideoBox',
		'_woo_limited' => 'TH_ShopLimitedOffers',
		'_woo_products' => 'TH_ShopProductsPresentation',
		'_wowslider' => 'TH_WowSlider',
		'_wpk_latest_posts_carousel' => 'TH_LatestPostsCarousel',
		'_zn_doc_header' => 'TH_DocumentationHeader',
		'_zn_documentation' => 'TH_DocumentationHeader',
		'_zn_sidebar' => 'TH_Sidebar',
	);
	return ( (isset($old_elements[$element_name]) &&!empty($old_elements[$element_name])) ? $old_elements[$element_name] : '');
}

function zn_cnv_v4_get_posts_to_convert( $start, $limit ){
	global $wpdb;

	$return = array();

	// Get all metafields containing OLD PB data and also add the post content and post_type
	$query = "
		SELECT meta.*, post.post_content, post.post_type
		FROM {$wpdb->postmeta} meta
		INNER JOIN {$wpdb->posts} post
			ON meta.post_id = post.ID
		WHERE meta_key = 'zn_meta_elements'
			AND meta.meta_value != ''
		GROUP BY meta.post_id
		LIMIT {$start}, {$limit}
	;";

	$return['posts'] = $wpdb->get_results( $query );

	$count_query = "
		SELECT count(Distinct meta.post_id)
		FROM {$wpdb->postmeta} meta
		INNER JOIN {$wpdb->posts} post
		ON meta.post_id = post.ID
		WHERE meta_key = 'zn_meta_elements'
		AND meta.meta_value != ''
   ";

	$return['count'] = $wpdb->get_var($count_query);

	return $return;
}

/**
 *
 * Change pagebuilder data from the old system to the new one
 *
 * */
function zn_cnv_v4_convert_pb_data( $update_data = false, $posts_data ){

	$updater_i = 1;

	foreach( $posts_data['posts'] as $meta_data )
	{


		$has_content_and_sidebar = false;
		$has_cusotm_sub_header = false; // Checks if the current page has a custom sub-header set
		$pb_layout = $content_areas = array();
		$meta_values  = maybe_unserialize( trim( $meta_data->meta_value ) );
		$sizes = array (
			"four"       => "0.25",
			"one-third"  => "0.33",
			"eight"      => "0.5",
			"two-thirds" => "0.66",
			"twelve"     => "0.75",
			"sixteen"    => "1",
		);
		$pb_content_areas = array( 'content_main_area', 'content_grey_area', 'content_bottom_area' );


		if ( $meta_values )
		{

			// Get the old theme options
			$old_theme_options = get_option( 'zn_kallyas_options' );

			// TODO : REMOVE IN FINAL VERSION
			// update_post_meta( $meta_data->post_id, 'zn_page_builder_status', 'disbaled' );
			// Remove WooCommerce image gallery
			if( $meta_data->post_type == 'product' ){
				if( !empty( $meta_values['woo_image_gallery'] ) && is_array( $meta_values['woo_image_gallery'] ) ){

					$all_images_ids = array();
					$woo_gallery = get_post_meta( $meta_data->post_id, '_product_image_gallery', true );

					if ( metadata_exists( 'post', $meta_data->post_id, '_product_image_gallery' ) ) {
						$woo_gallery = get_post_meta( $meta_data->post_id, '_product_image_gallery', true );
					} else {
						// Backwards compat - it seems that WooCommerce didn't properly updated the image galleries
						$attachment_ids = get_posts( 'post_parent=' . $meta_data->post_id . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids&meta_key=_woocommerce_exclude_image&meta_value=0' );
						$attachment_ids = array_diff( $attachment_ids, array( get_post_thumbnail_id( $meta_data->post_id ) ) );
						$woo_gallery = implode( ',', $attachment_ids );
					}

					$attachments = array_filter( explode( ',', $woo_gallery ) );

					// Loop trough all images in gallery
					foreach ( $meta_values['woo_image_gallery'] as $key => $value) {
						// If an image is set get the image id and add it to WooCommerce gallery
						if( !empty( $value['woo_single_image'] ) ){

							$image_id = ZngetAttachmentIdFromUrl( $value['woo_single_image'] );

							if( !empty( $image_id ) ){
								// Add the image only if it is not present already
								if( !in_array( $image_id, $attachments) ){
									$all_images_ids[] = $image_id;
								}
							}

						}
					}

					// Update woocommerce image gallery if we have images in our own gallery
					if( !empty( $all_images_ids ) ){
						$attachments = array_merge( $all_images_ids, $attachments );
					}

					update_post_meta( $meta_data->post_id, '_product_image_gallery', implode( ',', $attachments ) );
					unset( $meta_values['woo_image_gallery'] );
				}
			}

			foreach ( $meta_values as $area_name => &$value )
			{


				if( $area_name == 'header_area' ){
					foreach ($meta_values[$area_name] as $i => &$element) {
						$e = convert_pb_areas( $element );
						if(! is_null($e)){
							$pb_layout[] = $e;
							$has_cusotm_sub_header = true;
						}
					}
					unset( $meta_values[$area_name] );
				}
				elseif( $area_name == 'action_box_area' )
				{
					foreach ($meta_values[$area_name] as $i => &$element) {
						$e = convert_pb_areas( $element );
						if(! is_null($e)){
							$pb_layout[] = $e;
						}
					}
					unset( $meta_values[$area_name] );
				}
				elseif( in_array( $area_name, $pb_content_areas ) )
				{
					$columns = array();
					$content_columns = array();
					$size = 0;
					foreach ( $meta_values[$area_name] as $i => &$element) {

						// Search for the content and sidebar element
						if( isset($element['dynamic_element_type'] ) && $element['dynamic_element_type'] == '_content_sidebar' && in_array( $meta_data->post_type, array( 'page', 'post', 'portfolio' ) ) ){
							$has_content_and_sidebar = true;

							$content_sidebar_el = zn_get_content_and_sidebar( $meta_data, $meta_values );
							if( !empty( $content_sidebar_el ) ){
								$columns = array_merge( $columns, $content_sidebar_el );
							}
							continue;
						}

						$size += $sizes[ $element['_sizer'] ];
						$element = convert_pb_areas( $element );

						if(! is_null($element)){
							$el = ZN()->pagebuilder->add_module_to_layout( $element['object'], $element['options'] );
							$columns[] = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array( $el ), $element['width'] );
						}

						// Add an empty column to simulate row closing on the old framework
						// TODO : Replace with spacer element to see if it looks better
						if ( $size == '1' || $size == '0.99' || $size == '0.91' || $size == '0.88' ) {
							$spacer_element = ZN()->pagebuilder->add_module_to_layout( 'TH_SpacerElement', array( 'spacer_height' => '35' ) , array(), false );
							$columns[] = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array( $spacer_element ), 'col-sm-12' );
							$size = 0;
						}

					}

					$content_areas[$area_name] = $columns;

					// Performance gain
					unset( $meta_values[$area_name] );
				}
				else{
					update_post_meta( $meta_data->post_id, 'zn_'.$area_name, $value);
				}
			}


			// Check if we need to add a custom sub-header
			// This applies only if we do not have a custom sub-header, however, we do have content added with the pagebuilder to the page
			// The custom sub-header should inherit the settings set from theme's options panel
			if( ! $has_cusotm_sub_header && ( !empty( $pb_layout ) || !empty( $content_areas ) ) ){
				$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'TH_CustomSubHeaderLayout', array() , array(), false );
			}

			// COMBINE PB AREAS
			// CONTENT MAIN AREA
			// Check if we need to add the page content
			if( !$has_content_and_sidebar && ( !empty($pb_layout) || !empty($content_areas ) ) ){

				$page_layout = !empty( $meta_values['page_layout'] ) ? $meta_values['page_layout'] : false;
				$has_sidebar = zn_cnv_has_sidebar( $page_layout, $meta_data->post_type );

				// Only for posts and pages
				if( in_array( $meta_data->post_type, array( 'post', 'page' ) ) ){

					// Check to see if we have the PAGE BUILDER LAYOUT OPTION SAVED
					// style1 == on same row
					// default == content before pagebulder
					if( isset( $meta_values['page_builder_layout'] ) && $meta_values['page_builder_layout'] == 'style1' && $has_sidebar ){

						// We need to add the PB content inside the content
						$content_area_elements = !empty( $content_areas['content_main_area'] ) ? $content_areas['content_main_area'] : array();
						$content_columns = zn_get_content_and_sidebar( $meta_data, $meta_values, true, $content_area_elements );

						// Remove the content main area elements as we already added them bellow the content
						$content_areas['content_main_area'] = '';

					}
					else{
						// We need to add the content and then the PB content
						$content_columns = zn_get_content_and_sidebar( $meta_data, $meta_values );
					}
				}
				else{
					// THis is a different page that doesn't support the content bellow PB
					$content_columns = zn_get_content_and_sidebar( $meta_data, $meta_values );
				}

				// If we don't have any content we should add an empty section
				if( ! empty( $content_columns ) ){
					$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'ZnSection', array( 'bottom_padding' => '0', 'top_padding' => '60' ) , $content_columns, false );
				}
			}

			if( !empty( $content_areas['content_main_area'] ) ){
				$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'ZnSection', array( 'bottom_padding' => '0', 'top_padding' => '60' ) , $content_areas['content_main_area'], 'col-sm-12' );
			}


			// CONTENT GREY AREA
			if( !empty( $content_areas['content_grey_area'] ) ){
				// NOTHING TO DO HERE css_class
				$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'ZnSection', array( 'css_class' => 'gray-area', 'top_padding' => '60','bottom_padding' => '20' ) , $content_areas['content_grey_area'], 'col-sm-12' );
			}

			// CONTENT BOTTOM AREA
			if( !empty( $content_areas['content_bottom_area'] ) ){
				$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'ZnSection', array( 'bottom_padding' => '0' ) , $content_areas['content_bottom_area'], 'col-sm-12' );
			}

			// TODO : Add the comments element here if the user set the show comments after PB area
			// This only worked for posts and pages
			if( in_array( $meta_data->post_type, array( 'post', 'page' ) ) ){
				// If page comments were enabled gloablly
				// If comments location was set after pagebuilder
				if( !empty( $old_theme_options['zn_set_location_page_comments'] ) && $old_theme_options['zn_set_location_page_comments'] == 1 ){
					// TODO : ADD THE COMMENTS ELEMENT
					if( comments_open( $meta_data->post_id ) ) {
						$comments_el = ZN()->pagebuilder->add_module_to_layout( 'TH_Comments', array() , false, false );
						$comments_column = array( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array( $comments_el ), 'col-sm-12' ) );
						$pb_layout[] = ZN()->pagebuilder->add_module_to_layout( 'ZnSection', array() , $comments_column, false );
					}
				}
			}


			// If we have pagebuilder... save it already :D
			if( !empty( $pb_layout ) ){
				update_post_meta( $meta_data->post_id, 'zn_page_builder_status', 'enabled' );
				update_metadata( 'post', $meta_data->post_id, 'zn_page_builder_els', $pb_layout );
			}
		}

		if( !empty( $update_data ) ){
			$update_data['current_post']++;

			// If we reached the limit or
			if( $updater_i == 10 || $update_data['current_post'] >= $update_data['count'] ){

				$limit = $update_data['limit'] >= $update_data['count'] ? $update_data['count'] : $update_data['limit'];

				// GO to next step
				$response = array(
					'status' => 'ok',
					'step'	=> 'process_update',
					'data'	=> $update_data,
					'response_text' => 'Converted posts '.$update_data['start'].' to '.$limit.' out of '.$update_data['count']
				);

				ZN()->installer->zn_send_json( $response );
			}

			$updater_i++;
		}

	}
}


/**
 * Returns columns containing content and sidebar
 * @param type $post_type
 * @param type $page_layout
 * @param type $sidebar_select
 * @return bool || array
 */
function zn_get_content_and_sidebar( $metadata, $meta_values,  $wrap_container = null, $pb_data = null ){

	$content_columns = $sidebar_config = false;
	$page_layout = !empty( $meta_values['page_layout'] ) ? $meta_values['page_layout'] : false;
	$sidebar_select = !empty( $meta_values['sidebar_select'] ) ? $meta_values['sidebar_select'] : false;

	// We have a post format that has sidebar settings
	if( in_array( $metadata->post_type, array( 'post', 'page', 'product' ) ) && !empty( $page_layout ) && !empty( $sidebar_select ) ){
		// Sidebar settings
		$p_type = $metadata->post_type;


		// If it;s shop page
		if( class_exists( 'WooCommerce' ) && wc_get_page_id( 'shop' ) == $metadata->post_id ){
			$p_type = 'woo_archive';
		}
		elseif( $metadata->post_id == get_option( 'page_for_posts' ) ){
			$p_type = 'blog_archive';
		}



		$sidebar_config = zn_sidebar_config( $page_layout, $sidebar_select, $p_type );
	}

	// Get the content size. If we have a sidebar, we have a col-sm-9 width, else, col-sm-12
	$content_size = !empty( $sidebar_config ) ? 'col-sm-9' : 'col-sm-12';

	// Wee need to add the page content here
	$content_el = zn_cnv_get_page_content( $metadata, $meta_values, $page_layout );




	// Left sidebar
	if( !empty( $sidebar_config ) && $sidebar_config['page_layout'] == 'left_sidebar' ){
		$content_columns[] = $sidebar_config['sidebar_element'];
	}

	// Check to see if we need to show the content and PB data on same row
	if( $wrap_container ){
		// If we have content, add it to the layout
		if( !empty( $content_el ) ){
			$page_content_column = array( ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , $content_el , 'col-sm-12' ) );
			$page_content_columns = array_merge( $page_content_column, $pb_data );
		}
		else{
			// Only add the PB data
			$page_content_columns = $pb_data;
		}

		$custom_container = ZN()->pagebuilder->add_module_to_layout( 'ZnCustomContainer', array() , $page_content_columns, false );
		$content_columns[] = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array( $custom_container ), $content_size );
	}
	elseif( !empty( $content_el ) ){
		$content_columns[] = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , $content_el, $content_size );
	}

	if( !empty( $sidebar_config ) && $sidebar_config['page_layout'] == 'right_sidebar' ){
		$content_columns[] = $sidebar_config['sidebar_element'];
	}

	return $content_columns;
}

function zn_cnv_get_page_content( $metadata, $meta_values, $page_layout ){

	$content = array();
	$old_theme_options = get_option( 'zn_kallyas_options' );

	switch ( $metadata->post_type ) {
		case 'post':
			// Trebuie facut un check daca show_page_title == yes si daca avem content
			$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_PostContent', array() );
			break;
		case 'page':
			// Trebuie facut un check daca show_page_title == yes si daca avem content
			if( class_exists( 'WooCommerce' ) && wc_get_page_id( 'shop' ) == $metadata->post_id ){
				$archive_columns = $page_layout == 'no_sidebar' ? 4 : 3;
				$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_ProductArchive', array( 'num_columns' => $archive_columns ) );
			}
			elseif( $metadata->post_id == get_option( 'page_for_posts' ) ){
				// This is the page set as blog archive page
				$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_BlogArchive', array() );
			}
			elseif( ! empty( $metadata->post_content ) || ( !empty ( $meta_values['page_title_show'] ) && $meta_values['page_title_show'] == 'yes' )  ){
				$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_PageContent', array() );
			}
			break;
		case 'portfolio':
			$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_PortfolioContent', array() );
			break;
		case 'product':
			$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_ProductContent', array() );
			break;
		default:

			break;
	}

	// Also add the comments element if needed
	if( in_array( $metadata->post_type, array( 'post', 'page' ) ) ){
		// If comments location was set after page content
		if( isset( $old_theme_options['zn_set_location_page_comments'] ) && $old_theme_options['zn_set_location_page_comments'] === '0' ){
			// TODO : ADD THE COMMENTS ELEMENT
			if( comments_open( $metadata->post_id ) ) {
				$content[] = ZN()->pagebuilder->add_module_to_layout( 'TH_Comments', array() , false, false );
			}
		}
	}

	return $content;
}

/**
 * Returns the sidebar configuration
 * @param type $page_layout
 * @param type $sidebar_select
 * @param type $post_type
 * @return false || array
 */
function zn_sidebar_config( $page_layout, $sidebar_select, $post_type ){

	$return = array();

	// GET SIDEBAR LAYOUT
	$return['page_layout'] = zn_cnv_has_sidebar( $page_layout, $post_type );

	// It may be possible that the admin option is set to no_sidebar
	if( empty( $return['page_layout'] ) ){
		return false;
	}

	// GET SIDEBAR TO USE
	if( $sidebar_select == 'default' ){
		// We need to get the sidebar setting from admin panel
		switch ($post_type) {
			case 'post':
				$sidebar_select = zget_option( 'single_sidebar', 'unlimited_sidebars' );
				$sidebar_select = !empty( $sidebar_select ) ? $sidebar_select['sidebar'] : 'defaultsidebar';
				break;
			case 'page':
				$sidebar_select = zget_option( 'page_sidebar', 'unlimited_sidebars' );
				$sidebar_select = !empty( $sidebar_select ) ? $sidebar_select['sidebar'] : 'defaultsidebar';
				break;
			case 'product':
				$sidebar_select = zget_option( 'woo_single_sidebar', 'unlimited_sidebars' );
				$sidebar_select = !empty( $sidebar_select ) ? $sidebar_select['sidebar'] : 'defaultsidebar';
				break;
			case 'woo_archive':
				$sidebar_select = zget_option( 'woo_archive_sidebar', 'unlimited_sidebars' );
				$sidebar_select = !empty( $sidebar_select ) ? $sidebar_select['sidebar'] : 'defaultsidebar';
				break;
			case 'blog_archive':
				$sidebar_select = zget_option( 'archive_sidebar', 'unlimited_sidebars' );
				$sidebar_select = !empty( $sidebar_select ) ? $sidebar_select['sidebar'] : 'defaultsidebar';
				break;
			default:
				# code...
				break;
		}

	}

	// Finally, get the column containing the sidebar
	$sidebar_el = ZN()->pagebuilder->add_module_to_layout( 'TH_Sidebar', array( 'sidebar_select' => $sidebar_select ) );
	$return['sidebar_element'] = ZN()->pagebuilder->add_module_to_layout( 'ZnColumn', array() , array( $sidebar_el ), 'col-sm-3' );

	return $return;
}

function zn_cnv_has_sidebar( $page_layout, $post_type ){
	if( $page_layout == 'no_sidebar' ){
		return false;
	}
	elseif( $page_layout == 'default' ){
		// We need to get the sidebar setting from admin panel
		switch ($post_type) {
			case 'post':
				$page_layout_new = zget_option( 'single_sidebar', 'unlimited_sidebars' );
				$page_layout_new = !empty( $page_layout_new ) ? $page_layout_new['layout'] : 'right_sidebar';
				break;
			case 'page':
				$page_layout_new = zget_option( 'page_sidebar', 'unlimited_sidebars' );
				$page_layout_new = !empty( $page_layout_new ) ? $page_layout_new['layout'] : 'right_sidebar';
				break;
			case 'product':
				$page_layout_new = zget_option( 'woo_single_sidebar', 'unlimited_sidebars' );
				$page_layout_new = !empty( $page_layout_new ) ? $page_layout_new['layout'] : 'right_sidebar';
				break;
			case 'woo_archive':
				$page_layout_new = zget_option( 'woo_archive_sidebar', 'unlimited_sidebars' );
				$page_layout_new = !empty( $page_layout_new ) ? $page_layout_new['layout'] : 'right_sidebar';
				break;
			case 'blog_archive':
				$page_layout_new = zget_option( 'archive_sidebar', 'unlimited_sidebars' );
				$page_layout_new = !empty( $page_layout_new ) ? $page_layout_new['layout'] : 'right_sidebar';
				break;
			default:
				# code...
				break;
		}

	}
	else{
		$page_layout_new = $page_layout;
	}

	if( $page_layout_new == 'no_sidebar' ){
		return false;
	}

	return $page_layout_new;
}

/**
 * Convert old page builder areas to use the new structure
 * @param array $element
 * @return array|null
 */
function convert_pb_areas( $element ) {
	// Check first if we have the element
	if(isset($element['dynamic_element_type'])){
		// get the element
		$e = zn_convert_old_pb_name( $element['dynamic_element_type'] );
		if(empty($e)){
			return null;
		}
	}
	else { return null; }

	// Prepare output
	$module = array(
		'object' => $e
	);

	// The action box area element didn't had a size value
	if(isset($element['_sizer']) && !empty( $element['_sizer'] ) ) {
		$new_width = zn_get_size( $element['_sizer'] );
		$module['width'] = $new_width['sizer'];
	}

	// Convert contact form options keys to new element
	if ( 'TH_FeaturesBoxes' == $module['object'] ){
		$element = zn_cnv_v4_update_features_boxes( $element );
	}


	unset( $element['dynamic_element_type'], $element['pb_area'], $element['_sizer'] );

	// Convert icons
	$needs_icon_converting = array(
		'TH_StatsBox',
		'TH_VerticalTabs',
		'TH_StaticContentProductLoupe',
	);

	// Convert bootstrap icons
	if( in_array( $module['object'], $needs_icon_converting ) ){
		// These are all the options that contained an icon font
		array_walk_recursive($element, 'zn_update_bootstrap_icons_std', array(
			'vts_tab_icon',
			'sc_lp_button1_icon',
			'sc_lp_button2_icon',
		));
	}

	// Convert social icons
	$social_icon_elements = array(
		'TH_TeamBox',
		'TH_StaticContentEventCountdown',
	);
	if( in_array( $module['object'], $social_icon_elements ) ){
		array_walk_recursive($element, 'update_social_icons_std', array(
			'teb_social_icon',
			'sc_ec_social_icon',
		));
	}

	// Convert contact form options keys to new element
	if ( 'ZnContactForm' == $module['object'] ){
		$element = update_contact_form_options( $element );
	}

	// Convert Static Content MAPS ( single )
	if ( 'ZN_MAPS_SINGLE' == $module['object'] ){
		// print_z( $element );
		$element = update_static_content_maps( $element );
		$module['object'] = 'ZnGoogleMap';
	}

	// Convert portfolio category
	$old_portfolio_elements = array(
		'TH_PortfolioCarouselLayout',
		'TH_PortfolioCategory',
		'TH_PortfolioSortable',
	);
	if ( in_array( $module['object'], $old_portfolio_elements) ){
		// print_z( $element );
		$element = update_portfolio_category( $element, $module['object'] );
		$module['object'] = 'TH_PortfolioArchive';
	}

	$module['options'] = $element;
	$module['content'] = false;
	$module['uid'] = zn_uid('eluid');

	return $module;
}

/**
 * @param array $item
 */
function update_portfolio_category( &$item, $type ){

	$new_item = array();

	$new_style_map = array(
		'TH_PortfolioCategory' => 'portfolio_category',
		'TH_PortfolioSortable' => 'portfolio_sortable',
		'TH_PortfolioCarouselLayout' => 'portfolio_carousel',
	);

	// Adds the element style
	$new_item['portfolio_style'] = $new_style_map[ $type ];

	$new_key_map = array(
		'ports_per_page' => 'ports_per_page_visible',
		'port_num_columns' => 'ports_num_columns',
		'frame_style' => 'frame_style',
		'portfolio_categories' => 'portfolio_categories',
		'ports_per_page_visible' => 'ports_per_page_visible',
		'ports_num_columns' => 'ports_num_columns',
	);

	// change old options keys
	foreach ($item as $key => $value) {
		if( !empty( $new_key_map[$key] ) ) {
			$new_item[$new_key_map[$key]] = $value;
		}
	}

	return $new_item;
}


/**
 *
 * @param $item
 * @param $key
 * @param array $social_icon_options
 */
function zn_update_bootstrap_icons_std(&$item, $key, $social_icon_options) {
	if( in_array( $key, $social_icon_options ) ) {
		/// Se pare ca getBootstrapIcons avea spatii dupa numele iconitei ??
		if(is_string($item)){
			$item = trim($item);
		}
		$_item = zn_get_bootstrap_icon_name( $item );
		if(! empty($_item)){
			$item = $_item;
		}
	}
}

/**
 *	Converts the old contact form options id's to the new ones
 * @param $item
 * @param $key
 */
function update_contact_form_options( &$item ){

	$new_contact_form_options = array();
	$has_captcha_field = false;

	// Regular options
	$new_key_map = array(
		'zn_cf_email_address' => 'email',
		'zn_cf_desc' => 'description',
		'zn_cf_button_value' => 'submit_label',
		'zn_cf_button_subject' => 'email_subject',
	);

	foreach ($item as $key => $value) {
		if( !empty( $new_key_map[$key] ) ) {
			$new_contact_form_options[$new_key_map[$key]] = $value;
		}
	}

	$field_width = array(
		'col-sm-6',
		'col-sm-12',
	);

	$field_validation = array(
		'none',
		'not_empty',
	);

	// Form fields
	if( is_array( $item['zn_cf_fields'] ) ){
		foreach ( $item['zn_cf_fields'] as $key => $value) {

			// Check if we have a captcha field
			if( $value['zn_cf_type'] == 'captcha' ){
				$has_captcha_field = true;
				continue;
			}
			elseif( !empty( $value['zn_cf_type'] ) ){
				$new_contact_form_options['fields'][$key][ 'type' ] = $value['zn_cf_type'];
			}

			// Convert the name
			$new_contact_form_options['fields'][$key][ 'name' ] = $value['zn_cf_name'];
			$new_contact_form_options['fields'][$key][ 'email' ] = $value['zn_cf_f_email'];
			$new_contact_form_options['fields'][$key][ 'width' ] = 'col-sm-12';

			// Convert field validation
			if( !empty( $value['zn_cf_required']) ){
				$new_contact_form_options['fields'][$key][ 'validation' ] = $field_validation[$value['zn_cf_required']];
			}
			else{
				$new_contact_form_options['fields'][$key][ 'validation' ] = 'none';
			}
		}
	}

	// Set the captcha field
	if( $has_captcha_field ){
		$new_contact_form_options['captcha'] = true;
	}

	return $new_contact_form_options;
}

/**
 *	Converts the old static content maps to use the multiple locations one
 * @param $item
 * @param $key
 */
function update_static_content_maps( &$item ){

	$locations = array();

	$new_key_map = array(
		'sc_map_latitude' => 'sc_map_latitude',
		'sc_map_longitude' => 'sc_map_longitude',
		'sc_map_icon' => 'sc_map_icon',
	);

	foreach ($item as $key => $value) {
		if( !empty( $new_key_map[$key] ) ) {
			$locations['0'][$key] = $value;
			unset( $item[$key] );
		}
	}

	// Set the multiple locations back in options
	$item['single_multiple_maps'] = $locations;

	return $item;
}

function zn_cnv_v4_update_features_boxes( &$element ){

	// print_z( $element );

	if( !empty( $element['_sizer'] ) ){
		if( $element['_sizer'] == 'sixteen' ){
			if ( ! empty ( $element['fb_stitle'] ) || ! empty ( $element['fb_desc'] ) ) {
				$element['fb_columns'] = 'col-lg-4';
			}
			else{
				$element['fb_columns'] = 'col-lg-3';
			}
		}
	}

	return $element;
}

/**
 * Converts the old icon std to the new one
 * @param $icon
 * @return null
 */
function zn_get_bootstrap_icon_name( $icon ){

	$bootstrap_icons = array (
		"icon-glass" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue001' ),
		"icon-music" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue002' ),
		"icon-search" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue003' ),
		"icon-envelope" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'u2709' ),
		"icon-heart" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue005' ),
		"icon-star" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue006' ),
		"icon-star-empty" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue007' ),
		"icon-user" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue008' ),
		"icon-film" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue009' ),
		"icon-th-large" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue010' ),
		"icon-th" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue011' ),
		"icon-th-list" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue012' ),
		"icon-ok" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue013' ),
		"icon-remove" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue014' ),
		"icon-zoom-in" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue015' ),
		"icon-zoom-out" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue016' ),
		"icon-off" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue017' ),
		"icon-signal" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue018' ),
		"icon-cog" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue019' ),
		"icon-trash" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue020' ),
		"icon-home" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue021' ),
		"icon-file" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue022' ),
		"icon-time" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue023' ),
		"icon-road" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue024' ),
		"icon-download-alt" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue025' ),
		"icon-download" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue026' ),
		"icon-upload" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue027' ),
		"icon-inbox" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue028' ),
		"icon-play-circle" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue029' ),
		"icon-repeat" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue030' ),
		"icon-refresh" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue031' ),
		"icon-list-alt" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue032' ),
		"icon-lock" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue033' ),
		"icon-flag" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue034' ),
		"icon-headphones" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue035' ),
		"icon-volume-off" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue036' ),
		"icon-volume-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue037' ),
		"icon-volume-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue038' ),
		"icon-qrcode" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue039' ),
		"icon-barcode" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue040' ),
		"icon-tag" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue041' ),
		"icon-tags" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue042' ),
		"icon-book" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue043' ),
		"icon-bookmark" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue044' ),
		"icon-print" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue045' ),
		"icon-camera" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue046' ),
		"icon-font" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue047' ),
		"icon-bold" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue048' ),
		"icon-italic" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue049' ),
		"icon-text-height" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue050' ),
		"icon-text-width" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue051' ),
		"icon-align-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue052' ),
		"icon-align-center" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue053' ),
		"icon-align-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue054' ),
		"icon-align-justify" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue055' ),
		"icon-list" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue056' ),
		"icon-indent-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue057' ),
		"icon-indent-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue058' ),
		"icon-facetime-video" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue059' ),
		"icon-picture" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue060' ),
		"icon-pencil" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'u270f' ),
		"icon-map-marker" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue062' ),
		"icon-adjust" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue063' ),
		"icon-tint" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue064' ),
		"icon-edit" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue065' ),
		"icon-share" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue066' ),
		"icon-check" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue067' ),
		"icon-move" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue068' ),
		"icon-step-backward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue069' ),
		"icon-fast-backward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue070' ),
		"icon-backward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue071' ),
		"icon-play" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue072' ),
		"icon-pause" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue073' ),
		"icon-stop" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue074' ),
		"icon-forward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue075' ),
		"icon-fast-forward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue076' ),
		"icon-step-forward" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue077' ),
		"icon-eject" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue078' ),
		"icon-chevron-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue079' ),
		"icon-chevron-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue080' ),
		"icon-plus-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue081' ),
		"icon-minus-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue082' ),
		"icon-remove-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue083' ),
		"icon-ok-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue084' ),
		"icon-question-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue085' ),
		"icon-info-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue086' ),
		"icon-screenshot" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue087' ),
		"icon-remove-circle" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue088' ),
		"icon-ok-circle" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue089' ),
		"icon-ban-circle" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue090' ),
		"icon-arrow-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue091' ),
		"icon-arrow-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue092' ),
		"icon-arrow-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue093' ),
		"icon-arrow-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue094' ),
		"icon-share-alt" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue095' ),
		"icon-resize-full" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue096' ),
		"icon-resize-small" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue097' ),
		"icon-plus" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => '2b' ), /// Trebuie testata
		"icon-minus" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'u2212' ),
		"icon-asterisk" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => '2a' ), /// Trebuie testata
		"icon-exclamation-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue101' ),
		"icon-gift" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue102' ),
		"icon-leaf" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue103' ),
		"icon-fire" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue104' ),
		"icon-eye-open" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue105' ),
		"icon-eye-close" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue106' ),
		"icon-warning-sign" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue107' ),
		"icon-plane" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue108' ),
		"icon-calendar" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue109' ),
		"icon-random" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue110' ),
		"icon-comment" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue111' ),
		"icon-magnet" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue112' ),
		"icon-chevron-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue113' ),
		"icon-chevron-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue114' ),
		"icon-retweet" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue115' ),
		"icon-shopping-cart" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue116' ),
		"icon-folder-close" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue117' ),
		"icon-folder-open" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue118' ),
		"icon-resize-vertical" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue119' ),
		"icon-resize-horizontal" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue120' ),
		"icon-hdd" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue121' ),
		"icon-bullhorn" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue122' ),
		"icon-bell" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue123' ),
		"icon-certificate" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue124' ),
		"icon-thumbs-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue125' ),
		"icon-thumbs-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue126' ),
		"icon-hand-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue127' ),
		"icon-hand-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue128' ),
		"icon-hand-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue129' ),
		"icon-hand-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue130' ),
		"icon-circle-arrow-right" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue131' ),
		"icon-circle-arrow-left" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue132' ),
		"icon-circle-arrow-up" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue133' ),
		"icon-circle-arrow-down" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue134' ),
		"icon-globe" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue135' ),
		"icon-wrench" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue136' ),
		"icon-tasks" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue137' ),
		"icon-filter" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue138' ),
		"icon-briefcase" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue139' ),
		"icon-fullscreen" => array( 'family' => 'glyphicons_halflingsregular', 'unicode' => 'ue140' ),
	);
	return (isset($bootstrap_icons[$icon]) ? $bootstrap_icons[$icon] : null);
}


function zn_cnv_v4_convert_widgets(){
	// Convert old spans to new bootstrap
	zn_cnv_convert_hidden_panel();
	// Repare the widgets id's that were broken in v3.6.1
	zn_cnv_repare_sidebars();
}

/**
 * Converts old bootstrap spans with new ones for all text widgets
 * @return type
 */
function zn_cnv_convert_hidden_panel(){
	$all_text_widgets = get_option( 'widget_text' );

	$search = array(
		'span1',
		'span2',
		'span3',
		'span4',
		'span5',
		'span6',
		'span7',
		'span8',
		'span9',
		'span10',
		'span11',
		'span12',
	);
	$replace = array(
		'col-sm-1',
		'col-sm-2',
		'col-sm-3',
		'col-sm-4',
		'col-sm-5',
		'col-sm-6',
		'col-sm-7',
		'col-sm-8',
		'col-sm-9',
		'col-sm-10',
		'col-sm-11',
		'col-sm-12',
	);

	foreach ( $all_text_widgets as $key => &$value) {
		if( !empty( $value['text'] ) ){
			$value['text'] = str_replace( $search, $replace, $value['text'] );
		}
	}

	update_option( 'widget_text', $all_text_widgets );
}


// // We need to simulate a theme change in order to preserve the widgets locations
function zn_cnv_repare_sidebars()
{
	global $wp_registered_sidebars;
	$our_sidebars = false;

	$old_sidebar_config = wp_get_sidebars_widgets();

	$sidebars_mapping = array();

	$unlimited_sidebars = zget_option( 'unlimited_sidebars', 'unlimited_sidebars' );
	$unlimited_sidebars_num = count( $unlimited_sidebars );
	$i = 1;

	// Check to see if we actually need to convert the sidebars id's
	if( $unlimited_sidebars_num == 0 || empty( $old_sidebar_config ) || empty( $unlimited_sidebars ) ){
		return false;
	}

	foreach ( $old_sidebar_config as $key => $value) {
		if( $key == 'hiddenpannelsidebar') {
			$our_sidebars = true;

			continue;
		}

		// We reached our sidebars, now we need to see if we have footer sidebars
		if( strpos( $key, 'znfooter') === 0 ){
			$our_sidebars = true;
			continue;
		}

		// We've reached the unlimited sidebars


		if( $our_sidebars && strpos( $key, 'sidebar-' ) == 0 && $i <= $unlimited_sidebars_num ){

			if( !empty( $unlimited_sidebars[$i-1] ) ){
				$new_id = zn_sanitize_widget_id( $unlimited_sidebars[$i-1]['sidebar_name'] );
				$old_sidebar_config[ $new_id ] = $value;

				$sidebars_mapping[ $key ] = $new_id;

				// unset( $unlimited_sidebars[ $sidebar_id ] );
				unset( $old_sidebar_config[ $key ] );
			}

			$i++;
		}
		else{
			// we converted all our sidebars
			continue;
		}
	}

	// Save the new config
	wp_set_sidebars_widgets( $old_sidebar_config );

	// Fix theme mod
	$master_theme_config = get_option( 'theme_mods_kallyas' );
	$new_sidebar_config = array();
	if( !empty( $master_theme_config['sidebars_widgets']['data'] ) ){
		$master_theme_config['sidebars_widgets']['data'] = $old_sidebar_config;
	}

	update_option( 'theme_mods_kallyas', $master_theme_config );


	// Fix for child themes
	$old_sidebars_widgets = get_theme_mod( 'sidebars_widgets' );
	if( !empty( $child_sidebar_config['data'] ) ){
		set_theme_mod( 'sidebars_widgets', $old_sidebar_config );
	}

}

// echo convert(memory_get_usage() - $mem);
// echo '<br />'. convert(memory_get_peak_usage());
// die( '' ); // Se decomenteaza doar pentru teste...
