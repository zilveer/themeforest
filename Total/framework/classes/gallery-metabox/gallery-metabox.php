<?php
/**
 * Creates a gallery metabox for WordPress
 *
 * http://wordpress.org/plugins/easy-image-gallery/
 * https://github.com/woothemes/woocommerce
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Gallery_Metabox' ) ) {
	class WPEX_Gallery_Metabox {
		private $dir;
		private $post_types;

		/**
		 * Initialize the class and set its properties.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {

			// Update directory var
			$this->dir = apply_filters( 'wpex_gallery_metabox_dir_uri', get_template_directory_uri() .'/inc/classes/gallery-metabox/' );

			// Post types to add the metabox to
			$this->post_types = apply_filters( 'wpex_gallery_metabox_post_types', array( 'post' ) );

			// Add metabox to corresponding post types
			foreach( $this->post_types as $key => $val ) {
				add_action( 'add_meta_boxes_'. $val, array( $this, 'add_meta' ), 20 );
			}

			// Save metabox
			add_action( 'save_post', array( $this, 'save_meta' ) );

			// Add inline CSS for the design
			add_action( 'admin_print_styles-post.php', array( $this, 'css' ) );
			add_action( 'admin_print_styles-post-new.php', array( $this, 'css' ) );
			
		}

		/**
		 * Adds the gallery metabox
		 *
		 * @since 1.0.0
		 */
		function add_meta( $post ) {
			add_meta_box(
				'wpex-gallery-metabox', 
				esc_html__( 'Image Gallery', 'total' ),
				array( $this, 'render' ),
				$post->post_type,
				'normal',
				'high'
			);
		}

		/**
		 * Render the gallery metabox
		 *
		 * @since 1.0.0
		 */
		public function render() {
			global $post; ?>
			<div id="wpex_gallery_images_container">
				<ul class="wpex_gallery_images">
					<?php
					$image_gallery = get_post_meta( $post->ID, '_easy_image_gallery', true );
					$attachments = array_filter( explode( ',', $image_gallery ) );
					if ( $attachments ) {
						foreach ( $attachments as $attachment_id ) {
							if ( wp_attachment_is_image ( $attachment_id  ) ) {
								echo '<li class="image" data-attachment_id="' . $attachment_id . '"><div class="attachment-preview"><div class="thumbnail">
											' . wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</div>
											<a href="#" class="wpex-gmb-remove" title="' . esc_html__( 'Remove image', 'total' ) . '"><div class="media-modal-icon"></div></a>
										</div></li>';
							}
						}
					} ?>
				</ul>
				<input type="hidden" id="image_gallery" name="image_gallery" value="<?php echo esc_attr( $image_gallery ); ?>" />
				<?php wp_nonce_field( 'easy_image_gallery', 'easy_image_gallery' ); ?>
			</div>
			<p class="add_wpex_gallery_images hide-if-no-js">
				<a href="#" class="button-primary"><?php esc_html_e( 'Add/Edit Images', 'total' ); ?></a>
			</p>
			<p>
				<label for="easy_image_gallery_link_images">
					<input type="checkbox" id="easy_image_gallery_link_images" value="on" name="easy_image_gallery_link_images"<?php echo checked( get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ), 'on', false ); ?> /> <?php esc_html_e( 'Enable Lightbox for this gallery?', 'total' )?>
				</label>
			</p>
			<?php // Props to WooCommerce for the following JS code ?>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					// Uploading files
					var image_gallery_frame;
					var $image_gallery_ids   = $( '#image_gallery' );
					var $wpex_gallery_images = $( '#wpex_gallery_images_container ul.wpex_gallery_images' );
					jQuery( '.add_wpex_gallery_images' ).on( 'click', 'a', function( event ) {
						var $el = $(this);
						var attachment_ids = $image_gallery_ids.val();
						event.preventDefault();
						// If the media frame already exists, reopen it.
						if ( image_gallery_frame ) {
							image_gallery_frame.open();
							return;
						}
						// Create the media frame.
						image_gallery_frame = wp.media.frames.downloadable_file = wp.media( {
							// Set the title of the modal.
							title: "<?php esc_html_e( 'Add Images to Gallery', 'total' ); ?>",
							button: {
								text: "<?php esc_html_e( 'Add to gallery', 'total' ); ?>",
							},
							multiple: true
						} );
						// When an image is selected, run a callback.
						image_gallery_frame.on( 'select', function() {
							var selection = image_gallery_frame.state().get('selection');
							selection.map( function( attachment ) {
								attachment = attachment.toJSON();
								if ( attachment.id ) {
									attachment_ids = attachment_ids ? attachment_ids + "," + attachment.id : attachment.id;
									 $wpex_gallery_images.append('\
										<li class="image" data-attachment_id="' + attachment.id + '">\
											<div class="attachment-preview">\
												<div class="thumbnail">\
													<img src="' + attachment.url + '" />\
												</div>\
											   <a href="#" class="wpex-gmb-remove" title="<?php esc_html_e( 'Remove image', 'total' ); ?>"><div class="media-modal-icon"></div></a>\
											</div>\
										</li>');
								}
							} );
							$image_gallery_ids.val( attachment_ids );
						} );
						// Finally, open the modal.
						image_gallery_frame.open();
					} );
					// Image ordering
					$wpex_gallery_images.sortable( {
						items                : 'li.image',
						cursor               : 'move',
						scrollSensitivity    : 40,
						forcePlaceholderSize : true,
						forceHelperSize      : false,
						helper               : 'clone',
						opacity              : 0.65,
						placeholder          : 'wc-metabox-sortable-placeholder',
						start                : function( event,ui ) {
							ui.item.css( 'background-color', '#f6f6f6' );
						},
						stop                 : function( event,ui ) {
							ui.item.removeAttr( 'style' );
						},
						update               : function( event, ui ) {
							var attachment_ids = '';
							$( '#wpex_gallery_images_container ul li.image' ).css( 'cursor', 'default' ).each( function() {
								var attachment_id = jQuery(this).attr( 'data-attachment_id' );
								attachment_ids = attachment_ids + attachment_id + ',';
							} );
							$image_gallery_ids.val( attachment_ids );
						}
					} );
					// Remove images
					$( '#wpex_gallery_images_container' ).on( 'click', 'a.wpex-gmb-remove', function() {
						$( this ).closest( 'li.image' ).remove();
						var attachment_ids = '';
						$( '#wpex_gallery_images_container ul li.image' ).css( 'cursor', 'default' ).each( function() {
							var attachment_id = jQuery( this ).attr( 'data-attachment_id' );
							attachment_ids = attachment_ids + attachment_id + ',';
						} );
						$image_gallery_ids.val( attachment_ids );
						return false;
					} );
				} );
			</script>
		<?php
		}

		/**
		 * Render the gallery metabox
		 *
		 * @since 1.0.0
		 */
		public static function save_meta( $post_id ) {

			// Check nonce
			if ( ! isset( $_POST[ 'easy_image_gallery' ] )
				|| ! wp_verify_nonce( $_POST[ 'easy_image_gallery' ], 'easy_image_gallery' )
			) {
				return;
			}

			// Check auto save
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			}

			// Check user permissions
			$post_types = array( 'post' );
			if ( isset( $_POST['post_type'] ) && 'post' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				}
			}

			if ( isset( $_POST[ 'image_gallery' ] ) && !empty( $_POST[ 'image_gallery' ] ) ) {
				$attachment_ids = sanitize_text_field( $_POST['image_gallery'] );
				// Turn comma separated values into array
				$attachment_ids = explode( ',', $attachment_ids );
				// Clean the array
				$attachment_ids = array_filter( $attachment_ids  );
				// Return back to comma separated list with no trailing comma. This is common when deleting the images
				$attachment_ids =  implode( ',', $attachment_ids );
				update_post_meta( $post_id, '_easy_image_gallery', $attachment_ids );
			} else {
				// Delete gallery
				delete_post_meta( $post_id, '_easy_image_gallery' );
			}

			// link to larger images
			if ( isset( $_POST[ 'easy_image_gallery_link_images' ] ) ) {
				update_post_meta( $post_id, '_easy_image_gallery_link_images', $_POST[ 'easy_image_gallery_link_images' ] );
			} else {
				update_post_meta( $post_id, '_easy_image_gallery_link_images', 'off' );
			}

			// Add action
			do_action( 'wpex_save_gallery_metabox', $post_id );

		}

		/**
		 * Render the gallery metabox
		 *
		 * @since 1.0.0
		 */
		public function css() {

			global $post;

			if ( ! in_array( $post->post_type, $this->post_types ) ) {
				return;
			} ?>

			<style>
				.wpex_gallery_images .details.attachment { box-shadow: none }
				.wpex_gallery_images .image > div { width: 80px; height: 80px; box-shadow: none; }
				.wpex_gallery_images .attachment-preview { position: relative; padding: 4px; }
				.wpex_gallery_images .attachment-preview .thumbnail { cursor: move }    
				.wpex_gallery_images .wc-metabox-sortable-placeholder{width: 80px;height: 80px;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;border:4px dashed #ddd;background:#f7f7f7 url("<?php echo esc_url( $this->dir ); ?>watermark.png") no-repeat center}
				.wpex_gallery_images .wpex-gmb-remove {background: #eee url("<?php echo esc_url( $this->dir ); ?>delete.png") center center no-repeat;position: absolute;top: 2px;right: 2px;border-radius: 2px;padding: 2px;display: none;width: 10px;height: 10px;margin: 0;display: none;overflow: hidden;} 
				.wpex_gallery_images .image div:hover .wpex-gmb-remove { display: block }
				.wpex_gallery_images:after, #wpex_gallery_images_container:after { content: "."; display: block; height: 0; clear: both; visibility: hidden; }
				#wpex_gallery_images_container ul { margin: 0 !important }
				.wpex_gallery_images > li { float: left; cursor: move; margin: 9px 9px 0 0; }
				.wpex_gallery_images li.image img { width: 80px; height: 80px; }
				.wpex_gallery_images .attachment-preview:before { display: none !important; }
			</style>

			<?php
		}
	}
}

