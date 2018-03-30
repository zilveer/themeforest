<?php
/*@todo - AHSAN */
add_filter('wp_nav_menu_items', 'do_shortcode');
/* End */ 
define('Z_IMAGE_PLACEHOLDER', mango_uri."/images/placeholder.png");
// l10n
//load_plugin_textdomain('zci', FALSE, 'categories-images/languages');
add_action('admin_init', 'mango_cat_init');
function mango_cat_init() {
    $z_taxonomies = get_taxonomies();
    if (is_array($z_taxonomies)) {
        $zci_options = get_option('zci_options');
        if (empty($zci_options['excluded_taxonomies']))
            $zci_options['excluded_taxonomies'] = array();
        foreach ($z_taxonomies as $z_taxonomy) {
            if (in_array($z_taxonomy, $zci_options['excluded_taxonomies']))
                continue;
            add_action($z_taxonomy.'_add_form_fields', 'mango_add_texonomy_field');
            add_action($z_taxonomy.'_edit_form_fields', 'mango_edit_texonomy_field');
            add_filter( 'manage_edit-' . $z_taxonomy . '_columns', 'mango_taxonomy_columns' );
            add_filter( 'manage_' . $z_taxonomy . '_custom_column', 'mango_taxonomy_column', 10, 3 );
        }
    }
}
// add image field in add form
function mango_add_texonomy_field() {
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    }
    echo '<div class="form-field">
		<label for="taxonomy_image">' . __('Image', 'mango') . '</label>
		<input type="text" name="taxonomy_image" id="taxonomy_image" value="" />
		<br/>
		<button class="z_upload_image_button button">' . __('Upload/Add image', 'mango') . '</button>
	</div>'.mango_script();
}
// add image field in edit form
function mango_edit_texonomy_field($taxonomy) {
    /* if already enqueue so remove this code */
    if (get_bloginfo('version') >= 3.5)
        wp_enqueue_media();
    else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
    } /* if already enqueue so remove this code */
    if (mango_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) == Z_IMAGE_PLACEHOLDER)
        $image_text = "";
    else
        $image_text = mango_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE );
    echo '<tr class="form-field">
		<th scope="row" valign="top"><label for="taxonomy_image">' . __('Image', 'mango') . '</label></th>
		<td><img class="taxonomy-image" src="' .esc_url( mango_taxonomy_image_url( $taxonomy->term_id, NULL, TRUE ) ). '"/><br/><input type="text" name="taxonomy_image" id="taxonomy_image" value="'.esc_attr($image_text).'" /><br />
		<button class="z_upload_image_button button">' . __('Upload/Add image', 'mango') . '</button>
		<button class="z_remove_image_button button">' . __('Remove image', 'mango') . '</button>
		</td>
	</tr>'.mango_script();
}
// upload using wordpress upload
function mango_script() {
    return '<script type="text/javascript">
	    jQuery(document).ready(function($) {
			var wordpress_ver = "'.get_bloginfo("version").'", upload_button;
			$(".z_upload_image_button").click(function(event) {
				upload_button = $(this);
				var frame;
				if (wordpress_ver >= "3.5") {
					event.preventDefault();
					if (frame) {
						frame.open();
						return;
					}
					frame = wp.media();
					frame.on( "select", function() {
						// Grab the selected attachment.
						var attachment = frame.state().get("selection").first();
						frame.close();
						if (upload_button.parent().prev().children().hasClass("tax_list")) {
							upload_button.parent().prev().children().val(attachment.attributes.url);
							upload_button.parent().prev().prev().children().attr("src", attachment.attributes.url);
						}
						else
							$("#taxonomy_image").val(attachment.attributes.url);
					});
					frame.open();
				}
				else {
					tb_show("", "media-upload.php?type=image&amp;TB_iframe=true");
					return false;
				}
			});
			$(".z_remove_image_button").click(function() {
				$("#taxonomy_image").val("");
				$(this).parent().siblings(".title").children("img").attr("src","' . Z_IMAGE_PLACEHOLDER . '");
				$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				return false;
			});
			if (wordpress_ver < "3.5") {
				window.send_to_editor = function(html) {
					imgurl = $("img",html).attr("src");
					if (upload_button.parent().prev().children().hasClass("tax_list")) {
						upload_button.parent().prev().children().val(imgurl);
						upload_button.parent().prev().prev().children().attr("src", imgurl);
					}
					else
						$("#taxonomy_image").val(imgurl);
					tb_remove();
				}
			}
			$(".editinline").live("click", function(){  
			    var tax_id = $(this).parents("tr").attr("id").substr(4);
			    var thumb = $("#tag-"+tax_id+" .thumb img").attr("src");
				if (thumb != "' . Z_IMAGE_PLACEHOLDER . '") {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val(thumb);
				} else {
					$(".inline-edit-col :input[name=\'taxonomy_image\']").val("");
				}
				$(".inline-edit-col .title img").attr("src",thumb);
			    return false;  
			});  
	    });
	</script>';
}
// save our taxonomy image while edit or save term
add_action('edit_term','mango_save_taxonomy_image');
add_action('create_term','mango_save_taxonomy_image');
function mango_save_taxonomy_image($term_id) {
    if(isset($_POST['taxonomy_image']))
        update_option('mango_taxonomy_image'.$term_id, $_POST['taxonomy_image']);
}
// get attachment ID by image url
function mango_get_attachment_id_by_url($image_src) {
    global $wpdb;
    $query = "SELECT ID FROM {$wpdb->posts} WHERE guid = '$image_src'";
    $id = $wpdb->get_var($query);
    return (!empty($id)) ? $id : NULL;
}
// get taxonomy image url for the given term_id (Place holder image by default)
function mango_taxonomy_image_url($term_id = NULL, $size = NULL, $return_placeholder = FALSE) {
    if (!$term_id) {
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    $taxonomy_image_url = get_option('mango_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = mango_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id)) {
            if (empty($size))
                $size = 'full';
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            $taxonomy_image_url = $taxonomy_image_url[0];
        }
    }
    if ($return_placeholder)
        return ($taxonomy_image_url != '') ? $taxonomy_image_url : Z_IMAGE_PLACEHOLDER;
    else
        return $taxonomy_image_url;
}
function mango_quick_edit_custom_box($column_name, $screen, $name) {
    if ($column_name == 'thumb')
        echo '<fieldset>
		<div class="thumb inline-edit-col">
			<label>
				<span class="title"><img src="" alt="Thumbnail"/></span>
				<span class="input-text-wrap"><input type="text" name="taxonomy_image" value="" class="tax_list" /></span>
				<span class="input-text-wrap">
					<button class="z_upload_image_button button">' . __('Upload/Add image', 'mango') . '</button>
					<button class="z_remove_image_button button">' . __('Remove image', 'mango') . '</button>
				</span>
			</label>
		</div>
	</fieldset>';
}
/**
 * Thumbnail column added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @return void
 */
