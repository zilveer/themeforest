<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Listable
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function listable_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	global $post;

	$nav_locations = get_nav_menu_locations();
	if ( ! empty( $nav_locations['secondary'] ) ) {
		$wp_get_nav_menu_items = wp_get_nav_menu_items( $nav_locations['secondary'] );

		if ( has_nav_menu( 'secondary' ) && ! empty( $wp_get_nav_menu_items ) ) {
			$classes[] = 'has--secondary-menu';
		}
	}
	
	if ( ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'jobs' ) )
	     || is_search()
	     || is_tax( array( 'job_listing_category', 'job_listing_tag', 'job_listing_region' ) )
	) {
		$classes[] = 'page-listings';
	}

	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'job_dashboard' ) ) {
		$classes[] = 'page-job-dashboard';
	}

	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'my_bookmarks' ) ) {
		$classes[] = 'page-my-bookmarks';
	}


	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'woocommerce_my_account' ) ) {
		$classes[] = 'page-login';
	}

	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'submit_job_form' ) ) {
		$classes[] = 'page-add-listing';
	}

	if ( listable_using_facetwp() ) {
		$classes[] = 'is--using-facetwp';
	}

	if ( isset( $post->post_content ) && has_shortcode( $post->post_content, 'jobs_by_tag' ) ) {
		$classes[] = 'jobs-by-tags-page';
	}

	return $classes;
}

add_filter( 'body_class', 'listable_body_classes' );

function listable_login_body_class( $classes ) {
	if ( isset( $_REQUEST['modal_login'] ) && $_REQUEST['modal_login'] ) {
		$classes[] = 'page-login-modal';
	}

	return $classes;
}

add_filter( 'login_body_class', 'listable_login_body_class' );

function listable_add_front_page_link_to_customizer_settings() {
	global $wp_admin_bar;

	if ( is_page_template( 'page-templates/front_page.php' ) ) {
		$href = admin_url( 'customize.php' );
		//square brackets in a URL is a mtfker right now in WordPress
		$href = add_query_arg( urlencode( 'autofocus[section]' ), 'sidebar-widgets-front_page_sections', $href );
		$wp_admin_bar->add_node( array(
			'id'     => 'customizer_front_page_sections',
			'parent' => false,
			'title'  => '🔵 ' . esc_html__( 'Customize Front Page Sections', 'listable' ),
			'href'   => $href,
		) );
	}
}

add_action( 'wp_before_admin_bar_render', 'listable_add_front_page_link_to_customizer_settings' );

function listable_add_single_listing_link_to_customizer_settings() {
	global $wp_admin_bar;

	if ( is_singular( 'job_listing' ) ) {
		$href = admin_url( 'customize.php' );
		//square brackets in a URL is a mtfker right now in WordPress
		$href = add_query_arg( urlencode( 'autofocus[panel]' ), 'widgets', $href );
		$href = add_query_arg( 'url', urlencode( get_permalink() ), $href );
		$wp_admin_bar->add_node( array(
			'id'     => 'customizer_front_page_sections',
			'parent' => false,
			'title'  => '🔶 ' . esc_html__( 'Customize Listings Layout', 'listable' ),
			'href'   => $href,
		) );
	}
}

add_action( 'wp_before_admin_bar_render', 'listable_add_single_listing_link_to_customizer_settings' );

function listable_force_display_the_excerpt_box( $hidden ) {
	//this filter is fired from get_hidden_meta_boxes()
	//make sure that 'postexcerpt' is not in the default hidden boxes
	$hidden = array_diff( $hidden, array( 'postexcerpt' ) );

	return $hidden;
}

add_filter( 'default_hidden_meta_boxes', 'listable_force_display_the_excerpt_box' );

/**
 * Custom callback function for the page excerpt meta box - it changes the strings in the form
 *
 * @param $post
 */
if ( ! function_exists('listable_post_excerpt_meta_box' ) ) {
	function listable_post_excerpt_meta_box( $post ) { ?>
		<label class="screen-reader-text" for="excerpt"><?php esc_html_e( 'Page Subtitle', 'listable' ) ?></label>
		<textarea rows="1" cols="40" name="excerpt" id="excerpt"><?php echo $post->post_excerpt; // textarea_escaped ?></textarea>
		<p><?php esc_html_e( 'This is the subtitle that will be shown in the page\'s Hero Area, below the page title.', 'listable' ); ?></p>
		<?php
	}
}

function listable_change_page_excerpt_box_title() {
	global $wp_meta_boxes; // array of defined meta boxes

	//Change the page excerpt meta box title
	$wp_meta_boxes['page']['normal']['core']['postexcerpt']['title'] = esc_html__( 'Page Subtitle', 'listable' );
	//and it's callback
	$wp_meta_boxes['page']['normal']['core']['postexcerpt']['callback'] = 'listable_post_excerpt_meta_box';
}

