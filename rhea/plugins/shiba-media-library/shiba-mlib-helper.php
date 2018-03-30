<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (!class_exists("Shiba_Media_Library_Helper")) :

class Shiba_Media_Library_Helper {
	
	function __construct() {
		add_action('admin_init', array($this, 'admin_init'), 20);
	}
	
	function admin_init() {
		global $shiba_mlib;

		add_action('admin_head', array($this,'mlib_header'));
		add_filter('wp_redirect', array($this,'gallery_redirect'), 10, 2);

		if (defined('DOING_AJAX')) {
//			trigger_error('doing ajax' . print_r($_REQUEST, TRUE));
			if (isset($_REQUEST['action'])) { 
				switch ($_REQUEST['action']) {
				case 'inline-save':	
					if (isset($_REQUEST['screen']) && ($_REQUEST['screen'] == 'edit-gallery') ) {
						if (!class_exists("Shiba_Media_Library_Manage")) 
							require(SHIBA_MLIB_DIR . 'shiba-mlib-manage.php');
						$shiba_mlib->manage = new Shiba_Media_Library_Manage();	
					}
					break;
				case 'shiba_media_quick_edit':
					// Add Quick Edit functionality
					if (!class_exists("Shiba_Media_Library_QEdit"))
						require(SHIBA_MLIB_DIR.'shiba-mlib-qedit.php');
					$shiba_mlib->qedit = new Shiba_Media_Library_QEdit();
					add_filter('manage_media_columns', array($this,'add_admin_columns'), 5 );
					add_action('manage_media_custom_column', array($this,'manage_admin_columns'), 10, 2);
					break;
				}
			} // end isset $_REQUEST['action']
		} else
			add_filter('current_screen', array($this, 'current_screen') );

	}

	function current_screen($screen) {
		global $shiba_mlib;

		switch ($screen->id) {
		case 'upload':
			require_once(SHIBA_MLIB_DIR.'shiba-media-table.php');
			if (class_exists("Shiba_Media_List_Table"))
				$shiba_mlib->media_table = new Shiba_Media_List_Table();	
			require_once(SHIBA_MLIB_DIR.'shiba-mlib-upload.php');
			if (class_exists("Shiba_Media_Library_Upload"))
				$shiba_mlib->upload = new Shiba_Media_Library_Upload();	

			add_action('admin_head', array($this,'upload_header'), 51);
			// Adds tag column to the media library page
			// Give it a higher priority so that it runs first before other plugins 
			// that may add new columns	
			add_filter('manage_media_columns', array($this,'add_admin_columns'), 5 ); 
			add_action('manage_media_custom_column', array($this,'manage_admin_columns'), 10, 2);
//			add_filter('post_updated_messages', array($this,'gallery_updated_messages'));
			break;
		case 'edit-gallery':
			if (!class_exists("Shiba_Media_Library_Manage")) 
				require(SHIBA_MLIB_DIR . 'shiba-mlib-manage.php');
			$shiba_mlib->manage = new Shiba_Media_Library_Manage();	
			add_action('admin_head', array($this,'upload_header'), 51);
			add_action('admin_head', array($this,'gallery_header'), 51);

			break;
		case 'post':
			if (isset($_GET['post'])) {
				$post_id = abs($_GET['post']);
				$post_type = get_post_type($post_id);
				if ($post_type != 'gallery') break;
			} else break;
		case 'gallery':
			require_once(SHIBA_MLIB_DIR.'shiba-media-table.php');
			if (class_exists("Shiba_Media_List_Table"))
				$shiba_mlib->media_table = new Shiba_Media_List_Table();	
			require_once(SHIBA_MLIB_DIR . 'shiba-mlib-add.php');
			if (class_exists("Shiba_Media_Library_Add")) 
				$shiba_mlib->add = new Shiba_Media_Library_Add();	

			add_action('admin_head', array($this,'upload_header'), 51);
			add_filter('manage_media_columns', array($this,'add_admin_columns'), 5 ); 
			add_action('manage_media_custom_column', array($this,'manage_admin_columns'), 10, 2);
			break;
		}				
		return $screen;
	}

