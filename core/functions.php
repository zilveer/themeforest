<?php

define("THEMENAME", "Core");
define("SHORTNAME", "pp");
define("THEMEVERSION", time());
define("THEMEDOMAIN", THEMENAME.'Language');

//Get default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", TEMPLATEPATH."/data/");
define("THEMEUPLOADURL", get_template_directory_uri()."/data/");

load_theme_textdomain( THEMEDOMAIN, TEMPLATEPATH.'/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";

if ( is_readable($locale_file) )
{
	require_once($locale_file);
}

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'blog_ft', 625, 350, true );
	add_image_size( 'gallery_2', 295, 250, true );
	add_image_size( 'gallery_3', 180, 160, true );
	add_image_size( 'gallery_4', 138, 120, true );
	add_image_size( 'home_rotate', 305, 465, true );
	add_image_size( 'full_thumb', 80, 80, true );
}

//If delete sidebar
if(is_admin() && isset($_POST['sidebar_id']) && !empty($_POST['sidebar_id']))
{
	$current_sidebar = get_option('pp_sidebar');
	
	if(is_admin() && isset($current_sidebar[ $_POST['sidebar_id'] ]))
	{
		unset($current_sidebar[ $_POST['sidebar_id'] ]);
		update_option( "pp_sidebar", $current_sidebar );
	}
	
	echo 1;
	exit;
}

//If delete image
if(is_admin() && isset($_POST['field_id']) && !empty($_POST['field_id']))
{
	$current_val = get_option($_POST['field_id']);
	unlink(TEMPLATEPATH.'/data/'.$current_val);
	delete_option( $_POST['field_id'] );
	
	echo 1;
	exit;
}

/*
 *  Setup main navigation menu
 */
add_action( 'init', 'register_my_menu' );
function register_my_menu() {
	register_nav_menu( 'primary-menu', __( 'Primary Menu' ) );
}

if ( function_exists( 'add_theme_support' ) ) {
	// Setup thumbnail support
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
}

/**
*	Setup all theme's library
**/

/**
*	Setup admin setting
**/
include (TEMPLATEPATH . "/lib/admin.lib.php");
include (TEMPLATEPATH . "/lib/twitter.lib.php");

/**
*	Setup Sidebar
**/
include (TEMPLATEPATH . "/lib/sidebar.lib.php");


//Get custom function
include (TEMPLATEPATH . "/lib/custom.lib.php");


//Get custom shortcode
include (TEMPLATEPATH . "/lib/shortcode.lib.php");


// Setup theme custom widgets
include (TEMPLATEPATH . "/lib/widgets.lib.php");


include (get_template_directory() . "/fields/page.fields.php");
include (get_template_directory() . "/fields/post.fields.php");