add_action( 'add_meta_boxes', 'listable_change_page_excerpt_box_title' );

/**
 * Taxonomy Icons functions
 */

function listable_get_term_icon_id( $term_id = null, $taxonomy = null ) {

	if ( function_exists( 'get_term_meta' ) ) {

		if ( null === $term_id ) {
			global $wp_query;
			$term    = $wp_query->queried_object;
			$term_id = $term->term_id;

		}

		return get_term_meta( $term_id, 'pix_term_icon', true );
	}

	return false;
}

function listable_get_term_icon_url( $term_id = null, $size = 'thumbnail' ) {

	$attachment_id = listable_get_term_icon_id( $term_id );

	if ( ! empty( $attachment_id ) ) {
		$attach_args = wp_get_attachment_image_src( $attachment_id, $size );

		// $attach_args[0] should be the url
		if ( isset( $attach_args[0] ) ) {
			return $attach_args[0];
		}
	}

	return false;
}

function listable_get_term_image_id( $term_id = null, $taxonomy = null ) {

	if ( function_exists( 'get_term_meta' ) ) {

		if ( null === $term_id ) {
			global $wp_query;
			$term    = $wp_query->queried_object;
			$term_id = $term->term_id;

		}

		return get_term_meta( $term_id, 'pix_term_image', true );
	}

	return false;
}

function listable_get_term_image_url( $term_id = null, $size = 'thumbnail' ) {

	$attachment_id = listable_get_term_image_id( $term_id );

	if ( ! empty( $attachment_id ) ) {
		$attach_args = wp_get_attachment_image_src( $attachment_id, $size );

		// $attach_args[0] should be the url
		if ( isset( $attach_args[0] ) ) {
			return $attach_args[0];
		}
	}

	return false;
}

/**
 * Display an image from the given url
 * We use this function when the url may contain a svg file
 *
 * @param $url
 * @param string $class A CSS class
 * @param bool|true $wrap_as_img If the function should wrap the url in an image tag or not
 */
function listable_display_image( $url, $class = '', $wrap_as_img = true, $attachment_id = null ) {
	if ( ! empty( $url ) && is_string( $url ) ) {

		//we try to inline svgs
		if ( substr( $url, - 4 ) === '.svg' ) {

			//first let's see if we have an attachment and inline it in the safest way - with readfile
			//include is a little dangerous because if one has short_open_tags active, the svg header that starts with <? will be seen as PHP code
			if ( ! empty( $attachment_id ) && false !== @readfile( get_attached_file( $attachment_id ) ) ) {
				//all good
			} elseif ( false !== ( $svg_code = get_transient( md5( $url ) ) ) ) {
				//now try to get the svg code from cache
				echo $svg_code;
			} else {

				//if not let's get the file contents using WP_Filesystem
				require_once( ABSPATH . 'wp-admin/includes/file.php' );

				WP_Filesystem();

				global $wp_filesystem;

				$svg_code = $wp_filesystem->get_contents( $url );

				if ( ! empty( $svg_code ) ) {
					set_transient( md5( $url ), $svg_code, 12 * HOUR_IN_SECONDS );

					echo $svg_code;
				}
			}

		} elseif ( $wrap_as_img ) {

			if ( ! empty( $class ) ) {
				$class = ' class="' . $class . '"';
			}

			echo '<img src="' . $url . '"' . $class . '/>';

		} else {
			echo $url;
		}
	}
}


/**
 * Return the gallery of images attached to the listing
 *
 * @param null $listing_ID
 *
 * @return array|bool
 */
function listable_get_listing_gallery_ids( $listing_ID = null ) {

	if ( empty( $listing_ID ) ) {
		$listing_ID = get_the_ID();
	}

	//bail if we have no valid listing ID
	if ( empty( $listing_ID ) ) {
		return false;
	}

	$gallery_string = trim( get_post_meta( $listing_ID, 'main_image', true ) );
	//no spaces are allowed
	$gallery_string = str_replace( ' ', '', $gallery_string );
	//a little bit of sanity cleanup because sometimes (mainly during preview) an empty entry can be added at the end
	if ( ',' === substr( $gallery_string, - 1, 1 ) ) {
		$gallery_string = substr( $gallery_string, 0, - 1 );
	}

	if ( ! empty( $gallery_string ) ) {
		$gallery_ids = explode( ',', $gallery_string );

		//now ensure that each entry is a valid ID (positive int)
		$filter_options = array(
			'options' => array( 'min_range' => 1 )
		);
		foreach ( $gallery_ids as $key => $value ) {
			if ( false === filter_var( $value, FILTER_VALIDATE_INT, $filter_options ) ) {
				unset( $gallery_ids[ $key ] );
			}
		}

		//normalize the array, just in case we've deleted something
		$gallery_ids = array_values( $gallery_ids );
	}

	if ( ! empty( $gallery_ids ) ) {
		return $gallery_ids;
	}

	return false;
}

