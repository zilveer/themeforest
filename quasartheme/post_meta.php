<?php

// Hook into WordPress
add_action( 'admin_init', 'rockthemes_ad_add_custom_metabox' );

/**
 * Add meta box
 */
function rockthemes_ad_add_custom_metabox() {
	
	$post_types = array('post','page','quasarproducts');
	
	//If WooCommerce Activated, add it's product type to the $post_types
	if(rockthemes_woocommerce_active()) $post_types[] = 'product';
	
	//This will include the sidebar
	foreach ($post_types as $type) 
    {
		add_meta_box( 'rockthemes_post_details',  'Advanced Details' , 'rockthemes_post_details_metabox', $type, 'normal', 'default' );
    }	
	
	add_meta_box('rockthemes_gallery_details', 'Gallery Details', 'rockthemes_gallery_details_metabox', 'quasargallery', 'normal', 'default');	
	
	return;

}

/*
**	Custom Sidebar Metabox
*/
function rockthemes_post_details_metabox() {
	global $post;
	$custom_sidebar = get_post_meta($post->ID,'custom_sidebar_list',true);
	$rockthemes_advanced_post_details = get_post_meta($post->ID,'advanced_post_details',true);
		
	$ajax_filtered_thumbnail = '';
	$ajax_filtered_hover_box_image = '';
	$extra_featured_images = '';
	$extra_buttons = '';
	$video_iframe_code = '';
	
	if($rockthemes_advanced_post_details) extract($rockthemes_advanced_post_details);
	
	//Extra featured images
	$extra_featured_images_counter = 0;
	$extra_featured_images_html = '';
	if($extra_featured_images){

		foreach($extra_featured_images as $featured_image){

			$extra_featured_images_html .= '
				<div class="extra_featured_image_class" ref="'.$extra_featured_images_counter.'">
					<strong>Choose an Image : </strong><br/><br/>
					<div class="hide image-data"></div>
					<label for="upload_image"> 
						<input id="extra_featured_image'.$extra_featured_images_counter.'" class="upload_image_button" size="36" name="advanced_post_details[extra_featured_images]['.$extra_featured_images_counter.']" type="text" value="'.$featured_image.'" /> 
						<input class="image_uploader_class btn" value="Upload Image" type="button" /> 
					</label>
					<br/>
					<div class="button extra_featured_images_remove_button">Remove Image</div>
				</div>
				<br/>
			';
			$extra_featured_images_counter++;

		}
	}else{
		$extra_featured_images_html ='
			<div class="extra_featured_image_class" ref="'.$extra_featured_images_counter.'">
				<strong>Choose an Image : </strong><br/><br/>
				<div class="hide image-data"></div>
				<label for="upload_image"> 
					<input id="extra_featured_image'.$extra_featured_images_counter.'" class="upload_image_button" size="36" name="advanced_post_details[extra_featured_images]['.$extra_featured_images_counter.']" type="text" value="" /> 
					<input class="image_uploader_class btn" value="Upload Image" type="button" /> 
				</label>
				<br/>
				<div class="button extra_featured_images_remove_button">Remove Image</div>
			</div>
			<br/>
		';
		
		$extra_featured_images_counter++;
	}
	
	$extra_featured_images_script = '
		jQuery(document).on("click",".extra_featured_images_remove_button", function(){
			jQuery(this).parent().remove();
		});
		
		jQuery(document).on("click", ".extra_featured_images_add_button", function(){
			var id = 0;
			if(jQuery(".extra_featured_image_class").length){
				id = parseInt(jQuery(".extra_featured_image_class").last().attr("ref"))+1;
			}
			
			var new_elem = "<div class=\"extra_featured_image_class\" ref=\""+id+"\">"+
				"<strong>Choose an Image : </strong><br/><br/>"+
				"<div class=\"hide image-data\"></div>"+
				"<label for=\"upload_image\"> "+
					"<input id=\"extra_featured_image"+id+"\" class=\"upload_image_button\" size=\"36\" name=\"advanced_post_details[extra_featured_images]["+id+"]\" type=\"text\" value=\"\" /> "+
					"<input class=\"image_uploader_class btn\" value=\"Upload Image\" type=\"button\" /> "+
				"</label>"+
				"<br/>"+
				"<div class=\"button extra_featured_images_remove_button\">Remove Image</div>"+
			"</div>";

			
			jQuery(".extra_featured_image_holder").append(new_elem);
		});
	';
	
	
	$extra_buttons_html = '
		<div class="extra_button_class" ref="0">
			<input id="extra-button-data-0" type="hidden" name="advanced_post_details[extra_button_json_data][0]" value="" />
			<input id="extra-button-0" name="advanced_post_details[extra_buttons][0]" type="text" value="" /><div class="advanced_empty_a advanced_details_make_button_modal" id_ref="extra-button-0" id_data_ref="extra-button-data-0">Add / Edit Button</div>
			<a class="advanced_empty_a extra_button_remove_button">Remove Button</a>
		</div>
	';
	$extra_button_counter = 0;
	if($extra_buttons && $extra_buttons[0] != ''){
		$extra_buttons_html = '';
		foreach($extra_buttons as $extra_button){
			$extra_button_json_data = isset($rockthemes_advanced_post_details['extra_button_json_data']) && !empty($rockthemes_advanced_post_details['extra_button_json_data'][$extra_button_counter]) ? esc_attr($rockthemes_advanced_post_details['extra_button_json_data'][$extra_button_counter]) : '';
			
			$extra_buttons_html .= '
				<div class="extra_button_class" ref="'.$extra_button_counter.'">
					<input id="extra-button-data-'.$extra_button_counter.'" type="hidden" name="advanced_post_details[extra_button_json_data]['.$extra_button_counter.']" value="'.$extra_button_json_data.'" />
					<input id="extra-button-'.$extra_button_counter.'" name="advanced_post_details[extra_buttons]['.$extra_button_counter.']" type="text" value="'.esc_attr($extra_button).'" /><a class="advanced_empty_a advanced_details_make_button_modal" id_ref="extra-button-'.$extra_button_counter.'" id_data_ref="extra-button-data-'.$extra_button_counter.'">Add / Edit Button</a> | 
					<a class="advanced_empty_a extra_button_remove_button">Remove Button</a>
				</div>
			';
			$extra_button_counter++;
		}
	}
	
	$extra_buttons_script = '
		jQuery(document).on("click",".extra_button_remove_button", function(){
			jQuery(this).parent().remove();
		});
		
		jQuery(document).on("click", ".extra_button_add_button", function(){
			var id = 0;
			if(jQuery(".extra_button_class").length){
				id = parseInt(jQuery(".extra_button_class").last().attr("ref"))+1;
			}
			
			var new_elem = "<div class=\"extra_button_class\" ref=\""+id+"\">"+
					"<input id=\"extra-button-data-"+id+"\" type=\"hidden\" name=\"advanced_post_details[extra_button_json_data]["+id+"]\" value=\"\" />"+
					"<input id=\"extra-button-"+id+"\" name=\"advanced_post_details[extra_buttons]["+id+"]\" type=\"text\" value=\"\" /><a class=\"advanced_empty_a advanced_details_make_button_modal\" id_ref=\"extra-button-"+id+"\" id_data_ref=\"extra-button-data-"+id+"\">Add / Edit Button</a> | "+ 
					"<a class=\"advanced_empty_a extra_button_remove_button\">Remove Button</a>"+
				"</div>";

			
			jQuery(".extra_buttons_container").append(new_elem);
		});
	';
	
	
	
	echo '<div class="rockthemes-post-advanced-details">';//Main Container
	
	echo '
		<br/>
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-film"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Lightbox Video (PrettyPhoto Video)</strong><br/>
				<p>You can enter your Youtube / Vimeo video link.</p>
			</div>
			<div class="span5">
				<textarea class="" name="advanced_post_details[video_iframe_code]" rows="4">'.$video_iframe_code.'</textarea>
			</div>
		</div>
		<hr />

		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-columns"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Choose a Sidebar</strong><br/>
				<p>Choose your sidebar. If you do not have any sidebar, you can quickly add sidebars by clicking to "Add New Sidebar" button. If you don\'t want to use sidebar leave it empty.</p>
			</div>
			<div class="span5">
				'.rockthemes_pb_get_custom_sidebars_dropdown($custom_sidebar,false).'
			</div>
		</div>
		<hr />
		
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-link"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Extra Button for Portfolio List</strong><br/>
				<p>You can add extra button for Portfolio List. This button will only show up in the Portfolio List.</p>
				<div class="button extra_button_add_button"><i class="fa fa-plus"></i> Add Extra Button</div>
			</div>
			<div class="span5 extra_buttons_container">
				'.$extra_buttons_html.'
			</div>
		</div>
		<hr/>
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-picture-o"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Ajax Filtered Portfolio Thumbnail</strong><br/>
				<p>Ajax Filtered Portfolio works best with square images (Images with same width and height value). You can change this thumbnail size in Theme Options. Here are your current Ajax Filtered Thumbnail details : <br/><br/>
				<strong>Width : </strong>'.xr_get_option('rockthemes_ajaxfiltered_thumbnail_width','125px').'<br/><strong>Height : </strong>'.xr_get_option('rockthemes_ajaxfiltered_thumbnail_height','125px').'</p>
			</div>
			<div class="span5">
				<div class="ajax_filtered_thumbnail" ref="icon-image-uploader">
					<strong>Choose an Image : </strong><br/><br/>
					<div class="hide image-data"></div>
					<label for="upload_image"> <input id="ajax_filtered_thumbnail" class="upload_image_button" size="36" name="advanced_post_details[ajax_filtered_thumbnail]" type="text" value="'.$ajax_filtered_thumbnail.'" /> <input class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
				</div>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-picture-o"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Ajax Filtered Hover Box Image</strong><br/>
				<p>If you use Ajax Filtered Portfolio with Hover Box effect, you can upload a special image that fits your image size. Your current image sizes area : <br/><br/>
				<strong>Width : </strong>'.xr_get_option('ajax_filtered_hover_width','590px').'<br/><strong>Height : </strong>'.xr_get_option('ajax_filtered_hover_height','300px').'</p>
			</div>
			<div class="span5">
				<div class="ajax_filtered_hover_box_image" ref="icon-image-uploader">
					<strong>Choose an Image : </strong><br/><br/>
					<div class="hide image-data"></div>
					<label for="upload_image"> <input id="ajax_filtered_hover_box_image" class="upload_image_button" size="36" name="advanced_post_details[ajax_filtered_hover_box_image]" type="text" value="'.$ajax_filtered_hover_box_image.'" /> <input class="image_uploader_class btn" value="Upload Image" type="button" /> </label><br/>
				</div>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-picture-o"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Extra Featured Image</strong><br/>
				<p>You can add up to 5 featured images. You can add new images by clicking to "Add Featured Image" button.</p><br/>
				<div class="button extra_featured_images_add_button"><i class="fa fa-plus"></i> Add Featured Image</div>
			</div>
			<div class="span5 extra_featured_image_holder">
				'.$extra_featured_images_html.'
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-terminal"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Disable Breadcrumbs / Title Area</strong><br/>
				<p>If you want to disable the Header Title and Breadcrumbs area, choose disable</p><br/>
			</div>
			<div class="span5">
				<select autocomplete="off" name="advanced_post_details[disable_title_breadcrumbs_area]">
					<option value="false" '.(isset($rockthemes_advanced_post_details['disable_title_breadcrumbs_area']) && $rockthemes_advanced_post_details['disable_title_breadcrumbs_area'] === 'false' ? 'selected' : '').'>Do Not Disable Area</option>
					<option value="true" '.(isset($rockthemes_advanced_post_details['disable_title_breadcrumbs_area']) && $rockthemes_advanced_post_details['disable_title_breadcrumbs_area'] === 'true' ? 'selected' : '').'>Disable Area</option>
				</select>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-resize-vertical"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Space Between Header and Footer</strong><br/>
				<p>This option will add extra vertical space under header and top of the footer.</p><br/>
			</div>
			<div class="span5">
				<select autocomplete="off" name="advanced_post_details[activate_space_under_menu]">
					<option value="true" '.(isset($rockthemes_advanced_post_details['activate_space_under_menu']) && $rockthemes_advanced_post_details['activate_space_under_menu'] === 'true' ? 'selected' : '').'>Add Vertical Space</option>
					<option value="false" '.(isset($rockthemes_advanced_post_details['activate_space_under_menu']) && $rockthemes_advanced_post_details['activate_space_under_menu'] === 'false' ? 'selected' : '').'>Do Not Add Vertical Space</option>
				</select>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-archive"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Display Footer Large Area</strong><br/>
				<p>If you choose default, your choice in Theme Options for footer large area will be used.</p><br/>
			</div>
			<div class="span5">
				<select autocomplete="off" name="advanced_post_details[display_footer_large_area]">
					<option value="" '.(isset($rockthemes_advanced_post_details['display_footer_large_area']) && $rockthemes_advanced_post_details['display_footer_large_area'] === '' ? 'selected' : '').'>Default</option>
					<option value="true" '.(isset($rockthemes_advanced_post_details['display_footer_large_area']) && $rockthemes_advanced_post_details['display_footer_large_area'] === 'true' ? 'selected' : '').'>Display Footer Large Area</option>
					<option value="false" '.(isset($rockthemes_advanced_post_details['display_footer_large_area']) && $rockthemes_advanced_post_details['display_footer_large_area'] === 'false' ? 'selected' : '').'>Remove Footer Large Area</option>
				</select>
			</div>
		</div>
		<hr />
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-minus"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Display Footer Bottom Area</strong><br/>
				<p>If you choose default, your choice in Theme Options for footer bottom area will be used.</p><br/>
			</div>
			<div class="span5">
				<select autocomplete="off" name="advanced_post_details[display_footer_bottom_area]">
					<option value="" '.(isset($rockthemes_advanced_post_details['display_footer_bottom_area']) && $rockthemes_advanced_post_details['display_footer_bottom_area'] === '' ? 'selected' : '').'>Default</option>
					<option value="true" '.(isset($rockthemes_advanced_post_details['display_footer_bottom_area']) && $rockthemes_advanced_post_details['display_footer_bottom_area'] === 'true' ? 'selected' : '').'>Display Footer Bottom Area</option>
					<option value="false" '.(isset($rockthemes_advanced_post_details['display_footer_bottom_area']) && $rockthemes_advanced_post_details['display_footer_bottom_area'] === 'false' ? 'selected' : '').'>Remove Footer Bottom Area</option>
				</select>
			</div>
		</div>
		<hr />
		';
	
	echo '</div>'; //End of main container
	
	//Echo the scripts
	echo '
		<script type="text/javascript">
			jQuery(document).ready(function(){
				'.$extra_featured_images_script.'
				'.$extra_buttons_script.'
			});
		</script>
	';
	?>
    
   	<style type="text/css">
		.rockthemes-post-advanced-details .advanced-details-icon{
			font-size:40px;
			margin-left:10px;
			color:#666666;
		}
		
		.rockthemes-post-advanced-details .advanced_empty_a{cursor:pointer;}
		
		.rockthemes-post-advanced-details select, 
		.rockthemes-post-advanced-details input:not(.btn),
		.rockthemes-post-advanced-details textarea{
			padding:10px;
			border-radius:4px;
			color:#444444;
		}
		
		.rockthemes-post-advanced-details select{
			min-height:40px;	
		}

	</style>
    
    <?php
}

