<?php 

global $current_user, $wp_roles, $post;

$style = epic_get_modulestyle('epic_headermodule_style');
$margin = epic_get_modulemargin('epic_headermodule_margin');
$header = get_post_meta($post->ID,'epic_headermodule_header',true);
$description = get_post_meta($post->ID,'epic_headermodule_description',true);

$epic_header_text = stripslashes(get_option('epic_header_text'));
?>

<div id="module-header" class="module module-header clearfix <?php echo $style;?> <?php echo $margin;?>">


	<?php 
	//if(is_page() || is_single()){
	
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Header');?>
		
	<div class="fee-options" id="header_options">
		<form action="" method="post">
		<p>While this window is open, all the elements in the header-section of your site can be dragged and dropped in the position you want. To save the positions, click "Save and close window".
		</p>
		<!-- Add logo -->
		<h5>Logo</h5>
		<p>
		<input type="text" class="upload-input" name="upload_logo"  id="epic_add_logo" value="<?php echo get_option('epic_logo_url') ?>"/>
		<small>Enter path to logo image, or use the image-uploader in the theme options panel</small>
		</p>
				
		<p>
					<?php
						
						$settings = array(
    					'wpautop' => true,
    					'media_buttons' => true,
    					'wpautop' => true,
    					'tinymce' => true,
    					'quicktags' => true,
    					'textarea_rows' => 14
    					);
    					
						wp_editor($epic_header_text, 'epic_header_text', $settings );
					?>
					</p>

		
		<?php
		
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
	
	
	/* Secondary menu position */
	$epic_primary_x_pos = get_option('epic_primary_x_pos');
	$epic_primary_y_pos = get_option('epic_primary_y_pos');
	
	/* Secondary menu position */
	$epic_secondary_x_pos = get_option('epic_secondary_x_pos');
	$epic_secondary_y_pos = get_option('epic_secondary_y_pos');
	
	/* Header height */	
	$epic_header_height = get_option('epic_header_height');
	?>
	
		<input type="hidden" id="epic_wpml_x_pos" name="epic_wpml_x_pos" value="<?php echo $epic_wpml_x_pos; ?>"/>
		<input type="hidden" id="epic_wpml_y_pos" name="epic_wpml_y_pos" value="<?php echo $epic_wpml_y_pos; ?>"/>
		<input type="hidden" id="socialmedia-x-pos" name="socialmedia-x-pos" value="<?php echo $epic_socialmedia_x_pos; ?>"/>
		<input type="hidden" id="socialmedia-y-pos" name="socialmedia-y-pos" value="<?php echo $epic_socialmedia_y_pos; ?>"/>
		<input type="hidden" id="epic_searchform_x_pos" name="epic_searchform_x_pos" value="<?php echo $epic_searchform_x_pos; ?>"/>
		<input type="hidden" id="epic_searchform_y_pos" name="epic_searchform_y_pos" value="<?php echo $epic_searchform_y_pos; ?>"/>
		<input type="hidden" id="epic_primary_x_pos" name="epic_primary_x_pos" value="<?php echo $epic_primary_x_pos; ?>"/>
		<input type="hidden" id="epic_primary_y_pos" name="epic_primary_y_pos" value="<?php echo $epic_primary_y_pos; ?>"/>
		<input type="hidden" id="secondary-x-pos" name="secondary-x-pos" value="<?php echo $epic_secondary_x_pos; ?>"/>
		<input type="hidden" id="secondary-y-pos" name="secondary-y-pos" value="<?php echo $epic_secondary_y_pos; ?>"/>
		<input type="hidden" id="logo-x-pos" name="logo-x-pos" value="<?php echo $epic_logo_x_pos; ?>"/>
		<input type="hidden" id="logo-y-pos" name="logo-y-pos" value="<?php echo $epic_logo_y_pos; ?>"/>
		<input type="hidden" id="header-height" name="header-height" value="<?php echo $epic_header_height; ?>"/>
		
		<input type="hidden" id="epic_header_textbox_x_pos" name="epic_header_textbox_x_pos" 	value="<?php echo $epic_header_textbox_x_pos; ?>"/>
		<input type="hidden" id="epic_header_textbox_y_pos" name="epic_header_textbox_y_pos" 	value="<?php echo $epic_header_textbox_y_pos; ?>"/>
		<input type="hidden" id="epic_header_textbox_width" name="epic_header_textbox_width" 	value="<?php echo $epic_header_textbox_width; ?>"/>
		<input type="hidden" id="epic_header_textbox_height" name="epic_header_textbox_height"  value="<?php echo $epic_header_textbox_height; ?>"/>
	<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_headersettings'); ?>
	<input type="submit" value="Save"/>
	<input type="reset" value="Cancel"/>
	<input type="hidden" name="action" value="saved" />
	</form>
		

	
	</div>
</div>
<?php 


endif; 

//}
// End admin ?>


<div id="header" class="module-content clearfix">
<?php
/* WPML Language selector */
if(get_option('epic_language_selector')){
//language_selector_flags();
}




epic_header_logo(); 


if(get_option('epic_header_searchform') ==true){
get_template_part('searchform');
}
if($epic_header_text){
echo '<div id="header-textbox">';
$text = stripslashes($epic_header_text);
echo do_shortcode($text);
echo '</div>';
}


// Primary menu
if(has_nav_menu('primary')){

	echo "\n\n<!-- Primary menu -->\n";

	wp_nav_menu( array( 
			
		'sort_column' => 'menu_order',
		'container_id' => 'primary',
		'container_class' => 'clearfix',  
		'menu_id' => 'menu-primary', 
		'theme_location' => 'primary',
		'link_before' => '<span>',
		'link_after' => '</span>'
		
		)
	);
	echo "\n<!-- / primary menu -->\n\n";
	echo '<div class="submenu"></div>';	
} 

if(has_nav_menu('mobile')){
			wp_nav_menu(array(
	 		'theme_location' => 'mobile', // your theme location here
 	 		'container_id' 	 => 'primary_select',
  	 		'walker'         => new Dropdown_walker(),
 	 		'items_wrap'     => '<select id="primary-select"><option>'.__('Go to page','epic').'</option>%3$s</select>',
			)
		);
		
	
	}	

?>		
	</div> <!-- / module content -->
</div><!-- / module -->