/**
 * Return the ID of the first image found in the post meta (featured image). In case of listings first we will look into the gallery (main_image) and then for the featured image
 *
 * @param null $post_ID
 *
 * @return array|bool|string
 */

if ( ! function_exists( 'listable_get_post_image_id' ) ) {
	function listable_get_post_image_id( $post_ID = null ) {

		if ( empty( $post_ID ) ) {
			$post_ID = get_the_ID();
		}

		//get the presentation gallery if present
		$gallery_ids = listable_get_listing_gallery_ids( $post_ID );

		//now lets get the image (either from the presentation gallery or the featured image
		// if there are second images, use them
		if ( ! empty( $gallery_ids ) ) {
			return $gallery_ids[0];
		} else {
			// fallback to featured image
			return esc_sql( get_post_thumbnail_id( $post_ID ) );
		}

		return false;
	}
}

/**
 * Return the src of the post image. In the case of listings we will try and get the first image of the gallery first, then the featured image.
 *
 * @param null $post_id
 * @param string $size
 *
 * @return bool
 */
if ( ! function_exists( 'listable_get_post_image_src' ) ) {
	function listable_get_post_image_src( $post_id = null, $size = 'thumbnail' ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$attach_id = listable_get_post_image_id( $post_id );

		if ( empty( $attach_id ) || is_wp_error( $attach_id ) ) {
			return false;
		}

		$data = wp_get_attachment_image_src( $attach_id, $size );
		// if this attachment has an url for this size, return it
		if ( isset( $data[0] ) && ! empty ( $data ) ) {
			return listable_get_inline_background_image( $data[0] );
		}

		return false;
	}
}

/**
 * Given an URL we will try to find and return the ID of the attachment, if present
 *
 * @param string $attachment_url
 *
 * @return bool|null|string
 */
function listable_get_attachment_id_from_url( $attachment_url = '' ) {

	global $wpdb;
	$attachment_id = false;

	// If there is no url, bail.
	if ( '' == $attachment_url ) {
		return false;
	}

	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();

	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {

		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );

		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );

		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );

	}

	return $attachment_id;
}

function listable_callback_gtkywb() {
	$themedata = wp_get_theme( 'listable' );

	$protocol = 'http';

	if ( is_ssl() ) {
		$protocol = 'https';
	}

	$domain = '';

	if ( isset( $_SERVER['HTTP_HOST'] ) ) {
		$domain = $_SERVER['HTTP_HOST'];
	}

	$response = wp_remote_post( $protocol . '://pixelgrade.com/stats', array(
		'method' => 'POST',
		'body'   => array(
			'send_stats'    => true,
			'theme_name'    => 'listable',
			'theme_version' => $themedata->get( 'Version' ),
			'domain'        => $domain,
			'permalink'     => get_permalink( 1 ),
			'is_child'      => is_child_theme(),
		)
	) );
}

add_action( 'after_switch_theme', 'listable_callback_gtkywb' );

function listable_get_login_url() {
	$url = false;

//	$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
//	if ( $myaccount_page_id ) {
//		$url = get_permalink( $myaccount_page_id ) . '#entry-content-anchor';
//	} else {
	$url = esc_url( wp_login_url( get_permalink() ) ) . '&modal_login=true#login';

//	}
	return $url;
}

function listable_get_login_link_class( $class = '') {
	if ( listable_using_lwa() ) {
		if ( ! is_user_logged_in() ) {
			$class .= ' lwa-links-modal';
		}
		$class .= ' lwa-login-link';
	} else {
		$class .= ' iframe-login-link';
	}

	return $class;
}

function listabe_add_login_modal_class_checker() { ?>
	<script>
		document.addEventListener( "DOMContentLoaded", function( event ) {

			function getCookie( cname ) {
				var name = cname + "=";
				var ca = document.cookie.split( ';' );
				for ( var i = 0; i < ca.length; i++ ) {
					var c = ca[i];
					while ( c.charAt( 0 ) == ' ' ) c = c.substring( 1 );
					if ( c.indexOf( name ) == 0 ) return c.substring( name.length, c.length );
				}
				return "";
			}

			// whenever the login page modal is loading we should check if we need a body class
			var the_cookie = getCookie( 'listable_login_modal' );
			if ( typeof the_cookie !== "undefined" && 'opened' === the_cookie ) {

				var body_tag = document.getElementsByTagName( "body" ),
					has_modal_class = body_tag[0].className.indexOf( 'page-login-modal' );

				if ( has_modal_class === -1 ) { // there is no login modal class so we add one
					body_tag[0].className = body_tag[0].className + ' page-login-modal';
				}
			}
		} );
	</script>
	<?php
}