function pp_add_admin() {
 
global $themename, $shortname, $options;

if(empty($_REQUEST[SHORTNAME.'_predefined_skins']))
{

if ( isset($_GET['page']) && $_GET['page'] == basename(__FILE__) ) {
 
	if ( isset($_REQUEST['action']) && 'save' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) 
		{
			if(is_admin() && $value['type'] != 'image' && isset($value['id']) && isset($_REQUEST[ $value['id'] ]))
			{
				update_option( $value['id'], $_REQUEST[ $value['id'] ] );
			}
		}
		
		foreach ($options as $value) {
		
			if( isset($value['id']) && isset( $_REQUEST[ $value['id'] ] ) && $value['type'] != 'image') 
			{ 
				if($value['id'] != $shortname."_sidebar0")
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
						update_option( $value['id'], $_REQUEST[ $value['id'] ] );
						update_option( $value['id'].'_family', $_REQUEST[ $value['id'].'_family' ] );
					}
					else
					{
						if(is_admin())
						{
							update_option( $value['id'], $_REQUEST[ $value['id'] ]  );
						}
					}
				}
				elseif(is_admin() && isset($_REQUEST[ $value['id'] ]) && !empty($_REQUEST[ $value['id'] ]))
				{
					//get last sidebar serialize array
					$current_sidebar = get_option($shortname."_sidebar");
					$current_sidebar[ $_REQUEST[ $value['id'] ] ] = $_REQUEST[ $value['id'] ];
		
					update_option( $shortname."_sidebar", $current_sidebar );
				}
			} 
			elseif(is_admin() && isset($_FILES[ $value['id'] ]) || isset($_FILES[ $value['id'].'_upload' ])) 
			{
		
				if($value['type'] == 'image' OR $value['type'] == 'music')
				{
					if(is_writable(THEMEUPLOAD) && !empty($_FILES[$value['id']]['name']))
					{
					    $current_time = time();
					    $target = THEMEUPLOAD.$current_time.'_'.basename( $_FILES[$value['id']]['name']);
					    $current_file = THEMEUPLOAD.get_option($value['id']);
					
					    if(move_uploaded_file($_FILES[$value['id']]['tmp_name'], $target)) 
					    {
					    	if(file_exists($current_file) && !is_dir($current_file))
					    	{
						    	unlink($current_file);
						    }
					     	update_option( $value['id'], $current_time.'_'.basename( $_FILES[$value['id']]['name'])  );
					    }
					}
				}
				
			}
			else 
			{ 
				if(is_admin())
				{
					delete_option( $value['id'] );
				}
			} 
		}

		header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
 
	} 
	else if(is_admin() && isset($_REQUEST['action']) && 'reset' == $_REQUEST['action'] ) {
 
		foreach ($options as $value) {
		delete_option( $value['id'] ); }
 
		header("Location: admin.php?page=functions.php&reset=true");
 
	} 
} 

} // end if skin empty
else
{
	include_once (TEMPLATEPATH . "/lib/skin.lib.php");
	$selected_skin = $_REQUEST[SHORTNAME.'_predefined_skins'];
	
	foreach($pp_skin_options[$selected_skin] as $option_id => $option_value)
	{
		if(is_admin())
		{
			update_option( $option_id, $option_value  );
		}
	}
	
	header("Location: admin.php?page=functions.php&saved=true".$_REQUEST['current_tab']);
}
 
add_menu_page($themename, $themename, 'administrator', basename(__FILE__), 'pp_admin', get_admin_url().'/images/generic.png');
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
	wp_enqueue_style('google_fonts', "http://fonts.googleapis.com/css?family=".$pp_font, false, "", "all");
}

wp_enqueue_script('media-upload');
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
	
	<form id="pp_form" method="post" enctype="multipart/form-data">
	<div class="pp_wrap rm_wrap">
	
	<div class="header_wrap">
		<div style="float:left">
		<h2>Theme Setting</h2>
		For future updates follow me <a href="http://themeforest.net/user/peerapong">@themeforest</a> or <a href="http://twitter.com/ipeerapong">@twitter</a>
		</div>
		<div style="float:right;margin:32px 0 0 0">
			<input name="save<?php echo $i; ?>" class="button" type="submit" value="Save changes" style="margin-left: 25px;" />
			<br/><br/>
 <input type="hidden" name="action" value="save" />
 <input type="hidden" name="current_tab" id="current_tab" value="#pp_panel_general" />
		</div>
		<input type="hidden" name="pp_admin_url" id="pp_admin_url" value="<?php echo get_template_directory_uri(); ?>"/>
		<br style="clear:both"/><br/>
		
		<?php
$cache_dir = TEMPLATEPATH.'/cache';
$data_dir = THEMEUPLOAD;

if(!is_writable($cache_dir))
{
?>

	<div id="message" class="error fade">
	<p style="line-height:1.5em"><strong>
		The path <?php echo $cache_dir; ?> is not writable, please login with your FTP account and make it writable (chmod 777) otherwise all images won't display.
	</p></strong>
	</div>

<?php
}

