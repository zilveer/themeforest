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

		wp_enqueue_script('shiba-mlib-form', SHIBA_MLIB_URL . 'js/shiba-mlib.dev.js', array(),'1.1', TRUE);
		wp_enqueue_script('wp-ajax-response');
		wp_enqueue_script('shiba-mlib-post', SHIBA_MLIB_URL . 'js/shiba-mlib-post.js', array('suggest'),'1.1', TRUE);

		// bind attach menu option to findPosts javascript
		add_action('admin_footer', array($this,'bind_attach_action')); 
//		add_action('restrict_manage_posts', array($this,'upload_expanded_menu') );	
		add_action('admin_notices', array($this,'upload_expanded_menu') );	

		add_filter('request', array($this,'expanded_media_search'));  // parse_request function
		add_filter( 'get_search_query', array($this, 'get_search_query') );

		if ($shiba_mlib->is_option('qedit')) {
			// Add Quick Edit functionality
			if (!class_exists("Shiba_Media_Library_QEdit"))
				require(SHIBA_MLIB_DIR.'shiba-mlib-qedit.php');
			$shiba_mlib->qedit = new Shiba_Media_Library_QEdit();	
		}
	}
	

	function bind_attach_action() {
		?>
		<script type="text/javascript">
        /* <![CDATA[ */
		jQuery(document).ready(function() {
			jQuery('#find-posts-submit').click(function(e) {
				if ( '' == jQuery('#find-posts-response').html() )
					e.preventDefault();
			});
	
			jQuery('#doaction, #doaction2, #mlib_doaction').click(function(e){
				jQuery('select[name^="action"]').each(function(){
					if ( jQuery(this).val() == 'attach' ) {
						e.preventDefault();
	//					findGalleryPosts.open();
						findPosts.open();
					}
				});
			});
		});
        /* ]]> */
        </script>
        <?php
	} 
	
		
	function upload_action() {
		global $wpdb, $shiba_mlib;
		
		if ( !isset($_REQUEST['shiba_doaction']) || !isset($_REQUEST['shiba_action']) )return;
		check_admin_referer('bulk-media');
		
		$location = 'upload.php';
		if ( $referer = wp_get_referer() ) {
			if ( false !== strpos($referer, 'upload.php') || false !== strpos($referer, 'post.php') )
				$location = $referer;
		}
		$location = remove_query_arg( array('trashed', 'untrashed', 'deleted', 'ids', 'posted', 'attached', 'message'), $location );
		if ( !isset($_REQUEST['media']) ) {
			$location = add_query_arg( array( 'message' => 3 ) , $location );
			$shiba_mlib->javascript_redirect($location);
		}
		switch ($_REQUEST['shiba_action']) :
		case 'remove':
			$attach = array();
			foreach( (array) $_REQUEST['media'] as $att_id ) {
				$att_id = absint($att_id);
		
				if ( !current_user_can('edit_post', $att_id) )
					continue;
		
				$attach[] = $att_id;
			}
		
			if ( ! empty($attach) ) {
				$attachStr = implode(',', $attach);
				$attached = $wpdb->query( "UPDATE {$wpdb->posts} SET post_parent = '' WHERE post_type = 'attachment' AND ID IN ({$attachStr})");
			}

			if ( isset($attached) ) {
				if (strpos($location, 'post.php?post') !== FALSE) {	
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
		add_meta_box('tagsdiv-post_tag', __('Attachment Tags'), array(&$shiba_mlib->tag_metabox,'post_tags_meta_box'), 'media_library_page', 'normal', 'core'); 

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
            <label class="screen-reader-text" for="media-search-input"><?php _e( 'Search Media' ); ?>:</label>
            <input type="text" id="media-search-input" name="s" value="<?php the_search_query(); ?>" />
            <input type="submit" value="<?php esc_attr_e( 'Search Media' ); ?>" class="button" />
            
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
        <form id="shiba-mlib-form" action="" method="post">
            <?php wp_nonce_field('bulk-media'); ?>
        
            <select name="action" id="mlib_action">
            <option value="-1" selected="selected"><?php _e('Bulk Actions'); ?></option>
            <option value="delete"><?php _e('Delete Permanently'); ?></option>
            <option value="attach"><?php _e('Attach to a Post'); ?></option>
            <option value="remove"><?php _e('Detach from a Post'); ?></option>

            <option value="set_tags"><?php _e('Set/Replace Tags'); ?></option>
            <option value="add_tags"><?php _e('Add Tags'); ?></option>
            </select>
            <!-- Click container mlib_doaction defined in shiba-mlib.dev.js -->
            <input type="submit" value="<?php esc_attr_e('Apply'); ?>" name="doaction" id="mlib_doaction" class="button-secondary action" onClick="shibaMediaForm.getMedia('posts-filter');" />


            <div id="poststuff" class="metabox-holder" style="width:400px;" >	
            <?php $tag_meta_box = do_meta_boxes('media_library_page', 'normal', NULL); ?>
            </div>				
 
        </form>
        
       </div>

        </div> <!-- End div wrap -->
       
    	<div style="clear:both;"></div>
	<?php	
		if ($shiba_mlib->is_option('qedit') && is_object($shiba_mlib->qedit)) {
			// Add quick edit form
			$columns = get_column_headers('upload');
			$hidden = array_intersect( array_keys( $columns ), array_filter( get_hidden_columns('upload') ) );
			$col_count = count($columns) - count($hidden);
			$shiba_mlib->qedit->render_inline_edit_form(0, $col_count);
		}
	}

	// from media_upload_library_form
	function upload_date_filter() {
		global $wpdb, $wp_locale;
		$arc_query = "SELECT DISTINCT YEAR(post_date) AS yyear, MONTH(post_date) AS mmonth FROM $wpdb->posts WHERE post_type = 'attachment' ORDER BY post_date DESC";
		$arc_result = $wpdb->get_results( $arc_query );
		$month_count = count($arc_result);

		if ( $month_count && !( 1 == $month_count && 0 == $arc_result[0]->mmonth ) ) : ?>
		<select name='m' style="width:170px;height:25px;">
		<option value='0'><?php _e('Show all dates'); ?></option>
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
			$search = esc_sql($wpdb->esc_like($_GET['s']));
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