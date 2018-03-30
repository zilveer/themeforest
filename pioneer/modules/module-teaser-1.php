<?php 

global $current_user, $wp_roles, $post; 




?>
<div id="module-teaser-1" class="module module-teaser clearfix ">

	<?php
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false ){	
	?>
	
	<?php fee_handle('Teaser-1');?>
	
	
	<div class="fee-options" id="teaser-1-options">
	
	
	<form method="post">
	<h5>Select teaser</h5>
	<p><select name="teaser-1-teaser" id="teaser-1-teaser">
	<?php
	
		
	$selected = get_post_meta($post->ID,'epic_home_teaser_1',true);

	$args = array(
    		'numberposts'     => -1,
   		    'post_type'       => 'teaser',
    		'post_status'     => 'publish' ); 
    
    $teaserpost_1_array = get_posts( $args );
    	
		echo '<option value="">'.__('Select teaser','epic').'</option>';
		foreach ($teaserpost_1_array as $teaserpost_1 ):
			
			echo '<option value="'. $teaserpost_1->ID. '"';
				
				  if($selected == $teaserpost_1->ID){echo ' selected="selected" ';}
			
			echo '>' . get_the_title($teaserpost_1) . '</option>';
		endforeach;
	
?>
</select></p>


		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_teaser_1'); ?>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
		jQuery(function($) {
			jQuery( "#teaser-1-options" ).dialog({
				autoOpen: false,
				title:"Teaser settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#teaser-1_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#teaser-1-options" ).dialog( "open" );
				return false;
			});
		});
		</script>


</form>



<div class="clearfix"></div>


	</div>
</div>
<?php }?>	
	
	
<div class="module-content">	
	
		<?php
		
		$teaser = get_post_meta($post->ID,'epic_home_teaser_1',true);
		
		if($teaser){
		// Pass the id through a function to check language post id (WPLM support)
		$lang_page_id = lang_page_id($teaser);
		if($lang_page_id != NULL){
			$teaser = get_page($lang_page_id);
		}

		$args = array(
			'page_id' 		=> $teaser,
			'link' 			=> '',
			);
		echo epic_post_excerpt($args);
		
		}
		else {
			
			echo '<div class="message_box message_box_yellow"><p>No teaser selected. Please select a teaser.</p></div>';
		
		}		
		?>
		
	</div>
</div><!-- End module -->