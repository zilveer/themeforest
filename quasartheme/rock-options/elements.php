<?php
/*
**	Rock Theme Options
**
**	Elements are located here
**
**	Version	:	1.0
*/



/*
Regular Text Element
*/

if(!function_exists('xr_make_text_field')){
	function xr_make_text_field($args = array()){
		$default = '';
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		$return .= '<input autocomplete="off" type="text" id="'.$id.'" value="'.esc_attr(stripslashes($default)).'" />';
		$return .= '<div class="element-description">'.stripslashes(esc_attr($description)).'</div>';
		
		return $return;
	}
}




/*
Regular Text Area (No TinyMCE)
*/

if(!function_exists('xr_make_text_area')){
	function xr_make_text_area($args = array()){
		
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		$return .= '<textarea id="'.$id.'">'.stripslashes($default).'</textarea>';
		$return .= '<div class="element-description">'.stripslashes(esc_attr($description)).'</div>';
		
		return $return;
	}
}






/*
Image Uploader
*/

if(!function_exists('xr_make_image')){
	function xr_make_image($args = array()){
		$default = '';
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		
		$return .= '<div class="image_nocode_container">';
		if(!empty($default)){
			$return .= '<img src="'.$default.'" /><br />';
		}
		
		$return .= '<label for="upload_image"> <input autocomplete="off" id="'.$id.'" class="rockthemes_to_upload_image_button" size="36" name="upload_image" type="text" value="'.$default.'" /> <input autocomplete="off" class="rockthemes_to_image_uploader_class button" value="Upload Image" type="button" /> </label>';
		$return .= '</div><br />';
		
		$return .= '<div class="element-description-full">'.esc_attr(stripslashes($description)).'</div>';
		
		return $return;
	}
}




/*
Checkbox (With jQuery Slide)
*/

if(!function_exists('xr_make_checkbox')){
	function xr_make_checkbox($args = array()){
		
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		
		$return .= '<section id="'.$id.'" class="checkbox_holder">';
            
        $return .= '<div class="slider-frame">';
		if($default == "YES"){
			$return .= '<span class="slider-button on">YES</span>';
		}else{
			$return .= '<span class="slider-button">NO</span>';
		}
		$return .= '</div>';

        $return .= '</section>';
		$return .= '<div class="element-description">'.esc_attr(stripslashes($description)).'</div>';
		$return .= '<div class="clear"></div>';
		
		return $return;
	}
}





/*
Select (Dropdown) Element
*/

if(!function_exists('xr_make_select')){
	function xr_make_select($args = array()){
		$default = '';
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		$return .= '<select name="'.$id.'" id="'.$id.'">';
		
		foreach($choices as $choice){
			if($choice['value'] == $default){
				$return .= '<option value="'.$choice['value'].'" selected>'.$choice['text'].'</option>';
			}else{
				$return .= '<option value="'.$choice['value'].'" >'.$choice['text'].'</option>';
			}
		}
		
		$return .= '</select>';
		$return .= '<div class="element-description">'.esc_attr(stripslashes($description)).'</div>';
		$return .= '<div class="clear"></div>';
		
		return $return;
	}
}




/*
Select with Images Element
*/

if(!function_exists('xr_make_select_images')){
	function xr_make_select_images($args = array()){
		
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		
		$return .= '<div id="'.$id.'" class="image-select-list">';
		$return .= '<div class="image-select-container">';
		
			foreach($choices as $choice){
				if($choice['value'] == $default){
					$return .= '<div class="image-select-elem selected" value="'.$choice['value'].'"><img src="'.$choice['url'].'" alt="'.$choice['value'].'" /></div>';
				}else{
					$return .= '<div class="image-select-elem" value="'.$choice['value'].'"><img src="'.$choice['url'].'" alt="'.$choice['value'].'" /></div>';
				}
			}

		$return .= '<div class="clear"></div>';
		$return .= '</div>';
		$return .= '</div><br />';
		$return .= '<div class="element-description-full">'.esc_attr(stripslashes($description)).'</div>';

		return $return;
	}
}




/*
Select with Images Element
*/

