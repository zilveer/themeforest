<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

class FW_Extension_Woffice_Wiki extends FW_Extension {
	/**
	 * @internal
	 */
	public function _init() {
	
		add_action( 'init', array( $this, '_action_register_post_type' ) );
		add_action( 'init', array( $this, '_action_register_taxonomy' ) );
		add_action('fw_extensions_after_activation', array($this, 'woffice_wiki_flush'));
        add_action('fw_extensions_after_activation', array($this, '_woffice_assign_wiki_caps') ,999);

	}
	
	/**
	 * @internal
	 */
	public function _action_register_post_type() {

		$labels = array(
			'name'               => __( 'Wiki', 'woffice' ),
			'singular_name'      => __( 'Article', 'woffice' ),
			'menu_name'          => __( 'Wiki', 'woffice' ),
			'name_admin_bar'     => __( 'Article', 'woffice' ),
			'add_new'            => __( 'Add New', 'woffice' ),
			'new_item'           => __( 'Article', 'woffice' ),
			'edit_item'          => __( 'Edit Article', 'woffice' ),
			'view_item'          => __( 'View Article', 'woffice' ),
			'all_items'          => __( 'All Articles', 'woffice' ),
			'search_items'       => __( 'Search Article', 'woffice' ),
			'not_found'          => __( 'No Article found.', 'woffice' ),
			'not_found_in_trash' => __( 'No Article found in Trash.', 'woffice' )
		);

		$labels = apply_filters('woffice_post_type_wiki_labels', $labels);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'menu_icon' => 'dashicons-archive',
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'wiki' ),
			'capability_type'    => 'post',
            'capabilities' => array(
				'edit_posts' => 'woffice_edit_wikies',
				'edit_others_posts' => 'woffice_edit_others_wikies',
				'edit_private_posts' => 'woffice_edit_private_wikies',
				'edit_published_posts' => 'woffice_edit_published_wikies',
				'delete_posts' => 'woffice_delete_wikies',
				'delete_others_posts' => 'woffice_delete_others_wikies',
				'delete_private_posts' => 'woffice_delete_private_wikies',
				'delete_published_posts' => 'woffice_delete_published_wikies',
                'publish_posts' => 'woffice_publish_wikies',
				'read_private_posts' => 'woffice_read_private_wikies',
				'edit_post' => 'woffice_edit_wiki',
				'delete_post' => 'woffice_delete_wiki',
				'read_post' => 'woffice_read_wiki',
            ),
            //'map_meta_cap' => true,
            //'map_meta_cap' => true,
			'has_archive'        => true,
			'hierarchical'       => true,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor','thumbnail', 'revisions', 'author', 'comments' )
		);

		$args = apply_filters('woffice_post_type_wiki_args', $args, $labels);

		register_post_type( 'wiki', $args );
        add_filter( 'map_meta_cap', array($this, '_woffice_map_meta_cap'), 10, 4 );
	}

    /**
     * Assign the caps for wiki posts to the wordpress roles, following the standard of blog post caps
     */
    public function _woffice_assign_wiki_caps() {

        //Check if the caps are assigned already one time, in order to avoid to override the changes of the user
        $wiki_caps_flag = get_option('woffice_wiki_caps_flag');

        if($wiki_caps_flag == 1)
            return;

		//Assign caps to Administrator
		$role = get_role('administrator');

		$role->add_cap('woffice_read_wikies');
		$role->add_cap('woffice_edit_wikies');
		$role->add_cap('woffice_edit_others_wikies');
		$role->add_cap('woffice_edit_private_wikies');
		$role->add_cap('woffice_edit_published_wikies');
		$role->add_cap('woffice_delete_wikies');
		$role->add_cap('woffice_delete_others_wikies');
		$role->add_cap('woffice_delete_private_wikies');
		$role->add_cap('woffice_delete_published_wikies');
		$role->add_cap('woffice_publish_wikies');
		$role->add_cap('woffice_read_private_wikies');

        //Assign caps to Editor
        $role = get_role('editor');

        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_edit_others_wikies');
        $role->add_cap('woffice_edit_private_wikies');
        $role->add_cap('woffice_edit_published_wikies');
        $role->add_cap('woffice_delete_wikies');
        $role->add_cap('woffice_delete_others_wikies');
        $role->add_cap('woffice_delete_private_wikies');
        $role->add_cap('woffice_delete_published_wikies');
        $role->add_cap('woffice_publish_wikies');
        $role->add_cap('woffice_read_private_wikies');

        //Assign caps to Author
        $role = get_role('author');

        $role->add_cap('woffice_delete_wikies');
        $role->add_cap('woffice_delete_published_wikies');
        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_edit_published_wikies');
        $role->add_cap('woffice_publish_wikies');

        //Assign caps to Contributor
        $role = get_role('contributor');

        $role->add_cap('woffice_edit_wikies');
        $role->add_cap('woffice_delete_wikies');

        //Add/Update the flag
        update_option('woffice_wiki_caps_flag', 1);
    }

	/**
	 * @internal
	 */
	public function woffice_wiki_flush($extensions) {
	
		if (!isset($extensions['woffice-wiki'])) {
	        return;
	    }
	    
	    flush_rewrite_rules();
		
	}

	/**
	 * @internal
	 */
	public function _action_register_taxonomy() {

		$labels = array(
			'name'              => __( 'Wiki Categories', 'woffice' ),
			'singular_name'     => __( 'Article Category', 'woffice' ),
			'search_items'      => __( 'Search Wiki Categories', 'woffice' ),
			'all_items'         => __( 'All Wiki Categories', 'woffice' ),
			'edit_item'         => __( 'Edit Category', 'woffice' ),
			'update_item'       => __( 'Update Wiki Category', 'woffice' ),
			'add_new_item'      => __( 'Add New Wiki Category', 'woffice' ),
			'new_item_name'     => __( 'New Wiki Category', 'woffice' ),
			'menu_name'         => __( 'Categories', 'woffice' ),
		);
	
		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'wiki-category' ),
		);
	
		register_taxonomy( 'wiki-category', array( 'wiki' ), $args );
		
	}
	
	/**
	 * Function to return if the user has already voted
	 */
	public function woffice_user_has_already_voted($post_ID) {

	    // We get the Wiki Likes "Engine" :
        $wiki_like_engine = ( function_exists( 'fw_get_db_settings_option' ) ) ? fw_get_db_settings_option('wiki_like_engine') : '';
        if($wiki_like_engine == 'members') {

            $voted_IDs = get_post_meta($post_ID, "voted_IDs", true);
	        $voted_IDs = is_array($voted_IDs) ? $voted_IDs : array($voted_IDs);
            if (empty($voted_IDs) && !is_array($voted_IDs) && !is_user_logged_in()) {
                return false;
            }
            $user_id = get_current_user_id();
            if(in_array($user_id, $voted_IDs)) {
                return true;
            } else {
                return false;
            }

        } else {

            $timebeforerevote = 240; // = 4 hours
            // Retrieve post votes IPs
            $meta_IP = get_post_meta($post_ID, "voted_IP");
            if (empty($meta_IP)) {
                return false;
            }
            $voted_IP = $meta_IP[0];
            if(!is_array($voted_IP))
                $voted_IP = array();
            // Retrieve current user IP
            $ip = $_SERVER['REMOTE_ADDR'];
            // If user has already voted
            if(in_array($ip, array_keys($voted_IP)))
            {
                $time = $voted_IP[$ip];
                $now = time();
                // Compare between current time and vote time
                if(round(($now - $time) / 60) > $timebeforerevote)
                    return false;
                return true;
            }
            return false;

        }
		
	}

    public function _woffice_map_meta_cap( $caps, $cap, $user_id, $args ) {

        /* If editing, deleting, or reading a movie, get the post and post type object. */
        if ( 'woffice_edit_wiki' == $cap || 'woffice_delete_wiki' == $cap || 'woffice_read_wiki' == $cap ) {
            $post = get_post( $args[0] );
            $post_type = get_post_type_object( $post->post_type );

            /* Set an empty array for the caps. */
            $caps = array();
        }

        /* If editing a movie, assign the required capability. */
        if ( 'woffice_edit_wiki' == $cap ) {
            if ( $user_id == $post->post_author )
                $caps[] = $post_type->cap->edit_posts;
            else
                $caps[] = $post_type->cap->edit_others_posts;
        }

        /* If deleting a movie, assign the required capability. */
        elseif ( 'woffice_delete_wiki' == $cap ) {
            if ( $user_id == $post->post_author )
                $caps[] = $post_type->cap->delete_posts;
            else
                $caps[] = $post_type->cap->delete_others_posts;
        }

        /* If reading a private movie, assign the required capability. */
        elseif ( 'woffice_read_wiki' == $cap ) {

            if ( 'private' != $post->post_status )
                $caps[] = 'read';
            elseif ( $user_id == $post->post_author )
                $caps[] = 'read';
            else
                $caps[] = $post_type->cap->read_private_posts;
        }

        /* Return the capabilities required by the user. */
        return $caps;
    }
}
