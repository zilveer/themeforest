<?php

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
add_filter( 'ot_post_formats', '__return_true' );

function barcelona_ot_list_item_settings( $settings, $id ) {

	if ( $id == 'barcelona_sidebars' ) {
		return array();
	}

	return $settings;

}
add_filter( 'ot_list_item_settings', 'barcelona_ot_list_item_settings', 10, 2 );

function barcelona_ot_list_item_title_label( $label, $id ) {

	switch ( $id ) {
		case 'barcelona_sidebars':
			$label = esc_html__( 'Sidebar Name', 'barcelona' );
			break;
		case 'barcelona_mod':
			$label = esc_html__( 'Module Title', 'barcelona' );
			break;
	}

	return $label;

}
add_filter( 'ot_list_item_title_label', 'barcelona_ot_list_item_title_label', 10, 2 );

function barcelona_ot_list_item_description( $label, $id ) {

	if ( $id == 'barcelona_sidebars' ) {
		$label = '';
	}

	return $label;

}
add_filter( 'ot_list_item_description', 'barcelona_ot_list_item_description', 10, 2 );

function barcelona_ot_header_logo_link() {

	return '<span class="title">'. esc_html( BARCELONA_THEME_NAME ) .'</span><span class="sub-title">'. esc_html( sprintf( _x( 'Theme Options v%s', 'Theme Options v{version}', 'barcelona' ), BARCELONA_THEME_VERSION ) ) .'</span>';

}
add_filter( 'ot_header_logo_link', 'barcelona_ot_header_logo_link' );

function barcelona_ot_header_version_text() {

	return '';

}
add_filter( 'ot_header_version_text', 'barcelona_ot_header_version_text' );

function barcelona_ot_upload_text() {

	return esc_html__( 'Insert', 'barcelona' );

}
add_filter( 'ot_upload_text', 'barcelona_ot_upload_text' );

// Register User Contact Methods
function barcelona_user_contact_methods( $user_contact_method ) {

	$user_contact_method['job_title'] = esc_html__( 'Job Title', 'barcelona' );
	$user_contact_method['facebook'] = esc_html__( 'Facebook URL', 'barcelona' );
	$user_contact_method['twitter'] = esc_html__( 'Twitter URL', 'barcelona' );
	$user_contact_method['instagram'] = esc_html__( 'Instagram URL', 'barcelona' );
	$user_contact_method['google_plus'] = esc_html__( 'Google+ URL', 'barcelona' );
	$user_contact_method['linkedin'] = esc_html__( 'Linkedin URL', 'barcelona' );

	return $user_contact_method;

}
add_filter( 'user_contactmethods', 'barcelona_user_contact_methods' );

function barcelona_prevent_prepend_attachment( $content ) {

	$post = get_post();

	if ( ! empty( $post->post_type )
		&& $post->post_type == 'attachment'
		&& wp_attachment_is( 'image', $post ) ) {
		return '';
	}

	return $content;

}
add_filter( 'prepend_attachment', 'barcelona_prevent_prepend_attachment' );

function barcelona_body_class( $classes ) {

	if ( barcelona_get_option( 'boxed_layout' ) == 'on' ) {
		$classes[] = 'boxed-layout';
	}

	$barcelona_bg = barcelona_get_background();
	if ( empty( $barcelona_bg ) ) {
		$barcelona_bg = barcelona_get_background( true );
	}

	if ( ( get_background_color() !== get_theme_support( 'custom-background', 'default-color' )
			|| get_background_image()
			|| ! empty( $barcelona_bg ) )
		&& ! in_array( 'boxed-layout', $classes ) ) {
		$classes[] = 'boxed-layout-bg';
		if ( ! empty( $barcelona_bg ) ) {
			$classes[] = 'po-bg';
		}
	}

	if ( class_exists( 'Mobile_Detect' ) ) {

		$barcelona_detect = new Mobile_Detect;

		if ( $barcelona_detect->isTablet() ) {
			$classes[] = 'barcelona-device-tablet';
		} else if ( $barcelona_detect->isMobile() ) {
			$classes[] = 'barcelona-device-mobile';
		}

	}

	if ( is_singular() ) {

		$barcelona_fimg_id = barcelona_get_option( 'featured_image_style' );
		$barcelona_post_format = barcelona_get_post_format();
		$barcelona_is_media = in_array( $barcelona_post_format, array( 'audio', 'gallery', 'video' ), true );

		if ( $barcelona_fimg_id == 'none' ) {
			$barcelona_fimg_id = 'cl';
			$classes[] = 'barcelona-fimg-none';
		}

		if ( $barcelona_is_media && in_array( $barcelona_fimg_id, array( 'sp', 'fp', 'fs' ), true ) ) {
			$barcelona_fimg_id = 'sw';
		}

		if ( in_array( $barcelona_post_format, array( 'gallery', 'video' ), true ) && $barcelona_fimg_id != 'cl' ) {
			$barcelona_fimg_id = 'fw';
		}

		$classes[] = 'barcelona-fimg-'. $barcelona_fimg_id;

	}

	$classes[] = ( barcelona_get_option( 'show_breadcrumb' ) != 'on' ) ? 'no-breadcrumb' : 'has-breadcrumb';

	if ( barcelona_get_option( 'zoom_in_post_on_hover' ) == 'on' ) {
		$classes[] = 'zoom-enabled';
	}

	return $classes;

}
add_filter( 'body_class', 'barcelona_body_class' );

