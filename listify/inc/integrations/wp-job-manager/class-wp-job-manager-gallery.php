<?php

class Listify_WP_Job_Manager_Gallery {

	public static $slug;

	public static $post_id;

	public function __construct() {
		self::$slug = _x( 'gallery', 'gallery endpoint slug', 'listify' );

		/** Frontend */
		add_action( 'init', array( $this, 'add_rewrite_endpoints' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_localize_scripts' ), 12 );
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
		add_action( 'template_redirect', array( $this, 'upload_images' ) );

		add_filter( 'attachment_link', array( $this, 'attachment_link' ), 10, 2 );
		add_filter( 'comment_post_redirect', array( $this, 'comment_redirect' ), 10, 2 );

		add_action( 'listify_single_job_listing_actions_start', array( $this, 'add_link' ) );
		
		/** Admin */
		add_action( 'admin_menu', array( $this, 'add_meta_box' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_styles' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	public function can_upload_to_listing() {
		$can = true;

		if ( ! is_user_logged_in() ) {
			$can = false;
		}

		return apply_filters( 'listify_can_upload_to_listing', $can );
	}

	public function add_rewrite_endpoints() {
		add_rewrite_endpoint( self::$slug, EP_PERMALINK | EP_PAGES );
	}

	public static function url( $post_id = null ) {
		if ( $post_id ) {
			$base = get_permalink( $post_id );
		} elseif ( isset( self::$post_id ) ) {
			$base = get_permalink( self::$post_id );
		}

		if ( get_option( 'permalink_structure' ) ) {
			$url = trailingslashit( $base ) . trailingslashit( self::$slug );
		} else {
			$url = add_query_arg( 'gallery', true, $base );
		}

		return esc_url( $url );
	}

	public function add_link() {
		if ( ! $this->can_upload_to_listing() ) {
			return;
		}
		
		global $post;

		if ( 'preview' == $post->post_status ) {
			return;
		}
	?>
		<a href="#add-photo" class="popup-trigger"><i class="ion-ios-camera"></i> <?php _e( 'Add Photos', 'listify' ); ?></a>
		<?php locate_template( array( 'popup-content-single-job_listing-add-photo.php' ), true ); ?>
	<?php
	}

	public function wp_localize_scripts() {
		wp_localize_script( 'listify', 'listifyListingGallery',
			$this->get_localization()
		);
	}

	public function template_redirect() {
		global $wp_query;

		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		if ( isset( $wp_query->query_vars[ self::$slug ] ) ) {
			locate_template( array( 'single-job_listing-gallery.php' ), true );

			exit;
		}
	}

	public function upload_images() {
		if ( ! isset( $_POST[ 'listify_action' ] ) ) {
			return;
		}

		if ( 'listify_add_to_gallery' != $_POST[ 'listify_action' ] ) {
			return;
		}

		if ( ! is_singular( 'job_listing' ) ) {
			return;
		}

		$post_id = absint( $_POST[ 'post_id' ] );
		$current = (array) self::get( $post_id );
		$files   = (array) $this->upload_files( $post_id );

		if ( is_array( $files ) && ! empty( $files ) ) {
			$gallery = (array) array_unique( array_merge( array_values( (array) $files[ 'ids' ] ), array_values( $current ) ) );
			$string = implode( ',', $gallery );

			$shortcode = '[gallery ids=' . $string . ']';

			update_post_meta( $post_id, '_gallery_images', $files[ 'urls' ] );

			self::set( $post_id, $shortcode );
		} else {
			wc_add_notice( __( 'No valid files selected.', 'listify' ), 'error' );
		}

		wp_safe_redirect( esc_url( $_POST[ 'redirect' ] ) );
		exit();
	}

	private function upload_files( $post_id ) {
        /** WordPress Administration Image API */
        include_once( ABSPATH . 'wp-admin/includes/image.php' );
        include_once( ABSPATH . 'wp-admin/includes/media.php' );

		$allowed_mime_types = $this->get_allowed_mime_types();
		$output             = array();
		$files_to_upload    = job_manager_prepare_uploaded_files( $_FILES[ 'listify_gallery_images' ] );

		foreach ( $files_to_upload as $file_key => $file_to_upload ) {
			$uploaded_file = job_manager_upload_file( $file_to_upload, array( 
				'file_key' => $file_key, 
				'allowed_mime_types' => $allowed_mime_types 
			) );

			if ( ! is_wp_error( $uploaded_file ) ) {
				$output[ 'urls' ][] = $uploaded_file->url;
			}
		}

		$maybe_attach = array();

		if ( empty( $output[ 'urls' ] ) ) {
			return $output;
		}

		foreach ( $output[ 'urls' ] as $url ) {
            $maybe_attach[] = str_replace( array( WP_CONTENT_URL, site_url() ), array( WP_CONTENT_DIR, ABSPATH ), $url );
		}

		foreach ( $maybe_attach as $attachment_url ) {
			$attachment = array(
				'post_title'   => get_the_title( $post_id ),
				'post_content' => '',
				'post_status'  => 'inherit',
				'post_parent'  => $post_id,
				'guid'         => $attachment_url
			);

			if ( $info = wp_check_filetype( $attachment_url ) ) {
				$attachment['post_mime_type'] = $info['type'];
			}

			$attachment_id = wp_insert_attachment( $attachment, $attachment_url, $post_id );
			$output[ 'ids' ][] = $attachment_id;

			if ( ! is_wp_error( $attachment_id ) ) {
				wp_update_attachment_metadata( $attachment_id, wp_generate_attachment_metadata( $attachment_id, $attachment_url ) );
			}
		}

		return $output;
	}
	

	/**
	 * Limit gallery uploads to images.
	 *
	 * @since unknown
	 * @return array
	 */
	public function get_allowed_mime_types() {
		return apply_filters( 'listify_gallery_allowed_mime_types', array(
			'jpg' => 'image/jpeg',
			'gif' => 'image/gif',
			'png' => 'image/png'
		) );
	}

	/**
	 *
	 */
	public function attachment_link( $url, $id ) {
		global $wp_query;

		if ( ! is_singular( 'job_listing' ) || isset( $wp_query->query_vars[ self::$slug ] ) ) {
			return $url;
		}

		if ( ! did_action( 'listify_widget_job_listing_gallery_before' ) && ! did_action( 'listify_widget_job_listing_gallery_after' ) ) {
			return $url;
		}

		$gallery = self::get( get_queried_object_id() );
		$new = self::url() . '#' . $url;

		return $new;
	}

	public function comment_redirect( $url, $comment ) {
		$listing = get_post( $comment->comment_post_ID )->post_parent;

		if ( ! $listing || 'job_listing' != get_post_type( $listing ) ) {
			return $url;
		}

		$gallery = self::get( $listing );
		$url = self::url() . '#' . get_permalink( $comment->comment_post_ID );

		return $url;
	}

	public function admin_enqueue_styles () {
		global $pagenow, $post;

		if ( 
			! ( in_array( $pagenow, array( 'post-new.php', 'post.php' ) ) ) || 
			( isset( $_GET[ 'post_type' ] ) && 'job_listing' != $_GET[ 'post_type' ] ) ||
			'job_listing' != $post->post_type
		) {
			return;
		}

		wp_enqueue_script( 'timepicker', get_template_directory_uri() . '/inc/integrations/wp-job-manager/js/vendor/jquery.timepicker.min.js', array( 'jquery' ) );

		wp_enqueue_script( 'listify-wp-job-manager-gallery-admin', get_template_directory_uri() . '/inc/integrations/wp-job-manager/js/wp-job-manager-gallery-admin.js', array( 'jquery' ) );

		wp_localize_script( 'listify-wp-job-manager-gallery-admin', 'listifyListingGallery',
			$this->get_localization()
		);
	}

	public function add_meta_box() {
		$job_listings = get_post_type_object( 'job_listing' );

		add_meta_box( 'job_listing-gallery', sprintf( __( '%s Gallery', 'listify' ), $job_listings->labels->singular_name ), array( $this, 'meta_box_set_gallery' ), $job_listings->name, 'side' );
	}

	public function meta_box_set_gallery() {
		global $post;

		$gallery = self::get( $post->ID );

		if ( ! $gallery ) {
			$gallery = array();
		}

		$shortcode = '[gallery ids=' . implode( ',', $gallery ) . ']';
		$limit = 99999;
	?>

		<div class="listify-gallery-images-wrapper">
			<?php
				include( locate_template( array( 'content-single-job_listing-gallery-overview.php' ) ) );
			?>

			<input type="hidden" name="listify_gallery_images" id="listify_gallery_images" value="<?php echo $shortcode; ?>" />

		</div>

		<p class="listify-add-gallery-images hide-if-no-js" style="clear: left;">
			<a href="#" class="manage"><?php _e( 'Manage gallery images', 'listify' ); ?></a> &bull;
			<a href="#" class="remove"><?php _e( 'Clear gallery', 'listify' ); ?></a>
		</p>

	<?php
	}

	public function save_post( $post_id ) {
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

		$gallery = isset( $_POST[ 'listify_gallery_images' ] ) ? esc_attr( $_POST[ 'listify_gallery_images' ] ) : false;

		if ( ! $gallery ) {
			return;
		}

		self::set( $post->ID, $gallery );
	}

	public static function get( $post_id ) {
    	self::$post_id = $post_id;

		$post = get_post( self::$post_id );

		$gallery = $post->_gallery;

    	if ( ! $gallery ) {
      		return;
    	}

    	if ( is_string( $gallery ) ) { 
      		$gallery = self::parse_shortcode( $gallery );
    	}

    	foreach ( $gallery as $key => $item ) {
			if ( ! is_numeric( $item ) ) {
				unset( $gallery[ $key ] );
			}
		}

    	return $gallery;  
	}

	public static function set( $post_id, $gallery ) {
		$urls = array();
      	$gallery = self::parse_shortcode( $gallery );

		foreach ( $gallery as $key => $id ) {
			$image = wp_get_attachment_image_src( $id, 'fullsize' );

			$urls[] = $image[0];
		}

		update_post_meta( $post_id, '_gallery_images', $urls );
		update_post_meta( $post_id, '_gallery', $gallery );

		return;
	}

	private static function parse_shortcode( $shortcode ) {
		$pattern = get_shortcode_regex();
		preg_match( "/$pattern/s", $shortcode, $match );
		$atts = shortcode_parse_atts( $match[3] );

		if ( isset( $atts['ids'] ) ) {
			$shortcode = explode( ',', $atts['ids'] );
		} else {
			$shortcode = array();
		}

		return $shortcode;
	}

	private function get_localization() {
		return array(
			'canUpload'         => current_user_can( 'upload_files' ),
			'gallery_title' 	=> __( 'Add Images to Gallery', 'listify' ),
			'gallery_button' 	=> __( 'Add to gallery', 'listify' ),
			'delete_image'		=> __( 'Delete image', 'listify' ),
			'default_title' 	=> __( 'Upload', 'listify' ),
			'default_button' 	=> __( 'Select this', 'listify' ),
		);
	}

}
