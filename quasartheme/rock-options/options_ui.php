<?php


function rockthemes_to_get_option_length($array = array()){
	if(empty($array)) return 0;
	
	$array_count = 0;
	
	foreach($array as $array_level_1){
		$array_count += count($array_level_1['elements']);
	}
	
	return $array_count;
}


if(!function_exists('xr_loop_options_elements')){
	function xr_loop_options_elements(){
		global $rockthemes_to_options, $rockthemes_to_default_options;
		
			echo '<div style="display:none;">';
			wp_editor("","rockthemes-init-tinymce-editor-useless");
			echo '</div>';

		
		/* Every option will have a different section. This will loop through the sections
		** For example : Main Details, Color Details etc
		*/
		
		
		//ROCKTHEMES PAGE BUILDER EXTENSION
		if(isset($_REQUEST['rockthemes_to_import_export_page']) && $_REQUEST['rockthemes_to_import_export_page'] === 'true'){
			if(function_exists('rockthemes_to_generate_import_export_modal')){ 
				rockthemes_to_generate_import_export_modal();
				return;
			}
		}
		
		
		$navigation_side	= '';
		
		$content 			= '<div class="content_holder">';
			
		$firstCat = true;
		
		foreach($rockthemes_to_options as $option){
			
			/* This will generate elements inside the category.
			** This loop will check the element type then will generate the element according to it's type
			*/
			$class = (!empty($option['class'])) ? 'nav_element '.$option['class'].'' : 'nav_element';
			
			//Check if the first button, then add active_button class to it
			$activeBtn = $firstCat ? " active_button " : "";
			
			$navigation_side .= '<li '.($firstCat ? 'class="active_nav_item"' : '').'><a href="" id="'.$option['category_id'].'_button" class="'.$class.$activeBtn.'">'.$option['category_name'].'</a></li>';

				//Only show the first content
				$hide = !$firstCat ? "hide" : "active_content";
				$firstCat = false;
				
				//starting content div
				$content .= '<div class="content '.$hide.' " id="'.$option['category_id'].'">';
				$content .= '<div class="content_header '.$class.'">'.$option['category_name'].'</div>';

			foreach($option['elements'] as $element){
				if(isset($element['is_hidden']) && $element['is_hidden'] === 'true') continue;
				$content .= '<div class="in_content">'.xr_find_element($element).'</div>';

			}

				$content .= '<div class="clear"></div>';
				//closing content div
				$content .= '</div>';
		}
		//closing content-holder div
		$content .= '</div>';
		
		
		echo '<div class="xr_general_container">';
		echo '<div class="xr_save_dynamic"><div id="save_settings" class="button-primary right">Save Changes<span class="loading-process"></span></div></div>';
		echo '<div class="xr_header"><div class="make_padding">';
		echo '<img src="'.OPTIONS_URI.'images/quasar-theme-options.png" class="quasar-logo" />';
		echo '<h1 class="option_name">Theme Options</h1>';
		
		//Only display import new options button when there are new options.
		if(rockthemes_to_get_option_length($rockthemes_to_options) !== rockthemes_to_get_option_length($rockthemes_to_default_options) || 1 == 1){
			echo '<div class="button import_new_options">Import New Options</div>';
		}
		echo '<a href="?page=rock_options&rockthemes_to_import_export_page=true"><div class="import_all_default_data button-primary">Load / Export Datas</div></a>';
		
		echo '<div class="clear">';
		echo '</div></div></div>';/*HEADER*/
		echo '<div class="nav_holder"><ul>'.$navigation_side.'</ul></div>';
		echo $content;
		echo '<div class="clear"></div>';
		echo '<div class="xr_footer"><div class="make_padding"><div id="reset_settings" class="button left">Reset to Default<span class="reset-process"></span></div><div id="save_settings" class="button-primary right">Save Changes<span class="loading-process"></span></div></div></div>';/*FOOTER*/
		echo '</div>';/*End of container*/
		echo '<div class="clear"></div>';
		
		xr_jquery_save();

	}
}


