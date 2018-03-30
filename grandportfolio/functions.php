<?php
/*
Theme Name: Grand Portfolio Theme
Theme URI: http://themes.themegoods2.com/grandportfolio/landing
Author: ThemeGoods
Author URI: http://themeforest.net/user/ThemeGoods
License: GPLv2
*/

//Setup theme default constant and data
require_once get_template_directory() . "/lib/config.lib.php";

//Setup theme translation
require_once get_template_directory() . "/lib/translation.lib.php";

//Setup theme admin action handler
require_once get_template_directory() . "/lib/admin.action.lib.php";

//Setup theme support and image size handler
require_once get_template_directory() . "/lib/theme.support.lib.php";

//Get custom function
require_once get_template_directory() . "/lib/custom.lib.php";

//Setup menu settings
require_once get_template_directory() . "/lib/menu.lib.php";

//Setup CSS compression related functions
require_once get_template_directory() . "/lib/cssmin.lib.php";

//Setup JS compression related functions
require_once get_template_directory() . "/lib/jsmin.lib.php";

//Setup Sidebar
require_once get_template_directory() . "/lib/sidebar.lib.php";

//Setup theme custom widgets
require_once get_template_directory() . "/lib/widgets.lib.php";

//Setup theme admin settings
require_once get_template_directory() . "/lib/admin.lib.php";


/**
*	Begin Theme Setting Panel
**/ 
function grandportfolio_add_menu_icons_styles(){
?>
 
<style>
#adminmenu .menu-icon-events div.wp-menu-image:before {
  content: '\f145';
}
#adminmenu .menu-icon-portfolios div.wp-menu-image:before {
  content: '\f119';
}
#adminmenu .menu-icon-galleries div.wp-menu-image:before {
  content: '\f161';
}
#adminmenu .menu-icon-testimonials div.wp-menu-image:before {
  content: '\f122';
}
#adminmenu .menu-icon-team div.wp-menu-image:before {
  content: '\f307';
}
#adminmenu .menu-icon-pricing div.wp-menu-image:before {
  content: '\f214';
}
#adminmenu .menu-icon-clients div.wp-menu-image:before {
  content: '\f110';
}
</style>
 
<?php
}
add_action( 'admin_head', 'grandportfolio_add_menu_icons_styles' );

//Create theme admin panel
function grandportfolio_add_admin() 
{
	if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
		//Prevent conflict with demo importer
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		deactivate_plugins('wordpress-importer/wordpress-importer.php');
	}
	
	$grandportfolio_options= grandportfolio_get_options();
	
	if ( isset($_GET['page']) && $_GET['page'] == 'functions.php') {
	 
		if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
	 
			foreach ($grandportfolio_options as $value) 
			{
				if($value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
				{
					update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				}
			}
			
			foreach ($grandportfolio_options as $value) {
			
				if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] )) 
				{ 
	
					if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
					{
						//if sortable type
						if(is_admin() && $value['type'] == 'sortable')
						{
							$sortable_array = serialize($_REQUEST[ $value['id'] ]);
							
							$sortable_data = $_REQUEST[ $value['id'].'_sort_data'];
							$sortable_data_arr = explode(',', $sortable_data);
							$new_sortable_data = array();
							
							foreach($sortable_data_arr as $key => $sortable_data_item)
							{
								$sortable_data_item_arr = explode('_', $sortable_data_item);
								
								if(isset($sortable_data_item_arr[0]))
								{
									$new_sortable_data[] = $sortable_data_item_arr[0];
								}
							}
							
							update_option( $value['id'], $sortable_array );
							update_option( $value['id'].'_sort_data', serialize($new_sortable_data) );
						}
						elseif(is_admin() && $value['type'] == 'font')
						{
							if(!empty($_REQUEST[ $value['id'] ]))
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ] );
								update_option( $value['id'].'_value', $_REQUEST[ $value['id'].'_value' ] );
							}
							else
							{
								delete_option( $value['id'] );
								delete_option( $value['id'].'_value' );
							}
						}
						elseif(is_admin())
						{
							if($value['type']=='image')
							{
								update_option( $value['id'], esc_url($_REQUEST[ $value['id'] ])  );
							}
							elseif($value['type']=='textarea')
							{
								if(isset($value['validation']) && !empty($value['validation']))
								{
									update_option( $value['id'], esc_textarea($_REQUEST[ $value['id'] ]) );
								}
								else
								{
									update_option( $value['id'], $_REQUEST[ $value['id'] ] );
								}
							}
							elseif($value['type']=='iphone_checkboxes' OR $value['type']=='jslider')
							{
								update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
							}
							else
							{
								if(isset($value['validation']) && !empty($value['validation']))
								{
									$request_value = $_REQUEST[ $value['id'] ];
									
									//Begin data validation
									switch($value['validation'])
									{
										case 'text':
										default:
											$request_value = sanitize_text_field($request_value);
										
										break;
										
										case 'email':
											$request_value = sanitize_email($request_value);
	
										break;
										
										case 'javascript':
											$request_value = sanitize_text_field($request_value);
	
										break;
										
									}
									update_option( $value['id'], $request_value);
								}
								else
								{
									update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
								}
							}
						}
					}
					elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
					{
						if($value['id'] == SHORTNAME."_sidebar0")
						{
							//get last sidebar serialize array
							$current_sidebar = get_option(SHORTNAME."_sidebar");
							$request_value = $_REQUEST[ $value['id'] ];
							$request_value = sanitize_text_field($request_value);
							
							$current_sidebar[ $request_value ] = $request_value;
				
							update_option( SHORTNAME."_sidebar", $current_sidebar );
						}
						elseif($value['id'] == SHORTNAME."_ggfont0")
						{
							//get last ggfonts serialize array
							$current_ggfont = get_option(SHORTNAME."_ggfont");
							$current_ggfont[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
				
							update_option( SHORTNAME."_ggfont", $current_ggfont );
						}
					}
				} 
				else 
				{ 
					if(is_admin() && isset($value['id']))
					{
						delete_option( $value['id'] );
					}
				} 
			}
	
			header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
		}  
	} 
	 
	add_theme_page('Theme Setting', 'Theme Setting', 'administrator', 'functions.php', 'grandportfolio_admin', '');
}

function grandportfolio_fonts_url() 
{
    //Get all Google Web font CSS
    $grandportfolio_google_fonts = grandportfolio_get_google_fonts();
    
    $tg_fonts_family = array();
    if(is_array($grandportfolio_google_fonts) && !empty($grandportfolio_google_fonts))
    {
    	foreach($grandportfolio_google_fonts as $tg_font)
    	{
    		$tg_fonts_family[] = kirki_get_option($tg_font);
    	}
    }

    $tg_fonts_family = array_unique($tg_fonts_family);
    $font_families = array();

    foreach($tg_fonts_family as $key => $tg_google_font)
    {	    
        if(!empty($tg_google_font))
        {
        	$font_families[] = $tg_google_font.':300,400,600,700,400italic';
        }
    }
    
    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext,cyrillic-ext,greek-ext,cyrillic' ),
    );
    
    $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
 
    return esc_url_raw( $fonts_url );
}

function grandportfolio_enqueue_admin_page_scripts() 
{
	$current_screen = grandportfolio_get_current_screen();
	
	wp_enqueue_style('thickbox');
	
	if(property_exists($current_screen, 'base') && $current_screen->base != 'toplevel_page_revslider')
	{
		wp_enqueue_style('jquery-ui', get_template_directory_uri().'/functions/jquery-ui/css/custom-theme/jquery-ui-1.8.24.custom.css', false, '1.0', 'all');
	}
	
	wp_enqueue_style('grandportfolio-functions', get_template_directory_uri().'/functions/functions.css', false, THEMEVERSION, 'all');
	
	if(property_exists($current_screen, 'post_type') && ($current_screen->post_type == 'page' OR $current_screen->post_type == 'portfolios'))
	{
		wp_enqueue_style('jqueryui', get_template_directory_uri().'/css/jqueryui/custom.css', false, THEMEVERSION, 'all');
	}
	
	wp_enqueue_style('jquery-colorpicker', get_template_directory_uri().'/functions/colorpicker/css/colorpicker.css', false, THEMEVERSION, 'all');
	wp_enqueue_style('fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox.admin.css', false, THEMEVERSION, 'all');
	wp_enqueue_style('icheck', get_template_directory_uri().'/functions/skins/flat/green.css', false, THEMEVERSION, 'all');
	wp_enqueue_style('timepicker', get_template_directory_uri().'/functions/jquery.timepicker.css', false, '1.0', 'all');
	wp_enqueue_style("fontawesome", get_template_directory_uri()."/css/font-awesome.min.css", false, THEMEVERSION, "all");
	wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, THEMEVERSION, "all");
	
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-ui-datepicker');
	
	$ap_vars = array(
	    'url' => esc_url(get_home_url('/')),
	    'includes_url' => esc_url(includes_url())
	);
	
	wp_register_script('wpeditor', get_template_directory_uri() . '/functions/js-wp-editor.js', array( 'jquery' ), '1.1', true );
	wp_localize_script('wpeditor', 'ap_vars', $ap_vars );
	wp_enqueue_script('wpeditor');
	
	wp_enqueue_script('jquery-colorpicker', get_template_directory_uri().'/functions/colorpicker/js/colorpicker.js', false, THEMEVERSION);
	wp_enqueue_script('eye', get_template_directory_uri().'/functions/colorpicker/js/eye.js', false, THEMEVERSION);
	wp_enqueue_script('utils', get_template_directory_uri().'/functions/colorpicker/js/utils.js', false, THEMEVERSION);
	wp_enqueue_script('icheck', get_template_directory_uri().'/functions/jquery.icheck.min.js', false, THEMEVERSION);
	wp_enqueue_script('fancybox', get_template_directory_uri().'/js/fancybox/jquery.fancybox.admin.js', false, THEMEVERSION);
	wp_enqueue_script('timepicker', get_template_directory_uri().'/functions/jquery.timepicker.js', false, THEMEVERSION);
	
	wp_enqueue_script('grandportfolio-tooltipster', get_template_directory_uri().'/js/jquery.tooltipster.min.js', false, THEMEVERSION);
	wp_register_script( 'grandportfolio-theme-script', get_template_directory_uri().'/functions/rm_script.js', false, THEMEVERSION, true);
	$params = array(
	  'ajaxurl' => esc_url(admin_url('admin-ajax.php')),
	);
	wp_localize_script( 'grandportfolio-theme-script', 'tgAjax', $params );
	wp_enqueue_script( 'grandportfolio-theme-script' );
}

add_action('admin_enqueue_scripts',	'grandportfolio_enqueue_admin_page_scripts' );

