<?php
// don't load directly
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/*
 * Media Plus menu for the Media >> Library menu.
 *
 * Extends the WordPress media library to enable bulk detachments, attachments, and tagging.
 *
 */

if (!class_exists("Shiba_Media_Library_Upload")) :
	 
class Shiba_Media_Library_Upload {


	function Shiba_Media_Library_Upload() {
		global $shiba_mlib;

		wp_register_script('mediaPlusScript', SHIBA_MLIB_URL . '/shiba-mlib.dev.js');
		wp_enqueue_script('mediaPlusScript');
		wp_enqueue_script('wp-ajax-response');
		wp_enqueue_script('post');

		add_action('admin_head', array(&$shiba_mlib->helper,'upload_header'), 51);
//		add_action('restrict_manage_posts', array(&$this,'upload_expanded_menu') );	
		add_action('admin_notices', array(&$this,'upload_expanded_menu') );	
		add_filter('wp_redirect', array(&$this,'upload_redirect'), 10, 2);

		// Adds tag column to the media library page
		// Give it a higher priority so that it runs first before other plugins that may add new columns	
		add_filter('manage_media_columns', array(&$this,'add_admin_columns'), 5 ); 
		add_action('manage_media_custom_column', array(&$this,'manage_admin_columns'), 10, 2);

		add_filter('request', array(&$this,'expanded_media_search'));  // parse_request function
		add_filter( 'get_search_query', array(&$this, 'get_search_query') );
	}
	


	// Add tag column to the attachment Media Library page
	function add_admin_columns($posts_columns) {
		global $current_screen;		
		$new_columns['cb'] = '<input type="checkbox" />';
		if (isset($current_screen) && isset($current_screen->id) && ($current_screen->id == 'upload')) {
			$new_columns['icon'] = '';
			if (isset($posts_columns['media'])) // For WP 3.0
				$new_columns['media'] = _x( 'File', 'column name', THEMEDOMAIN );
			else $new_columns['title'] = _x( 'File', 'column name', THEMEDOMAIN );
		} else {
			$new_columns['new_icon'] = '';
			$new_columns['new_title'] = _x( 'File', 'column name', THEMEDOMAIN );
		}		
		$new_columns['author'] = __( 'Author', THEMEDOMAIN );
		/* translators: column name */
		$new_columns['parent'] = _x( 'Attached to', 'column name', THEMEDOMAIN );
//			$new_columns['comments'] = '<div class="vers"><img alt="Comments" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';
		/* translators: column name */
		$new_columns['date'] = _x( 'Date', 'column name', THEMEDOMAIN );
		$new_columns['att_tag'] = _x( 'Tags', 'column name', THEMEDOMAIN );

		return $new_columns;
	}
	
	function manage_admin_columns($column_name, $id) {
		global $post;
		
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
				_e('No Tags', THEMEDOMAIN);
			}
			break;
			
		case 'new_icon':
			$attachment_id = 0;
			if ($post->post_type == 'attachment')
				$attachment_id = $post->ID;
			 else if (function_exists('get_post_thumbnail_id')) 
				$attachment_id = get_post_thumbnail_id($post->ID);
			
			// wp_mime_type_icon throws a notice error in 3.1 RC2 when wp_get_attchment_image is called
			if (!$attachment_id) break;		
			if ( $thumb = wp_get_attachment_image( $attachment_id, array(80, 60), true ) ) {
				if ( $post->post_status == 'trash' ) echo $thumb;
				else {
				echo '	
				<a href="media.php?action=edit&amp;attachment_id='.$attachment_id.'" title="'.esc_attr(sprintf(__('Edit &#8220;%s&#8221;', THEMEDOMAIN), $post->post_title)).'">';
				echo $thumb;
				echo "</a>\n";
				}
			}
			break;		

		case 'new_title':
			$att_title = _draft_or_post_title();
			?>
			<strong><a href="<?php echo get_edit_post_link( $post->ID, true ); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;', THEMEDOMAIN ), $att_title ) ); ?>"><?php echo $att_title; ?></a></strong>
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
			global $shiba_media_table;
			if (isset($shiba_media_table))
				echo $shiba_media_table->row_actions( $shiba_media_table->_get_row_actions( $post, $att_title ) ); 
			break;
	