function xr_jquery_save(){
	global $rockthemes_to_options, $rockthemes_to_default_options;
	$jquery_save = '<script type="text/javascript">
	jQuery(document).ready(function(){
		var on_saving = false;
		//Save data function
		jQuery(document).on("click", "#save_settings", function(){
			if(on_saving) return;
			var save_button = jQuery(this);
			
			on_saving = true;
			save_button.find(".loading-process").html(" Saving...");
			
			var data = '.json_encode($rockthemes_to_default_options).'
			var translate_data = new Object();//Sample array for WPML translation

			for(var i=0; i<data.length; i++){
				for(var t=0; t<data[i]["elements"].length; t++){
					if(data[i]["elements"][t]["is_hidden"] == "true") continue;
					
					
					if(data[i]["elements"][t]["type"] == "text_field" ){
						
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).val();
					}else if(data[i]["elements"][t]["type"] == "colorpicker"){
						data[i]["elements"][t]["default"] = rgb2hex(jQuery("#"+data[i]["elements"][t]["id"]).parent().parent().find("a.wp-color-result").css("background-color"));
					}else if(data[i]["elements"][t]["type"] == "select"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).find(":selected").val();
					}else if(data[i]["elements"][t]["type"] == "select_images"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).find(".selected").attr("value");
					}else if(data[i]["elements"][t]["type"] == "select_images_vertical"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).find(".selected").attr("value");
					}else if(data[i]["elements"][t]["type"] == "image"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).attr("value");
					}else if(data[i]["elements"][t]["type"] == "checkbox"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).find(".slider-button").html();
					}else if(data[i]["elements"][t]["type"] == "socialicons"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).val();
					}else if(data[i]["elements"][t]["type"] == "text_area"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).val();
						
					}else if(data[i]["elements"][t]["type"] == "theme_update"){
						
						data[i]["elements"][t]["default"] = new Object();
						data[i]["elements"][t]["default"].username = jQuery("#"+data[i]["elements"][t]["id"]).find("#username").val();
						data[i]["elements"][t]["default"].user_api_key = jQuery("#"+data[i]["elements"][t]["id"]).find("#user_api_key").val();
						
					}else if(data[i]["elements"][t]["type"] == "page_list"){
						data[i]["elements"][t]["default"] = jQuery("#"+data[i]["elements"][t]["id"]).find(":selected").val();
						
						
					}else if(data[i]["elements"][t]["type"] == "font_option_field"){
						
						data[i]["elements"][t]["default"] = new Object();
						data[i]["elements"][t]["default"].font_size = jQuery("#"+data[i]["elements"][t]["id"]).find(".font_size").val();
						data[i]["elements"][t]["default"].font_family = jQuery("#"+data[i]["elements"][t]["id"]).find(".font_family").val();

						//data[i]["elements"][t]["default"] = "";//JSON.stringify(data[i]["elements"][t]["default"]);
						
					}
					
					if(data[i]["elements"][t]["is_translate"] && data[i]["elements"][t]["is_translate"] == "true"){
						translate_data[data[i]["elements"][t]["id"]] = data[i]["elements"][t]["default"];
					}
				}
			}
			
			  var rockthemes_to_nonce_save = "'.(esc_js(wp_create_nonce('rockthemes_to_nonce_save'))).'";
			  jQuery.post(ajaxurl, {settings_data:JSON.stringify(data), _ajax_nonce:rockthemes_to_nonce_save, translate_array:JSON.stringify(translate_data), action:"xr_save_settings"}, function(response) {
				  
				  if(response.indexOf("saved") > -1) {
					  on_saving = false;
					  save_button.find(".loading-process").html(" Successfully Saved!");
					  setTimeout(function(){save_button.find(".loading-process").html("");},2000);
				  } else {
					  on_saving = false;
					  save_button.find(".loading-process").html(" An Error Occured!");
					  setTimeout(function(){save_button.find(".loading-process").html("");},2000);
				  }
			  });
			  return false;
		});
		
		//Reset settings to default
		jQuery("#reset_settings").on("click", function(){
			if(on_saving) return;
			on_saving = true;
			jQuery(this).find(".reset-process").html(" Loading Defaults...");
			
			var data = '.json_encode($rockthemes_to_default_options).'
			  var rockthemes_to_nonce_save = "'.(esc_js(wp_create_nonce('rockthemes_to_nonce_save'))).'";
			  jQuery.post(ajaxurl, {settings_data:JSON.stringify(data), _ajax_nonce:rockthemes_to_nonce_save, action:"xr_save_settings"}, function(response) {
				  
				  if(response.indexOf("saved") > -1) {
					  
					  location.reload();
				  } else {
					  
				  }
			  });
			
		});
		
		//Select with Image Element
		jQuery(".image-select-list").each(function(){
			jQuery(this).find(".image-select-elem").on("click",function(){
				jQuery(this).parent().find(".selected").removeClass("selected");
				jQuery(this).addClass("selected");
			});
		});
		
		//Select with Image Vertical Element
		jQuery(".image-select-vertical-list").each(function(){
			jQuery(this).find(".image-select-vertical-elem").on("click",function(){
				jQuery(this).parent().find(".selected").removeClass("selected");
				jQuery(this).addClass("selected");
			});
		});
		
		//Navigation Buttons
		jQuery("li a.nav_element").on("click", function(){
			//remove old active button class, and add new active_button class
			jQuery(".active_button").removeClass("active_button");
			jQuery(".active_nav_item").removeClass("active_nav_item");
			jQuery(this).addClass("active_button");
			jQuery(this).parent().addClass("active_nav_item");
			
			//find new selected element
			var target_id = jQuery(this).attr("id").toString().replace("_button","");
			
			//hide old selected element
			jQuery(".active_content").removeClass("active_content").addClass("hide");
			
			//show new selected element
			jQuery("#"+target_id).addClass("active_content").css({"margin-left":"70px","opacity":"0"}).removeClass("hide").animate({"margin-left":"0px","opacity":"1"},400);
		});
		
		//Image Uploader Element
		var img_container_id;
		
		var custom_uploader;
		 
		 
		jQuery(".rockthemes_to_image_uploader_class").click(function(e) {
		 
				e.preventDefault();
		 
				//If the uploader object has already been created, reopen the dialog
				if (custom_uploader) {
					//custom_uploader.open();
					//return;
				}
				
				img_container_id = jQuery(this).parent().find(".rockthemes_to_upload_image_button").attr("id");
		 
				//Extend the wp.media object
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: "Choose Image",
					button: {
						text: "Choose Image"
					},
					multiple: false
				});
		 
				//When a file is selected, grab the URL and set it as the text field\'s value
				custom_uploader.on("select", function() {
					attachment = custom_uploader.state().get("selection").first().toJSON();
					jQuery("#"+img_container_id).val(attachment.url);
					if(jQuery("#"+img_container_id).parent().find("img").length > 0){
						jQuery("#"+img_container_id).parent().find("img").remove();	
						jQuery("#"+img_container_id).parent().find("br").remove();	
					}
					if(jQuery("#"+img_container_id).parent().parent().find("img").length > 0){
						jQuery("#"+img_container_id).parent().parent().find("img").remove();	
						jQuery("#"+img_container_id).parent().parent().find("br").remove();	
					}
					jQuery("#"+img_container_id).parent().prepend("<img src="+attachment.url+" /><br />");
				});
		 
				//Open the uploader dialog
				custom_uploader.open();
		 
		});	
			
		//Checkbox with jQuery
		jQuery(".slider-button").on("click",function(){
			if(jQuery(this).hasClass("on")){
				jQuery(this).removeClass("on").html("NO");
			}else{
				jQuery(this).addClass("on").html("YES");
			}
		});	
		
		
		//Global Functions
		function rgb2hex(rgb){
			if(rgb == undefined) return "";
			if(rgb.indexOf("#") > -1) return rgb;
		 rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		 return "#" +
		  ("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
		  ("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
		  ("0" + parseInt(rgb[3],10).toString(16)).slice(-2);
		}
	});
	</script>';
	
	echo $jquery_save;
}


function xr_theme_options_do_page() { 
	xr_loop_options_elements();
	return;
} 






?>