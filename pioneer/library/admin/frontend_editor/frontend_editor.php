<?php 
/*
 FRONT END EDITOR 
 */

function epic_frontend_editor(){ 

	
	global $current_user, $wp_roles, $wp_query;

	get_currentuserinfo();

	


	
	/* Check if user is logged in and is administrator */
	if ( current_user_can('manage_options') && is_user_logged_in()){ 
	
	/* Get the current post/page id */
	$post_id = $wp_query->post->ID;
	
		
	/* Global settings - Theme options */
	$articlewidth = get_option('epic_articlewidth');
	if(!$articlewidth){ $articlewidth = 640;}
	$sidebarwidth = 960 - $articlewidth;
	
	$topmargin = get_option('epic_wrapper_margin_top');
	if(empty($topmargin)){$topmargin = 30;}
	$bottommargin = get_option('epic_wrapper_margin_bottom');
	if(empty($bottommargin)){$bottommargin = 30;}
	
	$primary_color = get_option('epic_primary_color');
	$primary_hover_color = get_option('epic_primary_hover_color');
	$linkcolor = get_option('epic_custom_link_color');
	$linkhovercolor = get_option('epic_custom_link_hover_color');
	
	
	$epic_primary_background_color = get_option('epic_primary_background_color');
	
	
	$backgroundcolor = get_option('epic_custom_background_color');
	$epic_header_background_color = get_option('epic_header_background_color');
	$epic_footer_background_color = get_option('epic_footer_background_color');
	
		
	
	/* Logo position */
	$epic_logo_x_pos = get_option('epic_logo_x_pos');
	$epic_logo_y_pos = get_option('epic_logo_y_pos');
	
	/* WPML language selector position */
	$epic_wpml_x_pos = get_option('epic_wpml_x_pos');
	$epic_wpml_y_pos = get_option('epic_wpml_y_pos');
	
	/* WPML language selector position */
	$epic_bp_menu_x_pos = get_option('epic_bp_menu_x_pos');
	$epic_bp_menu_y_pos = get_option('epic_bp_menu_y_pos');
	
	/* Searchform position */
	$epic_searchform_x_pos = get_option('epic_searchform_x_pos');
	$epic_searchform_y_pos = get_option('epic_searchform_y_pos');
	
	/* Social media position */
	$epic_socialmedia_x_pos = get_option('epic_socialmedia_x_pos');
	$epic_socialmedia_y_pos = get_option('epic_socialmedia_y_pos');
	
	/* Header textbox */
	$epic_header_textbox_x_pos = get_option('epic_header_textbox_x_pos');
	$epic_header_textbox_y_pos = get_option('epic_header_textbox_y_pos');
	$epic_header_textbox_height = get_option('epic_header_textbox_height');
	$epic_header_textbox_width = get_option('epic_header_textbox_width');
	
	/* Primary menu position */
	$epic_primary_x_pos = get_option('epic_primary_x_pos');
	$epic_primary_y_pos = get_option('epic_primary_y_pos');
	
	/* Secondary menu position */
	$epic_secondary_x_pos = get_option('epic_secondary_x_pos');
	$epic_secondary_y_pos = get_option('epic_secondary_y_pos');
	
	/* Header height */	
	$epic_header_height = get_option('epic_header_height');
	
	?>
<div id="info"></div>
<div id="epic_fee_editor">

<form id="front_end_editor" method="post">
	<input type="hidden" value="<?php echo $post_id;?>" id="pageid"/>
	<input type="hidden" name="pageorder" id="pageorder" value="<?php echo $pageorder;?>"/>
	<ul class="editor-panels">
				<li><a href="#" id="openModuleSelector" class="openModuleSelector" title="Modules"></a></li>
		<li><a href="#" id="openFontSelector" class="openFontSelector" title="Fonts"></a></li>
		<li><a href="#" id="openAppearanceSelector" class="openAppearanceSelector" title="Colors and appearance"></a></li>
		
		
	</ul> 
	
		<!-- Image heights -->
		
			
		
		</form>
		<?php require_once(EPIC_ADMIN.'/frontend_editor/module-settings.php');?>
		
		<?php require_once(EPIC_ADMIN.'/frontend_editor/appearance-settings.php');?>
		<?php require_once(EPIC_ADMIN.'/frontend_editor/font-settings.php');?>
		<?php require_once(EPIC_ADMIN.'/frontend_editor/images-settings.php');?>
		
</div>
	<?php
	}
}



