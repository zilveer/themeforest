<?php
function project_taxonomies() {
	register_taxonomy('project-categories', 'project', array(
		'label' => esc_attr__('Project categories', 'multipurpose'),
		'labels' => array(
			'name' => esc_attr__('Project categories', 'multipurpose'),
			'singular_name' => esc_attr__('Project category', 'multipurpose'),
			'menu_name' => esc_attr__('Project categories', 'multipurpose'),
			'all_item' => esc_attr__('All project categories', 'multipurpose'),
			'edit_item' => esc_attr__('Edit project category', 'multipurpose'),
			'view_item' => esc_attr__('View project category', 'multipurpose'),
			'update_item' => esc_attr__('Update project category', 'multipurpose'),
			'add_new_item' => esc_attr__('Add new project category', 'multipurpose'),
			'new_item_name' => esc_attr__('New project category name', 'multipurpose'),
			'parent_item' => esc_attr__('Parent project category', 'multipurpose'),
			'parent_item_colon' => esc_attr__('Parent project category:', 'multipurpose'),
			'search_items' => esc_attr__('Search project categories', 'multipurpose'),
			'popular_items' => esc_attr__('Popular project categories', 'multipurpose'),
			'separate_items_with_commas' => esc_attr__('Separate project categories with commas', 'multipurpose'),
			'add_or_remove_items' => esc_attr__('Add or remove project categories', 'multipurpose'),
			'choose_from_most_used' => esc_attr__('Choose from most used project categories', 'multipurpose'),
			'not_found' => esc_attr__('Project category not found', 'multipurpose')
		),
		'hierarchical' => true
	));
	register_taxonomy('project-skills', 'project', array(
		'label' => esc_attr__('Project skills', 'multipurpose'),
		'labels' => array(
			'name' => esc_attr__('Project skills', 'multipurpose'),
			'singular_name' => esc_attr__('Project skill', 'multipurpose'),
			'menu_name' => esc_attr__('Project skills', 'multipurpose'),
			'all_item' => esc_attr__('All project skills', 'multipurpose'),
			'edit_item' => esc_attr__('Edit project skill', 'multipurpose'),
			'view_item' => esc_attr__('View project skill', 'multipurpose'),
			'update_item' => esc_attr__('Update project skill', 'multipurpose'),
			'add_new_item' => esc_attr__('Add new project skill', 'multipurpose'),
			'new_item_name' => esc_attr__('New project skill name', 'multipurpose'),
			'parent_item' => esc_attr__('Parent project skill', 'multipurpose'),
			'parent_item_colon' => esc_attr__('Parent project skill:', 'multipurpose'),
			'search_items' => esc_attr__('Search project skills', 'multipurpose'),
			'popular_items' => esc_attr__('Popular project skills', 'multipurpose'),
			'separate_items_with_commas' => esc_attr__('Separate project skills with commas', 'multipurpose'),
			'add_or_remove_items' => esc_attr__('Add or remove project skills', 'multipurpose'),
			'choose_from_most_used' => esc_attr__('Choose from most used project skills', 'multipurpose'),
			'not_found' => esc_attr__('Project skill not found', 'multipurpose')
		),
		'hierarchical' => true
	));
}	
add_action('init', 'project_taxonomies');

function register_project() {
	$project_slug = get_theme_mod('project_slug') ? get_theme_mod('project_slug') : 'project';
	register_post_type('project', array(
		'label' => esc_attr__('Projects', 'multipurpose'),
		'labels' => array(
			'name' => esc_attr__('Projects', 'multipurpose'),
			'singular_name' => esc_attr__('Project', 'multipurpose'),
			'menu_name' => esc_attr__('Projects', 'multipurpose'),
			'all_items' => esc_attr__('All projects', 'multipurpose'),
			'add_new' => esc_attr__('Add new', 'multipurpose'),
			'add_new_item' => esc_attr__('Add new project', 'multipurpose'),
			'edit_item' => esc_attr__('Edit project', 'multipurpose'),
			'new_item' => esc_attr__('New project', 'multipurpose'),
			'view_item' => esc_attr__('View project', 'multipurpose'),
			'search_items' => esc_attr__('Search projects', 'multipurpose'),
			'not_found' => esc_attr__('No projects found', 'multipurpose'),
			'not_found_in_trash' => esc_attr__('No projects found in trash', 'multipurpose'),
			'parent_item_colon' => esc_attr__('Parent project:', 'multipurpose')
			),
		'description' => esc_attr__('An item representing a project in a portfolio', 'multipurpose'),
		'public' => true,
		'menu_position' => 10,
		'capability_type' => 'post',
		'register_meta_box_cb' => 'multipurpose_project_metaboxes',
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'post-formats', /*'page-attributes'*/),
		'taxonomies' => array('project-categories', 'project-skills'),
		'rewrite' => array('slug' => $project_slug, 'with_front' => true)
	));	
	flush_rewrite_rules(false);
}
add_action('init', 'register_project');

add_image_size( 'project-thumbnail', 460, 248, true);
add_image_size( 'project-thumbnail-tiny', 66, 66, true);
add_image_size( 'project-thumbnail-medium', 600, 350, true);
add_image_size( 'project-thumbnail-large', 940, 99999, false);
add_image_size( 'project-thumbnail-related', 220, 160, true);

add_action('save_post', 'multipurpose_save_project_data_metabox');
add_action('save_post', 'multipurpose_save_project_video_metabox');
add_action('save_post', 'multipurpose_save_project_layout_metabox');

function multipurpose_project_metaboxes() {
	add_meta_box('project-data', 'Additional project data', 'multipurpose_draw_project_data_metabox', 'project', 'side', 'default');
	add_meta_box('project-video', 'Video', 'multipurpose_draw_project_video_metabox', 'project', 'normal', 'default');
	add_meta_box('project-layout', 'Layout', 'multipurpose_draw_project_layout_metabox', 'project', 'side', 'default');	
}

