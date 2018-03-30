<?php
global $current_user, $wp_roles, $post;
get_currentuserinfo();
	



$sidebar = get_post_meta($post->ID, 'epic_sidebar', true);
$sidebar_position = get_post_meta($post->ID, 'epic_layout', true);
if(is_singular('portfolio')){
	$sidebar_position == '';
}
?>

<div id="module-page-content" class="module module-page-content  clearfix <?php if($sidebar && $sidebar_position){ echo $sidebar_position; }?>">
<?php 
/* Check for permissions */
if ( current_user_can('manage_options') && is_user_logged_in() && EPIC_FRONTEND_EDITOR == false ){	

/* Add the admin handle */	
fee_handle('Page-content');

/* Get post meta */
$pagelayout = get_post_meta($post->ID,'epic_layout',true);
	
// Sidebars
$generatedSidebars = get_option('sbg_sidebars'); // Sidebars from the sidebar-generator
$autoSidebars = array( "default_sidebar"  => "Default Sidebar"); // Hard-coded sidebars
$allsidebars = array_merge((array)$autoSidebars,(array)$generatedSidebars); // Merge into one array
?>
				<div class="fee-options" id="page-options">
	
					<form method="post">
					<p><?php _e('NB! You need to refresh your page after saving to see the changes','epic');?></p>
					<h5>Title</h5>
					<p><input type="text" name="epic_page_title" value="<?php echo get_the_title();?>"/></p>

					<h5>Excerpt</h5>
					<p>
					<textarea name="epic_page_excerpt"><?php echo get_the_excerpt();?></textarea>
					</p>
					
					<p>
					<?php
						$settings = array(
    					'wpautop' => true,
    					'media_buttons' => true,
    					'wpautop' => true,
    					'tinymce' => true,
    					'quicktags' => true,
    					'textarea_rows' => 14
    					);
						wp_editor($post->post_content, 'epic_page_content', $settings );
					?>
					</p>
						<h5>Sidebar</h5>
						<div class="halfcolumn">
						<p>	<?php

/* Build the select */
echo '<select name="epic_sidebar">';
$selected = get_post_meta($post->ID,'epic_sidebar',true);
foreach ($allsidebars as $sidebarvalue => $sidebarname ) {
		 echo '<option value="'.$sidebarname.'" id="'.$sidebarvalue.'" ';
			  if($selected == $sidebarname){ echo 'selected="selected" '; }
		 echo '>'.$sidebarname.'</option>';
		}
echo '</select>';
?></p>
					</div>
					<div class="halfcolumn last">
						<p><input type="radio" name="epic_layout" value="sidebar_left"  <?php if($pagelayout == 'sidebar_left'){ echo 'checked="checked"';}?>
						<label>Left</label>
		
						<input type="radio" name="epic_layout" value="sidebar_right" <?php if($pagelayout == 'sidebar_right' || !$pagelayout){echo 'checked="checked"';} /* Set as default */?>
						<label>Right</label>
		
						<input type="radio" name="epic_layout" value="sidebar_none" <?php if($pagelayout == 'sidebar_none'){echo 'checked="checked"';}?>
						<label>No sidebar</label></p>
					</div>
		<hr/>
	
	<div class="halfcolumn">
			<h5>Featured media container size</h5>
				<?php $currentsize = get_post_meta($post->ID,'epic_media_size',true);?>
						<p><input type="radio" name="epic_media_size" value="regular"  <?php if($currentsize == '' || $currentsize == 'regular'){ echo 'checked="checked"';}?>
						<label>Regular</label>
						<input type="radio" name="epic_media_size" value="large"  <?php if($currentsize == 'large'){ echo 'checked="checked"';}?>
						<label>Large</label>
														
	</div>
	
	<div class="halfcolumn last" style="width:400px;">
			<h5>Post format</h5>
			<?php $currentformat = get_post_format($post->ID);?>
						<p><input type="radio" name="epic_post_format" value="standard"  <?php if($currentformat == ''){ echo 'checked="checked"';}?>
						<label>Standard</label>
						<input type="radio" name="epic_post_format" value="image"  <?php if($currentformat == 'image'){ echo 'checked="checked"';}?>
						<label>Image</label>
						<input type="radio" name="epic_post_format" value="video"  <?php if($currentformat == 'video'){ echo 'checked="checked"';}?>
						<label>Video</label>
						<input type="radio" name="epic_post_format" value="gallery"  <?php if($currentformat == 'gallery'){ echo 'checked="checked"';}?>
						<label>Gallery</label></p>

								
	</div>
	
		<?php wp_nonce_field('fee_save_nonce','fee_nonce_field_contentmodule'); ?>	
		<hr/>	
		<?php edit_post_link( 'Edit in wp-admin', '<button class="alignright">', '	</button>', $post->ID );?>	
		<input type="hidden" name="action" value="saved" />
		<input type="submit" value="Save changes"/>
		<input type="reset" value="Cancel"/>
		<script>
		jQuery(function($) {
			jQuery( "#page-options" ).dialog({
				autoOpen: false,
				title:"Page settings",
				show: "fade",
				hide: "fade",
				modal: true,
				width: 740,
				}).find("input[type=reset]").click(function() {
    				jQuery(this).closest(".ui-dialog-content").dialog("close");
				});

			jQuery( "#page-content_handle  .fee-opentoggle" ).click(function() {
				jQuery( "#page-options" ).dialog( "open" );
				return false;
			});
			
			
		});
		</script>
		</form>
	</div>
</div>
<?php }?>



	
<div class="module-content clearfix">
						

