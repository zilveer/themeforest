<?php 

	/* ------------------------------------
	:: EXTRA SCRIPTS
	------------------------------------ */	

	function init_extrascripts()
	{
		wp_register_style('font-awesome', get_template_directory_uri().'/stylesheets/font-icons/css/font-awesome.min.css',false,null);
		wp_register_style('font-awesome-social', get_template_directory_uri().'/stylesheets/font-icons/css/font-awesome-social.css',false,null);
		wp_enqueue_style('font-awesome');	
		wp_enqueue_style('font-awesome-social');	
				
		if ( !is_admin() )
		{
			if( of_get_option('sticky_menu') != 'disable' )
			{
				wp_register_script('waypoints', get_template_directory_uri().'/js/waypoints.min.js', array('jquery'), true );
				wp_enqueue_script('waypoints');
	
				wp_register_script('waypoints-sticky', get_template_directory_uri().'/js/waypoints-sticky.min.js',array('jquery','waypoints'),true);
				wp_enqueue_script('waypoints-sticky');
			}

			wp_deregister_script('jquery-reflection');	
			wp_register_script('jquery-reflection', get_template_directory_uri().'/js/jquery.reflection.js',false,array('jquery'),true);
			wp_enqueue_script('jquery-reflection');
		}
	}    


	add_action('wp_enqueue_scripts', 'init_extrascripts',101);	


	/*	Remove WP auto formatting */
	function remove_wpautop( $content )
	{ 
		$content = do_shortcode( shortcode_unautop( $content ) ); 
	
		$new_content = preg_replace( '#^<\/p>|^<br \/>|<p>$#', '', $content );
		$new_content = str_replace('<br />', "", $new_content);
		return $new_content;
	}

	/* ------------------------------------
	:: OPTIONS UPDATE
	------------------------------------ */
	
	update_option( 'themeva_theme', 'DynamiX' );
	
	// Update 5.0 Customizer Options
	if( get_option( 'dynamix_theme' ) != '5' )
	{
		$theme_options = get_option( 'themeva' );
		
		if( get_option('header_height') != '' )
		{
			$theme_options[ 'header_height' ] = get_option('header_height');
		}
	
		if( get_option('branding_disable') != '' )
		{
			$theme_options[ 'branding_disable' ] = get_option('branding_disable');
		}	

		if( get_option('branding_alignment') != '' )
		{
			$theme_options[ 'branding_alignment' ] = get_option('branding_disable');
		}			

		if( get_option('branding_margin') != '' )
		{
			$theme_options[ 'branding_margin' ] = get_option('branding_margin');
		}

		if( get_option('menu_alignment') != '' )
		{
			$theme_options[ 'menu_alignment' ] = get_option('menu_alignment');
		}	

		if( get_option('menu_margin') != '' )
		{
			$theme_options[ 'menu_margin' ] = get_option('menu_margin');
		}							
	
		update_option( 'themeva', $theme_options );	
		update_option( 'dynamix_theme', '5' );
	}
	
	
				
	/* ------------------------------------
	:: BUILD SKIN PRESETS + CUSTOMIZER
	------------------------------------ */

	build_skinpresets();
	require_once NV_FILES .'/adm/inc/theme-customizer.php';		
	

	/* ------------------------------------
	:: SIDEKICK
	------------------------------------ */

	define('SK_SUBSCRIPTION_ID',1695);
	define('SK_ENVATO_PARTNER', 'IdiBEpP9oju01Fd+NhFzBLZBIamiWGdVCS4v5poYSOo=');
	define('SK_ENVATO_SECRET', 'RqjBt/YyaTOjDq+lKLWhL10sFCMCJciT9SPUKLBBmso=');	

	/* ------------------------------------
	:: TGM PLUGIN ACTIVATION
	------------------------------------ */

	require_once NV_FILES . '/adm/inc/class-tgm-plugin-activation.php';
	
	add_action( 'tgmpa_register', 'themeva_register_required_plugins',999 );

	function themeva_register_required_plugins() {		
	 
		/**
		 * Array of plugin arrays. Required keys are name, slug and required.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
	 

			array(
				'name'                  => 'Revolution Slider', // The plugin name
				'slug'                  => 'revslider', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri() . '/plugins/revslider.zip', // The plugin source
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '5.2.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'                  => 'Visual Composer', // The plugin name
				'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri() . '/plugins/js_composer.zip', // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '4.11.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),						
			array(
				'name'                  => 'Contact Form 7', // The plugin name
				'slug'                  => 'contact-form-7', // The plugin slug (typically the folder name)
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),	
			array(
				'name'                  => 'Sidekick', // The plugin name
				'slug'                  => 'sidekick', // The plugin slug (typically the folder name)
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => '', // If set, overrides default API URL and points to an external URL
			),									
		);
	 
	
		$config = array(
			'domain'            => 'themeva',           // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                           // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',         // Default parent menu slug
			'parent_url_slug'   => 'themes.php',         // Default parent URL slug
			'menu'              => 'install-required-plugins',   // Menu slug
			'has_notices'       => true,                         // Show admin notices or not
			'is_automatic'      => true,            // Automatically activate plugins after installation or not
			'message'           => '',               // Message to output right before the plugins table
			'strings'           => array(
				'page_title'                                => __( 'Install Required Plugins', 'themeva-admin' ),
				'menu_title'                                => __( 'Install Plugins', 'themeva-admin' ),
				'installing'                                => __( 'Installing Plugin: %s', 'themeva-admin' ), // %1$s = plugin name
				'oops'                                      => __( 'Something went wrong with the plugin API.', 'themeva-admin' ),
				'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin:<span class="highlight-admin-text">%1$s</span>.', 'This theme requires the following plugins: <span class="highlight-admin-text">%1$s</span>.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin:<span class="highlight-admin-text">%1$s</span>.', 'This theme recommends the following plugins: <span class="highlight-admin-text">%1$s</span>.' ), // %1$s = plugin name(s)
				'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: <span class="highlight-admin-text">%1$s</span>.', 'The following required plugins are currently inactive: <span class="highlight-admin-text">%1$s</span>.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: <span class="highlight-admin-text">%1$s</span>.', 'The following recommended plugins are currently inactive: <span class="highlight-admin-text">%1$s</span>.' ), // %1$s = plugin name(s)
				'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update'                      => _n_noop( 'The following plugin <span class="highlight-admin-text">needs to be updated</span> to its latest version to ensure maximum compatibility with this theme: <span class="highlight-admin-text">%1$s</span>.<p></p>For a guide on <a href="http://help.themeva.com/theme-issues/" target="_blank">how to upgrade</a> the plugin see this page <a href="http://help.themeva.com/theme-issues/" target="_blank">here</a>.', 'The following plugin <span class="highlight-admin-text">needs to be updated</span> to its latest version to ensure maximum compatibility with this theme: <span class="highlight-admin-text">%1$s</span>.<p></p>For a guide on <a href="http://help.themeva.com/theme-issues/" target="_blank">how to upgrade</a> the plugin see this page <a href="http://help.themeva.com/theme-issues/" target="_blank">here</a>.' ), // %1$s = plugin name(s)
				'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                                    => __( 'Return to Required Plugins Installer', 'themeva-admin' ),
				'plugin_activated'                          => __( 'Plugin activated successfully.', 'themeva-admin' ),
				'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'themeva-admin' ) // %1$s = dashboard link
			)
		);
	 
		tgmpa( $plugins, $config );
	 
	}	

	if(function_exists('vc_set_as_theme'))
	{
		vc_set_as_theme($notifier = false);
	}
	
	// VC Columns
	function custom_css_classes_for_vc_row_and_vc_column($class_string, $tag)
	{
		if ($tag=='vc_row' || $tag=='vc_row_inner')
		{
			$class_string = str_replace('vc_row-fluid', 'row', $class_string);
		}
	  
		return $class_string;
	}

	// Filter to Replace default css class for vc_row shortcode and vc_column
	add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);	
	
	function filter_vc_updates( $value ) 
	{
		if( isset( $value->response['js_composer/js_composer.php'] ) )
		{
			unset( $value->response['js_composer/js_composer.php'] );		
		}
		return $value;
	}
	
	add_filter( 'site_transient_update_plugins', 'filter_vc_updates' );

	/* ------------------------------------
	:: EXTRA WIDGET AREA
	------------------------------------ */

	add_action( 'widgets_init', 'acoda_widgets_init' );
	
	function acoda_widgets_init() {

		// Header Panel		
		register_sidebar(
			array(
				'name' => 'Header Panel',
				'id' => 'headerpanel',
				'description' => __('Add widgets to appear within the header.','themeva-admin'),
				'before_title' => '<h3>',
				'after_title' => '</h3>',
			)
		);		
	
	}

	/* ------------------------------------
	:: WOOCOMMERCE CSS
	------------------------------------ */

	//define('WOOCOMMERCE_USE_CSS', false);

	function wp_enqueue_woocommerce_style()
	{
		if ( class_exists( 'woocommerce' ) )
		{
			wp_dequeue_style( 'woocommerce-general' );		
			wp_register_style( 'woocommerce-acoda', get_template_directory_uri() . '/stylesheets/woocommerce.css' );	
			wp_enqueue_style( 'woocommerce-acoda' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'wp_enqueue_woocommerce_style' );


	/* ------------------------------------
	:: bbPress
	------------------------------------ */

	add_theme_support( 'bbpress' );
	

	function wp_enqueue_bbpress_style()
	{
		if ( class_exists( 'bbPress' ) )
		{
			wp_dequeue_style( 'bbp-default' );	
			wp_dequeue_style( 'bbp_private_replies_style' );	
			wp_enqueue_style( 'bbp-acoda-bbpress', get_stylesheet_directory_uri() . '/stylesheets/bbpress.css',false,null);
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'wp_enqueue_bbpress_style', 1000 );	
	
	// Breadcrumb Separator
	function acoda_bbp_breadcrumb_separator()
	{
		$sep = ' <span class="subbreak">/</span> ';
		return $sep;
	}
	
	add_filter('bbp_breadcrumb_separator', 'acoda_bbp_breadcrumb_separator');

	// Blank Function
	add_filter( 'bbp_get_single_forum_description', 'acoda_bbp_return_blank' );
	add_filter( 'bbp_get_single_topic_description', 'acoda_bbp_return_blank' );
		
	function acoda_bbp_return_blank()
	{
		return '';
	}
	
	// Subscribe Link
	function bbp_acoda_subscribe_icon ( $args = array() )
	{
		$args['before'] = '';
		$args['subscribe'] = __( '<i class="fa fa-envelope-o"></i>Subscribe',  'bbpress' );
		$args['unsubscribe'] = __( '<i class="fa fa-envelope"></i>Unsubscribe',  'bbpress' );		
		
		return $args;
	}

	add_filter ('bbp_before_get_user_subscribe_link_parse_args','bbp_acoda_subscribe_icon') ;

	// Favorite Link
	function bbp_acoda_favorite_icon ( $args = array() )
	{
		$args['before'] = '';
		$args['favorite'] = __( '<i class="fa fa-star-o"></i>Favorite',  'bbpress' );
		$args['favorited'] = __( '<i class="fa fa-star"></i>Favorited',  'bbpress' );
		
		return $args;
	}

	add_filter ('bbp_before_get_user_favorites_link_parse_args','bbp_acoda_favorite_icon') ;	

	// Admin Links
	function bbp_topic_admin_link( $args = array() )
	{
		$args['sep'] = '';		
		
		return $args;
	}
	
	add_filter( 'bbp_before_get_topic_admin_links_parse_args', 'bbp_topic_admin_link' );	

	// Admin Links
	function bbp_reply_admin_link( $args = array() )
	{
		$args['sep'] = '';		
		
		return $args;
	}
	
	add_filter( 'bbp_before_get_reply_admin_links_parse_args', 'bbp_reply_admin_link' );	

	// Tags
	function bbp_tags_icon( $args = array() )
	{
		$args['before'] = '<div class="bbp-topic-tags"><p><i class="fa fa-tag"></i>&nbsp;';		
		
		return $args;
	}
	
	add_filter( 'bbp_before_get_topic_tag_list_parse_args', 'bbp_tags_icon' );				

	/* ------------------------------------
	:: FONT LISTS
	------------------------------------ */

	// Cufon Font List
	global $themeva_cufonfont;
	
	$themeva_cufonfont = array(
		'aller' => 'aller',
		'andika' => 'andika',
		'bebas-neue' => 'bebas-neue',
		'colaborate' => 'colaborate',
		'daniel' => 'daniel',
		'deftone-stylus' => 'deftone-stylus',
		'droid-serif' => 'droid-serif',
		'geo-sans' => 'geo-sans',
		'harabara' => 'harabara',
		'josefin-sans' => 'josefin-sans',
		'league-gothic' => 'league-gothic',
		'lucida-sans' => 'lucida-sans',
		'miso' => 'miso',
		'molot' => 'molot',
		'museo' => 'museo',
		'myriad-pro' => 'myriad-pro',
		'pt-sans' => 'pt-sans',
		'quicksand' => 'quicksand',
		'sansation' => 'sansation',
		'vegur' => 'vegur',
		'yanone-kaffeesatz' => 'yanone-kaffeesatz'
	); 


	if( of_get_option('cufon_font') ) 
	{ 
		$customcufon=array('custom-cufon-font' => of_get_option('cufon_font'));
		$themeva_cufonfont = array_merge((array)$themeva_cufonfont, (array)$customcufon); // Add custom cufon font to main cufon list
	}

	// Standard Font List
	global $nv_font;
	
	$nv_font = array(
		'Lucida Grande' => '"Lucida Grande", "Lucida Sans Unicode", Arial, Verdana, sans-serif',
		'Cambria' => 'Cambria, "Hoefler Text", Utopia, "Liberation Serif", "Nimbus Roman No9 L Regular", Times, "Times New Roman", serif',
		'Constantia' => 'Constantia, "Lucida Bright", Lucidabright, "Lucida Serif", Lucida, "DejaVu Serif", "Bitstream Vera Serif", "Liberation Serif", Georgia, serif',
		'Palatino Linotype' => '"Palatino Linotype", Palatino, Palladio, "URW Palladio L", "Book Antiqua", Baskerville, "Bookman Old Style", "Bitstream Charter", "Nimbus Roman No9 L", Garamond, "Apple Garamond", "ITC Garamond Narrow", "New Century Schoolbook", "Century Schoolbook", "Century Schoolbook L", Georgia, serif',
		'Helvetica Neue' => '"Helvetica Neue", Helvetica, Arial, serif',
		'Frutiger' => 'Frutiger, "Frutiger Linotype", Univers, Calibri, "Gill Sans", "Gill Sans MT", "Myriad Pro", Myriad, "DejaVu Sans Condensed", "Liberation Sans", "Nimbus Sans L", Tahoma, Geneva, "Helvetica Neue", Helvetica, Arial, sans-serif',
		'Corbel' => 'Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif',
		'Segoe UI' => '"Segoe UI", Candara, "Bitstream Vera Sans", "DejaVu Sans", "Bitstream Vera Sans", "Trebuchet MS", Verdana, "Verdana Ref", sans-serif',
		'Impact' => 'Impact, Haettenschweiler, "Franklin Gothic Bold", Charcoal, "Helvetica Inserat", "Bitstream Vera Sans Bold", "Arial Black", sans-serif',
		'Consolas' => 'Consolas, "Andale Mono WT", "Andale Mono", "Lucida Console", "Lucida Sans Typewriter", "DejaVu Sans Mono", "Bitstream Vera Sans Mono", "Liberation Mono", "Nimbus Mono L", Monaco, "Courier New", Courier, monospace'
	); 

	
	// Google Font List
	global $themeva_googlefont;
	
	$themeva_googlefont = array(
		'"Abril Fatface"'=>'"Abril Fatface"',
		'"Allan"' => '"Allan:700"',
		'Allerta' => 'Allerta',
		'Arvo' => 'Arvo:700,400',
		'Cabin' => 'Cabin',
		'Cardo' => 'Cardo:700,400',
		'Corben' => 'Corben:700,400',
		'"Crimson Text"' => 'Crimson Text:700,400',
		'"Dancing Script"' => 'Dancing Script',
		'Domine' => 'Domine:400,700',
		'"Droid Sans"' => 'Droid Sans:700,400',
		'"Droid Serif"' => 'Droid Serif:700,400',
		'"Goudy Bookletter 1911"' => 'Goudy Bookletter 1911',
		'"Josefin Sans"' => 'Josefin Sans:100,400',
		'Lato' => 'Lato:300,700',
		'Lekton' => 'Lekton:700,400',
		'Lobster' =>'Lobster',
		'Molengo' => 'Molengo',
		'Montserrat' => 'Montserrat:400,700',
		'Nobile' => 'Nobile:700,400',
		'"Open Sans"' => 'Open Sans:400,300',
		'Oswald' => 'Oswald:300,700',
		'Playfair Display' => 'Playfair Display:400,900',
		'"Poiret One"' => 'Poiret One',
		'"PT Sans"' => 'PT Sans:400,700',
		'Quicksand' => 'Quicksand:400,300,700',
		'Raleway' => 'Raleway:200,500',
		'Roboto Condensed' => 'Roboto Condensed:300',
		'Roboto' => 'Roboto:400,700,300',
		'Ubuntu' => 'Ubuntu:700,400',
		'Vollkorn' => 'Vollkorn:400,700'
	); 

	if( of_get_option('googlefont_url_1') && of_get_option('googlefont_css_1') )
	{ 
		$fontcss = str_replace("'", '"',of_get_option('googlefont_css_1')); // replace ' with "
		$customgoogle=array($fontcss => of_get_option('googlefont_url_1'));
		$themeva_googlefont = array_merge((array)$themeva_googlefont, (array)$customgoogle); // Add custom google font (one) to main google list
	}

	if( of_get_option('googlefont_url_2') && of_get_option('googlefont_css_2') )
	{ 
		$fontcss = str_replace("'", '"',of_get_option('googlefont_css_2')); // replace " with blank
		$customgoogle=array($fontcss => of_get_option('googlefont_url_2'));
		$themeva_googlefont = array_merge((array)$themeva_googlefont, (array)$customgoogle); // Add custom google font (two) to main google list
	}


	/* ------------------------------------
	:: GET SLIDER FRAME PATHS
	------------------------------------ */

	function get_slider_frame( $NV_show_slider )
	{
		if(	$NV_show_slider == 'stageslider' || 
			$NV_show_slider == 'islider' ||
			$NV_show_slider == 'nivo'|| 
			$NV_show_slider == 'carousel' )
		{
			$frame = NV_FILES .'/inc/stage-gallery-frame.php'; // STAGE, iSLIDER, NIVO
		}
		elseif( $NV_show_slider == 'gridgallery' )
		{
			$frame = NV_FILES .'/inc/grid-gallery-frame.php'; // GRID
		}
		elseif( $NV_show_slider == 'groupslider' )
		{
			$frame = NV_FILES .'/inc/group-gallery-frame.php'; // GROUP SLIDER
		}
		elseif( $NV_show_slider == 'galleryaccordion' )
		{
			$frame = NV_FILES .'/inc/accordion-gallery-frame.php'; // ACCORDION
		}
		elseif( $NV_show_slider == 'gallery3d' )
		{
			$frame = NV_FILES .'/inc/piecemaker-frame.php'; // 3d
		}
		
		return $frame;	
	}

	/* ------------------------------------
	:: READ MORE
	------------------------------------ */
	
	function themeva_readmore( $exturl = '' )
	{
		$url = ( $exturl !='' ) ? $url = $exturl : $url = get_permalink();
		
		return '<p><a class="read-more" href="'. $url .'">'. __( 'Read more  &rarr;', 'themeva' )  .'</a></p>';
	}

	/* ------------------------------------
	:: CONTACT FORM
	------------------------------------ */

	function contact_form($id,$title,$desc,$adminemail,$msg)
	{
		if( empty($adminemail) ) $adminemail=get_option("admin_email");
		
		$adminemail=str_replace('@','#',$adminemail);	
	
	?>
	
	<script type='text/javascript'>
	
		(function ($) 
		{
			$(document).ready(function()
			{
				$('#<?php echo $id; ?>contactform input').focus(function()
				{
					$(this).removeClass('fielderror');
				});
				
				$('#<?php echo $id; ?>contactform textarea').focus(function() {
					$(this).removeClass('fielderror');
				});
				
				$("#<?php echo $id; ?>contactform #<?php echo $id; ?>submit").click(function(){
			
			
					var subjectVal 	 = $("#<?php echo $id; ?>subject").val(),
						messageVal 	 = $("#<?php echo $id; ?>message").val(),
						nameVal 	 = $("#<?php echo $id; ?>name").val(),
						hasError 	 = false,
						email_regex  = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/,
						emailToVal	 = $("#<?php echo $id; ?>emailTo").val(),
						emailFromVal = $("#<?php echo $id; ?>emailFrom").val().toLowerCase();	
			
					$("#<?php echo $id; ?>contactform_wrap .error").slideUp();
			
					emailToVal=emailToVal.replace('#','@');
			
					if(emailToVal == '')
					{
						$("#<?php echo $id; ?>emailTo").addClass('fielderror');
						hasError = true;
					} 
					else if( !email_regex.test(emailToVal) )
					{
						$("#<?php echo $id; ?>emailTo").addClass('fielderror');
						hasError = true;
					}
			
					if(emailFromVal == '')
					{
						$("#<?php echo $id; ?>emailFrom").addClass('fielderror');
						hasError = true;
					} 
					else if( !email_regex.test(emailFromVal) )
					{
						$("#<?php echo $id; ?>emailFrom").addClass('fielderror');
						hasError = true;
					}
			
			
					if(messageVal == '') 
					{
						$("#<?php echo $id; ?>message").addClass('fielderror');
						hasError = true;
					}
			
			  
					if(nameVal == '')
					{
						$("#<?php echo $id; ?>name").addClass('fielderror');
						hasError = true;
					}
			  
			
					if(hasError == false)
					{
						
						$.post('<?php echo get_template_directory_uri().'/lib/inc/contact-send.php' ?>',$("#<?php echo $id; ?>contactform").serialize(),function(data)
						{
							$("#<?php echo $id; ?>contactform_wrap .error").slideUp();		
							$('#<?php echo $id; ?>contactform .field').val('');
							$("#<?php echo $id; ?>contactform_wrap .success").slideDown(function()
							{
								$(this).delay(5000).slideUp('slow');	
							});
						});
					
					} 
					else if(hasError == true)
					{
						$("#<?php echo $id; ?>contactform_wrap .error").slideDown();
					}
			
					return false;
				});
			}); 
		})(jQuery);
	
	</script>
	
	<div id="<?php echo $id; ?>contactform_wrap" class="contactform_wrap">
		<div class="success">
            <h3><?php _e('Thanks!', 'themeva' ); ?></h3>
            <p><?php if($msg) { echo $msg; } else { _e('Your email was successfully sent. Your enquiry will be dealt with as soon as possible.', 'themeva' ); } ?></p>
            </div>
            <div class="error">
                 <p><span class="email-error"></span> <?php _e('Required fields not completed correctly.', 'themeva' ); ?></p>
		</div>
        
		<form action="#" id="<?php echo $id; ?>contactform" class="contactform" method="post">
			<ol class="forms">	
				<li><input type="text" name="<?php echo $id; ?>name" id="<?php echo $id; ?>name" value="" class="field" />
				<label for="<?php echo $id; ?>name"><small><?php _e('Name', 'themeva' ); ?> <span class="required">*</span></small></label></li>
				<li><input type="text" name="<?php echo $id; ?>emailFrom" id="<?php echo $id; ?>emailFrom" value="" class="field" />
				<label for="<?php echo $id; ?>emailFrom"><small><?php _e('Email', 'themeva' ) ?> <span class="required">*</span></small></label></li>        
				<li><textarea name="<?php echo $id; ?>message" id="<?php echo $id; ?>message" class="field"></textarea></li>
				<li><input type="text" name="<?php echo $id; ?>siteURL" id="<?php echo $id; ?>siteURL" value="" class="hfield" /></li>
				<li><button type="submit" id="<?php echo $id; ?>submit"><?php _e('Submit', 'themeva' ); ?></button></li>
				<li><input type="hidden" name="<?php echo $id; ?>subject" id="<?php echo $id; ?>subject" value="<?php _e('Contact Form Submission from ', 'themeva' ); ?>" />
				<input type="hidden" name="<?php echo $id; ?>emailTo" id="<?php echo $id; ?>emailTo" value="<?php echo $adminemail; ?>" />
				<input type="hidden" name="<?php echo $id; ?>fields" id="<?php echo $id; ?>fields" value="<?php echo get_option('blogname');?>|<?php _e('Name', 'themeva' ); ?>|<?php _e('Email', 'themeva' ); ?>|<?php _e('Comments', 'themeva' ); ?>" />
				<input type="hidden" name="form_id" value="<?php echo $id; ?>" /></li>
			</ol>
		</form>
	</div>
	<?php 
	} 

	// HEX TO RGB
	function nv_html2rgb($color)
	{
		if ($color[0] == '#')
			$color = substr($color, 1);
	
		if (strlen($color) == 6)
			list($r, $g, $b) = array($color[0].$color[1],
									 $color[2].$color[3],
									 $color[4].$color[5]);
		elseif (strlen($color) == 3)
			list($r, $g, $b) = array($color[0].$color[0], $color[1].$color[1], $color[2].$color[2]);
		else
			return false;
	
		$r = hexdec($r); $g = hexdec($g); $b = hexdec($b);
	
		return $r.','.$g.','.$b;
	}


	// SOCIAL LINK CONVERSION
	function getsociallink($socialitem)
	{ 
		$permalink = '';
		
		if( is_page() || is_single() ) {
		$permalink = get_permalink();
		}
		elseif( is_category() )
		{
		$category = get_the_category();
		$permalink = get_category_link( $category[0] );
		}

		$title = get_the_title();
		$url = home_url('url');
	
		$find = array('[get_permalink]','[get_the_title]','[get_blogurl]');
		$replace = array($permalink,$title,$url);
		$socialitem = str_replace($find,$replace, $socialitem);
	
		return htmlspecialchars ( $socialitem );
	}

	/* ------------------------------------
	:: SKIN SETTINGS
	------------------------------------ */
	
	function setlayer( $layer, $setvalue, $skin)
	{
		$layersettings = $output = $primary_background = ''; // reset
		if( empty( $z ) ) $z = '';
		 
		// Get the skin data 
		$get_skin_data = maybe_unserialize(get_option('skin_data_'.$skin));
		
		
		// COLOR background layer
		if( $setvalue == $layer.'_color' )
		{ 	
			$color_pri = ( isset( $get_skin_data['skin_id_'. $layer .'_pri_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_pri_color'] ) : '';
			$color_sec = ( isset( $get_skin_data['skin_id_'. $layer .'_sec_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_sec_color'] ) : '';	
		
			if( empty($color_sec) ) $color_sec = $color_pri;
		
			// Get RGB values
			$rgb_color_pri = nv_html2rgb($color_pri);
			$rgb_color_sec = nv_html2rgb($color_sec);
			
			// Primary Opacity
			$opacity_pri = ( !empty( $get_skin_data['skin_id_'. $layer .'_pri_opac'. $z] ) ) ? $get_skin_data['skin_id_'. $layer .'_pri_opac'. $z] : 100;

			// Secondary Opacity
			$opacity_sec = ( !empty( $get_skin_data['skin_id_'. $layer .'_sec_opac'. $z] ) ) ? $get_skin_data['skin_id_'. $layer .'_sec_opac'. $z] : $opacity_pri;			
			
			if( $opacity_pri == '100' ) $opacity_pri='1'; elseif( $opacity_pri == '.' ) $opacity_pri = '0'; elseif( $opacity_pri < '10' ) $opacity_pri = '0.1'.$opacity_pri; else $opacity_pri = '0.'.$opacity_pri; 

			
			if( $opacity_sec == '100' ) $opacity_sec = '1'; elseif( $opacity_sec == '.' ) $opacity_sec = '0'; elseif( $opacity_sec < '10' ) $opacity_sec = '0.1'.$opacity_sec; else $opacity_sec = '0.'.$opacity_sec; 
		 
			$ie_opacity_pri = $opacity_pri * 255;
			$ie_opacity_pri = dechex( $ie_opacity_pri );
			$ie_opacity_sec = $opacity_sec * 255;
			$ie_opacity_sec = dechex( $ie_opacity_sec );
		
			if( $ie_opacity_pri == '0' ) $ie_opacity_pri = '00';
			if( $ie_opacity_sec == '0' ) $ie_opacity_sec = '00';
						
				
			$layersettings.='
			background: rgb( '.$rgb_color_pri.' );
			background: rgba( '.$rgb_color_pri.',  '.$opacity_pri.');
			background-color: transparent;
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'. $ie_opacity_pri.$color_pri.' , endColorstr=#'.$ie_opacity_sec.$color_sec.');
			-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$ie_opacity_pri.$color_pri.' , endColorstr=#'.$ie_opacity_sec.$color_sec.')";
			background: linear-gradient(to bottom, rgba( '.$rgb_color_pri.','. $opacity_pri.'), rgba( '.$rgb_color_sec.','. $opacity_sec.') );
			background: -o-linear-gradient(top,rgba('.$rgb_color_pri.','.$opacity_pri.'), rgba( '.$rgb_color_sec.','. $opacity_sec.'));
			background: -moz-linear-gradient(100% 100% 90deg, rgba( '.$rgb_color_sec.','. $opacity_sec.'), rgba( '.$rgb_color_pri.','. $opacity_pri.'));
			background: -webkit-gradient(linear, 0% 0%, 0% 90%, from(rgba( '.$rgb_color_pri.','.$opacity_pri.')), to(rgba( '.$rgb_color_sec.','. $opacity_sec.')));
			*background: transparent;
			zoom:1;';
		}
		
		// IMAGE FULL background layer
		if( $setvalue==$layer.'_imagefull' )
		{
			$imagefull_opac = ( isset( $get_skin_data['skin_id_'. $layer .'_imagefull_opac'] ) ) ? $get_skin_data['skin_id_'. $layer .'_imagefull_opac'] : '';
		
			// Image Opacity
			if( !empty($imagefull_opac) )
			{ 
				if( $imagefull_opac == '100' ) $imagefull_opac_dec = '1'; elseif( $imagefull_opac == '.' ) $imagefull_opac_dec = '0'; elseif( $imagefull_opac < '10' ) $imagefull_opac_dec = '.0'.$imagefull_opac; else $imagefull_opac_dec = '.'.$imagefull_opac;
		
				$layersettings.='
				opacity:'.$imagefull_opac_dec.';
				-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity='.$imagefull_opac.')";
				filter: alpha(opacity='.$imagefull_opac.');';
			}
		
			$imagefull_color = ( isset( $get_skin_data['skin_id_'. $layer .'_imagefull_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_imagefull_color'] ) : '';
		
			// Background Color
			if( !empty($imagefull_color) )
			{
				$layersettings.='
				background-color: #'.$imagefull_color.';'; 
				
				if( $layer == 'layer5' )
				{
					$primary_background = 'background-color: #'. $imagefull_color .';';
				}
			}
		} 
		
		// IMAGE POSITIONED background layer
		if( $setvalue==$layer.'_image' )
		{ 
			$image_opac = ( isset( $get_skin_data['skin_id_'. $layer .'_image_opac'] ) ) ? $get_skin_data['skin_id_'. $layer .'_image_opac'] : '';
		
			// Image Opacity
			if( !empty($image_opac) )
			{ 
				if( $image_opac == '100' ) $image_opac_dec = '1'; elseif( $image_opac == '.' ) $image_opac_dec = '0'; elseif( $image_opac < '10' ) $image_opac_dec = '.0'.$image_opac; else $image_opac_dec = '.'.$image_opac;
		
				$ie_opacity_pri = '00';
		
				$layersettings.='
				background:transparent;
				opacity:'. $image_opac_dec .';
				-ms-filter: 
				progid:DXImageTransform.Microsoft.Alpha(opacity='. $image_opac .')
				progid:DXImageTransform.Microsoft.gradient(startColorstr=#00FFFFFF,endColorstr=#00FFFFFF);
				zoom:1;';
			}
		
			// Background Color
			$image_color = ( isset( $get_skin_data['skin_id_'. $layer .'_image_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_image_color'] ) : '';
			
			if( !empty($image_color) )
			{ 
				$layersettings.='
				background-color: #'. $image_color .';'; 
				
				$primary_background = 'background-color: #'. $imagefull_color .';';
			}	
		
			// Background Image	
			$image = ( isset( $get_skin_data['skin_id_'. $layer .'_image'] ) ) ? $get_skin_data['skin_id_'. $layer .'_image'] : '';
			
			if( !empty($image) )
			{
				$layersettings.='
				background-image: url('.$image.');'; 
			}	
		
			// Background Image Position
			$image_valign = ( isset( $get_skin_data['skin_id_'. $layer .'_image_valign'] ) ) ? $get_skin_data['skin_id_'. $layer .'_image_valign'] : '';
			$image_halign = ( isset( $get_skin_data['skin_id_'. $layer .'_image_halign'] ) ) ? $get_skin_data['skin_id_'. $layer .'_image_halign'] : '';
		
			if( !empty($image_halign) || !empty($image_valign) )
			{
				if( !$image_halign ) $image_halign = '0'; // set defaults
				if( !$image_valign ) $image_valign = '0'; 
		
				$layersettings.='
				background-position: '. $image_halign .' '. $image_valign .';'; 
			}
		
			$image_repeat = ( isset( $get_skin_data['skin_id_'. $layer .'_image_repeat'] ) ) ? $get_skin_data['skin_id_'. $layer .'_image_repeat'] : '';
		
			// Background Image Repeat
			if( !empty($image_repeat) )
			{ 
				$layersettings.='
				background-repeat: '. $image_repeat .';'; 
			}
		}
		
		// PATTERN Background Layer
		if( $setvalue==$layer.'_pattern' )
		{
			$pattern_opac = ( isset( $get_skin_data['skin_id_'. $layer .'_pattern_opac'] ) ) ? $get_skin_data['skin_id_'. $layer .'_pattern_opac'] : '';
		
			// Pattern Opacity
			if( !empty($pattern_opac) )
			{
				if( $pattern_opac == '100' ) $pattern_opac_dec = '1'; elseif( $pattern_opac == '.' ) $pattern_opac_dec = '0'; elseif( $pattern_opac < '10' )  $pattern_opac_dec = '.0'.$pattern_opac;  else $pattern_opac_dec = '.'.$pattern_opac;
		
				$layersettings.='
				opacity:'.$pattern_opac_dec.';
				-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity='.$pattern_opac.')";
				filter: alpha(opacity='.$pattern_opac.');';
			}
		
			// Background Color
			$pattern_color = ( isset( $get_skin_data['skin_id_'. $layer .'_pattern_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_pattern_color'] ) : '';
			
			if( !empty($pattern_color) )
			{
				$layersettings.='
				background-color: #'. $pattern_color .';'; 
				
				$primary_background = 'background-color: #'. $imagefull_color .';';
			}
		
			$pattern = ( isset( $get_skin_data['skin_id_'. $layer .'_pattern'] ) ) ? $get_skin_data['skin_id_'. $layer .'_pattern'] : '';
			
			// Background Pattern
			if( !empty($pattern) )
			{
				$layersettings.='
				background-image: url('.get_template_directory_uri().'/images/'.$pattern.'.png);'; 
			}
		}
		
		// VIDEO Background Layer
		if( $setvalue == $layer.'_video' )
		{
			$video_opac = ( isset( $get_skin_data['skin_id_'. $layer .'_video_opac'] ) ) ? $get_skin_data['skin_id_'. $layer .'_video_opac'] : '';
		
			// Video Opacity
			if( !empty($video_opac) )
			{
				if( $video_opac == '100' ) $video_opac_dec = '1'; elseif( $video_opac == '.' ) $video_opac_dec = '0'; elseif( $video_opac < '10' ) $video_opac_dec = '.0'.$video_opac; else $video_opac_dec = '.'.$video_opac;
		
				$layersettings.='
				opacity:'.$video_opac_dec.';
				-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity='.$video_opac.')";
				filter: alpha(opacity='.$video_opac.');';
			}
		}
		
		if( !empty($layersettings) )
		{
			$output = '#custom-'. $layer .' { '. $layersettings .' }
			';
			
			if( !empty( $primary_background ) )
			{
				$output .= '#custom-layer5-color { '. $primary_background . '; }
				';
			}
			
			return $output;
		}
		
		// CYCLE Background Layer
		if( $setvalue == $layer.'_cycle' )
		{
			$cycle_opac = ( isset( $get_skin_data['skin_id_'. $layer .'_cycle_opac'] ) ) ? $get_skin_data['skin_id_'. $layer .'_cycle_opac'] : '';
		
			// Cycle Opacity
			if( !empty($cycle_opac) )
			{
				if( $cycle_opac == '100' ) $cycle_opac_dec = '1';  elseif( $cycle_opac == '.' ) $cycle_opac_dec = '0'; elseif( $cycle_opac < '10' ) $cycle_opac_dec = '.0'.$cycle_opac; else $cycle_opac_dec = '.'.$cycle_opac;
		
				$layersettings.='
				opacity:'.$cycle_opac_dec.';
				-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity='.$cycle_opac.')";
				filter: alpha(opacity='.$cycle_opac.');';
			}
		
			$cycle_color = ( isset( $get_skin_data['skin_id_'. $layer .'_cycle_color'] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $layer .'_cycle_color'] ) : '';
		
			// Background Color
			if( !empty($cycle_color) )
			{
				$layersettings.='
				background-color: #'.$cycle_color.';'; 
				
				if( $layer == 'layer5' )
				{
					$primary_background = 'background-color: #'. $imagefull_color .';';
				}
			}
		}
		
		if( !empty($layersettings) )
		{
			$output = '#custom-'. $layer .' { '. $layersettings .' }
			';
			
			if( !empty( $primary_background ) )
			{
				$output .= '#custom-layer5-color { '. $primary_background . '; }
				';
			}
			
			return $output;
		}
	}


	// CUSTOM LAYER HTML
	function setlayer_html( $layer,$setvalue,$skin )
	{
		$get_skin_data = maybe_unserialize(get_option('skin_data_'.$skin));
	
		// CYCLE
		if( $setvalue == $layer.'_cycle' )
		{
			$cycle_timeout = ( isset( $get_skin_data['skin_id_'. $layer .'_cycle_timeout'] ) ) ? $get_skin_data['skin_id_'. $layer .'_cycle_timeout'] : '';
	
			// Cycle Timeout
			if( !empty($cycle_timeout) )
			{
				$timeout ='timeout="'.$cycle_timeout.'"';
			}
		
			if( !isset($timeout) ) $timeout='';
		
			if( isset($get_skin_data['skin_id_'. $layer .'_datasource']) ) 		  $cycle_datasource = $get_skin_data['skin_id_'. $layer .'_datasource']; else $cycle_datasource = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_attached']) ) 	  $cycle_attached = $get_skin_data['skin_id_'. $layer .'_cycle_attached']; else $cycle_attached = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_pagepost_id']) ) $cycle_pagepost_id = $get_skin_data['skin_id_'. $layer .'_cycle_pagepost_id']; else $cycle_pagepost_id = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_cat']) ) 		  $cycle_cat = $get_skin_data['skin_id_'. $layer .'_cycle_cat']; else $cycle_cat = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_flickr']) ) 	  $cycle_flickr = $get_skin_data['skin_id_'. $layer .'_cycle_flickr']; else $cycle_flickr = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_slideset']) ) 	  $cycle_slideset = $get_skin_data['skin_id_'. $layer .'_cycle_slideset']; else $cycle_slideset = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_prodcat']) ) 	  $cycle_prodcat = $get_skin_data['skin_id_'. $layer .'_cycle_prodcat']; else $cycle_prodcat = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_prodtag']) ) 	  $cycle_prodtag = $get_skin_data['skin_id_'. $layer .'_cycle_prodtag']; else $cycle_prodtag = '';
			if( isset($get_skin_data['skin_id_'. $layer .'_cycle_mediacat']) ) 	  $cycle_mediacat = $get_skin_data['skin_id_'. $layer .'_cycle_mediacat']; else $cycle_mediacat = '';
		
			// Datasource
			if( $cycle_datasource )
			{
				if( strpos($cycle_datasource,'data-1' ) !== false && $cycle_attached !='' )
				{
					$datasource = 'attached_id="'. $cycle_attached .'"';	
				}
				elseif( strpos($cycle_datasource,'data-2' ) !== false && $cycle_cat !='' )
				{
					$data = rTrim( $cycle_cat,',' );	
					$datasource = 'categories="'. $data .'"';	
				}
				elseif( strpos($cycle_datasource,'data-3' ) != false && $cycle_flickr !='' )
				{
					$datasource = 'flickr_set="'. $cycle_flickr .'"';	
				}
				elseif( strpos($cycle_datasource,'data-4' ) !=false && $cycle_slideset !='' )
				{	
					$data = rTrim( $cycle_slideset,',' );	
					$datasource = 'slidesetid="'. $data .'"';		
				}
				elseif( strpos($cycle_datasource,'data-5' ) !== false )
				{
					// Product Cats	
					if( $cycle_prodcat )
					{
						$data = rTrim( $cycle_prodcat,',' );	
						$datasource = 'product_categories="'. $data .'"';
					}
				
					// Product Tags
					if( $cycle_prodtag )
					{		
						$data = rTrim( $cycle_prodtag,',' );	
						$datasource .= ' product_tags="'. $data .'"';	
					}
				}
				elseif( strpos($cycle_datasource,'data-6' ) !== false && $cycle_mediacat !='' )
				{
					$data = rTrim( $cycle_mediacat,',' );	
					$datasource = 'media_categories="'. $data .'"';	 
				}
				elseif( strpos($cycle_datasource,'data-8' ) !== false && $cycle_pagepost_id !='' )
				{
					$data = rTrim( $cycle_pagepost_id,',' );	
					$datasource = 'pagepost_id="'. $data .'"';	
				}				
			
				return do_shortcode('[postgallery_image  id="'. $layer .'" navigation="disabled" customlayer="yes" speed="1000" '. $datasource .' animation="fade" tween="easeOutSine"  '. $timeout .' /]'); 
			}
		}
	
		// IMAGE FULL
		if( $setvalue == $layer.'_imagefull' )
		{
			$image_featured = ( isset( $get_skin_data['skin_id_'. $layer .'_imagefeatured'] ) ) ? $get_skin_data['skin_id_'. $layer .'_imagefeatured'] : '';
			
			if( $image_featured == 'enable' )
			{
				$post_image_id = get_post_thumbnail_id(get_the_ID());
				if( !empty($post_image_id) )
				{
					$thumbnail = wp_get_attachment_image_src( $post_image_id, 'post-thumbnail', false );
					$imagefull = $thumbnail[0];
					$imagefull = parse_url( $imagefull, PHP_URL_PATH ); // make relative Image URL
				}
				else
				{
					$imagefull = ( isset( $get_skin_data['skin_id_'. $layer .'_imagefull'] ) ) ? $get_skin_data['skin_id_'. $layer .'_imagefull'] : '';
				}
			}
			else
			{
				$imagefull = ( isset( $get_skin_data['skin_id_'. $layer .'_imagefull'] ) ) ? $get_skin_data['skin_id_'. $layer .'_imagefull'] : '';
			}
		
			if( !empty($imagefull) )
			{
				return '<div class="fullimage"><img src="'. $imagefull .'" alt="&nbsp;" /></div>';
			}
		
		}
		
		// VIDEO
		if( $setvalue == $layer.'_video' )
		{
			$video = ( isset( $get_skin_data['skin_id_'. $layer .'_video'] ) ) ? $get_skin_data['skin_id_'. $layer .'_video'] : '';
			$video_type = ( isset( $get_skin_data['skin_id_'. $layer .'_video_type'] ) ) ? $get_skin_data['skin_id_'. $layer .'_video_type'] : '';
			$video_loop = ( isset( $get_skin_data['skin_id_'. $layer .'_video_loop'] ) ) ? $get_skin_data['skin_id_'. $layer .'_video_loop'] : '';
		
			if( !empty($video_type) && !empty($video) )
			{
				return do_shortcode('[videoembed type="'. $video_type .'"  url="'. $video .'" loop="'. $video_loop .'" customlayer="yes" autoplay="yes" id="'. $layer .'-video"]');
			}
		}
	}
	
	// FONTS
	function setcufon($element,$skin,$inherited_elements,$z)
	{
	 
		$get_skin_data = maybe_unserialize(get_option('skin_data_'.$skin));
	
		if( isset($get_skin_data['skin_id_'.$element.'_heading_font'.$z]) ) $heading_font= stripslashes($get_skin_data['skin_id_'.$element.'_heading_font'.$z]); else $heading_font='';
		if( isset($get_skin_data['skin_id_'.$element.'_h1_font'.$z]) ) $h1_font= stripslashes($get_skin_data['skin_id_'.$element.'_h1_font'.$z]); else $h1_font='';
		if( isset($get_skin_data['skin_id_'.$element.'_h2_font'.$z]) ) $h2_font= stripslashes($get_skin_data['skin_id_'.$element.'_h2_font'.$z]); else $h2_font='';
	
		$x='';

		// format css style number 
		if( !empty($z) )
		{
			$x = str_replace( '_', '', $z ); 
			$x = $x + 1;
			$x = '-' . $x;	
		} 
	
		if( $heading_font != '' )
		{
			$htags='h3, h4, h5, h6';
	
			if( $h2_font !='' )
			{
				$htags = 'h2,'. $htags;
				$h2tag = '.skinset-'. $element . $x .' h2,';
			}
			else
			{
				$h2tag = '';	
			}
	
			if( $h1_font !='' )
			{
				$htags = 'h1,'. $htags;
				$h1tag = '.skinset-'. $element . $x .' h1,';
			}
			else
			{
				$h1tag = '';	
			}
		
			$class = '';
			$class = setcss( $inherited_elements,$htags );
			
			// format css style number 
			if( !empty($z) )
			{
				$z = str_replace( '_', '', $z ); 
				$z = $z + 1;
				$z = '-'. $z;	
			} 
		 
			$cufonclasses = $class . $h1tag . $h2tag.'.skinset-'.$element.$z.' h3, .skinset-'.$element.$z.' h4, .skinset-'.$element.$z.' h5, .skinset-'.$element.$z.' h6, .skinset-'.$element.$z.' .cufon-replace,.skinset-'.$element.$z.' .custom-style.cufon-replace,.skinset-'.$element.$z.' #nv-tabs .menudesc p ';
			
			init_cufon( $cufonclasses,$heading_font );
		}
	
		if( !empty($h1_font) )
		{
			$class = setcss( $inherited_elements,'h1' );
			$cufonclasses = $class. '.skinset-'. $element . $z .' h1';
			init_cufon( $cufonclasses,$h1_font );
		}
		
		if( !empty($h2_font) )
		{
			$class = setcss($inherited_elements,'h2');
			$cufonclasses = $class. '.skinset-'.$element.$z.' h2';
			init_cufon( $cufonclasses,$h2_font );
		}
	}

	// CUSTOM LAYER CSS
	function setelement( $element,$skin,$inherited_elements,$z )
	{ 
		$get_skin_data = maybe_unserialize(get_option('skin_data_'. $skin));

		$layersettings=$elementsettings=$menu_inherit_element=$css=$heading_color_settings=$h1_color_settings=$h1_tag_settings=$h2_color_settings=$h2_tag_settings=$h3_color_settings=$h4_color_settings=$h5_color_settings=$h6_color_settings=$font_color_settings=$class=$linkhover_color_settings=$heading_tag_settings=$elemhover_bgcolor_settings=$elem_extras_2=$link_color_settings=$elem_bgcolor_settings=$elem_extras_1=''; // reset

		// FONT SIZE
		if( isset($get_skin_data['skin_id_'. $element .'_font_size'. $z]) ) $font_size = stripslashes( $get_skin_data['skin_id_'.$element.'_font_size'. $z] ); else $font_size = '';

		if( $font_size !='' )
		{
			$elementsettings.='
 			font-size:'.$font_size.'px;';
		}

		// FONT 
		if( isset($get_skin_data['skin_id_'.$element.'_font'.$z]) ) $font= stripslashes($get_skin_data['skin_id_'.$element.'_font'.$z]); else $font='';

		if( $font !='' )
		{
			$elementsettings.='
 			font-family:'. $font .';';
		}

		// HEADING FONT
		if( isset($get_skin_data['skin_id_'.$element.'_heading_font'. $z]) ) $heading_font= stripslashes( $get_skin_data['skin_id_'.$element.'_heading_font'. $z] ); else $heading_font = '';

		if( $heading_font !='' && of_get_option("nv_font_type" ) != "enable" )
		{
			$heading_tag_settings='
 			font-family:'.$heading_font.';';
		}

		// HEADING SIZE
		if( isset($get_skin_data['skin_id_'.$element.'_heading_size'.$z]) ) $heading_size = stripslashes( $get_skin_data['skin_id_'.$element.'_heading_size'. $z] ); else $heading_size = '';

		// H1 FONT
		if( isset($get_skin_data['skin_id_'.$element.'_h1_font'.$z]) ) $h1_font = stripslashes( $get_skin_data['skin_id_'.$element.'_h1_font'. $z] ); else $h1_font = '';

		if( $h1_font !='' && of_get_option("nv_font_type") !="enable" )
		{
			$h1_tag_settings='
 			font-family:'. $h1_font .';';
		}

		// H2 COLOR
		if( isset($get_skin_data['skin_id_'. $element .'_h2_font'. $z]) ) $h2_font = stripslashes( $get_skin_data['skin_id_'.$element.'_h2_font'. $z] ); else $h2_font = '';

		if( $h2_font!='' && of_get_option("nv_font_type") !="enable" )
		{
			$h2_tag_settings='
 			font-family:'. $h2_font .';';
		}

		// FONT COLOR
		if( isset($get_skin_data['skin_id_'. $element .'_font_color'. $z]) ) $font_color = $get_skin_data['skin_id_'. $element .'_font_color'. $z]; else $font_color = '';

		if( $font_color !='' )
		{
			$font_color_settings='
 			color:#'. str_replace('#','', $font_color ) .';';
			$elementsettings.='
 			color:#'. str_replace('#','', $font_color ) .';'; 
		}	

		// LINK COLOR
		if( isset($get_skin_data['skin_id_'. $element .'_link_color'. $z]) ) $link_color = $get_skin_data['skin_id_'. $element .'_link_color'. $z]; else $link_color = '';

		if( $link_color !='' )
		{
			$link_color_settings = '
			color:#'. str_replace('#','', $link_color ) .';';
			
			$elem_bordercolor_settings = '
 			border-color:#'. str_replace('#','', $link_color ) .';'; // set background color for various elements		

			$elem_bgcolor_settings = '
 			background-color:#'. str_replace('#','', $link_color ) .';'; // set background color for various elements			
			
			$elem_extras_1 = '
 			border-bottom: 1px dashed #'. str_replace('#','', $link_color ) .';'; // set border color for various elements
		}		

		// LINK HOVER COLOR
		if( isset($get_skin_data['skin_id_'. $element .'_linkhover_color'. $z]) ) $linkhover_color = $get_skin_data['skin_id_'.$element.'_linkhover_color'. $z]; else $linkhover_color = '';

		if( $linkhover_color !='' )
		{
			$linkhover_color_settings = '
 			color:#'. str_replace('#','', $linkhover_color ) .';';
			
			$elemhover_bgcolor_settings = '
			background-color:#'. str_replace('#','', $linkhover_color ) .';';
		}		

		// H1 COLOR
		if( isset($get_skin_data['skin_id_'.$element.'_h1_color'. $z]) ) $h1_color = $get_skin_data['skin_id_'.$element.'_h1_color'. $z];

		if( !empty($h1_color) )
		{
			$h1_color_settings = '
			color:#'. str_replace('#','', $h1_color ) .';';
		}	

		if( !empty($heading_size) )
		{
			$hsize = 31 + $heading_size;
			$h1_color_settings .= '
 			font-size:'.$hsize.'px;'; 
		}

		// H2 COLOR
		if( isset($get_skin_data['skin_id_'.$element.'_h2_color'.$z]) ) $h2_color = $get_skin_data['skin_id_'.$element.'_h2_color'.$z];
		
		if( !empty($h2_color) )
		{
			$h2_color_settings = '
 			color:#'. str_replace('#','', $h2_color ) .';';
		}

		if( !empty($heading_size) )
		{
			$hsize = 25 + $heading_size;
			$h2_color_settings .= '
			font-size:'. $hsize .'px;'; 
		}		
 
		// H3 COLOR
		if( isset($get_skin_data['skin_id_'. $element .'_h3_color'. $z]) ) $h3_color = $get_skin_data['skin_id_'.$element.'_h3_color'. $z];

		if( !empty($h3_color) )
		{
			$h3_color_settings = '
 			color:#'. str_replace('#','', $h3_color ) .';';
		}			

		if( !empty($heading_size) )
		{
			$hsize = 20 + $heading_size;
			$h3_color_settings .= '
			font-size:'. $hsize .'px;'; 
		}
 
 
		// H4 COLOR
		if( isset($get_skin_data['skin_id_'.$element.'_h4_color'. $z]) ) $h4_color = $get_skin_data['skin_id_'. $element .'_h4_color'.$z];

		if( !empty($h4_color) )
		{
			$h4_color_settings = '
 			color:#'. str_replace('#','', $h4_color ) .';';
		}

		if( !empty($heading_size) )
		{
			$hsize = 17 + $heading_size;
			$h4_color_settings .= '
			font-size:'. $hsize .'px;'; 
		}			

		// H5 COLOR
		if( isset($get_skin_data['skin_id_'.$element.'_h5_color'. $z]) ) $h5_color = $get_skin_data['skin_id_'.$element.'_h5_color'. $z];

		if( !empty($h5_color) )
		{
			$h5_color_settings = '
 			color:#'. str_replace('#','', $h5_color ) .';';
		}

		if( !empty($heading_size) )
		{
			$hsize = 14 + $heading_size;
			$h5_color_settings .= '
			font-size:'. $hsize .'px;'; 
		}	

		// H6 COLOR
		if( isset( $get_skin_data['skin_id_'.$element.'_h6_color'. $z]) ) $h6_color = $get_skin_data['skin_id_'.$element.'_h6_color'. $z];

		if( !empty($h6_color) )
		{
			$h6_color_settings = '
 			color:#'. str_replace('#','', $h6_color ) .';';
		}

		if( !empty($heading_size) )
		{
			$hsize = 12 + $heading_size;
			$h6_color_settings .= '
			font-size:'. $hsize .'px;'; 
		}

		// FLOATING FONT COLOR
		if( isset($get_skin_data['skin_id_floating'. $element .'_font_color'. $z]) ) $floating_font_color = $get_skin_data['skin_id_floating'. $element .'_font_color'. $z]; else $floating_font_color = '';

		if( $floating_font_color !='' )
		{
			$floating_font_color_settings='
 			color:#'. str_replace('#','', $floating_font_color ) .';';
		}
		
		// FLOATING FONT COLOR
		if( isset($get_skin_data['skin_id_floating'. $element .'_linkhover_color'. $z]) ) $floating_linkhover_color = $get_skin_data['skin_id_floating'. $element .'_linkhover_color'. $z]; else $floating_linkhover_color = '';

		if( $floating_linkhover_color !='' )
		{
			$floating_linkhover_color_settings='
 			color:#'. str_replace('#','', $floating_linkhover_color ) .';';
		}			

	

		// Form Settings
		$form_color = ( isset( $get_skin_data['skin_id_'. $element .'_form_color'. $z] ) ) ? $get_skin_data['skin_id_'.$element.'_form_color'. $z] : '';
		$form_border_color_tl = ( isset( $get_skin_data['skin_id_'. $element .'_form_border_color_tl'. $z] ) ) ? $get_skin_data['skin_id_'.$element.'_form_border_color_tl'. $z] : '';
		$form_border_color_br = ( isset( $get_skin_data['skin_id_'. $element .'_form_border_color_br'. $z] ) ) ? $get_skin_data['skin_id_'.$element.'_form_border_color_br'. $z] : '';

		// Form Background Color
		if( !empty($form_color) )
		{
			$form_color_settings = '
 			background-color:#'. str_replace('#','', $form_color ) .';';
		}
		
		// Form Border Top Left
		if( !empty($form_border_color_tl) )
		{
			$form_color_settings .= '
			border-top-color:#'. str_replace('#','', $form_border_color_tl ) .';
			border-left-color:#'. str_replace('#','', $form_border_color_tl ) .';
			';
		}	

		// Form Border Bottom Right
		if( !empty($form_border_color_br) )
		{
			$form_color_settings .= '
			border-bottom-color:#'. str_replace('#','', $form_border_color_br ) .';
			border-right-color:#'. str_replace('#','', $form_border_color_br ) .';
			';
		}

		// Submenu Settings
		$submenu_color = ( isset( $get_skin_data['skin_id_'. $element .'_panel_color'. $z] ) ) ? $get_skin_data['skin_id_'. $element .'_panel_color'. $z] : '';
		$submenu_border_color = ( isset( $get_skin_data['skin_id_'. $element .'_panel_border_color'. $z] ) ) ? $get_skin_data['skin_id_'. $element .'_panel_border_color'. $z] : '';


		// Submenu Background Color
		if( !empty($submenu_color) )
		{
			$submenu_settings = '
 			background-color:#'. str_replace('#','', $submenu_color ) .';';
		}
		
		// Submenu Border Color
		if( !empty($submenu_border_color) )
		{
			$submenu_settings .= '
			border-color:#'. str_replace('#','', $submenu_border_color ) .';
			';
		}						

		// Border Color
		$border_color = ( isset( $get_skin_data['skin_id_'.$element.'_border_color'.$z] ) ) ? $get_skin_data['skin_id_'.$element.'_border_color'.$z] : '';

		if( !empty($border_color) )
		{
			$border_color = str_replace( '#', '', $border_color );
			
			$elementsettings.='
		 	border-color: #'. $border_color .';';
		}	


		$color_pri = ( isset( $get_skin_data['skin_id_'. $element .'_pri_color'.$z] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $element .'_pri_color'.$z] ) : '';
		$color_sec = ( isset( $get_skin_data['skin_id_'. $element .'_sec_color'.$z] ) ) ? str_replace( '#', '', $get_skin_data['skin_id_'. $element .'_sec_color'.$z] ) : '';

 
		if( empty($color_sec) ) $color_sec = $color_pri;
 
		if( !empty($color_pri) )
		{
			$rgb_color_pri = nv_html2rgb($color_pri);
			$rgb_color_sec = nv_html2rgb($color_sec);
			
			// Primary Opacity
			$opacity_pri = ( !empty( $get_skin_data['skin_id_'. $element .'_pri_opac'. $z] ) ) ? $get_skin_data['skin_id_'. $element .'_pri_opac'. $z] : 100;

			// Secondary Opacity
			$opacity_sec = ( !empty( $get_skin_data['skin_id_'. $element .'_sec_opac'. $z] ) ) ? $get_skin_data['skin_id_'. $element .'_sec_opac'. $z] : $opacity_pri;			
			
			if( $opacity_pri == '100' ) $opacity_pri = '1'; elseif( $opacity_pri == '.' ) $opacity_pri = '0'; elseif( $opacity_pri < '10' ) $opacity_pri = '0.1'. $opacity_pri; else $opacity_pri = '0.'.$opacity_pri;
		
			
			if( $opacity_sec == '100' ) $opacity_sec = '1'; elseif( $opacity_sec == '.' ) $opacity_sec = '0'; elseif( $opacity_sec < '10' ) $opacity_sec = '0.1'. $opacity_sec; else $opacity_sec = '0.'.$opacity_sec;
		
		 
			$ie_opacity_pri = $opacity_pri * 255;
			$ie_opacity_pri = dechex($ie_opacity_pri);
			$ie_opacity_sec = $opacity_sec * 255;
			$ie_opacity_sec = dechex($ie_opacity_sec);
		 
			if( $ie_opacity_pri == '0' ) $ie_opacity_pri = '00';
			if( $ie_opacity_sec == '0' ) $ie_opacity_sec = '00';
		 
		 
			$elementsettings .= '
			background: rgb( '.$rgb_color_pri.' );
			background: rgba( '.$rgb_color_pri.',  '.$opacity_pri.');
			background-color: transparent;
			filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#'. $ie_opacity_pri.$color_pri.' , endColorstr=#'.$ie_opacity_sec.$color_sec.');
			-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#'.$ie_opacity_pri.$color_pri.' , endColorstr=#'.$ie_opacity_sec.$color_sec.')";
			background: linear-gradient(to bottom, rgba( '.$rgb_color_pri.','. $opacity_pri.'), rgba( '.$rgb_color_sec.','. $opacity_sec.') );
			background: -o-linear-gradient(top,rgba('.$rgb_color_pri.','.$opacity_pri.'), rgba( '.$rgb_color_sec.','. $opacity_sec.'));
			background: -moz-linear-gradient(100% 100% 90deg, rgba( '.$rgb_color_sec.','. $opacity_sec.'), rgba( '.$rgb_color_pri.','. $opacity_pri.'));
			background: -webkit-gradient(linear, 0% 0%, 0% 90%, from(rgba( '.$rgb_color_pri.','.$opacity_pri.')), to(rgba( '.$rgb_color_sec.','. $opacity_sec.')));
			*background: transparent;
			zoom:1;';			
		} 
		else
		{
			$elementsettings.='
			filter:none;
			-ms-filter:none;
			';
		}

		// format css style number
		if( !empty($z) )
		{ 
			$z = str_replace( '_', '', $z ); 
			$z = $z + 1;
			$z = '-'. $z;	
		}

		if( !empty($elementsettings) )
		{
			$class = setcss( $inherited_elements,'' );
			$extras = '';
			$formatgallery = ''; 
	 
			$css_elems = '.skinset-'. $element . $z .'.nv-skin'; 
	 
			if( !isset($invertsettings) ) $invertsettings = '';
	
			// set hover styling for menu
			if( $element == 'menu ul ul' || $menu_inherit_element !='' )
			{ 
				$css .= '#nv-tabs ul ul li:hover,#primary-wrapper  #nv-tabs ul li.extended-menu ul li ul li:hover {
				'.$invertsettings.';
				}';	
			}
	 
			$css .= $class . $css_elems.' {
			'.$elementsettings.'
			}';

		}
	
		if( !empty($font_color_settings) )
		{
			$css .= '
			.skinset-'.$element.$z.' div.item-list-tabs ul li a,
			.skinset-'.$element.$z.' .widget ul li.current_page_item a,
			.skinset-'.$element.$z.' span.menudesc,
			div.post-metadata a,
			.skinset-'.$element.$z.' .commentlist .comment-author a,
			.skinset-'.$element.$z.' .recent-metadata a,
			.skinset-'.$element.$z.' .nv-recent-posts h4 a,
			.skinset-'.$element.$z.' .post-metadata a,
			.skinset-'.$element.$z.' .widget.widget_pages li a,
			.skinset-'.$element.$z.' .widget.widget_nav_menu li a,
			.skinset-'.$element.$z.' .widget.widget_recent_entries li a,
			.skinset-'.$element.$z.' div.blind_down ul li a,
			.skinset-'.$element.$z.' #item-header-content h2 a,
			.skinset-'.$element.$z.' a.topic-title,
			.skinset-'.$element.$z.' .bbp-topic-title a,
			.skinset-'.$element.$z.' a.bbp-forum-title,
			.skinset-'.$element.$z.' td.td-group .object-name a { '. $font_color_settings .' }
			';
		}
	
		if( !empty( $elem_bordercolor_settings ) )
		{
			$css .= $class.'
			.skinset-'.$element.$z.' .woocommerce .woocommerce-error, 
			.skinset-'.$element.$z.' .woocommerce .woocommerce-info, 
			.skinset-'.$element.$z.' .woocommerce .woocommerce-message,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-closed,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-trash,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-spam,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.super-sticky,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.sticky { '. $elem_bordercolor_settings .' }
			';			
		}	
	
		if( !empty($link_color_settings) )
		{
			if( $element == 'main' || $element == 'background' )
			{
				$css .= '
				#header .mobilemenu-init a,
				#header .toppaneltrigger.mobile a,
				';
			}			
			
			$class = setcss($inherited_elements,'a, #content span.price, #content span.amount');			
			$css .= $class.'
			.skinset-'.$element.$z.' a,
			.skinset-'.$element.$z.' #content span.price,
			.skinset-'.$element.$z.' .fonticon i.inherit,
			.skinset-'.$element.$z.' #content span.amount,
			.skinset-'.$element.$z.' .woocommerce .woocommerce-info:before,
			.skinset-'.$element.$z.' span.text_linkcolor,
			#nv-tabs .skinset-'.$element.$z.' li[class*="scrollTo_"] a {'. $link_color_settings .' }
			';	
		}		
	
		if( !empty($linkhover_color_settings) )
		{
			$class = setcss($inherited_elements,'a:hover');
			$css .= $class.'
			.skinset-'.$element.$z.' a:hover,
			.skinset-'.$element.$z.' #nv-tabs .extended-menu li.scroll a:hover,
			.skinset-'.$element.$z.' a.waypoint_active,
			.skinset-'.$element.$z.' .post-metadata a:hover,
			.skinset-'.$element.$z.' .widget.widget_pages li a:hover,
			.skinset-'.$element.$z.' .widget.widget_nav_menu li a:hover,
			.skinset-'.$element.$z.' .widget.widget_recent_entries li a:hover,
			.skinset-'.$element.$z.' #item-header-content h2 a:hover,
			.skinset-'.$element.$z.' .current_page_item>a,
			.skinset-'.$element.$z.' .current-menu-item>a,
			.skinset-'.$element.$z.' li.menu-item:hover > a,
			.skinset-'.$element.$z.' .current-menu-ancestor>a,
			.skinset-'.$element.$z.' #mobile-tabs .current_page_item>a,
			.skinset-'.$element.$z.' #mobile-tabs .extended-menu .current_page_item>a,
			.skinset-'.$element.$z.' .bbp-reply-content #favorite-toggle .is-favorite a,
			.skinset-'.$element.$z.' .bbp-reply-content #subscription-toggle .is-subscribed a,
			.woocommerce.skinset-'.$element.$z.' p.stars a.active { '. $linkhover_color_settings .' }
			';	
		}
	
		if( !empty($heading_color_settings) || !empty($heading_tag_settings) )
		{
			$class = setcss($inherited_elements,'h1, h1 a, h2, h2 a, h3, h3 a, h4, h4 a, h5, h5 a, h6, h6 a');
			$css .= $class.'.skinset-'.$element.$z.' h1, .skinset-'.$element.$z.' h1 a, .skinset-'.$element.$z.' h2, .skinset-'.$element.$z.' h2 a, .skinset-'.$element.$z.' h3, .skinset-'.$element.$z.' h3 a, .skinset-'.$element.$z.' h4, .skinset-'.$element.$z.' h4 a, .skinset-'.$element.$z.' h5, .skinset-'.$element.$z.' h5 a, .skinset-'.$element.$z.' h6, .skinset-'.$element.$z.' h6 a,.skinset-'.$element.$z.' .bbp-topic-title a.bbp-topic-permalink,.skinset-'.$element.$z.' .bbp-forum-info a.bbp-forum-title { '.$heading_color_settings.$heading_tag_settings.'	}
			';
		}
	
		if( !empty($h1_color_settings) || !empty($h1_tag_settings) )
		{
			$class = setcss($inherited_elements,'h1, h1 a');
			$css .= $class.'.skinset-'.$element.$z.' h1, .skinset-'.$element.$z.' h1 a { '.$h1_color_settings.$h1_tag_settings.' }
			';
		}
	
		if( !empty($h2_color_settings) || !empty($h2_tag_settings) )
		{
			$class = setcss($inherited_elements,'h2, h2 a');
			$css .= $class.'.skinset-'.$element.$z.' h2, .skinset-'.$element.$z.' h2 a { '.$h2_color_settings.$h2_tag_settings.' }
			';	
		}
	
		if( !empty($h3_color_settings) )
		{
			$class = setcss($inherited_elements,'h3, h3 a');
			$css .= $class.'.skinset-'.$element.$z.' h3, .skinset-'.$element.$z.' h3 a { '.$h3_color_settings.' }
			';	
		}
	
		if( !empty($h4_color_settings) )
		{
			$class = setcss($inherited_elements,'h4, h4 a,h5, h5 a,h6, h6 a');
			$css .= $class.'.skinset-'.$element.$z.' h4,.skinset-'.$element.$z.' h5,.skinset-'.$element.$z.' h6,.skinset-'.$element.$z.' .ui-tabs-nav li a, .skinset-'.$element.$z.' .accordionhead a, .skinset-'.$element.$z.' span.price-value,.skinset-'.$element.$z.' .nv-recent-posts h4 a { '.$h4_color_settings.' }
			';	
		}

		// Transparent Header
		if( !empty($floating_font_color_settings) )
		{
			$css .= '
			.header-wrap.header_transparent .skinset-'.$element.$z.' #nv-tabs > ul > li > a,
			.header-wrap.header_transparent .skinset-'.$element.$z.' #nv-tabs > ul > li > .dropmenu-icon,
			.header-wrap.header_transparent .skinset-'.$element.$z.' h1 a,
			.header-wrap.header_transparent .skinset-'.$element.$z.' h2,
			.header-wrap.header_transparent .skinset-'.$element.$z.' .headerpanel-widgets h3,
			.header-wrap.header_transparent .skinset-'.$element.$z.' .headerpanel-widgets a,
			.header-wrap.header_transparent .skinset-'.$element.$z.' .headerpanel-widgets .textwidget {'. $floating_font_color_settings .' }
			';
		}

		if( !empty($floating_linkhover_color_settings) )
		{
			$css .= '
			.header-wrap.header_transparent .skinset-'.$element.$z.' #nv-tabs > ul > li:hover > a,
			.header-wrap.header_transparent .skinset-'.$element.$z.' #nv-tabs > ul > li.current-menu-item > a,
			.header-wrap.header_transparent .skinset-'.$element.$z.' #nv-tabs > ul > li:hover > .dropmenu-icon,
			.header-wrap.header_transparent .skinset-'.$element.$z.' h1 a:hover,
			.header-wrap.header_transparent .skinset-'.$element.$z.' .headerpanel-widgets a:hover {'. $floating_linkhover_color_settings .' }
			';
		}		


	
	
		/*if( !empty($h5_color_settings) )
		{
			$class = setcss($inherited_elements,'h5, h5 a');
			$css .= $class.'.skinset-'.$element.$z.' h5, .skinset-'.$element.$z.' h5 a { '.$h5_color_settings.' }
			';	
		}
	
		if( !empty($h6_color_settings) )
		{
			$class = setcss($inherited_elements,'h6, h6 a');
			$css .= $class.'.skinset-'.$element.$z.' h6, .skinset-'.$element.$z.' h6 a  { '.$h6_color_settings.' }
			';	
		}*/

		if( !empty($form_color_settings) )
		{
			$class = setcss($inherited_elements,'input[type="text"], input[type="password"],input[type="file"],textarea,input');
			$css .= $class.'.skinset-'.$element.$z.'  input[type="text"],.skinset-'.$element.$z.' input[type="password"],.skinset-'.$element.$z.' input[type="file"],.skinset-'.$element.$z.' textarea,.skinset-'.$element.$z.' input { '.$form_color_settings.' }
			';	
		}

		if( !empty($submenu_settings) )
		{
			$class = setcss( $inherited_elements,'' );
			$css .= $class.'#header #nv-tabs ul ul  { '.$submenu_settings.' }
			';	
		}				
	
		if( !empty($elem_bgcolor_settings) )
		{
			$class = setcss($inherited_elements,'span.nvcolor,span.highlight.one,.post-metadata li.post-date, .commentlist .reply a, div.header-message');
			$css .= $class.'
			.skinset-'.$element.$z.' span.nvcolor,
			.skinset-'.$element.$z.' span.dropcap.two.link_color,
			.skinset-'.$element.$z.' span.highlight.one,
			.skinset-'.$element.$z.' .post-metadata li.post-date,
			.skinset-'.$element.$z.' .commentlist .reply a,
			.skinset-'.$element.$z.' div.header-infobar,
			.skinset-'.$element.$z.' div.item-list-tabs ul li a span,
			.skinset-'.$element.$z.' .widget_display_stats dd strong,
			.skinset-'.$element.$z.' div.bbp-template-notice,
			.skinset-'.$element.$z.' div#message.updated,
			.skinset-'.$element.$z.' .hoverimg i,
			.skinset-'.$element.$z.' .hovervid i,
			.skinset-'.$element.$z.' span.activity,
			.skinset-'.$element.$z.' a.button,
			.skinset-'.$element.$z.' button.button,
			.skinset-'.$element.$z.' .fonticon.background,
			.skinset-'.$element.$z.' .button.link_color,
			.skinset-'.$element.$z.' .action-icons i,
			.skinset-'.$element.$z.' #respond input#submit.alt,
			.skinset-'.$element.$z.' a.button.alt,
			.skinset-'.$element.$z.' button.button.alt,
			.skinset-'.$element.$z.' input.button.alt,
			.skinset-'.$element.$z.'.woocommerce span.onsale,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-closed:before,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-trash:before,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.status-spam:before,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.super-sticky:before,
			.skinset-'.$element.$z.' #bbpress-forums li.bbp-body .hentry.sticky:before,
			.woocommerce.skinset-'.$element.$z.' .widget_price_filter .ui-slider .ui-slider-range,
			.woocommerce.skinset-'.$element.$z.' .widget_price_filter .ui-slider .ui-slider-handle,
			.skinset-'.$element.$z.' input[type="submit"] { '.$elem_bgcolor_settings.' }
			';	
		}
	
		if( !empty($elemhover_bgcolor_settings) )
		{
			$class = setcss($inherited_elements,'.nvcolor-wrap:hover span.nvcolor');
			$css .= $class.'.skinset-'.$element.$z.' .nvcolor-wrap:hover span.nvcolor,.woocommerce.skinset-'.$element.$z.' #respond input#submit.alt:hover, .woocommerce.skinset-'.$element.$z.' a.button.alt:hover, .woocommerce.skinset-'.$element.$z.' button.button.alt:hover, .woocommerce.skinset-'.$element.$z.' input.button.alt:hover { '.$elemhover_bgcolor_settings.' }
			';	
		}
	
		if( !empty($elem_extras_1) )
		{
			$class = setcss($inherited_elements,'acronym, abbr');
			$css .= $class.'.skinset-'.$element.$z.' acronym, .skinset-'.$element.$z.' abbr { '.$elem_extras_1.' }
			';	
		}
	
		return $css;
	}

	
	function setcss( $inherited_elements, $tags )
	{
		if( !isset($class) ) $class='';
		if( !isset($z) ) $z='';	
	
		if( $inherited_elements )
		{
			$inherited_elements = explode(",",$inherited_elements); 
			
			// loop through elements which will inherit settings
			foreach( $inherited_elements as $element_class )
			{ 
				if( $element_class == 'menu' ) $element_class = 'menu ul ul'; // add menu attribute
				$tagsarray = explode(",",$tags);
				
				foreach( $tagsarray as $tag )
				{
					$class .= '.skinset-'.$element_class.$z.' '.$tag.',';
				}
			}
		}
		else
		{
			$class='';
		}
		
		return $class;
	}


	// BUILD SKIN PRESETS
	function build_skinpresets()
	{ 
		require NV_FILES .'/adm/inc/skin-presets.php'; // skin data
		$skin_data_ids  = maybe_unserialize(get_option('skins_dynamix_ids'));
	 
		if( !empty($skin_data_ids) )
		{
			foreach( $skin_preset_ids as $skin_preset_id => $value )
			{
				if ( !preg_match("/\b". $skin_preset_id ."\b/", $skin_data_ids) )
				{
					delete_option('skins_dynamix_ids');
					update_option( 'skins_dynamix_ids', $skin_data_ids.$skin_preset_id.',');						
					update_option('skin_data_'.$skin_preset_id,$value);	
				}
			}
		}
		else // no previous skin data present
		{ 
			foreach( $skin_preset_ids as $skin_preset_id => $value )
			{
				$skin_data_ids.=$skin_preset_id.',';
				update_option( 'skin_data_'.$skin_preset_id,$value);
			}
	 
			update_option( 'skins_dynamix_ids', $skin_data_ids);	
		}
	 
	} 

	// Number to Words
	function numberToWords ($number, $type = '')
	{
		$words = array ('zero',
				'one',
				'two',
				'three',
				'four',
				'five',
				'six',
				'seven',
				'eight',
				'nine',
				'ten',
				'eleven',
				'twelve',
				'thirteen',
				'fourteen',
				'fifteen',
				'sixteen',
				'seventeen',
				'eighteen',
				'nineteen',
				'twenty',
				30=> 'thirty',
				40 => 'fourty',
				50 => 'fifty',
				60 => 'sixty',
				70 => 'seventy',
				80 => 'eighty',
				90 => 'ninety',
				100 => 'hundred',
				1000=> 'thousand');
	 
		$number_in_words='';
		
		if (is_numeric ($number))
		{
			$number = (int) round($number);
			if ($number < 0)
			{
				$number = -$number;
				$number_in_words = 'minus ';
			}
			if ($number > 1000)
			{
				$number_in_words = $number_in_words . numberToWords(floor($number/1000)) . " " . $words[1000];
				$hundreds = $number % 1000;
				$tens = $hundreds % 100;
				if ($hundreds > 100)
				{
					$number_in_words = $number_in_words . ", " . numberToWords ($hundreds);
				}
				elseif ($tens)
				{
					$number_in_words = $number_in_words . " and " . numberToWords ($tens);
				}
			}
			elseif ($number > 100)
			{
				$number_in_words = $number_in_words . numberToWords(floor ($number / 100)) . " " . $words[100];
				$tens = $number % 100;
				if ($tens)
				{
					$number_in_words = $number_in_words . " and " . numberToWords ($tens);
				}
			}
			elseif ($number > 20)
			{
				$number_in_words = $number_in_words . " " . $words[10 * floor ($number/10)];
				$units = $number % 10;
				if ($units)
				{
					$number_in_words = $number_in_words . numberToWords ($units);
				}
			}
			else
			{
				$number_in_words = $number_in_words . " " . $words[$number];
			}
			
			if( $type == 'vc' )
			{
				return 'columns'. $number_in_words;
			}
			else
			{
				return $number_in_words;
			}
			
		}
		return false;
	}

	/* ------------------------------------
	:: TINYMCE EXTENSION
	   http://plugins.svn.wordpress.org/tinymce-advanced/branches/tinymce-kit/tinymce-kit.php 
	   Plugin URI: http://www.speckygeek.com 
	------------------------------------ */

	 
	function themeva_mce_editor_buttons( $buttons ) {
	   array_unshift( $buttons, 'styleselect' );
	   return $buttons;
	}
	add_filter('mce_buttons', 'themeva_mce_editor_buttons');
	
	function themeva_mce_before_init( $init ) {
	  
		$style_formats = array(  
			array(  
				'title' => 'Text Link Color',  
				'inline' => 'span',  
				'classes' => 'text_linkcolor',
			),		
			array(  
				'title' => 'Highlight Link Color',  
				'inline' => 'span',  
				'classes' => 'highlight one',
			), 
			array(  
				'title' => 'Highlight Black',  
				'inline' => 'span',  
				'classes' => 'highlight two',
			),  
			array(  
				'title' => 'Drop Cap',  
				'inline' => 'span',  
				'classes' => 'dropcap one',
			),
			array(  
				'title' => 'Drop Cap Link Color',  
				'inline' => 'span',  
				'classes' => 'dropcap two link_color',
			),				
			array(  
				'title' => 'Light Font Weight',  
				'inline' => 'span',  
				'classes' => 'light-font-weight',
			),	
			array(  
				'title' => 'Heavy Font Weight',  
				'inline' => 'span',  
				'classes' => 'heavy-font-weight',
			),						
			array(  
				'title' => 'Medium Text',  
				'inline' => 'span',  
				'classes' => 'medium-text',
			),
			array(  
				'title' => 'Big Text',  
				'inline' => 'span',  
				'classes' => 'big-text',
			),
			array(  
				'title' => 'Large Text',  
				'inline' => 'span',  
				'classes' => 'large-text',
			),			
			array(  
				'title' => 'Extra Large Text',  
				'inline' => 'span',  
				'classes' => 'xlarge-text',
			),
			array(  
				'title' => 'Supersize Text',  
				'inline' => 'span',  
				'classes' => 'supersize-text',
			),
			array(  
				'title' => 'Text Shadow',  
				'inline' => 'span',  
				'classes' => 'text-shadow',
			),
			array(  
				'title' => 'White Text',  
				'inline' => 'span',  
				'classes' => 'white-text',
			)					
		);  
	  
	   $init['style_formats'] = json_encode( $style_formats );
	   return $init;
	}
	
	add_filter('tiny_mce_before_init', 'themeva_mce_before_init');	 


	/* ------------------------------------
	:: themeva tinymce shortcodes							      
	--------------------------------------- */
	
	function themeva_add_tinymce() {

        global $typenow;
        if(!in_array($typenow, array('post', 'page'))) return ;

        add_filter( 'mce_external_plugins', 'themeva_add_tinymce_plugin' );
        add_filter( 'mce_buttons', 'themeva_add_tinymce_button' );

    }

    // inlcude the js for tinymce
    function themeva_add_tinymce_plugin( $plugin_array ) {

        $plugin_array['themeva_shortcodes'] = get_template_directory_uri() . '/lib/adm/js/tinymce/tinymce_shortcodes.js';
        return $plugin_array;

    }

    // Add the button key for address via JSs
    function themeva_add_tinymce_button( $buttons ) {

        array_push( $buttons, 'themeva_shortcodes' );
        return $buttons;

    }

    add_action( 'admin_head', 'themeva_add_tinymce' );
	
	add_editor_style();


	/* ------------------------------------
	:: POST COMMENTS
	------------------------------------ */
	
	function nv_fields($fields)
	{
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
	
		$fields = array(
			'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' . 
			'<label for="author">' . __( 'Name','themeva') . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) .'</p>',
			'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.
			'<label for="email">' . __( 'Email','themeva') . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '</p>',
			'url'    => '<p class="comment-form-url"> <input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />'.
			'<label for="url">' . __( 'Website','themeva') . '</label>' . '</p>',
		);
		return $fields;
	}
	
	add_filter('comment_form_default_fields','nv_fields');

	function NorthVantage_comment( $comment, $args, $depth )
	{
		$GLOBALS['comment'] = $comment;	?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header class="comment-meta row">
					<div class="comment-author vcard columns twelve">
						<?php
							$avatar_size = 39;
							if ( '0' != $comment->comment_parent )
								$avatar_size = 39;
	
							echo get_avatar( $comment, $avatar_size );
	
							/* translators: 1: comment author, 2: date and time */
							printf( __( '%1$s %2$s ', 'themeva' ),
								sprintf( '<span class="fn"><h6>%s</h6></span>', get_comment_author_link() ),
								sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
									esc_url( get_comment_link( $comment->comment_ID ) ),
									get_comment_time( 'c' ),
									/* translators: 1: date, 2: time */
									sprintf( __( '%1$s at %2$s', 'themeva' ), get_comment_date(), get_comment_time() )
								)
							);
						 	
							edit_comment_link( __( '- Edit', 'themeva' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-author .vcard -->
	
					<?php if ( $comment->comment_approved == '0' ) : ?>
						<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'themeva' ); ?></em>
						<br />
					<?php endif; ?>
	
				</header>
				<section class="row">
                	<div class="columns twelve">
                        <div class="comment-content"><?php comment_text(); ?></div>
            
                        <div class="reply">
                            <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'themeva' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                        </div><!-- .reply -->
                    </div>
                </section>
			</article><!-- #comment-## -->
	
		<?php
	}

	function nv_recent_comment($comment, $args, $depth)
	{
	   $GLOBALS['comment'] = $comment; ?>
	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		 <div id="comment-<?php comment_ID(); ?>">
		  <div class="comment-author vcard">
			 <?php echo get_avatar( $comment->comment_author_email, 48 ); ?>
	
			 <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
		  </div>
		  <?php if ($comment->comment_approved == '0') : ?>
			 <em><?php _e('Your comment is awaiting moderation.','themeva') ?></em>
			 <br />
		  <?php endif; ?>
	
		  <div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s','themeva'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)','themeva'),'  ','') ?></div>
	
		  <?php comment_text() ?>
	
		  <div class="reply">
			 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		  </div>
		 </div>
	<?php
	}	