/* Save the options */
function fee_process(){
	
	global $current_user, $wp_roles, $wp_query, $post;
	get_currentuserinfo();
	
	if(isset($wp_query->post->ID)){
	$post_id = $wp_query->post->ID;
	}
	
	if (current_user_can('manage_options') && is_user_logged_in()){ 
	
	
	
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_appearance']),'fee_save_nonce')){
			
			
			$options = array(
				
				'epic_custom_css',
				'epic_background_texture',
				'epic_site_layout',
				'epic_tickermodule_background',
				'epic_twittermodule_background',
				'epic_searchmodule_background',
				'epic_signupmodule_background',
				'epic_page_background',
				'epic_header_background',
				'epic_footer_background',
				'epic_link_color',
				'epic_link_color_hover',
				'epic_header_link_color',
				'epic_header_link_color_hover',
				'epic_footer_link_color',
				'epic_footer_link_color_hover',
				'epic_primary_background',
				'epic_primary_border',
				'epic_primary_border_hover',
				'epic_primary_link',
				'epic_primary_link_hover',
				'epic_primary_background_hover'
				
				);
					
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_option($option, $opt);
				}else{ delete_option($option);}
			}			


		
		}
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_fontsettings']),'fee_save_nonce')){
	
			/* Fonts */
			
			/* Title fonts */
			
			if(isset($_POST["epic_title_font_rendering"])){
					$opt = $_POST["epic_title_font_rendering"];
					update_option('epic_title_font_rendering', $opt);
				}

			
			if(isset($_POST["epic_websafe_title_font"])){
					$opt = $_POST["epic_websafe_title_font"];
					update_option('epic_websafe_title_font', $opt);
				}
				
			if(isset($_POST["epic_google_title_font"])){
					$opt = stripslashes($_POST["epic_google_title_font"]);
					update_option('epic_google_title_font', $opt);
				}
				
			if(isset($_POST["epic_title_google_fontfamily_weight"])){
					$opt = stripslashes($_POST["epic_title_google_fontfamily_weight"]);
					update_option('epic_title_google_fontfamily_weight', $opt);
				}else{delete_option('epic_title_google_fontfamily_weight');}
					
				
			if(isset($_POST["epic_google_title_fontfamily"])){
					$opt = stripslashes($_POST["epic_google_title_fontfamily"]);
					update_option('epic_google_title_fontfamily', $opt);
				}
				
			/* Body fonts */
			
			if(isset($_POST["epic_body_font_rendering"])){
					$opt = $_POST["epic_body_font_rendering"];
					update_option('epic_body_font_rendering', $opt);
				}

			
			if(isset($_POST["epic_body_websafe_font"])){
					$opt = $_POST["epic_body_websafe_font"];
					update_option('epic_body_websafe_font', $opt);
				}
				
			if(isset($_POST["epic_body_google_fontfamily_weight"])){
					$opt = stripslashes($_POST["epic_body_google_fontfamily_weight"]);
					update_option('epic_body_google_fontfamily_weight', $opt);
				}else{delete_option('epic_body_google_fontfamily_weight');}
				
			if(isset($_POST["epic_body_google_fontfamily"])){
					$opt = stripslashes($_POST["epic_body_google_fontfamily"]);
					update_option('epic_body_google_fontfamily', $opt);
				}
				
				
			
			/* Header 1 */		
			if(isset($_POST["fee-h1-size"])){
					$fontsize = $_POST["fee-h1-size"];
					update_option('epic_h1_size', $fontsize);
				}
				
			if(isset($_POST["fee-h1-color"])){
					$fontsize = $_POST["fee-h1-color"];
					update_option('epic_h1_color', $fontsize);
				}
				
			if(isset($_POST["epic_h1_weight"])){
					$opt = $_POST["epic_h1_weight"];
					update_option('epic_h1_weight', $opt);
				}else {delete_option('epic_h1_weight');}
				
			/* Header 2 */		
			if(isset($_POST["fee-h2-size"])){
					$fontsize = $_POST["fee-h2-size"];
					update_option('epic_h2_size', $fontsize);
				}
				
			if(isset($_POST["fee-h2-color"])){
					$fontsize = $_POST["fee-h2-color"];
					update_option('epic_h2_color', $fontsize);
				}
			
			if(isset($_POST["epic_h2_weight"])){
					$opt = $_POST["epic_h2_weight"];
					update_option('epic_h2_weight', $opt);
				}else {delete_option('epic_h2_weight');}

			/* Header 3 */		
			if(isset($_POST["fee-h3-size"])){
					$fontsize = $_POST["fee-h3-size"];
					update_option('epic_h3_size', $fontsize);
				}
				
			if(isset($_POST["fee-h3-color"])){
					$fontsize = $_POST["fee-h3-color"];
					update_option('epic_h3_color', $fontsize);
				}
				
			if(isset($_POST["epic_h3_weight"])){
					$opt = $_POST["epic_h3_weight"];
					update_option('epic_h3_weight', $opt);
				}else {delete_option('epic_h3_weight');}
				
			/* Header 4 */		
			if(isset($_POST["fee-h4-size"])){
					$fontsize = $_POST["fee-h4-size"];
					update_option('epic_h4_size', $fontsize);
				}
				
			if(isset($_POST["fee-h4-color"])){
					$fontsize = $_POST["fee-h4-color"];
					update_option('epic_h4_color', $fontsize);
				}
				
			if(isset($_POST["epic_h4_weight"])){
					$opt = $_POST["epic_h4_weight"];
					update_option('epic_h4_weight', $opt);
				}else {delete_option('epic_h4_weight');}
				
				
			/* Header 5 */		
			if(isset($_POST["fee-h5-size"])){
					$fontsize = $_POST["fee-h5-size"];
					update_option('epic_h5_size', $fontsize);
				}
				
			if(isset($_POST["fee-h5-color"])){
					$fontsize = $_POST["fee-h5-color"];
					update_option('epic_h5_color', $fontsize);
				}
			
			if(isset($_POST["epic_h5_weight"])){
					$opt = $_POST["epic_h5_weight"];
					update_option('epic_h5_weight', $opt);
				}else {delete_option('epic_h5_weight');}
				
			/* Header 6 */		
			if(isset($_POST["fee-h6-size"])){
					$fontsize = $_POST["fee-h6-size"];
					update_option('epic_h6_size', $fontsize);
				}
				
			if(isset($_POST["fee-h6-color"])){
					$opt = $_POST["fee-h6-color"];
					update_option('epic_h6_color', $opt);
				}
				
			if(isset($_POST["epic_h6_weight"])){
					$opt = $_POST["epic_h6_weight"];
					update_option('epic_h6_weight', $opt);
				}else {delete_option('epic_h6_weight');}
				
			
			/* Body text */		
			if(isset($_POST["fee-p-size"])){
					$opt = $_POST["fee-p-size"];
					update_option('epic_p_size', $opt);
				}
				
			if(isset($_POST["fee-p-color"])){
					$opt = $_POST["fee-p-color"];
					update_option('epic_p_color', $opt);
				}
				
			if(isset($_POST["epic_p_weight"])){
					$opt = $_POST["epic_p_weight"];
					update_option('epic_p_weight', $opt);
				}else {delete_option('epic_p_weight');}

			
	
		}
		
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field']),'fee_process_nonce_modulesettings')){
		
			if(isset($_POST["pageorder"])){
				$pageorder = $_POST["pageorder"];
				$pageorder = str_replace(",,", ",",  $pageorder);
				$pageorder = rtrim($pageorder, ",");
				update_post_meta($post_id,'epic_pageorder', $pageorder);
			}
		}
		
		
	if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_tickermodule']),'fee_process_nonce')){
			
			$options = array(
				
				'epic_tickermodule_posts',
				'epic_tickermodule_effect',
				'epic_tickermodule_speed',
				'epic_tickermodule_style',
				'epic_tickermodule_margin'
				);
					
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}			
		}
		
		/* Save testimonial module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_testimonialmodule']),'fee_process_nonce')){
			
			$options = array(
				
				'epic_testimonialmodule_header',
				'epic_testimonialmodule_description',
				'epic_testimonialmodule_effect',
				'epic_testimonialmodule_speed',
				'epic_testimonialmodule_style',
				'epic_testimonialmodule_margin',
				'epic_testimonialmodule_posts'
				);
					
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}			
		}


		/* Social media module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_socialmediamodule']),'fee_process_nonce')){
			
			$options = array(
				'epic_socialmediamodule_header',
				'epic_socialmediamodule_description',
				'epic_socialmediamodule_textalign',
				'epic_socialmediamodule_style',
				'epic_socialmediamodule_margin',
				'epic_socialmediamodule_icons'
				);
					
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}			
		}


		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field']),'fee_process_nonce_imagessettings')){
		
			/* Image sizes  */
			
			if(isset($_POST["epic_thumbnail_featured_image_height"])){
					$opt = $_POST["epic_thumbnail_featured_image_height"];
					update_option('epic_thumbnail_featured_image_height', $opt);
			}

			
			if(isset($_POST["epic_thumbnail_slideshowfullwidth_image_height"])){
					$opt = $_POST["epic_thumbnail_slideshowfullwidth_image_height"];
					update_option('epic_thumbnail_slideshowfullwidth_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_slideshowregular_image_height"])){
					$opt = $_POST["epic_thumbnail_slideshowregular_image_height"];
					update_option('epic_thumbnail_slideshowregular_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_galleryfullwidth_image_height"])){
					$opt = $_POST["epic_thumbnail_galleryfullwidth_image_height"];
					update_option('epic_thumbnail_galleryfullwidth_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_galleryregular_image_height"])){
					$opt = $_POST["epic_thumbnail_galleryregular_image_height"];
					update_option('epic_thumbnail_galleryregular_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_900_image_height"])){
					$opt = $_POST["epic_thumbnail_900_image_height"];
					update_option('epic_thumbnail_900_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_590_image_height"])){
					$opt = $_POST["epic_thumbnail_590_image_height"];
					update_option('epic_thumbnail_590_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_430_image_height"])){
					$opt = $_POST["epic_thumbnail_430_image_height"];
					update_option('epic_thumbnail_430_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_280_image_height"])){
					$opt = $_POST["epic_thumbnail_280_image_height"];
					update_option('epic_thumbnail_280_image_height', $opt);
			}
			
			if(isset($_POST["epic_thumbnail_210_image_height"])){
					$opt = $_POST["epic_thumbnail_210_image_height"];
					update_option('epic_thumbnail_210_image_height', $opt);
			} 		
    		
		}
		
		

		
		
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_headersettings']),'fee_process_nonce')){
		
			/* 	THEME OPTIONS */
			
			$options = array(
			
				// Header elements
				'epic_header_searchform',
				'epic_header_smi',
				'epic_header_textbox',
				'epic_header_textbox_x_pos',
				'epic_header_textbox_y_pos',
				'epic_header_textbox_width',
				'epic_header_textbox_height',
				'epic_header_graphic'
				);
			
			
			if(isset($_POST["epic_header_graphic"])){
					$opt = $_POST["epic_header_graphic"];
					update_option('epic_header_graphic', $opt);
				} 
			
			/* Language selector */
			
			if(isset($_POST["epic_language_selector"])){
					$opt = $_POST["epic_language_selector"];
					update_option('epic_language_selector', $opt);
				} else {delete_option('epic_language_selector');}
				
			if(isset($_POST["epic_wpml_x_pos"])){
					$opt = $_POST["epic_wpml_x_pos"];
					update_option('epic_wpml_x_pos', $opt);
				} else {delete_option('epic_wpml_x_pos');}
				
			if(isset($_POST["epic_wpml_y_pos"])){
					$opt = $_POST["epic_wpml_y_pos"];
					update_option('epic_wpml_y_pos', $opt);
				} else {delete_option('epic_wpml_y_pos');}
			
		
				
			/* Buddypress menu */	
			if(isset($_POST["epic_bp_admin_menu"])){
					$opt = $_POST["epic_bp_admin_menu"];
					update_option('epic_bp_admin_menu', $opt);
				} else {delete_option('epic_bp_admin_menu');}
			
			if(isset($_POST["epic_bp_menu_x_pos"])){
					$opt = $_POST["epic_bp_menu_x_pos"];
					update_option('epic_bp_menu_x_pos', $opt);
				} else {delete_option('epic_bp_menu_x_pos');}
				
			if(isset($_POST["epic_bp_menu_y_pos"])){
					$opt = $_POST["epic_bp_menu_y_pos"];
					update_option('epic_bp_menu_y_pos', $opt);
				} else {delete_option('epic_bp_menu_y_pos');}
			
			/* Logo position */
			
			if(isset($_POST["logo-x-pos"])){
					$logo_x_pos = $_POST["logo-x-pos"];
					update_option('epic_logo_x_pos', $logo_x_pos);
				}
				
			if(isset($_POST["logo-y-pos"])){
					$logo_y_pos = $_POST["logo-y-pos"];
					update_option('epic_logo_y_pos', $logo_y_pos);
				}
				
			/* Secondary menu position */
			
			if(isset($_POST["secondary-x-pos"])){
					$secondary_x_pos = $_POST["secondary-x-pos"];
					update_option('epic_secondary_x_pos', $secondary_x_pos);
				}
				
			if(isset($_POST["secondary-y-pos"])){
					$secondary_y_pos = $_POST["secondary-y-pos"];
					update_option('epic_secondary_y_pos', $secondary_y_pos);
				}
				
			/* Primary menu position */
			
			if(isset($_POST["epic_primary_x_pos"])){
					$opt = $_POST["epic_primary_x_pos"];
					update_option('epic_primary_x_pos', $opt);
				}
				
			if(isset($_POST["epic_primary_y_pos"])){
					$opt = $_POST["epic_primary_y_pos"];
					update_option('epic_primary_y_pos', $opt);
				}
				
			/* Searchform position */
			
			if(isset($_POST["epic_searchform_x_pos"])){
					$opt = $_POST["epic_searchform_x_pos"];
					update_option('epic_searchform_x_pos', $opt);
				}
				
			if(isset($_POST["epic_searchform_y_pos"])){
					$opt = $_POST["epic_searchform_y_pos"];
					update_option('epic_searchform_y_pos', $opt);
				}
				
			/* Socialmedia position */
			
			if(isset($_POST["socialmedia-x-pos"])){
					$socialmedia_x_pos = $_POST["socialmedia-x-pos"];
					update_option('epic_socialmedia_x_pos', $socialmedia_x_pos);
				}
				
			if(isset($_POST["socialmedia-y-pos"])){
					$socialmedia_y_pos = $_POST["socialmedia-y-pos"];
					update_option('epic_socialmedia_y_pos', $socialmedia_y_pos);
				}
				
			/* Header height */
			
			if(isset($_POST["header-height"])){
					$headerheight = $_POST["header-height"];
					update_option('epic_header_height', $headerheight);
				}	
				
			/*			
			if(isset($_POST["articlewidth"])){
				$value = $_POST["articlewidth"];
				update_option('epic_articlewidth', $value);
			}
			*/
			
		
			/* Header sections */
			if(isset($_POST["epic_header_searchform"])){
					$opt = $_POST["epic_header_searchform"];
					update_option('epic_header_searchform', $opt);
			}else{  delete_option('epic_header_searchform');}
			
			if(isset($_POST["epic_header_smi"])){
					$opt = $_POST["epic_header_smi"];
					update_option('epic_header_smi', $opt);
			}else{  delete_option('epic_header_smi');}
			
			if(isset($_POST["epic_header_textbox"])){
					$opt = $_POST["epic_header_textbox"];
					update_option('epic_header_textbox', $opt);
			}else{  delete_option('epic_header_textbox');}	
			
			/* Header text box size and position */
			
			if(isset($_POST["epic_header_text"])){
					$opt = $_POST["epic_header_text"];
					update_option('epic_header_text', $opt);
			}else{  delete_option('epic_header_text');}
			
			if(isset($_POST["epic_header_textbox_x_pos"])){
					$opt = $_POST["epic_header_textbox_x_pos"];
					update_option('epic_header_textbox_x_pos', $opt);
			}else{  delete_option('epic_header_textbox_x_pos');}	
			
			if(isset($_POST["epic_header_textbox_y_pos"])){
					$opt = $_POST["epic_header_textbox_y_pos"];
					update_option('epic_header_textbox_y_pos', $opt);
			}else{  delete_option('epic_header_textbox_y_pos');}	
			
			if(isset($_POST["epic_header_textbox_width"])){
					$opt = $_POST["epic_header_textbox_width"];
					update_option('epic_header_textbox_width', $opt);
			}else{  delete_option('epic_header_textbox_width');}
			
			if(isset($_POST["epic_header_textbox_height"])){
					$opt = $_POST["epic_header_textbox_height"];
					update_option('epic_header_textbox_height', $opt);
			}else{  delete_option('epic_header_textbox_height');}	
			
							
			/* Site logo */
			
			if(isset($_POST["upload_logo"])){
				$opt = $_POST["upload_logo"];
				update_option('epic_logo_url', $opt);
			
			}
				
			if(isset($_POST["bottommargin"])){
				$bottommargin = $_POST["bottommargin"];
				update_option('epic_wrapper_margin_bottom', $bottommargin);
			}
			
			if(isset($_POST["topmargin"])){
				$topmargin = $_POST["topmargin"];
				update_option('epic_wrapper_margin_top', $topmargin);
			}
			
						
		}
		
		
		/* Save footer settings */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_footersettings']),'fee_save_nonce')){
		
			
			
			
			if(isset($_POST["epic_footer_credits"])){
				$opt = $_POST["epic_footer_credits"];
				update_option('epic_footer_credits', $opt);
			}	else{delete_option('epic_footer_credits');}

				
		}
		
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_teaserpages']),'fee_process_nonce')){
			
			// Save teaser-pages module
			
			if(isset($_POST["epic_home_teasers_header"])){
				$teasers_title = $_POST["epic_home_teasers_header"];
				update_post_meta($post_id,'epic_home_teasers_header', $teasers_title);
			}	else{delete_post_meta($post_id,'epic_home_teasers_header');}
			
			if(isset($_POST["epic_home_teasers_textalign"])){
				$teasers_title = $_POST["epic_home_teasers_textalign"];
				update_post_meta($post_id,'epic_home_teasers_textalign', $teasers_title);
			}	else{delete_post_meta($post_id,'epic_home_teasers_textalign');}
			
			if(isset($_POST["epic_home_teasers_description"])){
				$teasers_description = $_POST["epic_home_teasers_description"];
				update_post_meta($post_id,'epic_home_teasers_description', stripslashes($teasers_description));
			}	else{delete_post_meta($post_id,'epic_home_teasers_description');}
			
			if(isset($_POST["epic_home_teasers_pages"])){
				$teasers_pageorder = $_POST["epic_home_teasers_pages"];
				update_post_meta($post_id,'epic_home_teasers_pages', $teasers_pageorder);
			}	else{delete_post_meta($post_id,'epic_home_teasers_pages');}
			
			if(isset($_POST["epic_home_teaserpages_style"])){
				$opt = $_POST["epic_home_teaserpages_style"];
				update_post_meta($post_id,'epic_home_teaserpages_style', stripslashes($opt));
			}	else{delete_post_meta($post_id,'epic_home_teaserpages_style');}

			if(isset($_POST["epic_home_teaserpages_margin"])){
				$opt = $_POST["epic_home_teaserpages_margin"];
				update_post_meta($post_id,'epic_home_teaserpages_margin', stripslashes($opt));
			}	else{delete_post_meta($post_id,'epic_home_teaserpages_margin');}
			
	
		
		}
		
		/* Slider module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_slidermodule']),'fee_process_nonce_slidermodule')){
		
			
			$options = array(
				'epic_slidermodule_header',
				'epic_slidermodule_description',
				'epic_slidermodule_sidebar',
				'epic_slidermodule_style',
				'epic_post_slideshowcat',
				'epic_post_slideshowtype',
				'epic_cycle_effect',
				'epic_cycle_interval',
				'epic_cycle_nav',
				'epic_cycle_layout',
				'epic_slidermodule_margin'
				);
			
				foreach ($options as $option){
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, stripslashes($opt));
				}else{ delete_post_meta($post_id,$option);}
			}
		}
		
		
		/* Search module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_searchmodule']),'fee_save_nonce')){
		
			
			$options = array(
				'epic_searchmodule_header',
				'epic_searchmodule_description',
				);
			
				foreach ($options as $option){
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, stripslashes($opt));
				}else{ delete_post_meta($post_id,$option);}
			}
		}
		
		/* Teaser 1 module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_teaser_1']),'fee_process_nonce')){	
					
			
			
			if(isset($_POST["teaser-1-teaser"])){
				$teaser_1_teaser = $_POST["teaser-1-teaser"];
				update_post_meta($post_id,'epic_home_teaser_1', $teaser_1_teaser);
			}	else{delete_post_meta($post_id,'epic_home_teaser_1');}
			
			if(isset($_POST["epic_home_teaser_1_style"])){
				$teaser_1_style = $_POST["epic_home_teaser_1_style"];
				update_post_meta($post_id,'epic_home_teaser_1_style', stripslashes($teaser_1_style));
			}	else{delete_post_meta($post_id,'epic_home_teaser_1_style');}
			
			if(isset($_POST["epic_home_teaser_1_margin"])){
				$opt = $_POST["epic_home_teaser_1_margin"];
				update_post_meta($post_id,'epic_home_teaser_1_margin', stripslashes($opt));
			}	else{delete_post_meta($post_id,'epic_home_teaser_1_margin');}
			
		}

		
		
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_teaser_2']),'fee_process_nonce')){	

			/* Teaser 2 module */
			
			if(isset($_POST["teaser-2-teaser"])){
				$teaser_2_teaser = $_POST["teaser-2-teaser"];
				update_post_meta($post_id,'epic_home_teaser_2', $teaser_2_teaser);
			}	else{delete_post_meta($post_id,'epic_home_teaser_2');}
			
			if(isset($_POST["epic_home_teaser_2_style"])){
				$teaser_2_style = $_POST["epic_home_teaser_2_style"];
				update_post_meta($post_id,'epic_home_teaser_2_style', stripslashes($teaser_2_style));
			}	else{delete_post_meta($post_id,'epic_home_teaser_2_style');}
			
			if(isset($_POST["epic_home_teaser_2_margin"])){
				$opt = $_POST["epic_home_teaser_2_margin"];
				update_post_meta($post_id,'epic_home_teaser_2_margin', stripslashes($opt));
			}	else{delete_post_meta($post_id,'epic_home_teaser_2_margin');}
		}
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_teaser_3']),'fee_process_nonce')){	
			
			/* Teaser 3 module */
			
			if(isset($_POST["teaser-3-teaser"])){
				$teaser_3_teaser = $_POST["teaser-3-teaser"];
				update_post_meta($post_id,'epic_home_teaser_3', $teaser_3_teaser);
			}	else{ delete_post_meta($post_id,'epic_home_teaser_3');}
			
			if(isset($_POST["epic_home_teaser_3_style"])){
				$teaser_3_style = $_POST["epic_home_teaser_3_style"];
				update_post_meta($post_id,'epic_home_teaser_3_style', stripslashes($teaser_3_style));
			}	else{ delete_post_meta($post_id,'epic_home_teaser_3_style');}
			
			if(isset($_POST["epic_home_teaser_3_margin"])){
				$opt = $_POST["epic_home_teaser_3_margin"];
				update_post_meta($post_id,'epic_home_teaser_3_margin', stripslashes($opt));
			}	else{delete_post_meta($post_id,'epic_home_teaser_3_margin');}
						
		}
		
		
		// Save featured pages module
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_featuredpages']),'fee_process_nonce')){
		
			$options = array(
				
				'epic_featuredmodule_header',
				'epic_featuredmodule_textalign',
				'epic_featuredmodule_description',
				'epic_featuredmodule_pages',
				'epic_featuredmodule_style',
				'epic_featuredmodule_margin',
				'epic_featuredmodule_image',
				'epic_featuredmodule_excerptlimit'
				);
			
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}			
			
		}
		
		
		/* Save featured pages module 2 */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_featuredpages_2']),'fee_save_nonce')){
					
			$options = array(
				
				'epic_featuredmodule_2_header',
				'epic_featuredmodule_2_textalign',
				'epic_featuredmodule_2_description',
				'epic_featuredmodule_2_pages',
				'epic_featuredmodule_2_style',
				'epic_featuredmodule_2_margin',
				'epic_featuredmodule_2_image',
				'epic_featuredmodule_excerptlimit'
				);
			
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}			
		}
		
		
		/* Save title module */		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_titlemodule']),'fee_process_nonce')){
		
			if(isset($_POST['epic_titlemodule_title'])){
				$posttitle = $_POST['epic_titlemodule_title'];
			}
			
			$my_post = array();
  			$my_post['ID'] = $post_id;
  			
  			if($posttitle){
				$my_post['post_title'] = $posttitle; 
			}
			
			// Update the post into the database
 			 wp_update_post( $my_post );

			
			$options = array(
				'epic_titlemodule_breadcrumb',
				'epic_titlemodule_searchform',
				'epic_titlemodule_subtitle',
				'epic_titlemodule_description',
				'epic_titlemodule_style',
				'epic_titlemodule_margin'
				);
		
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}
			
			
		}

		
		/* Save Blog module */		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_blogmodule']),'fee_process_nonce')){
		
			$options = array(
				
				'epic_blogmodule_header',
				'epic_blogmodule_description',
				'epic_blogmodule_textalign',
				'epic_blogmodule_categories',
				'epic_blogmodule_style',
				'epic_blogmodule_margin',
				'epic_blogmodule_perpage',
				'epic_blogmodule_image',
				'epic_blogmodule_sidebar',
				'epic_blogmodule_layout',
				'epic_blogmodule_liststyle',
				'epic_blogmodule_slider',
				'epic_blogmodule_effect',
				'epic_blogmodule_excerpt',
				'epic_blogmodule_pagination'
				);
		
			foreach ($options as $option){
				
				if(isset($_POST[$option])){
				$opt = $_POST[$option];
				update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}		
		}
		
		/* Save Portfolio module */
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_portfoliomodule']),'fee_process_nonce')){
		
			$options = array(
				'epic_portfoliomodule_header',
				'epic_portfoliomodule_description',
				'epic_portfoliomodule_textalign',
				'epic_portfoliomodule_type',
				'epic_portfoliomodule_ajax',
				'epic_portfoliomodule_columns',
				'epic_portfoliomodule_excerpt',
				'epic_portfoliomodule_excerpt_limit',
				'epic_portfoliomodule_showcategories',
				'epic_portfoliomodule_perpage',
				'epic_portfoliomodule_filter',
				'epic_portfoliomodule_pagination',
				'epic_portfoliomodule_categories',
				'epic_portfoliomodule_slider',
				'epic_portfoliomodule_effect',
				'epic_portfoliomodule_order'
				);
			
				foreach ($options as $option){
					if(isset($_POST[$option])){
					$opt = $_POST[$option];
					update_post_meta($post_id,$option, stripslashes($opt));
					}else{ delete_post_meta($post_id,$option);}
				}

			}
		
		/* Page content module */
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_contentmodule']),'fee_process_nonce')){
			
			if(isset($_POST['epic_page_title'])){
				$posttitle = $_POST['epic_page_title'];
			}
			if(isset($_POST['epic_page_excerpt'])){
				$postexcerpt = $_POST['epic_page_excerpt'];
			}
			
			if(isset($_POST['epic_page_content'])){
				$postcontent = $_POST['epic_page_content'];
			}
						
			$my_post = array();
  			$my_post['ID'] = $post_id;
  			
  			if($posttitle){
				$my_post['post_title'] = $posttitle; 
			}
			if($postexcerpt){
				$my_post['post_excerpt'] = $postexcerpt; 
			}
			
			if($postcontent){
				$my_post['post_content'] = $postcontent; 
			}
			
			

			// Update the post into the database
 			 wp_update_post( $my_post );	
 			 
 			// Update the post-format
 			 if(isset($_POST['epic_post_format'])){
				$format = $_POST['epic_post_format'];
			}
  			
  			set_post_format( $post_id , $format);
			
			
			$options = array(
				'epic_layout',
				'epic_sidebar',
				'epic_pagemodule_margin',
				'epic_pagemodule_style',
				'epic_media_size'
				);
				
			foreach ($options as $option){
		
				if(isset($_POST[$option])){
					$opt = $_POST[$option];
					update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}
			
			
    	}
		
		/* Widget module */
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_widgetmodule']),'fee_process_nonce')){

		
			if(isset($_POST["epic_widgetmodule_sidebar"])){
				$opt = $_POST["epic_widgetmodule_sidebar"];
				update_post_meta($post_id,'epic_widgetmodule_sidebar', $opt);
			}else{ delete_post_meta($post_id,'epic_widgetmodule_sidebar');}
			
			if(isset($_POST["epic_widgetmodule_style"])){
				$opt = $_POST["epic_widgetmodule_style"];
				update_post_meta($post_id,'epic_widgetmodule_style', $opt);
			}else{ delete_post_meta($post_id,'epic_widgetmodule_style');}
			
			if(isset($_POST["epic_widgetmodule_margin"])){
				$opt = $_POST["epic_widgetmodule_margin"];
				update_post_meta($post_id,'epic_widgetmodule_margin', $opt);
			}else{ delete_post_meta($post_id,'epic_widgetmodule_margin');}
				
		}
		
		/* Twitter module */
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_twittermodule']),'fee_save_nonce')){

		
			if(isset($_POST["epic_twittermodule_username"])){
				$opt = $_POST["epic_twittermodule_username"];
				update_option('epic_twittermodule_username', $opt);
			}else{ delete_option('epic_twittermodule_username');}
			
							
		}
		
		/* Video module */
		
		if(isset($_POST["action"]) && $_POST["action"] == "saved" && wp_verify_nonce(isset($_POST['fee_nonce_field_videomodule']),'fee_process_nonce')){

		$videosettings = array(
		
				'epic_video_preview',
				'epic_video_host',
				'epic_video_url_m4v',
				'epic_video_url_ogv',
				'epic_video_url_webmv',
				'epic_video_width',
				'epic_video_height',
				'epic_video_id_vimeo',
				'epic_video_id_youtube',
				'epic_videomodule_style',
				'epic_videomodule_margin'
		
				);
			
			foreach ($videosettings as $option){
		
				if(isset($_POST[$option])){
					$opt = $_POST[$option];
					update_post_meta($post_id,$option, $opt);
				}else{ delete_post_meta($post_id,$option);}
			}
			
					
		}		

		epic_create_stylesheet();
		
	}

}

/** Add necessary scripts and css */
function fee_addscripts(){
	global $current_user, $wp_roles;
	
	get_currentuserinfo();
	

	
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false){	
		wp_enqueue_script('epic_editor_scripts', 	get_template_directory_uri().'/library/admin/frontend_editor/script.js');
		//echo '<script type="text/javascript" src="'.get_template_directory_uri().'/library/admin/frontend_editor/script.js"></script>';
		echo '<script type="text/javascript" src="'.get_template_directory_uri().'/library/admin/js/colorpicker.js"></script>';
		echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri().'/library/admin/css/colorpicker.css"/>';
		echo '<link rel="stylesheet" type="text/css" href="'. get_template_directory_uri().'/library/admin/frontend_editor/frontend_editor.css"/>';
	}

}



if(EPIC_FRONTEND_EDITOR == false ){

add_action('wp_head','fee_addscripts');
add_action('wp_head','fee_process');
add_action('wp_footer','epic_frontend_editor');
}
?>