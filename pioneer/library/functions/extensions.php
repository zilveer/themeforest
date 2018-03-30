<?php

/* ===================================================================
 *  
 * These functions change core Wordpress functionality
 *
 *  Since ver. 1.0
 *
===================================================================*/




/**
 * Makes custom image sizes selectable for manual insertion in posts and pages
 *
 * Only if default wordpress image resizing is selected
 *
 * Since version 1.0
 *
 */
 
function epic_get_additional_image_sizes() {
    $sizes = array();
    global $_wp_additional_image_sizes;
    if (isset($_wp_additional_image_sizes) && count($_wp_additional_image_sizes)) {
        $sizes = apply_filters('intermediate_image_sizes', $_wp_additional_image_sizes);
        $sizes = apply_filters('epic_get_additional_image_sizes', $_wp_additional_image_sizes);
    }
    return $sizes;
}

function epic_additional_image_size_input_fields($fields, $post) {
    if (!isset($fields['image-size']['html']) || substr($post->post_mime_type, 0, 5) != 'image') return $fields;
    $s = '';
    $sizes = epic_get_additional_image_sizes();
    if (!count($sizes)) return $fields;
    $items = array();
    foreach(array_keys($sizes) as $size) {
        $downsize = image_downsize($post->ID, $size);
        $enabled = $downsize[3];
        $css_id = "image-size-{$s}-{$post->ID}";
        $label = apply_filters('epic_image_size_name', $size);
        $html = "<div class='image-size-item'>\n";
        $html.= "\t<input type='radio' " . disabled($enabled, false, false) . "name='attachments[{$post->ID}][image-size]' id='{$css_id}' value='{$size}' />\n";
        $html.= "\t<label for='{$css_id}'>{$label}</label>\n";
        if ($enabled) $html.= "\t<label for='{$css_id}' class='help'>" . sprintf("(%d&nbsp;&times;&nbsp;%d)", $downsize[1], $downsize[2]) . "</label>\n";
        $html.= "</div>";
        $items[] = $html;
    }
    $items = join("\n", $items);
    $fields['image-size']['html'] = "{$fields['image-size']['html']}\n{$items}";
    return $fields;
}

add_filter('attachment_fields_to_edit', 'epic_additional_image_size_input_fields', 11, 2);



/**
 * Prevent "read more" jump
 *
 * Since ver. 1.0
 *
 */

if (!function_exists('epic_remove_more_jump_link')) {
    function remove_more_jump_link($link) {
        $offset = strpos($link, '#more-');
        if ($offset) {
            $end = strpos($link, '"', $offset);
        }
        if ($end) {
            $link = substr_replace($link, '', $offset, $end - $offset);
        }
        return $link;
    }
    //add_filter('the_content_more_link', 'epic_remove_more_jump_link');
}




/**
 * Filter the body_class to insert custom classes.
 *
 * Inserts i.e. class fullwidth for pages/posts with no sidebar selected.
 *
 * @ Since ver.1,0
 */



function epic_body_classes($classes) {
		
	global $post;
	
     	
  if(is_archive() || is_search()){
  		
  		$classes[] = 'regular';
  		$classes[] = 'sidebar_right';
  		
  	}
  	
 	elseif(is_tax('portfoliocategory')){
  		$classes[] = 'fullwidth';
   	}
    
	return $classes;
}

add_filter('body_class','epic_body_classes');


function epic_post_classes($classes) {
		
	global $post;
	
		
            
    return $classes;
}

//add_filter('post_class','epic_post_classes');






//add extra fields to category edit form callback function
function extra_category_fields($tag) { //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option("category_$t_id");
?>
<tr class="form-field">
<th scope="row" valign="top"><label for="cat_Image_url"><?php _e('Category Image Url','epic'); ?></label></th>
<td>
<input type="text" name="Cat_meta[img]" id="Cat_meta[img]" size="3" style="width:60%;" value="<?php echo $cat_meta['img'] ? $cat_meta['img'] : ''; ?>"><br />
            <span class="description"><?php _e('Image for category: use full url with http://', 'epic'); ?></span>
        </td>
</tr>

<?php
}
//add extra fields to category edit form hook
//add_action('edit_category_form_fields', 'extra_category_fields');