add_action( 'login_footer', 'listabe_add_login_modal_class_checker' );

if ( isset( $_COOKIE['listable_login_modal'] ) ) {
	remove_filter( 'lostpassword_url', 'wc_lostpassword_url', 10 );
}

function listable_is_edit_page( $new_edit = null ) {
	global $pagenow;
	//make sure we are on the backend
	if ( ! is_admin() ) {
		return false;
	}

	if ( $new_edit == "edit" ) {
		return in_array( $pagenow, array( 'post.php', ) );
	} elseif ( $new_edit == "new" ) { //check for new post page
		return in_array( $pagenow, array( 'post-new.php' ) );
	} else { //check for either new or edit
		return in_array( $pagenow, array( 'post.php', 'post-new.php' ) );
	}
}

function listable_is_nav_menus_page( $new_edit = null ) {
	global $pagenow;
	//make sure we are on the backend
	if ( ! is_admin() ) {
		return false;
	}

	if( 'nav-menus.php' == $pagenow ) {
		return true;
	}

	return false;
}

function listable_sort_array_by_priority( $a, $b ) {
	if ( $a['priority'] == $b['priority'] ) {
		return 0;
	}

	return ( $a['priority'] < $b['priority'] ) ? - 1 : 1;
}

function listable_add_comments_placeholders( $args ) {
	$args['fields']['author'] = str_replace( 'name="author"', 'placeholder="' . esc_attr__( 'Your name', 'listable' ) . '" name="author"', $args['fields']['author'] );
	$args['fields']['email']  = str_replace( 'name="email"', 'placeholder="' . esc_attr__( 'your@email.com', 'listable' ) . '" name="email"', $args['fields']['email'] );

	return $args;
}

add_action( 'comment_form_defaults', 'listable_add_comments_placeholders' );

function listable_search_template_chooser( $template ) {
	global $wp_query;
	$post_type = get_query_var( 'post_type' );
	if ( $wp_query->is_search && $post_type == 'job_listing' ) {
		return locate_template( 'search-job_listing.php' );  //  redirect to archive-search.php
	}

	return $template;
}

add_filter( 'template_include', 'listable_search_template_chooser' );

function listable_get_random_hero_object( $post_id = null ) {

	if ( $post_id === null ) {
		global $post;
		$post_id = $post->ID;
	}

	$image_backgrounds  = get_post_meta( $post_id, 'image_backgrounds', true );
	$videos_backgrounds = get_post_meta( $post_id, 'videos_backgrounds', true );

	if ( ! empty( $image_backgrounds ) ) {
		$image_backgrounds = explode( ',', $image_backgrounds );
	} else {
		$image_backgrounds = array();
	}

	if ( ! empty( $videos_backgrounds ) ) {
		$videos_backgrounds = explode( ',', $videos_backgrounds );
	} else {
		$videos_backgrounds = array();
	}

	$all_backgrounds = array_merge( $image_backgrounds, $videos_backgrounds );

	if ( ! empty( $all_backgrounds ) ) {
		$random = array_rand( $all_backgrounds, 1 );

		return get_post( $all_backgrounds[ $random ] );
	}
}

/**
 * Check if there is a photon version of the required image
 * @param $url
 *
 * @return mixed|void
 */
function listable_get_inline_background_image( $url ) {
	if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'photon' ) && function_exists( 'jetpack_photon_url' ) ) {
		return apply_filters( 'jetpack_photon_url', $url );
	}
	return $url;
}

/**
 * This filter will ensure that after an users logs in from the iframe modal doesn't get stuck in it.
 *
 * @param $user_login
 * @param $user
 */
function listable_reload_page_after_modal_reload( $user_login, $user ) {

	if ( ! is_user_logged_in() && isset( $_COOKIE['listable_login_modal'] ) && $_COOKIE['listable_login_modal'] === 'opened' ) {

		if ( isset( $_POST['redirect_to'] ) ) {
			echo '<script type="text/javascript">if ( typeof self.parent.wp !== "undefined" ) { self.parent.location.replace("' . $_POST['redirect_to'] . '"); } </script>';
		} else {
			echo '<script type="text/javascript">if ( typeof self.parent.wp !== "undefined" ) { self.parent.location.reload(true); } </script>';
		}

		unset( $_COOKIE['listable_login_modal'] );
		setcookie( 'listable_login_modal', null, - 1, '/' );
		exit;
	}
}

add_action( 'wp_login', 'listable_reload_page_after_modal_reload', 10, 2 );

/**
 * Add descriptions to menu items
 */