//project data

function multipurpose_draw_project_data_metabox($post) {
	global $post; 
	$data = get_post_custom($post->ID);
	$url = isset($data['project_meta_url']) ? esc_attr($data['project_meta_url'][0]) : '';
	$copyright = isset($data['project_meta_copyright']) ? esc_attr($data['project_meta_copyright'][0]) : '';

	wp_nonce_field( 'multipurpose_project_metabox_nonce', 'project_metabox_nonce' ); 
	?>
	<p><label for="project_url"><?php esc_attr_e('Project URL:', 'multipurpose'); ?></label><input name="project_url" id="project_url" value="<?php echo $url ?>" /></p>
	<p><label for="project_copyright"><?php esc_attr_e('Copyright by:', 'multipurpose'); ?></label><input name="project_copyright" id="project_copyright" value="<?php echo $copyright ?>" /></p>
	<?php
}

function multipurpose_save_project_data_metabox($project_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset($_POST['project_metabox_nonce']) || !wp_verify_nonce($_POST['project_metabox_nonce'], 'multipurpose_project_metabox_nonce' )) return; 
	if(!current_user_can('edit_post', $project_id)) return; 

	if(isset($_POST['project_url'])) {
		update_post_meta($project_id, 'project_meta_url', strip_tags($_POST['project_url']));
	}
	if(isset($_POST['project_copyright'])) {
		$allowed = array(
			'a' => array(
				'href' => array(),
				'title' => array(),
				),
			'strong' => array()
			);
		update_post_meta($project_id, 'project_meta_copyright', wp_kses($_POST['project_copyright'], $allowed));
	}
}

//video

function multipurpose_draw_project_video_metabox($post) {
	global $post; 
	$data = get_post_custom($post->ID);
	$video = isset($data['project_meta_video']) ? esc_attr($data['project_meta_video'][0]) : '';

	wp_nonce_field( 'multipurpose_project_video_metabox_nonce', 'project_video_metabox_nonce' ); 
	?>
	<p><label for="project_video"><?php esc_attr_e('Put the video embedding code here:', 'multipurpose'); ?></label><textarea name="project_video" id="project_video" rows="5" cols="30" class="widefat"><?php echo $video ?></textarea></p>
	<?php
}

function multipurpose_save_project_video_metabox($project_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset($_POST['project_video_metabox_nonce']) || !wp_verify_nonce($_POST['project_video_metabox_nonce'], 'multipurpose_project_video_metabox_nonce' )) return; 
	if(!current_user_can('edit_post', $project_id)) return; 

	if(isset($_POST['project_url'])) {
		update_post_meta($project_id, 'project_meta_video', trim($_POST['project_video']));
	}
}

//project layout

function multipurpose_draw_project_layout_metabox($post) {
	global $post; 
	$data = get_post_custom($post->ID);
	$layout = isset($data['project_meta_layout']) ? esc_attr($data['project_meta_layout'][0]) : '';
	$img_link = isset($data['project_image_link_hidden']) ? esc_attr($data['project_image_link_hidden'][0]) : '';

	wp_nonce_field( 'multipurpose_project_layout_metabox_nonce', 'project_layout_metabox_nonce' ); 
	?>
	<p><label for="project_layout"><?php esc_attr_e('Presentation:', 'multipurpose'); ?></label><select name="project_layout" id="project_layout">
		<option value="half" <?php if($layout == 'half'): ?>selected="selected"<?php endif; ?>><?php  esc_attr_e('Half page project image', 'multipurpose') ?></option>
		<option value="full" <?php if($layout == 'full'): ?>selected="selected"<?php endif; ?>><?php  esc_attr_e('Full width project image', 'multipurpose') ?></option>		
	</select></p>
	<p><label><input type="checkbox" name="project_image_link_hidden" id="project_image_link_hidden" value="1"<?php if($img_link == 1): ?>checked="checked"<?php endif; ?>> <?php esc_attr_e('Hide image/video link on portfolio page', 'multipurpose'); ?></label></p>
	<?php
}

function multipurpose_save_project_layout_metabox($project_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if(!isset($_POST['project_layout_metabox_nonce']) || !wp_verify_nonce($_POST['project_layout_metabox_nonce'], 'multipurpose_project_layout_metabox_nonce' )) return; 
	if(!current_user_can('edit_post', $project_id)) return; 

	if(isset($_POST['project_url'])) {
		update_post_meta($project_id, 'project_meta_layout', strip_tags($_POST['project_layout']));
	}
	if(isset($_POST['project_image_link_hidden'])) $image_link = 1;
	else $image_link = 0;
	update_post_meta($project_id, 'project_image_link_hidden', $image_link);
}

// custom columns in admin project list

add_filter('manage_project_posts_columns', 'multipurpose_project_table_head');
function multipurpose_project_table_head( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'thumbnail' => 'Thumbnail',
		'title' => 'Project title',
		'category' => 'Project category',
		'date' => 'Date'
	);
    
    return $columns;
}

add_action( 'manage_project_posts_custom_column', 'multipurpose_project_table_content', 10, 2 );
function multipurpose_project_table_content( $column_name, $post_id ) {
    if ($column_name == 'category') {
    	$cats = array();
    	$categories = wp_get_post_terms($post_id, 'project-categories');
    	foreach ($categories as $c) {
    		$cats[] = $c->name;
    	}
    	echo implode(", ", $cats);
    }	
    if ($column_name == 'thumbnail') {
    	echo get_the_post_thumbnail( $post_id, 'admin-thumbnail');
    }
}