	function get_custom_types() {		
		// Update custom post types
		$custom = array();
		$post_types = get_post_types(array('public'   => true, '_builtin' => false));
		if(is_array($post_types)) {
			global $wp_post_types;
			foreach($post_types as $custom_type) {
				if( post_type_supports( $custom_type, 'shiba-mlib' )) {
					$custom[$custom_type] = $wp_post_types[$custom_type]->labels->name;
				}
			}
		}
		update_option(SHIBA_MLIB_CUSTOM_TYPES, $custom);		
		return $custom;		
	}


	function get_linked_posts($post) {
		// Get all posts or pages that contain the input post url
		global $wpdb;
		
		$post = get_post($post);
		switch ($post->post_type) {
		case 'attachment':
			$link = wp_get_attachment_url($post->ID);
			// remove file extension
			$link = substr($link, 0, strrpos($link, '.'));
			break;
		default:
			$link = get_permalink($post->ID);
			break;
		}
		
		$query = $wpdb->prepare("SELECT id FROM {$wpdb->posts} WHERE ($wpdb->posts.post_type != 'revision') AND ($wpdb->posts.post_content LIKE '%%%s%%')", $link);
		return $wpdb->get_col($query);
	}
	
	// Captures delete permanently link from new gallery screen
	function gallery_redirect($location, $status) {
		global $shiba_mlib;
//		trigger_error("$location || {$_SERVER['REQUEST_URI']}");
			
		$referer = wp_get_referer();
		$id = absint($shiba_mlib->substring($referer, 'wp-admin/post.php?post=', '&action=edit'));
//		trigger_error("REFERER $referer ID $id");
		if (!$id) return $location;
		
		if (get_post_type($id) == 'gallery') {
			$referer = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids', 'posted'), $referer );
			// redirect to http referer		
			if (strpos($location, 'upload.php?trashed') !== FALSE) {
				$location = str_replace('upload.php?', $referer . '&', $location);
				$location = add_query_arg('message', 13, $location);
			} elseif (strpos($location, 'upload.php?deleted=1') !== FALSE) {
				$location = add_query_arg('message', 12, $referer);
			} elseif (strpos($location, 'upload.php?untrashed') !== FALSE) {
				$location = add_query_arg('message', 14, $referer);		
			}
		}
//		trigger_error("new location $location");
		return $location;
	}			

	function mlib_header() {
		global $post_type;
		// icons are 16x16
		?>
		<style>		
		#adminmenu #menu-posts-gallery div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -121px -33px;}
		#adminmenu #menu-posts-gallery:hover div.wp-menu-image,#adminmenu #menu-posts-gallery.wp-has-current-submenu div.wp-menu-image{background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/menu.png') no-repeat scroll -121px -1px;}		
        </style>
        <?php
	}
	
	function gallery_header() {
		?>
		<style>
		#icon-edit { background:transparent url('<?php echo get_bloginfo('url');?>/wp-admin/images/icons32.png') no-repeat -251px -5px; }
		.fixed .column-id { width: 50px; }
		.fixed .column-images { width: 70px; text-align: center; }
		.fixed .column-gallery_categories, .fixed .column-gallery_tags { width: 15%; }
		</style>
    	<?php
	}
	
	function upload_header() {
		?>
		<style>
		.fixed .column-new_icon, .fixed .column-icon { width: 70px; text-align: center; }
		.fixed .column-title, .fixed .column-new_title { width: 25%; }
		.fixed .column-date { width: 96px; }
		.fixed .column-parent { width: 20%; }
		.fixed .column-att_tag { width: 15%; }
		.fixed .column-image_posts { width: 50px; text-align: center; }
		</style>
		<?php
	}