function rockthemes_ad_save_post_details_metabox( $post_id ) {
	global $post;	

	
	//Save Advanced Post Details
	if( isset($_POST['advanced_post_details'])){
		update_post_meta($post->ID, 'advanced_post_details', $_POST['advanced_post_details']);

		//Save Sidebar : This moved here to save empty sidebar choices (No sidebar chosen, Sidebar will be setted via general not strict) 
		if(isset($_POST['custom_sidebar_list'])){
			update_post_meta( $post->ID, 'custom_sidebar_list', $_POST['custom_sidebar_list'] );
		}
	}
}

add_action( 'save_post', 'rockthemes_ad_save_post_details_metabox' );

function rockthemes_ad_get_post_details_metabox(){
	global $post, $rockthemes_advanced_details, $wp_query;
	
	if(is_archive()) return false;
	
	$current_page_id = $wp_query->get_queried_object_id();

	$rockthemes_advanced_details = get_post_meta($current_page_id, 'advanced_post_details', true);
			
	return $rockthemes_advanced_details;
}


//Only for sidebar. This is used in the rock-widgets/load-widgets.php file.
function rockthemes_cs_get_custom_sidebar_metabox(){
	global $post;
	
	if(is_archive()) return false;
	
	$sidebar = get_post_meta(get_queried_object_id(), 'custom_sidebar_list', true);
	return $sidebar;
}