// save extra category extra fields callback function
function save_extra_category_fileds($term_id) {
    if (isset($_POST['Cat_meta'])) {
        $t_id = $term_id;
        $cat_meta = get_option("category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
        foreach($cat_keys as $key) {
            if (isset($_POST['Cat_meta'][$key])) {
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option("category_$t_id", $cat_meta);
    }
}
// save extra category extra fields hook
add_action('edited_category', 'save_extra_category_fileds');


/** 
 * Fixes Wordpress bug that sometimes "Insert into post" button disappears. 
 * This script forces the button to be visible. 
 */

add_filter('get_media_item_args', 'allow_img_insertion');
function allow_img_insertion($vars) {
    $vars['send'] = true; // 'send' as in "Send to Editor"
    return($vars);
}


/** 
 * This function is required to make user registration work
 *
 * @ Since ver. 1.0
 */
function epic_user_registration_head(){

require_once( ABSPATH . WPINC . '/user.php' );
require_once( ABSPATH . 'wp-admin/includes' . '/template.php' ); // this is only for the selected() function
$registration = get_option( 'users_can_register' );
 
/* If user registered, input info. */
if ( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['action'] ) && ( $_POST['action'] == 'adduser' ||  $_POST['action'] == 'add_user')) {
	$user_pass = wp_generate_password();
	$userdata = array(
		'user_pass' => $user_pass,
		'user_login' => esc_attr( $_POST['user_name'] ),
		'user_email' => esc_attr( $_POST['user_email'] ),
		'role' => get_option( 'default_role' ),
	);
 
	if ( !$userdata['user_login'] )
		$error = __('A username is required for registration.', 'epic');
	elseif ( username_exists($userdata['user_login']) )
		$error = __('Sorry, that username already exists!', 'epic');
 
	elseif ( !is_email($userdata['user_email'], true) )
		$error = __('You must enter a valid email address.', 'epic');
	elseif ( email_exists($userdata['user_email']) )
		$error = __('Sorry, that email address is already used!', 'epic');
 
	else{
		$new_user = wp_insert_user( $userdata );
		wp_new_user_notification($new_user, $user_pass);
 		$success = '';
 		$success .= __('Thank you for registering at','epic').get_bloginfo('name').'<br/>';
 		$success .= __('A message containing your password will be sent to your email address','epic');
 		//$hideform = true;
	}
 
}


}

//add_action('wp_head','epic_user_registration_head');


/* Extend Walker_Nav_Menu class to create page-menu */
class pagemenu_walker extends Walker_Nav_Menu {
      function start_el( &$output, $item, $depth, $args){
          
           global $wp_query;
           global $post;
           
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;

           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
           $class_names = ' class="'. esc_attr( $class_names ) . '"';

           $output .= $indent . '<li ' . $value . $class_names .'>';

           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

           $description  = ! empty( $item->description ) ? ''.esc_attr( $item->description ).'' : '';
			
           if($depth != 0){
              $description = $append = $prepend = "";
           }

           $item_output = $args->before;
           $item_output .= '';
           
           if($depth == 0){
          
           $item_output .= $args->link_before .'<a'. $attributes .'>'.apply_filters( 'the_title', $item->title, $item->ID ).'<br/><span class="desc">';
           $item_output .= $description;
           $item_output .= $args->link_after.'</span></a>';
            
           $item_output .= $args->after;
		   }

			if($depth != 0){
            $item_output .= $args->link_before;
            $item_output .= '<a'. $attributes .'>'.apply_filters( 'the_title', $item->title, $item->ID ).'</a>';
            
            $item_output .= $args->link_after;
            }

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
            } 
            
}
?>