<?php
global $post;
$mediasize = get_post_meta($post->ID,'epic_media_size',true);

 if(is_page()){
	 $disabled_comments = get_option('epic_disable_comments_pages');
	 }
	 if(is_single()){
	 $disabled_comments = get_option('epic_disable_comments_posts');
	 }
	 if(is_singular('portfolio')){
	 $disabled_comments = get_option('epic_disable_comments_portfolio');
	 }


$format = get_post_format();
if(!is_singular('portfolio')){
	if($format != '' && $mediasize == 'large'){
	echo '<div class="featured-large">';
			// If post format is set to gallery... (gallery.php)
			if( has_post_format('gallery')):
				include(locate_template('gallery.php'));	
				
			// If post format is set to image... (postimage.php)
			elseif( has_post_format('image') && has_post_thumbnail() ):
				$selectedsidebar = get_post_meta($post->ID, 'epic_selectsidebar',true);
				echo epic_image($post->ID,'Thumbnail-900','permalink');
						
			// If post format is set to video... (video.php)
			elseif( has_post_format('video')):
				get_template_part('video');
			endif; 
	echo '</div>';					
	}
}

/* Post content */
//echo subMenu($post->ID);

epic_article_alpha();


if($format != '' && $mediasize == 'regular' && !is_singular('portfolio')){
		
						
						// If post format is set to gallery... (gallery.php)
						if( has_post_format('gallery')):
						include(locate_template('gallery.php'));	
						
						 // If post format is set to image... (postimage.php)
						elseif( has_post_format('image') && has_post_thumbnail() ):
						$selectedsidebar = get_post_meta($post->ID, 'epic_selectsidebar',true);
									
						if($selectedsidebar != 'No Sidebar'):
							echo epic_image($post->ID,'Thumbnail-590','permalink');
						else:
							echo epic_image($post->ID,'Thumbnail-900','permalink');
						endif;
									
						// If post format is set to video... (video.php)
						elseif( has_post_format('video')):
							get_template_part('video');
						endif; 
						

}

global $post;

if (have_posts()) : the_post();
 
 	if(is_singular('portfolio')){
 	
 		
 	
 		echo '<div class="two-third">';
 					
 						if( has_post_format('gallery')):
 						$mediasize = 'portfolio';
						include(locate_template('gallery.php'));	
						
					
						elseif( has_post_format('image') && has_post_thumbnail() ):
						echo epic_image($post->ID,'Featured-portfolio','permalink');
						
									
						// If post format is set to video... (video.php)
						elseif( has_post_format('video')):
						get_template_part('video');
						
						
						else:
						echo epic_image($post->ID,'Featured-portfolio','permalink');
						endif; 
 		
 		echo '</div>';
 		echo '<div  class="one-third last">';
 			
 				$taxonomy = 'portfoliocategory';
				$terms = get_the_term_list($post->ID, $taxonomy,'',', ','');
				if($terms){
				echo $terms ;
				}
			echo '<a href="#" id="close_post"></a>';
			echo '<div id="postnav">';
 			previous_post(' %', '<span class="prevpost-icon"></span>', 'no'); 
			next_post(' %', '<span class="nextpost-icon"></span>', 'no');
 			echo '</div>';
			
			echo '<hr/>';
			
 			echo '<h2>';
 			echo get_the_title();
 			echo '</h2>';
 			
 			echo '<h4>';
 			echo get_the_excerpt();
 			echo '</h4>';
 			
 			the_content($post->ID);
 			
 			$websitelink = get_post_meta($post->ID,'epic_website',true);
 			if($websitelink){
 			echo '<a href="'.$websitelink.'" rel="external" class="epic_link">Visit website</a>';
 			}
 			
 		
 			
 		echo '</div>';
 		
 		echo '<hr/>';
 	
 		if (comments_open() && $disabled_comments == false){ comments_template();}
 	}
 	
	 elseif(is_single()){
		
	 	the_content($post->ID);	 	
		epic_post_meta(); 	
		previous_post_link('<span class="prevpost">%link</span>');
		next_post_link('<span class="nextpost">%link</span>');
		echo '<hr/>';
	
	 	/* Insert comments if not disabled  */
		if (comments_open() && $disabled_comments == false){ comments_template();}
	 }
	 
	 else{
	 		
			the_content($post->ID);
			
	 }
	 
	 //epic_post_pagination();
		 
	 endif; 
	 
	
	 epic_article_omega();
	 
	 
	 if($sidebar_position != 'sidebar_none' && !is_singular('portfolio')){
	 get_sidebar();
	 }
	 
	 ?>
	</div>
</div>