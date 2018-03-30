<?php

/**
 * The PHP code for setup Theme page custom fields.
 *
 * @package WordPress
 */


/*
	Begin creating custom fields
*/

$args = array(
    'numberposts' => -1,
    'post_type' => array('gallery'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
	$galleries_select[$gallery->ID] = $gallery->post_title;
}

$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar',
);

$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

$page_postmetas = 
	array (
		/*
			Begin Page custom fields
		*/
		
		array("section" => "Content Gallery", "title" => "Content Gallery", "id" => "page_gallery_id", "type" => "select", "description" => "If you select \"Gallery\" page template. Select a gallery here:", "items" => $galleries_select),
		
		array("section" => "Password Protect", "title" => "Password Protect", "id" => "page_gallery_password", "description" => "Enter your password for the gallery"),
		
		array("section" => "Select Sidebar (If has)", "title" => "Select Sidebar", "id" => "page_sidebar", "type" => "select", "description" => "Select this page's sidebar to display", "items" => $theme_sidebar),
		/*
			End Page custom fields
		*/
		
	);
?>
<?php

function page_create_meta_box() {

	global $page_postmetas;
	if ( function_exists('add_meta_box') && isset($page_postmetas) && count($page_postmetas) > 0 ) {  
		add_meta_box( 'page_metabox', 'Page Options', 'page_new_meta_box', 'page', 'side', 'high' );  
	}

}  

function page_new_meta_box() {
	global $post, $page_postmetas;

	echo '<input type="hidden" name="myplugin_noncename" id="myplugin_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<br/>';
	
	$meta_section = '';

	foreach ( $page_postmetas as $postmeta ) {

		$meta_id = $postmeta['id'];
		$meta_title = $postmeta['title'];
		$meta_description = $postmeta['description'];
		$meta_section = $postmeta['section'];
		
		$meta_type = '';
		if(isset($postmeta['type']))
		{
			$meta_type = $postmeta['type'];
		}
		
		echo "<strong>".$meta_title."</strong><hr class='pp_widget_hr'/>";

		echo "<div class='pp_widget_description'>$meta_description</div>";

		if ($meta_type == 'checkbox') {
			$checked = get_post_meta($post->ID, $meta_id, true) == '1' ? "checked" : "";
			echo "<input type='checkbox' name='$meta_id' id='$meta_id' value='1' $checked /></p>";
		}
		else if ($meta_type == 'select') {
			echo "<p><select name='$meta_id' id='$meta_id'>";
			
			if(!empty($postmeta['items']))
			{
				foreach ($postmeta['items'] as $item_key => $item)
				{
					$page_style = get_post_meta($post->ID, $meta_id);
				
					if(isset($page_style[0]) && $item_key == $page_style[0])
					{
						$css_string = 'selected';
					}
					else
					{
						$css_string = '';
					}
				
					echo '<option value="'.$item_key.'" '.$css_string.'>'.$item.'</option>';
				}
			}
			
			echo "</select></p>";
		}
		else {
			echo "<p><input type='text' name='$meta_id' id='$meta_id' class='code' value='".get_post_meta($post->ID, $meta_id, true)."' style='width:99%' /></p>";
		}
	}
	
	echo '<br/>';

}

function page_save_postdata( $post_id ) {

	global $page_postmetas;

	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times

	if ( isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	}

	// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want to do anything

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return $post_id;

	// Check permissions

	if ( isset($_POST['post_type']) && 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	// OK, we're authenticated

	if ( $parent_id = wp_is_post_revision($post_id) )
	{
		$post_id = $parent_id;
	}

	foreach ( $page_postmetas as $postmeta ) {
	
		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']]) {
			page_update_custom_meta($post_id, $_POST[$postmeta['id']], $postmeta['id']);
		}

		if (isset($_POST[$postmeta['id']]) && $_POST[$postmeta['id']] == "") {
			delete_post_meta($post_id, $postmeta['id']);
		}
	}

}

function page_update_custom_meta($postID, $newvalue, $field_name) {

	if (!get_post_meta($postID, $field_name)) {
		add_post_meta($postID, $field_name, $newvalue);
	} else {
		update_post_meta($postID, $field_name, $newvalue);
	}

}

//init

add_action('admin_menu', 'page_create_meta_box'); 
add_action('save_post', 'page_save_postdata'); 

/*
	End creating custom fields
*/

?>