function grandportfolio_enqueue_front_page_scripts() 
{
    //enqueue frontend css files
	$pp_advance_combine_css = get_option('pp_advance_combine_css');
	
	//If enable animation
	$pp_animation = get_option('pp_animation');
	
	//Get theme cache folder
	$upload_dir = wp_upload_dir();
	$cache_dir = '';
	$cache_url = '';
	
	if(isset($upload_dir['basedir']))
	{
		$cache_dir = THEMEUPLOAD;
	}
	
	if(isset($upload_dir['baseurl']))
	{
		$cache_url = THEMEUPLOADURL;
	}
	    
	if(!empty($pp_advance_combine_css))
	{
	    if(!file_exists($cache_dir.'/combined.css'))
	    {
	    	$cssmin = new CSSMin();
	    	
	    	$css_arr = array(
	    	    get_template_directory().'/css/reset.css',
	    	    get_template_directory().'/css/wordpress.css',
	    	    get_template_directory().'/css/animation.css',
	    	    get_template_directory().'/css/jqueryui/custom.css',
	    	    get_template_directory().'/js/mediaelement/mediaelementplayer.css',
	    	    get_template_directory().'/js/flexslider/flexslider.css',
	    	    get_template_directory().'/css/tooltipster.css',
	    	    get_template_directory().'/css/odometer-theme-minimal.css',
	    	    get_template_directory().'/css/hw-parallax.css',
	    	    get_template_directory().'/css/screen.css',
	    	);
	    	
	    	//Check menu layout
			$tg_menu_layout = grandportfolio_menu_layout();
			
			switch($tg_menu_layout)
			{
				case 'leftmenu':
					$css_arr[] = get_template_directory_uri().'/css/menus/leftmenu.css';
				break;
				
				case 'leftalign':
				case 'leftalign_center':
				case 'hammenuside':
					$css_arr[] = get_template_directory_uri().'/css/menus/leftalignmenu.css';
				break;
				
				case 'hammenufull':
					$css_arr[] = get_template_directory_uri().'/css/menus/leftalignmenu.css';
					$css_arr[] = get_template_directory_uri().'/css/menus/hammenufull.css';
				break;
			}
	    	
	    	$cssmin->addFiles($css_arr);
	    	
	    	// Set original CSS from all files
	    	$cssmin->setOriginalCSS();
	    	$cssmin->compressCSS();
	    	
	    	$css = $cssmin->printCompressedCSS();
	    	
	    	$wp_filesystem = grandportfolio_get_wp_filesystem();
			$wp_filesystem->put_contents(
			  $cache_dir."combined.css",
			  $css,
			  FS_CHMOD_FILE
			);
	    }
	    
	    wp_enqueue_style("ilightbox", get_template_directory_uri()."/css/ilightbox/ilightbox.css", false, "", "all");
	    wp_enqueue_style("grandportfolio-combined", $cache_url."combined.css", false, "");
	}
	else
	{
		wp_enqueue_style("grandportfolio-reset", get_template_directory_uri()."/css/reset.css", false, "");
		wp_enqueue_style("grandportfolio-wordpress", get_template_directory_uri()."/css/wordpress.css", false, "");
		wp_enqueue_style("grandportfolio-animation", get_template_directory_uri()."/css/animation.css", false, "", "all");
	    wp_enqueue_style("ilightbox", get_template_directory_uri()."/css/ilightbox/ilightbox.css", false, "", "all");
	    wp_enqueue_style("jquery-ui", get_template_directory_uri()."/css/jqueryui/custom.css", false, "");
	    wp_enqueue_style("mediaelement", get_template_directory_uri()."/js/mediaelement/mediaelementplayer.css", false, "", "all");
	    wp_enqueue_style("flexslider", get_template_directory_uri()."/js/flexslider/flexslider.css", false, "", "all");
	    wp_enqueue_style("tooltipster", get_template_directory_uri()."/css/tooltipster.css", false, "", "all");
	    wp_enqueue_style("odometer", get_template_directory_uri()."/css/odometer-theme-minimal.css", false, "", "all");
	    wp_enqueue_style("hw-parallax", get_template_directory_uri().'/css/hw-parallax.css', false, "", "all");
	    wp_enqueue_style("grandportfolio-screen", get_template_directory_uri().'/css/screen.css', false, "", "all");
	}
	
	//Check menu layout
	$tg_menu_layout = grandportfolio_menu_layout();
	
	switch($tg_menu_layout)
	{
		case 'leftmenu':
			wp_enqueue_style("grandportfolio-leftmenu", get_template_directory_uri().'/css/menus/leftmenu.css', false, "", "all");
		break;
		
		case 'leftalign':
		case 'leftalign_center':
		case 'hammenuside':
			wp_enqueue_style("grandportfolio-leftalignmenu", get_template_directory_uri().'/css/menus/leftalignmenu.css', false, "", "all");
		break;
		
		case 'hammenufull':
			wp_enqueue_style("grandportfolio-leftalignmenu", get_template_directory_uri().'/css/menus/leftalignmenu.css', false, "", "all");
			wp_enqueue_style("grandportfolio-hammenufull", get_template_directory_uri().'/css/menus/hammenufull.css', false, "", "all");
		break;
	}
	
	//Add Google Font
	wp_enqueue_style('grandportfolio-fonts', grandportfolio_fonts_url(), array(), null);
	
	//Add Font Awesome Support
	wp_enqueue_style("font-awesome", get_template_directory_uri()."/css/font-awesome.min.css", false, "", "all");
	
	if(THEMEDEMO && isset($_GET['menu']) && !empty($_GET['menu']))
	{
		wp_enqueue_style("grandportfolio-custom-css", admin_url('admin-ajax.php')."?action=grandportfolio_custom_css&menu=".$_GET['menu'], false, "", "all");
	}
	else
	{
		wp_enqueue_style("grandportfolio-custom-css", admin_url('admin-ajax.php')."?action=grandportfolio_custom_css", false, "", "all");
	}
	
	$tg_boxed = kirki_get_option('tg_boxed');
    if(THEMEDEMO && isset($_GET['boxed']) && !empty($_GET['boxed']))
    {
    	$tg_boxed = 1;
    }
    
    if(!empty($tg_boxed) && $tg_menu_layout != 'leftmenu')
    {
    	wp_enqueue_style("grandportfolio-boxed", get_template_directory_uri().'/css/tg_boxed.css', false, "", "all");
    }
	
	//If using child theme
	if(is_child_theme())
	{
	    wp_enqueue_style('grandportfolio-childtheme', get_stylesheet_directory_uri()."/style.css", false, "", "all");
	}
	
	//Enqueue javascripts
	wp_enqueue_script(array('jquery'));
	
	$js_path = get_template_directory()."/js/";
	$js_arr = array(
		'jquery.requestAnimationFrame.js',
		'jquery.mousewheel.min.js',
		'ilightbox.packed.js',
		'jquery.easing.js',
	    'waypoints.min.js',
	    'jquery.isotope.js',
	    'jquery.masory.js',
	    'jquery.tooltipster.min.js',
	    'hw-parallax.js',
	    'masonry.pkgd.min.js',
	    'custom_plugins.js',
	    'custom.js',
	);
	$js = "";

	$pp_advance_combine_js = get_option('pp_advance_combine_js');
	
	if(!empty($pp_advance_combine_js))
	{	
		if(!file_exists($cache_dir."combined.js"))
		{
			foreach($js_arr as $file) {
				if($file != 'jquery.js' && $file != 'jquery-ui.js')
				{
    				$js .= JSMin::minify($wp_filesystem->get_contents($js_path.$file));
    			}
			}
			
			$wp_filesystem->put_contents(
			  $cache_dir."combined.js",
			  $js,
			  FS_CHMOD_FILE
			);
		}

		wp_enqueue_script("grandportfolio-combined", $cache_url."/combined.js", false, "", true);
	}
	else
	{
		wp_enqueue_script("requestAnimationFrame", get_template_directory_uri()."/js/jquery.requestAnimationFrame.js", false, "", true);
		wp_enqueue_script("mousewheel", get_template_directory_uri()."/js/jquery.mousewheel.min.js", false, "", true);
		wp_enqueue_script("ilightbox", get_template_directory_uri()."/js/ilightbox.packed.js", false, "", true);
		wp_enqueue_script("easing", get_template_directory_uri()."/js/jquery.easing.js", false, "", true);
		wp_enqueue_script("waypoints", get_template_directory_uri()."/js/waypoints.min.js", false, "", true);
		wp_enqueue_script("isotope", get_template_directory_uri()."/js/jquery.isotope.js", false, "", true);
		wp_enqueue_script("masory", get_template_directory_uri()."/js/jquery.masory.js", false, "", true);
		wp_enqueue_script("tooltipster", get_template_directory_uri()."/js/jquery.tooltipster.min.js", false, "", true);
		wp_enqueue_script("hw-parallax", get_template_directory_uri()."/js/hw-parallax.js", false, "", true);
		wp_enqueue_script("grandportfolio-masonry", get_template_directory_uri()."/js/masonry.pkgd.min.js", false, THEMEVERSION, false);
		wp_enqueue_script("grandportfolio-custom-plugins", get_template_directory_uri()."/js/custom_plugins.js", false, "", true);
		wp_enqueue_script("grandportfolio-custom-script", get_template_directory_uri()."/js/custom.js", false, "", true);
	}
}
add_action( 'wp_enqueue_scripts', 'grandportfolio_enqueue_front_page_scripts' );


//Enqueue mobile CSS after all others CSS load
function grandportfolio_register_mobile_css() 
{
	//Check if enable responsive layout
	$tg_mobile_responsive = kirki_get_option('tg_mobile_responsive');
	
	if(!empty($tg_mobile_responsive))
	{
		//enqueue frontend css files
		$pp_advance_combine_css = get_option('pp_advance_combine_css');
	
		if(!empty($pp_advance_combine_css))
		{
			wp_enqueue_style("grandportfolio-responsive-css", admin_url('admin-ajax.php')."?action=grandportfolio_responsive_css", false, "", "all");
		}
		else
		{
	    	wp_enqueue_style('grandportfolio-responsive-css', get_template_directory_uri()."/css/grid.css", false, "", "all");
	    }
	}
}
add_action('wp_enqueue_scripts', 'grandportfolio_register_mobile_css', 15);