function listable_nav_description( $item_output, $item, $depth, $args ) {

	if ( 'search_suggestions' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;

}

add_filter( 'walker_nav_menu_start_el', 'listable_nav_description', 10, 4 );


function listable_is_password_protected() {
	global $post;
	$private_post = array( 'allowed' => false, 'error' => '' );

	if ( isset( $_POST['submit_password'] ) ) { // when we have a submision check the password and its submision
		if ( isset( $_POST['submit_password_nonce'] ) && wp_verify_nonce( $_POST['submit_password_nonce'], 'password_protection' ) ) {
			if ( isset ( $_POST['post_password'] ) && ! empty( $_POST['post_password'] ) ) { // some simple checks on password
				// finally test if the password submitted is correct
				if ( $post->post_password === $_POST['post_password'] ) {
					$private_post['allowed'] = true;

					// ok if we have a correct password we should inform wordpress too
					// otherwise the mad dog will put the password form again in the_content() and other filters
					global $wp_hasher;
					if ( empty( $wp_hasher ) ) {
						require_once( ABSPATH . 'wp-includes/class-phpass.php' );
						$wp_hasher = new PasswordHash( 8, true );
					}

					setcookie( 'wp-postpass_' . COOKIEHASH, $wp_hasher->HashPassword( stripslashes( $_POST['post_password'] ) ), 0, COOKIEPATH );

				} else {
					$private_post['error'] = esc_html__( 'Wrong Password', 'listable' );
				}
			}
		}
	}

	if ( isset( $_COOKIE[ 'wp-postpass_' . COOKIEHASH ] ) && get_permalink() == wp_get_referer() ) {
		$private_post['error'] = esc_html__( 'Wrong Password', 'listable' );
	}

	return $private_post;
}

function listable_permalink_settings_init() {
	// Add our settings
	add_settings_field(
		'listable_listing_slug',            // id
		esc_html__( '&#x1f4bc; Listing URL Base', 'listable' ),   // setting title
		'listable_listing_slug_input',  // display callback
		'permalink',                                    // settings page
		'optional'                                      // settings section
	);
	add_settings_field(
		'listable_listing_category_slug',            // id
		esc_html__( '&#x1f4bc; Listing Category Base', 'listable' ),   // setting title
		'listable_listing_category_slug_input',  // display callback
		'permalink',                                    // settings page
		'optional'                                      // settings section
	);
	add_settings_field(
		'listable_listing_tag_slug',                 // id
		esc_html__( '&#x1f4bc; Listing Tag Base', 'listable' ),        // setting title
		'listable_listing_tag_slug_input',       // display callback
		'permalink',                                    // settings page
		'optional'                                      // settings section
	);


	// now let's save these options
	if ( ! is_admin() ) {
		return;
	}

	// We need to save the options ourselves; settings api does not trigger save for the permalinks page
	if ( isset( $_POST['listable_listing_category_slug'] ) && isset( $_POST['listable_listing_tag_slug'] ) ) {
		// Cat and tag bases
		$listable_listings_slug = sanitize_text_field( $_POST['listable_listing_base_slug'] );
		$listable_category_slug = sanitize_text_field( $_POST['listable_listing_category_slug'] );
		$listable_tag_slug      = sanitize_text_field( $_POST['listable_listing_tag_slug'] );

		$permalinks = get_option( 'listable_permalinks_settings' );

		if ( ! $permalinks ) {
			$permalinks = array();
		}

		$permalinks['listing_base']  = untrailingslashit( $listable_listings_slug );
		$permalinks['category_base'] = untrailingslashit( $listable_category_slug );
		$permalinks['tag_base']      = untrailingslashit( $listable_tag_slug );

		update_option( 'listable_permalinks_settings', $permalinks );
	}
}

add_action( 'admin_init', 'listable_permalink_settings_init' );

function listable_listing_slug_input() {
	$permalinks = get_option( 'listable_permalinks_settings' ); ?>
	<input name="listable_listing_base_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['listing_base'] ) ) {
		echo esc_attr( $permalinks['listing_base'] );
	} ?>" placeholder="<?php echo esc_attr_x( 'listings', 'slug', 'listable' ) ?>"/>
	<?php
}

function listable_listing_category_slug_input() {
	$permalinks = get_option( 'listable_permalinks_settings' ); ?>
	<input name="listable_listing_category_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['category_base'] ) ) {
		echo esc_attr( $permalinks['category_base'] );
	} ?>" placeholder="<?php echo esc_attr_x( 'listing-category', 'slug', 'listable' ) ?>"/>
	<?php
}

function listable_listing_tag_slug_input() {
	$permalinks = get_option( 'listable_permalinks_settings' ); ?>
	<input name="listable_listing_tag_slug" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['tag_base'] ) ) {
		echo esc_attr( $permalinks['tag_base'] );
	} ?>" placeholder="<?php echo esc_attr_x( 'listing-tag', 'slug', 'listable' ) ?>"/>
	<?php
}

