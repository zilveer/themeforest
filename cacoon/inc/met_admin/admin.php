<?php
ob_start();

if(isset($_GET['go']) AND $_GET['go']=='customizer'){
	header("Location:customize.php");
}

/* ----------------------------------------------------------
Declare vars
------------------------------------------------------------- */
$themename = "Cacoon";
$shortname = "met";

/* ----------------------------------------------------------
Do the job with ajax and leave the page [Mainly for removing list items]
------------------------------------------------------------- */
if(isset($_GET["subPage"]) AND $_GET["subPage"] == 'ajax'){
	require_once "ajax_request.php";
	exit;
}

$categories = get_categories('hide_empty=0&orderby=name');
$all_cats = array();
foreach ($categories as $category_item ) {
	$all_cats[$category_item->cat_ID] = $category_item->cat_name;
}
array_unshift($all_cats, "Select a category");

// Background Patterns
for($i = 1; $i <= 28; $i++):
	$bgPatterns[] = get_template_directory_uri().'/img/bgpatterns/bgimage'.$i.'.jpg';
endfor;
/*
function google_font_initialize(){
	$theBody = wp_remote_get('https://www.googleapis.com/webfonts/v1/webfonts?key='.base64_decode('QUl6YVN5QV9QNlVfWDU2RWUwck5JMkNxSExqdmdfSndGbkZJTk5V'),array('sslverify' => false));
	if(!isset($theBody->errors)){
		return $theBody['body'];
	}else{
		return false;
	}
}
*/
function met_get_option($key, $default=''){
	$search = get_option('met_options');

	foreach($search as $optionSection => $sectionOptions){
		foreach($sectionOptions as $sectionOptionItemKEY => $sectionOptionItemVAL){
			$allOptions[$sectionOptionItemKEY] = $sectionOptionItemVAL;
		}
	}

	if(array_key_exists($key,$allOptions) AND !empty($allOptions[$key])){
		$returnData = $allOptions[$key];
	}else{
		$returnData = $default;
	}

	return $returnData;
}


/*---------------------------------------------------
register settings
----------------------------------------------------*/
function theme_settings_init(){
	register_setting( 'theme_settings', 'theme_settings' );
	wp_enqueue_style("bootstrapstyle", get_template_directory_uri()."/inc/met_admin/css/bootstrap.css", false, false, "all");
	wp_enqueue_style("panelcustom", get_template_directory_uri()."/inc/met_admin/css/custom.css", false, "1.0", "all");

	wp_enqueue_script("jquery");
	wp_enqueue_script("bootstrap", get_template_directory_uri()."/inc/met_admin/js/bootstrap.js", false, "1.0");
	wp_enqueue_script("admincustom", get_template_directory_uri()."/inc/met_admin/js/custom.js", false, "1.0");

	wp_enqueue_media();
}
function my_admin_scripts() {
	/* Media Library Setup */
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}
function mw_enqueue_color_picker() {
	// first check that $hook_suffix is appropriate for your admin page
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'my-script-handle', get_template_directory_uri()."/inc/met_admin/js/custom.js", array( 'wp-color-picker' ), false, true );
}
if (isset($_GET['subPage'])) {
	add_action('admin_print_scripts', 'my_admin_scripts');
	add_action('admin_print_styles', 'my_admin_styles');
	add_action( 'admin_enqueue_scripts', 'mw_enqueue_color_picker' );
}

/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function add_settings_page() {
	add_menu_page( __( 'Theme Options','metcreative' ), __( 'Background','metcreative' ), 'manage_options', 'settings', 'theme_settings_page');
	add_theme_page( 'Background', 'Background', 'manage_options', 'admin.php?page=settings&subPage=background' );
}

/*---------------------------------------------------
add actions
----------------------------------------------------*/
if(!isset($_GET["subPage"])){
	$_GET["subPage"] = 'background';
}
if(isset($_GET['page']) AND $_GET['page']=='settings'){
	add_action( 'admin_init', 'theme_settings_init' );
}

add_action( 'admin_menu', 'add_settings_page' );