function barcelona_link_pages_link( $link, $i ) {

	if ( is_numeric( $link ) ) {
		$link = '<span class="page-numbers current">'. esc_html( $link ) .'</span>';
	} else {
		$link = wp_kses( str_replace( '<a href=', '<a class="page-numbers" href=', $link ), array( 'a' => array( 'href' => array(), 'class' => array() ) ) );
	}

	return $link;

}
add_filter( 'wp_link_pages_link', 'barcelona_link_pages_link', 10, 2 );

function barcelona_get_search_form() {

	static $barcelona_search_i = 1;

	$form = '<form class="search-form" method="get" action="' . esc_url( home_url( '/' ) ) . '">
				 <div class="search-form-inner"><div class="barcelona-sc-close"><span class="barcelona-ic">&times;</span><span class="barcelona-text">'. esc_html__( 'Close', 'barcelona' ) .'</span></div>
				 	<div class="input-group">
				        <span class="input-group-addon" id="searchAddon'. intval( $barcelona_search_i ) .'"><span class="fa fa-search"></span></span>
		                <input type="text" name="s" class="form-control search-field" autocomplete="off" placeholder="'. esc_attr_x( 'Search&hellip;', 'placeholder', 'barcelona' ) .'" title="' . esc_attr_x( 'Search for:', 'label', 'barcelona' ) . '" value="'. esc_attr( get_search_query() ) .'" aria-describedby="searchAddon'. intval( $barcelona_search_i ) .'" />
		                <span class="input-group-btn">
		                    <button type="submit" class="btn"><span class="btn-search-text">'. esc_attr_x( 'Search', 'submit button', 'barcelona' ) .'</span><span class="btn-search-icon"><span class="fa fa-search"></span></span></button>
		                </span>
	                </div>
                </div>
            </form>';

	$barcelona_search_i++;

	return $form;

}
add_filter( 'get_search_form', 'barcelona_get_search_form' );

