<?php
add_action( 'admin_init', 'vp_meta_boxes');
function vp_meta_boxes() {
	add_meta_box('vp_pagetemplates_meta', 'Page Template Settings', 'vp_pagetemplates_meta', 'page', 'side');
}
//*********** Page Templates Area **************

function vp_pagetemplates_meta() {
	global $post;
	$temp = maybe_unserialize(get_post_meta($post->ID,'vp_ptemplate_settings',true));
	$categories = isset($temp['categories']) ? $temp['categories'] : '';
	$blog_posts = isset($temp['blog_posts']) ? $temp['blog_posts'] : '';
	$fullwidth = isset($temp['fullwidth']) ? $temp['fullwidth'] : '1';
?>
		Here you'll see some page template options(just for the theme specific page templates)
		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<label style="font-weight: bold" for="vp_fullwidth">Full width page?</label>
			<input type="checkbox" name="vp_fullwidth" id="vp_fullwidth" value="" <?php checked( $fullwidth ); ?> />
		</div>
		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<h4>Select categories to include: </h4>
					
			<?php $cats_array = get_categories('hide_empty=0');
			foreach ($cats_array as $cat) {
				$checked = '';
				
				if (!empty($categories)) {
					if (in_array($cat->cat_ID, $categories)) $checked = "checked=\"checked\"";
				} ?>
				
				<label style="padding-bottom: 5px; display: block" for="<?php echo 'cat-' . $cat->cat_ID; ?>">
					<input type="checkbox" name="vp_categories[]" id="<?php echo 'cat-' . $cat->cat_ID; ?>" value="<?php echo $cat->cat_ID; ?>" <?php echo $checked; ?> />
					<?php echo $cat->cat_name; ?>
				</label>							
			<?php } ?>
		</div>

		<div style="margin: 15px 0px 15px 0px; display: none" class="blog">
			<label style="font-weight: bold" for="vp_blogposts">Number of blog posts per page:</label>
			<input size="2" type="text" name="vp_blogposts" id="vp_blogposts" value="<?php if($blog_posts == '') echo '6'; else echo $blog_posts;?>" />
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function() {	
				var page_template = jQuery('select#page_template'),
					page_template_div = jQuery('#vp_pagetemplates_meta');
				page_template.on('change', function() {
					page_template_div.find('.inside > div').css('display','none');
					var ptval = jQuery(this).val();
					if(ptval === "page-template-blog.php")
						jQuery("div.blog").show(400);
				});
				page_template.trigger('change');				
			});
		</script>
<?php 
}
add_action('save_post', 'vp_save_ptemplate_settings', 10, 2);
function vp_save_ptemplate_settings($post_id, $post) 
{
	// verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
   		 return;
   	// Check permissions
    if ( 'page' == $post->post_type )  
    {
 	   if ( !current_user_can( 'edit_page', $post_id ) )
       		 return;
 	}
  	else
  	{
    	if ( !current_user_can( 'edit_post', $post_id ) )
        	return;	
    }
    $temp = array();
    if(isset($_POST['vp_fullwidth']))
    	$temp['fullwidth'] = 1;
    else
    	$temp['fullwidth'] = 0;
    if(isset($_POST['vp_categories']))
    {
    		$temp['categories'] = (array)$_POST['vp_categories'];
    }
    else
    	$temp['categories'] = '';

    if(isset($_POST['vp_blogposts']) != '' && is_numeric($_POST['vp_blogposts']) )
    	$temp['blog_posts'] = (int)$_POST['vp_blogposts'];
    else
    	$temp['blog_posts'] = 6; 
    update_post_meta($post_id, 'vp_ptemplate_settings', $temp);
}

?>