function grandportfolio_admin() 
{ 
	$grandportfolio_options= grandportfolio_get_options();
	$i=0;
	
	$pp_font_family = get_option('pp_font_family');
	
	if(function_exists( 'wp_enqueue_media' )){
	    wp_enqueue_media();
	}
	?>
		
		<div id="pp_loading"><span><?php esc_html_e('Updating...', 'grandportfolio-translation' ); ?></span></div>
		<div id="pp_success"><span><?php esc_html_e('Successfully Update', 'grandportfolio-translation' ); ?></span></div>
		
		<?php
			if(isset($_GET['saved']) == 'true')
			{
		?>
			<script>
				jQuery('#pp_success').show();
		            	
		        setTimeout(function() {
	              jQuery('#pp_success').fadeOut();
	            }, 2000);
			</script>
		<?php
			}
		?>
		
		<form id="pp_form" method="post" enctype="multipart/form-data">
		<div class="pp_wrap rm_wrap">
		
		<div class="header_wrap">
			<div style="float:left">
			<h2><?php esc_html_e('Theme Setting', 'grandportfolio-translation' ); ?><span class="pp_version">v<?php echo THEMEVERSION; ?></span></h2><br/>
			<a href="http://themes.themegoods2.com/grandportfolio/doc" target="_blank"><?php esc_html_e('Online Documentation', 'grandportfolio-translation' ); ?></a>&nbsp;|&nbsp;<a href="https://themegoods.ticksy.com/" target="_blank"><?php esc_html_e('Theme Support', 'grandportfolio-translation' ); ?></a>
			</div>
			<div style="float:right;margin:32px 0 0 0">
				<!-- input id="save_ppskin" name="save_ppskin" class="button secondary_button" type="submit" value="Save as Skin" / -->
				<input id="save_ppsettings" name="save_ppsettings" class="button button-primary button-large" type="submit" value="<?php esc_html_e('Save All Changes', 'grandportfolio-translation' ); ?>" />
				<br/><br/>
				<input type="hidden" name="action" value="save" />
				<input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_general" />
				<input type="hidden" name="pp_save_skin_flg" id="pp_save_skin_flg" value="" />
				<input type="hidden" name="pp_save_skin_name" id="pp_save_skin_name" value="" />
			</div>
			<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
			<br style="clear:both"/><br/>
	
	<?php
		//Check if theme has new update
	?>
	
		</div>
		
		<div class="pp_wrap">
		<div id="pp_panel">
		<?php 
			foreach ($grandportfolio_options as $value) {
				
				$active = '';
				
				if($value['type'] == 'section')
				{
					if($value['name'] == 'General')
					{
						$active = 'nav-tab-active';
					}
					echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.$active.'"><i class="fa '.$value['icon'].'"></i>'.str_replace('-', ' ', $value['name']).'</a>';
				}
			}
		?>
		</h2>
		</div>
	
		<div class="rm_opts">
		
	<?php 
	$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
	foreach ($grandportfolio_options as $value) {
	switch ( $value['type'] ) {
	 
	case "open":
	?> <?php break;
	 
	case "close":
	?>
		
		</div>
		</div>
	
	
		<?php break;
	 
	case "title":
	?>
		<br />
	
	
	<?php break;
	 
	case 'text':
		
		//if sidebar input then not show default value
		if($value['id'] != SHORTNAME."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
		{
			$default_val = get_option( $value['id'] );
		}
		else
		{
			$default_val = '';	
		}
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>"
			value="<?php if ($default_val != "") { echo esc_attr(get_option( $value['id'])) ; } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.intval($value['size']).'"'; } ?> />
			<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		<?php
		if($value['id'] == SHORTNAME."_sidebar0")
		{
			$current_sidebar = get_option(SHORTNAME."_sidebar");
			
			if(!empty($current_sidebar))
			{
		?>
			<br class="clear"/><br/>
		 	<div class="pp_sortable_wrapper">
			<ul id="current_sidebar" class="rm_list">
	
		<?php
			foreach($current_sidebar as $sidebar)
			{
		?> 
				
				<li id="<?php echo esc_attr($sidebar); ?>"><div class="title"><?php echo esc_html($sidebar); ?></div><a href="<?php echo esc_url($url); ?>" class="sidebar_del" rel="<?php echo esc_attr($sidebar); ?>"><i class="fa fa-trash"></i></a><br style="clear:both"/></li>
		
		<?php
			}
		?>
		
			</ul>
			</div>
		
		<?php
			}
		}
		elseif($value['id'] == SHORTNAME."_ggfont0")
		{
		?>
			<?php esc_html_e('Below are fonts that already installed.', 'grandportfolio-translation' ); ?><br/>
			<select name="<?php echo SHORTNAME; ?>_sample_ggfont" id="<?php echo SHORTNAME; ?>_sample_ggfont">
			<?php 
				foreach ($pp_font_arr as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($option['css-name']); ?>" data-family="<?php echo esc_attr($option['font-name']); ?>"><?php echo esc_html($option['font-name']); ?></option>
			<?php } ?>
			</select> 
		<?php
			$current_ggfont = get_option(SHORTNAME."_ggfont");
			
			if(!empty($current_ggfont))
			{
		?>
			<br class="clear"/><br/>
		 	<div class="pp_sortable_wrapper">
			<ul id="current_ggfont" class="rm_list">
	
		<?php
		
			foreach($current_ggfont as $ggfont)
			{
		?> 
				
				<li id="<?php echo esc_attr($ggfont); ?>"><div class="title"><?php echo esc_html($ggfont); ?></div><a href="<?php echo esc_url($url); ?>" class="ggfont_del" rel="<?php echo esc_attr($ggfont); ?>"><i class="fa fa-trash"></i></a><br style="clear:both"/></li>
		
		<?php
			}
		?>
		
			</ul>
			</div>
		
		<?php
			}
		}
		?>
	
		</div>
		<?php
	break;
	
	case 'password':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="<?php echo esc_attr($value['type']); ?>"
			value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
	
		</div>
		<?php
	break;
	
	break;
	
	case 'image':
	case 'music':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input id="<?php echo esc_attr($value['id']); ?>" type="text" name="<?php echo esc_attr($value['id']); ?>" value="<?php echo get_option($value['id']); ?>" style="width:200px" class="upload_text" readonly />
		<input id="<?php echo esc_attr($value['id']); ?>_button" name="<?php echo esc_attr($value['id']); ?>_button" type="button" value="Browse" class="upload_btn button" rel="<?php echo esc_attr($value['id']); ?>" style="margin:5px 0 0 5px" />
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		<script>
		jQuery(document).ready(function() {
			jQuery('#<?php echo esc_js($value['id']); ?>_button').click(function() {
	         	var send_attachment_bkp = wp.media.editor.send.attachment;
			    wp.media.editor.send.attachment = function(props, attachment) {
			    	formfield = jQuery('#<?php echo esc_js($value['id']); ?>').attr('name');
		         	jQuery('#'+formfield).attr('value', attachment.url);
			
			        wp.media.editor.send.attachment = send_attachment_bkp;
			    }
			
			    wp.media.editor.open();
	        });
	    });
		</script>
		
		<?php 
			$current_value = get_option( $value['id'] );
			
			if(!is_bool($current_value) && !empty($current_value))
			{
				$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
			
				if($value['type']=='image')
				{
		?>
		
			<div id="<?php echo esc_attr($value['id']); ?>_wrapper" style="width:380px;font-size:11px;"><br/>
				<img src="<?php echo get_option($value['id']); ?>" style="max-width:500px"/><br/><br/>
				<a href="<?php echo esc_url($url); ?>" class="image_del button" rel="<?php echo esc_attr($value['id']); ?>"><?php esc_html_e('Delete', 'grandportfolio-translation' ); ?></a>
			</div>
			<?php
				}
				else
				{
			?>
			<div id="<?php echo esc_attr($value['id']); ?>_wrapper" style="width:380px;font-size:11px;">
				<br/><a href="<?php echo get_option( $value['id'] ); ?>">
				<?php esc_html_e('Listen current music', 'grandportfolio-translation' ); ?></a>&nbsp;<a href="<?php echo esc_url($url); ?>" class="image_del button" rel="<?php echo esc_attr($value['id']); ?>"><?php esc_html_e('Delete', 'grandportfolio-translation' ); ?></a>
			</div>
		<?php
				}
			}
		?>
	
		</div>
		<?php
	break;
	
	case 'jslider':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<div style="float:left;width:290px;margin-top:10px">
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="text" class="jslider"
			value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
		</div>
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		<script>jQuery("#<?php echo esc_js($value['id']); ?>").slider({ from: <?php echo esc_js($value['from']); ?>, to: <?php echo esc_js($value['to']); ?>, step: <?php echo esc_js($value['step']); ?>, smooth: true, skin: "round_plastic" });</script>
	
		</div>
		<?php
	break;
	
	case 'colorpicker':
	?>
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_text"><label for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<input name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" type="text" 
			value="<?php if ( get_option( $value['id'] ) != "" ) { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?>"
			<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker" readonly/>
		<div id="<?php echo esc_attr($value['id']); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($value['id']); ?>').click()" style="background:<?php if (get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo esc_attr($value['std']); } ?> url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png) center no-repeat;">&nbsp;</div>
			<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		
		</div>
		
	<?php
	break;
	 
	case 'textarea':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_textarea"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
		<textarea name="<?php echo esc_attr($value['id']); ?>"
			type="<?php echo esc_attr($value['type']); ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo esc_html($value['std']); } ?></textarea>
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
	
		</div>
	
		<?php
	break;
	 
	case 'select':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<?php foreach ($value['options'] as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($key); ?>"><?php echo esc_html($option); ?></option>
			<?php } ?>
		</select> <small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'font':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_font"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div id="<?php echo esc_attr($value['id']); ?>_wrapper" style="float:left;font-size:11px;">
		<select class="pp_font" data-sample="<?php echo esc_attr($value['id']); ?>_sample" data-value="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>">
			<option value="" data-family="">---- <?php esc_html_e('Theme Default Font', 'grandportfolio-translation' ); ?> ----</option>
			<?php 
				foreach ($pp_font_arr as $key => $option) { ?>
			<option
			<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
				value="<?php echo esc_attr($option['css-name']); ?>" data-family="<?php echo esc_attr($option['font-name']); ?>"><?php echo esc_html($option['font-name']); ?></option>
			<?php } ?>
		</select> 
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_value" name="<?php echo esc_attr($value['id']); ?>_value" value="<?php echo get_option( $value['id'].'_value' ); ?>"/>
		<br/><br/><div id="<?php echo esc_attr($value['id']); ?>_sample" class="pp_sample_text"><?php esc_html_e('Sample Text', 'grandportfolio-translation' ); ?></div>
		</div>
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case 'radio':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/><br/>
	
		<div style="margin-top:5px;float:left;<?php if(!empty($value['desc'])) { ?>width:300px<?php } else { ?>width:500px<?php } ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<div style="float:left;<?php if(!empty($value['desc'])) { ?>margin:0 20px 20px 0<?php } ?>">
			<input style="float:left;" id="<?php echo esc_attr($value['id']); ?>" name="<?php echo esc_attr($value['id']); ?>" type="radio"
			<?php if (get_option( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
				value="<?php echo esc_attr($key); ?>"/><?php echo esc_html($option); ?>
		</div>
		<?php } ?>
		</div>
		
		<?php if(!empty($value['desc'])) { ?>
			<small><?php echo stripslashes($value['desc']); ?></small>
		<?php } ?>
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	
	case 'sortable':
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_select"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<div style="float:left;width:100%;">
		<?php 
		$sortable_array = array();
		if(get_option( $value['id'] ) != 1)
		{
			$sortable_array = unserialize(get_option( $value['id'] ));
		}
		
		$current = 1;
		
		if(!empty($value['options']))
		{
		?>
		<select name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" class="pp_sortable_select">
		<?php
		foreach ($value['options'] as $key => $option) { 
			if($key > 0)
			{
		?>
		<option value="<?php echo esc_attr($key); ?>" data-rel="<?php echo esc_attr($value['id']); ?>_sort" title="<?php echo html_entity_decode($option); ?>"><?php echo html_entity_decode($option); ?></option>
		<?php }
		
				if($current>1 && ($current-1)%3 == 0)
				{
		?>
		
				<br style="clear:both"/>
		
		<?php		
				}
				
				$current++;
			}
		?>
		</select>
		<a class="button pp_sortable_button" data-rel="<?php echo esc_attr($value['id']); ?>" class="button" style="margin-top:10px;display:inline-block">Add</a>
		<?php
		}
		?>
		 
		 <br style="clear:both"/><br/>
		 
		 <div class="pp_sortable_wrapper">
		 <ul id="<?php echo esc_attr($value['id']); ?>_sort" class="pp_sortable" rel="<?php echo esc_attr($value['id']); ?>_sort_data"> 
		 <?php
		 	$sortable_data_array = unserialize(get_option( $value['id'].'_sort_data' ));
	
		 	if(!empty($sortable_data_array))
		 	{
		 		foreach($sortable_data_array as $key => $sortable_data_item)
		 		{
			 		if(!empty($sortable_data_item))
			 		{
		 		
		 ?>
		 		<li id="<?php echo esc_attr($sortable_data_item); ?>_sort" class="ui-state-default"><div class="title"><?php echo esc_html($value['options'][$sortable_data_item]); ?></div><a data-rel="<?php echo esc_attr($value['id']); ?>_sort" href="javascript:;" class="remove"><i class="fa fa-trash"></i></a><br style="clear:both"/></li> 	
		 <?php
		 			}
		 		}
		 	}
		 ?>
		 </ul>
		 
		 </div>
		 
		</div>
		
		<input type="hidden" id="<?php echo esc_attr($value['id']); ?>_sort_data" name="<?php echo esc_attr($value['id']); ?>_sort_data" value="" style="width:100%"/>
		<br style="clear:both"/><br/>
		
		<div class="clearfix"></div>
		</div>
		<?php
	break;
	 
	case "checkbox":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
	
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
	<?php break; 
	
	case "iphone_checkboxes":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label>
	
		<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
		<input type="checkbox" class="iphone_checkboxes" name="<?php echo esc_attr($value['id']); ?>"
			id="<?php echo esc_attr($value['id']); ?>" value="true" <?php echo esc_html($checked); ?> />
	
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "html":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_checkbox"><label
			for="<?php echo esc_attr($value['id']); ?>"><?php echo stripslashes($value['name']); ?></label><br/>
	
		<?php echo stripslashes($value['html']); ?>
	
		<small><?php echo stripslashes($value['desc']); ?></small>
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
	
	case "shortcut":
	?>
	
		<div id="<?php echo esc_attr($value['id']); ?>_section" class="rm_input rm_shortcut">
	
		<ul class="pp_shortcut_wrapper">
		<?php 
			$count_shortcut = 1;
			foreach ($value['options'] as $key_shortcut => $option) { ?>
			<li><a href="#<?php echo esc_attr($key_shortcut); ?>" <?php if($count_shortcut==1) { ?>class="active"<?php } ?>><?php echo esc_html($option); ?></a></li>
		<?php $count_shortcut++; } ?>
		</ul>
	
		<div class="clearfix"></div>
		</div>
	
	<?php break; 
		
	case "section":
	
	$i++;
	
	?>
	
		<div id="pp_panel_<?php echo strtolower($value['name']); ?>" class="rm_section">
		<div class="rm_title">
		<h3><img
			src="<?php echo get_template_directory_uri(); ?>/functions/images/trans.png"
			class="inactive" alt=""><?php echo stripslashes($value['name']); ?></h3>
		<span class="submit"><input class="button-primary" name="save<?php echo esc_attr($i); ?>" type="submit"
			value="Save changes" /> </span>
		<div class="clearfix"></div>
		</div>
		<div class="rm_options"><?php break;
	 
	}
	}
	?>
	 	
	 	<div class="clearfix"></div>
	 	</form>
	 	</div>
	</div>
<?php
}

add_action('admin_menu', 'grandportfolio_add_admin');

/**
*	End Theme Setting Panel
**/ 


//Setup theme custom filters
require_once get_template_directory() . "/lib/theme.filter.lib.php";

//Setup required plugin activation
require_once get_template_directory() . "/lib/tgm.lib.php";

//Setup Theme Customizer
require_once get_template_directory() . "/modules/kirki/kirki.php";
require_once get_template_directory() . "/lib/customizer.lib.php";

//Setup page custom fields and action handler
require_once get_template_directory() . "/fields/page.fields.php";

//Setup content builder
require_once get_template_directory() . "/modules/content_builder.php";

// Setup shortcode generator
require_once get_template_directory() . "/modules/shortcode_generator.php";


//Check if Woocommerce is installed	
if(class_exists('Woocommerce'))
{
	//Setup Woocommerce Config
	require_once get_template_directory() . "/modules/woocommerce.php";
}

/**
*	Setup AJAX portfolio content builder function
**/
add_action('wp_ajax_grandportfolio_ppb', 'grandportfolio_ppb');
add_action('wp_ajax_nopriv_grandportfolio_ppb', 'grandportfolio_ppb');

function grandportfolio_ppb() {
	if(is_admin() && isset($_GET['shortcode']) && !empty($_GET['shortcode']))
	{
		if(isset($ppb_post_type) && $ppb_post_type == 'page')
		{
			require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		}
		else if(isset($ppb_post_type) && $ppb_post_type == 'projects')
		{
			require_once get_template_directory() . "/lib/contentbuilder_project.shortcode.lib.php";
		}
		else
		{
			require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		}
		//pp_debug($ppb_shortcodes);
		
		if(isset($ppb_shortcodes[$_GET['shortcode']]) && !empty($ppb_shortcodes[$_GET['shortcode']]))
		{
			$selected_shortcode = $_GET['shortcode'];
			$selected_shortcode_arr = $ppb_shortcodes[$_GET['shortcode']];
			//pp_debug($selected_shortcode_arr);
?>

			<div class="ppb_inline_wrap">
				<h2><?php echo esc_html($selected_shortcode_arr['title']); ?></h2>
				<a id="save_<?php echo esc_attr($_GET['rel']); ?>" data-parent="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" class="button-primary ppb_inline_save" href="javascript:;"><?php esc_html_e('Update', 'grandportfolio-translation' ); ?></a>
				<a class="button" href="javascript:;" onClick="jQuery.fancybox.close();">Cancel</a>
			</div>
			<div id="ppb_inline_<?php echo esc_attr($selected_shortcode); ?>" data-shortcode="<?php echo esc_attr($selected_shortcode); ?>" class="ppb_inline">
			<div class="ppb_inline_option_wrap">
				<?php
					if(isset($selected_shortcode_arr['title']) && $selected_shortcode_arr['title']!='Divider')
					{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_title"><?php esc_html_e('Title', 'grandportfolio-translation' ); ?></label><br/>
					<input type="text" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="Title" class="ppb_input"/>
					<span class="label_desc"><?php esc_html_e('Enter Title for this content', 'grandportfolio-translation' ); ?></span>
				</div>
				<br/>
				<?php
					}
					else
					{
				?>
				<input type="hidden" id="<?php echo esc_attr($selected_shortcode); ?>_title" name="<?php echo esc_attr($selected_shortcode); ?>_title" data-attr="title" value="<?php echo esc_attr($selected_shortcode_arr['title']); ?>" class="ppb_input"/>
				<?php
					}
				?>
				
				<?php
					foreach($selected_shortcode_arr['attr'] as $attr_name => $attr_item)
					{
						if(!isset($attr_item['title']))
						{
							$attr_title = ucfirst($attr_name);
						}
						else
						{
							$attr_title = $attr_item['title'];
						}
					
						if($attr_item['type']=='jslider')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="range" class="ppb_input" min="<?php echo esc_attr($attr_item['min']); ?>" max="<?php echo esc_attr($attr_item['max']); ?>" step="<?php echo esc_attr($attr_item['step']); ?>" value="<?php echo esc_attr($attr_item['std']); ?>" /><output for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" onforminput="value = foo.valueAsNumber;"></output><br/>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="jslider"/>
				</div>
				<br/>
				<?php
						}
				
						if($attr_item['type']=='file')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text"  class="ppb_input ppb_file" />
					<a id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>">Upload</a>
					<img id="image_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_file_image" />
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="file"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='video')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text"  class="ppb_input ppb_file" />
					<a id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_button" type="button" class="metabox_upload_btn button" rel="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>">Upload</a>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<br/><a id="video_view_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="button ppb_video_url" target="_blank"><?php echo esc_html__('View Video', 'grandportfolio-translation' ); ?></a>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="video"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
						?>
								<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
								}
						?>
					</select><br style="clear:both"/>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='select_multiple')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<select name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" class="ppb_input" multiple="multiple">
						<?php
								foreach($attr_item['options'] as $attr_key => $attr_item_option)
								{
									if(!empty($attr_item_option))
									{
						?>
									<option value="<?php echo esc_attr($attr_key); ?>"><?php echo ucfirst($attr_item_option); ?></option>
						<?php
									}
								}
						?>
					</select><br style="clear:both"/>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="select_multiple"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='text')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input" />
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="text"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='colorpicker')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<input name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" type="text" class="ppb_input color_picker" />
					<div id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo esc_js($selected_shortcode); ?>_<?php echo esc_js($attr_name); ?>').click()" style="background-color:<?php echo esc_attr($attr_item['std']); ?>;background-image: url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png);margin-top:3px">&nbsp;</div><br style="clear:both"/>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="colorpicker"/>
				</div>
				<br/>
				<?php
						}
						
						if($attr_item['type']=='textarea')
						{
				?>
				<div class="ppb_inline_option">
					<label for="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>"><?php echo esc_html($attr_title); ?></label><br/>
					<textarea name="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" id="<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" cols="" rows="3" class="ppb_input"></textarea>
					<span class="label_desc"><?php echo esc_html($attr_item['desc']); ?></span>
					
					<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="textarea"/>
				</div>
				<br/>
				<?php
						}
					}
				?>
				
				<?php
					if(isset($selected_shortcode_arr['content']) && $selected_shortcode_arr['content'])
					{
				?>
					<div class="ppb_inline_option">
						<label for="<?php echo esc_attr($selected_shortcode); ?>_content"><?php esc_html_e('Content', 'grandportfolio-translation' ); ?></label><br/>
						<textarea id="<?php echo esc_attr($selected_shortcode); ?>_content" name="<?php echo esc_attr($selected_shortcode); ?>_content" cols="" rows="7" class="ppb_input"></textarea>
						<span class="label_desc"><?php esc_html_e('You can enter text, HTML for its content', 'grandportfolio-translation' ); ?></span>
						
						<input type="hidden" id="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" name="type_<?php echo esc_attr($selected_shortcode); ?>_<?php echo esc_attr($attr_name); ?>" value="content"/>
					</div>
				<?php
					}
				?>
			</div>
		</div>
		<br/>
		
		<script>
		jQuery(document).ready(function(){
			var formfield = '';
			
			jQuery('#ppb_options_unsaved').val(1);
	
			jQuery('.metabox_upload_btn').click(function() {
			    jQuery('.fancybox-overlay').css('visibility', 'hidden');
			    jQuery('.fancybox-wrap').css('visibility', 'hidden');
		     	formfield = jQuery(this).attr('rel');
			    
			    var send_attachment_bkp = wp.media.editor.send.attachment;
			    wp.media.editor.send.attachment = function(props, attachment) {
			     	jQuery('#'+formfield).attr('value', attachment.url);
			     	jQuery('#image_'+formfield).attr('src', attachment.url);
			
			        wp.media.editor.send.attachment = send_attachment_bkp;
			        jQuery('.fancybox-overlay').css('visibility', 'visible');
			     	jQuery('.fancybox-wrap').css('visibility', 'visible');
			    }
			
			    wp.media.editor.open();
		     	return false;
		    });
		
			jQuery("#ppb_inline :input").each(function(){
				if(typeof jQuery(this).attr('id') != 'undefined')
				{
					 jQuery(this).attr('value', '');
				}
			});
			
			var currentItemData = jQuery('#<?php echo esc_js($_GET['rel']); ?>').data('ppb_setting');
			var currentItemOBJ = jQuery.parseJSON(currentItemData);
			
			jQuery.each(currentItemOBJ, function(index, value) { 
			  	if(typeof jQuery('#'+index) != 'undefined')
				{
					jQuery('#'+index).val(decodeURI(value));
					
					//If textarea then convert to visual editor
					if(jQuery('#'+index).is('textarea'))
					{
						jQuery('#'+index).html(decodeURI(value));
						jQuery('#'+index).wp_editor();
					}
					
					//Check if in put file
					if(jQuery('#type_'+index).val()=='file')
					{
						jQuery('#image_'+index).attr('src', value);
					}
					
					//Check if in put video
					if(jQuery('#type_'+index).val()=='video')
					{
						jQuery('#video_view_'+index).attr('href', value);
					}
				}
			});
			
			jQuery('.color_picker').each(function()
			{	
			    var inputID = jQuery(this).attr('id');
			    
			    jQuery(this).ColorPicker({
			    	color: jQuery(this).val(),
			    	onShow: function (colpkr) {
			    		jQuery(colpkr).fadeIn(200);
			    		return false;
			    	},
			    	onHide: function (colpkr) {
			    		jQuery(colpkr).fadeOut(200);
			    		return false;
			    	},
			    	onChange: function (hsb, hex, rgb, el) {
			    		jQuery('#'+inputID).val('#' + hex);
			    		jQuery('#'+inputID+'_bg').css('backgroundColor', '#' + hex);
			    	}
			    });	
			    
			    jQuery(this).css('width', '200px');
			    jQuery(this).css('float', 'left');
			});
			
			var el, newPoint, newPlace, offset;
 
			 jQuery("input[type='range']").change(function() {
			 
			   el = jQuery(this);
			   
			   width = el.width();
			   newPoint = (el.val() - el.attr("min")) / (el.attr("max") - el.attr("min"));
			   el.next("output").text(el.val());
			 })
			 .trigger('change');
			
			jQuery("#save_<?php echo esc_js($_GET['rel']); ?>").click(function(){
				tinyMCE.triggerSave();
			
			    var targetItem = jQuery('#ppb_inline_current').attr('value');
			    var parentInline = jQuery(this).attr('data-parent');
			    var currentItemData = jQuery('#'+targetItem).find('.ppb_setting_data').attr('value');
			    var currentShortcode = jQuery('#'+parentInline).attr('data-shortcode');
			    
			    var itemData = {};
			    itemData.id = targetItem;
			    itemData.shortcode = currentShortcode;
			    
			    jQuery("#"+parentInline+" :input.ppb_input").each(function(){
			     	if(typeof jQuery(this).attr('id') != 'undefined')
			     	{	
			    	 	itemData[jQuery(this).attr('id')] = encodeURI(jQuery(this).attr('value'));
			    	 	
				    	 if(jQuery(this).attr('data-attr') == 'title')
				    	 {
				    	  	jQuery('#'+targetItem).find('.title').html(decodeURI(jQuery(this).attr('value')));
				    	  	if(jQuery('#'+targetItem).find('.ppb_unsave').length==0)
				    	  	{
				    	  		jQuery('<a href="javascript:;" class="ppb_unsave">Unsaved</a>').insertAfter(jQuery('#'+targetItem).find('.title'));
				    	  		
				    	  		jQuery('#ppb_options_unsaved').val(1);
				    	  	}
				    	 }
			     	}
			    });
			    
			    var currentItemDataJSON = JSON.stringify(itemData);
			    jQuery('#'+targetItem).data('ppb_setting', currentItemDataJSON);
			    
			    jQuery.fancybox.close();
			});
			
			jQuery.fancybox.hideLoading();
		});
		</script>
