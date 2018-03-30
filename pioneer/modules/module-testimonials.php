<?php 




$header = get_post_meta($post->ID,'epic_testimonialmodule_header',true);
$description = get_post_meta($post->ID,'epic_testimonialmodule_description',true);
$testimonialeffect = get_post_meta($post->ID,'epic_testimonialmodule_effect',true);
if($testimonialeffect == '') {$testimonialeffect = 'fade';}
$testimonialspeed = get_post_meta($post->ID,'epic_testimonialmodule_speed',true);
if($testimonialspeed == null) {$testimonialspeed = '6000';}
$selectedposts = get_post_meta($post->ID,'epic_testimonialmodule_posts',true);
$selectedposts = rtrim($selectedposts,",");
$selectedposts = explode(',', $selectedposts);
?>

<div id="module-testimonials" class="module module-testimonials clearfix">


	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Testimonial');?>
		
	<div class="fee-options" id="testimonial_options">
	
		<form method="post">
		
		<?php add_module_input_title('epic_testimonialmodule_header');?>
		<?php add_module_textarea_description('epic_testimonialmodule_description');?>		

		
		
		<h5>Select posts</h5>
		<p><?php _e('Select posts by dragging them into the container. To remove posts, drag them back to the original list.','epic');?></p>
		<script>
		jQuery('#pagelist-testimonial').sortable({
			connectWith: jQuery('#pagelist-testimonial-selected'),
			placeholder: "ui-state-highlight"
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#pagelist-testimonial-selected').sortable({
			connectWith: jQuery('#pagelist-testimonial'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var newOrdering = jQuery('#pagelist-testimonial-selected').sortable('toArray');
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
    			
    			jQuery('#epic_testimonialmodule_posts').val(newOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<div class="formwrapper clearfix">
		<ul class="pagelist" id="pagelist-testimonial">
		<?php
		
		$args = array(
    	'sort_order' => 'ASC',
    	'sort_column' => 'post_title',
   		'post_type' => 'testimonial',
    	'post_status' => 'publish'
		);
		$pages = get_posts($args);
		$selected =  get_post_meta($post->ID,'epic_testimonialmodule_posts',true);
		$selected = explode(',', $selected);
		
						
				foreach ($pages as $page ) {
						
      				if(in_array($page->ID, $selected) == false){	
      					 echo '<li id="'.$page ->ID.'">'.$page ->post_title.'</li>';
      					
					}
				}
		
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="pagelist-testimonial-selected">
		<?php
		
				foreach ($pages as $page ) {
						if(in_array($page->ID, $selected) == true){		
      					 echo '<li id="'.$page ->ID.'">'.$page ->post_title.'</li>';
      					 
					}
				}
		?>		
		</ul>
		</div>

		<hr/>
		<h5>testimonial effect</h5>
	
		<div class="halfcolumn">
			<?php 
			$default = 'fade';
			$effects = epic_cycle_effects();
			$selected_effect = get_post_meta($post->ID,'epic_testimonialmodule_effect',true);
			?>
			<p><select name="epic_testimonialmodule_effect">
			<?php foreach ( $effects as $effect => $effectname){
				
				echo '<option value="'.$effect.'"';
				
				if($effect == $selected_effect){ echo 'selected="selected"';}
				if(!$selected_effect && $effect == $default){ echo 'selected="selected"';}
				
				echo ' >'.$effectname.'</option>';
			
			}?>
			</select></p>
		</div>
		
		<div class="halfcolumn last">
				<?php $speed = get_post_meta($post->ID,'epic_testimonialmodule_speed',true); ?>
				<p><input type="text" name="epic_testimonialmodule_speed" id="epic_testimonialmodule_speed" value="<?php if($speed){echo $speed;} else { echo '6000';}?>"/>
				<small>Enter value in milliseconds (1000 = 1 second)</small>
				</p>
			
		</div>


		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_testimonialmodule'); ?>	
		<input type="hidden" name="epic_testimonialmodule_posts" id="epic_testimonialmodule_posts" value="<?php echo get_post_meta($post->ID,'epic_testimonialmodule_posts',true);?>"/>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		
		<script>
			jQuery(function($) {
			jQuery( "#testimonial_options" ).dialog({
				autoOpen: false,
				title:"Testimonial settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580
				
				});

			jQuery( "#testimonial_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#testimonial_options" ).dialog( "open" );
				return false;
			});
		});
		</script>
			
			
	</form>
		
		
		
	</div>
</div>
<?php endif; // End admin 


?>

<div class="module-content clearfix">
<?php
if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix">';
if(!empty($header)){echo '<h4>'.$header.'</h4>';} 
if(!empty($description)){echo '<p>'.$description.'</p>';} 
echo '</div>';
}
?>

<!-- Loop the posts -->
		<?php 
	

		if($selectedposts){
		echo '<div class="testimonial-icon"></div>';
		echo '<div id="testimonial-slider"><ul id="testimonial">';
		foreach ($selectedposts as $selectedpost): 
			
			$mypageid  = $selectedpost;
	
			
			// Pass the id through a function to check language post id (WPLM support)
			$lang_page_id = lang_page_id($selectedpost);
			if($lang_page_id != NULL){
				$queried_post = get_post($lang_page_id);
			}

			$title = $queried_post->post_title;
			$signature = get_post_meta($mypageid,'epic_testimonial_writer',true);
		
			echo '<li><div class="testimonial-signature"><h4>'.$signature.'</h4></div><div class="testimonial-text"><h3>'.$queried_post->post_excerpt .'</h3></div></li>';

			endforeach;
		echo '</ul></div>';			
		}else{ 
		echo '<div class="message_box message_box_yellow"><p>No news posts have been selected. Please select posts.</p></div>'; }
?>



<script>
  jQuery(function () {
   jQuery('#testimonial-slider').flexslider({
   directionNav: false,
   manualControls: "ul.flex-nav li",
   slideshowSpeed: <?php echo $testimonialspeed;?>,
   });
  });
</script>

<?php




?>
		
		</div> <!-- / module content -->
</div><!-- / module -->
