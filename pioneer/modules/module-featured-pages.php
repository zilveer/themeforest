<?php 

global $current_user, $wp_roles, $post;


$header = get_post_meta($post->ID,'epic_featuredmodule_header',true);
$description = get_post_meta($post->ID,'epic_featuredmodule_description',true);
$textalign = get_post_meta($post->ID,'epic_featuredmodule_textalign',true);
$epic_featuredmodule_excerptlimit = get_post_meta($post->ID,'epic_featuredmodule_excerptlimit',true);

?>

<div id="module-featured-pages" class="module module-featured clearfix ">


	<?php 
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false){
	
	
	?>
	
	<?php fee_handle('Featured');?>	
	
	<div class="fee-options" id="featured_options">
	
	
	<div class="clearfix">
		
<form method="post">
		<?php add_module_input_title('epic_featuredmodule_header');?>
		<?php add_module_textarea_description('epic_featuredmodule_description');?>
		<?php add_module_text_style('epic_featuredmodule_textalign');?>
		<h5>Select pages</h5>
		<p><?php _e('Select pages by dragging them into the container. The pages will be displayed in the order you drop them in. To remove pages, drag them back to the original list.','epic');?></p>
		<script>
		jQuery('#pagelist-featured').sortable({
			connectWith: jQuery('#pagelist-featured-selected'),
			placeholder: "ui-state-highlight"
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#pagelist-featured-selected').sortable({
			connectWith: jQuery('#pagelist-featured'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var featuredOrdering = jQuery('#pagelist-featured-selected').sortable('toArray');
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
    			
    			jQuery('#epic_featuredmodule_pages').val(featuredOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<div class="formwrapper clearfix">
		<ul class="pagelist" id="pagelist-featured" class="clearfix">
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
		$selected =  get_post_meta($post->ID,'epic_featuredmodule_pages',true);
		$selected = explode(',', $selected);
		
			foreach ($pages as $page ) {
						
      				if(in_array($page->ID, $selected) == false){	
      					 echo '<li id="'.$page ->ID.'">'.$page ->post_title.'</li>';
      					
					}
				}
		
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="pagelist-featured-selected" class="clearfix">
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
		<div class="halfcolumn">
		<h5>Excerpt limit</h5>
		<p>
		<input type="text" name="epic_featuredmodule_excerptlimit" value="<?php if(!$epic_featuredmodule_excerptlimit){echo '1000'; } else {echo $epic_featuredmodule_excerptlimit;}?>"/>
		</p>
		</div>
		<div class="halfcolumn last">
		<h5>Featured image</h5>
		<p>
		<?php $epic_featuredmodule_image = get_post_meta($post->ID,'epic_featuredmodule_image',true);?>
		<input type="radio" name="epic_featuredmodule_image" value="show" <?php if($epic_featuredmodule_image == 'show' || !$epic_featuredmodule_image){ echo 'checked="checked"';}?>/>
		<label for="epic_featuredmodule_image">Show image</label>
		
		<input type="radio" name="epic_featuredmodule_image" value="hide" <?php if($epic_featuredmodule_image == 'hide'){ echo 'checked="checked"';}?>/>
		<label for="epic_featuredmodule_image">Disable image</label>
		</p>
		</div>
		<hr/>
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_featuredpages'); ?>	
		<input type="hidden" name="epic_featuredmodule_pages" id="epic_featuredmodule_pages" value="<?php echo get_post_meta($post->ID,'epic_featuredmodule_pages',true);?>"/>
		
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		
		<script>
		jQuery(function() {
			jQuery( "#featured_options" ).dialog({
				autoOpen: false,
				title:"Featured module options",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 550,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#featured_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#featured_options" ).dialog( "open" );
				return false;
			});
			});
		</script>

		
	</form>


	
	</div>
	</div>
	
	
	
	</div>
<?php }?>	
	
	
<div class="module-content">	


<?php 


$epic_featuredmodule_image = get_post_meta($post->ID,'epic_featuredmodule_image',true); // Keep outside the loop to get the correct id
$pages = get_post_meta($post->ID,'epic_featuredmodule_pages',true);

if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}
?>
		
<div class="blocked clearfix">				
					
					
				
<?php


$fpages = rtrim($pages,",");
$allpages = explode(',', $pages);

$b = 1;
if($fpages){

foreach ($allpages as $singlepage) : 

// Pass the id through a function to check language post id (WPLM support)
$lang_page_id = lang_page_id($singlepage);
if($lang_page_id != NULL){
$queried_post = get_page($lang_page_id);
$title = $queried_post->post_title;

?>
<div class="page type-page <?php if($b % 4 == 0){echo 'last';} ?>">
					
									
					<?php 
					if( $epic_featuredmodule_image != 'hide' && has_post_thumbnail($singlepage)){
						echo '<div class="post-image">';
						echo epic_image($singlepage, 'Thumbnail-featured', $queried_post);
						echo '</div>';
					}
					
					?>
											
					<div class="post-info">
					<p class="caption"><a href="<?php echo get_permalink( $queried_post );?>"><?php echo $title;?></a></p>								
					<?php echo '<p>'.$queried_post->post_excerpt .'</p>';?>
					<?php //echo epic_post_excerptlimit($epic_featuredmodule_excerptlimit,$queried_post);?>
					<a href="<?php echo get_permalink($queried_post);?>" class="epic_link"><?php _e('Read more','epic');?></a>					
					</div>
					
</div>
<?php

if($b % 4 == 0){echo '<br class="break"/>';}
$b++;
}
endforeach;
}else{
echo '<div class="message_box message_box_yellow"><p>No pages have been added. Please fill out the required fields.</p></div>';
}?>
	
	</div>
</div>
</div>