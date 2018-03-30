<?php
//Get theme data
$theme_obj = wp_get_theme('furies');

define("THEMENAME", $theme_obj['Name']);
define("SHORTNAME", "pp");
define("SKINSHORTNAME", "ps");
define("THEMEVERSION", $theme_obj['Version']);
define("THEMEDOMAIN", THEMENAME.'Language');
define("THEMEDEMOURL", 'http://themes.themegoods2.com/furies');

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(THEMENAME)."/");
define("THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(THEMENAME)."/");

//Define include fields from skin option
$pp_include_from_skin_arr = array(SHORTNAME.'_font_color', SHORTNAME.'_content_color', SHORTNAME.'_content_opacity_color', SHORTNAME.'_link_color', SHORTNAME.'_hover_link_color', SHORTNAME.'_h1_font_color', SHORTNAME.'_button_bg_color', SHORTNAME.'_button_font_color', SHORTNAME.'_button_border_color', SHORTNAME.'_menu_font_color', SHORTNAME.'_submenu_font_color', SHORTNAME.'_menu_hover_font_color', SHORTNAME.'_menu_active_font_color');

load_theme_textdomain( THEMEDOMAIN, get_template_directory().'/languages' );

$locale = get_locale();
$locale_file = get_template_directory()."/languages/$locale.php";

if ( is_readable($locale_file) )
{
	require_once($locale_file);
}

//If restore default theme settings
if(isset($_POST['pp_restore_flg']) && !empty($_POST['pp_restore_flg']) && $_GET["page"] == "functions.php")
{
	global $wpdb;
	
	//Inject SQL for default setting
	include_once(get_template_directory() . "/restore.php");
}

//If clear cache
if(isset($_POST['method']) && !empty($_POST['method']) && $_POST['method'] == 'clear_cache')
{
	if(file_exists(TEMPLATEPATH."/cache/combined.js"))
	{
		unlink(TEMPLATEPATH."/cache/combined.js");
	}
	
	if(file_exists(TEMPLATEPATH."/cache/combined.css"))
	{
		unlink(TEMPLATEPATH."/cache/combined.css");
	}
	
	exit;
}

//If activate skin
if(isset($_POST['method']) && !empty($_POST['method']) && $_POST['method'] == 'activate_skin' && !empty($_POST['skin_id']))
{
	wp_reset_query();
	global $wpdb;
	
	$pp_skins_obj = array();
	
	$wpdb->query("SELECT * FROM `".$wpdb->prefix."options` WHERE `option_name` = '".$_POST['skin_id']."'");
	$pp_skins_obj = $wpdb->last_result;
	$skin_settings_arr = unserialize($pp_skins_obj[0]->option_value);
	
	foreach($skin_settings_arr['settings'] as $key => $skin_setting)
	{
		if(in_array($key, $pp_include_from_skin_arr))
		{
			if(!empty($skin_setting))
			{
				update_option( $key, $skin_setting );
			}
			else
			{
				delete_option( $key );
			}
		}
	}
	
	exit;
}

//If delete skin
if(isset($_POST['method']) && !empty($_POST['method']) && $_POST['method'] == 'remove_skin' && !empty($_POST['skin_id']))
{
	delete_option( $_POST['skin_id'] );
	exit;
}

//If delete sidebar
if(isset($_POST['sidebar_id']) && !empty($_POST['sidebar_id']))
{
	$current_sidebar = get_option('pp_sidebar');
	
	if(isset($current_sidebar[ $_POST['sidebar_id'] ]))
	{
		unset($current_sidebar[ $_POST['sidebar_id'] ]);
		update_option( "pp_sidebar", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete ggfont
if(is_admin() && isset($_POST['ggfont']) && !empty($_POST['ggfont']))
{
	$current_ggfont = get_option('pp_ggfont');
	
	if(isset($current_ggfont[ $_POST['ggfont'] ]))
	{
		unset($current_ggfont[ $_POST['ggfont'] ]);
		update_option( "pp_ggfont", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete image
if(isset($_POST['field_id']) && !empty($_POST['field_id']) && isset($_GET["page"]) && $_GET["page"] == "functions.php" )
{
	$current_val = get_option($_POST['field_id']);
	delete_option( $_POST['field_id'] );
	
	echo 1;
	exit;
}

/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu', THEMEDOMAIN ) );
}

if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'gallery_2', 450, 340, true );
	add_image_size( 'gallery_3', 293, 219, true );
	add_image_size( 'gallery_4', 215, 161, true );
	add_image_size( 'gallery_a', 920, 9999, false );
	add_image_size( 'gallery_t', 174, 174, true );
	add_image_size( 'gallery_m', 296, 221, true );
	add_image_size( 'gallery_m2', 296, 450, true );
	add_image_size( 'gallery_wall', 360, 280, true );
	add_image_size( 'project_s', 520, 520, true );
	add_image_size( 'blog', 610, 407, true );
	add_image_size( 'blog_f', 920, 460, true );
}

/**
*	Setup all theme's library
**/

/**
*	Setup admin setting
**/
include (get_template_directory() . "/lib/admin.lib.php");
include (get_template_directory() . "/lib/twitter.lib.php");
include (get_template_directory() . "/lib/cssmin.lib.php");
include (get_template_directory() . "/lib/jsmin.lib.php");

/**
*	Setup Sidebar
**/
include (get_template_directory() . "/lib/sidebar.lib.php");


//Get custom function
include (get_template_directory() . "/lib/custom.lib.php");


//Get custom shortcode
include (get_template_directory() . "/lib/shortcode.lib.php");


// Setup theme custom widgets
include (get_template_directory() . "/lib/widgets.lib.php");


include (get_template_directory() . "/fields/page.fields.php");
include (get_template_directory() . "/fields/post.fields.php");
include (get_template_directory() . "/fields/gallery/tg-gallery.php");

function pp_add_admin() {
 
global $themename, $shortname, $options, $pp_include_from_skin_arr;

if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) 
		{
			if($value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
		}
		
		foreach ($options as $value) {
		
			if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] )) 
			{ 

				if($value['id'] != $shortname."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
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
							update_option( $value['id'].'_family', $_REQUEST[ $value['id'].'_family' ] );
						}
						else
						{
							delete_option( $value['id'] );
							delete_option( $value['id'].'_family' );
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
							update_option( $value['id'], esc_textarea($_REQUEST[ $value['id'] ])  );
						}
						elseif($value['type']=='iphone_checkboxes' OR $value['type']=='jslider')
						{
							update_option( $value['id'], intval($_REQUEST[ $value['id'] ])  );
						}
					
						update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
					}
				}
				elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
				{
					if($value['id'] == SHORTNAME."_sidebar0")
					{
						//get last sidebar serialize array
						$current_sidebar = get_option(SHORTNAME."_sidebar");
						$current_sidebar[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
			
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
		
		if(isset($_POST['pp_save_skin_flg']) && !empty($_POST['pp_save_skin_flg']) && $_GET["page"] == "functions.php")
		{
			global $wpdb;
			$ppskin_id = SKINSHORTNAME."_".time();
			
			$wpdb->query("SELECT * FROM `".$wpdb->prefix."options` WHERE `option_name` LIKE '%pp_%'");
			$pp_settings_obj = $wpdb->last_result;
			$serilize_settings_arr = array();
			
			$serilize_settings_arr['id'] = $ppskin_id;
			$serilize_settings_arr['name'] = $_POST['pp_save_skin_name'];
			foreach ($pp_settings_obj as $pp_setting)
			{
				if(in_array($pp_setting->option_name, $pp_include_from_skin_arr))
				{
					$serilize_settings_arr['settings'][$pp_setting->option_name] = $pp_setting->option_value;
				}
			}
			
			add_option($ppskin_id, $serilize_settings_arr);
			header("Location: admin.php?page=functions.php&saved=true#pp_panel_skins");
			exit;
		}

		header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
	}  
} 
 
add_menu_page('Theme Setting', 'Theme Setting', 'administrator', basename(__FILE__), 'pp_admin', get_admin_url().'/images/generic.png');
}

function pp_add_init() {

$file_dir=get_bloginfo('template_directory');
wp_enqueue_style('thickbox');
wp_enqueue_style("functions", $file_dir."/functions/functions.css", false, "1.0", "all");
wp_enqueue_style("jquery-ui", $file_dir."/functions/jquery-ui/css/ui-lightness/jquery-ui-1.8.10.custom.css", false, "1.0", "all");
wp_enqueue_style("colorpicker_css", $file_dir."/functions/colorpicker/css/colorpicker.css", false, "1.0", "all");
wp_enqueue_style("uniform.aristo", $file_dir."/functions/uniform/css/uniform.aristo.css", false, "1.0", "all");

$pp_font = get_option('pp_font');
if(!empty($pp_font))
{
	wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic", false, "", "all");
}

wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script("jquery-ui-core");
wp_enqueue_script("jquery-ui-sortable");
wp_enqueue_script("colorpicker_script", $file_dir."/functions/colorpicker/js/colorpicker.js", false, "1.0");
wp_enqueue_script("eye_script", $file_dir."/functions/colorpicker/js/eye.js", false, "1.0");
wp_enqueue_script("utils_script", $file_dir."/functions/colorpicker/js/utils.js", false, "1.0");
wp_enqueue_script("iphone_checkboxes", $file_dir."/functions/iphone-style-checkboxes.js", false, "1.0");
wp_enqueue_script("jslider_depend", $file_dir."/functions/jquery.dependClass.js", false, "1.0");
wp_enqueue_script("jslider", $file_dir."/functions/jquery.slider-min.js", false, "1.0");
wp_enqueue_script("jquery.uniform.min", $file_dir."/functions/uniform/jquery.uniform.min.js", false, "1.0");
wp_enqueue_script("rm_script", $file_dir."/functions/rm_script.js", false, "1.0");

}

function pp_enqueue_front_page_styles() {
    //enqueue frontend css files
	$pp_advance_combine_css = get_option('pp_advance_combine_css');
	    
	if(!empty($pp_advance_combine_css))
	{	
	    if(!file_exists(get_template_directory_uri()."/cache/combined.css"))
	    {
	    	$cssmin = new CSSMin();
	    	
	    	$css_arr = array(
	    	    get_template_directory().'/css/screen.css',
	    	    get_template_directory().'/js/fancybox/jquery.fancybox.css',
	    	    get_template_directory().'/js/fancybox/jquery.fancybox-thumbs.css',
	    	    get_template_directory().'/css/supersized.css',
	    	);
	    	
	    	$cssmin->addFiles($css_arr);
	    	
	    	// Set original CSS from all files
	    	$cssmin->setOriginalCSS();
	    	$cssmin->compressCSS();
	    	
	    	$css = $cssmin->printCompressedCSS();
	    	
	    	file_put_contents(get_template_directory()."/cache/combined.css", $css);
	    }
	    
	    wp_enqueue_style("combined_css", get_template_directory_uri()."/cache/combined.css", false, THEMEVERSION);
	}
	else
	{
	    wp_enqueue_style("style.css", get_template_directory_uri(), false, THEMEVERSION, "all");
	    wp_enqueue_style("fancybox", get_template_directory_uri()."/js/fancybox/jquery.fancybox.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("fancybox_thumb", get_template_directory_uri()."/js/fancybox/jquery.fancybox-thumbs.css", false, THEMEVERSION, "all");
	    wp_enqueue_style("supersized", get_template_directory_uri()."/css/supersized.css", false, THEMEVERSION, "all");
	}
	
	//Add custom colors and fonts
	wp_enqueue_style("custom_css", get_template_directory_uri()."/templates/custom-css.php", false, THEMEVERSION, "all");
	
	//Get Google Web font CSS
	$pp_font = get_option('pp_font');
	
	if(!empty($pp_font))
	{
	    wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font."&subset=latin,cyrillic-ext,greek-ext,cyrillic", false, "", "all");
	}
	
	//Check if enable responsive layout
	$pp_enable_responsive = get_option('pp_enable_responsive');
	
	if(!empty($pp_enable_responsive))
	{
	    wp_enqueue_style('grid', get_template_directory_uri()."/css/grid.css", false, "", "all");
	}      
}
add_action( 'wp_enqueue_scripts', 'pp_enqueue_front_page_styles' );


function pp_admin() {
 
global $themename, $shortname, $options;
$i=0;

$pp_font_family = get_option('pp_font_family');
?>

<style>
#pp_sample_text
{
	font-family: '<?php echo $pp_font_family; ?>';
}
</style>
	
	<div id="pp_loading"><span>Updating...</span></div>
	<div id="pp_success"><span>Successfully<br/>Update</span></div>
	
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
		<h2>Theme Setting</h2>(v<?php echo THEMEVERSION; ?>)
		For future updates follow me <a href="http://themeforest.net/user/peerapong">@themeforest</a> or <a href="http://twitter.com/ipeerapong">@twitter</a>
		</div>
		<div style="float:right;margin:32px 0 0 0">
			<input id="save_ppsettings" name="save_ppsettings" class="button-primary" type="submit" value="Save changes" style="margin-left: 25px;" />
			<input id="save_ppskin" name="save_ppskin" class="button" type="submit" value="Save as Skin" />
			<br/><br/>
			<input type="hidden" name="action" value="save" />
			<input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_general" />
			<input type="hidden" name="pp_save_skin_flg" id="pp_save_skin_flg" value="" />
			<input type="hidden" name="pp_save_skin_name" id="pp_save_skin_name" value="" />
		</div>
		<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
		<br style="clear:both"/><br/>
		
		<?php
$cache_dir = get_template_directory().'/cache';
$data_dir = THEMEUPLOAD;

if(!is_writable($cache_dir))
{
?>

	<div id="message" class="error fade">
	<p style="line-height:1.5em"><strong>
		The path <?php echo $cache_dir; ?> is not writable, please login with your FTP account and make it writable (chmod 777) otherwise CSS and javascript compression feature won't work.
	</p></strong>
	</div>

<?php
}
?>
		
		<?php
			if ( isset($_REQUEST['activate']) &&  $_REQUEST['activate'] ) 
			{
		?>		
			
			<div id="message" class="updated fade">
				<p><strong><?php echo THEMENAME; ?> Theme activated</strong></p>
				<p>What's next?<br/><br/>
				<ol>
					<li>The default theme settings are saved but you can navigate to each tab and change them.</li>
					<li>Setup image galleries via Galleries > Add New</li>
					<li>Go to Pages and add some ex. blog, portfolio, services etc.</li>
					<li>Setup blog posts via Posts > Add New</li>
					<li>Setup portfolio items via Portfolios > Add New Portfolio</li>
				</ol>
			</p><br/>
			<p>
				<strong>*Note: </strong>There is  the theme's manual in /manual/index.html it will help you get through all theme features.
			</p>
			</div>
			<br/>
			
		<?php
			}
		?>		
	</div>
	
	<div class="pp_wrap">
	<div id="pp_panel">
	<?php 
		foreach ($options as $value) {
			/*print '<pre>';
			print_r($value);
			print '</pre>';*/
			
			$active = '';
			
			if($value['type'] == 'section')
			{
				if($value['name'] == 'General')
				{
					$active = 'nav-tab-active';
				}
				echo '<a id="pp_panel_'.strtolower($value['name']).'_a" href="#pp_panel_'.strtolower($value['name']).'" class="nav-tab '.$active.'"><img src="'.get_template_directory_uri().'/functions/images/icon/'.$value['icon'].'" class="ver_mid"/>'.str_replace('-', ' ', $value['name']).'</a>';
			}
		}
	?>
	</h2>
	</div>

	<div class="rm_opts">
	
<?php 

// Get Google font list from cache
$pp_font_arr = array();

$font_cache_path = get_template_directory().'/cache/gg_fonts.cache';
$file = file_get_contents($font_cache_path, true);
$pp_font_arr = unserialize($file);

//Get installed Google font (if has)
$current_ggfont = get_option('pp_ggfont');

if(!empty($current_ggfont))
{
	foreach($current_ggfont as $ggfont)
	{
		$pp_font_arr[] = array(
			'font-family' => 'font-family: \''.$ggfont.'\'',
			'font-name' => $ggfont,
			'css-name' => urlencode($ggfont),
		);
	}
}

//Sort by font name
function cmp($a, $b)
{
    return strcmp($a["font-name"], $b["font-name"]);
}
usort($pp_font_arr, "cmp");

$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

foreach ($options as $value) {
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
	if($value['id'] != $shortname."_sidebar0" && $value['id'] != SHORTNAME."_ggfont0")
	{
		$default_val = get_option( $value['id'] );
	}
	else
	{
		$default_val = '';	
	}
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ($default_val != "") { echo get_option( $value['id']) ; } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php
	if($value['id'] == $shortname."_sidebar0")
	{
		$current_sidebar = get_option($shortname."_sidebar");
		
		if(!empty($current_sidebar))
		{
	?>
		<br class="clear"/>
		<div class="pp_sortable_header" style="width:418px">Sidebar Manager</div>
	 	<div class="pp_sortable_wrapper" style="width:418px">
		<ul id="current_sidebar" class="rm_list">

	<?php
		foreach($current_sidebar as $sidebar)
		{
	?> 
			
			<li id="<?php echo $sidebar; ?>"><div class="title"><?php echo $sidebar; ?></div><a href="<?php echo $url; ?>" class="sidebar_del" rel="<?php echo $sidebar; ?>">Delete</a><br style="clear:both"/></li>
	
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
		Below are fonts that already installed.<br/>
		<select name="<?php echo SHORTNAME; ?>_sample_ggfont" id="<?php echo SHORTNAME; ?>_sample_ggfont">
		<?php 
			foreach ($pp_font_arr as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
			value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
		<?php } ?>
		</select> 
	<?php
		$current_ggfont = get_option(SHORTNAME."_ggfont");
		
		if(!empty($current_ggfont))
		{
	?>
		<br class="clear"/>
		<div class="pp_sortable_header" style="width:418px">Google Fonts Manager</div>
	 	<div class="pp_sortable_wrapper" style="width:418px">
		<ul id="current_ggfont" class="rm_list">

	<?php
	
		foreach($current_ggfont as $ggfont)
		{
	?> 
			
			<li id="<?php echo $ggfont; ?>"><div class="title"><?php echo $ggfont; ?></div><a href="<?php echo $url; ?>" class="ggfont_del" rel="<?php echo $ggfont; ?>">Delete</a><br style="clear:both"/></li>
	
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

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>
	<?php
break;

break;

case 'image':
case 'music':
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input id="<?php echo $value['id']; ?>" type="text" name="<?php echo $value['id']; ?>" value="<?php echo get_option($value['id']); ?>" style="width:200px" class="upload_text" readonly />
	<input id="<?php echo $value['id']; ?>_button" name="<?php echo $value['id']; ?>_button" type="button" value="Upload" class="upload_btn button" rel="<?php echo $value['id']; ?>" style="margin:7px 0 0 5px" />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<script>
	jQuery(document).ready(function() {
		jQuery('#<?php echo $value['id']; ?>_button').click(function() {
         	formfield = jQuery('#<?php echo $value['id']; ?>').attr('name');
         	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
         	return false;
        });
         
        window.send_to_editor = function(html) {
         	musicurl = jQuery(html).get(0).href;
         	jQuery('#'+formfield).attr('value', musicurl);
         	tb_remove();
         	jQuery('#pp_form').submit();
        }
    });
	</script>
	
	<?php 
		$current_value = get_option( $value['id'] );
		
		if(!is_bool($current_value) && !empty($current_value))
		{
			if($value['type']=='image')
			{
	?>
	
		<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;"><br/>
			<img src="<?php echo get_option($value['id']); ?>" style="max-width:500px"/><br/><br/>
			<a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>">Delete</a>
		</div>
		<?php
			}
			else
			{
		?>
		<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;">
			<br/><a href="<?php echo get_option( $value['id'] ); ?>">
			Listen current music</a>&nbsp;<a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>">Delete</a>
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

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<div style="float:left;width:290px;margin-top:10px">
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text" class="jslider"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	</div>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<script>jQuery("#<?php echo $value['id']; ?>").slider({ from: <?php echo $value['from']; ?>, to: <?php echo $value['to']; ?>, step: <?php echo $value['step']; ?>, smooth: true, skin: "round_plastic" });</script>

	</div>
	<?php
break;

case 'colorpicker':
?>
	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="text" 
		value="<?php if ( get_option( $value['id'] ) != "" ) { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker" readonly/>
	<div id="<?php echo $value['id']; ?>_bg" class="colorpicker_bg" onclick="jQuery('#<?php echo $value['id']; ?>').click()" style="background:<?php if (get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?> url(<?php echo get_template_directory_uri(); ?>/functions/images/trigger.png) center no-repeat;">&nbsp;</div>
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	</div>
	
<?php
break;
 
case 'textarea':
?>

	<div class="rm_input rm_textarea"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<textarea name="<?php echo $value['id']; ?>"
		type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id']) ); } else { echo $value['std']; } ?></textarea>
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>

	</div>

	<?php
break;
 
case 'select':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>">
		<?php foreach ($value['options'] as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $key) { echo 'selected="selected"'; } ?>
			value="<?php echo $key; ?>"><?php echo $option; ?></option>
		<?php } ?>
	</select> <small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'font':
?>

	<div class="rm_input rm_font"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div id="<?php echo $value['id']; ?>_wrapper" style="float:left;font-size:11px;">
	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>">
		<option value="" data-family="">---- Disable Google Webfonts ----</option>
		<?php 
			foreach ($pp_font_arr as $key => $option) { ?>
		<option
		<?php if (get_option( $value['id'] ) == $option['css-name']) { echo 'selected="selected"'; } ?>
			value="<?php echo $option['css-name']; ?>" data-family="<?php echo $option['font-name']; ?>"><?php echo $option['font-name']; ?></option>
		<?php } ?>
	</select> 
	<input type="hidden" id="<?php echo $value['id']; ?>_family" name="<?php echo $value['id']; ?>_family" value="<?php echo get_option( $value['id'].'_family' ); ?>"/>
	<br/><br/><div id="pp_sample_text">Sample Text</div>
	</div>
	
	<small>
		You can also view preview of all fonts from <a href="http://www.google.com/webfonts">Google web fonts</a>
	</small>
	
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case 'radio':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div style="margin-top:5px;float:left;width:300px">
	<?php foreach ($value['options'] as $key => $option) { ?>
	<div style="float:left;margin:0 20px 20px 0">
		<input style="float:left;" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" type="radio"
		<?php if (get_option( $value['id'] ) == $key) { echo 'checked="checked"'; } ?>
			value="<?php echo $key; ?>"/><?php echo $option; ?>
	</div>
	<?php } ?>
	</div>
	
		<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'skin':
	global $wpdb;
	$pp_skins_obj = array();
	
	$wpdb->query("SELECT * FROM `".$wpdb->prefix."options` WHERE `option_name` LIKE '%".SKINSHORTNAME."_%'");
	$pp_skins_obj = $wpdb->last_result;
	//pp_debug($pp_skins_obj);
	
	if ($_SERVER["SERVER_PORT"] != "80") {
	  	$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].":".$_SERVER["SERVER_PORT"].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].":".$_SERVER["SERVER_PORT"].$_SERVER['REQUEST_URI'];
	} else {
	  	$api_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	}
?>

	<div class="rm_input" style="margin-top:10px">
	<label for="pp_theme_layout">
		<h2>Skins Manager</h2>
	</label>
	<?php echo $value['desc']; ?>
	<br style="clear:both"/><br/>

	<ul class="pp_skin_mgmt"> 
	 <?php 
		foreach ($pp_skins_obj as $key => $pp_skin) { 
			//Get skin name	
			$pp_skin_arr = unserialize($pp_skin->option_value);
			//pp_debug(unserialize($pp_skin_arr));
	?>
	 		<li class="ui-state-default">
	 			<div class="title"><?php echo $pp_skin_arr['name']; ?></div>
	 			<a data-rel="<?php echo $pp_skin_arr['id']; ?>" href="<?php echo $api_url; ?>" class="skin_remove remove">x</a>
	 			<a data-rel="<?php echo $pp_skin_arr['id']; ?>" href="<?php echo $api_url; ?>" class="skin_activate button">Activate</a>
	 			<br style="clear:both"/>
	 		</li> 	
	 <?php
	 	}
	 ?>
	 </ul>
	
	<div class="clearfix"></div>
	</div>
	<?php
break;

case 'sortable':
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div style="float:left;width:100%;">
	<?php 
	$sortable_array = unserialize(get_option( $value['id'] ));
	
	$current = 1;
	
	if(!empty($value['options']))
	{
	?>
	<select name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" class="pp_sortable_select">
	<?php
	foreach ($value['options'] as $key => $option) { 
		if($key > 0)
		{
	?>
	<option value="<?php echo $key; ?>" data-rel="<?php echo $value['id']; ?>_sort" title="<?php echo html_entity_decode($option); ?>"><?php echo html_entity_decode($option); ?></option>
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
	<a class="button pp_sortable_button" data-rel="<?php echo $value['id']; ?>" class="button" style="margin-top:5px;float:left;">Add</a>
	<?php
	}
	?>
	 
	 <br style="clear:both"/>
	 
	 <div class="pp_sortable_header" style="width:418px"><?php echo $value['sort_title']; ?></div>
	 <div class="pp_sortable_wrapper" style="width:418px">
	 Drag each item for sorting.<br/>
	 <ul id="<?php echo $value['id']; ?>_sort" class="pp_sortable" rel="<?php echo $value['id']; ?>_sort_data"> 
	 <?php
	 	$sortable_data_array = unserialize(get_option( $value['id'].'_sort_data' ));

	 	if(!empty($sortable_data_array))
	 	{
	 		foreach($sortable_data_array as $key => $sortable_data_item)
	 		{
		 		if(!empty($sortable_data_item))
		 		{
	 		
	 ?>
	 		<li id="<?php echo $sortable_data_item; ?>_sort" class="ui-state-default"><div class="title"><?php echo $value['options'][$sortable_data_item]; ?></div><a data-rel="<?php echo $value['id']; ?>_sort" href="javascript:;" class="remove">x</a><br style="clear:both"/></li> 	
	 <?php
	 			}
	 		}
	 	}
	 ?>
	 </ul>
	 
	 </div>
	 
	</div>
	
	<input type="hidden" id="<?php echo $value['id']; ?>_sort_data" name="<?php echo $value['id']; ?>_sort_data" value="" style="width:100%"/>
	<br style="clear:both"/><br/>
	
	<div class="clearfix"></div>
	</div>
	<?php
break;
 
case "checkbox":
?>

	<div class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>
<?php break; 

case "iphone_checkboxes":
?>

	<div class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
	<input type="checkbox" class="iphone_checkboxes" name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />


	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	</div>

<?php break; 

case "html":
?>

	<div class="rm_input rm_checkbox"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<?php echo $value['html']; ?>

	<small><?php echo $value['desc']; ?></small>
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
		class="inactive" alt="""><?php echo $value['name']; ?></h3>
	<span class="submit"><input class="button-primary" name="save<?php echo $i; ?>" type="submit"
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

add_action('admin_init', 'pp_add_init');
add_action('admin_menu', 'pp_add_admin');


/**
*	Setup all theme's plugins
**/
// Setup shortcode generator plugin
include (get_template_directory() . "/plugins/shortcode_generator.php");

// Setup Twitter API
include (get_template_directory() . "/plugins/twitteroauth.php");


function pp_tag_cloud_filter($args = array()) {
   $args['smallest'] = 11;
   $args['largest'] = 11;
   $args['unit'] = 'px';
   return $args;
}

add_filter('widget_tag_cloud_args', 'pp_tag_cloud_filter', 90);

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

if (isset($_GET['activated']) && $_GET['activated']){
	global $wpdb;
	
	// Run default settings
	include_once(get_template_directory() . "/default_settings.php");
	
    wp_redirect(admin_url("themes.php?page=functions.php&activate=true"));
}
?>