function barcelona_get_the_archive_title( $title ) {

	if ( is_category() ) {

		$title = sprintf( esc_html_x( '%s', 'Category archives title', 'barcelona' ), esc_html( single_cat_title( '', false ) ) );

	} elseif ( is_tag() ) {

		$title = sprintf( esc_html__( 'Tag: %s', 'barcelona' ), esc_html( single_tag_title( '', false ) ) );

	} elseif ( is_author() ) {

		$title = sprintf( esc_html__( 'Author: %s', 'barcelona' ), '<span class="vcard">' . get_the_author() . '</span>' );

	} elseif ( is_year() ) {

		$title = sprintf( esc_html_x( 'Archive: %s', 'Yearly archives title', 'barcelona' ), get_the_date( 'Y' ) );

	} elseif ( is_month() ) {

		$title = sprintf( esc_html_x( 'Archive: %s', 'Monthly archives title', 'barcelona' ), get_the_date( 'F Y' ) );

	} elseif ( is_day() ) {

		$title = sprintf( esc_html_x( 'Archive: %s', 'Daily archives title', 'barcelona' ), get_the_date( BARCELONA_DATE_FORMAT ) );

	} elseif ( is_tax( 'post_format' ) ) {

		if ( is_tax( 'post_format', 'post-format-aside' ) ) {

			$title = esc_html_x( 'Asides', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {

			$title = esc_html_x( 'Galleries', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {

			$title = esc_html_x( 'Images', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {

			$title = esc_html_x( 'Videos', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {

			$title = esc_html_x( 'Quotes', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {

			$title = esc_html_x( 'Links', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {

			$title = esc_html_x( 'Statuses', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {

			$title = esc_html_x( 'Audio', 'post format archive title', 'barcelona' );

		} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {

			$title = esc_html_x( 'Chats', 'post format archive title', 'barcelona' );

		}

	} elseif ( is_post_type_archive() ) {

		$title = sprintf( esc_html__( 'Archives: %s', 'barcelona' ), post_type_archive_title( '', false ) );

	} elseif ( is_tax() ) {

		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( esc_html__( '%1$s: %2$s', 'default' ), $tax->labels->singular_name, esc_html( single_term_title( '', false ) ) );

	} else {

		$title = esc_html__( 'Archives', 'barcelona' );

	}

	return $title;

}
add_filter( 'get_the_archive_title', 'barcelona_get_the_archive_title' );

function barcelona_search_form_full() {

	echo '<div class="search-form-full">'. get_search_form( false ) .'</div>';

}
add_action( 'wp_footer', 'barcelona_search_form_full' );

function barcelona_widget_tagcloud_limit( $args ) {

	$args['number'] = 20;

	return $args;

}
//add_filter( 'widget_tag_cloud_args', 'barcelona_widget_tagcloud_limit' );

function barcelona_meta_box_post_format_video() {

	return array(
		'id'        => 'ot-post-format-video',
		'title'     =>  esc_html__( 'Post Format Options: Video', 'barcelona' ),
		'pages'     => array( 'post' ),
		'context'   => 'side',
		'priority'  => 'low',
		'fields'    => array(
			array(
				'id'        => 'barcelona_format_video_type',
				'label'     => '',
				'desc'      => '',
				'type'      => 'select',
				'std'       => 'external',
				'choices'   => array(
					array(
						'value' => 'external',
						'label' => esc_html__( 'External', 'barcelona' )
					),
					array(
						'value' => 'internal',
						'label' => esc_html__( 'Self-Hosted', 'barcelona' )
					)
				)
			),
			array(
				'id'    => 'barcelona_format_video_embed',
				'label' => esc_html__( 'Video Embed Code', 'barcelona' ),
				'desc'  => esc_html__( 'Add the embed code of video from services like Youtube, Vimeo, or Hulu.', 'barcelona' ),
				'type'  => 'textarea',
				'rows'  => 3,
				'class' => 'barcelona-textarea-code',
				'condition' => 'barcelona_format_video_type:is(external)'
			),
			array(
				'id'          => 'barcelona_format_video_url',
				'label'       => esc_html__( 'Video Url', 'barcelona' ),
				'desc'        => esc_html__( 'Put the url of the video or choose from library', 'barcelona' ),
				'type'        => 'upload',
				'condition'   => 'barcelona_format_video_type:is(internal)'
			)
		)
	);

}
add_filter( 'ot_meta_box_post_format_video', 'barcelona_meta_box_post_format_video' );

function barcelona_meta_box_post_format_audio() {

	return array(
		'id'        => 'ot-post-format-audio',
		'title'     =>  esc_html__( 'Post Format Options: Audio', 'barcelona' ),
		'pages'     => array( 'post' ),
		'context'   => 'side',
		'priority'  => 'low',
		'fields'    => array(
			array(
				'id'        => 'barcelona_format_audio_type',
				'label'     => '',
				'desc'      => '',
				'type'      => 'select',
				'std'       => 'external',
				'choices'   => array(
					array(
						'value' => 'external',
						'label' => esc_html__( 'External', 'barcelona' )
					),
					array(
						'value' => 'internal',
						'label' => esc_html__( 'Self-Hosted', 'barcelona' )
					)
				)
			),
			array(
				'id'    => 'barcelona_format_audio_embed',
				'label' => esc_html__( 'Audio Embed Code', 'barcelona' ),
				'desc'  => esc_html__( 'Add the embed code of audio from services like SoundCloud or Rdio.', 'barcelona' ),
				'type'  => 'textarea',
				'rows'  => 3,
				'class' => 'barcelona-textarea-code',
				'condition' => 'barcelona_format_audio_type:is(external)'
			),
			array(
				'id'          => 'barcelona_format_audio_url',
				'label'       => esc_html__( 'Audio Url', 'barcelona' ),
				'desc'        => esc_html__( 'Put the url of the video or choose from library', 'barcelona' ),
				'type'        => 'upload',
				'condition'   => 'barcelona_format_audio_type:is(internal)'
			)
		)
	);

}
add_filter( 'ot_meta_box_post_format_audio', 'barcelona_meta_box_post_format_audio' );

function barcelona_meta_box_post_format_gallery() {

	return array(
		'id'        => 'ot-post-format-gallery',
		'title'     => esc_html__( 'Post Format Options: Gallery', 'barcelona' ),
		'pages'     => array( 'post' ),
		'context'   => 'side',
		'priority'  => 'low',
		'fields'    => array(
			array(
				'id'          => 'barcelona_format_gallery',
				'label'       => '',
				'desc'        => '',
				'std'         => '',
				'type'        => 'gallery'
			)
		)
	);

}
add_filter( 'ot_meta_box_post_format_gallery', 'barcelona_meta_box_post_format_gallery' );

function barcelona_views_meta_key() {

	return '_barcelona_views';

}
add_filter( 'ev_meta_key', 'barcelona_views_meta_key' );

function barcelona_admin_body_class() {

	$barcelona_class = '';
	$barcelona_post_id = false;

	if ( array_key_exists( 'post', $_GET ) && is_numeric( $_GET['post'] ) ) {
		$barcelona_post_id = $_GET['post'];
	} else if ( array_key_exists( 'post_ID', $_POST ) ) {
		$barcelona_post_id = $_POST['post_ID'];
	}

	if ( is_numeric( $barcelona_post_id ) ) {

		$template_file = get_post_meta( $barcelona_post_id, '_wp_page_template', true );

		if ( $template_file == 'page-modules.php' ) {
			$barcelona_class = 'page-builder-template';
		}

	}

	return $barcelona_class;

}
add_filter( 'admin_body_class', 'barcelona_admin_body_class' );

/*
 * Custom password protected post form
 */
function barcelona_password_form() {

	global $post;

	$label = 'pwbox-' . ( empty($post->ID) ? rand() : $post->ID );
	$output = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form" method="post">
	<p class="description">' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'barcelona' ) . '</p>
	<p class="input-group"><input name="post_password" id="' . esc_attr( $label ) . '" class="form-control" type="password" size="20" placeholder="'. esc_html__( 'Type password...', 'barcelona' ) .'" /><span class="input-group-btn"><button type="submit" class="btn btn-red-2" name="Submit">'. esc_attr__( 'Submit', 'barcelona' ) .'</button></span></p></form>';

	return $output;

}
add_filter( 'the_password_form', 'barcelona_password_form' );

function barcelona_widget_text_shortcode( $text ) {

	return do_shortcode( $text );

}
add_filter( 'widget_text', 'barcelona_widget_text_shortcode' );

function barcelona_gallery_shortcode( $output='', $attr ) {

	$post = get_post();

	static $instance = 0;
	$instance++;

	if ( ! empty( $attr['ids'] ) ) {

		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}

		$attr['include'] = $attr['ids'];

	}

	if ( isset( $attr['orderby'] ) ) {

		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );

		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}

	}

	$atts = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'columns'    => 3,
		'size'       => 'barcelona-sq',
		'include'    => '',
		'exclude'    => '',
		'link'       => 'file',
		'type'       => ''
	), $attr, 'gallery' );

	$barcelona_post_id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {

		$_attachments = get_posts( array(
			'include'        => $atts['include'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $atts['order'],
			'orderby'        => $atts['orderby']
		) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[$val->ID] = $val;
		}

	} elseif ( ! empty( $atts['exclude'] ) ) {

		$attachments = get_children( array(
			'post_parent'    => $barcelona_post_id,
			'exclude'        => $atts['exclude'],
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $atts['order'],
			'orderby'        => $atts['orderby']
		) );

	} else {

		$attachments = get_children( array(
			'post_parent'    => $barcelona_post_id,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $atts['order'],
			'orderby'        => $atts['orderby']
		) );

	}

	if ( empty( $attachments ) ) {
		return '';
	}

	if ( is_feed() ) {

		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
			$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}

		return $output;

	}

	if ( $atts['type'] == 'featured' ) {
		$atts['columns'] = 1;
	}

	$output = '';

	if ( $atts['type'] == 'featured' ) {

		$output .= '<section class="posts-box posts-box-carousel posts-box-gallery">
						<div class="posts-wrapper">
							<ul class="nav-dir" id="gal-controls"><li><button class="btn"><span class="fa fa-angle-right"></span></button></li><li><button class="btn"><span class="fa fa-angle-left"></span></button></li></ul>
							<div class="mas-item owl-carousel owl-theme" data-controls="#gal-controls" data-items="1" data-rtl="'. ( is_rtl() ? 'true' : 'false' ) .'" data-loop="false">';

	} else {

		$output .= '<div id="gallery-'. intval( $instance ) .'" class="gallery galleryid-'. intval( $barcelona_post_id ) .' gallery-columns-'. intval( $atts['columns'] ) .' gallery-size-'. sanitize_html_class( $atts['size'] ) .' clearfix">';

	}

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$barcelona_attr = array(
			'class' => 'gal-img',
			'data-gallery' => $barcelona_post_id
		);

		if ( trim( $attachment->post_excerpt ) ) {
			$barcelona_attr['title'] = wptexturize($attachment->post_excerpt);
		}

		if ( $atts['type'] == 'featured' ) {

			$barcelona_img_url = wp_get_attachment_image_src( $id, 'barcelona-lg' );
			$barcelona_title = array_key_exists( 'title', $barcelona_attr ) ? $barcelona_attr[ 'title' ] : '';

			$output .= '<article class="item">';
			$output .= wp_get_attachment_image( $id, $atts['size'] );
			$output .= '<a href="' . esc_url( $barcelona_img_url[0] ) . '" class="item-overlay boxer clearfix" data-gallery="' . intval( $barcelona_post_id ) . '" title="' . esc_attr( $barcelona_title ) . '">';
			if ( ! empty( $barcelona_attr['title'] ) ) {
				$output .= '<div class="inner"><div class="post-summary"><h4 class="post-title small">' . esc_html( $barcelona_attr['title'] ) . '</h4></div></div>';
			}
			$output .= '</a></article>';

		} else {

			$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $barcelona_attr );

			$image_meta = wp_get_attachment_metadata( $id );

			$orientation = '';
			if ( isset( $image_meta[ 'height' ], $image_meta[ 'width' ] ) ) {
				$orientation = ( $image_meta[ 'height' ] > $image_meta[ 'width' ] ) ? 'portrait' : 'landscape';
			}

			$output .= '<figure class="gallery-item"><div class="gallery-icon ' . sanitize_html_class( $orientation ) . '">';
			if ( isset( $barcelona_attr['title'] ) ) {
				$output .= '<span class="caption-overlay">'. esc_html( $barcelona_attr['title'] ) .'</span>';
			}
			$output .= $image_output .'</div></figure>';

		}

		$i++;

	}

	$output .= "</div>\n";

	if ( $atts['type'] == 'featured' ) {
		$output .= '</div></section>';
	}

	return $output;

}
add_filter( 'post_gallery', 'barcelona_gallery_shortcode', 10, 4 );

function barcelona_bbp_title() {

	return esc_html__( 'Forums Archive', 'barcelona' ) .' | '. esc_html( get_bloginfo( 'name' ) );

}
add_filter( 'bbp_title', 'barcelona_bbp_title' );





add_action( 'load-post.php', 'barcelona_views_post_meta_box' );
add_action( 'load-post-new.php', 'barcelona_views_post_meta_box' );

function barcelona_views_post_meta_box() {

	/* Add meta boxes on the 'add_meta_boxes' hook. */
	add_action( 'add_meta_boxes', 'barcelona_add_post_views_meta_box' );

	/* Save post meta on the 'save_post' hook. */
	add_action( 'save_post', 'barcelona_save_post_views', 10, 2 );

}

function barcelona_add_post_views_meta_box() {

	add_meta_box(
		'barcelona-post-views',      // Unique ID
		esc_html__( 'Post Views', 'example' ),    // Title
		'barcelona_post_views_meta_box_html',   // Callback function
		'post',         // Admin page (or post type)
		'normal',         // Context
		'default'         // Priority
	);

}

/* Display the post meta box. */
function barcelona_post_views_meta_box_html( $object, $box ) { ?>

	<?php wp_nonce_field( basename( __FILE__ ), 'barcelona_post_views_nonce' ); ?>

	<p>
		<label for="barcelona-post-views"><?php _e( 'Post Views', 'barcelona' ); ?></label>
		<br />
		<input class="widefat" type="text" name="barcelona-post-views" id="barcelona-post-views" value="<?php echo esc_attr( get_post_meta( $object->ID, '_barcelona_views', true ) ); ?>" size="30" />
	</p>
<?php }

/* Save the meta box's post metadata. */
function barcelona_save_post_views( $post_id, $post ) {

	/* Verify the nonce before proceeding. */
	if ( ! isset( $_POST['barcelona_post_views_nonce'] ) || !wp_verify_nonce( $_POST['barcelona_post_views_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	/* Get the post type object. */
	$post_type = get_post_type_object( $post->post_type );

	/* Check if the current user has permission to edit the post. */
	if ( !current_user_can( $post_type->cap->edit_post, $post_id ) ) {
		return $post_id;
	}

	/* Get the posted data and sanitize it for use as an HTML class. */
	$new_meta_value = ( isset( $_POST['barcelona-post-views'] ) ? sanitize_html_class( $_POST['barcelona-post-views'] ) : '' );

	/* Get the meta key. */
	$meta_key = '_barcelona_views';

	/* Get the meta value of the custom field key. */
	$meta_value = get_post_meta( $post_id, $meta_key, true );

	update_post_meta( $post_id, $meta_key, $new_meta_value, $meta_value );

	return $post_id;

}

/*
 * Add shortcode support for menu items
 */
function barcelona_nav_menu_items( $items ) {

	return do_shortcode( $items );

}
add_filter( 'wp_nav_menu_items', 'barcelona_nav_menu_items' );

/*
 * Convert URLs into the hyperlinks in the comments
 */
function barcelona_convert_comment_links( $comment_content ) {

	$barcelona_pattern = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';
	$barcelona_output = preg_replace( $barcelona_pattern, '<a href="$0" target="_blank" title="$0">$0</a>', $comment_content );

	return $barcelona_output;

}
add_filter( 'get_comment_text', 'barcelona_convert_comment_links' );

/*
 * Allow category description to have custom html
 */
remove_filter( 'pre_term_description', 'wp_filter_kses' );

/*
 * Add custom class into the next/prev pagination links
 */
function barcelona_posts_link_attributes() {

	return 'class="page-numbers"';

}

add_filter( 'next_posts_link_attributes', 'barcelona_posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'barcelona_posts_link_attributes' );


remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
add_filter( 'woocommerce_show_page_title', '__return_false' );

function barcelona_woo_start_wrap() {

	if ( barcelona_get_option( 'show_breadcrumb' ) == 'on' ) {
		woocommerce_breadcrumb();
	}

	echo '<div class="container"><div class="'. esc_attr( barcelona_row_class() ) .'"><main id="main" class="'. esc_attr( barcelona_main_class() ) .'">';

	if ( ! is_product() ) {

		echo '<div class="box-header archive-header has-title"><h2 class="title">';

		if ( is_shop() ) {

			woocommerce_page_title();

		} elseif ( ( is_product_category() ) || ( is_product_tag() ) ) {

			global $wp_query;
			$barcelona_obj = $wp_query->get_queried_object();

			echo $barcelona_obj->name;

		} else {

			the_title();

		}

		echo '</h2></div>';

	}

}
add_action( 'woocommerce_before_main_content', 'barcelona_woo_start_wrap' );

function barcelona_woo_end_wrap() {

	echo '</main>';

	get_sidebar();

	echo '</div><!-- .row --></div><!-- .container -->';

}
add_action( 'woocommerce_after_main_content', 'barcelona_woo_end_wrap' );

function barcelona_woo_breadcrumbs() {

	// <ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">

	return array(
		'delimiter'   =>  '',
		'wrap_before' => '<div class="breadcrumb-wrapper"><div class="container"><ol itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb">',
		'wrap_after'  => '</ol></div></div>',
		'before'      => '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">',
		'after'       => '</li>',
		'home'        => esc_html_x( 'Home', 'breadcrumb', 'barcelona' ),
	);

}
add_filter( 'woocommerce_breadcrumb_defaults', 'barcelona_woo_breadcrumbs' );

function barcelona_woo_loop_columns() {

	if ( barcelona_get_option( 'sidebar_position' ) == 'none' ) {
		return 4;
	} else {
		return 3;
	}

}
add_filter( 'loop_shop_columns', 'barcelona_woo_loop_columns' );

function barcelona_woo_pagination() {

	return array(
		'prev_text' => esc_html__( '&laquo; Prev', 'barcelona' ),
		'next_text' => esc_html__( 'Next &raquo;', 'barcelona' )
	);

}
add_filter( 'woocommerce_pagination_args', 'barcelona_woo_pagination' );