/* ---------------------------------------------------------
Google Fonts
-----------------------------------------------------------
$google_fonts = get_option('met_google_fonts');
if(empty($google_fonts)){
	$google_fonts = google_font_initialize();
	if($google_fonts){
		update_option('met_google_fonts',$google_fonts);
	}

}else{
	$google_fonts = get_option('met_google_fonts');
}
$google_fonts = json_decode($google_fonts,true);

if($google_fonts["items"]){
	foreach($google_fonts["items"] as $v){
		$google_fonts_names[] = $v['family'];
	}
}

$google_fonts_names[] = 'Verdana';
$google_fonts_names[] = 'Arial';
$google_fonts_names[] = 'Tahoma';

for($fs = 7; $fs <= 70; $fs++):
	$font_sizes[] = $fs.'px';
endfor;

$font_weights = array('Normal','Bold','Italic');
*/

/* ---------------------------------------------------------
Get options
----------------------------------------------------------- */
$met_options = get_option('met_options');

/* ---------------------------------------------------------
Declare options
----------------------------------------------------------- */
require_once "theme_options.inc";


/* ---------------------------------------------------------
Categories
----------------------------------------------------------- */
$admin_cats = array(
	'background' 	=> array(
		'pageID'	=> 'background',
		'icon' 		=> 'icon-picture',
		'title' 	=> 'Layout & Background'
	),
	'sidebar' 		=> array(
		'pageID'	=> 'sidebar',
		'icon' 		=> 'icon-tasks',
		'title' 	=> 'Sidebar Management'
	),
);



