<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Projects Post Type
 * Created by CMSMasters
 * 
 */


class Projects {
	function Projects() { 
		$project_labels = array( 
			'name' => __('Projects', 'cmsmasters'), 
			'singular_name' => __('Project', 'cmsmasters'), 
			'add_new' => __('Add New', 'cmsmasters'), 
			'all_items' => __('All Projects', 'cmsmasters'), 
			'add_new_item' => __('Add New Project', 'cmsmasters'), 
			'edit_item' => __('Edit Project', 'cmsmasters'), 
			'new_item' => __('New Project', 'cmsmasters'), 
			'view_item' => __('View Project', 'cmsmasters'), 
			'search_items' => __('Search Projects', 'cmsmasters'), 
			'not_found' => __('No Projects found', 'cmsmasters'), 
			'not_found_in_trash' => __('No Projects found in Trash', 'cmsmasters'), 
			'menu_name' => __('Projects', 'cmsmasters') 
		);
		
		$project_args = array( 
			'labels' => $project_labels, 
			'public' => true, 
			'menu_position' => 51, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'supports' => array( 
				'title', 
				'editor', 
				'author', 
				'thumbnail', 
				'excerpt', 
				'trackbacks', 
				'custom-fields', 
				'comments', 
				'revisions', 
				'page-attributes' 
			), 
			'query_var' => 'project', 
			'has_archive' => true, 
			'show_ui' => true, 
			'_builtin' => false, 
			'_edit_link' => 'post.php?post=%d', 
			'rewrite' => array( 
				'slug' => 'project', 
				'with_front' => true 
			) 
		);
		
		register_post_type('project', $project_args);
		
		add_filter('manage_edit-project_columns', array(&$this, 'edit_columns'));
		add_filter('manage_edit-project_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		register_taxonomy('pj-sort-categs', array('project'), array(
			'hierarchical' => true, 
			'label' => __('Categories', 'cmsmasters'), 
			'singular_label' => __('Category', 'cmsmasters'), 
			'rewrite' => array( 
				'slug' => 'pj-sort-categs', 
				'with_front' => true 
			) 
		));
		
		register_taxonomy('pj-tags', array('project'), array(
			'hierarchical' => false, 
			'label' => __('Tags', 'cmsmasters'), 
			'singular_label' => __('Tag', 'cmsmasters'), 
			'rewrite' => array( 
				'slug' => 'pj-tags', 
				'with_front' => true 
			) 
		));
		
		register_taxonomy('pj-categs', array('project'), array(
			'hierarchical' => true, 
			'label' => __('Types', 'cmsmasters'), 
			'singular_label' => __('Type', 'cmsmasters'), 
			'rewrite' => array( 
				'slug' => 'pj-categs', 
				'with_front' => true 
			) 
		));
		
		flush_rewrite_rules(false);
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
		add_action('request', array(&$this, 'orderby_sortable_columns'));
	}
	
	function edit_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __('Title', 'cmsmasters'),
			'pj_thumb' => __('Thumbnail', 'cmsmasters'),
			'pj_format' => __('Format', 'cmsmasters'),
			'pj_description' => __('Description', 'cmsmasters'),
			'pj_sort_categ' => __('Categories', 'cmsmasters'),
			'pj_tags' => __('Tags', 'cmsmasters'),
			'menu_order' => __('Order', 'cmsmasters')
		);
		
		return $columns;
	}
	
	function custom_columns($column) {
		switch ($column) {
			case 'pj_thumb':
				if (has_post_thumbnail() != '') {
					echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => cmsms_title(get_the_ID(), false), 
						'title' => cmsms_title(get_the_ID(), false), 
						'style' => 'width:75px; height:75px;' 
					));
				} else {
					echo '<em>' . __('No Thumbnail', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'pj_format':
				if (get_post_meta(get_the_ID(), 'cmsms_project_format', true) != '') {
					echo '<p>' . __(ucfirst(get_post_meta(get_the_ID(), 'cmsms_project_format', true)), 'cmsmasters') . '</p>';
				} else {
					echo '<em>' . __('Album', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'pj_description':
				if (has_excerpt() || get_the_content() != '') {
					theme_excerpt(20);
				} else {
					echo '<em>' . __('No Description', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'pj_sort_categ':
				if (get_the_terms(0, 'pj-sort-categs') != '') {
					$pj_sort_categs = get_the_terms(0, 'pj-sort-categs');
					$pj_sort_categs_html = array();
					
					foreach ($pj_sort_categs as $pj_sort_categ) {
						array_push($pj_sort_categs_html, '<a href="' . get_term_link($pj_sort_categ->slug, 'pj-sort-categs') . '">' . $pj_sort_categ->name . '</a>');
					}
					
					echo implode($pj_sort_categs_html, ', ');
				} else {
					echo '<em>' . __('Uncategorized', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'pj_tags':
				if (get_the_terms(0, 'pj-tags') != '') {
					$pj_tags = get_the_terms(0, 'pj-tags');
					$pj_tag_html = array();
					
					foreach ($pj_tags as $pj_tag) {
						array_push($pj_tag_html, '<a href="' . get_term_link($pj_tag->slug, 'pj-tags') . '">' . $pj_tag->name . '</a>');
					}
					
					echo implode($pj_tag_html, ', ');
				} else {
					echo '<em>' . __('No Tags', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'menu_order':
				$custom_post = get_post(get_the_ID());
				$custom = $custom_post->menu_order;
				
				echo $custom;
				
				break;
		}
	}
	
	function edit_sortable_columns($columns) {
		$columns['menu_order'] = 'menu_order';
		$columns['pj_format'] = 'pj_format';
		
		return $columns;
	}
	
	function orderby_sortable_columns($vars) { 
		if (isset($vars['orderby']) && $vars['orderby'] == 'pj_format') {
			$vars = array_merge($vars, array( 
				'meta_key' => 'cmsms_project_format', 
				'orderby' => 'meta_value' 
			));
		}
		
		return $vars;
	}
}


function ProjectsInit() {
	global $pj;
	
	
	$pj = new Projects();
}


add_action('init', 'ProjectsInit');