if(!function_exists('xr_make_select_images_vertical')){
	function xr_make_select_images_vertical($args = array()){
		
		extract($args);
		$return = '<h3>'.$label.'</h3>';
		$return .= '<div class="element-description-full">'.esc_attr(stripslashes($description)).'</div>';
		
		$return .= '<div id="'.$id.'" class="image-select-vertical-list">';
		$return .= '<div class="image-select-vertical-container">';
		
			foreach($choices as $choice){
				if($choice['value'] == $default){
					$return .= '<div class="image-select-vertical-elem selected" value="'.$choice['value'].'"><img src="'.$choice['url'].'" alt="'.$choice['value'].'" /></div>';
				}else{
					$return .= '<div class="image-select-vertical-elem" value="'.$choice['value'].'"><img src="'.$choice['url'].'" alt="'.$choice['value'].'" /></div>';
				}
			}

		$return .= '<div class="clear"></div>';
		$return .= '</div>';
		$return .= '</div><br />';

		return $return;
	}
}






/*
Colorpicker
*/
if(!function_exists('xr_make_colorpicker')){
	function xr_make_colorpicker($args = array()){
		extract($args);

		$return = '<h3>'.$label.'</h3>';
		$return .= '<input autocomplete="off" type="text" id="'.$id.'" value="'.$default.'" class="my-color-field" data-default-color="'.$default.'" />';
		$return .= '<div class="element-description">'.esc_attr(stripslashes($description)).'</div>';
		$return .= '<script type="text/javascript">
					jQuery(document).ready(function(){
				jQuery("#'.$id.'").wpColorPicker();
			});

		</script>';	
		
		return $return;
	}
}




/*
**	Header for Rock Theme Optins
**
**	Only for the backend
*/
if(!function_exists('xr_make_header')){
	function xr_make_header($args = array()){
		extract($args);
		
		$return = '<div class="rockthemes-to-header-container">';		
		$return .= '<h2>'.stripslashes($description).'</h2>';
		$return .= '</div>';
		
		return $return;
	}
}



/*
**	Page List
**	
**	Displays all of the wordpress pages.
**
*/
if(!function_exists('xr_make_page_list')){
	function xr_make_page_list($args = array()){

		extract($args);

		$return = '<h3>'.$label.'</h3>';
		$mypages = get_pages();
		$return .= '<select id="'.$id.'" autocomplete="off">';
		foreach($mypages as $page){     
			$return .= '<option value="'.$page->ID.'"';
			if ($page->ID == $default) {$return .= ' selected';}
			$return .= '>'.$page->post_title.'</option>';
		}
		$return .= '</select>';  
		$return .= '<div class="element-description">'.esc_attr(stripslashes($description)).'</div>';
		$return .= '<div class="clear"></div>';

		return $return;
	}
}



/*
**	Font CSS Details Field
**
**	Contains font CSS Code and Font Size
*/
if(!function_exists('xr_make_font_option_field')){
	function xr_make_font_option_field($args = array()){
		extract($args);

		$return = '<h3>'.$label.'</h3>';
		
		$return .= '<div id="'.$id.'" class="font_option_field row-fluid">';
			$return .= '
				<div class="span5">
					<strong>Font Family :</strong><br/>
					<input autocomplete="off" class="font_family" type="text" value="'.esc_attr(stripslashes($default['font_family'])).'" />
				</div>
				<div class="span2">
					<strong>Font Size :</strong><br/>
					<input autocomplete="off" class="font_size" type="text" value="'.$default['font_size'].'" />
				</div>
			';
			
			$return .= '<div class="element-description span5">'.esc_attr(stripslashes($description)).'. Make sure you use correct CSS codes for both font family and font size. Do not forget to add "px" for font size</div>';
		$return .= '</div>';
		

		return $return;
		
	}
}




/*
**	ROCKTHEMES PAGE BUILDER ELEMENTS
*/

/*
**	Social Icons
*/
if(!function_exists('xr_make_socialicons')){
	function xr_make_socialicons($args = array()){
		extract($args);

		$default = json_decode(($default),true);

		$return = '<h3>'.$label.'</h3>';
		$return .= '<div class="social_icons_class" ref="0">';
		$return .= '<input autocomplete="off" id="'.$id.'" type="hidden" value="'.esc_attr(json_encode($default)).'" />';
		$return .= '<input autocomplete="off" id="'.$id.'-shortcode" type="text" value="'.esc_attr($default['shortcode']).'" /><div class="button call_social_icons_external" id_ref="'.$id.'-shortcode" id_data_ref="'.$id.'">Add Social Icons</div>';
		$return .= '</div>';
		$return .= '<div class="clear"></div><br/>';
		$return .= '<div class="element-description-full">'.esc_attr(stripslashes($description)).'</div>';
				
		return $return;
	}
}




