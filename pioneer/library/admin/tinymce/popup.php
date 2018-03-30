<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__('You are not allowed to be here','epic'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Epic shortcodes</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/library/admin/tinymce/tinymce.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/library/admin/js/jquery.js"></script>
<script language="javascript" type="text/javascript">
jQuery(document).ready(function($){

		$('#self_hosted_meta').hide();
		$('#external_hosted_meta').hide();

		tabPanel();
		
		$('#video_type').change(function(){
		
			if( $(this).attr('value') == 'vimeo'){
					$('#external_hosted_meta').show();
					$('#self_hosted_meta').hide();
			}
			
			if( $(this).attr('value') == 'youtube'){
					$('#external_hosted_meta').show();
					$('#self_hosted_meta').hide();
			}
			
			else if( $(this).attr('value') == 'self'){
					$('#self_hosted_meta').show();
					$('#external_hosted_meta').hide();
			}
		
		});
		
	
		
});

// TAB PANEL
function tabPanel(){
	
		//Default Action
			jQuery(".tabcontent").hide(); //Hide all content
			jQuery(" #epic_tabnav > li:first").addClass("current-menu-item").show(); //Activate first tab
			jQuery(".tabcontent:first").show(); //Show first tab content
			
			
			//On Click Event
			jQuery("#epic_tabnav > li").click(function() {
				jQuery("#epic_tabnav > li").removeClass("current-menu-item"); //Remove any "active" class
				jQuery(this).addClass("current-menu-item"); //Add "active" class to selected tab
				jQuery(".tabcontent").hide(); //Hide all content
				var activeTab = jQuery(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
				jQuery(activeTab).show(); //Fade in the active content
				return false;
			});
			
			return false;
	}	
	
	
</script>
<style type="text/css">
fieldset { margin:16px 0; padding:10px; }
legend, label, select, input[type=text] { font-size:11px; }
select {line-height:24px; color:#777;}
input[type=text] { ine-height:24px; height:24px; float:left; width:100%; color:#777;}
#epic_tabnav{margin:0; padding: 0; list-style: none; margin:10px 0 0 0;}
#epic_tabnav li{display: inline; float: left; margin:0px -1px 0 0; position: relative; z-index:1;}
#epic_tabnav li a{display: inline;  padding:0 10px; float:left; line-height:24px; text-decoration: none;}
#epic_tabnav li.current-menu-item a{
background: #fff;   border:1px solid #ccc; border-bottom:1px solid #fff;
border-radius:4px 4px 0 0;
-moz-border-radius: 4px 4px 0 0;
-webkit-border-radius: 4px 4px 0 0;
line-height:22px;

}
.tabcontent{padding:10px; background: #fff; border:1px solid #ccc; float: left; width:560px; margin:-1px 0 10px 0; position: relative; z-index:0;}
.tabcontent fieldset{margin:10px 0 10px 0;}

.tabcontent fieldset.floated{margin:10px 10px 10px 0; float:left; width:252px;}

.tabcontent select{width:100%; margin:0 0 4px 0;}
.tabcontent select.labeledSelect{width:240px;}
.tabcontent input[type=text]{margin:0 0 10px 0; background: #f9f9f9;}
.tabcontent label{margin:0 10px 0 0; width:160px;}

#epic_shortcodes input[type=submit]{float:right; padding:10px; width:auto; height:auto;}
#epic_shortcodes .last{margin-right:0;}
#epic_shortcodes textarea{width:100%; height:200px; background: #f9f9f9; color:#777;}
div.inputwrap{float:left; width:100%; clear: both; margin: 0 0 10px;}
</style>
</head>
<body onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="epic_shortcodes" action="#" id="epic_shortcodes">

			<ul id="epic_tabnav">
				
				<li><a href="#tab0">Buttons</a></li>
				<li><a href="#tab3">Columns</a></li>
				<!--<li><a href="#tab2">Gallery</a></li>-->
				<li><a href="#tab4">Video</a></li>
				<li><a href="#tab6">Dropcaps</a></li>
				<li><a href="#tab7">Quotes</a></li>
				<li><a href="#tab8">Boxes</a></li>
				<li><a href="#tab1">Forms</a></li>
				<li><a href="#tab12">Tabs and toggles</a></li>
				
				
			</ul>
			
			
			<div class="tabcontent" id="tab0">
				
				<fieldset>
						<legend><?php _e('Button text','epic');?></legend>
						<input type="text" value="" name="button_text" id="button_text"/>
				
				</fieldset>
				<fieldset>
						<legend><?php _e('Button link','epic');?></legend>
						
						
						<div class="inputwrap">
						
						<select id="button_page_link" name="button_page_link">
									<option value="0">Select page</option>
									<?php
																		
									$pages = get_pages();
									$epic_getpages = array();
									foreach ($pages as $page_list ) {
      								 $epic_getpages[$page_list ->ID] = $page_list ->post_title;
		 							echo ' <option value="'.$page_list ->ID.'">'.$page_list ->post_title.'</option>';
									}?>
						</select>
						<label>Link to page</label>
						</div>
						
						<div class="inputwrap">
						
						<input type="text" value="" name="button_link" id="button_link"/>
						<label>Custom link</label>
						</div>
						
						<div class="inputwrap">
						<input type="checkbox" id="button_target" name="button_target" value="external"/><label>Open link in new window</label>
						</div>
				
				</fieldset>
				
				<fieldset class="floated">
						<legend><?php _e('Button size','epic');?></legend>
							<select id="button_size" name="button_size">
									<option value="small">Small</option>
									<option value="medium">Medium</option>
									<option value="large">Large</option>
							</select>
						
				
				</fieldset>
						
				<fieldset class="floated last">
						<legend><?php _e('Button alignment','epic');?></legend>
							<select id="button_align" name="button_align">
									<option value="">None</option>
									<option value="left">Left</option>
									<option value="right">Right</option>
					
						</select>
				</fieldset>
				
				<fieldset class="floated">
						<legend><?php _e('Background color','epic');?></legend>
						<input type="text" value="" name="button_background_color" id="button_background_color"/>
				
				</fieldset>
				
				<fieldset class="floated last">
						<legend><?php _e('Border color','epic');?></legend>
						<input type="text" value="" name="button_border_color" id="button_border_color"/>
				
				</fieldset>
				
				<fieldset class="floated">
						<legend><?php _e('Text color','epic');?></legend>
						<input type="text" value="" name="button_text_color" id="button_text_color"/>
				
				</fieldset>
				
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
				<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertButtons();"/>
			</div>
		
			
			
			<div class="tabcontent" id="tab5">
			<fieldset>
						<legend><?php _e('Modules and elements','epic');?></legend>
						<select id="module_shortcode" name="module_shortcode">
									
									
									<optgroup label="Tabs and toggles">
									<option value="toggle">Toggle button</option>
									<option value="accordion">Accordion</option>
									<option value="toggle_list">Toggle button</option>
									<option value="tabs_default">Tab panel</option>
									</optgroup>
									
							
									
									
									<optgroup label="Misc. elements">
								
									<option value="break">Break - Clear</option>
									<option value="breakline">Line with link to pagetop</option>
									<option value="author">Post Author info-box</option>
									<option value="relatedposts">Related posts</option>
									</optgroup>
						</select>
			</fieldset>
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertModules();" style="float:right; padding:10px; width:auto; height:auto;"/>
			</div>
			
			
			<?php // Tabs and Toggles ?>
			<div class="tabcontent" id="tab12">
			<p>Enter the names for the tabs you want to appear in the tab panel. Separate entries with comma.</p>
			
			<fieldset>
						<legend>Types</legend>
						<select id="tab_type" name="tab_type">
									
									<option value="">Select type</option>
									<option value="tab" id="tab" name="contactform">Tab panel</option>
									<option value="accordion" 	id="accordion" 	name="loginform">Accordion toggle</option>
									<option value="toggle" 	id="toggle" name="registerform">Regular toggle</option>
								
						</select>			
			</fieldset>
			
			<fieldset>
						<legend>Tab panel </legend>
						<textarea id="tab_text" name="tab_text"></textarea>
			</fieldset>
						
			
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTabs();" />
					
			</div>
			
			
			<?php // Toggles ?>
			<div class="tabcontent" id="tab13">
			<p>Enter the names for the toggle-buttons you want to appear in the toggle list panel. Separate entries with comma.</p>
	
			<fieldset>
						<legend>Toggle panel </legend>
						<textarea id="toggles" name="toggles"></textarea>
			</fieldset>
						
			
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertToggles();" />
					
			</div>
			<?php // Forms ?>
			
			<div class="tabcontent" id="tab1">
			<fieldset>
						<legend>Forms</legend>
						<select id="form_shortcode" name="form_shortcode">
									
									<option value="">Select form</option>
									<option value="contact" id="contactform" 	name="contactform">Contactform</option>
									<option value="login" 	id="loginform" 		name="loginform">Login form</option>
									<option value="signup" 	id="registerform" 	name="registerform">User register form</option>
								
						</select>			
			</fieldset>
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertForm();" style="float:right; padding:10px; width:auto; height:auto;"/>
			</div>
			
			
			<div class="tabcontent" id="tab3">
			
			<p>Here you can insert column grids to format your page layout. Note that you need to use the options with the "last" ending on the last element in a row.</p>
			
			<fieldset>
					<legend>Column shortcode</legend>
						<select id="column_shortcode" name="column_shortcode" size="36">
									<optgroup label="Grid layouts">
									<option value="two_column_grid">Two column grid</option>
									<option value="three_column_grid">Three column grid</option>
									<option value="four_column_grid">Four column grid</option>
									<option value="five_column_grid">Five column grid</option>
									</optgroup>
									<optgroup label="Single columns">
									<option value="one_half">One half</option>
									<option value="one_half_last">One half - last</option>
									<option value="one_third">One third</option>
									<option value="one_third_last">One third - last</option>
									<option value="two_third">Two third</option>
									<option value="two_third_last">Two third - last</option>
									<option value="one_fourth">One fourth</option>
									<option value="one_fourth_last">One fourth - last</option>
									<option value="three_fourth">Three fourth</option>
									<option value="three_fourth_last">Three fourth - last</option>
									<option value="one_fifth">One fifth</option>
									<option value="one_fifth_last">One fifth - last</option>
									<option value="two_fifth">Two fifth</option>
									<option value="two_fifth_last">Two fifth - last</option>
									<option value="three_fifth">Three fifth</option>
									<option value="three_fifth_last">Three fifth - last</option>
									</optgroup>
									<optgroup label="3 columns mixed grids">
									<option value="onethird_twothird">One third / Two third</option>
									<option value="twothird_onethird">Two third / One third</option>
									</optgroup>
									<optgroup label="4 columns mixed grids">
									<option value="half_onefourth_onefourth">One half / One fourth / One fourth</option>
									<option value="onefourth_half_onefourth">One fourth / One half / One fourth</option>
									<option value="onefourth_onefourth_half">One fourth / One fourth / One half </option>
									<option value="onefourth_threefourth">One fourth / Three fourth </option>
									<option value="threefourth_onefourth">Three fourth / One fourth </option>
									</optgroup>
									<optgroup label="5 columns mixed grids">
									<option value="twofifth_threefifth">Two fifth / Three fifth  </option>
									<option value="threefifth_twofifth">Three fifth / Two fifth  </option>
									<option value="twofifth_onefifth_onefifth_onefifth">Two fifth / One fifth / One fifth / One fifth</option>
									<option value="onefifth_twofifth_onefifth_onefifth">One fifth / Two fifth / One fifth / One fifth</option>
									<option value="onefifth_onefifth_twofifth_onefifth">One fifth / One fifth / Two fifth / One fifth</option>
									<option value="onefifth_onefifth_onefifth_twofifth">One fifth / One fifth / One fifth / Two fifth</option>
									<option value="onefifth_twofifth_twofifth">One fifth / Two fifth / Two fifth </option>
									<option value="twofifth_onefifth_twofifth">Two fifth / One fifth / Two fifth </option>
									<option value="twofifth_twofifth_onefifth">Two fifth / Two fifth / One fifth </option>
									
									<option value="threefifth_onefifth_onefifth">Three fifth / One fifth / One fifth </option>
									<option value="onefifth_threefifth_onefifth">One fifth / Three fifth/  One fifth</option>
									<option value="onefifth_onefifth_threefifth">One fifth / One fifth / Three fifth</option>
									</optgroup>
									
						</select>
			</fieldset>
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertColumns();" />
			</div>
			
			
			<div class="tabcontent" id="tab4">
			<fieldset>
						<legend><?php _e('Video host','epic');?></legend>
						<select id="video_type" name="video_type">
									<option value="">Select video host</option>
									<option value="vimeo">Vimeo</option>
									<option value="youtube">Youtube</option>
									<option value="self">Self-hosted</option>
						</select>
			</fieldset>
			
			<div id="self_hosted_meta">
			<fieldset>
						<legend><?php _e('Video poster image','epic');?></legend>
						<input id="video_poster" name="video_poster" type="text">
			</fieldset>
			<fieldset>
						<legend><?php _e('Video .m4v file source','epic');?></legend>
						<input id="video_m4v" name="video_m4v" type="text">
			</fieldset>
			<fieldset>
						<legend><?php _e('Video .ogv file source','epic');?></legend>
						<input id="video_ogv" name="video_ogv" type="text">
			</fieldset>
			<fieldset>
						<legend><?php _e('Video .webmv file source','epic');?></legend>
						<input id="video_webmv" name="video_webmv" type="text">
			</fieldset>
			</div>
			
			<div id="external_hosted_meta">
			<fieldset>
						<legend><?php _e('Video id','epic');?></legend>
						<input id="video_id" name="video_id" type="text">
			</fieldset>
			</div>
			<fieldset class="floated">
						<legend><?php _e('Video width','epic');?></legend>
						<input id="video_width" name="video_width" type="text">
			</fieldset class="floated last">
				<fieldset>
						<legend><?php _e('Video height','epic');?></legend>
						<input id="video_height" name="video_height" type="text">
			</fieldset>
			<br class="clearfix" />
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
			<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertVideo();"/>
			</div>
			
			
			
			
			
			
			<!-- Dropcaps -->
			
			<div class="tabcontent" id="tab6">
				
				<fieldset class="floated">
						<legend><?php _e('Dropcap text','epic');?></legend>
						<input type="text" value="" name="dropcap_text" id="dropcap_text"/>
				
				</fieldset>
				
				
				<fieldset class="floated last">
						<legend><?php _e('Dropcap style','epic');?></legend>
							<select id="dropcap_style" name="dropcap_style">
									<option value="">Default</option>
									<option value="dark_ball">Dark ball</option>
									<option value="grey_ball">Dark square</option>
																	
							</select>
						
				
				</fieldset>
								
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
				<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertDropcaps();"/>
			</div>
			
			
			<!-- Quotes -->
			
			<div class="tabcontent" id="tab7">
				
				
				
				
				<fieldset>
						<legend><?php _e('Quote style','epic');?></legend>
							<select id="quote_style" name="quote_style">
									<option value="">Default</option>
									<option value="quotation_1">Quotation-mark 1</option>
									<option value="quotation_2">Quotation-mark 2</option>
									
									
							</select>
						
				
				</fieldset>
				
				<fieldset>
						<legend><?php _e('Quote text','epic');?></legend>
						<textarea name="quote_text" id="quote_text"></textarea>
				
				</fieldset>
								
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
				<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertQuote();"/>
			</div>
			
			
			


			<!-- Content boxes -->
			
			<div class="tabcontent" id="tab8">
				
				<fieldset>
						<legend><?php _e('Box header','epic');?></legend>
						<input type="text" value="" name="box_header" id="box_header"/>
				
				</fieldset>
				
				<fieldset>
						<legend><?php _e('Box text','epic');?></legend>
						<textarea name="box_text" id="box_text" style="height:150px;"></textarea>
				
				</fieldset>
				
				
				
				
				<fieldset class="floated ">
						<legend><?php _e('Alignment','epic');?></legend>
							<select id="box_align" name="box_align">
									<option value="">None</option>
									<option value="left">Left</option>
									<option value="right">Right</option>
																	
							</select>
						
				
				</fieldset>
				

				
				
				
				<fieldset class="floated last">
						<legend><?php _e('Size','epic');?></legend>
							<select id="box_size" name="box_size">
									<option value="box_full">Full width</option>
									<option value="one-half">One half width</option>
									<option value="one-third">One third width</option>
									<option value="one-fourth">One fourth width</option>
									<option value="one-fifth">One fifth width</option>
									
									
							</select>
						
				</fieldset>
				
				
				
				
		
				
				<fieldset>
				
					<legend><?php _e('Position','epic');?></legend>
					<div class="inputwrap">
						<input type="checkbox" id="box_margin" name="box_margin"/><label>Remove margins</label>
						<p>If you are creating a column layout with boxes, you should check "remove margins" on the last item in the row, to make elements float properly</p>
						
					</div>
				
				
				</fieldset>
				
				
								
				<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
				<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertBox();"/>
			</div>
			

			
			
</form>


</body>
</html>
