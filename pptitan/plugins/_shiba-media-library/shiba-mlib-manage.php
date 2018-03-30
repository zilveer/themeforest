<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists("Shiba_Media_Library_Manage")) :

class Shiba_Media_Library_Manage {

	function Shiba_Media_Library_Manage() {
		global $shiba_mlib;
		add_action('admin_head', array($this,'admin_header'));

		add_filter('manage_gallery_posts_columns', array($this, 'gallery_columns'));
		add_action('manage_posts_custom_column', array($this,'manage_gallery_columns'), 10, 2);
	}

			
	function admin_header() {
	}
	
	function gallery_columns($posts_columns) {
		$new_columns['cb'] = '<input type="checkbox" />';
		
		$new_columns['id'] = __('ID');
		$new_columns['new_icon'] = '';
		$new_columns['title'] = _x('Gallery Name', 'column name');
		$new_columns['images'] = __('Images');
		$new_columns['author'] = __('Author');
		
		$new_columns['gallery_categories'] = __('Categories');
		$new_columns['gallery_tags'] = __('Tags');
	
		$new_columns['date'] = _x('Date', 'column name');
	
		return $new_columns;
	}
				
	function manage_gallery_columns($column_name, $id) {
		global $shiba_mlib, $wpdb, $post;
		switch ($column_name) {
		case 'id':
			echo $id;
		break;

		case 'new_icon':
			$attachment_id = 0;
			if (function_exists('get_post_thumbnail_id')) 
				$attachment_id = get_post_thumbnail_id($post->ID);
			
			// wp_mime_type_icon throws a notice error in 3.1 RC2 when wp_get_attchment_image is called
			if (!$attachment_id) {
				echo '<img width="46" height="60" src="'.includes_url('images/crystal/default.png').'" class="attachment-80x60" />';

				break;
			}		
			if ( $thumb = wp_get_attachment_image( $attachment_id, array(80, 60), true ) ) {
				if ( $post->post_status == 'trash' ) echo $thumb;
				else {
				$attachment = get_post($attachment_id);	
				echo '	
				<a href="media.php?action=edit&amp;attachment_id='.$attachment_id.'" title="'.esc_attr(sprintf(__('Edit &#8220;%s&#8221;'), $attachment->post_title)).'">';
				echo $thumb;
				echo "</a>\n";
				}
			}
			break;		
			
		case 'images':
			$gallery_type = get_post_meta($id, '_gallery_type', TRUE);
			if (!$gallery_type) $gallery_type = 'attachment';

			$args = array(
					'post_parent' => $id,
					'post_type' => $gallery_type,
					'posts_per_page' => -1,	
					'post_status' => 'any',
					'suppress_filters' => TRUE
				); 
			$tmp_query = new WP_Query;
			$images = $tmp_query->query($args); 
			
			echo count($images); 
			unset($tmp_query); unset($images);
			break;
		case 'gallery_categories':
			$categories = get_the_category();
			if ( !empty( $categories ) ) {
				$out = array();
				foreach ( $categories as $c )
					$out[] = "<a href='edit.php?post_type=gallery&amp;category_name=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'category', 'display')) . "</a>";
					echo join( ', ', $out );
			} else {
				_e('Uncategorized');
			}
			break;

		case 'gallery_tags':
			$tags = get_the_tags($post->ID);
			if ( !empty( $tags ) ) {
				$out = array();
				foreach ( $tags as $c )
					$out[] = "<a href='edit.php?post_type=gallery&amp;tag=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'post_tag', 'display')) . "</a>";
				echo join( ', ', $out );
			} else {
				_e('No Tags');
			}
			break;
		case 'gallery_order': ?>
        	<input class='menu_order_input' type='text' id='menu_order[]' name='menu_order[]' value='' />
 			<?php 
			break;
		default:
			break;
		} // end switch
	}	
} // end Shiba_Media_Library_Manage class
endif;
?>