function listable_string_to_bool( $value ) {
	return ( is_bool( $value ) && $value ) || in_array( $value, array( '1', 'true', 'yes' ) ) ? true : false;
}

function listable_get_shortcode_param_value( $content, $shortcode, $param, $default ) {
	$param_value = $default;
	if ( has_shortcode( $content, $shortcode ) ) {
		$pattern = get_shortcode_regex( array( $shortcode ) );

		if ( preg_match_all( '/'. $pattern .'/s', $content, $matches ) ) {
			$keys = array();
			$result = array();
			foreach( $matches[0] as $key => $value) {
				// $matches[3] return the shortcode attribute as string
				// replace space with '&' for parse_str() function
				$get = str_replace(" ", "&" , $matches[3][$key] );
				parse_str($get, $output);

				//get all shortcode attribute keys
				$keys = array_unique( array_merge(  $keys, array_keys($output)) );
				$result[] = $output;

			}

			if ( ! empty( $result ) ) {
				$value = listable_preg_match_array_get_value_by_key( $result, $param );

				if ( null !== $value ) {
					//just in case someone has magic_quotes activated
					$param_value = stripslashes_deep( $value );
				}
			}
		}
	}

	return $param_value;
}

function listable_preg_match_array_get_value_by_key( $arrs, $searched ) {
	foreach ( $arrs as $arr ) {
		foreach ( $arr as $key => $value ) {
			if (  $key == $searched ) {
				return $value;
			}
		}
	}

	return null;
}

function listable_add_custom_menu_items() {
	global $pagenow;
	if( 'nav-menus.php' == $pagenow ) {
		add_meta_box( 'listable-add-user-menu-links', esc_html__( 'User Menu', 'listable' ), 'wp_nav_menu_item_listable_user_menu_links_meta_box', 'nav-menus', 'side', 'low' );
	}
}
add_action( 'admin_init', 'listable_add_custom_menu_items' );

function wp_nav_menu_item_listable_user_menu_links_meta_box( $object ) {
	global $nav_menu_selected_id;
	$menu_items = array(
		'#listablelogin' => array(
			'title' => esc_html__( 'Log In', 'listable' ),
			'label' => esc_html__( 'Log In', 'listable' ),
		),
		'#listablelogout' => array(
			'title' => esc_html__( 'Log Out', 'listable' ),
			'label' => esc_html__( 'Log Out', 'listable' ),
		),
		'#listablecurrentusername' => array(
			'title' => esc_html__( 'Welcome!', 'listable' ),
			'label' => esc_html__( 'Current Username', 'listable' ),
		),
	);
	$menu_items_obj = array();
	foreach ( $menu_items as $id => $item ) {
		$menu_items_obj[$id] = new stdClass;
		$menu_items_obj[$id]->ID			    = esc_attr( $id );
		$menu_items_obj[$id]->object_id			= esc_attr( $id );
		$menu_items_obj[$id]->title				= esc_attr( $item['title'] );
		$menu_items_obj[$id]->url				= esc_attr( $id );
		$menu_items_obj[$id]->description 		= 'description';
		$menu_items_obj[$id]->db_id 				= 0;
		$menu_items_obj[$id]->object 			= 'listable';
		$menu_items_obj[$id]->menu_item_parent 	= 0;
		$menu_items_obj[$id]->type 				= 'custom';
		$menu_items_obj[$id]->target 			= '';
		$menu_items_obj[$id]->attr_title 		= '';
		$menu_items_obj[$id]->label 		        = esc_attr( $item['label'] );
		$menu_items_obj[$id]->classes 			= array();
		$menu_items_obj[$id]->xfn 				= '';
	}
	$walker = new Walker_Nav_Menu_Checklist( array() );
	?>

	<div id="listable-user-menu-links" class="listablediv taxonomydiv">
		<div id="tabs-panel-listable-links-all" class="tabs-panel tabs-panel-view-all tabs-panel-active">

			<ul id="listable-user-menu-linkschecklist" class="list:listable-user-menu-links categorychecklist form-no-clear">
				<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $menu_items_obj ), 0, (object)array( 'walker' => $walker ) ); ?>
			</ul>

		</div>
		<p class="button-controls">
				<span class="add-to-menu">
					<input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu right" value="<?php esc_attr_e( 'Add to Menu', 'listable' ); ?>" name="add-listable-user-menu-links-menu-item" id="submit-listable-user-menu-links" />
					<span class="spinner"></span>
				</span>
		</p>
	</div><!-- .listablediv -->

	<?php
}

/*
 * Our User Menu should not be hidden by default
 */
