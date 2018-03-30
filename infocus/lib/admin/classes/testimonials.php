<?php
/**
 *
 */

class mysiteTestimonial {
	
	/**
	 *
	 */
	public static function init() {
		if ( !is_admin() ) return;
		
		add_action( 'admin_head', array( 'mysiteTestimonial', 'admin_css' ) );
		add_action( 'publish_testimonial', array( 'mysiteTestimonial', 'testimonials_publish' ) );
		
		add_filter( 'post_updated_messages', array( 'mysiteTestimonial', 'updated_messages' ) );
		add_filter( 'manage_edit-testimonial_columns', array( 'mysiteTestimonial', 'columns' ) );
		add_action( 'manage_posts_custom_column', array( 'mysiteTestimonial', 'custom_columns' ) );
	}
	
	/**
	 *
	 */
	public static function admin_css() {
		global $post_type;

		if ( isset( $post_type ) && $post_type == 'testimonial' ) {
			$out = '';
			$out .= '<style type="text/css">';
			$out .= '#post-preview,#titlediv,._image_upload_picture,._image_use_gravatar,#wp-admin-bar-view{display:none;}';
			$out .= '#save-post{float:right;}.column-saved_testimonial{width:240px;}';
			$out .= '.testimonial_image{float: left;padding-right: 10px;}';
			$out .= '.column-testimonial_id{width:100px;}';
			$out .= '</style>';
			
			echo $out . "\r";
		}
	}
	