<?php
		}
	}
	
	die();
}

/**
*	Begin theme custom AJAX calls handler
**/

/**
*	Setup AJAX portfolio content builder preview function
**/
add_action('wp_ajax_grandportfolio_ppb_preview', 'grandportfolio_ppb_preview');
add_action('wp_ajax_nopriv_grandportfolio_ppb_preview', 'grandportfolio_ppb_preview');

function grandportfolio_ppb_preview() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']) && isset($_GET['rel']) && !empty($_GET['rel']))
	{
		$page_id = $_GET['page_id'];
		$page_title = $_GET['title'];
		$ppb_form_item = $_GET['rel'];
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview=true&rel='.$ppb_form_item;
?>
	<div class="ppb_inline_wrap preview">
	    <h2><?php esc_html_e('Preview', 'grandportfolio-translation' ); ?> <?php echo urldecode($page_title); ?></h2>
	    <a class="button button-primary" href="javascript:;" onClick="jQuery.fancybox.close();"><?php esc_html_e('Close', 'grandportfolio-translation' ); ?></a>
	</div>	
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}

/**
*	Setup AJAX portfolio content builder preview page function
**/
add_action('wp_ajax_grandportfolio_ppb_preview_page', 'grandportfolio_ppb_preview_page');
add_action('wp_ajax_nopriv_grandportfolio_ppb_preview_page', 'grandportfolio_ppb_preview_page');

function grandportfolio_ppb_preview_page() {
	if(is_admin() && isset($_GET['page_id']) && !empty($_GET['page_id']))
	{
		$page_id = $_GET['page_id'];
		$page_title = get_the_title($page_id);
		$preview_url = get_permalink($page_id);
		$preview_url.= '?ppb_preview_page=true';
?>
	<div class="ppb_inline_wrap preview">
	    <h2><?php esc_html_e('Preview', 'grandportfolio-translation' ); ?> <?php echo urldecode($page_title); ?></h2>
	    <a class="button button-primary" href="javascript:;" onClick="jQuery.fancybox.close();"><?php esc_html_e('Close', 'grandportfolio-translation' ); ?></a>
	</div>	
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
	}
	die();
}


/**
*	Setup AJAX portfolio content builder set data for preview page function
**/
add_action('wp_ajax_grandportfolio_ppb_preview_page_set_data', 'grandportfolio_ppb_preview_page_set_data');
add_action('wp_ajax_nopriv_grandportfolio_ppb_preview_page_set_data', 'grandportfolio_ppb_preview_page_set_data');

function grandportfolio_ppb_preview_page_set_data() {
	
	if(is_admin() && isset($_POST['page_id']) && !empty($_POST['page_id']))
	{
		$page_id = $_POST['page_id'];
		//$data = mb_convert_encoding($_POST['data'],'UTF-8','UTF-8');
		//$data = json_decode($_POST['data']);
		//var_dump($_POST['data']);
		//var_dump($_POST['data_order']);
		$data_order = $_POST['data_order'];
		
		//Set data order to WordPress cache
		set_transient('grandportfolio_'.$page_id.'_data_order', $data_order, 3600 );
		
		//Convert order data to array
		$ppb_form_item_arr = array();
		if(!empty($data_order))
		{
		    $ppb_form_item_arr = explode(',', $data_order);
		}
		
		if(isset($ppb_form_item_arr[0]) && !empty($ppb_form_item_arr[0]))
		{
		    $data_arr = array();
		    $size_arr = array();
		
		    foreach($ppb_form_item_arr as $key => $ppb_form_item)
		    {
		    	if(isset($_POST[$ppb_form_item.'_data']))
		    	{
			    	$data_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_data'];
			    	$size_arr[$ppb_form_item] = $_POST[$ppb_form_item.'_size'];
		    	}
		    }
		}
		
		set_transient('grandportfolio_'.$page_id.'_data', $data_arr, 3600 );
		set_transient('grandportfolio_'.$page_id.'_size', $size_arr, 3600 );
?>
	
<?php
	}
	die();
}

