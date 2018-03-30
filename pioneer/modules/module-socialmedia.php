<?php 


$selected = get_post_meta($post->ID,'epic_socialmediamodule_icons',true);
$header = get_post_meta($post->ID,'epic_socialmediamodule_header',true);
$description = get_post_meta($post->ID,'epic_socialmediamodule_description',true);
$textalign = get_post_meta($post->ID,'epic_socialmediamodule_textalign',true);	
$selected = rtrim($selected,', ');
$selectedarray = explode(',',$selected);
?>

<div id="module-socialmedia" class="module module-socialmedia clearfix">


	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Socialmedia');?>
		
	<div class="fee-options" id="socialmedia_options">
	
		<form method="post">
		
		<?php add_module_input_title('epic_socialmediamodule_header');?>
		<?php add_module_textarea_description('epic_socialmediamodule_description');?>
		<?php add_module_text_style('epic_socialmediamodule_textalign');?>
		
		<h5>Select social media platforms</h5>
		<p><?php _e('Select the icons you want to add to the module. You need to enter the links in the options panel in your wp-admin.','epic');?></p>
		<script>
		jQuery('#pagelist-socialmedia').sortable({
			connectWith: jQuery('#pagelist-socialmedia-selected'),
			placeholder: "ui-state-highlight",
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#pagelist-socialmedia-selected').sortable({
			connectWith: jQuery('#pagelist-socialmedia'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var newOrdering = jQuery('#pagelist-socialmedia-selected').sortable('toArray');
    			var l = "teaser_".length;
    			var newOrderIds = new Array(newOrdering.length);
    			var ctr = 0;
    			// Loop over each value in the array and get the ID
    			jQuery.each(
     			 newOrdering,
      			function(intIndex, objValue) {
      			  //Get the ID of the reordered items 
       			 //- this is sent back to server to save
        			newOrderIds[ctr] = objValue.substring('',objValue.length);
        			ctr = ctr + 1;
      			}
    			);
    			//alert("newOrderIds : "+newOrderIds); //Remove after testing
    			//$("#info").load("save-item-ordering.jsp?"+newOrderIds);
    			
    			jQuery('#epic_socialmediamodule_icons').val(newOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<div class="formwrapper clearfix">
		<ul class="socialicons" id="pagelist-socialmedia">
		<?php
		
				
		$medias = array(
		'delicious' => '',
		'deviantart' => '',
		'digg' => '',
		'dribble' => '',
		'dopplr' => '',
		'ember' => '',
		'evernote' => '',
		'facebook' => '',
		'flickr' => '',
		'forrst' => '',
		'google' => '',
		'google_plus' => '',
    	'gowalla' => '',
    	'grooveshark' => '',
    	'icloud' => '',
    	'lastfm' => '',
		'linkedin' => '',
		'metacafe' => '',
		'mixx' => '',
		'myspace' => '',
		'netvibes' => '',
		'newsvine' => '',
		'orkut' => '',
		'paypal' => '',
		'picasa' => '',
		'plurk' => '',
		'posterous' => '',
		'reddit' => '',
		'retweet' => '',
		'rss' => '',
		'skype' => '',
		'technorati' => '',
		'tumblr' => '',
		'twitter' => '',
		'vimeo' => '',
		'wordpress' => '',
		'yahoo' => '',
		'yelp' => '',
		'zerply' => '',
		'zootool' => ''
		);
		
		foreach ($medias as $media => $name ) {
			
			$needle = strpos($selected, $media);
			if(in_array($media, $selectedarray) == false){
			//if($needle === false){
      			echo '<li id="'.$media.'" class="icon-'.$media.'"><a href="#" title="'.$media.'"></a></li>';
      			}
			}
		?>
		</ul>
		
		<ul class="socialicons receiver clearfix" id="pagelist-socialmedia-selected">
		<?php
			
			
			foreach ($selectedarray as $media ) {
				 echo '<li id="'.$media.'" class="icon-'.$media.'"><a href="'.get_option('epic_socialmedia_'.$media).'" title="'.$media.'"></a></li>';
      			}
		?>		
		</ul>
		</div>
		

		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_socialmediamodule'); ?>	
		<input type="text" name="epic_socialmediamodule_icons" id="epic_socialmediamodule_icons" value="<?php echo get_post_meta($post->ID,'epic_socialmediamodule_icons',true);?>"/>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
			jQuery(function() {
			jQuery( "#socialmedia_options" ).dialog({
				autoOpen: false,
				title:"Socialmedia settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#socialmedia_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#socialmedia_options" ).dialog( "open" );
				return false;
			});
		});
		</script>
			
			
	</form>
		
		
		
	</div>
</div>
<?php endif; // End admin ?>

<div class="module-content clearfix">
<?php
if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}
?>

<!-- Loop the posts -->
		<?php 
		
		if($selectedarray){
		echo epic_socialicons($selectedarray);}else{ 
		echo '<div class="message_box message_box_yellow"><p>No icons been selected.</p></div>'; }


?>
		
		</div> <!-- / module content -->
</div><!-- / module -->