function listable_user_menu_dropdown_not_hidden( $hidden ) {
	if ( is_array( $hidden ) ) {
		$key = array_search( 'listable-add-user-menu-links', $hidden );
		if ( false !== $key ) {
			unset( $hidden[ $key ] );
		}
	}

	return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'listable_user_menu_dropdown_not_hidden', 10, 1 );

/*
 * It runs on theme update or install to make sure that the User Menu dropdown is visible
 */
function listable_make_user_menu_links_visible_by_default() {
	//force it visible on theme update
	$user = wp_get_current_user();
	//get the current options
	$hidden_meta_boxes = get_user_option( 'metaboxhidden_nav-menus', $user->ID );

	//if it is false that means that the user has never modified the Screen Options
	//the default_hidden_meta_boxes filter will take care of that
	if ( false !== $hidden_meta_boxes && ! is_array( $hidden_meta_boxes ) )
		return;

	//make sure that our meta box is not included
	$hidden_meta_boxes = listable_user_menu_dropdown_not_hidden( $hidden_meta_boxes );

	//finally save it to the database
	update_user_option( $user->ID, 'metaboxhidden_nav-menus', $hidden_meta_boxes, true );
}
add_action( 'after_switch_theme', 'listable_make_user_menu_links_visible_by_default' );

function listable_setup_nav_menu_item( $item ) {
	global $pagenow, $wp_rewrite;

	if( 'nav-menus.php' != $pagenow && !defined('DOING_AJAX') && isset( $item->url ) && 'custom' == $item->type ) {
		// Set up listable current user menu links
		switch ( $item->url ) {
			case '#listablecurrentusername':
				//do nothing right now - will do through the walker
				break;

			default:
				break;
		}
		$_root_relative_current = untrailingslashit( $_SERVER['REQUEST_URI'] );
		$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_root_relative_current );
		$item_url = untrailingslashit( $item->url );
		$_indexless_current = untrailingslashit( preg_replace( '/' . preg_quote( $wp_rewrite->index, '/' ) . '$/', '', $current_url ) );
		// Highlight current menu item
		if ( $item_url && in_array( $item_url, array( $current_url, $_indexless_current, $_root_relative_current ) ) ) {
			$item->classes[] = 'current-menu-item current_page_item';
		}
	}
// it's pointless as WP will put the title in the label for AJAX calls no matter what (in the next step) - Ya I know...
//	if ( defined('DOING_AJAX') && isset( $item->url ) && 'custom' == $item->type ) {
//		if ( '#listablecurrentusername' == $item->url ) {
//			$item->label = esc_html__( 'Current Username', 'listable' );
//		}
//	}
	return $item;
}
add_filter( 'wp_setup_nav_menu_item', 'listable_setup_nav_menu_item' );


/**
 * Modify the output for our custom User Menu items
 */