	// Add tag column to the attachment Media Library page
	function add_admin_columns($posts_columns) {
		global $shiba_mlib, $current_screen;		
		$new_columns['cb'] = '<input type="checkbox" />'; 
		
		if (isset($current_screen) && isset($current_screen->id) && ($current_screen->id == 'upload')) {
			$new_columns['icon'] = '';
			if (isset($posts_columns['media'])) // For WP 3.0
				$new_columns['media'] = _x( 'File', 'column name' );
			else $new_columns['title'] = _x( 'File', 'column name' );
		} else {
			$new_columns['new_icon'] = '';
			$new_columns['new_title'] = _x( 'File', 'column name' );
		}
		
		$new_columns['author'] = __( 'Author' );
		$new_columns['parent'] = _x( 'Attached to', 'column name' );
//			$new_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		$new_columns['date'] = _x( 'Date', 'column name' );
		$new_columns['att_tag'] = _x( 'Tags', 'column name' );
		
		if ($shiba_mlib->is_option('image_posts'))
			$new_columns['image_posts'] = _x( '#Posts', 'column name' );

		return $new_columns;
	}
	
	function manage_admin_columns($column_name, $id) {
		global $post, $shiba_mlib;
		
		switch($column_name) {
		case 'att_tag':
			$tagparent = "upload.php?";
			$tags = get_the_tags();
			if ( !empty( $tags ) ) {
				$out = array();
				foreach ( $tags as $c )
					$out[] = "<a href='".$tagparent."tag=$c->slug'> " . esc_html(sanitize_term_field('name', $c->name, $c->term_id, 'post_tag', 'display')) . "</a>";
				echo join( ', ', $out );
			} else {
				_e('No Tags');
			}
			break;
			
		case 'new_icon':
		
			$attachment_id = 0;
			if ($post->post_type == 'attachment')
				$attachment_id = $post->ID;
			 else if (function_exists('get_post_thumbnail_id')) 
				$attachment_id = get_post_thumbnail_id($post->ID);
			
			// wp_mime_type_icon throws a notice error in 3.1 RC2 when 
			// wp_get_attchment_image is called
			if (!$attachment_id) {
				echo '<img width="46" height="60" src="'.includes_url('images/media/default.png').'" class="attachment-80x60" />';

				break;
			}		
			if ( $thumb = wp_get_attachment_image( $attachment_id, array(80, 60), true ) ) {
				if ( $post->post_status == 'trash' ) echo $thumb;
				else {
				$attachment = get_post($attachment_id);	
				echo '	
				<a href="media.php?action=edit&amp;attachment_id='.$attachment_id.'" title="'.esc_attr(sprintf(__('Edit &#8220;%s&#8221;'), $attachment->post_title)).'">';
				echo $thumb;
				echo "</a>\n";
				}
			}
			
			break;		

		case 'new_title':
			$att_title = _draft_or_post_title();
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->ID, true ); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $att_title ) ); ?>"><?php echo $att_title; ?></a></strong>
				<p> <?php
				if ($post->post_type == 'attachment') {
					if ( preg_match( '/^.*?\.(\w+)$/', get_attached_file( $post->ID ), $matches ) )
						echo esc_html( strtoupper( $matches[1] ) );
					else 
						echo strtoupper( str_replace( 'image/', '', get_post_mime_type() ) ); 
				} else {
					echo strtoupper($post->post_type);
				}
				?>
				</p>
			<?php 
			
			if (class_exists('Shiba_Media_List_Table') && isset($shiba_mlib->media_table)) {
				echo $shiba_mlib->media_table->display_row_actions( $post, $att_title ); 
			}
			
			break;
	
		case 'image_posts':
			$post_ids = $this->get_linked_posts($post);
			$num_posts = count($post_ids);
			$post_id_str = implode(',', $post_ids);
			if ($num_posts <= 0)
				echo $num_posts;
			else	
				echo "<a href=\"edit.php?posts=$post_id_str&amp;post_type=post\">$num_posts</a>";
			break;
		default:
			break;
		} // end switch
	}
} // end Shiba_Media_Library_Helper class
endif;


?>