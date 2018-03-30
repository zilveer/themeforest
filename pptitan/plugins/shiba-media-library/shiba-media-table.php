<?php
if (!function_exists('is_admin')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}


if (!class_exists("Shiba_Media_List_Table")) :
	if(!class_exists('WP_Media_List_Table')){
		require_once( ABSPATH . 'wp-admin/includes/class-wp-media-list-table.php' );
	}
	class Shiba_Media_List_Table extends WP_Media_List_Table { 
		public $is_trash = FALSE; 
		
		// for wordpress 3.1 and above. Replaces edit-attachment-rows.php
		function display_media_table() { 
			// filling in arguments needed from get_column_info
			global $post;
			$redir_tab = 'gallery';
			$this->_column_headers = array($this->get_columns(), array(), array() /*$this->get_sortable_columns()*/);
			$singular = $this->_args['singular'];
//          $this->display_tablenav( 'top' );
	
			?>
            <table class="wp-list-table <?php echo implode( ' ', $this->get_table_classes() ); ?>">
                <thead>
                <tr>
                    <?php $this->print_column_headers(); ?>
                </tr>
                </thead>
            
                <tfoot>
                <tr>
                    <?php $this->print_column_headers( false ); ?>
                </tr>
                </tfoot>
            
                <tbody id="the-list"<?php
                    if ( $singular ) {
                        echo " data-wp-lists='list:$singular'";
                    } ?>>
                    <?php 
                    global $wp_query, $menu_order;
                    // order posts by menu order
                    if (is_array($menu_order) /*&& !isset($_GET['orderby'])*/) {
                        usort($wp_query->posts, array($this, 'menu_order_cmp')); 
                        unset($menu_order);
                    }	
            
                    $this->display_rows_or_placeholder(); 
                    ?>
                </tbody>
            </table>

			<?php 
//			$this->display_tablenav( 'bottom' );
 	}
	
	function menu_order_cmp($a, $b) {
		global $menu_order;

   		$pos1 = isset($menu_order[$a->ID]) ? $menu_order[$a->ID] : 0;
   		$pos2 = isset($menu_order[$b->ID]) ? $menu_order[$b->ID] : 0;

   		if ($pos1==$pos2)
       		return 0;
  		 else
      		return ($pos1 < $pos2 ? -1 : 1);
	}

	function display_row_actions( $post, $att_title ) {
		echo $this->row_actions( $this->_get_row_actions( $post, $att_title ) ); 	
	}


	function get_cinfo() {
		return $this->get_column_info();	
	}
	
	// From class-wp-media-list-table.php. Can't properly inherit because it is specified 
	// as private as of WP 4.0. Therefore, we have to respecify it which is brain-dead but
	// ah well. 
	private function _get_row_actions( $post, $att_title ) {
		$actions = array();

		if ( $this->detached ) {
			if ( current_user_can( 'edit_post', $post->ID ) )
				$actions['edit'] = '<a href="' . get_edit_post_link( $post->ID, true ) . '">' . __( 'Edit' ) . '</a>';
			if ( current_user_can( 'delete_post', $post->ID ) )
				if ( EMPTY_TRASH_DAYS && MEDIA_TRASH ) {
					$actions['trash'] = "<a class='submitdelete' href='" . wp_nonce_url( "post.php?action=trash&amp;post=$post->ID", 'trash-post_' . $post->ID ) . "'>" . __( 'Trash' ) . "</a>";
				} else {
					$delete_ays = !MEDIA_TRASH ? " onclick='return showNotice.warn();'" : '';
					$actions['delete'] = "<a class='submitdelete'$delete_ays href='" . wp_nonce_url( "post.php?action=delete&amp;post=$post->ID", 'delete-post_' . $post->ID ) . "'>" . __( 'Delete Permanently' ) . "</a>";
				}
			$actions['view'] = '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( sprintf( __( 'View &#8220;%s&#8221;' ), $att_title ) ) . '" rel="permalink">' . __( 'View' ) . '</a>';
			if ( current_user_can( 'edit_post', $post->ID ) )
				$actions['attach'] = '<a href="#the-list" onclick="findPosts.open( \'media[]\',\''.$post->ID.'\' );return false;" class="hide-if-no-js">'.__( 'Attach' ).'</a>';
		}
		else {
			if ( current_user_can( 'edit_post', $post->ID ) && !$this->is_trash )
				$actions['edit'] = '<a href="' . get_edit_post_link( $post->ID, true ) . '">' . __( 'Edit' ) . '</a>';
			if ( current_user_can( 'delete_post', $post->ID ) ) {
				if ( $this->is_trash )
					$actions['untrash'] = "<a class='submitdelete' href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$post->ID", 'untrash-post_' . $post->ID ) . "'>" . __( 'Restore' ) . "</a>";
				elseif ( EMPTY_TRASH_DAYS && MEDIA_TRASH )
					$actions['trash'] = "<a class='submitdelete' href='" . wp_nonce_url( "post.php?action=trash&amp;post=$post->ID", 'trash-post_' . $post->ID ) . "'>" . __( 'Trash' ) . "</a>";
				if ( $this->is_trash || !EMPTY_TRASH_DAYS || !MEDIA_TRASH ) {
					$delete_ays = ( !$this->is_trash && !MEDIA_TRASH ) ? " onclick='return showNotice.warn();'" : '';
					$actions['delete'] = "<a class='submitdelete'$delete_ays href='" . wp_nonce_url( "post.php?action=delete&amp;post=$post->ID", 'delete-post_' . $post->ID ) . "'>" . __( 'Delete Permanently' ) . "</a>";
				}
			}
			if ( !$this->is_trash ) {
				$title =_draft_or_post_title( $post->post_parent );
				$actions['view'] = '<a href="' . get_permalink( $post->ID ) . '" title="' . esc_attr( sprintf( __( 'View &#8220;%s&#8221;' ), $title ) ) . '" rel="permalink">' . __( 'View' ) . '</a>';
			}
		}

		/**
		 * Filter the action links for each attachment in the Media list table.
		 *
		 * @since 2.8.0
		 *
		 * @param array   $actions  An array of action links for each attachment.
		 *                          Default 'Edit', 'Delete Permanently', 'View'.
		 * @param WP_Post $post     WP_Post object for the current attachment.
		 * @param bool    $detached Whether the list table contains media not attached
		 *                          to any posts. Default true.
		 */
		$actions = apply_filters( 'media_row_actions', $actions, $post, $this->detached );

		return $actions;
	}
}
endif;
?>