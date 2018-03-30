<?php
function csthemes_admin_head() { ?>
<style>
h2 { margin-bottom: 20px; }
.title { margin: 0px !important; background: #D4E9FA; padding: 10px; font-family: Georgia, serif; font-weight: normal !important; letter-spacing: 1px; font-size: 18px; }
.container { background: #EAF3FA; padding: 10px; }
.maintable { font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; background: #EAF3FA; margin-bottom: 20px; padding: 10px 0px; }
.mainrow { padding-bottom: 10px !important; border-bottom: 1px solid #D4E9FA !important; float: left; margin: 0px 10px 10px 10px !important; }
.titledesc { font-size: 14px; font-weight:bold; width: 220px !important; margin-right: 20px !important; }
.forminp { width: 700px !important; valign: middle !important; }
.forminp input, .forminp select, .forminp textarea { margin-bottom: 9px !important; background: #fff; border: 1px solid #D4E9FA; width: 500px; padding: 4px; font-family:"Lucida Grande","Lucida Sans Unicode",Arial,Verdana,sans-serif; font-size: 12px; }
.forminp span { font-size: 10px !important; font-weight: normal !important; ine-height: 14px !important; }
.info { background: #FFFFCC; border: 1px dotted #D8D2A9; padding: 10px; color: #333; }
.forminp .checkbox { width:20px }
.info a { color: #333; text-decoration: none; border-bottom: 1px dotted #333 }
.info a:hover { color: #666; border-bottom: 1px dotted #666; }
.warning { background: #FFEBE8; border: 1px dotted #CC0000; padding: 10px; color: #333; font-weight: bold; }
</style>
<?php }
 
 // VARIABLES
 
$themename = "Cleano Studios";
$shortname = "cs";
$options = array();
$template_path = get_bloginfo('template_directory');
$cs_categories_obj = get_categories('hide_empty=0');
$cs_categories = array();
$cs_pages_obj = get_pages('sort_column=post_parent,menu_order');
$cs_pages = array();
foreach ($cs_categories_obj as $cs_cat) {
	$cs_categories[$cs_cat->cat_ID] = $cs_cat->cat_name;
}
foreach ($cs_pages_obj as $cs_page) {
	$cs_pages[$cs_page->ID] = $cs_page->post_title;
}
$cs_blog = array("Excerpt","Full Content");
$cs_styles = array("blue","red","green","yellow");
$nums = array("Select a number:","1","2","3","4","5","6","7","8","9","10");
$nums1 = array("Select a number:","10","20","30","40","50","60","70","80","90","100");
$categories_tmp = array_unshift($cs_categories, "Select a category:");
$cs_pages_tmp = array_unshift($cs_pages, "Select a page:");


// THIS IS THE DIFFERENT FIELDS

$options[] = array(	"name" => "General Settings",
					"type" => "heading");
$options[] = array(	"name" => "Color Scheme",
					"desc" => "Select one of the 4 colors supported.",
					"id" => $shortname."_style",
					"std" => "blue",
					"type" => "select",
					"options" => $cs_styles);
$options[] = array(	"name" => "Custom Logo",
					"desc" => "Paste the full URL of your custom logo image, should you wish to replace our default logo.",
					"id" => $shortname."_logo",
					"std" => "",
					"type" => "text");
$options[] = array(	"name" => "Custom Favicon",
					"desc" => "Paste the full URL of your custom favicon, should you wish to replace our default favicon.",
					"id" => $shortname."_favicon",
					"std" => "",
					"type" => "text");		

$options[] = array(	"name" => "Basic SEO",
					"type" => "heading");
$options[] = array(	"name" => "Keywords",
					"desc" => "Some keywords that describe your website, seperated by a coma (<strong>,</strong>).",
					"id" => $shortname."_seo_keywords",
					"std" => "",
					"type" => "text");	
$options[] = array(	"name" => "Description",
					"desc" => "A schort description of your website.",
					"id" => $shortname."_seo_desc",
					"std" => "",
					"type" => "textarea");	
					
$options[] = array(	"name" => "Frontpage Settings",
					"type" => "heading");					
$options[] = array(	"name" => "Welcome Header",
					"desc" => "The text that will act as header for the text left of the slider.",
					"id" => $shortname."_welcome_h1",
					"std" => "",
					"type" => "text");
$options[] = array(	"name" => "Welcome Text",
					"desc" => "The text that will act as header for the text left of the slider.",
					"id" => $shortname."_welcome_text",
					"std" => "",
					"type" => "textarea");	
					
$options[] = array(	"name" => "Image Box 1 - Image",
					"desc" => "The URL of the image that you wish to put on the left under the slider block. Size: 294x100",
					"id" => $shortname."_imgbox_left_img",
					"std" => "",
					"type" => "text");	
$options[] = array(	"name" => "Image Box 1 - URL",
					"desc" => "The destination of the image that you wish to put on the left under the slider block.",
					"id" => $shortname."_imgbox_left_url",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Image Box 2 - Image",
					"desc" => "The URL of the image that you wish to put in the center under the slider block. Size: 294x100",
					"id" => $shortname."_imgbox_center_img",
					"std" => "",
					"type" => "text");	
$options[] = array(	"name" => "Image Box 2 - URL",
					"desc" => "The destination of the image that you wish to put in the center under the slider block.",
					"id" => $shortname."_imgbox_center_url",
					"std" => "",
					"type" => "text");	

$options[] = array(	"name" => "Image Box 3 - Image",
					"desc" => "The URL of the image that you wish to put on the right under the slider block. Size: 294x100",
					"id" => $shortname."_imgbox_right_img",
					"std" => "",
					"type" => "text");	
$options[] = array(	"name" => "Image Box 3 - URL",
					"desc" => "The destination of the image that you wish to put on the right under the slider block.",
					"id" => $shortname."_imgbox_right_url",
					"std" => "",
					"type" => "text");						
					
$options[] = array(	"name" => "Portfolio Settings",
					"type" => "heading");					
$options[] = array(	"name" => "Category",
					"desc" => "Please select your portfolio category.",
					"id" => $shortname."_portfolio",
					"std" => "Select a category:",
					"type" => "select",
					"options" => $cs_categories);
$options[] = array(	"name" => "Slider Count",
					"desc" => "Number of items on the frontpage slider.",
					"id" => $shortname."_portfolio_slider",
					"std" => "Select a number:",
					"type" => "select",
					"options" => $nums);
$options[] = array(	"name" => "Page Items",
					"desc" => "Number of items to show on portfolio page.",
					"id" => $shortname."_portfolio_count",
					"std" => "Select a number:",
					"type" => "select",
					"options" => $nums1);
$options[] = array(	"name" => "Header Text",
					"desc" => "The text that will appear as the header of the portfolio page.",
					"id" => $shortname."_portfolio_header",
					"std" => "",
					"type" => "text");	
					
$options[] = array(	"name" => "Blog Settings",
					"type" => "heading");					
$options[] = array(	"name" => "Text length",
					"desc" => "Select either \"excerpt\" for a short text or \"full content\" to control the length your self.",
					"id" => $shortname."_blog_content",
					"std" => "Excerpt",
					"type" => "select",
					"options" => $cs_blog);
$options[] = array(	"name" => "Header Text",
					"desc" => "The text that will appear as the header of the blog page.",
					"id" => $shortname."_blog_header",
					"std" => "",
					"type" => "text");
					
// ADMIN PANEL

function csthemes_add_admin() {

	 global $themename, $options;
	
	if ( $_GET['page'] == basename(__FILE__) ) {	
        if ( 'save' == $_REQUEST['action'] ) {
	
                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	update_option( $value['id'], $_REQUEST[ $value['id'] ] ); 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;
							update_option($up_opt, $_REQUEST[$up_opt] );
						}
					}
				}

                foreach ($options as $value) {
					if($value['type'] != 'multicheck'){
                    	if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } 
					}else{
						foreach($value['options'] as $mc_key => $mc_value){
							$up_opt = $value['id'].'_'.$mc_key;						
							if( isset( $_REQUEST[ $up_opt ] ) ) { update_option( $up_opt, $_REQUEST[ $up_opt ]  ); } else { delete_option( $up_opt ); } 
						}
					}
				}
						
				header("Location: admin.php?page=theme-options.php&saved=true");								
			
			die;

		} else if ( 'reset' == $_REQUEST['action'] ) {
			delete_option('sandbox_logo');
			
			header("Location: admin.php?page=theme-options.php&reset=true");
			die;
		}

	}
add_menu_page($themename." Options", $themename." Options", 'edit_themes', basename(__FILE__), 'csthemes_page');
}

function csthemes_page (){

		global $options, $themename, $manualurl;
		
		?>

<div class="wrap">

    			<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">

						<h2><?php echo $themename; ?> Options</h2>

						<?php if ( $_REQUEST['saved'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been updated!</div><?php } ?>
						<?php if ( $_REQUEST['reset'] ) { ?><div style="clear:both;height:20px;"></div><div class="warning"><?php echo $themename; ?>'s Options has been reset!</div><?php } ?>							
						
						<!--START: GENERAL SETTINGS-->
     						
     						<table class="maintable">
     							
							<?php foreach ($options as $value) { ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<tr class="mainrow">
										<td class="titledesc"><?php echo $value['name']; ?></td>
										<td class="forminp">
		
									<?php } ?>		 
	
									<?php
										
										switch ( $value['type'] ) {
										case 'text':
		
									?>
									
		        							<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings($value['id']); } else { echo $value['std']; } ?>" />
		
									<?php
										
										break;
										case 'select':
		
									?>
		
	            						<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
	                					<?php foreach ($value['options'] as $option) { ?>
	                						<option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option>
	                					<?php } ?>
	            						</select>
		
									<?php
		
										break;
										case 'textarea':
										$ta_options = $value['options'];
		
									?>
									
										<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="<?php echo $ta_options['cols']; ?>" rows="8"><?php  if( get_settings($value['id']) != "") { echo stripslashes(get_settings($value['id'])); } else { echo $value['std']; } ?></textarea>
		
									<?php
										
										break;
										case "radio":
		
 										foreach ($value['options'] as $key=>$option) { 
				
													$radio_setting = get_settings($value['id']);
													
													if($radio_setting != '') {
		    											
		    											if ($key == get_settings($value['id']) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
													
													} else {
													
														if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									} ?>
									
	            					<input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> /><?php echo $option; ?><br />
		
									<?php }
		 
										break;
										case "checkbox":
										
										if(get_settings($value['id'])) { $checked = "checked=\"checked\""; } else { $checked = ""; }
									
									?>
		            				
		            				<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
		
									<?php
		
										break;
										case "multicheck":
		
 										foreach ($value['options'] as $key=>$option) {
 										
	 											$cs_key = $value['id'] . '_' . $key;
												$checkbox_setting = get_settings($cs_key);
				
 												if($checkbox_setting != '') {
		    		
		    											if (get_settings($cs_key) ) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
												} else { if($key == $value['std']) { $checked = "checked=\"checked\""; } else { $checked = ""; }
				
									} ?>
									
	            					<input type="checkbox" class="checkbox" name="<?php echo $cs_key; ?>" id="<?php echo $cs_key; ?>" value="true" <?php echo $checked; ?> /><label for="<?php echo $cs_key; ?>"><?php echo $option; ?></label><br />
									
									<?php }
		 
										break;
										case "heading":

									?>
									
										</table> 
		    							
		    									<h3 class="title"><?php echo $value['name']; ?></h3>
										
										<table class="maintable">
		
									<?php
										
										break;
										default:
										break;
									
									} ?>
	
									<?php if ( $value['type'] <> "heading" ) { ?>
	
										<?php if ( $value['type'] <> "checkbox" ) { ?><br/><?php } ?><span><?php echo $value['desc']; ?></span>
										</td></tr>
	
									<?php } ?>		
	
							<?php } ?>	
							
							</table>	

							<p class="submit">
								<input name="save" type="submit" value="Save changes" />    
								<input type="hidden" name="action" value="save" />
							</p>							
							
							<div style="clear:both;"></div>		
						
						<!--END: GENERAL SETTINGS-->						
             
            </form>

</div><!--wrap-->

<div style="clear:both;height:20px;"></div>
 
 <?php

};

$theme_metaboxes = array(
		"thumb-small" => array (
			"name"		=> "thumb-small",
			"default" 	=> "",
			"label" 	=> "Small Preview Image URL",
			"type" 		=> "text",
			"desc"      => "Upload your image with 'Add Media' above post window, copy the url and paste it here. Max height and width should be: 304x225 pixels"
		),
		"thumb-large" => array (
			"name"		=> "thumb-large",
			"default" 	=> "",
			"label" 	=> "Large Preview Image URL",
			"type" 		=> "text",
			"desc"      => "Upload your image with 'Add Media' above post window, copy the url and paste it here. Max height and width should be: 500x193 pixels"
		),
	);
	
function cstheme_meta_box_content() {
	global $post, $theme_metaboxes;
	foreach ($theme_metaboxes as $theme_metabox) {
		$theme_metaboxvalue = get_post_meta($post->ID,$theme_metabox["name"],true);
		if ($theme_metaboxvalue == "" || !isset($theme_metaboxvalue)) {
			$theme_metaboxvalue = $theme_metabox['default'];
		}
		

		echo "\t".'<p>';
		echo "\t\t".'<label for="'.$theme_metabox['name'].'" style="font-weight:bold; ">'.$theme_metabox['label'].':</label>'."\n";
		echo "\t\t".'<input style="width:99%" type="'.$theme_metabox['type'].'" value="'.$theme_metaboxvalue.'" name="'.$theme_metabox["name"].'" id="'.$theme_metabox['name'].'"/><br/>'."\n";
		echo "\t\t".$theme_metabox['desc'].'</p>'."\n";				
	}
}

function cstheme_metabox_insert($pID) {
	global $theme_metaboxes;
	foreach ($theme_metaboxes as $theme_metabox) {
		$var = $theme_metabox["name"];
		if (isset($_POST[$var])) {			
			if( get_post_meta( $pID, $theme_metabox["name"] ) == "" )
				add_post_meta($pID, $theme_metabox["name"], $_POST[$var], true );
			elseif($_POST[$var] != get_post_meta($pID, $theme_metabox["name"], true))
				update_post_meta($pID, $theme_metabox["name"], $_POST[$var]);
			elseif($_POST[$var] == "")
				delete_post_meta($pID, $theme_metabox["name"], get_post_meta($pID, $theme_metabox["name"], true));
		}
	}
}

function cstheme_meta_box() {
	if ( function_exists('add_meta_box') ) {
		add_meta_box('theme-settings','Coffee Junkie Custom Settings','cstheme_meta_box_content','post','normal','high');
	}
}

add_action('admin_menu', 'cstheme_meta_box');
add_action('wp_insert_post', 'cstheme_metabox_insert');
add_action('admin_menu', 'csthemes_add_admin');
add_action('admin_head', 'csthemes_admin_head');	

?>