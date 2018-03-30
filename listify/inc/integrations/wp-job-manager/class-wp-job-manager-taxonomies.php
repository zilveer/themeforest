<?php
/**
 * Handles taxonomies in admin
 *
 * @since 1.4.0
 *
 * @package Listify
 * @category Admin
 */
class Listify_WP_Job_Manager_Taxonomies {

	public function __construct() {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$this->taxonomies = apply_filters( 'listify_taxonomy_meta', array(
			'job_listing_category',
			'job_listing_region',
			'job_listing_tag',
			'job_listing_type'
		) );

		// add media scipts
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );

		// Add form
		foreach ( $this->taxonomies as $taxonomy ) {
			add_action( $taxonomy . '_add_form_fields', array( $this, 'add_term_fields' ) );
			add_action( $taxonomy . '_edit_form_fields', array( $this, 'edit_term_fields' ), 10 );

			add_filter( 'manage_edit-' . $taxonomy . '_columns', array( $this, 'term_columns' ) );
			add_filter( 'manage_' . $taxonomy . '_custom_column', array( $this, 'term_column' ), 10, 3 );
		}

		add_action( 'created_term', array( $this, 'save_term_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_term_fields' ), 10, 3 );
		add_action( 'save_post', array( $this, 'clear_term_marker' ) );
	}

	public function admin_scripts() {
		$screen = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		$screens = array();

		foreach ( $this->taxonomies as $taxonomy ) {
			$screens[] = 'edit-' . $taxonomy;
		}

		if ( in_array( $screen_id, $screens ) ) {
			wp_enqueue_media();
		}
	}

	/**
	 * Category thumbnail fields.
	 */
	public function add_term_fields() {
		?>
		<div class="form-field term-thumbnail-wrap">
			<label><?php _e( 'Featured Image', 'listify' ); ?></label>
			<div id="term_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( wc_placeholder_img_src() ); ?>" width="60px" height="60px" /></div>
			<div style="line-height: 60px;">
				<input type="hidden" id="term_thumbnail_id" name="term_thumbnail_id" />
				<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'listify' ); ?></button>
				<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'listify' ); ?></button>
			</div>
			<script type="text/javascript">

				// Only show the "remove image" button when needed
				if ( ! jQuery( '#term_thumbnail_id' ).val() ) {
					jQuery( '.remove_image_button' ).hide();
				}

				// Uploading files
				var file_frame;

				jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

					event.preventDefault();

					// If the media frame already exists, reopen it.
					if ( file_frame ) {
						file_frame.open();
						return;
					}

					// Create the media frame.
					file_frame = wp.media.frames.downloadable_file = wp.media({
						title: '<?php esc_html_e( 'Choose an image', 'listify' ); ?>',
						button: {
							text: '<?php esc_html_e( 'Use image', 'listify' ); ?>'
						},
						multiple: false
					});

					// When an image is selected, run a callback.
					file_frame.on( 'select', function() {
						var attachment = file_frame.state().get( 'selection' ).first().toJSON();

						jQuery( '#term_thumbnail_id' ).val( attachment.id );
						jQuery( '#term_thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
						jQuery( '.remove_image_button' ).show();
					});

					// Finally, open the modal.
					file_frame.open();
				});

				jQuery( document ).on( 'click', '.remove_image_button', function() {
					jQuery( '#term_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
					jQuery( '#term_thumbnail_id' ).val( '' );
					jQuery( '.remove_image_button' ).hide();
					return false;
				});

			</script>
			<div class="clear"></div>
		</div>
		<?php
	}

	/**
	 * Edit category thumbnail field.
	 *
	 * @param mixed $term Term (category) being edited
	 */
	public function edit_term_fields( $term ) {
		$thumbnail_id = absint( get_term_meta( $term->term_id, 'thumbnail_id', true ) );

		if ( $thumbnail_id ) {
			$image = wp_get_attachment_thumb_url( $thumbnail_id );
		} else {
			$image = wc_placeholder_img_src();
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label><?php _e( 'Featured Image', 'listify' ); ?></label></th>
			<td>
				<div id="term_thumbnail" style="float: left; margin-right: 10px;"><img src="<?php echo esc_url( $image ); ?>" width="60px" height="60px" /></div>
				<div style="line-height: 60px;">
					<input type="hidden" id="term_thumbnail_id" name="term_thumbnail_id" value="<?php echo $thumbnail_id; ?>" />
					<button type="button" class="upload_image_button button"><?php _e( 'Upload/Add image', 'listify' ); ?></button>
					<button type="button" class="remove_image_button button"><?php _e( 'Remove image', 'listify' ); ?></button>
				</div>
				<script type="text/javascript">

					// Only show the "remove image" button when needed
					if ( '0' === jQuery( '#term_thumbnail_id' ).val() ) {
						jQuery( '.remove_image_button' ).hide();
					}

					// Uploading files
					var file_frame;

					jQuery( document ).on( 'click', '.upload_image_button', function( event ) {

						event.preventDefault();

						// If the media frame already exists, reopen it.
						if ( file_frame ) {
							file_frame.open();
							return;
						}

						// Create the media frame.
						file_frame = wp.media.frames.downloadable_file = wp.media({
							title: '<?php esc_html_e( 'Choose an image', 'listify' ); ?>',
							button: {
								text: '<?php esc_html_e( 'Use image', 'listify' ); ?>'
							},
							multiple: false
						});

						// When an image is selected, run a callback.
						file_frame.on( 'select', function() {
							var attachment = file_frame.state().get( 'selection' ).first().toJSON();

							jQuery( '#term_thumbnail_id' ).val( attachment.id );
							jQuery( '#term_thumbnail' ).find( 'img' ).attr( 'src', attachment.sizes.thumbnail.url );
							jQuery( '.remove_image_button' ).show();
						});

						// Finally, open the modal.
						file_frame.open();
					});

					jQuery( document ).on( 'click', '.remove_image_button', function() {
						jQuery( '#term_thumbnail' ).find( 'img' ).attr( 'src', '<?php echo esc_js( wc_placeholder_img_src() ); ?>' );
						jQuery( '#term_thumbnail_id' ).val( '' );
						jQuery( '.remove_image_button' ).hide();
						return false;
					});

				</script>
				<div class="clear"></div>
			</td>
		</tr>
		<?php
	}

	/**
	 * save_category_fields function.
	 *
	 * @param mixed $term_id Term ID being saved
	 * @param mixed $tt_id
	 * @param string $taxonomy
	 */
	public function save_term_fields( $term_id, $tt_id = '', $taxonomy = '' ) {
		if ( isset( $_POST['term_thumbnail_id'] ) && in_array( $taxonomy, $this->taxonomies ) ) {
			update_term_meta( $term_id, 'thumbnail_id', absint( $_POST['term_thumbnail_id'] ) );
		}
	}

	/**
	 * Thumbnail column added to category admin.
	 *
	 * @param mixed $columns
	 * @return array
	 */
	public function term_columns( $columns ) {
		$new_columns          = array();
		$new_columns['cb']    = $columns['cb'];
		$new_columns['thumb'] = __( 'Featured Image', 'listify' );

		unset( $columns['cb'] );

		return array_merge( $new_columns, $columns );
	}

	/**
	 * Thumbnail column value added to category admin.
	 *
	 * @param string $columns
	 * @param string $column
	 * @param int $id
	 * @return array
	 */
	public function term_column( $columns, $column, $id ) {

		if ( 'thumb' == $column ) {

			$thumbnail_id = get_term_meta( $id, 'thumbnail_id', true );

			if ( $thumbnail_id ) {
				$image = wp_get_attachment_thumb_url( $thumbnail_id );
			} else {
				$image = wc_placeholder_img_src();
			}

			// Prevent esc_url from breaking spaces in urls for image embeds
			// Ref: http://core.trac.wordpress.org/ticket/23605
			$image = str_replace( ' ', '%20', $image );

			$columns .= '<img src="' . esc_url( $image ) . '" alt="' . esc_attr__( 'Thumbnail', 'listify' ) . '" class="wp-post-image" height="48" width="48" />';

		}

		return $columns;
	}

	/**
	 * Clear the term marker transient when a post is updated.
	 *
	 * @since 1.4.1
	 * @return void
	 */
	public function clear_term_marker( $post_id ) {
        global $post;

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( ! is_object( $post ) ) {
            return;
        }

        if ( 'job_listing' != $post->post_type ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post->ID ) ) {
            return;
        }

		delete_transient( 'listify_marker_term_' . $post->ID );
	}

}
