<?php 
$epic_footer_credits = get_option('epic_footer_credits');
?>

<div id="module-footer" class="module module-footer clearfix">


	<?php global $current_user, $wp_roles;
	

	
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Footer');?>
		
	<div class="fee-options" id="footer_options">
		<form method="post">
		<h5>Footer credits</h5>
		<p><textarea name="epic_footer_credits"><?php echo $epic_footer_credits;?></textarea></p>
		<hr/>

		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_footersettings'); ?>	
		
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		
		<script>
			jQuery(function($) {
			jQuery( "#footer_options" ).dialog({
				autoOpen: false,
				title:"Footer module options",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#footer_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#footer_options" ).dialog( "open" );
				return false;
			});
		});
		</script>
			
			
	</form>
		
		
		
	</div>
</div>
<?php endif; 


// End admin ?>

<div id="footer" class="module-content clearfix">
	
	<?php
			echo '<div class="footer-widgets clearfix" id="primary-footer-widgets">';
			 	if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Primary Footer')){};
			echo '</div>';
								
		
			
			echo '<div class="footer-widgets clearfix" id="secondary-footer-widgets">';
			 	if  (function_exists('dynamic_sidebar') && dynamic_sidebar('Secondary Footer')){};
			echo '</div>';
								
		
						
			if(has_nav_menu('footer')){
				
				wp_nav_menu(
						array( 
						'sort_column' => 'menu_order', 
						'container_id' => 'footer-menu', 
						'menu_id' => 'menu-footer',
						'theme_location' => 'footer'
						)
					);
				}
				
			
			
			if(!empty($epic_footer_credits)){
				echo '<div id="footer-credits">'. stripslashes($epic_footer_credits).'</div>';
			}
			
			?>	
	
		</div> <!-- / module content -->
</div><!-- / module -->
