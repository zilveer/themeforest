<?php
class Theme_Post_Type_Portfolio {
	public $post_type = 'portfolio';
	public $post_type_taxonomy = 'portfolio_category';

	function __construct($post_type = 'portfolio', $post_type_taxonomy = 'portfolio_category') {
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
		// Rewriting Permalink Slug
		$permalink_slug = trim(wpml_t(THEME_NAME , 'Portfolio Permalink Slug', theme_get_option('portfolio','permalink_slug')));

		if ( empty($permalink_slug) ) {
			$permalink_slug = 'portfolio';
		}
		register_post_type($this->post_type, array(
			'labels' => array(
				'name' => _x('Portfolio items', 'post type general name', 'theme_admin' ),
				'singular_name' => _x('Portfolio Item', 'post type singular name', 'theme_admin' ),
				'add_new' => _x('Add New', 'portfolio', 'theme_admin' ),
				'add_new_item' => __('Add New Portfolio Item', 'theme_admin' ),
				'edit_item' => __('Edit Portfolio Item', 'theme_admin' ),
				'new_item' => __('New Portfolio Item', 'theme_admin' ),
				'view_item' => __('View Portfolio Item', 'theme_admin' ),
				'search_items' => __('Search Portfolio Items', 'theme_admin' ),
				'not_found' =>  __('No portfolio item found', 'theme_admin' ),
				'not_found_in_trash' => __('No portfolio items found in Trash', 'theme_admin' ), 
				'parent_item_colon' => '',
				'menu_name' => __('Portfolio items', 'theme_admin' ),
			),
			'singular_label' => __('portfolio', 'theme_admin' ),
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'show_in_menu' => true,
			//'menu_position' => 20,
			'capability_type' => 'portfolio',
			'capabilities' => array(
				'publish_posts' => 'theme_publish_portfolios',

				'edit_post' => 'theme_edit_portfolio',
				'edit_posts' => 'theme_edit_portfolios',
				'edit_private_posts' => 'theme_edit_private_portfolios',
				'edit_published_posts' => 'theme_edit_published_portfolios',
				'edit_others_posts' => 'theme_edit_others_portfolios',
				
				'delete_post' => 'theme_delete_portfolio',
				'delete_posts' => 'theme_delete_portfolios',
				'delete_private_posts' => 'theme_delete_private_portfolios',
				'delete_published_posts' => 'theme_delete_published_portfolios',
				'delete_others_posts' => 'theme_delete_others_portfolios',

				'read_post' => 'theme_read_portfolio',
				'read_private_posts' => 'theme_read_private_portfolios',
			),
			'hierarchical' => false,
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'page-attributes', 'revisions'),
			'has_archive' => true,
			'rewrite' => array( 'slug' => $permalink_slug, 'with_front' => true, 'pages' => true, 'feeds'=>true ),
			'query_var' => true,
			'can_export' => true,
			'show_in_nav_menus' => true,
		));
	}

	function register_taxonomy(){
		//register taxonomy for portfolio
		register_taxonomy($this->post_type_taxonomy,$this->post_type,array(
			'hierarchical' => true,
			'labels' => array(
				'name' => _x( 'Portfolio Categories', 'taxonomy general name', 'theme_admin' ),
				'singular_name' => _x( 'Portfolio Category', 'taxonomy singular name', 'theme_admin' ),
				'search_items' =>  __( 'Search Categories', 'theme_admin' ),
				'popular_items' => __( 'Popular Categories', 'theme_admin' ),
				'all_items' => __( 'All Categories', 'theme_admin' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit Portfolio Category', 'theme_admin' ), 
				'update_item' => __( 'Update Portfolio Category', 'theme_admin' ),
				'add_new_item' => __( 'Add New Portfolio Category', 'theme_admin' ),
				'new_item_name' => __( 'New Portfolio Category Name', 'theme_admin' ),
				'separate_items_with_commas' => __( 'Separate Portfolio category with commas', 'theme_admin' ),
				'add_or_remove_items' => __( 'Add or remove portfolio category', 'theme_admin' ),
				'choose_from_most_used' => __( 'Choose from the most used portfolio category', 'theme_admin' ),
				'menu_name' => __( 'Categories', 'theme_admin' ),
			),
			'capabilities' => array(
				'manage_terms' => 'theme_manage_portfolio_terms',
				'edit_terms'   => 'theme_edit_portfolio_terms',
				'delete_terms' => 'theme_delete_portfolio_terms',
				'assign_terms' => 'theme_assign_portfolio_terms',
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
		}
		if ( get_query_var( 'taxonomy' ) == $this->post_type_taxonomy ) {
			global $wp_query;
			$wp_query->is_404 = true;
			$wp_query->is_tax = false;
			$wp_query->is_archive = false;
		}
	}

	function admin_init(){
		add_filter('manage_edit-'.$this->post_type.'_columns', array(&$this, 'edit_columns'));
		add_action('manage_posts_custom_column',array(&$this, 'manager_custom_column'), 10, 2);
	}

	function edit_columns($columns){
		$columns['portfolio_categories'] = __('Categories', 'theme_admin' );
		$columns['description'] = __('Description', 'theme_admin' );
		$columns['thumbnail'] = __('Thumbnail', 'theme_admin' );
		
		return $columns;
	}

	function manager_custom_column($column){
		global $post;
	
		if ($post->post_type == $this->post_type) {
			switch($column){
				case "description":
					the_excerpt();
					break;
				case "portfolio_categories":
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
				case 'thumbnail':
					echo the_post_thumbnail('thumbnail');
					break;
			}
		}
	}
}
