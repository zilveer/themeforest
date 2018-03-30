<?php $textalign = get_post_meta($post->ID,'epic_featuredmodule_2_textalign',true);?>

<div id="module-highlights" class="module module-highlights clearfix">


	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false){
	?>
	
	<?php fee_handle('Highlights');?>	
	
	<div class="fee-options" id="highlights_options">
	
	
	
		
<form method="post">
		<?php add_module_input_title('epic_featuredmodule_2_header');?>
		<?php add_module_textarea_description('epic_featuredmodule_2_description');?>
		<?php add_module_text_style('epic_featuredmodule_2_textalign');?>		
		<h5>Select pages</h5>
		
		<p><?php _e('Select pages by dragging them into the container. The pages will be displayed in the order you drop them in. To remove pages, drag them back to the original list.','epic');?></p>
		
		
		
		<script>
		jQuery('#pagelist-featured-2').sortable({
			connectWith: jQuery('#pagelist-featured-selected-2'),
			placeholder: "ui-state-highlight"
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#pagelist-featured-selected-2').sortable({
			connectWith: jQuery('#pagelist-featured-2'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var featuredOrdering = jQuery('#pagelist-featured-selected-2').sortable('toArray');
    			var l = "featured_".length;
    			var featuredOrderIds = new Array(featuredOrdering.length);
    			var ctr = 0;
    			// Loop over each value in the array and get the ID
    			jQuery.each(
     			 featuredOrdering,
      			function(intIndex, objValue) {
      			  //Get the ID of the reordered items 
       			 //- this is sent back to server to save
        			featuredOrderIds[ctr] = objValue.substring('',objValue.length);
        			ctr = ctr + 1;
      			}
    			);
    			//alert("newOrderIds : "+newOrderIds); //Remove after testing
    			//$("#info").load("save-item-ordering.jsp?"+newOrderIds);
    			
    			jQuery('#epic_featuredmodule_2_pages').val(featuredOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		
		<div class="formwrapper clearfix">
	
		<ul class="pagelist" id="pagelist-featured-2" class="clearfix">
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
		$selected =  get_post_meta($post->ID,'epic_featuredmodule_2_pages',true);
		$selected = explode(',', $selected);
		
			foreach ($pages as $page ) {
						
      				if(in_array($page->ID, $selected) == false){	
      					 echo '<li id="'.$page ->ID.'">'.$page ->post_title.'</li>';
      					
					}
				}
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="pagelist-featured-selected-2" class="clearfix">
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
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_featuredpages_2'); ?>	
		<input type="hidden" name="epic_featuredmodule_2_pages" id="epic_featuredmodule_2_pages" value="<?php echo get_post_meta($post->ID,'epic_featuredmodule_2_pages',true);?>"/>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
		jQuery(function($) {
			jQuery( "#highlights_options" ).dialog({
				autoOpen: false,
				title:"Highlights module options",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 550,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#highlights_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#highlights_options" ).dialog( "open" );
				return false;
			});
			});
		</script>
	</form>
		

	
	
	</div>
	
	
	
	</div>
<?php }?>	
	
	
<div class="module-content">	


<?php 

$header = get_post_meta($post->ID,'epic_featuredmodule_2_header',true);
$description = get_post_meta($post->ID,'epic_featuredmodule_2_description',true);
$epic_featuredmodule2_image = get_post_meta($post->ID,'epic_featuredmodule_2_image',true); // Keep outside the loop to get the correct id
$pages = get_post_meta($post->ID,'epic_featuredmodule_2_pages',true);

if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}
		?>
	
<div class="blocked">				
					
					
				
<?php


// Teaser pages
//$pages = str_replace("featured_", '', $pages); // Remove the featured_ prefix
$pages = rtrim($pages,",");
$allpages = explode(',', $pages);

$b = 1;
if($pages){
foreach ($allpages as $page) : 

// Pass the id through a function to check language post id (WPLM support)
$lang_page_id = lang_page_id($page);
if($lang_page_id != NULL){
$queried_post = get_page($lang_page_id);
$title = $queried_post->post_title;
$pageIcon = get_post_meta($page,'epic_page_icon',true);
if($pageIcon){$divclass = "icon";} else {$divclass = '';}
?>
<div class="page type-page <?php if($b % 3 == 0){echo 'last';} ?>">
		<?php if($pageIcon):?><div class="page-icon"><img src="<?php echo $pageIcon ?>" /></div><?php endif;?>
		<div class="post-info <?php echo $divclass;?>">
			<h3 class="caption"><a href="<?php echo get_permalink($queried_post);?>"><?php echo $title;?></a></h3>
			<p class="subtitle"><a href="<?php echo get_permalink($queried_post);?>"><?php echo $queried_post->post_excerpt;?></a></p>
			</div>
</div>
<?php

if($b % 3 == 0){echo '<br class="break"/>';}
$b++;
}
endforeach;
}else{
echo '<div class="message_box message_box_yellow"><p>No pages have been added. Please fill out the required fields.</p></div>';
}
?> 
	</div>
</div>
</div>