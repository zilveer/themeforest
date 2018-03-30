<?php
/**
 * @package WordPress
 * @subpackage Origami_Theme
 */
 // VARIABLES
$themename = "Origami";
$shortname = "themeteam_origami";
$manualurl = 'http://origmai.gothemeteam.com/';
$functions_path = TEMPLATEPATH . '/functions/';
$functions_include_path = TEMPLATEPATH . '/function_includes/';
define('THEMETEAM_IMAGE_RESIZE', get_template_directory_uri() . '/function_includes' );
define('THEMETEAM_JS', get_bloginfo('template_url') . '/js/');

//include theme options
require_once ($functions_include_path . 'theme-options.php');
//include theme common elements
require_once ($functions_include_path . 'theme-common-elements.php');
//include custom head
require_once ($functions_include_path . 'theme-js.php');
//include custom widgets
require_once ($functions_include_path . 'theme-widgets.php');
//include custom Shortcodes
require_once($functions_include_path . 'theme-shortcodes.php');
//include custom post types
require_once($functions_include_path . 'theme-custom-post-types.php');
//include custom meta box
require_once($functions_include_path . 'theme-custom-metabox.php');

// Activation
if (is_admin() && isset($_GET['activated']) && isset($GLOBALS['pagenow']) && $GLOBALS['pagenow'] == 'themes.php')
{
	if(!get_option('themeteam_origami_version')){
		update_option('themeteam_origami_version','1.0');
		update_option('themeteam_origami_enable_breadcrumbs', 'yes');
		update_option('themeteam_origami_button_color', 'lightblue');
		update_option('themeteam_origami_custom_bg', 'bg_default');
		update_option('themeteam_origami_featured_slider_type', 'normal_width');
		update_option('themeteam_origami_message_layout', 'single');
		update_option('themeteam_origami_individual_message_text', 'This is a sample Message, this message is controlled in the Origami Options in the admin side.');
		update_option('themeteam_origami_individual_button_text', 'Message Button');
		update_option('themeteam_origami_individual_link', 'http://gothemeteam.com');
		update_option('themeteam_origami_featured_layout', 'postsandrecent');

		update_option('themeteam_origami_footer1_header', 'Privacy Statement ');
		update_option('themeteam_origami_footer1_url', 'http://gothemeteam.com');
		update_option('themeteam_origami_footer2_header', 'Terms & Conditions');
		update_option('themeteam_origami_footer2_url', 'http://gothemeteam.com');

		update_option('themeteam_origami_copyright', '2010');
		update_option('themeteam_origami_enable_cufon', 'no');

		//Get data for page with the title of the new post.
		//We'll later use this to check if it already exists, if it does we won't create it.
		$page_check = get_page_by_title('Test Page');
		$page_check_id = $page_check->ID;

		//Declaring the data for our new page
		$new_page = array(
			'post_type' => 'page',
			'post_title' => 'Test Page',
			'post_status' => 'publish',
			'post_author' => 1,
		);

		//If the page doesn't already exist create it
		if(!isset($page_check_id)){
			wp_insert_post($new_page);
			//getting the data of our new page and assigning a page template for it.
			//If you're not going to use a custom template remove the next 3 lines
			$new_page_data = get_page_by_title('Test Page');
			$new_page_id = $new_page_data->ID;
			update_post_meta($new_page_id, '_wp_page_template','page.php');
			update_post_meta($new_page_id, 'themeteam_image_upload','/wp-content/themes/origami/images/infrared.jpg');
			update_post_meta($new_page_id, 'themeteam_slider_text','this is some sample slider text. You can enter this in the page custom options.');
			update_option('themeteam_origami_featured_slider_ids',$new_page_id);

			//now create a post
			$new_post = array(
				'post_type' => 'post',
				'post_title' => 'Sample Post',
				'post_status' => 'publish',
				'post_content' => 'This is a sample post. Please delete if you would like to. ',
				'post_author' => 1,
			);

			//If the page doesn't already exist create it
			wp_insert_post($new_post);

		}


	}
}

