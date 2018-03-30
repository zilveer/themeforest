<?php

//UPDATH THEME
require_once ( get_template_directory() . '/framework/admin/updates.php');

//CUSTOM SLIDER POST TYPE
require_once ( get_template_directory() . '/framework/admin/custom-slider.php');

if( is_admin() ){

	//TGM CLASS
	require_once ( get_template_directory() . '/framework/admin/inc/tgm/class-tgm-plugin-activation.php');

	//OPTIONS FUNCTIONS
	require_once ( get_template_directory() . '/framework/admin/framework-options.php');

	//TIEPANEL
	require_once ( get_template_directory() . '/framework/admin/framework-panel.php');

	//CATEGORIES OPTIONS
	require_once ( get_template_directory() . '/framework/admin/framework-category.php');

	//POSTS META-BOXES
	require_once ( get_template_directory() . '/framework/admin/framework-metaboxes.php');

	//UPDATE NOTIFIER
	require_once ( get_template_directory() . '/framework/admin/inc/notifier/update-notifier.php');

	//IMPORTER PLUGIN
	require_once ( get_template_directory() . '/framework/admin/inc/importer/tie-importer.php');


	require_once ( get_template_directory() . '/framework/admin/framework-builder.php');


	/*-----------------------------------------------------------------------------------*/
	# Rate The Theme
	/*-----------------------------------------------------------------------------------*/
	if ( isset( $_GET['page'] ) && $_GET['page'] == 'panel' ) {
		function tie_enqueue_pointer_script_style( $hook_suffix ) {
			$dismissed_pointers = explode( ',', get_user_meta( get_current_user_id(), 'dismissed_wp_pointers', true ) );

			$tie_admin_pointers			= false;
			$tie_before_panel_pointers 	= false; //To show only one message

			if( !in_array( 'tie_rate_theme5', $dismissed_pointers ) ) {
				add_action( 'admin_print_footer_scripts', 'tie_rate_pointer_print_scripts' );
				$tie_admin_pointers = true;
			}

			$today          	= time();
			$first_congrats_day = mktime( 0, 0, 0, 12, 25 );
			$last_congrats_day  = mktime( 0, 0, 0, 1, 5 );
			$first_dat_new_year = mktime( 0, 0, 0, 1, 1 );
			$the_new_year		= date( 'Y' )+1;

			if( $today >= $first_dat_new_year && $today < $last_congrats_day ){
				$the_new_year	= date( 'Y' );
			}

			$new_year_pointer 	= 'tie_happy_new_year_'.$the_new_year;

			if( !in_array( $new_year_pointer, $dismissed_pointers ) && ( $today >= $first_congrats_day || $today < $last_congrats_day ) ) {
				add_action( 'admin_print_footer_scripts', 	'tie_happy_new_year_pointer_print_scripts' );
				add_action( 'tie_before_theme_panel', 		'tie_before_admin_pointers_container' );
				$tie_admin_pointers 		= true;
				$tie_before_panel_pointers 	= true;
			}

			if( !in_array( 'tie_sahifa_notice', $dismissed_pointers ) && !$tie_before_panel_pointers ) {
				add_action( 'admin_print_footer_scripts', 	'tie_sahifa_notice_pointer_print_scripts' );
				add_action( 'tie_before_theme_panel', 		'tie_before_admin_pointers_container' );
				$tie_admin_pointers = true;
			}

			if( !empty( $tie_admin_pointers ) ) {
				wp_enqueue_style( 'wp-pointer' );
				wp_enqueue_script( 'wp-pointer' );
			}


		}
		add_action( 'admin_enqueue_scripts', 'tie_enqueue_pointer_script_style' );

		function tie_rate_pointer_print_scripts() {
			$pointer_content  = "<h3>". __( 'Did you like', 'tie' ) ." ".THEME_NAME." ?</h3>";
			$pointer_content .= "<p><a href=\'http://themeforest.net/downloads?ref=tielabs\' target=\'_blank\'>".__( "If you like the theme, please don\'t forget to rate it :)", "tie")."</a></p>";
		?>
			<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('.mo-panel .tie-tabs.tie-rate').pointer({
					content:		'<?php echo $pointer_content; ?>',
					pointerWidth:	350,
					position:		{
										edge:	'left', /* arrow direction */
										align:	'middle' /* vertical alignment */
									},
					close:			function() {
										$.post( ajaxurl, {
												pointer: 'tie_rate_theme5', /* pointer ID */
												action: 'dismiss-wp-pointer'
										});
									}
				}).pointer('open');
			});
			//]]>
			</script>
		<?php
		}

		//______
		function tie_before_admin_pointers_container() {
			?>
				<div id="tie-before-admin-pointers-container"></div>
			<?php
		}

		function tie_sahifa_notice_pointer_print_scripts() {
			$pointer_content  = "<h3>". __( 'Howdy!', 'tie' ) ."</h3>";
			$pointer_content .= '<p>As you know <a href="http://tielabs.com/blog/attention-about-illegalnulled-tielabs-themes/" target="_blank"><strong>Sahifa theme is exclusively available for purchase on ThemeForest only</strong></a> for $59 but, Did you know the purchase you made allows you to use the theme on one domain or project. A single purchase is needed for each site you use the theme on. We appreciate following the <a href="http://themeforest.net/licenses/standard?ref=tielabs" target="_blank">License terms</a> as it allows us to keep supporting and releasing new updates. <strong>If you are using the theme on a single website only, you can safely dismiss this message.</strong> <br /><a href="http://themeforest.net/item/i/2819356?ref=tielabs&utm_source=sahifa-notice&utm_medium=post&utm_campaign=sahifa-theme" target="_blank" style="margin-top: 5px" class="button button-primary">Buy Another License</a></p>';
		?>
			<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('.mo-panel').pointer({
					content:		'<?php echo $pointer_content; ?>',
					pointerClass:	'wp-pointer tie-pointer-general-message tie-pointer-license-message',
					pointerWidth:	810,
					position:		{
										edge:	'bottom', /* arrow direction */
										align:	'middle' /* vertical alignment */
									},
					close:			function() {
										jQuery( '#tie-before-admin-pointers-container' ).slideUp();
										$.post( ajaxurl, {
												pointer: 'tie_sahifa_notice', /* pointer ID */
												action: 'dismiss-wp-pointer'
										});
									}
				}).pointer('open');
			});
			//]]>
			</script>
		<?php
		}


		//______
		function tie_happy_new_year_pointer_print_scripts() {
			$today          	= time();
			$last_congrats_day  = mktime( 0, 0, 0, 1, 5 );
			$first_dat_new_year = mktime( 0, 0, 0, 1, 1 );
			$the_new_year		= date( 'Y' )+1;

			if( $today >= $first_dat_new_year && $today < $last_congrats_day ){
				$the_new_year	= date( 'Y' );
			}

			$new_year_pointer 	= 'tie_happy_new_year_'.$the_new_year;
			$pointer_content  	= "<h3>". __( 'Happy New Year!', 'tie' ) ."</h3><span></span>";
			$pointer_content 	.= '<p>'. __( 'To our client who have made our progress possible, All of us at TieLabs join in wishing you a Happy New Year with the best of everything in your life for you and your family and we look forward to serving you in the new year :)', 'tie' ) .'</p>';
			$pointer_content 	.= '<p>'. sprintf( __( 'Follow us on <a href="%1$s" target="_blank">Twitter</a> or <a href="%2$s" target="_blank">Facebook</a>.' , 'tie' ), 'http://twitter.com/tielabs', 'https://www.facebook.com/tielabs' ) .'</p>';
		?>
			<script type="text/javascript">
			//<![CDATA[
			jQuery(document).ready( function($) {
				$('.mo-panel').pointer({
					content:		'<?php echo $pointer_content; ?>',
					pointerClass:	'wp-pointer tie-pointer-general-message tie-happy-new-year-message',
					pointerWidth:	810,
					position:		{
										edge:	'bottom', /* arrow direction */
										align:	'middle' /* vertical alignment */
									},
					close:			function() {
										jQuery( '#tie-before-admin-pointers-container' ).slideUp();
										$.post( ajaxurl, {
												pointer: '<?php echo $new_year_pointer ?>', /* pointer ID */
												action: 'dismiss-wp-pointer'
										});
									}
				}).pointer('open');
			});
			//]]>
			</script>
		<?php
		}
	}


	/*-----------------------------------------------------------------------------------*/
	# Yoast Seo | Add the page builder content to the post content to be analyzed.
	/*-----------------------------------------------------------------------------------*/
	if ( function_exists( 'wpseo_init' ) ) {
		function tie_yst_custom_content_analysis( $content ) {
			global $post;

			$get_builder_data = get_post_meta( $post->ID , 'tie_builder', true );
			if( !empty( $get_builder_data )){
				$content = $content . ' ' . serialize( get_post_meta( $post->ID , 'tie_builder', true ) );
			}

			return $content;
		}
		add_filter( 'wpseo_pre_analysis_post_content', 'tie_yst_custom_content_analysis' );
	}


	/*-----------------------------------------------------------------------------------*/
	# Register main Scripts and Styles
	/*-----------------------------------------------------------------------------------*/
	function tie_admin_register() {
		global $pagenow;

		wp_register_script( 'tie-admin-main', get_template_directory_uri() . '/framework/admin/js/tie.js', array( 'jquery' ) , false , false );
		wp_register_script( 'tie-admin-icon-picker', get_template_directory_uri() . '/framework/admin/js/icon-picker.js', array( 'jquery' ) , false , false );
		wp_register_script( 'tie-admin-colorpicker', get_template_directory_uri() . '/framework/admin/js/colorpicker.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-sortable', 'jquery-ui-slider' ) , false , false );

		wp_register_style( 'tie-style', get_template_directory_uri().'/framework/admin/style.css', array(), '', 'all' );
		wp_register_style( 'tie-fonts', get_template_directory_uri().'/framework/admin/fonts.css', array(), '', 'all' );
		wp_register_style( 'tie-fontawesome', get_template_directory_uri().'/fonts/fontawesome/font-awesome.min.css', array(), '', 'all' );

		if ( (isset( $_GET['page'] ) && $_GET['page'] == 'panel') || (  $pagenow == 'post-new.php' ) || (  $pagenow == 'post.php' )|| (  $pagenow == 'term.php' ) ) {
			wp_enqueue_script( 'tie-admin-colorpicker');

			$tie_lang = array(
				"update"					=> __( 'Update', 'tie' ),

				"bulider_category"			=> __( 'Category:', 'tie' ),
				"bulider_order"				=> __( 'Posts Order:', 'tie' ),
				"bulider_posts"				=> __( 'Number of posts to show:', 'tie' ),
				"bulider_offset"			=> __( 'Offset - number of posts to pass over:', 'tie' ),
				"bulider_thumbnail"			=> __( 'Hide thumbnail for the First post', 'tie' ),
				"bulider_thumbnails"		=> __( 'Hide all small thumbnails', 'tie' ),
				"bulider_exclude"			=> __( 'Exclude These Categories:', 'tie' ),
				"bulider_title"				=> __( 'Title:', 'tie' ),
				"bulider_pagination"		=> __( 'Show Pagination', 'tie' ),
				"bulider_social"			=> __( 'Show Social Buttons', 'tie' ),
				"bulider_warning"			=> __( 'WordPress WARNING: Setting the offset option breaks pagination, disable the pagination option if you want to use the offset option.', 'tie' ),
				"bulider_tabs"				=> __( 'Categories Tabs Block', 'tie' ),
				"bulider_recent"			=> __( 'Recent Posts', 'tie' ),
				"bulider_block"				=> __( 'Category Block:', 'tie' ),
				"bulider_categories"		=> __( 'Choose Categories:', 'tie' ),
				"bulider_woocommerce"		=> __( 'WooCommerce', 'tie' ),
				"bulider_recent_products"	=> __( 'Recent Products', 'tie' ),
				"bulider_products"			=> __( 'Number of Products to show:', 'tie' ),
				"bulider_pro_offset"		=> __( 'Offset - number of Products to pass over:', 'tie' ),
				"bulider_mode"				=> __( 'Display Mode:', 'tie' ),
				"bulider_default"			=> __( 'Default Layout', 'tie' ),
				"bulider_scrolling"			=> __( 'Scrolling Block', 'tie' ),
				"bulider_scroll"			=> __( 'Scrolling', 'tie' ),
				"bulider_text_html"			=> __( 'Text or HTML', 'tie' ),
				"bulider_supports"			=> __( 'Supports: Text, HTML and Shortcodes.', 'tie' ),
				"bulider_picture"			=> __( 'News in Picture', 'tie' ),
				"bulider_lightbox"			=> __( 'Videos Lightbox', 'tie' ),
				"bulider_videos"			=> __( 'Videos', 'tie' ),
				"bulider_videos_lightbox"	=> __( 'Videos Lightbox option working with YouTube and Vimeo videos only.', 'tie' ),
				"bulider_latest"			=> __( 'Latest Posts', 'tie' ),
				"bulider_random"			=> __( 'Random Posts', 'tie' ),

				"shortcode_tielabs"			=> __( 'Tielabs Shortcodes', 'tie' ),
				"shortcode_box"				=> __( 'Box', 'tie' ),
				"shortcode_alignment"		=> __( 'Alignment:', 'tie' ),
				"shortcode_class"			=> __( 'Custom CSS Class:', 'tie' ),
				"shortcode_style"			=> __( 'Style:', 'tie' ),
				"shortcode_shadow"			=> __( 'Shadow', 'tie' ),
				"shortcode_info"			=> __( 'Info', 'tie' ),
				"shortcode_success"			=> __( 'Success', 'tie' ),
				"shortcode_warning"			=> __( 'Warning', 'tie' ),
				"shortcode_error"			=> __( 'Error', 'tie' ),
				"shortcode_download"		=> __( 'Download', 'tie' ),
				"shortcode_note"			=> __( 'Note', 'tie' ),
				"shortcode_right"			=> __( 'Right', 'tie' ),
				"shortcode_left"			=> __( 'Left', 'tie' ),
				"shortcode_center"			=> __( 'Center', 'tie' ),
				"shortcode_width"			=> __( 'Width:', 'tie' ),
				"shortcode_content"			=> __( 'Content:', 'tie' ),
				"shortcode_button"			=> __( 'Button', 'tie' ),
				"shortcode_color"			=> __( 'Color:', 'tie' ),
				"shortcode_red"				=> __( 'Red', 'tie' ),
				"shortcode_orange"			=> __( 'Orange', 'tie' ),
				"shortcode_blue"			=> __( 'Blue', 'tie' ),
				"shortcode_green"			=> __( 'Green', 'tie' ),
				"shortcode_black"			=> __( 'Black', 'tie' ),
				"shortcode_gray"			=> __( 'Gray', 'tie' ),
				"shortcode_white"			=> __( 'White', 'tie' ),
				"shortcode_pink"			=> __( 'Pink', 'tie' ),
				"shortcode_purple"			=> __( 'Purple', 'tie' ),
				"shortcode_yellow"			=> __( 'Yellow', 'tie' ),
				"shortcode_size"			=> __( 'Size:', 'tie' ),
				"shortcode_small"			=> __( 'Small', 'tie' ),
				"shortcode_medium"			=> __( 'Medium', 'tie' ),
				"shortcode_big"				=> __( 'Big', 'tie' ),
				"shortcode_link"			=> __( 'Link:', 'tie' ),
				"shortcode_text"			=> __( 'Text:', 'tie' ),
				"shortcode_icon"			=> __( 'Icon (use full Font Awesome name):', 'tie' ),
				"shortcode_new_window"		=> __( 'Open link in a new window/tab', 'tie' ),
				"shortcode_tabs"			=> __( 'Tabs', 'tie' ),
				"shortcode_tab_title1"		=> __( 'Tab 1 Title', 'tie' ),
				"shortcode_tab_title2"		=> __( 'Tab 2 Title', 'tie' ),
				"shortcode_tab_title3"		=> __( 'Tab 3 Title', 'tie' ),
				"shortcode_tab_content1"	=> __( 'Tab 1 | Your Content', 'tie' ),
				"shortcode_tab_content2"	=> __( 'Tab 2 | Your Content', 'tie' ),
				"shortcode_tab_content3"	=> __( 'Tab 3 | Your Content', 'tie' ),
				"shortcode_slide1"			=> __( 'Slide 1 | Your Content', 'tie' ),
				"shortcode_slide2"			=> __( 'Slide 2 | Your Content', 'tie' ),
				"shortcode_slide3"			=> __( 'Slide 3 | Your Content', 'tie' ),
				"shortcode_vertical"		=> __( 'Vertical', 'tie' ),
				"shortcode_horizontal"		=> __( 'Horizontal', 'tie' ),
				"shortcode_toggle"			=> __( 'Toggle Box', 'tie' ),
				"shortcode_title"			=> __( 'Title:', 'tie' ),
				"shortcode_state"			=> __( 'State:', 'tie' ),
				"shortcode_opened"			=> __( 'Opened', 'tie' ),
				"shortcode_closed"			=> __( 'Closed', 'tie' ),
				"shortcode_slideshow"		=> __( 'Content Slideshow', 'tie' ),
				"shortcode_bio"				=> __( 'Author Bio', 'tie' ),
				"shortcode_avatar"			=> __( 'Author Image URL:', 'tie' ),
				"shortcode_flickr"			=> __( 'Flickr', 'tie' ),
				"shortcode_add_flickr"		=> __( 'Add photos from Flickr', 'tie' ),
				"shortcode_flickr_id"		=> __( 'Account ID : ( get it from http://idgettr.com )', 'tie' ),
				"shortcode_flickr_num"		=> __( 'Number of photos', 'tie' ),
				"shortcode_sorting"			=> __( 'Sorting:', 'tie' ),
				"shortcode_recent"			=> __( 'Recent', 'tie' ),
				"shortcode_random"			=> __( 'Random', 'tie' ),
				"shortcode_feed"			=> __( 'Display Feeds', 'tie' ),
				"shortcode_feed_url"		=> __( 'URL of the RSS feed:', 'tie' ),
				"shortcode_feeds_num"		=> __( 'Number of Feeds:', 'tie' ),
				"shortcode_map"				=> __( 'Google Maps', 'tie' ),
				"shortcode_map_url"			=> __( 'Google Maps URL', 'tie' ),
				"shortcode_height"			=> __( 'Height:', 'tie' ),
				"shortcode_video"			=> __( 'Video', 'tie' ),
				"shortcode_video_url"		=> __( 'Video URL:', 'tie' ),
				"shortcode_audio"			=> __( 'Audio', 'tie' ),
				"shortcode_mp3"				=> __( 'MP3 file URL', 'tie' ),
				"shortcode_m4a"				=> __( 'M4A file URL', 'tie' ),
				"shortcode_ogg"				=> __( 'OGG file URL', 'tie' ),
				"shortcode_lightbox"		=> __( 'Lightbox', 'tie' ),
				"shortcode_lightbox_url"	=> __( 'Full Image or YouTube / Vimeo Video URL', 'tie' ),
				"shortcode_tooltip"			=> __( 'ToolTip', 'tie' ),
				"shortcode_direction"		=> __( 'Direction:', 'tie' ),
				"shortcode_northwest"		=> __( 'Northwest', 'tie' ),
				"shortcode_north"			=> __( 'North', 'tie' ),
				"shortcode_northeast"		=> __( 'Northeast', 'tie' ),
				"shortcode_west"			=> __( 'West', 'tie' ),
				"shortcode_east"			=> __( 'East', 'tie' ),
				"shortcode_southwest"		=> __( 'Southwest', 'tie' ),
				"shortcode_south"			=> __( 'South', 'tie' ),
				"shortcode_southeast"		=> __( 'Southeast', 'tie' ),
				"shortcode_share"			=> __( 'Share Buttons', 'tie' ),
				"shortcode_facebook"		=> __( 'Facebook Like Button', 'tie' ),
				"shortcode_tweet"			=> __( 'Tweet Button', 'tie' ),
				"shortcode_digg"			=> __( 'Digg Button', 'tie' ),
				"shortcode_stumble"			=> __( 'Stumble Button', 'tie' ),
				"shortcode_google"			=> __( 'Google+ Button', 'tie' ),
				"shortcode_pinterest"		=> __( 'Pinterest Button', 'tie' ),
				"shortcode_follow"			=> __( 'Twitter Follow Button', 'tie' ),
				"shortcode_username"		=> __( 'Twitter Username', 'tie' ),
				"shortcode_dropcap"			=> __( 'Dropcap', 'tie' ),
				"shortcode_highlight"		=> __( 'Highlight Text', 'tie' ),
				"shortcode_padding"			=> __( 'Padding', 'tie' ),
				"shortcode_padding_right"	=> __( 'Padding right', 'tie' ),
				"shortcode_padding_left"	=> __( 'Padding Left', 'tie' ),
				"shortcode_divider"			=> __( 'Divider Line', 'tie' ),
				"shortcode_solid"			=> __( 'Solid', 'tie' ),
				"shortcode_dashed"			=> __( 'Dashed', 'tie' ),
				"shortcode_normal"			=> __( 'Normal', 'tie' ),
				"shortcode_double"			=> __( 'Double', 'tie' ),
				"shortcode_dotted"			=> __( 'Dotted', 'tie' ),
				"shortcode_margin_top"		=> __( 'Margin Top:', 'tie' ),
				"shortcode_margin_bottom"	=> __( 'Margin Bottom:', 'tie' ),
				"shortcode_lists"			=> __( 'Lists', 'tie' ),
				"shortcode_star"			=> __( 'Star', 'tie' ),
				"shortcode_check"			=> __( 'Check', 'tie' ),
				"shortcode_thumb_up"		=> __( 'Thumb Up', 'tie' ),
				"shortcode_thumb_down"		=> __( 'Thumb Down', 'tie' ),
				"shortcode_plus"			=> __( 'Plus', 'tie' ),
				"shortcode_minus"			=> __( 'Minus', 'tie' ),
				"shortcode_heart"			=> __( 'Heart', 'tie' ),
				"shortcode_light_bulb"		=> __( 'Light Bulb', 'tie' ),
				"shortcode_cons"			=> __( 'Cons', 'tie' ),
				"shortcode_ads"				=> __( 'Ads', 'tie' ),
				"shortcode_ads1"			=> __( 'Ads Shortcode 1', 'tie' ),
				"shortcode_ads2"			=> __( 'Ads Shortcode 2', 'tie' ),
				"shortcode_Restrict"		=> __( 'Restrict Content', 'tie' ),
				"shortcode_registered"		=> __( 'For Registered Users only', 'tie' ),
				"shortcode_guests"			=> __( 'For Guests only', 'tie' ),
				"shortcode_columns"			=> __( 'Columns', 'tie' ),
				"shortcode_add_content"		=> __( 'Add content here', 'tie' ),
				"shortcode_full_img"		=> __( 'Full Width Image', 'tie' ),
 			);
			wp_localize_script( 'tie-admin-main', 'tieLang', $tie_lang );

		}elseif( $pagenow == "nav-menus.php" ){

			wp_enqueue_script( 'tie-admin-icon-picker');
			wp_enqueue_style ( 'tie-fontawesome' );

			$tie_lang = array(
				"update"					=> __( 'Update', 'tie' ),
				"search"					=> __( 'Search', 'tie' )
			);
			wp_localize_script( 'tie-admin-main', 'tieLang', $tie_lang );

		}else{
			$tie_lang = array(
				"update"					=> __( 'Update', 'tie' )
			);
			wp_localize_script( 'tie-admin-main', 'tieLang', $tie_lang );
		}

		wp_enqueue_script( 'tie-admin-main' );
		wp_enqueue_style( 'tie-style' );
		wp_enqueue_style( 'tie-fonts' );
	}
	add_action( 'admin_enqueue_scripts', 'tie_admin_register' );


	// INSTALL THE THEME
	global $pagenow;
	if ( isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
		add_action( 'init', 'tie_install_theme', 1 );
	}

	function tie_install_theme() {
		global $default_data;

		if( !get_option('tie_active') ){
			tie_save_settings( $default_data );
			update_option( 'tie_active' , THEME_VER );
		}

		/*if( !get_option('tie_date') ){
			update_option( 'tie_date' , THEME_VER );
		}*/

		//WOOCOMMERCE
		$catalog = array(
			'width' 	=> '450',	// px
			'height'	=> '600',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '800',	// px
			'height'	=> '1000',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '200',	// px
			'height'	=> '200',	// px
			'crop'		=> 1 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', 	$catalog ); 	// Product category thumbs
		update_option( 'shop_single_image_size',	$single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}

}

//DEFAULT OPTIONS
$default_data = Array(
	"tie_options"	=> Array(
		'theme_layout' 				=> 		'boxed',
		'time_format' 				=> 		'modern',

		'lightbox_all' 				=> 		true,
		'lightbox_gallery' 			=> 		true,

		'breadcrumbs' 				=> 		true,
		'breadcrumbs_delimiter' 	=> 		'/',

		'logo_setting' 				=> 		'logo',
		'logo_margin' 				=> 		'15',
		'logo_margin_bottom'		=> 		'15',

		'top_menu'					=>		true,
		'main_nav'					=>		true,
		'todaydate_format' 			=> 		'l , F j Y',
		'top_search' 				=> 		true,
		'live_search' 				=> 		true,
		'top_social' 				=> 		true,
		'stick_nav' 				=> 		true,
		'random_article' 			=> 		true,

		'mobile_menu_hide_icons'	=>		true,
		'mobile_menu_active'		=>		true,
		'mobile_menu_search'		=>		true,
		'mobile_menu_social'		=>		true,

		'breaking_news' 			=> 		true,
		'breaking_type' 			=> 		'category',
		'breaking_cat' 				=> 		'1',
		'breaking_number' 			=> 		'10',
		'breaking_effect' 			=> 		'fade',
		'breaking_speed'			=> 		'750',
		'breaking_time' 			=> 		'3500',

		'exc_length' 				=> 		'50',
		'arc_meta_score'			=>		true,
		'arc_meta_date'				=>		true,
		'arc_meta_comments'			=>		true,
		'arc_meta_cats'				=>		true,
		'category_desc' 			=> 		true,
		'category_rss' 				=> 		true,
		'tag_rss' 					=> 		true,
		'author_bio' 				=> 		true,
		'author_rss' 				=> 		true,

		'post_og_cards'				=>		true,
		'post_authorbio' 			=> 		true,
		'post_nav' 					=> 		true,
		'post_meta' 				=> 		true,
		'post_author' 				=> 		true,
		'post_date' 				=> 		true,
		'post_cats' 				=> 		true,
		'post_comments' 			=> 		true,
		'post_views' 				=> 		true,
		'post_tags' 				=> 		true,

		'rss_icon'					=>		true,

		'share_post' 				=> 		true,
		'share_buttons_pages'		=> 		true,
		'share_post_type' 			=> 		'flat',
		'share_shortlink' 			=> 		true,
		'share_tweet' 				=> 		true,
		'share_facebook' 			=> 		true,
		'share_google' 				=> 		true,
		'share_linkdin'				=> 		true,
		'share_stumble' 			=> 		true,
		'share_pinterest' 			=> 		true,

		'related' 					=> 		true,
		'related_number' 			=> 		'3',
		'related_number_full' 		=> 		'4',
		'related_query' 			=> 		'category',

		'check_also' 				=> 		true,
		'check_also_position' 		=> 		'right',
		'check_also_number' 		=> 		'1',
		'check_also_query' 			=> 		'category',

		'sidebar_pos' 				=> 		'right',
		'sticky_sidebar' 			=> 		true,
		'footer_top' 				=> 		true,
		'footer_social' 			=> 		true,
		'footer_widgets_enable' 	=> 		true,
		'footer_widgets' 			=> 		'footer-3c',
		'footer_one' 				=> 		'&#169; Copyright %year%, All Rights Reserved',
		'footer_two' 				=> 		'Powered by <a href="http://wordpress.org">WordPress</a> | Designed by <a href="http://tielabs.com/">TieLabs</a>',

		'homepage_cats_colors'		=>		true,
		'lazy_load'					=>		true,
		'smoth_scroll'				=>		true,

		'background_type' 			=> 		'pattern',

		'notify_theme' 				=> 		true,
	)
);

/*-----------------------------------------------------------------------------------*/
# Custom Admin Bar Menus
/*-----------------------------------------------------------------------------------*/
function tie_admin_bar() {
	global $wp_admin_bar;

	if ( current_user_can( 'switch_themes' ) ){
		$wp_admin_bar->add_menu( array(
			'parent' => 0,
			'id' => 'mpanel_page',
			'title' => THEME_NAME ,
			'href' => admin_url( 'admin.php?page=panel')
		) );
	}
}
add_action( 'wp_before_admin_bar_render', 'tie_admin_bar' );

// IMPORTER
add_action( 'import_done', 'wordpress_importer_init' );


?>
