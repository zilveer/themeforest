<?php
/*-----------------------------------------------------------------------------------*/
/* Manage slideshow's columns */
/*-----------------------------------------------------------------------------------*/
function edit_slideshow_columns($columns) {
	$columns['slideshow_category'] = __('Categories', 'theme_admin' );
	$columns['author'] = __('Author', 'theme_admin' );
	$columns['thumbnail'] = __('Thumbnail', 'theme_admin' );
	
	return $columns;
}
add_filter('manage_edit-slideshow_columns', 'edit_slideshow_columns');

function manage_slideshow_columns($column) {
	global $post;
	
	if ($post->post_type == "slideshow") {
		switch($column){
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
			case "slideshow_category":
				$terms = get_the_terms($post->ID, 'slideshow_category');
				
				if (! empty($terms)) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=slideshow&slideshow_category=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'slideshow_category', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('slideshow_category');
					$output = "No $t->label";
				}
				
				echo $output;
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_slideshow_columns', 10, 2);
/*-----------------------------------------------------------------------------------*/
/* Add image size for slideshow */
/*-----------------------------------------------------------------------------------*/
if ((isset($_REQUEST['post_id']) && get_post_type($_REQUEST['post_id']) == 'slideshow') || 
	(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')) {
	add_image_size('slideshow', 960, 440, true);
}

/*-----------------------------------------------------------------------------------*/
/* Add scripts and styles for slideshow */
/*-----------------------------------------------------------------------------------*/
if(theme_is_post_type_edit('slideshow') || theme_is_post_type_new('slideshow')){
	wp_deregister_script('autosave');
}
