<?php
/*
* @KingSize 2015
** Add Slider Post Type **
*/
function kingsize_create_post_type_sliders() 
{
	$labels = array(
		'name' => __( 'Slider', 'kslang'),
		'singular_name' => __( 'Slider', 'kslang' ),
		'add_new' => __('Add New', 'slide', 'kslang'),
		'add_new_item' => __('Add New Slider', 'kslang'),
		'edit_item' => __('Edit Slider', 'kslang'),
		'new_item' => __('New Slider', 'kslang'),
		'view_item' => __('View Slider', 'kslang'),
		'search_items' => __('Search Slider', 'kslang'),
		'not_found' =>  __('No sliders found', 'kslang'),
		'not_found_in_trash' => __('No sliders found in Trash', 'kslang'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => true,
		'publicly_queryable' => true,
		'rewrite' => array('slug' => 'slider'),
		'show_ui' => true, 
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
	    'supports' => array('title','editor','author','thumbnail','excerpt','page-attributes') //,'custom-fields'
	  ); 
	  
	  register_post_type('slider',$args);
}




function kingsize_build_taxonomies_slider(){
	register_taxonomy("slider-category", array("slider"), array("hierarchical" => true, "label" => __( "Slider Categories", "kslang" ), "singular_label" => __( "Categories", "kslang" ), "rewrite" => array('slug' => 'slider-category', 'hierarchical' => true))); 
}


function kingsize_slider_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __( 'Slider Item Title', 'kslang' ),
            "slider_categories" => __( 'Slider Categories', 'kslang' ),
			"slider_image" => __('Image', 'kslang'),
			"date" => __('Date', 'kslang')
        );  
  
        return $columns;  
}  
  
function kingsize_slider_custom_columns($column){  
        global $post;  

        switch ($column)  
        {    
            case "slider_categories":  
                echo get_the_term_list($post->ID, 'slider-category', '', ', ','');  
                break;
			case "slider_image":
					if(has_post_thumbnail()) {						
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
						$url_img = wm_image_resize('50','50', $image[0]);
						echo '<img src="'.$url_img.'" width="'.$image[width].'" height="'.$image[height].'" alt="" />';
					}
				break;	
        }  
}  

add_action( 'init', 'kingsize_create_post_type_sliders' );
add_action( 'init', 'kingsize_build_taxonomies_slider', 0 );
add_filter("manage_edit-slider_columns", "kingsize_slider_edit_columns");  
add_action("manage_posts_custom_column",  "kingsize_slider_custom_columns");

/*
////////////////////////////////////////////////////////
###### Move old to new Slider Post Type ######
$args_slider = array(    
    'post_type' => 'slider',
    'post_status' => 'publish' ); 
$slider_posts_array = get_posts( $args_slider );

if(count($slider_posts_array) == 0 ) :

		global $wpdb;
		define('PHOTO_TABLE', $wpdb->prefix . 'kingsize_photos');

	if(count($wpdb->query("SHOW TABLES LIKE '".PHOTO_TABLE."'")) == 1) :

		global $wpdb;
		$photos = $wpdb->get_results("SELECT * FROM " . PHOTO_TABLE . " WHERE album=1 ORDER BY p_order ASC", 'ARRAY_A');

		if (empty($photos)) {
			return false;
		} else {

			foreach ($photos as $photo) {
				
				// Create post object
				  $slider_post = array(
					 'post_title' => 'Slider'.$photo['id'],
					 'post_content' => '',
					 'post_status' => 'publish',
					 'post_type' => 'slider',
					 'post_status' => 'publish',
					 'tax_input' => array(
							'slider-category' => $terms,
						)
				  );
				 // Insert the post into the database
				  $slider_id = wp_insert_post( $slider_post );

				

				  ///Moving the slider file	
				  if($slider_id > 0) :

					  $kingsize_dir = ABSPATH . 'wp-content/uploads/background/';
					  $filename = $kingsize_dir.$photo['id'].".".$photo['ext'];

					  $wp_filetype = wp_check_filetype(basename($filename), null );
					  $wp_upload_dir = wp_upload_dir();

					  $attachment = array(
						 'guid' => $wp_upload_dir['baseurl'] . _wp_relative_upload_path( $filename ), 
						 'post_mime_type' => $wp_filetype['type'],
						 'post_title' => preg_replace('/\.[^.]+$/', '', basename($photo['ext'])),
						 'post_content' => '',
						 'post_status' => 'inherit'
					  );

					  $attach_id = wp_insert_attachment( $attachment, $filename, 37 );

					  // you must first include the image.php file
					  // for the function wp_generate_attachment_metadata() to work
					  require_once(ABSPATH . 'wp-admin/includes/image.php');
					  $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
					  wp_update_attachment_metadata( $attach_id, $attach_data );
					
					  set_post_thumbnail( $slider_id, $attach_id );
				  endif;

  				  $wpdb->query("DELETE FROM " . PHOTO_TABLE . " WHERE id={$photo['id']} LIMIT 1"); //deleting inserted old data

			}
		}

   endif;

endif;*/
?>