/**
*	Setup preview demo page function
**/
add_action('wp_ajax_grandportfolio_ppb_demo_preview', 'grandportfolio_ppb_demo_preview');
add_action('wp_ajax_nopriv_grandportfolio_ppb_demo_preview', 'grandportfolio_ppb_demo_preview');

function grandportfolio_ppb_demo_preview() {
	if(is_admin() && isset($_POST['key']) && !empty($_POST['key']))
	{
		require_once get_template_directory() . "/lib/contentbuilder.shortcode.lib.php";
		
		if(isset($ppb_shortcodes[$_POST['key']]))
		{
			$page_title = $ppb_shortcodes[$_POST['key']]['title'];
			$preview_url = $ppb_shortcodes[$_POST['key']]['url'];
?>
	<div class="ppb_inline_wrap preview">
	    <h2><?php esc_html_e('Preview', 'grandportfolio-translation' ); ?> <?php echo urldecode($page_title); ?></h2>
	    <a class="button button-primary" href="javascript:;" onClick="jQuery.fancybox.close();"><?php esc_html_e('Close', 'grandportfolio-translation' ); ?></a>
	</div>	
	<iframe id="ppb_preview_frame" src="<?php echo esc_url($preview_url); ?>"></iframe>
<?php
		}
	}
	die();
}

/**
*	Setup one click importer function
**/
add_action('wp_ajax_grandportfolio_import_demo_content', 'grandportfolio_import_demo_content');
add_action('wp_ajax_nopriv_grandportfolio_import_demo_content', 'grandportfolio_import_demo_content');

function grandportfolio_import_demo_content() {
	if(is_admin() && isset($_POST['demo']) && !empty($_POST['demo']))
	{
	    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
	    
	    // Load Importer API
	    require_once ABSPATH . 'wp-admin/includes/import.php';
	
	    if ( ! class_exists( 'WP_Importer' ) ) {
	        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	        if ( file_exists( $class_wp_importer ) )
	        {
	            require $class_wp_importer;
	        }
	    }
	
	    if ( ! class_exists( 'WP_Import' ) ) {
	    	$class_wp_importer = ABSPATH . 'wp-content/plugins/wordpress-importer/wordpress-importer.php';
	        if ( file_exists( $class_wp_importer ) )
	            require $class_wp_importer;
	    }
	
	    $import_files = array();
	    $page_on_front ='';

		//Check import selected demo
	    if ( class_exists( 'WP_Import' ) ) 
	    { 
	    	switch($_POST['demo'])
	    	{
		    	case 99:
		    	default:
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo']."_woo.xml" ;
		    		}
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/landing';
		    		
		    		$page_on_front = 3602; //Demo Homepage ID
		    		
		    		$locations = get_theme_mod('nav_menu_locations');
					$locations['primary-menu'] = 22;
					$locations['top-menu'] = 25;
					$locations['side-menu'] = 24;
		    	break;
		    	
		    	case 1:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo1';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4591; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
					$locations['side-menu'] = 20;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
		    	break;
		    	
		    	case 2:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo2';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4449; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['top-menu'] = 15;
					$locations['side-menu'] = 15;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
					set_theme_mod( 'tg_blog_slider_layout', '2cols-slider' );
		    	break;
		    	
		    	case 3:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo3';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4553; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['primary-menu'] = 18;
					$locations['side-menu'] = 18;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
		    	break;
		    	
		    	case 4:
		    		//Set demo XML file path
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo']."_woo.xml" ;
		    		}
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo4';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4520; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['primary-menu'] = 18;
					$locations['side-menu'] = 18;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
		    	break;
		    	
		    	case 5:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo5';
		    		
		    		//Set default demo pages
		    		$page_on_front = 18; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['primary-menu'] = 14;
					$locations['side-menu'] = 14;
		    	break;
		    	
		    	case 6:
		    		//Set demo XML file path
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo']."_woo.xml" ;
		    		}
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo6';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4526; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
					$locations['side-menu'] = 14;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
		    	break;
		    	
		    	case 7:
		    		//Set demo XML file path
		    		//Check if install Woocommerce
		    		if(!class_exists('Woocommerce'))
					{
		    			$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		}
		    		else
		    		{
			    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo']."_woo.xml" ;
		    		}
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo7';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4539; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
					$locations['primary-menu'] = 19;
					$locations['side-menu'] = 19;
					
					//Set default Blog Slider category
					set_theme_mod( 'tg_blog_slider_cat', '2' );
		    	break;
		    	
		    	case 8:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo8';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4647; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['primary-menu'] = 21;
					$locations['side-menu'] = 21;
					$locations['footer-menu'] = 21;
		    	break;
		    	
		    	case 9:
		    		//Set demo XML file path
		    		$import_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".xml" ;
		    		$styling_file = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".dat" ;
		    		$oldurl = 'http://themes.themegoods2.com/grandportfolio/demo9';
		    		
		    		//Set default demo pages
		    		$page_on_front = 4647; //Demo Homepage ID
		    		
		    		//Set default demo menu location
		    		$locations = get_theme_mod('nav_menu_locations');
		    		$locations['primary-menu'] = 21;
					$locations['side-menu'] = 21;
					$locations['footer-menu'] = 21;
		    	break;
	    	}
			
			//Run and download demo contents
			$wp_import = new WP_Import();
	        $wp_import->fetch_attachments = true;
	        $wp_import->import($import_filepath);
	    }
	    
	    //Setup default front page settings.
	    update_option('show_on_front', 'page');
	    update_option('page_on_front', $page_on_front);
	    
	    //Set default custom menu settings
		set_theme_mod( 'nav_menu_locations', $locations );
		
		//Import Demo Stlying
		require_once ABSPATH . 'wp-admin/includes/file.php';

		if(file_exists($styling_file))
		{
			WP_Filesystem();
			$wp_filesystem = grandportfolio_get_wp_filesystem();
			$styling_data = $wp_filesystem->get_contents($styling_file);
			$styling_data_arr = unserialize($styling_data);
			
			if(isset($styling_data_arr['mods']) && is_array($styling_data_arr['mods']))
			{	
				// Get menu locations and save to array
				$locations = get_theme_mod('nav_menu_locations');
				$save_menus = array();
				foreach( $locations as $key => $val ) 
				{
					$save_menus[$key] = $val;
				}
			
				//Remove all theme customizer
				remove_theme_mods();
				
				//Re-add the menus
				set_theme_mod('nav_menu_locations', array_map( 'absint', $save_menus ));
			
				foreach($styling_data_arr['mods'] as $key => $styling_mod)
				{
					if(!is_array($styling_mod))
					{
						set_theme_mod( $key, $styling_mod );
					}
				}
			}
		}
		
		//Import widgets
		if(file_exists($import_widget_filepath = get_template_directory() ."/cache/demos/importer/demo".$_POST['demo']."/".$_POST['demo'].".wie"))
		{
			// Get file contents and decode
			WP_Filesystem();
			$wp_filesystem = grandportfolio_get_wp_filesystem();
			$data = $wp_filesystem->get_contents($import_widget_filepath);
			$data = json_decode( $data );
		
			// Import the widget data
			// Make results available for display on import/export page
			$widget_import_results = grandportfolio_import_data( $data );
		}
		
		//Change all URLs from demo URL to localhost
		$update_options = array ( 0 => 'content', 1 => 'excerpts', 2 => 'links', 3 => 'attachments', 4 => 'custom', 5 => 'guids', );
		$newurl = esc_url( site_url() ) ;
		grandportfolio_update_urls($update_options, $oldurl, $newurl);
		
		//Refresh rewrite rules
		flush_rewrite_rules();
	    
		exit();
	}
}

/**
*	Setup get styling function
**/
add_action('wp_ajax_grandportfolio_get_styling', 'grandportfolio_get_styling');
add_action('wp_ajax_nopriv_grandportfolio_get_styling', 'grandportfolio_get_styling');

function grandportfolio_get_styling() {
	if(is_admin() && isset($_POST['styling']) && !empty($_POST['styling']))
	{
	    require_once ABSPATH . 'wp-admin/includes/file.php';
		$styling_file = get_template_directory() . "/cache/demos/customizer/settings/".$_POST['styling'].".dat";

		if(file_exists($styling_file))
		{
			WP_Filesystem();
			$wp_filesystem = grandportfolio_get_wp_filesystem();
			$styling_data = $wp_filesystem->get_contents($styling_file);
			$styling_data_arr = unserialize($styling_data);
			
			if(isset($styling_data_arr['mods']) && is_array($styling_data_arr['mods']))
			{	
				// Get menu locations and save to array
				$locations = get_theme_mod('nav_menu_locations');
				$save_menus = array();
				foreach( $locations as $key => $val ) 
				{
					$save_menus[$key] = $val;
				}
			
				//Remove all theme customizer
				remove_theme_mods();
				
				//Re-add the menus
				set_theme_mod('nav_menu_locations', array_map( 'absint', $save_menus ));
			
				foreach($styling_data_arr['mods'] as $key => $styling_mod)
				{
					if(!is_array($styling_mod))
					{
						set_theme_mod( $key, $styling_mod );
					}
				}
			}
		    
			exit();
		}
	}
}

/**
*	Setup AJAX search function
**/
add_action('wp_ajax_grandportfolio_ajax_search', 'grandportfolio_ajax_search');
add_action('wp_ajax_nopriv_grandportfolio_ajax_search', 'grandportfolio_ajax_search');

function grandportfolio_ajax_search() {
	$wpdb = grandportfolio_get_wpdb();
	
	if (strlen($_POST['s'])>0) {
		$limit=5;
		$s=strtolower(addslashes($_POST['s']));
		$querystr = "
			SELECT $wpdb->posts.*
			FROM $wpdb->posts
			WHERE 1=1 AND ((lower($wpdb->posts.post_title) like %s))
			AND $wpdb->posts.post_type IN ('post', 'page', 'portfolios', 'galleries')
			AND (post_status = 'publish')
			ORDER BY $wpdb->posts.post_date DESC
			LIMIT $limit;
		 ";

	 	$pageposts = $wpdb->get_results($wpdb->prepare($querystr, '%'.$wpdb->esc_like($s).'%'), OBJECT);
	 	
	 	if(!empty($pageposts))
	 	{
			echo '<ul>';
	
	 		foreach($pageposts as $result_item) 
	 		{
	 			$post=$result_item;
	 			
	 			$post_type = get_post_type($post->ID);
				$post_type_class = '';
				$post_type_title = '';
				
				switch($post_type)
				{
				    case 'galleries':
				    	$post_type_class = '<i class="fa fa-picture-o"></i>';
				    	$post_type_title = esc_html__('Gallery', 'grandportfolio-translation' );
				    break;
				    
				    case 'page':
				    default:
				    	$post_type_class = '<i class="fa fa-file-text-o"></i>';
				    	$post_type_title = esc_html__('Page', 'grandportfolio-translation' );
				    break;
				    
				    case 'projects':
				    	$post_type_class = '<i class="fa fa-folder-open-o"></i>';
				    	$post_type_title = esc_html__('Projects', 'grandportfolio-translation' );
				    break;
				    
				    case 'services':
				    	$post_type_class = '<i class="fa fa-star"></i>';
				    	$post_type_title = esc_html__('Service', 'grandportfolio-translation' );
				    break;
				    
				    case 'clients':
				    	$post_type_class = '<i class="fa fa-user"></i>';
				    	$post_type_title = esc_html__('Client', 'grandportfolio-translation' );
				    break;
				}
				
				$post_thumb = array();
				if(has_post_thumbnail($post->ID, 'thumbnail'))
				{
				    $image_id = get_post_thumbnail_id($post->ID);
				    $post_thumb = wp_get_attachment_image_src($image_id, 'thumbnail', true);
				    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
				    
				    if(isset($post_thumb[0]) && !empty($post_thumb[0]))
				    {
				        $post_type_class = '<div class="search_thumb"><img src="'.$post_thumb[0].'" alt="'.esc_attr($image_alt).'"/></div>';
				    }
				}
	 			
				echo '<li>';
				
				if(!isset($post_thumb[0]))
				{
					echo '<div class="post_type_icon">';
				}
				
				echo '<a href="'.get_permalink($post->ID).'">'.$post_type_class.'</i></a>';
				
				if(!isset($post_thumb[0]))
				{
					echo '</div>';
				}
				
				echo '<div class="ajax_post">';
				echo '<a href="'.get_permalink($post->ID).'"><strong>'.$post->post_title.'</strong><br/>';
				echo '<span class="post_detail">'.date(THEMEDATEFORMAT, strtotime($post->post_date)).'</span></a>';
				echo '</div>';
				echo '</li>';
			}
			
			echo '<li class="view_all"><a href="javascript:jQuery(\'#searchform\').submit()">'.esc_html__('View all results', 'grandportfolio-translation' ).'</a></li>';
	
			echo '</ul>';
		}

	}
	else 
	{
		echo '';
	}
	die();

}


