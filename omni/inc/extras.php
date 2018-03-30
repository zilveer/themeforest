<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package omni
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function omni_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}

add_filter( 'body_class', 'omni_body_classes' );


if ( version_compare( $GLOBALS['wp_version'], '4.1', '<' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep Optional separator.
	 *
	 * @return string The filtered title.
	 */
	function omni_wp_title( $title, $sep ) {
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name.
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary.
		if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
			$title .= " $sep " . sprintf( esc_html__( 'Page %s', 'omni' ), max( $paged, $page ) );
		}

		return $title;
	}

	add_filter( 'wp_title', 'omni_wp_title', 10, 2 );

	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function omni_render_title() {
		?>
		<title><?php wp_title( '|', true, 'right' ); ?></title>
		<?php
	}

	add_action( 'wp_head', 'omni_render_title' );
endif;

function bootstrap_wrap_oembed( $html ){
	$html = preg_replace( '/(width|height)="\d*"\s/', "", $html ); // Strip width and height #1
	return'<div class="embed-responsive embed-responsive-16by9">'.$html.'</div>'; // Wrap in div element and return #3 and #4
}
add_filter( 'embed_oembed_html','bootstrap_wrap_oembed',10,1);


/**
 * Style for read more button.
 *
 * @param string $more Default More text.
 *
 * @return string
 */
function crum_list_excerpt_more( $more ) {
	global $post;

	return '<a href="' . get_permalink( get_the_ID() ) . '" class="button size-2">' .
	       sprintf(
	           /* translators: %s: Name of current post. */
		       wp_kses( __( 'Continue reading %s', 'omni' ), array( 'span' => array( 'class' => array() ) ) ),
		       the_title( '<span class="screen-reader-text">"', '"</span>', false )
	       ) . '</a>';
}

add_filter( 'excerpt_more', 'crum_list_excerpt_more' );

/**
 * Style for read more button.
 *
 * @return string
 */
function crum_list_read_more_link() {

	return '<a href="' . get_permalink( get_the_ID() ) . '" class="button size-2">' .
	       sprintf(
	           /* translators: %s: Name of current post. */
		       wp_kses( __( 'Continue reading %s', 'omni' ), array( 'span' => array( 'class' => array() ) ) ),
		       the_title( '<span class="screen-reader-text">"', '"</span>', false )
	       ) . '</a>';
}

add_filter( 'the_content_more_link', 'crum_list_read_more_link' );





/**
 * Add/Remove Contact Methods.
 *
 * @param mixed $contactmethods Current fields on profile page.
 *
 * @return mixed
 */
function crum_contactmethods( $contactmethods ) {

	$contactmethods['twitter']    = 'Twitter';
	$contactmethods['googleplus'] = 'Google Plus';
	$contactmethods['linkedin']   = 'Linked In';
	$contactmethods['facebook']   = 'Facebook';
	$contactmethods['instagram']  = 'Instagram';
	$contactmethods['pinterest']  = 'Pinterest';


	// Remove Contact Methods.
	unset( $contactmethods['aim'] );
	unset( $contactmethods['yim'] );
	unset( $contactmethods['jabber'] );

	return $contactmethods;
}

add_filter( 'user_contactmethods', 'crum_contactmethods', 10, 1 );


/**
 * Add class to edit button.
 *
 * @param string $output Custom Class for post edit link.
 *
 * @return string
 */
function crum_edit_post_link( $output ) {
	$output = str_replace( 'class="post-edit-link"', 'class="post-edit-link btn btn-primary"', $output );

	return $output;
}

add_filter( 'edit_post_link', 'crum_edit_post_link' );

/**
 * Customize get_avatar css class
 *
 * @param string $class Default avatar Class.
 *
 * @return string
 */
function change_avatar_css( $class ) {
	$class = str_replace( "class='avatar", "class='img-circle avatar", $class );

	return $class;
}

add_filter( 'get_avatar', 'change_avatar_css' );

/**
 * Customize the Password Form on Protected Posts
 *
 * @param int $post Post ID.
 *
 * @return string
 */
function crum_password_form( $post ) {
	$current_post = get_post( $post );
	$label        = 'pwbox-' . ( empty( $current_post->ID ) ? rand() : $current_post->ID );
	$output       = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" class="post-password-form form-inline" method="post">
    <h2>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'omni' ) . '</h2>
    <p class="hide"><label for="' . $label . '">' . __( 'Password:', 'omni' ) . '</label></p>
     	<div class="form-group"><input name="post_password" class="form-control" id="' . $label . '" type="password" size="20" placeholder="' . esc_html__( 'Password:', 'omni' ) . '" /><button class="btn btn-primary pass" name="Submit">' . esc_attr__( 'Submit', 'omni' ) . '</button></div>
    </form>
    ';

	return $output;
}

add_filter( 'the_password_form', 'crum_password_form' );


// Load VC if not already active.
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( $disable_updater = true );
}