function mango_taxonomy_columns( $columns ) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumb'] = __('Image', 'mango');
    unset( $columns['cb'] );
    return array_merge( $new_columns, $columns );
}
/**
 * Thumbnail column value added to category admin.
 *
 * @access public
 * @param mixed $columns
 * @param mixed $column
 * @param mixed $id
 * @return void
 */
function mango_taxonomy_column( $columns, $column, $id ) {
    if ( $column == 'thumb' )
        $columns = '<span><img src="' . esc_url( mango_taxonomy_image_url($id, NULL, TRUE) ) . '" alt="' . __('Thumbnail', 'mango') . '" class="wp-post-image" /></span>';
    return $columns;
}
// change 'insert into post' to 'use this image'
function mango_change_insert_button_text($safe_text, $text) {
    return str_replace("Insert into Post", "Use this image", $text);
}
// style the image in category list
if ( strpos( $_SERVER['SCRIPT_NAME'], 'edit-tags.php' ) > 0 ) {
    //add_action( 'admin_head', 'z_add_style' );
    add_action('quick_edit_custom_box', 'mango_quick_edit_custom_box', 10, 3);
    add_filter("attribute_escape", "mango_change_insert_button_text", 10, 2);
}
// get taxonomy image for the given term_id
function mango_taxonomy_image($term_id = NULL, $size = 'full', $attr = NULL, $echo = TRUE) {
    if (!$term_id) {
        if (is_category())
            $term_id = get_query_var('cat');
        elseif (is_tax()) {
            $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $term_id = $current_term->term_id;
        }
    }
    $taxonomy_image_url = get_option('mango_taxonomy_image'.$term_id);
    if(!empty($taxonomy_image_url)) {
        $attachment_id = mango_get_attachment_id_by_url($taxonomy_image_url);
        if(!empty($attachment_id))
            $taxonomy_image = wp_get_attachment_image($attachment_id, $size, FALSE, $attr);
        else {
            $image_attr = '';
            if(is_array($attr)) {
                if(!empty($attr['class']))
                    $image_attr .= ' class="'.$attr['class'].'" ';
                if(!empty($attr['alt']))
                    $image_attr .= ' alt="'.$attr['alt'].'" ';
                if(!empty($attr['width']))
                    $image_attr .= ' width="'.$attr['width'].'" ';
                if(!empty($attr['height']))
                    $image_attr .= ' height="'.$attr['height'].'" ';
                if(!empty($attr['title']))
                    $image_attr .= ' title="'.$attr['title'].'" ';
            }
            $taxonomy_image = '<img src="'.esc_url($taxonomy_image_url).'" '.$image_attr.'/>';
        }
    }
    if ($echo)
        echo $taxonomy_image;
    else
        return $taxonomy_image;
}
if(get_option('icons_to_nav_menus')){
    update_option('icons_to_nav_menus','0');
}
?>