/**
*	End theme custom AJAX calls handler
**/

/**
*	Setup contact form mailing function
**/
add_action('wp_ajax_grandportfolio_contact_mailer', 'grandportfolio_contact_mailer');
add_action('wp_ajax_nopriv_grandportfolio_contact_mailer', 'grandportfolio_contact_mailer');

function grandportfolio_contact_mailer() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	//Error message when message can't send
	define('ERROR_MESSAGE', 'Oops! something went wrong, please try to submit later.');
	
	if (isset($_POST['your_name'])) {
	
		//Get your email address
		$contact_email = get_option('pp_contact_email');
		$pp_contact_thankyou = esc_html__('Thank you! We will get back to you as soon as possible', 'grandportfolio-translation' );
		
		/*
		|
		| Begin sending mail
		|
		*/
		
		$from_name = $_POST['your_name'];
		$from_email = $_POST['email'];
		
		//Get contact subject
		if(!isset($_POST['subject']))
		{
			$contact_subject = esc_html__('[Email Contact]', 'grandportfolio-translation' ).' '.get_bloginfo('name');
		}
		else
		{
			$contact_subject = $_POST['subject'];
		}
		
		$headers = "";
	   	//$headers.= 'From: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Reply-To: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
	   	$headers.= 'Return-Path: '.$from_name.' <'.$from_email.'>'.PHP_EOL;
		
		$message = 'Name: '.$from_name.PHP_EOL;
		$message.= 'Email: '.$from_email.PHP_EOL.PHP_EOL;
		$message.= 'Message: '.PHP_EOL.$_POST['message'].PHP_EOL.PHP_EOL;
		
		if(isset($_POST['address']))
		{
			$message.= 'Address: '.$_POST['address'].PHP_EOL;
		}
		
		if(isset($_POST['phone']))
		{
			$message.= 'Phone: '.$_POST['phone'].PHP_EOL;
		}
		
		if(isset($_POST['mobile']))
		{
			$message.= 'Mobile: '.$_POST['mobile'].PHP_EOL;
		}
		
		if(isset($_POST['company']))
		{
			$message.= 'Company: '.$_POST['company'].PHP_EOL;
		}
		
		if(isset($_POST['country']))
		{
			$message.= 'Country: '.$_POST['country'].PHP_EOL;
		}
		    
		
		if(!empty($from_name) && !empty($from_email) && !empty($message))
		{
			wp_mail($contact_email, $contact_subject, $message, $headers);
			echo '<p>'.$pp_contact_thankyou.'</p>';
			
			die;
		}
		else
		{
			echo '<p>'.ERROR_MESSAGE.'</p>';
			
			die;
		}

	}
	else 
	{
		echo '<p>'.ERROR_MESSAGE.'</p>';
	}
	die();
}

/**
*	End theme contact form mailing function
**/


/**
*	Setup gallery grid infinite scroll function
**/
add_action('wp_ajax_grandportfolio_gallery_grid', 'grandportfolio_gallery_grid');
add_action('wp_ajax_nopriv_grandportfolio_gallery_grid', 'grandportfolio_gallery_grid');

function grandportfolio_gallery_grid() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	$gallery_id = '';
	$items = 1;
	$columns = 2;
	$offset = 0;
	$type = 'grid';
	$image_size = 'grandportfolio-gallery-grid';
	
	if(isset($_POST['gallery_id']))
	{
		$gallery_id = $_POST['gallery_id'];
	}
	
	if(isset($_POST['items']))
	{
		$items = $_POST['items'];
	}
	
	if(isset($_POST['columns']))
	{
		$columns = $_POST['columns'];
	}
	
	if(isset($_POST['offset']))
	{
		$offset = $_POST['offset'];
	}
	
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	
	//Check if masonry image size
	if($type != 'grid')
	{
		$image_size = 'grandportfolio-gallery-masonry';
	}
	
	$images_arr = get_post_meta($gallery_id, 'wpsimplegallery_gallery', true);
	$images_arr = grandportfolio_resort_gallery_img($images_arr);
	$images_arr = array_values($images_arr);
	
	$return_html = '';
	
	if(!is_numeric($columns))
	{
		$columns = 4;
	}
	
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	switch($columns)
	{
		case 2:
			$wrapper_class = 'two_cols';
			$grid_wrapper_class = 'classic2_cols';
			$column_class = 'one_half gallery2';
		break;
		
		case 3:
			$wrapper_class = 'three_cols';
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
		break;
		
		case 4:
			$wrapper_class = 'four_cols';
			$grid_wrapper_class = 'classic4_cols';
			$column_class = 'one_fourth gallery4';
		break;
	}
	
	$current_offset = intval($offset+$items-1);
	if($current_offset > count($images_arr))
	{
		$current_offset = count($images_arr);
	}
	
	if(!empty($images_arr))
	{	
		for($i = $offset; $i <= $current_offset; $i++)
		{
			if(isset($images_arr[$i]))
			{
				$image = $images_arr[$i];
		    	$obj_image = wp_get_attachment_image_src($image, 'original');
				
				$image_url = wp_get_attachment_image_src($image, 'original', true);
				$small_image_url = wp_get_attachment_image_src($image, $image_size, true);
				
				$image_caption = get_post_field('post_excerpt', $image);
				$image_alt = get_post_meta($image, '_wp_attachment_image_alt', true);
				
				//Get image purchase URL
				$grandportfolio_purchase_url = get_post_meta($image, 'grandportfolio_purchase_url', true);
				
				if(!empty($grandportfolio_purchase_url))
				{
				    $image_caption.= '<a href="'.esc_url($grandportfolio_purchase_url).'" class="button ghost"><i class="fa fa-shopping-cart marginright"></i>'.esc_html__('Purchase', 'grandportfolio-translation' ).'</a>';
				}
				
				$tg_lightbox_enable_caption = kirki_get_option('tg_lightbox_enable_caption');
				
				$return_html.= '<div class="element grid ' .esc_attr($grid_wrapper_class).'">';
				$return_html.= '<div class="'.esc_attr($column_class).' static filterable gallery_type">';
				$return_html.= '<a class="fancy-gallery" href="'.esc_url($image_url[0]).'" ';
				
				if(!empty($tg_lightbox_enable_caption)) 
				{
					$return_html.= 'data-caption="'.esc_attr($image_caption).'" ';
				}
				
				$return_html.= '>';
				$return_html.= '<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($image_alt).'" width="'.esc_attr($obj_image[1]).'" height="'.esc_attr($obj_image[2]).'"/>';
				
				$return_html.= '</a>';
				$return_html.= '</div>';
				$return_html.= '</div>';
			}
		}
	}
	
	echo stripslashes($return_html);
	die();
}

/**
*	End gallery grid infinite scroll function
**/


/**
*	Setup portfolio grid infinite scroll function
**/
add_action('wp_ajax_grandportfolio_portfolio_grid', 'grandportfolio_portfolio_grid');
add_action('wp_ajax_nopriv_grandportfolio_portfolio_grid', 'grandportfolio_portfolio_grid');

function grandportfolio_portfolio_grid() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	$cat = '';
	$items = 1;
	$items_ini = 0;
	$columns = 2;
	$offset = 0;
	$type = 'grid';
	$image_size = 'grandportfolio-gallery-grid';
	
	if(isset($_POST['cat']))
	{
		$cat = $_POST['cat'];
	}
	
	if(isset($_POST['items']))
	{
		$items = $_POST['items'];
	}
	
	if(isset($_POST['items_ini']))
	{
		$items_ini = $_POST['items_ini'];
	}
	
	if(isset($_POST['columns']))
	{
		$columns = $_POST['columns'];
	}
	
	if(isset($_POST['offset']))
	{
		$offset = $_POST['offset'];
	}
	
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	
	if(isset($_POST['order']))
	{
		$portfolio_order = $_POST['order'];
	}
	
	if(isset($_POST['order_by']))
	{
		$portfolio_order_by = $_POST['order_by'];
	}
	
	if(isset($_POST['layout']))
	{
		$layout = $_POST['layout'];
	}
	
	//Check if masonry image size
	if($type != 'grid')
	{
		$image_size = 'grandportfolio-gallery-masonry';
	}
	
	$return_html = '';
	
	$portfolio_order = 'ASC';
	$portfolio_order_by = 'menu_order';
	switch($portfolio_order)
	{
		case 'default':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'menu_order';
		break;
		
		case 'newest':
			$portfolio_order = 'DESC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'oldest':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'title':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'title';
		break;
		
		case 'random':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'rand';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $portfolio_order,
	    'orderby' => $portfolio_order_by,
	    'post_type' => array('portfolios'),
	    'suppress_filters' => false,
	);
	
	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	switch($columns)
	{
		case 2:
			$wrapper_class = 'two_cols';
			$grid_wrapper_class = 'classic2_cols';
			$column_class = 'one_half gallery2';
		break;
		
		case 3:
			$wrapper_class = 'three_cols';
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
		break;
		
		case 4:
			$wrapper_class = 'four_cols';
			$grid_wrapper_class = 'classic4_cols';
			$column_class = 'one_fourth gallery4';
		break;
	}
	
	$current_offset = intval($offset+$items_ini-1);
	if($current_offset > count($portfolios_arr))
	{
		$current_offset = count($portfolios_arr);
	}

	if(!empty($portfolios_arr))
	{	
		for($i = $offset; $i <= $current_offset; $i++)
		{
			if(isset($portfolios_arr[$i]))
			{
				$key = $i;
				$image_url = '';
				$portfolio_ID = $portfolios_arr[$i]->ID;
						
				if(has_post_thumbnail($portfolio_ID, 'original'))
				{
				    $image_id = get_post_thumbnail_id($portfolio_ID);
				    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
				    
				    $small_image_url = wp_get_attachment_image_src($image_id, $image_size, true);
				}
				
				$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
				
				if(empty($portfolio_link_url))
				{
				    $permalink_url = get_permalink($portfolio_ID);
				}
				else
				{
				    $permalink_url = $portfolio_link_url;
				}
				
				//Begin display HTML
				$return_html.= '<div class="element '.esc_attr($grid_wrapper_class).'">';
				$return_html.= '<div class="'.esc_attr($column_class).' filterable static animated'.($key+1).' portfolio_type">';
				
				if(!empty($image_url[0]))
				{
					$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
				    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
				    
				    switch($portfolio_type)
				    {
				    case 'External Link':
						$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
				
						$return_html.= '<a target="_blank" href="'.esc_url($portfolio_link_url).'"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
				        
				    break;
				    //end external link
				    
				    case 'Project Content':
	        	    default:
	
			        	$return_html.= '<a href="'.get_permalink($portfolio_ID).'"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
		        
				    break;
				    //end external link
	        	    
	        	    case 'Image':
				
						$return_html.= '<a data-caption="'.esc_attr($portfolios_arr[$i]->post_title).'" href="'.esc_url($image_url[0]).'" class="fancy-gallery"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
				
				    break;
				    //end image
				    
				    case 'Youtube Video':
				
						$return_html.= '<a href="https://www.youtube.com/embed/'.esc_attr($portfolio_video_id).'" class="lightbox_youtube" data-options="width:900, height:488"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
				
				    break;
				    //end youtube
				
				case 'Vimeo Video':
	
						$return_html.= '<a href="https://player.vimeo.com/video/'.esc_attr($portfolio_video_id).'" class="lightbox_vimeo" data-options="width:900, height:506"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
				
				    break;
				    //end vimeo
				    
				case 'Self-Hosted Video':
				
				    //Get video URL
				    $portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
				    $preview_image = wp_get_attachment_image_src($image_id, 'large', true);
				    
						$return_html.= '<a href="'.esc_url($portfolio_mp4_url).'" class="lightbox_vimeo"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_title">
	        					<div class="table">
	        						<div class="cell">
							            <h5>'.$portfolios_arr[$i]->post_title.'</h5>
							            <div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>
	        						</div>
	        					</div>
					        </div></a>';
				
				    break;
				    //end self-hosted
				    }
				    //end switch
				}
				$return_html.= '</div>';
				
				$return_html.= '</div>';
			}
		}
	}
	
	echo stripslashes($return_html);
	die();
}

/**
*	End portfolio grid infinite scroll function
**/


/**
*	Setup portfolio classic infinite scroll function
**/
add_action('wp_ajax_grandportfolio_portfolio_classic', 'grandportfolio_portfolio_classic');
add_action('wp_ajax_nopriv_grandportfolio_portfolio_classic', 'grandportfolio_portfolio_classic');