if(!is_writable($data_dir))
{
?>

	<div id="message" class="error fade">
	<p style="line-height:1.5em"><strong>
		The path <?php echo $data_dir; ?> is not writable, please login with your FTP account and make it writable (chmod 777) otherwise all file uploader won't work.
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
					<li>Setup homepage's slider via Slides > Add New Slide</li>
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

// Get Google font list
$pp_font_arr = array();

$font_cache_path = TEMPLATEPATH.'/cache/gg_fonts.cache';

if(file_exists($font_cache_path))
{
    $font_cache_timer = intval((time()-filemtime($font_cache_path))/60);
}
else
{
    $font_cache_timer = 0;
}


if(!file_exists($font_cache_path) OR $font_cache_timer > 1440)
{
	$fonts_seraliazed = file_get_contents('http://phat-reaction.com/googlefonts.php?format=php');
	$pp_font_arr = unserialize($fonts_seraliazed);
	
	if(file_exists($font_cache_path))
	{
	    unlink($font_cache_path);
	}
	
	$myFile = $font_cache_path;
	$fh = fopen($myFile, 'w');
	fwrite($fh, $fonts_seraliazed);
	fclose($fh);
}
else
{
	$file = file_get_contents($font_cache_path, true);
	$pp_font_arr = unserialize($file);
}

/*echo '<pre>';
print_r($pp_font_arr);
echo '</pre>';*/


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
	if($value['id'] != $shortname."_sidebar0")
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
		$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	
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
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="file"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php 
		if(is_file($data_dir.'/'.get_option( $value['id'] )) && !is_bool(get_option( $value['id'] )))
		{
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	?>
	
	<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;"><br/>
		<img src="<?php echo THEMEUPLOADURL; ?><?php echo get_option( $value['id'] ); ?>" style="max-width:500px"/><br/><br/>
		Current Image <a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>">Delete</a>
	</div>
	<?php
		}
	?>

	</div>
	<?php
break;

case 'music':
?>

	<div class="rm_input rm_text"><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>
	<input name="<?php echo $value['id']; ?>"
		id="<?php echo $value['id']; ?>" type="file"
		value="<?php if ( get_option( $value['id'] ) != "") { echo stripslashes(get_option( $value['id'])  ); } else { echo $value['std']; } ?>"
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?> />
	<small><?php echo $value['desc']; ?></small>
	<div class="clearfix"></div>
	
	<?php 
		if(is_file($data_dir.'/'.get_option( $value['id'] )) && !is_bool(get_option( $value['id'] )))
		{
			$url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	?>
	
	<div id="<?php echo $value['id']; ?>_wrapper" style="width:380px;font-size:11px;">
		<br/><a href="<?php echo get_template_directory_uri(); ?>/data/<?php echo get_option( $value['id'] ); ?>">
		Listen current music</a>&nbsp;<a href="<?php echo $url; ?>" class="image_del button" rel="<?php echo $value['id']; ?>">Delete</a>
	</div>
	<?php
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
		<?php if(!empty($value['size'])) { echo 'style="width:'.$value['size'].'"'; } ?>  class="color_picker"/>
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
		<option value="" data-family="">---- Default Theme Font ----</option>
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
?>

	<div class="rm_input rm_select"><label
		for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label><br/>

	<div style="float:left;width:300px;margin-top:10px">
	<?php foreach ($value['options'] as $key => $option) { ?>
	<div style="float:left;width:150px;margin-bottom:20px">
		<a class="skin_img" href="#" onclick="jQuery('#<?php echo $value['id']; ?>').attr('value', <?php echo $key; ?>);jQuery('#pp_form').submit();">
			<?php echo $option; ?>
		</a>
	</div>
	<?php } ?>
	<input type="hidden" id="<?php echo $value['id']; ?>" name="<?php echo $value['id']; ?>" value=""/>
	</div>
	
		<small><?php echo $value['desc']; ?></small>
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
	 			if(is_numeric($sortable_data_item))
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
include (TEMPLATEPATH . "/plugins/troubleshooting.php");
include (TEMPLATEPATH . "/plugins/shortcode_generator.php");

// Setup Gallery Plugin
include (TEMPLATEPATH . "/plugins/shiba-media-library/shiba-media-library.php");

// Setup Twitter API
include (TEMPLATEPATH . "/plugins/twitteroauth.php");


function pp_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'pp_formatter', 99);
add_filter('widget_text', 'pp_formatter', 99);

//Make widget support shortcode
add_filter('widget_text', 'do_shortcode');

if (is_admin() && isset($_GET['activated']) && $_GET['activated']){
	global $wpdb;
	
	// Run default settings
	include_once(TEMPLATEPATH . "/default_settings.php");
    wp_redirect(admin_url("themes.php?page=functions.php&activate=true"));
}
?>