/*
**	Update Field (Special Field)
*/
if(!function_exists('xr_make_theme_update')){
	function xr_make_theme_update($args = array()){
		
		$user_api_key = '';
		$username = '';
		
		extract($args);
		
		if(!empty($default)) extract($default);
				
		
		$return = '<div class="theme_update_container" id="'.$id.'">';
		$return .= '<h3>'.$label.'</h3>';
		$return .= '
			<strong>Enter Your Themeforest Username :</strong><br/>
			<input autocomplete="off" type="text" id="username" value="'.$username.'" />
			<br/><br/>
		';
		
		$return .= '
			<strong>Enter Your API Key :</strong><br/>
			<input autocomplete="off" type="text" name="user_api_key" id="user_api_key" value="'.$user_api_key.'" />
			<br/>
			<br/>
		';
		
		$return .= '<div class="button check_theme_update">Check Updates <span></span></div>';
		$return .= '<div class="button-primary start_theme_update hide" href="?page=rock_options&start_theme_update=true">Update Theme <span></span></div>';
		
		$return .= '<div class="clear"></div>';
		$return .= '<br/>
					<div id="theme_update_errors"></div>
					<br/>
					<br/>
					<p>To get your purchase API Key, login to your Themeforest Account and follow these steps :</p>
					<ul class="license-description-list">
						<li>Go To My "Settings"</li>
						<li>You will see the "API Keys" in the left menu. Click on it</li>
						<li>Under "Generate another API Key" enter the label you want and click "Generate API Key" button</li>
						<li>Now it will show your API Key under "Your API Keys". Find your API Key</li>
						<li>Copy the key. Do not copy the label and make sure you only copy the API Key</li>
						<li>Now you can paste your API Key here</li>
					</ul>
					<br/>
					';
		
		$return .= '</div>';
		
					
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(document).on("click", ".check_theme_update", function(){
						var clicked_btn = jQuery(this);
						var username = jQuery("#username").val();
						var user_api_key = jQuery("#user_api_key").val();
						var error_div = jQuery("#theme_update_errors");
						
						if(username == ""){
							error_div.html("Enter your username");
							return;	
						}
						
						if(user_api_key == ""){
							error_div.html("Enter your API Key");
							return;	
						}
						
						jQuery(this).find("span").append("<i class=\"fa fa-refresh fa-spin\"></i>");
						
						var data = new Object();
						data.username = username;
						data.user_api_key = user_api_key;
						
						jQuery.post(ajaxurl, {action:"rock_theme_update_check_update", data:data}, function(data){
							console.dir(data);
							if(data.errors){
								var errors_html_out = "";
								for(var er = 0; er < data.errors.length; er++){
									errors_html_out += data.errors[er]+"<br/>";
								}
								error_div.html(errors_html_out);
								
								clicked_btn.find("span").html("");
								return;	
							}
							
							if(data.updated_themes_count){
								/*
								var updated_themes_html = "";
								for(var ut = 0; ut < data.updated_themes.length; ut++){
									updated_themes_html += data.updated_themes[ut]+"<br/>";
								}
								error_div.html(updated_themes_html);
								*/
								
								jQuery(".start_theme_update").css({"opacity":"0","display":"inline-block"}).animate({"opacity":1},300);
								clicked_btn.find("span").html("");
								return;	
							}else{
								clicked_btn.find("span").html("");
								error_div.html("<strong>No Update is Available. You are using the Latest Version.</strong>");
							}
							
							return;	
							console.log("data is "+data.errors);
							console.dir(data);
							//error_div.html(data);
						});
					});
					
					
					jQuery(document).on("click", ".start_theme_update", function(){
						var clicked_btn = jQuery(this);
						var username = jQuery("#username").val();
						var user_api_key = jQuery("#user_api_key").val();
						var error_div = jQuery("#theme_update_errors");
						
						if(username == ""){
							error_div.html("Enter your username");
							return;	
						}
						
						if(user_api_key == ""){
							error_div.html("Enter your API Key");
							return;	
						}
						
						jQuery(this).find("span").append("<i class=\"fa fa-refresh fa-spin\"></i>");
						
						var data = new Object();
						data.username = username;
						data.user_api_key = user_api_key;
						
						jQuery.post(ajaxurl, {action:"rock_theme_update_start_update", data:data}, function(data){
							console.log(data.success);
							console.dir(data);
							if(data.errors){
								var errors_html_out = "";
								for(var er = 0; er < data.errors.length; er++){
									errors_html_out += data.errors[er]+"<br/>";
								}
								error_div.html(errors_html_out);
								
								clicked_btn.find("span").html("");
								return;	
							}
							
							if(data.success){
								var success_html_out = "";
								for(var s = 0; s < data.installation_feedback.length; s++){
									if(data.installation_feedback[s].toString().indexOf("<a") < 0){
										success_html_out += data.installation_feedback[s]+"<br/>";
									}
								}
								error_div.html(success_html_out);
								
								clicked_btn.find("span").html("");
								return;	
							}
						});
					});
					
				});
			</script>
		';
				
		return $return.$script;
	}
}