// Admin Panel
function themeteam_add_admin() {
	global $themename, $options;

	if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                	//update button css
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] );
				}

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); }
				}

				header("Location: admin.php?page=functions.php&saved=true");

			die;

		}

	}

	add_menu_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'themeteam_page', get_bloginfo('template_directory').'/images/tt_logo.png');
}

function tt_admin_tinymce() {
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'jquery-color' );
	wp_print_scripts('editor');
	if (function_exists('add_thickbox')) add_thickbox();
	wp_print_scripts('media-upload');
	if (function_exists('wp_tiny_mce')) wp_tiny_mce();
	wp_admin_css();
	wp_enqueue_script('utils');
	do_action("admin_print_styles-post-php");
	do_action('admin_print_styles');
}


function themeteam_page (){
	global $options, $themename, $manualurl;

?>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory')?>/function_includes/admin/css/admin-styles.css" media="screen" />
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory');?>/css/Aristo/jquery-ui-1.8rc3.custom.css" media="screen" />
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/admin/jquery-ui-1.8.4.custom.min.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/admin/admin_tt.js"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/admin/upload_admin.js"></script>

<link rel="stylesheet" media="screen" type="text/css" href="<?php echo get_bloginfo('template_directory')?>/function_includes/admin/colorpicker/css/colorpicker.css" />
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory')?>/function_includes/admin/colorpicker/js/colorpicker.js"></script>

<script type="text/javascript" src="<?php echo get_bloginfo('template_directory');?>/js/cufon_yui.js"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Aller.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Andika.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Bebas.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Caviar_Dreams-Bold.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Caviar_Dreams.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Colaborate-Bold.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Colaborate.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Delicious.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Delicious-Bold.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Geosans.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/League_Gothic.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Lane-Narrow.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Lobster.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Mido.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Miso.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/PT_Sans.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/PT_Sans-Bold.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Sansation.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Sansation-Bold.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Segan.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Tallys.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Yanone_Kaffeesatz.font.js" type="text/javascript"></script>
<script src="<?php echo get_bloginfo('template_directory');?>/fonts/cufon/Yanone_Kaffeesatz-Bold.font.js" type="text/javascript"></script>

<script type="text/javascript">
	$(function() {
		$("#tabs").tabs({

		});
		$("#themeteam_origami_featured_slider_ids").buttonset();
		$("#radioButton").buttonset();
		$('.uibutton').button();

	});
</script>


<div id="wrap">
	<h2><?php echo $themename; ?> Options</h2>

	<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options have been updated!</div><?php } ?>

	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">General Options</a></li>
			<li><a href="#tabs-2">Homepage Options</a></li>
			<li><a href="#tabs-3">Footer Options</a></li>
			<li><a href="#tabs-4">Font Color Options</a></li>
			<li><a href="#tabs-5">Cufon Options</a></li>
			<li><a href="#tabs-6"><img src="<?php echo get_bloginfo('template_directory');?>/images/tt_logo.png"/></a></li>
		</ul>

		<?php
		$counter = 0;
		$count = 1;
		foreach ($options as $value) {
			if( $value['type'] == "heading" )
			{

				if($count > 1){
			?>
					</table></div></div>
			<?php
				}
			?>
			<div id="tabs-<?php echo $count; ?>">
				<div class="submit">
					<input name="save" type="submit" value="Save changes" />
					<input type="hidden" name="action" value="save" />
				</div>
				<div>
					<table class="admintable">
			<?php
				$count++;
			}

			if ( $value['type'] <> "heading" )
			{
				if($value['type'] == "subsection"){
			?>
					<tr class="ui-widget-header mainrowsub">
						<td class="titlesubsection" colspan="2"><?php echo $value['name']; ?></td>
					</tr>
			<?php
				}else if($value['css'] == "normal"){
			?>
					<tr class="adminTR">
						<td class="headerAdmin"><?php echo $value['name']; ?></td>
						<td class="adminForm">
			<?php
				}else if($value['css'] == "none"){
			?>
					<tr class="adminTR2">
						<td class="headerAdmin"><?php echo $value['name']; ?></td>
						<td class="adminForm">
			<?php
				}
			}

			switch ( $value['type'] ) {

				case 'text':
					if( $value['id'] != "") {
						$tempValue = get_settings($value['id']);
					} else {
						$tempValue = $value['std'];
					}
			?>
				<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo stripslashes($tempValue); ?>" />
			<?php
				break;
				case 'colorpicker':
					if( $value['id'] != "") {
						$tempValue = get_settings($value['id']);
					} else {
						$tempValue = $value['std'];
					}
			?>
					<div id="colorSwatch-<?php echo $value['id']; ?>" class="colorSwatch"></div>&nbsp;&nbsp;<input style="width: 100px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $tempValue; ?>" />
					<!-- set the javascript for color picker -->
					<script>
						jQuery(	function($){
							$("#colorSwatch-<?php echo $value['id']; ?>").css("background-color", "#<?php echo $tempValue; ?>");
							$("#<?php echo $value['id']; ?>").ColorPicker({
								onSubmit: function(hsb, hex, rgb, el) {$(el).val(hex);$(el).ColorPickerHide();},
								onChange: function (hsb, hex, rgb) {$("#colorSwatch-<?php echo $value['id']; ?>").css("background-color", "#" + hex);$("#<?php echo $value['id']; ?>").val(hex);},
								onBeforeShow: function (hex) {$(this).ColorPickerSetColor(this.value);}});
						});
					</script>
			<?php
				break;
				case 'select':
			?>
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
			<?php
				$select_value = get_option($value['id']);

				foreach ($value['options'] as $option => $name) {

					$selected = '';

					 if($select_value != '') {
						 if ( $select_value == $option) { $selected = ' selected="selected"';}
				     } else {
						 if ( isset($value['std']) )
							 if ($value['std'] == $option) { $selected = ' selected="selected"'; }
					 }
			?>
					 <option <?php echo $selected; ?> value="<?php echo $option; ?>">
					 	<?php echo $name; ?>
					 </option>
			<?php
				 }
			?>
				 	</select>

			<?php
				break;
				case 'textarea':
			 		$defaultValue;
					if( $value['id'] != "") {
						$defaultValue = stripslashes(get_settings($value['id']));
					} else {
						$defaultValue = $value['std'];
					}
			?>
					<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="80" rows="8"><?php echo $defaultValue; ?></textarea>
			<?php
				break;
				case 'checkbox':
					$checked;
					if($value['id']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
			?>
					<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
			<?php
				break;
				case "radio":

					$select_value = get_option( $value['id']);

			 		foreach ($value['options'] as $key => $option)
			 		{

				 		$checked = '';
				   		if($select_value != '') {
							if ( $select_value == $key) { $checked = ' checked'; }
				   		} else {
							if ($value['std'] == $key) { $checked = ' checked'; }
				   		}
			?>
						<input class="ttRadio" type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
			<?php
					}

				break;
				case "radio_ibutton":

					$select_value = get_option( $value['id']);
					$count = 1;
			?>
				 	<div id="radioButton">
			<?php
				 	foreach ($value['options'] as $key => $option)
				 	{

					 	$checked = '';
				   		if($select_value != '') {
							if ( $select_value == $key) { $checked = ' checked'; }
				   		} else {
							if ($value['std'] == $key) { $checked = ' checked'; }
				   		}
			?>
						<script>Cufon.replace("#<?php echo $count; ?>", { fontFamily: "<?php echo $option; ?>", fontSize: "16px" });</script>
						<input class="iRadio" type="radio" id="<?php echo $value['id']; ?>_<?php echo $count; ?>" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><label for="<?php echo $value['id']; ?>_<?php echo $count; ?>">Enable</label><span class="cufonButton" id="<?php echo $count; ?>"><?php echo $option; ?></span><br />
			<?php
						$count++;
					}
			?>
					</div>
			<?php
				break;
				case 'checkboxselect':
					$shortname = "themeteam_origami";
					//get pages for global
					$pages_list = get_pages();
					$getpagnav = array();
					foreach($pages_list as $apage) {
						$getpagnav[$apage->ID] = $apage->post_title;
					}
			?>
					<div id="<?php echo $shortname; ?>_featured_slider_ids" class="page_select">
			<?php
				$checked;
				if($get_options[$id]){ $checked = "checked=\"checked\""; }else{ $checked = "";}
				$value['options'] = $getpagnav;
				foreach ($value['options'] as $pgid => $pgname) {

					if ($pgname !='') {
			?>
						<input type="checkbox" name="<?php echo $pgid; ?>" id="<?php echo $value['id']; ?>_<?php echo $pgid; ?>" class="select_<?php echo $value['id']; ?> checkbox"/><label for="<?php echo $value['id']; ?>_<?php echo $pgid; ?>"><?php echo $pgname; ?></label>
			<?php
					}
				}
			?>
				</div><div id="maxMessage" style="display:none;"></div>
			<?php

				break;
				case 'catselect':
			?>
					<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
 						<option value="">Select Category</option>
			<?php
					 $args=array(
					  'type' => 'post',
					  'order' => 'ASC'
					  );
					  $categories=  get_categories($args);
					  foreach ($categories as $category) {
					  	$option_sel = '<option value="'.$category->term_id;
					  	if(get_settings($value['id']) == $category->term_id){
					  		$option_sel .= '" selected="selected" ';
					  	}
					  	$option_sel .= '">';
						$option_sel .= $category->cat_name;
						$option_sel .= '</option>';
			?>
						<?php echo $option_sel; ?>
			<?php
					  }
			?>
					</select>
			<?php
				break;
				case 'logo_upload':
					if( $value['id'] != "") {
						$tempValue = get_settings($value['id']);
					} else {
						$tempValue = $value['std'];
					}
			?>
					<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo $tempValue; ?>" class="input_text" />
					<input id="upload_logo_button" type="button" value="Upload Image" style="width:20%;"/>
			<?php
				break;
				case 'bg_upload':
					if( $value['id'] != "") {
						$tempValue = get_settings($value['id']);
					} else {
						$tempValue = $value['std'];
					}
			?>
					<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="text" value="<?php echo $tempValue; ?>" class="input_text" />
					<input id="upload_bg_button" type="button" value="Upload Image" style="width:20%;"/>
			<?php
				break;
				case 'editor':
					$defaultValue;
					if( $value['id'] != "") {
						$defaultValue = stripslashes(get_settings($value['id']));
					} else {
						$defaultValue = $value['std'];
					}
					$tempID;
					if(user_can_richedit()){
						$tempID = 'postdivrich';
					}else{
						$tempID = 'postdiv';
					}
			?>
					</table>
					<h3>Custom Content</h3>
					<p style="font-size:9px;">If you chose Custom Content enter content here.</p>
					<div id="poststuff"><div id="post-body"><div id="post-body-content"><div id="<?php echo $tempID; ?>" class="postarea">
					<?php echo the_editor(stripslashes($defaultValue),$value['id'],'', true); ?>
					</div></div></div></div>
			<?php
				break;
			}
			if ( $value['type'] <> "heading" &&  $value['type'] != "subsection" &&  $value['type'] != "editor") {
			?>
				<br/><span><?php echo $value['desc']; ?></span>
				</td></tr>
			<?php
			}
		}?>
		</table></div></div>
		<div id="tabs-6">
			<div>
				<div class="ui-widget">

					<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
						<p>
							<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
							<strong>Version Info:</strong>

							<br/>
							Origami for WPcommerce 1.0 - Released 10/20/2011
							<br/>
							<br/>
							<a href="<?php bloginfo('template_url'); ?>/documentation/Origami_for_WordPress.pdf" class="uibutton">Documentation</a>&nbsp;&nbsp;<a href="http://themeforest.net/user/goThemeTeam" class="uibutton">View Portfolio</a>
						</p>
					</div>

				</div>
			</div>
		</div>

	</div>

	<div style="clear:both;height:20px;"></div>

	</form>



</div>
<?php
}

add_filter('admin_head','tt_admin_tinymce');
add_action('admin_menu', 'themeteam_add_admin');
?>