	/**
	 *
	 */
	public static function updated_messages( $messages ) {
		global $post, $post_ID;

		  $messages['testimonial'] = array(
		    0 => '', // Unused. Messages start at index 1.
		    1 => __( 'Testimonial updated.', MYSITE_ADMIN_TEXTDOMAIN ),
		    2 => __( 'Custom field updated.', MYSITE_ADMIN_TEXTDOMAIN ),
		    3 => __( 'Custom field deleted.', MYSITE_ADMIN_TEXTDOMAIN ),
		    4 => __( 'Testimonial updated.', MYSITE_ADMIN_TEXTDOMAIN ),
		    /* translators: %s: date and time of the revision */
		    5 => isset($_GET['revision']) ? sprintf( __('Testimonial restored to revision from %s', MYSITE_ADMIN_TEXTDOMAIN ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		    6 => __( 'Testimonial published.', MYSITE_ADMIN_TEXTDOMAIN ),
		    7 => __( 'Testimonial saved.', MYSITE_ADMIN_TEXTDOMAIN ),
		    8 => __( 'Testimonial submitted.', MYSITE_ADMIN_TEXTDOMAIN ),
		    9 => sprintf( __('Testimonial scheduled for: <strong>%1$s</strong>.', MYSITE_ADMIN_TEXTDOMAIN ),
		      // translators: Publish box date format, see http://php.net/date
		      date_i18n( __( 'M j, Y @ G:i', MYSITE_ADMIN_TEXTDOMAIN ), strtotime( $post->post_date ) ) ),
		    10 => __( 'Testimonial draft updated.', MYSITE_ADMIN_TEXTDOMAIN ),
		  );

		  return $messages;
	}
	
	
	/**
	 *
	 */
	public static function columns( $columns ) {
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"saved_testimonial" => __( 'Name', MYSITE_ADMIN_TEXTDOMAIN ),
			"testimonial" => __( 'Testimonial', MYSITE_ADMIN_TEXTDOMAIN ),
			"testimonial_id" => __( 'Testimonial ID', MYSITE_ADMIN_TEXTDOMAIN ),
		);

		return $columns;
	}
	
	/**
	 *
	 */
	function custom_columns( $column ) {
		global $post;
		
		$title = _draft_or_post_title();
		$post_type_object = get_post_type_object( $post->post_type );
		$can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );
		
		switch ($column)
		{
			case "testimonial_id":
				echo $post->ID;
				break;
			case "testimonial":
				$custom = get_post_custom();
				if( isset( $custom["_testimonial"][0] ) )
					echo $custom["_testimonial"][0];
				break;
			case "saved_testimonial":
				$custom = get_post_custom();
				
				if( isset( $custom["_image"][0] ) && $custom["_image"][0] == 'upload_picture' && !empty( $custom["_custom_image"][0] ) )
					echo '<div class="testimonial_image"><img src="' . mysite_wp_image( $custom["_custom_image"][0], '32', '32' ) . '" alt="" height="32" width="32" /></div>';
				
				if( isset( $custom["_email"][0] ) && isset( $custom["_image"][0] ) && $custom["_image"][0] == 'use_gravatar' )
					echo '<div class="testimonial_image">' . get_avatar( $custom["_email"][0], 32 ) . '</div>';
				
				if( isset( $custom['_name'][0] ) )
					echo '<div class="testimonial_name"><strong>' . $custom['_name'][0] . '</strong></div>';
				
				if( isset( $custom['_website_name'][0] ) )
					echo '<div class="testimonial_website_name">' . $custom['_website_name'][0] . '</div>';
					
				if( isset( $custom['_website_url'][0] ) )
					echo '<div class="testimonial_website_url"><a href="' . esc_url( $custom['_website_url'][0] ) . '" target="_blank">' . $custom['_website_url'][0] . '</a></div>';
					
				$actions = array();
				if ( $can_edit_post && 'trash' != $post->post_status ) {
					$actions['edit'] = '<a href="' . get_edit_post_link( $post->ID, true ) . '" title="' . esc_attr( __( 'Edit this item', MYSITE_ADMIN_TEXTDOMAIN ) ) . '">' . __( 'Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
					$actions['inline hide-if-no-js'] = '<a href="#" class="editinline" title="' . esc_attr( __( 'Edit this item inline', MYSITE_ADMIN_TEXTDOMAIN ) ) . '">' . __( 'Quick&nbsp;Edit', MYSITE_ADMIN_TEXTDOMAIN ) . '</a>';
				}
				if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
					if ( 'trash' == $post->post_status )
						$actions['untrash'] = "<a title='" . esc_attr( __( 'Restore this item from the Trash', MYSITE_ADMIN_TEXTDOMAIN ) ) . "' href='" . wp_nonce_url( admin_url( sprintf( $post_type_object->_edit_link . '&amp;action=untrash', $post->ID ) ), 'untrash-' . $post->post_type . '_' . $post->ID ) . "'>" . __( 'Restore', MYSITE_ADMIN_TEXTDOMAIN ) . "</a>";
					elseif ( EMPTY_TRASH_DAYS )
						$actions['trash'] = "<a class='submitdelete' title='" . esc_attr( __( 'Move this item to the Trash', MYSITE_ADMIN_TEXTDOMAIN ) ) . "' href='" . get_delete_post_link( $post->ID ) . "'>" . __( 'Trash', MYSITE_ADMIN_TEXTDOMAIN ) . "</a>";
					if ( 'trash' == $post->post_status || !EMPTY_TRASH_DAYS )
						$actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Delete this item permanently', MYSITE_ADMIN_TEXTDOMAIN ) ) . "' href='" . get_delete_post_link( $post->ID, '', true ) . "'>" . __( 'Delete Permanently', MYSITE_ADMIN_TEXTDOMAIN ) . "</a>";
				}

				$actions = apply_filters( is_post_type_hierarchical( $post->post_type ) ? 'page_row_actions' : 'post_row_actions', $actions, $post );
				
				//echo WP_List_Table::row_actions( $actions );
				$action_count = count( $actions );
				$i = 0;

				echo '<div class="row-actions">';
				foreach ( $actions as $action => $link ) {
					++$i;
					( $i == $action_count ) ? $sep = '' : $sep = ' | ';
					echo "<span class='$action'>$link$sep</span>";
				}
				echo '</div>';

				get_inline_data( $post );
				
				break;
		}
	}
	
	/**
	 *
	 */
	public static function testimonials_publish( $post_id ) {
		global $wpdb, $post;	
		if( isset( $_POST[MYSITE_SETTINGS]['_name'] ) )
			$wpdb->update( $wpdb->posts, array( 'post_title' => $_POST[MYSITE_SETTINGS]['_name'] ), array( 'ID' => $post_id ) );
	}

}

?>