if ( function_exists( 'vc_remove_element' ) ) {
	vc_remove_element( 'vc_posts_slider' );
	vc_remove_element( 'vc_gmaps' );
}

if ( ! ( function_exists( 'crumina_widget_background' ) ) ) {
	/**
	 *  Background options for widget before footer.
	 *
	 * @param string $widget_prefix Get options for current widget.
	 *
	 * @return string
	 */
	function crumina_widget_background( $widget_prefix ) {

		$widget_bg            = cs_get_customize_option( $widget_prefix . '_widget_bg_image' );
		$widget_bg_repeat     = cs_get_customize_option( $widget_prefix . '_widget_bg_repeat' );
		$widget_bg_position   = cs_get_customize_option( $widget_prefix . '_widget_bg_position' );
		$widget_bg_attachment = cs_get_customize_option( $widget_prefix . '_widget_bg_attachment' );
		$widget_bg_color      = cs_get_customize_option( $widget_prefix . '_widget_bg_color' );
		$widget_text_color    = cs_get_customize_option( $widget_prefix . '_widget_text_color' );

		$custom_style = 'style="';

		if ( isset( $widget_bg ) && ! ( empty( $widget_bg ) ) ) {
			$image = wp_get_attachment_image_src( $widget_bg, 'full' );
			$custom_style .= 'background-image:url(' . $image[0] . '); ';
		}

		if ( isset( $widget_bg_position ) && ! ( empty( $widget_bg_position ) ) ) {
			$custom_style .= 'background-position:' . $widget_bg_position . '; ';
		}

		if ( isset( $widget_bg_repeat ) && ! ( 'inherit' === $widget_bg_repeat ) ) {
			$custom_style .= 'background-repeat:' . $widget_bg_repeat . '; ';
		} elseif ( isset( $widget_bg_repeat ) && ( 'inherit' === $widget_bg_repeat ) ) {
			$custom_style .= 'background-size:cover;';
		}

		if ( isset( $widget_bg_attachment ) && ! ( empty( $widget_bg_attachment ) ) ) {
			$custom_style .= 'background-attachment:' . $widget_bg_attachment . '; ';
		}

		if ( isset( $widget_bg_color ) && ! ( empty( $widget_bg_color ) ) ) {
			$custom_style .= 'background-color:' . $widget_bg_color . '; ';
		}

		if ( isset( $widget_text_color ) && ! ( empty( $widget_text_color ) ) ) {
			$custom_style .= 'color:' . $widget_text_color . '; ';
		}

		$custom_style .= '"';

		return $custom_style;

	}
}




add_action( 'numbered_in_page_links', 'numbered_in_page_links', 10, 1 );

/**
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 *
 * @param  array $args
 *
 * @return void
 */
function numbered_in_page_links( $args = array() ) {

	$before = $pagelink = $link_before = $link_after = $highlight_before = $highlight_after = $after = '';

	$defaults = array(
		'before'           => '<p>' . __( 'Pages:','omni' ),
		'after'            => '</p>',
		'link_before'      => '',
		'link_after'       => '',
		'pagelink'         => '%',
		'echo'             => 1,
		'highlight_before' => '<b>',
		'highlight_after'  => '</b>',
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'wp_link_pages_args', $r );
	extract( $r );

	global $page, $numpages, $multipage, $more, $pagenow;

	if ( ! $multipage ) {
		return;
	}

	$output = $before;

	for ( $i = 1; $i < ( $numpages + 1 ); $i ++ ) {
		$j = str_replace( '%', $i, $pagelink );
		$output .= ' ';

		if ( $i != $page || ( ! $more && 1 == $page ) ) {
			$output .= _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>";
		} else {
			$output .= "$highlight_before{$link_before}{$j}{$link_after}$highlight_after";
		}
	}

	print $output . $after;
}

if ( ! ( function_exists( 'crumina_font_customization' ) ) ) {
	function crumina_font_customization( $tag ) {

		$custom_color         = cs_get_customize_option( $tag . '_typography_custom_color' );
		$custom_font_size     = cs_get_customize_option( $tag . '_typography_custom_font_size' );
		$custom_font          = cs_get_customize_option( $tag . '_typography_use_custom' );
		$custom_font_settings = cs_get_customize_option( $tag . '_typography_custom_font' );

		$custom_css = '{';

		if ( isset( $custom_color ) && ! ( empty( $custom_color ) ) ) {
			$custom_css .= 'color:' . $custom_color . '; ';
		}

		if ( isset( $custom_font_size ) && ! ( empty( $custom_font_size ) ) ) {
			$custom_css .= 'font-size:' . $custom_font_size . 'px; ';
		}

		if ( isset( $custom_font ) && ( true === $custom_font ) && isset( $custom_font_settings ) && ! ( empty( $custom_font_settings ) ) ) {
			if ( substr_count( $custom_font_settings, ' ' ) > 0 ) {
				$custom_font_settings = '"' . $custom_font_settings . '"';
			}
			$custom_css .= 'font-family:' . $custom_font_settings . ';';
		}

		$custom_css .= '}';

		return $custom_css;

	}
}