// Class needed only in the admin
if ( is_admin() ) {
	$wpex_gallery_metabox = new WPEX_Gallery_Metabox;
}

/**
 * Check if the post has a gallery
 *
 * @since 3.0.0
 */
function wpex_post_has_gallery( $post_id = '' ) {
	$post_id = $post_id ? $post_id : wpex_global_obj( 'post_id' );
	if ( get_post_meta( $post_id, '_easy_image_gallery', true ) ) {
		return true;
	}
}

/**
 * Retrieve attachment IDs
 *
 * @since 1.0.0
 */
function wpex_get_gallery_ids( $post_id = '' ) {
	$post_id = $post_id ? $post_id : wpex_global_obj( 'post_id' );
	$post_id = $post_id ? $post_id : get_the_ID(); // Extra check for VC
	$attachment_ids = get_post_meta( $post_id, '_easy_image_gallery', true );
	if ( $attachment_ids ) {
		$attachment_ids = explode( ',', $attachment_ids );
		return array_filter( $attachment_ids );
	}
}

/**
 * Get array of gallery image urls
 *
 * @since 3.5.0
 */
function wpex_get_gallery_images( $post_id = '', $size = 'full' ) {
	$ids = wpex_get_gallery_ids( $post_id );
	if ( $ids ) {
		$images = array();
		foreach ( $ids as $id ) {
			$image = wp_get_attachment_image_src( $id, $size );
			$image = isset( $image[0] ) ? $image[0] : '';
			if ( $image ) {
				$images[] = $image;
			}
		}
		return $images;
	}
}

/**
 * Retrieve attachment data
 *
 * @since 1.0.0
 */
function wpex_get_attachment( $id ) {
	$attachment = get_post( $id );
	return array(
		'alt'         => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
		'caption'     => $attachment->post_excerpt,
		'description' => $attachment->post_content,
		'href'        => get_permalink( $attachment->ID ),
		'src'         => $attachment->guid,
		'title'       => $attachment->post_title,
	);
}

/**
 * Return gallery count
 *
 * @since 1.0.0
 */
function wpex_gallery_count() {
	$ids = wpex_get_gallery_ids();
	return count( $ids );
}

/**
 * Check if lightbox is enabled
 *
 * @since 1.0.0
 */
function wpex_gallery_is_lightbox_enabled() {
	if ( 'on' == get_post_meta( get_the_ID(), '_easy_image_gallery_link_images', true ) ) {
		return true;
	}
}