<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Wolf_Video_Thumbnail' ) ) {
	/**
	 * Wolf_Video_Thumbnail class
	 *
	 * Helper class to generate thumbnail from youtube and vimeo videos
	 *
	 */
	class Wolf_Video_Thumbnail {

		/**
		 * Wolf_Video_Thumbnail Constructor.
		 *
		 * @access public
		 * @return void
		 */
		public function __construct() {

			add_action( 'admin_init', array( $this, 'add_metabox' ) );

			// AJAX callback
			add_action( 'wp_ajax_video_thumbnail', array( $this, 'video_thumbnail_callback' ) );
			add_action( 'wp_ajax_video_thumbnail_delete', array( $this, 'video_thumbnail_delete_callback' ) );
			add_action( 'wp_ajax_wolf_thumbnail_delete', array( $this, 'thumbnail_delete_callback' ) );

			// AJAX Searching
			if ( in_array( basename( $_SERVER['PHP_SELF'] ), apply_filters( 'video_thumbnail_editor_pages', array( 'post-new.php', 'page-new.php', 'post.php', 'page.php' ) ) ) ) {
				add_action( 'admin_head', array( $this, 'video_thumbnail_script' ) );
			}
		}

		/**
		 * Get all post types
		 *
		 * @access public
		 * @return array
		 */
		public function get_post_types() {

			return array( 'post' );
		}

		/**
		 * Get Vimeo Info
		 *
		 * @access public
		 * @param int $id
		 * @param string $info
		 * @return array
		 */
		public function get_vimeo_info( $id, $info = 'thumbnail_large' ) {

			if ( ! function_exists( 'curl_init' ) ) {
				return null;
			} else {
				$ch = curl_init();
				$videoinfo_url = "http://vimeo.com/api/v2/video/$id.php";
				curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
				curl_setopt( $ch, CURLOPT_HEADER, 0 );
				curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
				curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
				$output = unserialize( curl_exec( $ch ) );
				$output = $output[0][$info];
				if ( curl_error( $ch ) != null ) {
					$output = new WP_Error(
						'vimeo_info_retrieval',
						sprintf(
							__(
'Error retrieving video information from the URL <a href="%1$s">%1$s</a>.<a href="%2$s">Libcurl error</a> %3$s: <code>%4$s</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.',
								'wolf'
							),
							$videoinfo_url,
							'http://curl.haxx.se/libcurl/c/libcurl-errors.html',
							curl_errno( $ch ),
							curl_error( $ch )
						)
					);
				}
				curl_close( $ch );

				return $output;
			}
		}

		/**
		 * Get the first video URL in the post
		 *
		 * @access public
		 * @param int $post_id
		 * @return string/bool
		 */
		public function get_video_url( $post_id ) {

			if ( ! $post_id ) $post_id = get_the_ID();

			$content = get_post_field( 'post_content', $post_id );

			$has_video_url = preg_match( '#youtube(?:\-nocookie)?\.com/watch\?v=([A-Za-z0-9\-_]+)#', $content, $match )
			|| preg_match( '#youtube(?:\-nocookie)?\.com/v/([A-Za-z0-9\-_]+)#', $content, $match )
			|| preg_match( '#youtube(?:\-nocookie)?\.com/embed/([A-Za-z0-9\-_]+)#', $content, $match )
			|| preg_match( '#youtu.be/([A-Za-z0-9\-_]+)#', $content, $match )

			|| preg_match( '#vimeo\.com/([0-9]+)#', $content, $match )
			|| preg_match( '#player.vimeo.com/video/([0-9]+)#', $content, $match );

			$video_url = ( $has_video_url ) ? esc_url( $match[0] ) : null;

			return $video_url;
		}

		/**
		 * Retrieve thumbnail from Vimeo
		 *
		 * @access public
		 * @param int $post_id
		 * @return string
		 */
		public function get_vimeo_thumbnail( $post_id ) {

			//'#http://player\.vimeo\.com/video/([0-9]+)#'
			//#(?:http://)?(?:www\.)?vimeo\.com/([A-Za-z0-9\-_]+)#

			$url = $this->get_video_url( $post_id );
			$vimeo_thumbnail = null;

			if ( $url ) {

				if ( preg_match( '#player\.vimeo\.com/video/([0-9]+)#', $url, $match ) ) {
					$url = str_replace( 'player.vimeo.com/video', 'vimeo.com', $url );
				}

				if (
					preg_match( '#vimeo\.com/([A-Za-z0-9\-_]+)#', $url, $match )

				) {
					if ( $match && isset( $match[1] ) ) {
						$vimeo_thumbnail = $this->get_vimeo_info( $match[1], $info = 'thumbnail_large' );

					}
				}
			}

			return $vimeo_thumbnail;
		}

		/**
		 * Retrieve thumbnail from Youtube
		 *
		 * @access public
		 * @param int $post_id
		 * @return string
		 */
		public function get_youtube_thumbnail( $post_id ) {

			$url = $this->get_video_url( $post_id );
			$youtube_thumbnail = null;

			if ( $url ) {

				if (
					preg_match( '#youtube(?:\-nocookie)?\.com/watch\?v=([A-Za-z0-9\-_]+)#', $url, $match )
					|| preg_match( '#youtube(?:\-nocookie)?\.com/v/([A-Za-z0-9\-_]+)#', $url, $match )
					|| preg_match( '#youtube(?:\-nocookie)?\.com/embed/([A-Za-z0-9\-_]+)#', $url, $match )
					|| preg_match( '#youtu.be/([A-Za-z0-9\-_]+)#', $url, $match )
				) {

					if ( $match && isset( $match[1] ) ) {

						$youtube_id = $match[1];
						$youtube_thumbnail = 'http://img.youtube.com/vi/' . $youtube_id . '/0.jpg';

						$image_qualities = array( 'maxresdefault', 'sddefault', '0' );

						// Get the best quality available
						foreach ( $image_qualities  as $image_quality ) {
							if ( @getimagesize( ( 'http://i.ytimg.com/vi/'. $youtube_id. '/'.$image_quality.'.jpg' ) ) ) {
								$youtube_thumbnail = "http://i.ytimg.com/vi/$youtube_id/$image_quality.jpg";
								update_post_meta( $post_id, '_video_thumbnail_quality', $image_quality );
								return $youtube_thumbnail;
								break; //exiting
							}
						}
					}
				}
			}

			return $youtube_thumbnail;
		}

		/**
		 * Get video thumbnail from vimeo or youtube
		 *
		 * @access public
		 * @param int $post_id
		 * @return string
		 */
		public function get_video_thumbnail( $post_id ) {

			$thumbnail = null;

			// if vimeo
			if ( $this->get_vimeo_thumbnail( $post_id ) ) {

				$thumbnail = $this->get_vimeo_thumbnail( $post_id );

			} elseif ( $this->get_youtube_thumbnail( $post_id ) ) {

				$thumbnail = $this->get_youtube_thumbnail( $post_id );
			}
			return $thumbnail;
		}

		/**
		 * Set the video thumbnail as featured image
		 *
		 * @access public
		 * @param int $post_id
		 * @return string
		 */
		public function set_video_thumbnail( $post_id = null ) {

			$new_thumbnail = null;
			$thumbnail_url = null;
			$attachment_id = null;

			// Get the post ID if none is provided
			if ( ! $post_id ) $post_id = get_the_ID();

			// check if the thumbnail has already been generated and saved in a post meta
			$meta = get_post_meta( $post_id, '_video_thumbnail', true );

			// get video thumbnail
			$new_thumbnail = $this->get_video_thumbnail( $post_id );

			// if we got something from youtube or vimeo
			if ( $new_thumbnail ) {

				// check if this thumbnail has already been attached to the post using meta
				$args = array(
					'post_type' => 'attachment',
					'numberposts' => null,
					'post_status' => null,
					'post_parent' => $post_id,
				);
				$attachments = get_posts( $args );

				if ( $attachments ) {

					foreach ( $attachments as $attachment ) {

						if ( get_post_meta( $attachment->ID, '_video_thumbnail_url', true ) == $new_thumbnail ) {
							$attachment_id = $attachment->ID;
							break;
						}
					}
				}

				// check if the retrieven thumbnail is different from the one saved in the post meta
				if ( $meta != $new_thumbnail ) {

					// Add hidden custom field with thumbnail origin URL
					update_post_meta( $post_id, '_video_thumbnail', $new_thumbnail );

					//  if not already attached, we upload it in the library
					if ( ! $attachment_id ) {

						// upload the image and attach it to the post
						$file = media_sideload_image( $new_thumbnail , $post_id );

						if ( $file && preg_match( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/', $file , $match ) ) {

							if ( isset( $match[1] ) ) {

								$attachment_url = $match[1];
								$attachment_id  = $this->get_attachment_id_from_url( $post_id, $attachment_url );
							}
						}
					}

					// make sure we got an attachment generated
					if ( $attachment_id ) {

						// set origin URL post meta to the attachment to avoid to generate the image twice
						update_post_meta( $attachment_id, '_video_thumbnail_url', $new_thumbnail );

						// set featured image
						update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
					}


				// if the retrieven thumbnail is already saved as post meta
				} elseif ( $meta == $new_thumbnail ) {

					$new_thumbnail = $meta;
					if ( $attachment_id && ! get_post_meta( $post_id, '_thumbnail_id', $attachment_id, true ) ) {
						update_post_meta( $post_id, '_thumbnail_id', $attachment_id );
					}
				}
			} // endif new_thumbnail

			return $new_thumbnail;

		}

		/**
		 * Returns attachment id from attachment URL
		 *
		 * @access public
		 * @param int $post_id
		 * @param string $attachment_url
		 * @return int
		 */
		public function get_attachment_id_from_url( $post_id = null, $attachment_url = null ) {

			if ( $post_id && $attachment_url ) {

				global $wpdb;
				$post_table = $wpdb->prefix.'posts';
				$query = $wpdb->prepare( "SELECT $post_table.ID FROM $post_table WHERE $post_table.guid= %s;", $attachment_url );
				$attachment = $wpdb->get_col( $query );
				return $attachment[0];
			}
		}

		/**
		 * Add video thumbnail metabox
		 *
		 * @access public
		 * @return void
		 */
		public function add_metabox() {

			$post_types = $this->get_post_types();

			if ( is_array( $post_types ) ) {

				foreach ( $post_types as $type ) {
					add_meta_box(
						'video_thumbnail',
						'Video Thumbnail',
						array( $this, 'render_metabox' ),
						$type,
						'side',
						'low'
					);
				}
			}
		}

		/**
		 * Render metabox
		 *
		 * @access public
		 * @return void
		 */
		public function render_metabox() {

			global $post;

			$post_id = $post->ID;

			$custom = get_post_custom( $post_id );

			if ( isset( $custom['_video_thumbnail'][0] ) ) {

				$video_thumbnail = $custom['_video_thumbnail'][0];

			} else {
				$video_thumbnail = '';
			}

			if ( isset( $video_thumbnail ) && $video_thumbnail != '' ) {

				echo "<p id='video-thumbnail-preview'><img src='$video_thumbnail' style='max-width:100%;' /></p>";

			}

			if ( get_post_status() == 'publish' || get_post_status() == 'private' ) {

				if ( isset( $video_thumbnail ) && $video_thumbnail != '' ) {

					echo '<p id="video-thumbnail-action">';
					echo '<a href="#" id="video-thumbnail-reset" onClick="video_thumbnail_reset(\'' . $post_id . '\' );return false;">' . $this->get_text( 'reset' ) . '</a>';
					echo '<a href="#" id="video-thumbnail-delete" style="display:inline-block; border-left:1px dotted #ccc; margin-left:5px;padding-left:6px" onClick="video_thumbnail_delete(\'' . $post_id . '\' );return false;">' . $this->get_text( 'delete' ) . '</a>';
					echo '</p>';

				} elseif ( $this->get_video_url( $post_id ) ) {

					echo '<p id="video-thumbnail-preview">';
					echo sanitize_text_field( $this->get_text( 'has_video' ) );
					echo '</p>';

					echo '<p id="video-thumbnail-action">';
					echo '<a href="#" id="video-thumbnail-reset" onClick="video_thumbnail_reset(\'' . $post_id . '\' );return false;">' . $this->get_text( 'generate' ) . '</a>';
					echo '</a></p>';

				} else {
					echo sanitize_text_field( $this->get_text( 'no_video' ) );
				}
			} else {
				if ( isset( $video_thumbnail ) && $video_thumbnail != '' ) {

					echo '<p id="video-thumbnail-action">';
					echo '<a href="#" id="video-thumbnail-reset" onClick="video_thumbnail_reset(\'' . $post_id . '\' );return false;">' . __( 'Reset', 'wolf' ) . '</a>';
					echo '<a href="#" id="video-thumbnail-delete" style="display:inline-block; border-left:1px dotted #ccc; margin-left:5px;padding-left:6px" onClick="video_thumbnail_delete(\'' . $post_id . '\' );return false;">' . __( 'Delete', 'wolf' ) . '</a>';
					echo '</p>';

				} else {
					echo '<p>';

					echo sanitize_text_field( $this->get_text( 'not_published' ) );

					echo '</p>';
				}
			}
		}

		/**
		 * Add script functions in admin head
		 *
		 * @access public
		 * @return string
		 */
		public function video_thumbnail_script() {
			$ajax_nonce = wp_create_nonce( 'wolf-video-thumbnail' );
			?>
			<!-- Video Thumbnails Researching Ajax -->
			<script type="text/javascript">
			function video_thumbnail_reset( id ) {

				var removeFeaturedImg = '<p id="video-custom-remove" class="hide-if-no-js"><a href="#" id="remove-post-thumbnail" onclick="wolf_thumbnail_delete( ' + id + ' );return false;"><?php _e( 'Remove featured image', 'wolf' ); ?></a></p>';
					var resetText = '<?php echo sanitize_text_field( $this->get_text( 'reset' ) ); ?>';
					var deleteText = '<?php echo sanitize_text_field( $this->get_text( 'delete' ) ); ?>';
					var deleteLink = "<a href='#' id='video-thumbnail-delete' style='display:inline-block; border-left:1px dotted #ccc; margin-left:5px;padding-left:6px' onClick='video_thumbnail_delete( " + id + " );return false;'>" + deleteText + "</a>";

				var data = {
					action: 'video_thumbnail',
					security: '<?php echo sanitize_text_field( $ajax_nonce ); ?>',
					post_id: id
				};

				document.getElementById( 'video-thumbnail-preview' ).innerHTML= '<?php _e( 'Working...', 'wolf' ); ?>... <img src="<?php echo admin_url( 'images/loading.gif' ); ?>"/>';

				// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
				jQuery.post( ajaxurl, data, function( response ) {

					document.getElementById( 'video-thumbnail-preview' ).innerHTML= response;

					jQuery( '#postimagediv .inside #set-post-thumbnail' ).empty().html( response );
					jQuery( '#remove-post-thumbnail' ).remove();
					jQuery( '#video-thumbnail-delete' ).remove();

					jQuery( '#postimagediv .inside' ).append( removeFeaturedImg );
					jQuery( '#video-thumbnail-action' ).append( deleteLink );
					jQuery( '#video-thumbnail-reset' ).empty().append( resetText );
				} );
			}

			function video_thumbnail_delete( id ) {

				var message = '<?php echo sanitize_text_field( $this->get_text( 'has_video' ) ); ?>';
				var generateText = '<?php echo sanitize_text_field( $this->get_text( 'generate' ) ); ?>';
				var deleteLink = "<a href='#' id='video-thumbnail-reset' onClick='video_thumbnail_reset( " + id + " );return false;'>" + generateText + "</a>";
				var data = {
					action: 'video_thumbnail_delete',
					security: '<?php echo sanitize_text_field( $ajax_nonce ); ?>',
					post_id: id
				};

				jQuery.post( ajaxurl, data, function( response ) {
					// video-thumbnail-delete
					jQuery( '#video-thumbnail-delete' ).remove();
					jQuery( '#video-thumbnail-preview' ).empty().append( message );
					jQuery( '#video-thumbnail-action' ).empty().append( deleteLink );

				} );
			}

			function wolf_thumbnail_delete( id ) {

				var data = {
					action: 'wolf_thumbnail_delete',
					security: '<?php echo sanitize_text_field( $ajax_nonce ); ?>',
					post_id: id
				};

				jQuery.post( ajaxurl, data, function( response ) {
					jQuery( '#postimagediv .inside #set-post-thumbnail' ).empty().html( '<?php _e( 'Set featured image', 'wolf' ); ?>' );
					jQuery( '#remove-post-thumbnail' ).remove();
				} );
			}
			</script>
			<?php
		}

		/**
		 * Delete thumbnail (AJAX)
		 *
		 * @access public
		 * @return void
		 */
		public function video_thumbnail_delete_callback() {

			check_ajax_referer( 'wolf-video-thumbnail', 'security' );
			$post_id = $_POST['post_id'];
			delete_post_meta( $post_id, '_video_thumbnail' );
			exit();
		}

		/**
		 * Delete featured image (AJAX)
		 *
		 * @access public
		 * @return void
		 */
		public function thumbnail_delete_callback() {

			check_ajax_referer( 'wolf-video-thumbnail', 'security' );
			$post_id = $_POST['post_id'];
			delete_post_meta( $post_id, '_thumbnail_id' );
			exit();
		}

		/**
		 * Set thumbnail (AJAX)
		 *
		 * @access public
		 * @return void
		 */
		public function video_thumbnail_callback() {

			check_ajax_referer( 'wolf-video-thumbnail', 'security' );
			$post_id = $_POST['post_id'];
			$video_thumbnail = $this->set_video_thumbnail( $post_id );

			if ( is_wp_error( $video_thumbnail ) ) {

				echo sanitize_text_field( $video_thumbnail->get_error_message() );

			} else  if ( $video_thumbnail != null ) {

				echo '<img src="' . esc_url( $video_thumbnail ) . '" style="max-width:100%;" />';

			} else {
				echo sanitize_text_field( $this->get_text( 'has_video' ) );
			}

			exit();
		}

		/**
		 * Return translatable string
		 *
		 * @access public
		 * @param string $string
		 * @return array
		 */
		public function get_text( $string ) {

			// Translatable string
			$text = array(
				'no_video' => __( 'No video URL in the post.', 'wolf' ),
				'has_video' => __( 'A video has been attached to this post. Click on "Generate" to create a thumbnail from this video', 'wolf' ),
				'not_published' => __( 'You will be able to generate a video thumbnail and use it as featured image for this post when it is published.', 'wolf' ),
				'generate' => __( 'Generate', 'wolf' ),
				'reset' => __( 'Reset', 'wolf' ),
				'delete' => __( 'Delete', 'wolf' ),
			);

			return $text[$string];
		}

	} // end class

	$wolf_work_do_video_thumbnails = new Wolf_Video_Thumbnail;
} // end class check