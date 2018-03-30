<?php
class Theme_Post_Type_Slideshow {
	public $post_type = 'slideshow';
	public $post_type_taxonomy = 'slideshow_category';

	function __construct($post_type = 'slideshow', $post_type_taxonomy = 'slideshow_category') {
		$this->post_type = $post_type;
		$this->post_type_taxonomy = $post_type_taxonomy;
	}

	function init(){
		$this->register();
		add_action( 'template_redirect', array(&$this, 'context_fixer') );
		add_action( "restrict_manage_posts", array( &$this, '_action_filters' ));
	}

	function register(){
		$this->register_post_type();
		$this->register_taxonomy();
	}

	function register_post_type() {
		register_post_type($this->post_type, array(
			'labels' => array(
				'name' => _x('Slider Items', 'post type general name', 'theme_admin'),
				'singular_name' => _x('Slider Item', 'post type singular name', 'theme_admin'),
				'add_new' => _x('Add New', 'slideshow', 'theme_admin'),
				'add_new_item' => __('Add New Slider Item', 'theme_admin'),
				'edit_item' => __('Edit Slider Item', 'theme_admin'),
				'new_item' => __('New Slider Item', 'theme_admin'),
				'view_item' => __('View Slider Item', 'theme_admin'),
				'search_items' => __('Search Slider Items', 'theme_admin'),
				'not_found' =>  __('No slider item found', 'theme_admin'),
				'not_found_in_trash' => __('No slider items found in Trash', 'theme_admin'), 
				'parent_item_colon' => '',
				'menu_name' => __('Slider Items', 'theme_admin' ),
			),
			'singular_label' => __('slideshow', 'theme_admin'),
			'public' => false,
			'publicly_queryable' => false,
			'exclude_from_search' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			//'menu_position' => 20,
			'capability_type' => 'slideshow',
			'capabilities' => array(
				'publish_posts' => 'theme_publish_slideshows',

				'edit_post' => 'theme_edit_slideshow',
				'edit_posts' => 'theme_edit_slideshows',
				'edit_private_posts' => 'theme_edit_private_slideshows',
				'edit_published_posts' => 'theme_edit_published_slideshows',
				'edit_others_posts' => 'theme_edit_others_slideshows',
				
				'delete_post' => 'theme_delete_slideshow',
				'delete_posts' => 'theme_delete_slideshows',
				'delete_private_posts' => 'theme_delete_private_slideshows',
				'delete_published_posts' => 'theme_delete_published_slideshows',
				'delete_others_posts' => 'theme_delete_others_slideshows',

				'read_post' => 'theme_read_slideshow',
				'read_private_posts' => 'theme_read_private_slideshows',
			),
			'hierarchical' => false,
			'supports' => array('title', 'editor', 'thumbnail' , 'page-attributes'),
			'has_archive' => false,
			'rewrite' => false,
			'query_var' => false,
			'can_export' => true,
			'show_in_nav_menus' => false,
		));
	}

	function register_taxonomy(){
		//register taxonomy for portfolio
		register_taxonomy($this->post_type_taxonomy,$this->post_type,array(
			'hierarchical' => true,
			'labels' => array(
				'name' => _x( 'Slider Categories', 'taxonomy general name', 'theme_admin' ),
				'singular_name' => _x( 'Slideshow Category', 'taxonomy singular name', 'theme_admin' ),
				'search_items' =>  __( 'Search Categories', 'theme_admin' ),
				'popular_items' => __( 'Popular Categories', 'theme_admin' ),
				'all_items' => __( 'All Categories', 'theme_admin' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Slideshow Category', 'theme_admin' ), 
				'update_item' => __( 'Update Slideshow Category', 'theme_admin' ),
				'add_new_item' => __( 'Add New Slideshow Category', 'theme_admin' ),
				'new_item_name' => __( 'New Slideshow Category Name', 'theme_admin' ),
				'separate_items_with_commas' => __( 'Separate Slideshow category with commas', 'theme_admin' ),
				'add_or_remove_items' => __( 'Add or remove slideshow category', 'theme_admin' ),
				'choose_from_most_used' => __( 'Choose from the most used slideshow category', 'theme_admin' ),
				'menu_name' => __( 'Categories', 'theme_admin' ),
			),
			'capabilities' => array(
				'manage_terms' => 'theme_manage_slideshow_terms',
				'edit_terms'   => 'theme_edit_slideshow_terms',
				'delete_terms' => 'theme_delete_slideshow_terms',
				'assign_terms' => 'theme_assign_slideshow_terms',
			),
			'public' => false,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_tagcloud' => false,
			'query_var' => true,
			'rewrite' => false,
		));
	}

	public function _action_filters(){
		$screen = get_current_screen();
		if($screen->post_type !== $this->post_type){
			return;
		}
		
		$taxonomy_slug = $this->post_type_taxonomy;
		$taxonomy = get_taxonomy($taxonomy_slug);
		if($taxonomy){
			$args = array(
				'orderby' => 'name',
				'hide_empty' => false
			);

			$terms = get_terms($taxonomy_slug, $args);

			if($terms) {
				printf(' &nbsp;<select name="%s" class="postform">', $taxonomy_slug);
				printf('<option value="0">%s</option>', _x('Show all ' . $taxonomy->label, 'taxonomy show all filter'));
				foreach ($terms as $term) {
					if(isset($_GET[$taxonomy_slug]) && $_GET[$taxonomy_slug] === $term->slug) {
						printf('<option value="%s" selected="selected">%s (%s)</option>', $term->slug, $term->name, $term->count);
					} else {
						printf('<option value="%s">%s (%s)</option>', $term->slug, $term->name, $term->count);
					}
				}
				print('</select>&nbsp;');
			}
		}
	}

	function context_fixer(){
		if ( get_query_var( 'post_type' ) == $this->post_type ) {
			global $wp_query;
			$wp_query->is_home = false;
			$wp_query->is_404 = true;
			$wp_query->is_single = false;
			$wp_query->is_singular = false;
		}
	}

	function admin_init(){
		add_filter('manage_edit-'.$this->post_type.'_columns', array(&$this, 'edit_columns'));
		add_action('manage_posts_custom_column',array(&$this, 'manager_custom_column'), 10, 2);

		add_action('wp_enqueue_script',array(&$this,'deregister_script'));
	}
	
	function deregister_script(){
		if(theme_is_post_type_edit($this->post_type) || theme_is_post_type_new($this->post_type)){
			wp_deregister_script('autosave');
		}
	}
	function edit_columns($columns){
		$columns['slideshow_category'] = __('Categories', 'theme_admin' );
		$columns['author'] = __('Author', 'theme_admin' );
		$columns['thumbnail'] = __('Thumbnail', 'theme_admin' );
		
		return $columns;
	}

	function manager_custom_column($column){
		global $post;
	
		if ($post->post_type == $this->post_type) {
			switch($column){
				case 'thumbnail':
					echo the_post_thumbnail('thumbnail');
					break;
				case "slideshow_category":
					$terms = get_the_terms($post->ID, $this->post_type_taxonomy);
					
					if (! empty($terms)) {
						foreach($terms as $t)
							$output[] = "<a href='edit.php?post_type=".$this->post_type."&".$this->post_type_taxonomy."=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, $this->post_type_taxonomy, 'display')) . "</a>";
						$output = implode(', ', $output);
					} else {
						$t = get_taxonomy($this->post_type_taxonomy);
						$output = "No $t->label";
					}
					
					echo $output;
					break;
			}
		}
	}
}
