<?php
global $current_user, $wp_roles;
get_currentuserinfo();
?>
<div id="module-widgets" class="module module-widgets clearfix">
	
	<?php if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):	?>
	
	<?php fee_handle('Widgets');?>
		
	
	
	<div class="fee-options" id="widgets-options">
	<form method="post">
	
	
	<h5>Select widgetized area</h5>
	<p>	<?php
// Sidebars
$selectable = get_option('sbg_sidebars'); // Sidebars from the sidebar-generator

/* Build the select */
echo '<select name="epic_widgetmodule_sidebar">';
$selectedsidebar = get_post_meta($post->ID,'epic_widgetmodule_sidebar',true);
		echo '<option value="">Select sidebar/widgetized area</option>';
		foreach ($selectable as $sidebar_id => $sidebar_name ) {
		 echo '<option value="'.$sidebar_name.'" id="'.$sidebar_id.'" ';
			  if($selectedsidebar == $sidebar_name){ echo 'selected="selected" '; }
		 echo '>'.$sidebar_name.'</option>';
		}
echo '</select>';
?></p>
		
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_widgetmodule'); ?>	
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
		jQuery(function($) {
			jQuery( "#widgets-options" ).dialog({
				autoOpen: false,
				title:"Widgets module options",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});


			jQuery( "#widgets_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#widgets-options" ).dialog( "open" );
				return false;
			});
		});
		</script>	
		
	</form>

	
	</div>
	</div>
	<?php endif;?>
	
	<div class="module-content">
		<?php 
			$selectedsidebar = get_post_meta($post->ID,'epic_widgetmodule_sidebar',true);
			$selectedsidebar_id = str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$selectedsidebar);
			$selectedsidebar_id = strtolower($selectedsidebar_id);
			
			$widget_count = count_sidebar_widgets( $selectedsidebar_id, false );
			if($selectedsidebar){
			?>
			<div class="content-widgets content-widgets-<?php echo $widget_count;?> clearfix">
				<?php dynamic_sidebar($selectedsidebar_id);?>
		    </div>
			<?php }else{
echo '<div class="message_box message_box_yellow"><p>No widgetized area/sidebar has been selected. Please fill out the required fields.</p></div>';
}
?>
	
	</div>
</div>