function grandportfolio_portfolio_classic() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	echo 'test';
	
	$cat = '';
	$items = 1;
	$items_ini = 0;
	$columns = 2;
	$offset = 0;
	$type = 'grid';
	$image_size = 'grandportfolio-gallery-grid';
	
	if(isset($_POST['cat']))
	{
		$cat = $_POST['cat'];
	}
	
	if(isset($_POST['items']))
	{
		$items = $_POST['items'];
	}
	
	if(isset($_POST['items_ini']))
	{
		$items_ini = $_POST['items_ini'];
	}
	
	if(isset($_POST['columns']))
	{
		$columns = $_POST['columns'];
	}
	
	if(isset($_POST['offset']))
	{
		$offset = $_POST['offset'];
	}
	
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	
	if(isset($_POST['order']))
	{
		$portfolio_order = $_POST['order'];
	}
	
	if(isset($_POST['order_by']))
	{
		$portfolio_order_by = $_POST['order_by'];
	}
	
	if(isset($_POST['layout']))
	{
		$layout = $_POST['layout'];
	}
	
	//Check if masonry image size
	if($type != 'grid')
	{
		$image_size = 'grandportfolio-gallery-masonry';
	}
	
	$return_html = '';
	
	$portfolio_order = 'ASC';
	$portfolio_order_by = 'menu_order';
	switch($portfolio_order)
	{
		case 'default':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'menu_order';
		break;
		
		case 'newest':
			$portfolio_order = 'DESC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'oldest':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'post_date';
		break;
		
		case 'title':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'title';
		break;
		
		case 'random':
			$portfolio_order = 'ASC';
			$portfolio_order_by = 'rand';
		break;
	}
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items,
	    'order' => $portfolio_order,
	    'orderby' => $portfolio_order_by,
	    'post_type' => array('portfolios'),
	    'suppress_filters' => false,
	);
	
	if(!empty($cat))
	{
		$args['portfoliosets'] = $cat;
	}
	
	$portfolios_arr = get_posts($args);
	
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	switch($columns)
	{
		case 2:
			$wrapper_class = 'two_cols';
			$grid_wrapper_class = 'classic2_cols';
			$column_class = 'one_half gallery2';
		break;
		
		case 3:
			$wrapper_class = 'three_cols';
			$grid_wrapper_class = 'classic3_cols';
			$column_class = 'one_third gallery3';
		break;
		
		case 4:
			$wrapper_class = 'four_cols';
			$grid_wrapper_class = 'classic4_cols';
			$column_class = 'one_fourth gallery4';
		break;
	}
	
	$current_offset = intval($offset+$items_ini-1);
	if($current_offset > count($portfolios_arr))
	{
		$current_offset = count($portfolios_arr);
	}

	if(!empty($portfolios_arr))
	{	
		for($i = $offset; $i <= $current_offset; $i++)
		{
			if(isset($portfolios_arr[$i]))
			{
				$key = $i;
				$image_url = '';
				$portfolio_ID = $portfolios_arr[$i]->ID;
						
				if(has_post_thumbnail($portfolio_ID, 'original'))
				{
				    $image_id = get_post_thumbnail_id($portfolio_ID);
				    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
				    
				    $small_image_url = wp_get_attachment_image_src($image_id, $image_size, true);
				}
				
				$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
				
				if(empty($portfolio_link_url))
				{
				    $permalink_url = get_permalink($portfolio_ID);
				}
				else
				{
				    $permalink_url = $portfolio_link_url;
				}
				
				//Begin display HTML
				$return_html.= '<div class="element '.esc_attr($grid_wrapper_class).'">';
				$return_html.= '<div class="'.esc_attr($column_class).' classic filterable static animated'.($key+1).'">';
				
				if(!empty($image_url[0]))
				{
					$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
				    $portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
				    
				    switch($portfolio_type)
				    {
				    case 'External Link':
						$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
				
						$return_html.= '<a target="_blank" href="'.esc_url($portfolio_link_url).'"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-chain"></i>
							</div>
						</div></a>';
				        
				    break;
				    //end external link
				    
				    case 'Project Content':
	        	    default:
	
			        	$return_html.= '<a href="'.get_permalink($portfolio_ID).'"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-mail-forward"></i>
							</div>
						</div></a>';
		        
				    break;
				    //end external link
	        	    
	        	    case 'Image':
				
						$return_html.= '<a data-caption="'.esc_attr($portfolios_arr[$i]->post_title).'" href="'.esc_url($image_url[0]).'" class="fancy-gallery"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-search-plus"></i>
							</div>
						</div></a>';
				
				    break;
				    //end image
				    
				    case 'Youtube Video':
				
						$return_html.= '<a href="https://www.youtube.com/embed/'.esc_attr($portfolio_video_id).'" class="lightbox_youtube" data-options="width:900, height:488"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div></a>';
				
				    break;
				    //end youtube
				
				case 'Vimeo Video':
	
						$return_html.= '<a href="https://player.vimeo.com/video/'.esc_attr($portfolio_video_id).'" class="lightbox_vimeo" data-options="width:900, height:506"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div></a>';
				
				    break;
				    //end vimeo
				    
				case 'Self-Hosted Video':
				
				    //Get video URL
				    $portfolio_mp4_url = get_post_meta($portfolio_ID, 'portfolio_mp4_url', true);
				    $preview_image = wp_get_attachment_image_src($image_id, 'large', true);
				    
						$return_html.= '<a href="'.esc_url($portfolio_mp4_url).'" class="lightbox_vimeo"><img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($portfolios_arr[$i]->post_title).'"/><div class="portfolio_classic_icon_wrapper">
							<div class="portfolio_classic_icon_content">
								<i class="fa fa-play"></i>
							</div>
						</div></a>';
				
				    break;
				    //end self-hosted
				    }
				    //end switch
				}
				$return_html.= '</div>';
				
				//Display portfolio detail
				$return_html.= '<br class="clear"/><div id="portfolio_desc_'.esc_attr($portfolio_ID).'" class="portfolio_desc portfolio'.esc_attr($columns).' '.esc_attr($layout).' filterable">';
	            $return_html.= '<h5>'.$portfolios_arr[$i]->post_title.'</h5>';
	            $return_html.= '<div class="post_detail">'.$portfolios_arr[$i]->post_excerpt.'</div>';
				$return_html.= '</div>';
				
				$return_html.= '</div>';
			}
		}
	}
	
	echo stripslashes($return_html);
	die();
}

/**
*	End portfolio classic infinite scroll function
**/


/**
*	Setup blog post grid infinite scroll function
**/
add_action('wp_ajax_grandportfolio_post_grid', 'grandportfolio_post_grid');
add_action('wp_ajax_nopriv_grandportfolio_post_grid', 'grandportfolio_post_grid');

function grandportfolio_post_grid() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
	
	$cat = '';
	$items = 1;
	$items_ini = 0;
	$columns = 2;
	$offset = 0;
	$type = 'grid';
	$image_size = 'grandportfolio-blog';
	
	if(isset($_POST['cat']))
	{
		$cat = $_POST['cat'];
	}
	
	if(isset($_POST['items']))
	{
		$items = $_POST['items'];
	}
	
	if(isset($_POST['items_ini']))
	{
		$items_ini = $_POST['items_ini'];
	}
	
	if(isset($_POST['columns']))
	{
		$columns = $_POST['columns'];
	}
	
	if(isset($_POST['offset']))
	{
		$offset = $_POST['offset'];
	}
	
	if(isset($_POST['type']))
	{
		$type = $_POST['type'];
	}
	
	//Check if masonry image size
	if($type != 'grid')
	{
		$image_size = 'grandportfolio-gallery-masonry';
	}
	
	$return_html = '';
	
	//Get portfolio items
	$args = array(
	    'numberposts' => $items_ini,
	    'order' => 'DESC',
	    'orderby' => 'post_date',
	    'post_type' => array('post'),
	    'offset' => $offset,
	    'suppress_filters' => false,
	);
	
	if(!empty($cat))
	{
		$args['category'] = $cat;
	}
	
	$posts_arr = get_posts($args);
	
	$wrapper_class = '';
	$grid_wrapper_class = '';
	$column_class = '';
	
	$current_offset = intval($offset+$items_ini-1);
	if($current_offset > count($posts_arr))
	{
		$current_offset = count($posts_arr);
	}
	
	//Check columns class
	switch($columns)
	{
		case 2:
		default:
			$excerpt_length = 200;
		break;
		
		case 3:
			$excerpt_length = 110;
		break;
	}

	if(!empty($posts_arr))
	{	
		foreach($posts_arr as $key => $ppb_post)
		{
			$animate_layer = $key+7;
			$image_thumb = '';
										
			if(has_post_thumbnail($ppb_post->ID, 'large'))
			{
			    $image_id = get_post_thumbnail_id($ppb_post->ID);
			    $image_thumb = wp_get_attachment_image_src($image_id, 'large', true);
			}
			
			$return_html.= '<div id="post-'.$ppb_post->ID.'" class="post type-post hentry status-publish">
			<div class="post_wrapper grid_layout">';
			
			 //Get post featured content
		    $post_ft_type = get_post_meta($ppb_post->ID, 'post_ft_type', true);
		    
		    switch($post_ft_type)
		    {
		    	case 'Image':
		    	case 'Gallery':
		    	default:
		        	if(!empty($image_thumb))
		        	{
		        		$small_image_url = wp_get_attachment_image_src($image_id, 'grandportfolio-blog', true);
		
		    	    $return_html.= '<div class="post_img small">
		    	    	<a href="'.esc_url(get_permalink($ppb_post->ID)).'">
		    	    		<img src="'.esc_url($small_image_url[0]).'" alt="'.esc_attr($ppb_post->post_title).'" class=""/>
		                </a>
		    	    </div>';
		    		}
		    	break;
		    	
		    	case 'Vimeo Video':
		    		$post_ft_vimeo = get_post_meta($ppb_post->ID, 'post_ft_vimeo', true);
		
					$return_html.= do_shortcode('[tg_vimeo video_id="'.$post_ft_vimeo.'" width="670" height="377"]').'<br/>';
		    	break;
		    	
		    	case 'Youtube Video':
		    		$post_ft_youtube = get_post_meta($ppb_post->ID, 'post_ft_youtube', true);

		    		$return_html.= do_shortcode('[tg_youtube video_id="'.$post_ft_youtube.'" width="670" height="377"]').'<br/>';
		    	break;
		    	
		    } //End switch
		    
		    $return_html.= '<div class="blog_grid_content">';
		    
		    //Check post format
		    $post_format = get_post_format($ppb_post->ID);
		    
		    switch($post_format)
			{
			    case 'quote':
			
			    $return_html.= '<div class="post_quote_wrapper">
						<div class="post_quote_title">
						    '.$ppb_post->post_content.'
						</div>
						<div class="post_detail">
					        '.$ppb_post->post_title.'
						</div>
					</div>';
			    		    
				$return_html.= '</div>

			    	</div>
			    </div>';
			    
			    break;
			    
			    case 'link':
			
			    $return_html.= '
			    <div class="post_header quote">
			    	<div class="post_quote_title grid">
			    	'.$ppb_post->post_content.'
			    	<div class="post_detail">
			    	    	'.get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;';
			    		    
						$post_categories = wp_get_post_categories($ppb_post->ID);
						if(!empty($post_categories))
						{
						 	$return_html.= esc_html__('In', 'grandportfolio-custom-post' ).'&nbsp;';
						 	
						    foreach($post_categories as $c)
						    {
						        $cat = get_category( $c );
						    	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
						    }
						}
			    		    
				$return_html.= '</div>';
			    	
				$return_html.= '
			    	</div>
			    </div>';

			    break;
			    
			    default:
		    
				$return_html.= '<div class="post_header grid">
				<div class="post_info_cat">';
				
				$return_html.= get_the_time(THEMEDATEFORMAT, $ppb_post->ID).'&nbsp;/&nbsp;';
				
				$post_categories = wp_get_post_categories($ppb_post->ID);
						    	
				$count_categories = count($post_categories);
				$i = 0;
				
				if(!empty($post_categories))
				{
				 	foreach($post_categories as $c)
				    {
				        $cat = get_category( $c );
				    	$return_html.= '<a href="'.esc_url(get_category_link($cat->term_id)).'">'.$cat->name.'</a>';
				    	
				    	if(THEMEDEMO && $i == 0)
						{
						    break;
						}
				    	
				    	if(++$i != $count_categories) 
						{
						    $return_html.= '&nbsp;/&nbsp;';
						}
				    }
				}
				
				$return_html.= '</div>
				<h6><a href="'.esc_url(get_permalink($ppb_post->ID)).'" title="'.get_the_title($ppb_post->ID).'">'.get_the_title($ppb_post->ID).'</a></h6>';
			    		    
				$return_html.= '</div>';
				
				$return_html.= grandportfolio_substr($ppb_post->post_excerpt, $excerpt_length);
		        break;
		    }
		    
		    $return_html.= '
	    </div>    
	</div>
</div>';
		}
	}
	
	echo stripslashes($return_html);
	die();
}

/**
*	End blog post grid infinite scroll function
**/