/*
**	License Field (Special Field)
*/
if(!function_exists('xr_make_license')){
	function xr_make_license($args = array()){
		extract($args);
		
		$buyer = '';
		$activated_at = '';
		$activated_url = '';
		$purchase_code_entered_at = '';
				
		$default = json_decode(stripslashes($default),true);
		
		$current_theme = wp_get_theme();
		
		$backbone = json_decode(stripslashes(unserialize(get_option('html_backbone_moderation', false))),true);
		if($backbone && $backbone['data']) extract($backbone['data']);
		
		
		$return = '<div class="enter_purchase_code_container '.($buyer !== "" ? "hide" : "").'">';
		$return .= '<h3>'.$label.'</h3>';
		$return .= '<input autocomplete="off" type="text" id="license_input" value="" /><div id="activate_license_code" class="button" >Activate Purchase Code</div>';
		$return .= '<div class="clear"></div>';
		$return .= '<br/>
					<br/>
					<div id="license_errors"></div>
					<strong style="color:#FF0000;">!Important</strong>
					<p>If this is your testing server, do not enter your purchase code. Purchase code can only be used in one site and can not be removed. But if this is your demo server for your clients, you can enter your Purchase Code. When you will move your site to your clients domain you can contact us to migrate your license.</p>
					<br/>
					<br/>
					<strong style="color:#FF0000;">!Important</strong>
					<p>Make sure you are not using child theme when entering Purchase Code. If you are using child theme, switch to main Quasar Theme before entering Purchase Code</p>
					<br/>
					<br/>
					<h3 class="purchase_code_howto_title">How to get your Purchase Code?</h3>
					<div class="purchase_code_howto_image image_nocode_container">
						<img src="'.OPTIONS_URI.'images/purchase_code.png" />
					</div>
					<p class="purchase_code_howto_desc">To get your purchase code, login to your Themeforest Account and follow these steps :</p>
					<ul class="license-description-list">
						<li>Go To Downloads</li>
						<li>You will see the "Download" button next to our theme icon, click on it</li>
						<li>When you click to "Download" you will see different options, click on "License certificate & purchase code"</li>
						<li>Download the file</li>
						<li>Open the downloaded file with your favorite text editor</li>
						<li>You will see "Item Purchase Code:", copy that code</li>
						<li>And now you can paste your purchase code here</li>
					</ul>
					<br/>
					<p><strong>Purchase Code Format Example : </strong></p>
					<p>aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee</p>
					<br/>
					';
		
		$return .= '</div>';
		

		//Licensed item details
		$return .= '
			<div class="licensed_to_container '.($buyer === "" ? "hide" : "").'">
				<h3>License Information</h3>
				<div class="row-fluid">
					<div class="span3">
						<strong>Licensed To : </strong>
					</div>
					<div class="span9">
						<span class="licensed_to">'.$buyer.'</span>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3">
						<strong>For : </strong>
					</div>
					<div class="span9">
						<span class="licensed_for">'.$activated_url.'</span>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span3">
						<strong>At : </strong>
					</div>
					<div class="span9">
						<span class="licensed_at">'.$purchase_code_entered_at.'</span>
					</div>
				</div>
				<div class="row-fluid">
					<div class="large-12">
						<br/><br/>
						<p>If you have entered your Purchase Code on wrong domain or you want to change your domain, you can contact us to migrate your Purchase Code when you move your site to your new/final domain</p>
						<a class="reenter_purcase_code" style="cursor:pointer;">Re-Enter Purchase Code</a>
					</div>
				</div>
			</div>
		';			
					
		$script = '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					
					jQuery(document).on("click", ".reenter_purcase_code", function(){
						jQuery(".purchase_code_howto_image, .license-description-list, .purchase_code_howto_title, .purchase_code_howto_desc").addClass("hide");
						jQuery(".enter_purchase_code_container.hide").removeClass("hide");
					});
					
					function substr_replace (str, replace, start, length) {
					  if (start < 0) { // start position in str
						start = start + str.length;
					  }
					  length = length !== undefined ? length : str.length;
					  if (length < 0) {
						length = length + str.length - start;
					  }
					  return str.slice(0, start) + replace.substr(0, length) + replace.slice(length) + str.slice(start + length);
					}			
					
					
					var user_try = 0;
					jQuery(document).on("click", "#activate_license_code", function(){
						
						//If already on progress stop the function and remove the icon
						if(jQuery(this).find(".fa fa-refresh").length){
							jQuery(this).find(".fa fa-refresh").remove();
							return;
						}
						
						//If no purchase code entered, return
						if(jQuery("#license_input").val() == ""){ return alert("Enter a Purchase Code");}
						
						//Add loading icon
						var button_text = jQuery(this).html();
						button_text += " <i class=\"fa fa-refresh fa-spin\"></i>";
						jQuery(this).html(button_text);
						
						
						jQuery.post(ajaxurl, {action:"theme_license_total_try"}, function(data){
							user_try = data.try;
							if(data.try >  10){
								jQuery("#activate_license_code").find(".fa fa-refresh").remove();
								jQuery("#license_errors").html("");
								alert("You have reached to maximum limit for wrong codes\n10 Wrong Purchase Code\n\nPlease try again later with a valid purchase code");	
							}else{
								on_activate_click();
							}
						});
					});
							
					function on_activate_click(){
						
						var data = new Object();
						
						data.purchase_code = jQuery("#license_input").val();
						data.url = window.location.host;
						data.theme = "'.$current_theme->name.'"
						//http://rockthemes.net/theme_license/license_control.php
						jQuery.post("http://rockthemes.net/theme_license/license_control.php", 
									{data:JSON.stringify(data)},
						function(data){
							jQuery("#activate_license_code").find(".fa fa-refresh").remove();
							jQuery("#license_errors").html("");
														
							try{
								data = JSON.parse(data);	
							}catch(e){
								//Do nothing	
							}
							
							if(data){
								//data = JSON.parse(data);
								if(data.error){
									var try_left;
									if(data.error == "maximum_wrong_code"){
										alert("You have reached to maximum limit for wrong codes\n10 Wrong Purchase Code\n\nPlease try again later with a valid purchase code");	
									}else if(data.error == "wrong_code_limit"){
										data.try = user_try;

										if(data.try && data.try >= 8){
											try_left = 10 - parseInt(data.try);
											jQuery("#license_errors").html("Purchase code you have entered is not valid. Limit left :"+try_left+"<br/><br/>");
										}else{
											jQuery("#license_errors").html("Purchase code you have entered is not valid. Make sure you have entered your Purchase Code correctly.<br/><br/>");
										}
									}else if(data.error == "purchase_code_in_use"){
										data.try = user_try
										try_left = 10 - parseInt(data.try);
										var error_message = "Purchase code you have entered is registered to another domain. Please Enter your valid Purchase Code.";
										if(try_left <= 3){
											error_message += " Limit left :"+try_left+"<br/><br/>";
										}else{
											error_message += "<br/><br/>";
										}
										jQuery("#license_errors").html(error_message);
									}else if(data.error == "wrong_item_name"){
										data.try = user_try;
										try_left = 10 - parseInt(data.try);
										var error_message = "Purchase code you have entered does not belong to your current theme.";
										if(try_left <= 3){
											error_message += " Limit left :"+try_left+"<br/><br/>";
										}else{
											error_message += "<br/><br/>";
										}
										jQuery("#license_errors").html(error_message);
									}
								}else if(data.success){
									jQuery.post(ajaxurl, {data:JSON.stringify(data), action:"backbone_core"}, function(backbone_data){										
										if(backbone_data == "success"){
											jQuery(".licensed_to_container").find(".licensed_to").html(data.data.buyer);
											jQuery(".licensed_to_container").find(".licensed_for").html(data.data.activated_url);
											jQuery(".licensed_to_container").find(".licensed_at").html(data.data.purchase_code_entered_at);
											
											jQuery(".enter_purchase_code_container").hide();
											jQuery(".licensed_to_container").removeClass("hide").fadeIn();
										}else{
											alert("An error occured during the mysql connection to "+window.location.host+backbone_data);	
										}
									});
									
								}
							}
						}).fail(function(){
							jQuery("#activate_license_code").find(".fa fa-refresh").remove();
							alert("Connection to the server could not be established. Please try again later.");
						});
					};
					
				});
			</script>
		';
				
		return $return.$script;
	}
}







/* This function finds the element type and calls it's function
** 
*/
if(!function_exists('xr_find_element')){
	function xr_find_element($elem){
		$function_name = 'xr_make_'.$elem['type'];
		return $function_name($elem);
	}
}


?>