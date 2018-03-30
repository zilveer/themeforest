<?php 
/* Get post meta */

$header = get_post_meta($post->ID,'epic_blogmodule_header',true);
$description = get_post_meta($post->ID,'epic_blogmodule_description',true);
$textalign = get_post_meta($post->ID,'epic_blogmodule_textalign',true);
$pagination = get_post_meta($post->ID,'epic_blogmodule_pagination',true);
$perpage = get_post_meta($post->ID,'epic_blogmodule_perpage',true);
$sidebar = get_post_meta($post->ID, 'epic_blogmodule_sidebar', true);
$sidebar_position = get_post_meta($post->ID, 'epic_blogmodule_layout', true);
//$epic_blogmodule_categories =  get_post_meta($post->ID,'epic_blogmodule_categories',true);
$categories_selected = get_post_meta($post->ID,'epic_blogmodule_categories',true);
?>

<div id="module-blog" class="module module-blog clearfix  <?php if($sidebar && $sidebar_position){ echo $sidebar_position; };?>">


	<?php global $current_user, $wp_roles;
	get_currentuserinfo();
	if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false):?>
	
	<?php fee_handle('Blog');?>
	
	
	<div class="fee-options" id="blog_options">
	
	
		<form method="post">
		<?php add_module_input_title('epic_blogmodule_header');?>
		<?php add_module_textarea_description('epic_blogmodule_description');?>	
		<?php add_module_text_style('epic_blogmodule_textalign');?>	
		
		
		<br class="clear"/>
		<h5>Select categories</h5>
		<p><?php _e('Select categories by dragging them into the container. To remove categories, drag them back to the original list.','epic');?></p>
		<script>
		jQuery('#categorylist-blog').sortable({
			connectWith: jQuery('#categorylist-blog-selected'),
			placeholder: "ui-state-highlight",
			//handle: 'span.draghandle'
			}).disableSelection();
		
		jQuery('#categorylist-blog-selected').sortable({
			connectWith: jQuery('#categorylist-blog'),
			greedy: true,
			//helper: 'clone',
			//forceHelperSize: true,
			//handle: 'span.draghandle',
			cursor: 'pointer',
			opacity: 0.6,
			placeholder: "ui-state-highlight",
			
			update : function (event, ui) {	
			
			    var featuredOrdering = jQuery('#categorylist-blog-selected').sortable('toArray');
    			var l = "blog_category_".length;
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
    			
    			jQuery('#epic_blogmodule_categories').val(featuredOrderIds);
  			}  			
  			
  	
		}).disableSelection();
		</script>
		<div class="formwrapper clearfix">
		<ul class="pagelist" id="categorylist-blog" class="clearfix">
		<?php
		$categories = get_categories(array('hide_empty' => false, 'taxonomy' => 'category'));
					
		
		$epic_getcat = array();
		foreach ($categories as $category ) {
			$needle = strpos($categories_selected, 'blog_category_'.$category -> cat_ID);
			if($needle === false){
       		echo '<li id="blog_category_'.$category -> cat_ID.'">'.$category -> cat_name.'</li>';
       		}
		}
		
		?>
		
		
		</ul>
		
		<ul class="pagelist-selected" id="categorylist-blog-selected" class="clearfix">
		<?php
		
		
		foreach ($categories as $category ) {
				$needle = strpos($categories_selected, 'blog_category_'.$category -> cat_ID);
				if($needle !== false){
       				echo '<li id="blog_category_'.$category -> cat_ID.'">'.$category -> cat_name.'</li>';
				}
			}
		
		?>		
		</ul>
		</div>
				
		<h5>Sidebar</h5>
		<div class="halfcolumn">
		<p>	<?php
		// Sidebars
		$generatedSidebars = get_option('sbg_sidebars'); // Sidebars from the sidebar-generator
		$autoSidebars = array( "default_sidebar"  => "Default Sidebar"); // Hard-coded sidebars
		$allsidebars = array_merge((array)$autoSidebars,(array)$generatedSidebars); // Merge into one array
		
		$sidebar = get_post_meta($post->ID,'epic_blogmodule_sidebar',true);
		
		/* Build the select */
		echo '<select name="epic_blogmodule_sidebar">';

		foreach ($allsidebars as $sidebarvalue => $sidebarname ) {
		 echo '<option value="'.$sidebarname.'" id="'.$sidebarvalue.'" ';
			  if($sidebar == $sidebarname){ echo 'selected="selected" '; }
		 echo '>'.$sidebarname.'</option>';
		}
		echo '</select>';
		?></p>
		</div>
		<div class="halfcolumn last">
		
		<?php $sidebar_position = get_post_meta($post->ID,'epic_blogmodule_layout',true); ?>
								
						<p><input type="radio" name="epic_blogmodule_layout" value="sidebar_left"  <?php if($sidebar_position == 'sidebar_left'){ echo 'checked="checked"';}?>>
						<label for="epic_blogmodule_layout">Left</label>
		
						<input type="radio" name="epic_blogmodule_layout" value="sidebar_right" <?php if($sidebar_position == 'sidebar_right' || !$sidebar_position){echo 'checked="checked"';}?>>
						<label for="epic_blogmodule_layout">Right</label>
		
						<input type="radio" name="epic_blogmodule_layout" value="sidebar_none" <?php if($sidebar_position == 'sidebar_none'){echo 'checked="checked"';}?>>
						<label for="epic_blogmodule_layout">No sidebar</label></p>
		</div>
		
		
		
		<br class="clear"/>
		
		<div class="quartercolumn">
			<h5>Number of posts</h5>
			<p><input type="text" name="epic_blogmodule_perpage" id="epic_blogmodule_perpage" value="<?php echo get_post_meta($post->ID,'epic_blogmodule_perpage',true);?>"</p>
		</div>
		
		
		<div class="quartercolumn last">
			<?php $epic_blogmodule_pagination = get_post_meta($post->ID,'epic_blogmodule_pagination',true);?>
			<h5>Show pagination</h5>
			<p>
			<input type="radio" name="epic_blogmodule_pagination" value="yes" <?php if($epic_blogmodule_pagination == 'yes' ){echo 'checked="checked"';}?>/><label>Yes</label>
			<input type="radio" name="epic_blogmodule_pagination" value="no" <?php if($epic_blogmodule_pagination== 'no' || !$epic_blogmodule_pagination){echo 'checked="checked"';}?>/>
			<label>No</label>
			</p>
		</div>
		<hr/>
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_blogmodule'); ?>	
		<input type="hidden" name="epic_blogmodule_categories" id="epic_blogmodule_categories" value=" <?php echo get_post_meta($post->ID,'epic_blogmodule_categories',true);?>"/>
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		
		<script>
			jQuery(function() {
			jQuery( "#blog_options" ).dialog({
				autoOpen: false,
				title:"Blog settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 580
				
				});

			jQuery( "#blog_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#blog_options" ).dialog( "open" );
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
$categories_selected = str_replace("blog_category_", '', $categories_selected); // Remove the featured_ prefix
$categories_selected = rtrim((string)$categories_selected, ',');


$imagesize = 'Thumbnail-590';


if(!empty($categories_selected)){

if(!empty($header) || !empty($description)){
echo '<div class="intro clearfix intro_'.$textalign.'">';
if(!empty($header))		{ echo '<span class="module-title">'.$header.'</span>';}
if(!empty($description)){ echo '<span class="module-description">'.$description.'</span>';} 
echo '</div>';
}



if($categories_selected){

if ( get_query_var('paged') ) { $paged = get_query_var('paged');} 
elseif ( get_query_var('page') ) {$paged = get_query_var('page');}
else { $paged = 1;}

		
$args = array('showposts' => $perpage, 'cat' => $categories_selected, 'paged' => $paged);
query_posts($args);




/* Start loop */
if(have_posts()):
epic_blog_alpha();

?>

<ul class="blog clearfix" >

<?php

while (have_posts()): the_post();

$format = get_post_format();

$excerpt_args = array(
		'page_id' 		=> $post->ID,
		'link' 			=> 'text',
		'string'		=> __('Continue reading','epic')
		);


?>

	
<li class="<?php echo $poststyle.' format_'.$format;  ?>">

	<div class="post-info">
	
<?php 


if ($format == 'image'){ 
	if(has_post_thumbnail($post->ID)){		
		echo epic_image($post->ID,$imagesize, 'permalink'); 
		}?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  	
	
	
	echo epic_post_excerpt($excerpt_args);

}


else if ($format == 'gallery'){ ?>
	<?php 
	$mediasize = 'regular'; 
	include(locate_template('gallery.php'));
	?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  ?>
	<?php
	
	
	echo epic_post_excerpt($excerpt_args);


}



else if ($format == 'video'){ ?>

	<?php get_template_part('video');?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	<?php  epic_post_meta();  ?>
	<?php echo epic_post_excerpt($excerpt_args);
	}
	


	
else { ?>
	<h2><a href="<?php echo get_permalink();?>"><?php echo get_the_title();?></a></h2>
	
	<?php  epic_post_meta();  ?>
	
	<?php
	echo epic_post_excerpt($excerpt_args);

}
?>

		
	</div>	
	
	
	
	
</li>	

<?php

endwhile; 
?>
</ul>
<?php endif;

if( $pagination == 'yes'){
echo epic_pagination();
}
wp_reset_query();
}
epic_blog_omega();

			if($sidebar != 'no-sidebar'){
				get_sidebar('blog');
			}?>
		
		<?php
		}else {	
		?>
		
		<div class="message_box message_box_yellow"><p>No categories have been selected. Please select categories.</p></div>
		
		<?php }
		?>
	
	</div>
</div>
