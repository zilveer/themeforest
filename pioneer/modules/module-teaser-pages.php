<?php // Get post meta

$header = get_post_meta($post->ID,'epic_home_teasers_header',true);
$description = get_post_meta($post->ID,'epic_home_teasers_description',true);
$textalign = get_post_meta($post->ID,'epic_home_teasers_textalign',true);			
?>
<section id="module-teaser-pages" class="module module-teaserpages" >
	
		<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false){
	?>
	
	<?php fee_handle('Teaserpages');?>	
	
	<div class="fee-options clearfix" id="teaserpages-options">
	
	
	
	

	<form method="post">
		
		
		<?php add_module_input_title('epic_home_teasers_header');?>
		<?php add_module_textarea_description('epic_home_teasers_description');?>
		<?php add_module_text_style('epic_home_teasers_textalign');?>	
		<hr/>
		<h5>Select pages</h5>
		<p><?php _e('Select pages by dragging them into the container. The pages will be displayed in the order you drop them in. To remove pages, drag them back to the original list.','epic');?></p>
		<script>
		jQuery('#pagelist-teaser').sortable({
			connectWith: jQuery('#pagelist-teaser-selected'),
			placeholder: "ui-state-highlight"
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#pagelist-teaser-selected').sortable({
			connectWith: jQuery('#pagelist-teaser'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var newOrdering = jQuery('#pagelist-teaser-selected').sortable('toArray');
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
    			
    			jQuery('#epic_home_teasers_pages').val(newOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<div class="formwrapper clearfix">
		<ul class="pagelist" id="pagelist-teaser">
		<?php
		$pageargs = array(
    	'child_of' => 0,
   		'sort_order' => 'ASC',
    	'sort_column' => 'post_title',
   		'hierarchical' => 0,
   		'parent' => -1,
    	'offset' => 0,
   		'post_type' => 'page',
    	'post_status' => 'publish'
		);
		$pages = get_pages($pageargs);
		$selected =  get_post_meta($post->ID,'epic_home_teasers_pages',true);
		$selected = explode(',', $selected);
		
						
				foreach ($pages as $page ) {
						
      				if(in_array($page->ID, $selected) == false){	
      					 echo '<li id="'.$page ->ID.'">'.$page ->post_title.'</li>';
      					
					}
				}
		
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="pagelist-teaser-selected">
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
			
		<input type="hidden" name="epic_home_teasers_pages" id="epic_home_teasers_pages" value="<?php echo get_post_meta($post->ID,'epic_home_teasers_pages',true);?>"/>
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_teaserpages'); ?>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
		jQuery(function($) {
			jQuery( "#teaserpages-options" ).dialog({
				autoOpen: false,
				title:"Teaserpages settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 550,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});
			jQuery( "#teaserpages_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#teaserpages-options" ).dialog( "open" );
				return false;
			});
		});
		</script>
		
		
	</form>

	</div>
	
</div><!-- / module options -->
<?php }?>
		
	<div class="module-content">
				
		
		<?php 
			
if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}
		?>	
		
		<div class="blocked clearfix">
		
		
		
		
		<!-- Loop the posts -->
		<?php 
		$selected = get_post_meta($post->ID,'epic_home_teasers_pages',true);
		//$pages = str_replace("teaser_", '', $pages); // Remove the featured_ prefix
		$pages = rtrim($selected,",");
		$pages = explode(',', $pages);

		$a = 1;

		if($selected){
		foreach ($pages as $page): 
			
			$mypageid  = $page;
	
		
		$pageIcon = get_post_meta($page,'epic_page_icon',true);
		if($pageIcon){$divclass = "icon";} else {$divclass = '';}
			
		?>
		
		<div class="page type-page <?php if($a % 3 == 0){echo 'last';} ?>">
		 
	<?php
			// Pass the id through a function to check language post id (WPLM support)
			$lang_page_id = lang_page_id($page);
			if($lang_page_id != NULL){
				$queried_post = get_page($lang_page_id);
			}

			$title = $queried_post->post_title;

			
			?>
			
				<?php if($pageIcon):?><div class="page-icon"><img src="<?php echo $pageIcon ?>" /></div><?php endif;?>
				<div class="post-info <?php echo $divclass;?>">
					
					<p class="caption"><a href="<?php echo get_permalink($queried_post);?>"><?php echo $title;?></a></p>
					
					
					<?php echo '<p class="post-excerpt">'.$queried_post->post_excerpt .'</p>'; ?>			
					<a href="<?php echo get_permalink($mypageid);?>" class="epic_link"><?php _e('Read more','epic');?></a>
				</div><!-- / post-info -->
			</div><!-- / page -->
			<?php
			if($a % 3 == 0){echo '<br class="break"/>';}
			$a++;
			endforeach;
			}else{
echo '<div class="message_box message_box_yellow"><p>No pages have been added. Please fill out the required fields.</p></div>';
}
			
		
?>
		</div><!-- / blocked -->
		
		
		
	
	
	</div><!-- / module content -->
</section><!-- / module -->