<?php $twitteruser =  get_option('epic_twittermodule_username');?>

<div id="module-twitter" class="module module-twitter clearfix">


	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Twitter');?>
		
	<div class="fee-options" id="twitter_options">
	
		<form method="post">

		<h5>Enter your twitter username</h5>
		<p><input type="text" name="epic_twittermodule_username" id="epic_twittermodule_username" value="<?php echo $twitteruser;?>"/>
		<small>This is a global option</small></p>
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_twittermodule'); ?>	
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
			jQuery(function($) {
			jQuery( "#twitter_options" ).dialog({
				autoOpen: false,
				title:"Twitter module",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});


			jQuery( "#twitter_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#twitter_options" ).dialog( "open" );
				return false;
			});
		});
		</script>
			
			
	</form>
		
		
		
	</div>
</div>
<?php endif; // End admin ?>

<div class="module-content clearfix">
	
	<!-- Loop the posts -->
	<?php 
	$count = 1;
	?>
	
	<ul id="twitter_update_list">
		<li><?php _e('Twitter feed loading','epic');?></li>
	</ul>
	<a href="http://twitter.com/<?php echo $twitteruser;?>" id="twitterlink"></a>
	<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
	<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/<?php echo  $twitteruser;?>.json?callback=twitterCallback2&amp;count=<?php echo $count;?>"></script>
	
		</div> <!-- / module content -->
</div><!-- / module -->
