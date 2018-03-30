<?php 
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.0
 * 
 * Testimonials Post Type
 * Created by CMSMasters
 * 
 */


class Testimonials {
	function Testimonials() { 
		$testimonial_labels = array( 
			'name' => __('Testimonials', 'cmsmasters'), 
			'singular_name' => __('Testimonials', 'cmsmasters'), 
			'add_new' => __('Add New', 'cmsmasters'), 
			'all_items' => __('All Testimonials', 'cmsmasters'), 
			'add_new_item' => __('Add New Testimonial', 'cmsmasters'), 
			'edit_item' => __('Edit Testimonial', 'cmsmasters'), 
			'new_item' => __('New Testimonial', 'cmsmasters'), 
			'view_item' => __('View Testimonial', 'cmsmasters'), 
			'search_items' => __('Search Testimonials', 'cmsmasters'), 
			'not_found' => __('No Testimonials found', 'cmsmasters'), 
			'not_found_in_trash' => __('No Testimonials found in Trash', 'cmsmasters'), 
			'menu_name' => __('Testimonials', 'cmsmasters') 
		);
		
		$testimonial_args = array( 
			'labels' => $testimonial_labels, 
			'public' => true, 
			'menu_position' => 52, 
			'capability_type' => 'post', 
			'hierarchical' => false, 
			'supports' => array( 
				'title', 
				'editor', 
				'thumbnail', 
				'excerpt', 
				'trackbacks', 
				'custom-fields', 
				'comments', 
				'revisions', 
				'page-attributes' 
			), 
			'query_var' => 'testimonial', 
			'has_archive' => true, 
			'show_ui' => true, 
			'_builtin' => false, 
			'_edit_link' => 'post.php?post=%d', 
			'rewrite' => array( 
				'slug' => 'testimonial', 
				'with_front' => true 
			) 
		);
		
		register_post_type('testimonial', $testimonial_args);
		
		add_filter('manage_edit-testimonial_columns', array(&$this, 'edit_columns'));
		add_filter('manage_edit-testimonial_sortable_columns', array(&$this, 'edit_sortable_columns'));
		
		register_taxonomy('tl-categs', array('testimonial'), array(
			'hierarchical' => true, 
			'label' => __('Categories', 'cmsmasters'), 
			'singular_label' => __('Category', 'cmsmasters'), 
			'rewrite' => array( 
				'slug' => 'tl-categs', 
				'with_front' => true 
			) 
		));
		
		flush_rewrite_rules(false);
		
		add_action('manage_posts_custom_column', array(&$this, 'custom_columns'));
	}
	
	function edit_columns($columns) {
		$columns = array(
			'cb' => '<input type="checkbox" />',
			'title' => __('Title', 'cmsmasters'),
			'tl_avatar' => __('Avatar', 'cmsmasters'),
			'tl_description' => __('Description', 'cmsmasters'),
			'tl_categs' => __('Categories', 'cmsmasters'),
			'menu_order' => __('Order', 'cmsmasters')
		);
		
		return $columns;
	}
	
	function custom_columns($column) {
		switch ($column) {
			case 'tl_avatar':
				if (has_post_thumbnail() != '') {
					echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array( 
						'alt' => cmsms_title(get_the_ID(), false), 
						'title' => cmsms_title(get_the_ID(), false), 
						'style' => 'width:75px; height:75px;' 
					));
				} else {
					echo '<em>' . __('No Avatar', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'tl_description':
				if (has_excerpt() || get_the_content() != '') {
					theme_excerpt(20);
				} else {
					echo '<em>' . __('No Description', 'cmsmasters') . '</em>';
				}
				
				break;
			case 'tl_categs':
				if (get_the_terms(0, 'tl-categs') != '') {
					$tl_categs = get_the_terms(0, 'tl-categs');
					$tl_categs_html = array();
					
					foreach ($tl_categs as $tl_categ) {
						array_push($tl_categs_html, '<a href="' . get_term_link($tl_categ->slug, 'tl-categs') . '">' . $tl_categ->name . '</a>');
					}
					
					echo implode($tl_categs_html, ', ');
				} else {
					echo '<em>' . __('Uncategorized', 'cmsmasters') . '</em>';
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
		
		return $columns;
	}
}


function TestimonialsInit() {
	global $tl;
	
	
	$tl = new Testimonials();
}


add_action('init', 'TestimonialsInit');