class Listable_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Start the element output.
	 *
	 * @see Walker::start_el()
	 *
	 * @since 3.0.0
	 * @since 4.4.0 'nav_menu_item_args' filter was added.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		if ( isset( $item->url ) && 'custom' == $item->type ) {
			if ( '#listablecurrentusername' == $item->url ) {
				//add a special class just for it
				$classes[] = 'menu-item-current-username ';
				if ( ! is_user_logged_in() && listable_using_lwa() ) {
					$classes[] = 'lwa';
				}
			} elseif ( '#listablelogin' == $item->url  && listable_using_lwa() ) {
				$classes[] = 'lwa';
			}
		}

		/**
		 * Filter the arguments for a single nav menu item.
		 *
		 * @since 4.4.0
		 *
		 * @param array  $args  An array of arguments.
		 * @param object $item  Menu item data object.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$args = (object) apply_filters( 'nav_menu_item_args', $args, $item, $depth );

		/**
		 * Filter the CSS class(es) applied to a menu item's list item element.
		 *
		 * @since 3.0.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array  $classes The CSS classes that are applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		/**
		 * Filter the ID applied to a menu item's list item element.
		 *
		 * @since 3.0.1
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
		 * @param object $item    The current menu item.
		 * @param array  $args    An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth   Depth of menu item. Used for padding.
		 */
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		$output .= $indent . '<li' . $id . $class_names .'>';

		$atts = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
		$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
		$atts['href']   = ! empty( $item->url )        ? $item->url        : '';
		$atts['class']  =  ' ';

		/**
		 * Filter the HTML attributes applied to a menu item's anchor element.
		 *
		 * @since 3.6.0
		 * @since 4.1.0 The `$depth` parameter was added.
		 *
		 * @param array $atts {
		 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
		 *
		 *     @type string $title  Title attribute.
		 *     @type string $target Target attribute.
		 *     @type string $rel    The rel attribute.
		 *     @type string $href   The href attribute.
		 * }
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				//Custom URL for the Current Username menu item since right now it should be #listablecurrentusername
				if( isset( $item->url ) && 'custom' == $item->type ) {
					// Set up listable current user menu links
					switch ( $item->url ) {
						case '#listablecurrentusername':
							if ( 'href' === $attr ) {
								$username_url = '#';
								if ( ! is_user_logged_in() ) {
									$username_url = wp_login_url();
								} elseif ( get_option( 'woocommerce_myaccount_page_id' ) ) {
									$username_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
								}

								$value = $username_url;
							} elseif ( 'class' === $attr ) {
								if ( listable_using_lwa() ) {
									if ( ! is_user_logged_in() ) {
										$value .= ' lwa-links-modal';
									}
									$value .= ' lwa-login-link';
								} else {
									$value .= ' iframe-login-link';
								}
							}
							break;

						case '#listablelogin':
							if ( 'href' === $attr ) {
								$value = wp_login_url();
							} elseif ( 'class' === $attr ) {
								if ( listable_using_lwa() ) {
									if ( ! is_user_logged_in() ) {
										$value .= ' lwa-links-modal';
									}
									$value .= ' lwa-login-link';
								} else {
									$value .= ' iframe-login-link';
								}
							}

							break;

						case '#listablelogout':
							if ( 'href' === $attr ) {
								$value = wp_logout_url( home_url() );
							} elseif ( 'class' === $attr ) {
								$value .= ' logout-link';
							}
							break;

						default:
							break;
					}
				}

				$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		/** This filter is documented in wp-includes/post-template.php */
		$title = apply_filters( 'the_title', $item->title, $item->ID );

		/**
		 * Filter a menu item's title.
		 *
		 * @since 4.4.0
		 *
		 * @param string $title The menu item's title.
		 * @param object $item  The current menu item.
		 * @param array  $args  An array of {@see wp_nav_menu()} arguments.
		 * @param int    $depth Depth of menu item. Used for padding.
		 */
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$item_output = '';

		if ( isset( $args->before ) ) {
			$item_output = $args->before;
		}

		$item_output .= '<a'. $attributes .'>';

		//If this is a Current Username item
		if( isset( $item->url ) && 'custom' == $item->type  && '#listablecurrentusername' == $item->url ) {
			//Get the current user display name
			global $current_user;

			wp_get_current_user();

			$avatar_args = array(
				// get_avatar_data() args.
				'class'         => 'user-avatar',
			);
			$avatar = get_avatar( $current_user->ID , 32, '','', $avatar_args );
			$item_output .= $avatar;

			if ( ! empty( $current_user->display_name ) ) {
				$item_output .= '<span class="user-display-name">' . $current_user->display_name . '</span>';
			} else {
				$item_output .= '<span class="user-display-name">' . $item->title . '</span>';
			}

		} else {
			//do the regular WP thing
			$item_output .= $args->link_before . $title . $args->link_after;
		}

		$item_output .= '</a>';

		if ( isset( $args->after ) ) {
			$item_output .= $args->after;
		}

		/**
		 * Filter a menu item's starting output.
		 *
		 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
		 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
		 * no filter for modifying the opening and closing `<li>` for a menu item.
		 *
		 * @since 3.0.0
		 *
		 * @param string $item_output The menu item's starting HTML output.
		 * @param object $item        Menu item data object.
		 * @param int    $depth       Depth of menu item. Used for padding.
		 * @param array  $args        An array of {@see wp_nav_menu()} arguments.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

} //Listable_Walker_Nav_Menu

/**
 * Output an icon to be used in the Single Listing Map Widget
 */
function listable_output_single_listing_icon () {
	global $post;

	$the_term = null;

	// Try to get a category icon
	$cat_list = wp_get_post_terms(
		$post->ID,
		'job_listing_category',
		array( 'fields' => 'all' )
	);

	if ( ! empty( $cat_list ) && ! is_wp_error( $cat_list ) ) {
		foreach ( $cat_list as $term ) :
			if ( listable_get_term_icon_url( $term->term_id ) ) {
				$the_term = $term;
				break;
			}
		endforeach;
	}

	// Else try to get a tag icon
	if ( $the_term == null ) {
		$tag_list = wp_get_post_terms(
			$post->ID,
			'job_listing_tag',
			array( 'fields' => 'all' )
		);

		if ( ! empty( $tag_list ) && ! is_wp_error( $tag_list ) ) {
			foreach ( $tag_list as $term ) :
				if ( listable_get_term_icon_url( $term->term_id ) ) {
					$the_term = $term;
					break;
				}
			endforeach;
		}
	}

	if( $the_term != null ) {
		$icon_url      = listable_get_term_icon_url( $the_term->term_id );
		$attachment_id = listable_get_term_icon_id( $the_term->term_id );
		echo '<div class="single-listing-map-category-icon">';
		listable_display_image( $icon_url, '', true, $attachment_id );
		echo '</div>';
	}
}