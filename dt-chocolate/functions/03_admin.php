<?php
// custon columns

// portfolio
add_filter('manage_edit-dt_portfolio_columns', 'dt_columns', 5);
// slider
add_filter('manage_edit-main_slider_columns', 'dt_columns', 5);
// benefits
add_filter('manage_edit-dt_gallery_plus_columns', 'dt_columns', 5);

// for portfolio and slider
function dt_columns($defaults){
    $defaults['dt_thumbs'] = __('Thumbs', 'dt');
    return $defaults;
}

add_action('manage_posts_custom_column', 'dt_custom_columns', 5, 2);

function dt_custom_columns($column_name, $id){
	if($column_name === 'dt_thumbs'){	
		$thumb_id = get_post_thumbnail_id($id);
		
		if( $thumb_id ) {
			$img = wp_get_attachment_image_src($thumb_id, 'thumbnail');
			$img = $img[0];
		}else {
			$args = array(
				'post_type'			=> 'attachment',
				'post_parent'		=> $id,
				'post_status'		=> 'inherit',
				'orderby'			=> 'menu_order',
				'order'				=> 'ASC',
				'posts_per_page'	=> 1
			);
			$attachment = new Wp_Query($args);
			if( !empty($attachment->posts) ) {
				$img = wp_get_attachment_image_src($attachment->posts[0]->ID, 'thumbnail');
				$img = $img[0];
			}else {
				$img = get_template_directory_uri(). '/images/noimage_thumbnail.jpg';
			}
		}
		printf( '<a href="post.php?post=%d&action=edit" title=""><img width="100px" height="100px" src="%s" alt=""/></a>',
			$id,
			$img
		);
    }
}

// end

function my_admin_scripts() {
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_register_script('my-upload', get_template_directory_uri().'/js/admin-uploader-script.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('my-upload');
}

function my_admin_styles() {
	wp_enqueue_style('thickbox');
}