if(!function_exists('crumina_tag_font_size')){
	function crumina_font_size($tag){
		$output = '';
		$tag_option = cs_get_customize_option( 'heading_typography_custom_font_size_'.$tag );
		if(isset($tag_option) && !empty($tag_option)){
			$output .= $tag;
			$output .= '{font-size:'.$tag_option.'px !important;}';
		}

		return $output;
	}
}

if ( ! function_exists( 'crum_comments' ) ) :
	/**
	 * Reactor List Comments Callback
	 * callback function for wp_list_comments in reactor/comments.php
	 *
	 * @param object $comment Comment object.
	 * @param array  $args    Arguments for callback.
	 * @param int    $depth   Max. depth of comments tree.
	 */
	function crum_comments( $comment, $args, $depth ) {
		do_action( 'crum_comments', $comment, $args, $depth );

		$GLOBALS['comment'] = $comment;

		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
				// Display trackbacks differently than normal comments.
				?>
				<div <?php comment_class( 'comment-entry' ); ?> id="comment-<?php comment_ID(); ?>">
				<h6><?php esc_html_e( 'Pingback:', 'omni' ); ?> <?php comment_author_link(); ?> </h6>
				<?php edit_comment_link( esc_html__( 'Edit', 'omni' ), '<div class="comment-edit-link"><span>', '</span></div>' ); ?>
				<?php
				break;
			default :
				// Proceed with normal comments.
				global $comment_depth;
				global $allowedtags;

				if ( '1' === $comment_depth ) {
					$reply_comment = '';
				} else {
					$reply_comment = ' reply-comment';
				}

				?>
			<div <?php comment_class( 'comment-entry' . $reply_comment ); ?> id="li-comment-<?php comment_ID(); ?>">

				<?php if ( '0' === $comment->comment_approved ) : ?>
					<h5 class="comment-awaiting-moderation"> <?php esc_html_e( 'Your comment is awaiting moderation.', 'omni' ); ?></h5>
				<?php endif; ?>


				<div class="comment-image">
					<?php
					$avatar_output = get_avatar( $comment, 165 );
					echo wp_kses( $avatar_output, $allowedtags );
					?>
				</div>


				<div class="comment-content">
					<?php
					$comment_author_email = get_comment_author_email();
					$is_user              = get_user_by( 'email', $comment_author_email );

					if ( ! ( false === $is_user ) ) {
						$author_name      = $is_user->display_name;
						$author_posts_url = get_author_posts_url( $is_user->ID );
						$author_link      = '<a href="' . $author_posts_url . '" rel="external nofollow" class="url">' . $author_name . '</a>';
					} else {
						$author_link = get_comment_author_link();
					}

					?>
					<div class="name">
						<?php echo wp_kses( $author_link, $allowedtags ); ?>
						<div class="reply">
							<?php
							$comment_reply_link = '';
							ob_start();
							comment_reply_link( array_merge( $args, array(
								'reply_text' => esc_html__( 'reply', 'omni' ),
								'before'     => '<span aria-hidden="true" class="glyphicon glyphicon-comment"></span> ',
								'after'      => '',
								'depth'      => $depth,
								'max_depth'  => $args['max_depth'],
							) ) );
							$comment_reply_link .= ob_get_clean();
							echo wp_kses( $comment_reply_link, $allowedtags );
							?>
						</div>
					</div>
					<?php
					$comment_time     = get_comment_time( 'c', false, true );
					$comment_time_ago = crumina_relative_time( $comment_time );
					?>
					<div class="date"><span aria-hidden="true" class="glyphicon glyphicon-time"></span> <?php echo esc_html( $comment_time_ago ); ?></div>

					<div class="description"><?php comment_text(); ?></div>
					<div class="clear"></div>
				</div><!-- end media-body -->
				<!-- #comment-## -->
				<?php
				break;
		endswitch; // End comment_type check.
	}
endif;

// Related posts plugin addition.
add_filter( 'rp4wp_append_content', '__return_false' );

function omni_stringTruncate($string, $your_desired_width) {
	$parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
	$parts_count = count($parts);

	$length = 0;
	$last_part = 0;
	for (; $last_part < $parts_count; ++$last_part) {
		$length += strlen($parts[$last_part]);
		if ($length > $your_desired_width) { break; }
	}

	return implode(array_slice($parts, 0, $last_part));
}

add_filter('wp_get_attachment_image', 'crum_addlightboxrel');
function crum_addlightboxrel($content) {
	global $post;
	$pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
	$replacement = '<a$1href=$2$3.$4$5 rel="prettyPhoto[pp_gal'.$post->ID.']" title="'.$post->post_title.'"$6>';
	$content = preg_replace($pattern, $replacement, $content);
	return $content;
}