		default:
				break;
		} // end switch
	}
		
	// Change redirect set in upload.php
	function upload_redirect($location, $status) {
		if (strpos($location, 'redirect_back=upload.php') !== FALSE )
			$location = $this->process_upload_messages($location);

		if ( isset($_REQUEST['found_post_id']) && isset($_REQUEST['media']) ) {
			if (!isset($_REQUEST['detached']))
				$location = remove_query_arg('detached', $location);
		}
		return $location;
	}
	
		
	function upload_action() {
		global $wpdb, $shiba_mlib;
		
		if ( !isset($_REQUEST['shiba_doaction']) || !isset($_REQUEST['shiba_action']) || !$_REQUEST['media'] )return;
		check_admin_referer('bulk-media');
		
		$location = 'upload.php';
		if ( $referer = wp_get_referer() ) {
			if ( false !== strpos($referer, 'upload.php') || false !== strpos($referer, 'post.php') )
				$location = $referer;
		}
		
		switch ($_REQUEST['shiba_action']) :
		case 'remove':
			$attach = array();
			foreach( (array) $_REQUEST['media'] as $att_id ) {
				$att_id = (int) $att_id;
		
				if ( !current_user_can('edit_post', $att_id) )
					continue;
		
				$attach[] = $att_id;
			}
		
			if ( ! empty($attach) ) {
				$attach = implode(',', $attach);
				$attached = $wpdb->query( $wpdb->prepare("UPDATE $wpdb->posts SET post_parent = %d WHERE post_type = 'attachment' AND ID IN ($attach)", '') );
			}
		
			if ( isset($attached) ) {
				if (strpos($location, 'post.php?post') !== FALSE) {	
					$location = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids', 'posted', 'attached'), $location );
					$location = add_query_arg( array( 'message' => 11 ) , $location );
				} else $location = add_query_arg( array( 'attached' => $attached ) , $location );
				$shiba_mlib->javascript_redirect($location);
			}
			break;
		case 'set_tags':
			if (!isset($_REQUEST['tax_input']['post_tag'])) return;
			$tag_arr = explode(',',esc_attr($_REQUEST['tax_input']['post_tag']));
			
			foreach( (array) $_REQUEST['media'] as $att_id ) {
				$att_id = absint($att_id);
				if ( !current_user_can('edit_post', $att_id) )
					continue;
		
				// Replace tags for attachment
				wp_set_object_terms( $att_id, $tag_arr, 'post_tag' );
			}
	
			$location = add_query_arg('posted', 1, $location);
			$shiba_mlib->javascript_redirect($location);
			break;
		case 'add_tags':
			if (!isset($_REQUEST['tax_input']['post_tag'])) return;
			$tag_arr = explode(',',esc_attr($_REQUEST['tax_input']['post_tag']));
			
			foreach( (array) $_REQUEST['media'] as $att_id ) {
				$att_id = absint($att_id);
				if ( !current_user_can('edit_post', $att_id) )
					continue;
		
				// Add tags for attachment
				wp_set_object_terms( $att_id, $tag_arr, 'post_tag', TRUE );
			}
	
			$location = add_query_arg('posted', 1, $location);
			$shiba_mlib->javascript_redirect($location);
			break;
		default:
			break;	
		endswitch;
	}
	
	function upload_expanded_menu() {
		global $wpdb, $shiba_mlib, $current_screen;
	
		$this->upload_action();
	
		require_once('includes/meta-boxes.php');

		global $message;
		if ($message) $search_top = 150; else $search_top = 100;				
		add_meta_box('tagsdiv-post_tag', __('Attachment Tags', THEMEDOMAIN), array(&$shiba_mlib->tag_metabox,'post_tags_meta_box'), 'media_library_page', 'normal', 'core'); 
		
		?>
		<style>
        #shiba-search-box { float:right; }
		#shiba-filter-box { float:right; }
        </style>	
        <div class="wrap">   
        <?php screen_icon(); ?>
        <h2>Shiba Media Library</h2> 

        <div id="shiba-search-box">
        <form class="shiba-search-form" action="" method="get">            
            <label class="screen-reader-text" for="media-search-input"><?php _e( 'Search Media', THEMEDOMAIN ); ?>:</label>
            <input type="text" id="media-search-input" name="s" value="<?php the_search_query(); ?>" />
            <input type="submit" value="<?php esc_attr_e( 'Search Media', THEMEDOMAIN ); ?>" class="button" />
            
            <!-- Add drop down box to allow search for other gallery attributes -->
            <select name='search_attribute' id='search_attribute'>
                <option class='search-option' value='title'>Title</option>
                <option class='search-option' value='tag' <?php if (isset($_REQUEST['search_attribute']) && ($_REQUEST['search_attribute'] == 'tag')) echo "selected";?>>Tag</option>
            </select>    
        </form>	
        </div>

        <form id="shiba-filter-box" action="" method="get">
            <?php $this->upload_date_filter(); ?>
        </form>    

        <div id="shiba-mlib-box">
        <form id="shiba-mlib-form" action="" method="<?php if (class_exists('WP_Media_List_Table')) echo 'post'; else echo 'get';?>">
            <?php wp_nonce_field('bulk-media'); ?>
        
            <select name="action" id="mlib_action">
            <option value="-1" selected="selected"><?php _e('Bulk Actions', THEMEDOMAIN); ?></option>
            <option value="delete"><?php _e('Delete Permanently', THEMEDOMAIN); ?></option>
            <option value="attach"><?php _e('Attach to a Post', THEMEDOMAIN); ?></option>
            <option value="remove"><?php _e('Detach from a Post', THEMEDOMAIN); ?></option>

            <option value="set_tags"><?php _e('Set/Replace Tags', THEMEDOMAIN); ?></option>
            <option value="add_tags"><?php _e('Add Tags', THEMEDOMAIN); ?></option>
            </select>
            <!-- Click container mlib_doaction defined in shiba-mlib.dev.js -->
            <input type="submit" value="<?php esc_attr_e('Apply'); ?>" name="doaction" id="mlib_doaction" class="button-secondary action" onClick="processMediaPlusForm('posts-filter');" />


            <div id="poststuff" class="metabox-holder" style="width:400px;" >	
            <?php $tag_meta_box = do_meta_boxes('media_library_page', 'normal', NULL); ?>
            </div>				
 
        </form>
        
       </div>

        </div> <!-- End div wrap -->
       
    	<div style="clear:both;"></div>
	<?php	
	}

	// from media_upload_library_form
	function upload_date_filter() {
		global $wpdb, $wp_locale;
		$arc_query = "SELECT DISTINCT YEAR(post_date) AS yyear, MONTH(post_date) AS mmonth FROM $wpdb->posts WHERE post_type = 'attachment' ORDER BY post_date DESC";
		$arc_result = $wpdb->get_results( $arc_query );
		$month_count = count($arc_result);

		if ( $month_count && !( 1 == $month_count && 0 == $arc_result[0]->mmonth ) ) : ?>
		<select name='m' style="width:170px;height:25px;">
		<option value='0'><?php _e('Show all dates', THEMEDOMAIN); ?></option>
		<?php
		foreach ($arc_result as $arc_row) {
			if ( $arc_row->yyear == 0 )
				continue;
			$arc_row->mmonth = zeroise( $arc_row->mmonth, 2 );
		
			if ( isset($_GET['m']) && ( $arc_row->yyear . $arc_row->mmonth == $_GET['m'] ) )
				$default = ' selected="selected"';
			else
				$default = '';
		
			echo "<option$default value='" . esc_attr("$arc_row->yyear$arc_row->mmonth") . "'>";
			echo $wp_locale->get_month($arc_row->mmonth) . " $arc_row->yyear";
			echo "</option>\n";
		}
		?>
		</select>
		<?php endif; // month_count ?>
		<input type="submit" id="mlib-post-query-submit" value="<?php esc_attr_e('Filter'); ?>" class="button-secondary" style="margin-left:5px"/>	
		<?php
	}    
	
	function process_upload_messages($location) {

		if ( strpos($location, 'deleted=1') !== FALSE ) {
			$location = add_query_arg('message', 12, $location);
		}
		
		if ( strpos($location, 'trashed=1') !== FALSE ) {
			$location = add_query_arg('message', 13, $location);
		}

		if ( strpos($location, 'untrashed=1') !== FALSE ) {
			$location = add_query_arg('message', 14, $location);
		}
		$location = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'attached', 'posted'), $location );
		return $location;		
	}

	function expanded_media_search($q) {
		// Added section for dealing with galleries
		if (isset($_GET['page']) && ($_GET['page'] == 'shiba_manage_gallery')) {
			$q['post_type'] = 'gallery';
			if ($q['post_status'] != 'trash') $q['post_status'] = 'any';
		}
		
		// Now for the expanded search
		global $wpdb;
		// process additional search options
		if (isset($_GET['s']) && isset($_GET['search_attribute'])) {
			$searchStr = $_GET['s'];
			$search = esc_sql(like_escape($_GET['s']));
			$q['s'] = $search;
			$_GET['search'] = $search;
			switch ($_GET['search_attribute']) {
			case 'title':
				break;
			case 'tag':
				// get all tags that are like search string
				$query = "SELECT slug FROM {$wpdb->terms} WHERE name LIKE '%{$search}%'";
				$tags = $wpdb->get_col($query);
				// create comma separated string of slugs
				if (count($tags) <= 0) 
					$tagStr = $search;
				else {	
					$tagStr = '';
					foreach ($tags as $tag) {
						$tagStr .= $tag . ',';
					}
					$tagStr = substr($tagStr, 0, strlen($tagStr)-1);
				}
				$q['tag'] = $tagStr;
				unset($q['s']);	
				break;
			case 'category':	
				// get all tags that are like search string
				$query = "SELECT term_id FROM {$wpdb->terms} WHERE name LIKE '%{$search}%'";
				$categories = $wpdb->get_col($query);
				// create comma separated string of category ids
				if (count($categories) <= 0) 
					$q['category_name'] = $search;
				else {	
					$catStr = '';
					foreach ($categories as $category) {
						$catStr .= $category . ',';
					}
					$catStr = substr($catStr, 0, strlen($catStr)-1);
					$q['cat'] = $catStr;
				}
				unset($q['s']);	
				break;
			default:
				break;
			} // end switch
		}	
		return $q;
	}
	
	function get_search_query($value) {
		if (!$value && isset($_GET['search'])) {
			$value = $_GET['search'];
		}	
		return $value;
	}	
	
} // end class	
endif;
?>