/**
*	Setup image proofing function
**/
add_action('wp_ajax_grandportfolio_image_proofing', 'grandportfolio_image_proofing');
add_action('wp_ajax_nopriv_grandportfolio_image_proofing', 'grandportfolio_image_proofing');

function grandportfolio_image_proofing() {
	if(!THEMEDEMO)
	{
		check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );
		
		$gallery_id = '';
		$image_id = '';
		
		if(isset($_POST['gallery_id']))
		{
			$gallery_id = $_POST['gallery_id'];
		}
		
		if(isset($_POST['image_id']))
		{
			$image_id = $_POST['image_id'];
		}
		
		if(isset($_POST['method']) && $_POST['method'] == 'approve')
		{
			//Get current approved images
			$current_images_approve = get_post_meta($gallery_id, 'gallery_images_approve', true);
			
			if(!empty($current_images_approve))
			{
				if ( !in_array( $image_id, $current_images_approve ) ) {
					$current_images_approve[] = $image_id;
				}
	
				$current_images_approve = array_unique($current_images_approve);
				update_post_meta($gallery_id, 'gallery_images_approve', $current_images_approve);
			}
			else
			{
				$current_images_approve[] = $image_id;
				$current_images_approve = array_unique($current_images_approve);
				update_post_meta($gallery_id, 'gallery_images_approve', $current_images_approve);	
			}
		}
		else if(isset($_POST['method']) && $_POST['method'] == 'unapprove')
		{
			//Get current approved images
			$current_images_approve = get_post_meta($gallery_id, 'gallery_images_approve', true);
			
			if(!empty($current_images_approve))
			{
				if (($key = array_search($image_id, $current_images_approve)) !== false) 
				{
				    unset($current_images_approve[$key]);
				}
				
				update_post_meta($gallery_id, 'gallery_images_approve', $current_images_approve);
			}
		}
	}
	
	die();
}

/**
*	End image proofing function
**/


/**
*	Setup image flow XML function
**/
add_action('wp_ajax_grandportfolio_image_flow_xml', 'grandportfolio_image_flow_xml');
add_action('wp_ajax_nopriv_grandportfolio_image_flow_xml', 'grandportfolio_image_flow_xml');

function grandportfolio_image_flow_xml() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	$all_photo_arr = array();
	if(isset($_GET['gallery_id']) OR !empty($_GET['gallery_id']))
	{
		$all_photo_arr = get_post_meta($_GET['gallery_id'], 'wpsimplegallery_gallery', true);
		
		//Get default gallery sorting
		$all_photo_arr = grandportfolio_resort_gallery_img($all_photo_arr);
	}
	
	header("Content-type: text/xml");
	echo '<?xml version="1.0" encoding="utf-8" ?>
			<bank>';
			
	$tg_full_image_caption = kirki_get_option('tg_full_image_caption');
	
			
	foreach($all_photo_arr as $photo_id)
	{
		$full_image_url = wp_get_attachment_image_src( $photo_id, 'full' );
		$small_image_url = wp_get_attachment_image_src( $photo_id, 'large' );
		
		//Get image meta data
		$image_title = get_the_title($photo_id);
		$image_caption = get_post_field('post_excerpt', $photo_id);
	
		echo '<img>';
		echo '<src>'.$small_image_url[0].'</src>';
		echo '<link>'.$full_image_url[0].'</link>';
		
		if(!empty($tg_full_image_caption))
		{
			//Get image purchase URL
			$grandportfolio_purchase_url = get_post_meta($photo_id, 'grandportfolio_purchase_url', true);
			if(!empty($grandportfolio_purchase_url))
			{
				$image_caption.= '<br/><a href="'.esc_url($grandportfolio_purchase_url).'" class="button ghost"><i class="fa fa-shopping-cart marginright"></i>'.esc_html__('Purchase', 'grandportfolio-translation' ).'</a>';
			}
		
			echo '<caption>'.esc_attr($image_caption).'</caption>';
		}
		else
		{
			echo '<caption></caption>';
		}
		
		echo '</img>';
	}
			
	echo '</bank>';

	die();
}

/**
*	End image flow XML function
**/

/**
*	Setup portfolio flow XML function
**/
add_action('wp_ajax_grandportfolio_portfolio_flow_xml', 'grandportfolio_portfolio_flow_xml');
add_action('wp_ajax_nopriv_grandportfolio_portfolio_flow_xml', 'grandportfolio_portfolio_flow_xml');

function grandportfolio_portfolio_flow_xml() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	//Get all portfolio items
	$query_string = 'orderby=menu_order&order=ASC&post_type=portfolios&numberposts=-1&suppress_filters=0&posts_per_page=-1';
	query_posts($query_string);
	
	header("Content-type: text/xml");
	echo '<?xml version="1.0" encoding="utf-8" ?>
			<bank>';
			
	$tg_full_image_caption = kirki_get_option('tg_full_image_caption');
	
			
	if (have_posts()) : while (have_posts()) : the_post();
		$image_url = '';
		$portfolio_ID = get_the_ID();
		    	
		if(has_post_thumbnail($portfolio_ID, 'original'))
		{
		    $image_id = get_post_thumbnail_id($portfolio_ID);
		    $image_url = wp_get_attachment_image_src($image_id, 'original', true);
		}
		
		//Get image meta data
		$image_title = get_the_title();
		$image_excerpt = get_post_field('post_excerpt', $portfolio_ID);
		
		$portfolio_content = '<h4>'.$image_title.'</h4>';
		if(!empty($image_excerpt))
		{
			$portfolio_content.= '<div class="post_detail">'.$image_excerpt.'</div>';
		}
	
		echo '<img>';
		echo '<src>'.$image_url[0].'</src>';
		echo '<caption>'.esc_attr($portfolio_content).'</caption>';
		
		$portfolio_type = get_post_meta($portfolio_ID, 'portfolio_type', true);
		$portfolio_video_id = get_post_meta($portfolio_ID, 'portfolio_video_id', true);
		
		switch($portfolio_type)
		{
		    case 'External Link':
		    	$portfolio_link_url = get_post_meta($portfolio_ID, 'portfolio_link_url', true);
		    	echo '<link>'.esc_url($portfolio_link_url).'</link>';
		    break;
		    
		    case 'Portfolio Content':
		    	echo '<link>'.esc_url(get_permalink($portfolio_ID)).'</link>';
		    break;
		    
		    case 'Image':
		    default:
		    	echo '<link>'.$image_url[0].'</link>';
		    break;
		    
		    case 'Youtube Video':
		    	echo '<link>'.esc_url('https://www.youtube.com/embed/'.esc_attr($portfolio_video_id)).'</link>';
		    break;
		    
		    case 'Vimeo Video':
		    	echo '<link>'.esc_url('https://player.vimeo.com/video/'.esc_attr($portfolio_video_id)).'</link>';
		    break;
		}
		
		echo '</img>';
		
	endwhile; endif;
			
	echo '</bank>';

	die();
}

/**
*	End portfolio flow XML function
**/


/**
*	Setup contact form captcha function
**/
add_action('wp_ajax_grandportfolio_get_captcha', 'grandportfolio_get_captcha');
add_action('wp_ajax_nopriv_grandportfolio_get_captcha', 'grandportfolio_get_captcha');

function grandportfolio_get_captcha() {
	session_start();

	if(isset($_GET['check']) && !empty($_GET['check']))
	{	
		if($_GET['captcha-code']==$_SESSION['random_number'])
		{
			echo 'true';
		}
		else
		{
			echo esc_html__('Please enter correct captcha text', 'grandportfolio-translation' );
		}
			
		exit;
	}
	else
	{
		$word_1 = '';
		$word_2 = '';
		
		for ($i = 0; $i < 4; $i++) 
		{
			$word_1 .= chr(rand(97, 122));
		}
		for ($i = 0; $i < 4; $i++) 
		{
			$word_2 .= chr(rand(97, 122));
		}
		
		$_SESSION['random_number'] = $word_1.' '.$word_2;
		
		$dir = get_template_directory().'/images/';
		
		$image = imagecreatetruecolor(165, 50);
		
		$font = "recaptchaFont.ttf"; // font style
		
		$color = imagecolorallocate($image, 0, 0, 0);// color
		
		$white = imagecolorallocate($image, 255, 255, 255); // background color white
		
		imagefilledrectangle($image, 0,0, 709, 99, $white);
		
		imagettftext ($image, 22, 0, 5, 30, $color, $dir.$font, $_SESSION['random_number']);
		
		header("Content-type: image/png");
		
		imagepng($image);  
	}

	die();
}

/**
*	End contact form captcha function
**/

/**
*	Setup blur image function
**/
add_action('wp_ajax_grandportfolio_blurred_image', 'grandportfolio_blurred_image');
add_action('wp_ajax_nopriv_grandportfolio_blurred_image', 'grandportfolio_blurred_image');

function grandportfolio_blurred_image() {
	check_ajax_referer( 'tgajax-post-contact-nonce', 'tg_security' );

	$do_blur = FALSE;
	if(isset($_GET['src']) && !empty($_GET['src']))
	{
		$image_id = grandportfolio_get_image_id($_GET['src']);
		if(!empty($image_id))
		{
			$do_blur = TRUE;
		}
	}
	$blurFactor = 5;
	if(isset($_GET['blur_factor']) && is_numeric($_GET['blur_factor']))
	{
		$blurFactor = $_GET['blur_factor'];
	}
	
	if($do_blur)
	{
		header('Content-Type: image/jpeg');
		$image = imagecreatefromjpeg($_GET['src']);
		$new_image = grandportfolio_blur($image,$blurFactor);
		imagejpeg($new_image);
		imagedestroy($new_image);
	}

	die();
}

/**
*	End blur image function
**/


/**
*	Setup custom CSS function
**/
add_action('wp_ajax_grandportfolio_custom_css', 'grandportfolio_custom_css');
add_action('wp_ajax_nopriv_grandportfolio_custom_css', 'grandportfolio_custom_css');

function grandportfolio_custom_css() {
	get_template_part("/modules/custom_css");

	die();
}

/**
*	End custom CSS function
**/

/**
*	Setup custom CSS function
**/
add_action('wp_ajax_grandportfolio_responsive_css', 'grandportfolio_responsive_css');
add_action('wp_ajax_nopriv_grandportfolio_responsive_css', 'grandportfolio_responsive_css');

function grandportfolio_responsive_css() {
	get_template_part("/modules/responsive_css");

	die();
}

/**
*	End custom CSS function
**/


if(THEMEDEMO)
{
	function grandportfolio_add_my_query_var( $link ) 
	{
		$arr_params = array();
	    
	    if(isset($_GET['topbar'])) 
		{
			$arr_params['topbar'] = $_GET['topbar'];
		}
		
		if(isset($_GET['menu'])) 
		{
			$arr_params['menu'] = $_GET['menu'];
		}
		
		if(isset($_GET['frame'])) 
		{
			$arr_params['frame'] = $_GET['frame'];
		}
		
		if(isset($_GET['frame_color'])) 
		{
			$arr_params['frame_color'] = $_GET['frame_color'];
		}
		
		if(isset($_GET['boxed'])) 
		{
			$arr_params['boxed'] = $_GET['boxed'];
		}
		
		if(isset($_GET['footer'])) 
		{
			$arr_params['footer'] = $_GET['footer'];
		}
		
		if(isset($_GET['menulayout'])) 
		{
			$arr_params['menulayout'] = $_GET['menulayout'];
		}
		
		$link = add_query_arg( $arr_params, $link );
	    
	    return $link;
	}
	add_filter('category_link','grandportfolio_add_my_query_var');
	add_filter('page_link','grandportfolio_add_my_query_var');
	add_filter('post_link','grandportfolio_add_my_query_var');
	add_filter('term_link','grandportfolio_add_my_query_var');
	add_filter('tag_link','grandportfolio_add_my_query_var');
	add_filter('category_link','grandportfolio_add_my_query_var');
	add_filter('post_type_link','grandportfolio_add_my_query_var');
	add_filter('attachment_link','grandportfolio_add_my_query_var');
	add_filter('year_link','grandportfolio_add_my_query_var');
	add_filter('month_link','grandportfolio_add_my_query_var');
	add_filter('day_link','grandportfolio_add_my_query_var');
	add_filter('search_link','grandportfolio_add_my_query_var');
	add_filter('previous_post_link','grandportfolio_add_my_query_var');
	add_filter('next_post_link','grandportfolio_add_my_query_var');
}

//Setup custom settings when theme is activated
if (isset($_GET['activated']) && $_GET['activated']){
	//Add default contact fields
	$pp_contact_form = get_option('pp_contact_form');
	if(empty($pp_contact_form))
	{
		add_option( 'pp_contact_form', 's:1:"3";' );
	}
	
	$pp_contact_form_sort_data = get_option('pp_contact_form_sort_data');
	if(empty($pp_contact_form_sort_data))
	{
		add_option( 'pp_contact_form_sort_data', 'a:3:{i:0;s:1:"1";i:1;s:1:"2";i:2;s:1:"3";}' );
	}

	wp_redirect(admin_url("admin.php?page=functions.php&activate=true"));
}
?>