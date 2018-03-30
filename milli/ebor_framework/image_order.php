<?php

class ReorderEntryImages {

	protected $version = '1.0.3';

	protected $plugin_slug = 'reorder-entry-images';

	protected static $instance = null;

	protected $plugin_screen_hook_suffix = 'reorder-entry-images';

	protected $the_post_type = array('page', 'post');

	private function __construct() {

		if( is_admin() ) :

			// Add metabox on the proper metabox hook
			if( is_array( $this->the_post_type ) ) {
				foreach ( $this->the_post_type as $type ) {
					add_action( 'add_meta_boxes_' . $type, array( $this, 'add_image_sortable_box' ) );
				}
			}

			// Updates the attachments when saving
			add_filter( 'wp_insert_post_data', array( $this, 'sort_images_meta_save' ), 99, 2 );

		endif;
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Add a custom metabox to post, page or cpt, that displays the attachments in a list.
	 *
	 * @since   1.0.0
	 */
	public function add_image_sortable_box() {

		$images = get_children(
			array(
				'post_parent' => get_the_ID(),
				'post_type' => 'attachment',
				'post_mime_type' => 'image'
			)
		);
		if ( $images ) {
			if( is_array( $this->the_post_type ) ) {
				foreach( $this->the_post_type as $type ) {
					add_meta_box(
						'sort-entry-images',
						__( 'Drag & Drop to Reorder Gallery', 'ebor_starter' ),
						array( $this, 'add_image_metabox_sorter' ),
						$type,
						'normal',
						'default'
					);
				}
			}
		}
	}

	/**
	 * Gets all attachments and displays them in a sortable list on admin pages.
	 *
	 * @param 	array|object 	$p
	 * @since   1.0.0
	 */
	public function add_image_metabox_sorter( $p ) {

		$thumb_id = get_post_thumbnail_id( get_the_ID() );

		$args = array(
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
			'post_type'      => 'attachment',
			'post_parent'    => get_the_ID(),
			'post_mime_type' => 'image/jpeg',
			'post_status'    => null,
			'numberposts'    => -1,
			'exclude'		 => $thumb_id // Exclude featured thumbnail
		);

		$attachments = get_posts( $args );

		if( $attachments ) :
			wp_nonce_field( 'custom_images_sort', 'images_sort_nonce' ); ?>

			<div class="imageuploader">
				<div id="attachmentcontainer">
					<?php $i = 0; foreach( $attachments as $attachment ) : // pre($attachment);
						$editorimage = wp_get_attachment_image_src( $attachment->ID, 'thumbnail', false, false);
						$i++;
						?>
						<div class="attachment" id="image-<?php echo $attachment->ID; ?>">
							<div class="image">
								<a href="<?php echo esc_url( get_admin_url( '', 'post.php?post='.$attachment->ID.'&action=edit' ) ); ?>" title="<?php echo esc_attr( $attachment->post_title ); ?>">
									<img width="100" height="auto" src="<?php echo esc_url( $editorimage[0] ); ?>" />
								</a>
								<input type="hidden" name="att_id[]" id="att_id" value="<?php echo esc_attr( $attachment->ID ); ?>" />
							</div>
							<div class="title"><?php echo esc_attr( $attachment->post_title ); ?></div>
							<span class="number"><a class="submitdelete deletion" onclick="return showNotice.warn();" href="<?php echo get_delete_post_link( $attachment->ID, '', true ); ?>">Delete Permanently</a></span>
						</div>
					<?php endforeach; ?>
					<div style="clear: both;"></div>
				</div>
			</div>

		<?php
		endif;
	}

	/**
	 * Saves the data to the post
	 *
	 * @param 	array 	$data			Sinitized post data
	 * @param 	array 	$_post_vars		Raw post data
	 * @return	$data
	 * @since   1.0.0
	 */
	public function sort_images_meta_save( $data, $_post_vars ) {
		//global $post_ID;
		$post_ID = $_post_vars['ID'];

		if( !in_array( $data['post_type'], $this->the_post_type ) || !isset( $_post_vars['images_sort_nonce'] ) ) {
			return $data;
		}

		if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
			return $data;
		}

		if( !wp_verify_nonce( $_post_vars['images_sort_nonce'], 'custom_images_sort' ) ) {
			return $data;
		}

		if( !current_user_can( 'edit_post', $post_ID ) ) {
			return $data;
		}

		if( isset( $_post_vars['att_id'] ) ) {
			foreach( $_post_vars['att_id'] as $img_index => $img_id ) {
				$a = array(
					'ID' => $img_id,
					'menu_order' => $img_index
				);
				wp_update_post( $a );
			}
		}
		return $data;
	}
	
}
ReorderEntryImages::get_instance();