/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/
function theme_settings_page() {
	global $themename,$theme_options,$shortname,$admin_cats;
	$i=0;
	$message = '';
	$the_options = get_option('met_options');
	if(isset($_REQUEST['action'])){
		if ( 'save' == $_REQUEST['action'] ) {

			/*if(!isset($the_options[$_GET["subPage"]])) $the_options[$_GET["subPage"]] = array();
			if(!isset($theme_options[$_GET["subPage"]])) $theme_options[$_GET["subPage"]] = array();*/

			//print_r($_POST);

			if(!isset($_POST[$shortname.'_install'])){
				foreach($_POST as $k => $v){
					//unset($the_options[$_GET["subPage"]][$k]);
					$the_options[$_GET["subPage"]][$k] = $v;
					//$theme_options[$_GET["subPage"]][$k]['selected'] = $v;
				}
				update_option($shortname.'_options',$the_options);
			}else{
				$new_opts = stripslashes($_POST[$shortname.'_install']);
				//$new_opts = unserialize($new_opts);
				update_option($shortname.'_options',$new_opts);
			}

			header('Location:'.$_SERVER['PHP_SELF'].'?'.str_replace('&action=save','',$_SERVER['QUERY_STRING']).'&met_opts_saving=saved');
		}
	}
?>

<div class="admin-container container-fluid" style="margin-right: 20px">


    <div id="wrapper">

        <div id="content">
            <div class="row-fluid">
                <div class="span12">
					<?php
						if(isset($_GET["subPage"])):
					?>
                    <div class="row-fluid">
                        <div class="span12">
						<?php if(isset($_GET["met_opts_saving"])): ?>
							<div class="alert alert-success">Successfuly Saved The Options!</div>
							<?php unset($_GET["met_opts_saving"]); ?>
						<?php endif; ?>

						<?php if(!function_exists('curl_init') AND $_GET['subPage'] == 'styling'): ?>
							<div class="alert alert-info">Your server does not support cURL extension, google font support disabled!</div>
						<?php endif; ?>

                            <form class="widgetbox" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"].'?'.str_replace('&action=save','',$_SERVER["QUERY_STRING"]); ?>&action=save">
                                <div class="title">
									<strong><i class="<?php echo $admin_cats[$_GET["subPage"]]["icon"]; ?> icon-white"></i></strong>
									<h2 class="tabbed"><?php echo $admin_cats[$_GET["subPage"]]["title"]; ?></span></h2>
									<input type="submit" class="btn pull-right" value="Save Settings">
								</div>
                                <div class="widgetcontent">

									<div class="form-horizontal">
										<?php
											$theme_options[$_GET["subPage"]];
											foreach($theme_options[$_GET["subPage"]] as $value):
										?>
												<div class="control-group metadmin">
													<label class="control-label" <?php echo !isset($value["desc"]) || empty($value["desc"]) ? 'style="margin-bottom: 15px"' : '' ?>><b><?php echo $value["name"]; ?></b><br><small><?php echo $value["desc"]; ?></small></label>
													<div class="controls">
														<?php
															$value["type"] = isset($value["type"]) ? $value["type"] : '';
															switch($value["type"]):
																case 'radio':
																	if(is_array($value['value'])):
																		foreach($value['value'] as $k => $radio):
																			$checkedText	= $radio == $value['selected'] ? 'checked=""' : '';
																			$btnColor 		= $checkedText != '' ? 'btn-primary' : '';
																			$alignment 		= (($k == 0) ? '-prepend' : (($k == (count($value['value'])-1)) ? '-append' : ''));
																			$alignment		= isset($value["itemDesc"][$k]) ? ' radio-left' : $alignment;
																			$isPattern		= isset($value["subtype"]) && $value["subtype"] == 'image-list' ? 'pattern-item' : '';
																			$useImgTags		= isset($value["imgtags"]) && $value["imgtags"] == 'yes' ? 'yes' : '';
														?>
																			<div class="input<?php echo $alignment.' '.$isPattern; ?>">
																				<?php if(isset($value['subtype']) && $value['subtype']=='image-list'){ ?>
																					<label class="btn <?php echo $btnColor; ?>">
																						<?php if($useImgTags != 'yes'): ?>
																							<?php echo '<div class="pattern-desk" style="background-image: url('.$radio.')"></div>' ?>
																						<?php else: ?>
																							<?php echo '<div class="pattern-desk" style="width: auto; height: auto;"><img src="'.$radio.'" alt="" /></div>' ?>
																						<?php endif; ?>
																						<input type="radio" name="<?php echo $value["id"]; ?>" value="<?php echo $radio; ?>" <?php echo $checkedText; ?>>
																					</label>
																				<?php }else{ ?>
																					<?php if(!isset($value['itemDesc'])){ ?>
																						<label class="btn <?php echo $btnColor; ?>">
																							<?php echo $radio ?>
																							<input type="radio" name="<?php echo $value["id"]; ?>" value="<?php echo $radio; ?>" <?php echo $checkedText; ?>>
																						</label>
																					<?php }else{ ?>
																							<input type="radio" name="<?php echo $value["id"]; ?>" id="<?php echo $value["id"]; ?>_<?php echo $value["itemDesc"][$k]; ?>" <?php echo (($value["selected"] == '' && $value["itemDesc"][$k] == $value["defaults"]) ? 'checked=""' : (($value["itemDesc"][$k] == $value["selected"]) ? 'checked=""' : '')); ?> value="<?php echo $value["itemDesc"][$k]; ?>">
																							<label class="btn <?php echo $value["itemDesc"][$k]; ?>" for="<?php echo $value["id"]; ?>_<?php echo $value["itemDesc"][$k]; ?>"><?php echo $radio == '' ? 'Default' : $radio ?></label>
																					<?php } ?>
																				<?php } ?>
																			</div>
														<?php
																		endforeach; // Values of Array of Radio Choices
																	endif; // Is it array
																break; // Radio Case Ends
															case 'filelibrary':
																?>
																<div class="input">
																	<input type="text" value="<?php echo $value["selected"]; ?>" id="<?php echo $value["id"]; ?>" name="<?php echo $value["id"]; ?>"/>
																	<div class="uploader" id="uploader_<?php echo $value["id"]; ?>">
																		<input type="button" class="button" name="<?php echo $value["id"]; ?>_button" id="<?php echo $value["id"]; ?>_button" value="<?php echo $value['value']; ?>" />
																		<button class="btn btn-mini btn-danger clear_image<?php echo ($value["selected"]) != '' ? ' show_button' : '' ; ?>">Clear File</button>
																	</div>

																</div>
																<?php
															break; // Imagelibrary Case Ends
																case 'imagelibrary':
														?>
																	<div class="input">


																		<input type="hidden" value="<?php echo $value["selected"]; ?>" id="<?php echo $value["id"]; ?>" name="<?php echo $value["id"]; ?>"/>


																		<div class="uploader" id="uploader_<?php echo $value["id"]; ?>">
																			<?php echo $value["selected"] != '' ? '<img class="met_library_preview_image" id="uploader_media_preview_'.$value["id"].'" src="'.$value['selected'].'" alt=""/><br>' : '<img class="met_library_preview_image" id="uploader_media_preview_'.$value["id"].'" src="#" alt="" style="display: none" /><br>'; ?>

																			<input type="hidden" value="<?php echo $value["selected"]; ?>" name="<?php echo $value["id"]; ?>" id="_<?php echo $value["id"]; ?>" />
																			<input type="button" class="button" name="_<?php echo $value["id"]; ?>_button" id="_<?php echo $value["id"]; ?>_button" value="<?php echo $value['value']; ?>" />
																			<button class="btn btn-mini btn-danger clear_image<?php echo ($value["selected"]) != '' ? ' show_button' : '' ; ?>">Clear Image</button>
																		</div>

																	</div>
														<?php
																break; // Imagelibrary Case Ends
																case 'textarea':
														?>
																	<div class="input">
																		<textarea name="<?php echo $value["id"]; ?>" placeholder="<?php echo $value["value"]; ?>"><?php echo $value["selected"]; ?></textarea>
																	</div>
														<?php
																break; // textarea Case Ends
																case 'text':
														?>
																	<div class="input">
																		<input class="in-text" type="text" name="<?php echo $value["id"]; ?>" placeholder="<?php echo $value["value"]; ?>" value="<?php echo $value["selected"]; ?>"/>
																	</div>
														<?php
																break; // text Case Ends
																case 'checkbox':
														?>
																	<div class="input">
																		<label>
																			<?php echo $value["value"]; ?>
																			<input class="cbox" type="checkbox" name="<?php echo $value["id"]; ?>" value="1" <?php echo $value["selected"] == '1' ? 'checked=""' : ''; ?>/>
																		</label>
																	</div>
														<?php
																break; // checkbox Case Ends
																case 'listitems':
														?>
																	<div class="input">
																		<?php $k = 'none'; ?>
																		<?php if(!empty($value["selected"])): ?>
																			<?php foreach($value["selected"] as $k => $v): ?>
																				<div class="listline">
																					<?php foreach($value["types"] as $key => $val): ?>
																						<?php if($val == 'text'){ ?>
																							<input data-original-number="<?php echo $k; ?>" class="in-text" type="text" placeholder="<?php echo $value["value"][$key]; ?>" name="<?php echo $value["id"].'['.$k.']'.'['.$value["keys"][$key].']'; ?>" value="<?php echo $v[$value["keys"][$key]]; ?>" />
																						<?php }elseif($val == 'dropdown'){ ?>
																							<select data-original-number="<?php echo $k; ?>" class="in-text" name="<?php echo $value["id"].'['.$k.']'.'['.$value["keys"][$key].']'; ?>">
																								<option value=""></option>
																								<?php foreach($value["values"][$key] as $defaultVal): ?>
																									<option <?php if($defaultVal == $v[$value["keys"][$key]]){ echo 'selected=""';} ?>><?php echo $defaultVal; ?></option>
																								<?php endforeach; ?>
																							</select>
																						<?php } ?>
																						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																					<?php endforeach; ?>
																					<i class="icon-minus delete-list-item" data-toggle="tooltip" title="WARNING!This will be deleted from database as you click!" onclick="deleteListItem(jQuery(this));"></i>
																				</div>
																			<?php endforeach; ?>
																		<?php endif; ?>
																		<div class="listline">
																			<?php if(is_numeric($k)){$k++;}else{$k=0;} ?>
																			<?php foreach($value["types"] as $key => $val): ?>
																				<?php if($val == 'text'){ ?>
																					<input data-original-number="<?php echo $k; ?>" class="in-text" type="text" placeholder="<?php echo $value["value"][$key]; ?>" name="<?php echo $value["id"]; ?>[<?php echo $k; ?>][<?php echo $value["keys"][$key]; ?>]" />
																				<?php }elseif($val == 'dropdown'){ ?>
																					<select data-original-number="<?php echo $k; ?>" class="in-text" name="<?php echo $value["id"].'['.$k.']'.'['.$value["keys"][$key].']'; ?>">
																						<option value=""></option>
																						<?php foreach($value["values"][$key] as $defaultVal): ?>
																							<option><?php echo $defaultVal; ?></option>
																						<?php endforeach; ?>
																					</select>
																				<?php } ?>
																				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																			<?php endforeach; ?>
																			<i class="icon-plus add-list-item" onclick="addListItem(jQuery(this));"></i>
																		</div>
																	</div>
														<?php
																break; // listitems Case Ends
																case 'colorpicker':
														?>
																	<div class="input">
																		<input type="text" name="<?php echo $value["id"]; ?>" value="<?php echo $value["selected"] == '' ? $value["defaults"] : $value["selected"]; ?>"  class="my-color-field" data-default-color="<?php echo isset($value["defaults"]) ? $value["defaults"] : '' ?>" />
																	</div>
														<?php
																break; // colorpicker Case Ends
																case 'select':
														?>
																	<div class="input">
																		<select name="<?php echo $value["id"]; ?>">
																			<?php if(!isset($value["value"]["gap"])): ?>
																				<?php foreach($value["value"] as $opt): ?>
																					<option <?php $value["selected"] == $opt ? 'selected=""' : '' ?>><?php echo $opt; ?></option>
																				<?php endforeach; ?>
																			<?php else: ?>
																				<?php for($g = $value["value"]["gap"][0]; $g <= $value["value"]["gap"][1]; $g++): ?>
																					<option <?php $value["selected"] == $g ? 'selected=""' : '' ?>><?php echo $g; ?></option>
																				<?php endfor; ?>
																			<?php endif; ?>
																		</select>
																	</div>
														<?php
																break; // select Case Ends
																case 'font':
																	/*$shortname.'_body_text_font' => array(
																	'name'		=> 'Body Text Font',
																	'id'		=> $shortname.'_body_text_font',
																	'type'		=> 'font',
																	'value'		=> '',
																	'selected'	=> isset($met_options['styling'][$shortname.'_body_text_font']) ? $met_options['styling'][$shortname.'_body_text_font'] : '',
																	'desc'		=> 'Body text font options',
																	'subtypes'	=> array('size','family','weight','color','line-height'),
																	'subValues'	=> array($font_sizes,$google_fonts_names,$font_weights,'',$font_sizes),
																	'defaults'	=> array('12px','Verdana','normal','#747779','18px')
																)*/
														?>
																	<div class="input">

																		<?php foreach($value["subtypes"] as $subtypeKey => $subtype): ?>

																			<label class="inline-label"> <?php echo ucwords($subtype).' : '; ?>

																				<?php if('color' != $subtype): ?>

																					<select class="auto_width_select" name="<?php echo $value["id"].'_'.$subtype; ?>">

																						<?php foreach($value["subValues"][$subtypeKey] as $opt): ?>

																							<option
																								<?php
																								//echo $the_options[$_GET["subPage"]][$value["id"].'_'.$subtype].'<br><br>';
																								if(isset($the_options[$_GET["subPage"]][$value["id"].'_'.$subtype]) && $the_options[$_GET["subPage"]][$value["id"].'_'.$subtype] == $opt){
																									echo 'selected=""';
																									$already = 1;
																								}elseif($opt == $value["defaults"][$subtypeKey] AND !isset($already)){
																									echo 'selected=""';
																								}
																								?>>
																								<?php echo $opt; ?></option>

																						<?php endforeach; ?>

																					</select>

																				<?php else: ?>

																					<input type="text" name="<?php echo $value["id"].'_'.$subtype; ?>" value="<?php echo (!isset($the_options[$_GET["subPage"]][$value["id"].'_'.$subtype]) ? $value["defaults"][$subtypeKey] : $the_options[$_GET["subPage"]][$value["id"].'_'.$subtype]); ?>" class="my-color-field" />

																				<?php endif; ?>

																			</label>

																		<?php endforeach; ?>

																	</div>
														<?php
																break; // font Case Ends
															endswitch; // Switching for Type
														?>
													</div>
												</div>
										<?php
											endforeach; // This categoires keys&vals
										?>

									</div>
									<input type="submit" class="btn btn-inverse pull-right" value="<?php _e('Save Settings','metcreative'); ?>">
									<div class="clear"></div>
                                </div>
                            </form>
                        </div>
                    </div>

					<?php
						endif; // subPage Existance Control Ends
					?>
                </div>
            </div>
        </div>

    </div>
</div>
    <?php
}

?>