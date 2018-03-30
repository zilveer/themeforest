<?php

/* ------------------------------------------------------------------------

	Class: R-CustomPost 
	Ver. 2.0.1
	Copyright: Rascals Themes
	Web: http://rascals.eu

 ------------------------------------------------------------------------ */

class R_Custom_Post {
	
	private $args;
	private $options;
	private $admin_path;
	private $admin_uri;
	private $textdomain;
	
	/* Contruct
	---------------------------------------------- */
	function __construct( $args, $options ) {

		/* Set options and page variables */
		$this->args = $args;
		$this->options = $options;

		/* Textdomain */
		$this->textdomain = 'custom_post_class';
		if ( isset( $args['textdomain'] ) )
			$this->textdomain = $args['textdomain'];
		
		/* Set paths */

		/* Set path */
		if ( $this->args['admin_path'] == '' ) {
			$_path = get_template_directory_uri();
		} else {
			$_path = '';
		}
		$this->admin_path = $_path . $this->args['admin_dir'];

		/* Set URI path */
		if ( $this->args['admin_uri'] == '' ) {
			$_path_uri = get_template_directory();
		} else {
			$_path_uri = '';
		}
		$this->admin_uri = $_path_uri . $this->args['admin_dir'];


		/* Register Post Type */
		register_post_type( $this->args['post_name'], $this->options );
		
		/* Add ajax sortable function */
		if ( $this->args['sortable'] ) {
			
			add_action( 'wp_ajax_' . $this->args['post_name'], array(&$this, 'save_order') );
			
			/* Call method to create the sidebar menu items */
			add_action( 'admin_menu', array(&$this, 'add_admin_menu') );
			
			/* Set admin order */
			add_filter( 'pre_get_posts', array(&$this, 'set_admin_order') );
			
		}

		/* --- Functions --- */
		/* Include function */
		if ( ! function_exists( 'mr_image_resize' ) )
			include_once( $this->admin_uri . '/functions/mr-image-resize.php' );

	}

	/* Create the sidebar menu */
	function add_admin_menu() {	
		$panel_sub_page = add_submenu_page( 'edit.php?post_type=' . $this->args['post_name'], $this->args['post_name'] . '_sort', _x( 'Sort Items', 'Custom Post Class', $this->textdomain ), 'moderate_comments', $this->args['post_name'], array(&$this, 'init'));

		// Load the JS conditionally
        add_action( 'load-' . $panel_sub_page, array( &$this, 'custom_post_scripts' )  );
	}
	
	/* Admin scripts */
	function custom_post_scripts() {

		/* Custom Post */
		wp_enqueue_style( 'sortable_custom_post_css', $this->admin_path . '/assets/css/custom_post.css', false, '2013-11-01', 'screen' );
		wp_enqueue_script( 'custom_post_js', $this->admin_path . '/assets/js/custom_post.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-sortable', 'jquery-ui-droppable', 'jquery-ui-draggable'), '2013-11-01', true );

		/* Touch punch */
		wp_enqueue_script( 'touch_punch', $this->admin_path . '/assets/js/jquery.ui.touch-punch.min.js', array( 'jquery' ), '2013-11-01', true );
	
	}
	
	/* Ajax function */
	function save_order() {
		global $wpdb;
	 
		$order = explode( ',', $_POST['order'] );
		$counter = 1;
	 
		foreach ( $order as $value ) {
			$wpdb->update( $wpdb->posts, array('menu_order' => $counter), array('ID' => $value) );
			$counter++;
		}
		die(1);
	}
	
	/* Set Admin Order */
	function set_admin_order( $wp_query ) {
	
		if ( isset( $wp_query->query['post_type'] ) ) {
			
			/* Get the post type from the query */
			$post_type = $wp_query->query['post_type'];
	
			if ( $post_type == $this->args['post_name'] ) {
	
				/* 'orderby' value can be any column name */
				$wp_query->set( 'orderby', 'menu_order' );

				/* 'order' value can be ASC or DESC */
				$wp_query->set( 'order', 'ASC' );
			  
			}
		}
	}

	/* Initialize */
	function init() {
		$this->display();
	}
	
	function display() {
		
		$sort_query = new WP_Query( 'post_type=' . $this->args['post_name'] . '&posts_per_page=-1&orderby=menu_order&order=ASC' );
		
		echo '<div class="wrap-sortable-post">';
		echo '<h3>' . _x( 'Sort Items', 'Custom Post Class', $this->textdomain ) . ' <img src="' . site_url() . '/wp-admin/images/loading.gif" id="loading-animation" alt="' . $this->args['post_name'] . '"/></h3>';

		echo '<ul id="sortable-posts">';
		while ( $sort_query->have_posts() ){ 

			$sort_query->the_post();
			echo '<li id="' . get_the_ID() . '">';
			echo '<span class="drag-item"></span>';
			echo '<a href="' . home_url() . '/wp-admin/post.php?action=edit&post=' . get_the_ID() . '" class="edit-item" title="' . _x( 'Edit This Post', 'Custom Post Class', $this->textdomain ) . '"></a>';
			echo '<div class="sortable-content">';
			echo '<h6>' . get_the_title() . ' <span>[id: ' . get_the_ID() . ']</span></h6>';
			echo '</div>';
			echo '</li>';

		}
		
		echo '</ul>';
		echo '</div>';
	}


	/* Public Functions */

	/* Taxonomy options
	---------------------------------------------- */
	public function generate_taxonomy_options( $tax_slug, $parent = '', $level = 0 ) {
	    $args = array( 'show_empty' => 1 );
	    if ( ! is_null( $parent ) ) {
	        $args = array( 'parent' => $parent );
	    } 
	    $terms = get_terms( $tax_slug, $args );
	    $tab = '';
	    for ( $i=0; $i<$level; $i++ ) {
	        $tab.='--';
	    }
	    foreach ( $terms as $term ) {
	        // output each select option line, check against the last $_GET to show the current option selected
	        echo '<option value='. $term->slug, isset($_GET[$tax_slug]) && $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' .$tab. $term->name .' (' . $term->count .')</option>';
	        $this->generate_taxonomy_options( $tax_slug, $term->term_id, $level+1 );
	    }
	}

	/* Image exist
	---------------------------------------------- */
	public function image_exists( $img ) {

		// Check image src or image ID
		if ( is_numeric( $img ) ) {
	    	$image_att = wp_get_attachment_image_src( $img, 'full' );
		   	if ( $image_att[0] )
		   		return $image_att[0];
		   	else 
		   		return false;
		}

		//define upload path & dir
	   	$upload_info = wp_upload_dir();
		$upload_dir = $upload_info['basedir'];
		$upload_url = $upload_info['baseurl'];

		// check if $img_url is local
		if( strpos( $img, $upload_url ) === false ) return false;

		//define path of image
		$rel_path = str_replace( $upload_url, '', $img);
		$img_path = $upload_dir . $rel_path;

		$image = @getimagesize( $img_path );
		if ( $image ) return $img;
		else return false;

	}


	/* Image resize
	---------------------------------------------- */
	public function image_resize( $width, $height, $src, $crop = 'c', $retina = false ) {

		$image = $this->image_exists( $src );

		// If icon
	   	if ( strpos( $src, ".ico" ) !== false )
	   		return $src;

	   	// If image src exists
		if ( $image ) {
			if ( function_exists( 'mr_image_resize' ) )
				return mr_image_resize( $image, $width, $height, true, $crop, $retina );
			else 
				return $id;
		}
		return false;
	}
	
}
?>