/*
**	Gallery Post Metabox
*/
function rockthemes_gallery_details_metabox(){
	global $post;
	$rockthemes_advanced_post_details = get_post_meta($post->ID,'advanced_post_details',true);
		
	$ajax_filtered_thumbnail = '';
	$ajax_filtered_hover_box_image = '';
	$extra_featured_images = '';
	$extra_buttons = '';
	$video_iframe_code = '';
	
	if($rockthemes_advanced_post_details) extract($rockthemes_advanced_post_details);
	
	//Extra featured images
	$extra_featured_images_counter = 0;
	$extra_featured_images_html = '';
	
	echo '<div class="rockthemes-post-advanced-details">';//Main Container
	echo '
		<br/>
		<div class="row-fluid">
			<div class="span1">
				<div class="advanced-details-icon">
					<i class="fa fa-film"></i>
				</div>
			</div>
			<div class="span6">
				<strong>Add Lightbox Video (PrettyPhoto Video)</strong><br/>
				<p>You can enter your Youtube / Vimeo video link. If you enter a video link here, video will play on lightbox effect instead of showing full image</p>
			</div>
			<div class="span5">
				<textarea class="" name="advanced_post_details[video_iframe_code]" rows="4" style="width:100%;">'.$video_iframe_code.'</textarea>
			</div>
		</div>
		<hr />
	';
	echo '</div>';
	
	?>
    
   	<style type="text/css">
		.rockthemes-post-advanced-details .advanced-details-icon{
			font-size:40px;
			margin-left:10px;
			color:#666666;
		}
		
		.rockthemes-post-advanced-details .advanced_empty_a{cursor:pointer;}
		
		.rockthemes-post-advanced-details select, 
		.rockthemes-post-advanced-details input:not(.btn),
		.rockthemes-post-advanced-details textarea{
			padding:10px;
			border-radius:4px;
			color:#444444;
		}
		
		.rockthemes-post-advanced-details select{
			min-height:40px;	
		}

	</style>
    
    <?php
}

function rockthemes_gallery_post_details_save( $post_id ) {
	global $post;	

	
	//Save Advanced Post Details
	if( isset($_POST['advanced_post_details'])){
		update_post_meta($post->ID, 'advanced_post_details', $_POST['advanced_post_details']);
	}
}

add_action( 'save_post', 'rockthemes_gallery_post_details_save' );
/*
function rockthemes_ad_get_post_details_metabox(){
	global $post, $rockthemes_advanced_details, $wp_query;
	
	$current_page_id = $wp_query->get_queried_object_id();

	$rockthemes_advanced_details = get_post_meta($current_page_id, 'advanced_post_details', true);
			
	return $rockthemes_advanced_details;
}
*/



?>