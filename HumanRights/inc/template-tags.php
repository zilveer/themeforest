<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WPCharming
 */

/**
 * Render WordPress title ( Backwards compatibility for WP version < 4.1 )
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) :
    function wpcharming_render_title() {
	?>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<?php
    }
    add_action( 'wp_head', 'wpcharming_render_title' );
endif;

/**
 * Display the page header at the top of single page.
 */
function wpcharming_get_page_header($postID) {
	$enable_page_header    = get_post_meta( $postID, '_wpc_enable_page_header', true );
	$header_title          = get_post_meta( $postID, '_wpc_header_title', true );
	$header_subtitle       = get_post_meta( $postID, '_wpc_header_subtitle', true );
	$header_alignment      = get_post_meta( $postID, '_wpc_header_alignment', true );
	$header_bg             = get_post_meta( $postID, '_wpc_header_bg', true );
	$header_padding_top    = get_post_meta( $postID, '_wpc_header_padding_top', true );
	$header_padding_bottom = get_post_meta( $postID, '_wpc_header_padding_bottom', true );
	$header_parallax       = get_post_meta( $postID, '_wpc_header_parallax', true );
	$header_bg_color       = get_post_meta( $postID, '_wpc_header_bg_color', true );
	$header_text_color     = get_post_meta( $postID, '_wpc_header_text_color', true );

	// Page Header CSS
	$page_header_style = array();
	if ( $header_bg_color ) $page_header_style[] = 'background-color: '. $header_bg_color .';';
	if ( $header_text_color ) $page_header_style[] = 'color: '. $header_text_color .';';
	if ( $header_padding_top ) $page_header_style[] = 'padding-top: '. esc_attr($header_padding_top) .'px;';
	if ( $header_padding_bottom ) $page_header_style[] = 'padding-bottom: '. esc_attr($header_padding_bottom) .'px;';
	if ( $header_alignment == 'center' ) $page_header_style[] = 'text-align: center;';
	if ( $header_alignment == 'right' ) $page_header_style[] = 'text-align: right;';
	if ( $header_bg && $header_parallax !== 'on' ) $page_header_style[] = 'background: url('. esc_url($header_bg) .') no-repeat top center;';

	$page_header_style = implode('', $page_header_style);
	if ( $page_header_style ) {
		$page_header_style = wp_kses( $page_header_style, array() );
		$page_header_style = ' style="' . esc_attr($page_header_style) . '"';
	}

	// Parallax
	$parallax_bg = $data_bg = $wpc_row_parallax = null;
	if ( $header_parallax == 'on' && $header_bg ) {
		$wpc_row_parallax = ' wpc_row_parallax';
		$data_bg     = ' data-bg="'. esc_url($header_bg) .'" data-speed="0.5"';
		$parallax_bg = '<div class="wpc_parallax_bg" style="background-image: url('. esc_url($header_bg) .')"></div>';
	}

	// Heading Color
	$heading_color = null;
	if ( $header_text_color ) {
		$heading_color = ' style="color:'. $header_text_color .'"';
	}

	if ( $enable_page_header == 'on' ) {

		echo '
		<div class="page-header-wrap clearfix '. $wpc_row_parallax .'"'. $page_header_style . $data_bg .'>

			<div class="container">';

				if ( $header_title !== '' ) { 
					echo '<h1 class="page-title"'. $heading_color .'>'. wp_kses_post($header_title) .'</h1>';
				}

				if ( $header_subtitle ) echo'
				<span class="page-subtitle">'. wp_kses_post($header_subtitle) .'</span>';

			echo '
			</div>';

			echo $parallax_bg;


		echo '
		</div>';

	}
}

/**
 * Display navigation to next/previous set of posts when applicable.
 */
function wpcharming_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset ( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'wpcharming'     => $pagenum_link,
		'format'    => $format,
		'total'     => $GLOBALS['wp_query']->max_num_pages,
		'current'   => $paged,
		'mid_size'  => 1,
		'add_args'  => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&larr; Previous', 'wpcharming' ),
		'next_text' => __( 'Next &rarr;', 'wpcharming' ),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'wpcharming' ); ?></h1>
		<div class="pagination loop-pagination">
			<?php echo $links; ?>
		</div><!--/ .pagination -->
	</nav><!--/ .navigation -->
	<?php
	endif;
}


if ( ! function_exists( 'wpcharming_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function wpcharming_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'wpcharming' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>&nbsp;%title', 'Previous post link', 'wpcharming' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title&nbsp;<span class="meta-nav">&rarr;</span>', 'Next post link',     'wpcharming' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'wpcharming_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wpcharming_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		//$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		_x( ' on %s', 'post date', 'wpcharming' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	if ( is_sticky( ) ) {
		echo '<span class="genericon genericon-pinned"></span> ';
	}

	$byline = sprintf(
		_x( 'Posted by %s', 'post author', 'wpcharming' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';

	$categories_list = get_the_category_list( __( ', ', 'wpcharming' ) );
	if ( $categories_list && wpcharming_categorized_blog() ) {
		//printf( '<span class="cat-links">' . __( ' in %1$s', 'wpcharming' ) . '</span>', $categories_list );
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">'. __(' with ', 'wpcharming');
		comments_popup_link( __( '0 Comment', 'wpcharming' ), __( '1 Comment', 'wpcharming' ), __( '% Comments', 'wpcharming' ) );
		echo '</span>';
	}

}
endif;


/**
 * Control Excerpt Length using Filters
 */
function wpcharming_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'wpcharming_excerpt_length', 999 );

/**
 * Remove […] string using Filters
 */
function wpcharming_excerpt_more( $more ) {
	return ' ...';
}
add_filter('excerpt_more', 'wpcharming_excerpt_more');



if ( ! function_exists( 'wpcharming_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wpcharming_entry_footer() {
	
	$blog_single_author = wpcharming_option('blog_single_author');
	?>
	
	<?php
	$category_list = get_the_category_list();
	$tag_list      = get_the_tag_list( '<ul class="post-tags"><li>', "</li>\n<li>", '</li></ul>' );
	$meta_text     = '';

	if ( $category_list ) {
		$meta_text .= __( '<i class="fa fa-file"></i> ', 'wpcharming' ) . '%1$s';
	}
	if ( $tag_list ) {
		$meta_text .= __( '<i class="fa fa-tag"></i> ', 'wpcharming' ) . '%2$s';
	}
	printf(
		$meta_text,
		$category_list,
		$tag_list,
		get_permalink()
	);
	?>
	
	<?php if ( $blog_single_author ) { ?>
	<div class="entry-author clearfix">
		<div class="entry-author-avatar">
			<?php
			printf(
				'<a class="vcard" href="%1$s">%2$s</a>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				get_avatar( get_the_author_meta( 'ID' ) )
			);
			?>
		</div>
		<div class="entry-author-byline">
			<?php
			printf(
				_x( 'Written by %s', 'author byline', 'wpcharming' ),
				sprintf(
					'<a class="vcard" href="%1$s">%2$s</a>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_html( get_the_author_meta( 'display_name' ) )
				)
			);
			?>
		</div>
		<?php if ( is_singular() && $author_bio = get_the_author_meta( 'description' ) ) : ?>
		<div class="entry-author-bio">
			<?php echo wpautop( ( $author_bio ) ); ?>
		</div>
		<?php endif; ?>
	</div>
	<?php } ?>

	<?php
}
endif;

if ( ! function_exists( 'the_archive_title' ) ) :
/**
 * Shim for `the_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function the_archive_title( $before = '', $after = '' ) {
	if ( is_category() ) {
		$title = sprintf( __( 'Category: %s', 'wpcharming' ), single_cat_title( '', false ) );
	} elseif ( is_tag() ) {
		$title = sprintf( __( 'Tag: %s', 'wpcharming' ), single_tag_title( '', false ) );
	} elseif ( is_author() ) {
		$title = sprintf( __( 'Author: %s', 'wpcharming' ), '<span class="vcard">' . get_the_author() . '</span>' );
	} elseif ( is_year() ) {
		$title = sprintf( __( 'Year: %s', 'wpcharming' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpcharming' ) ) );
	} elseif ( is_month() ) {
		$title = sprintf( __( 'Month: %s', 'wpcharming' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpcharming' ) ) );
	} elseif ( is_day() ) {
		$title = sprintf( __( 'Day: %s', 'wpcharming' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'wpcharming' ) ) );
	} elseif ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = _x( 'Asides', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = _x( 'Galleries', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = _x( 'Images', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = _x( 'Videos', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = _x( 'Quotes', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = _x( 'Links', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
		$title = _x( 'Statuses', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = _x( 'Audio', 'post format archive title', 'wpcharming' );
	} elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
		$title = _x( 'Chats', 'post format archive title', 'wpcharming' );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( __( 'Archives: %s', 'wpcharming' ), post_type_archive_title( '', false ) );
	} elseif ( is_tax() ) {
		$tax = get_taxonomy( get_queried_object()->taxonomy );
		/* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
		$title = sprintf( __( '%1$s: %2$s', 'wpcharming' ), $tax->labels->singular_name, single_term_title( '', false ) );
	} else {
		$title = __( 'Archives', 'wpcharming' );
	}

	/**
	 * Filter the archive title.
	 *
	 * @param string $title Archive title to be displayed.
	 */
	$title = apply_filters( 'get_the_archive_title', $title );

	if ( ! empty( $title ) ) {
		echo $before . $title . $after;
	}
}
endif;

if ( ! function_exists( 'the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function the_archive_description( $before = '', $after = '' ) {
	$description = apply_filters( 'get_the_archive_description', term_description() );

	if ( ! empty( $description ) ) {
		/**
		 * Filter the archive description.
		 *
		 * @see term_description()
		 *
		 * @param string $description Archive description to be displayed.
		 */
		echo $before . $description . $after;
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wpcharming_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wpcharming_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wpcharming_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wpcharming_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wpcharming_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wpcharming_categorized_blog.
 */
function wpcharming_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wpcharming_categories' );
}
add_action( 'edit_category', 'wpcharming_category_transient_flusher' );
add_action( 'save_post',     'wpcharming_category_transient_flusher' );

/**
 * Let the sidebar display by Theme Option and Page Settings.
 */
function wpcharming_get_sidebar() {
	global $post;
	global $woocommerce;
	$post_type              = get_post_type($post);
	$archive_layout_setting = wpcharming_option('archive_layout');
	$page_layout_admin      = wpcharming_option('page_layout');
	$blog_layout_admin      = wpcharming_option('blog_layout');
	$single_shop_layout     = wpcharming_option('single_shop_layout');

	// Pages
	if ( is_singular('page') ){
		$page_layout_meta       = get_post_meta( $post->ID, '_wpc_page_layout', true );
		if ( $page_layout_meta == '' || $page_layout_meta == 'sidebar-default' ) {
			if ( $page_layout_admin == '' || $page_layout_admin == 'left-sidebar' || $page_layout_admin == 'right-sidebar' ) {
				get_sidebar();
			}
		} else {
			if ( $page_layout_meta == 'right-sidebar' || $page_layout_meta == 'left-sidebar' ) {
				get_sidebar();
			}
		}
	}

	// Single Post
	if ( is_single() && $post_type != 'product' ) {
		if ( $blog_layout_admin == 'right-sidebar' || $blog_layout_admin == 'left-sidebar' ) {
			get_sidebar();
		}
	}

	// Archive
	if ( ( (is_archive() || is_author()) && $post_type == 'post' ) && !is_front_page() ) {
		if ( $archive_layout_setting == 'right-sidebar' || $archive_layout_setting == 'left-sidebar' ) {
			get_sidebar();
		}
	}

	// Search
	if ( is_search() ) {
		if ( $archive_layout_setting == 'right-sidebar' || $archive_layout_setting == 'left-sidebar' ) {
			get_sidebar();
		}
	}

	// WooCommerce
	if ( $woocommerce ) {
		$shop_layout_meta       = get_post_meta( woocommerce_get_page_id('shop'), '_wpc_page_layout', true );
		if ( is_shop() || is_product_category() || is_product_tag() ) {
			if ( $shop_layout_meta == 'right-sidebar' || $shop_layout_meta == 'left-sidebar' ) {
				get_sidebar();
			}
		}
		if( is_product() ) {
			if ( $single_shop_layout == 'right-sidebar' || $single_shop_layout == 'left-sidebar' ) {
				get_sidebar();
			} else {
				// No Sidebar
			}
		} 
	}
}
/**
 * Let the sidebar display on frontpage if Front page set as latest post
 */
function wpcharming_frontpage_sidebar() {
	$display_sidebar        = false;
	$archive_layout_setting = wpcharming_option('archive_layout');
	$blog_layout_setting    = wpcharming_option('blog_layout');

	if ( is_front_page() ) {
		if ( $archive_layout_setting == 'right-sidebar' || $archive_layout_setting == 'left-sidebar' ) {
			$display_sidebar = true;
		} else {
			$display_sidebar = false;
		}
	} 

	if ( !is_front_page() && is_home() ) {
		if ( $blog_layout_setting == 'right-sidebar' || $blog_layout_setting == 'left-sidebar' ) {
			$display_sidebar = true;
		} else {
			$display_sidebar = false;
		}
	}

	if ( $display_sidebar ) {
		get_sidebar();
	}
}


if ( ! function_exists( 'wpcharming_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpcharming_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function wpcharming_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
        // Display trackbacks differently than normal comments.
    ?>
    <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
        <p><?php _e( 'Pingback:', 'wpcharming' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wpcharming' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
            break;
        default :
        // Proceed with normal comments.
        global $post;
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
        <article id="comment-<?php comment_ID(); ?>" class="comment clearfix">

            <?php echo get_avatar( $comment, 60 ); ?>

            <div class="comment-wrapper">
            
                <header class="comment-meta comment-author vcard">
                    <?php
                        printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                            get_comment_author_link(),
                            // If current post author is also comment author, make it known visually.
                            ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'wpcharming' ) . '</span>' : ''
                        );
                        printf( '<a class="comment-time" href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                            esc_url( get_comment_link( $comment->comment_ID ) ),
                            get_comment_time( 'c' ),
                            /* translators: 1: date, 2: time */
                            sprintf( __( '%1$s', 'wpcharming' ), get_comment_date() )
                        );
                        comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'wpcharming' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
                        edit_comment_link( __( 'Edit', 'wpcharming' ), '<span class="edit-link">', '</span>' );
                    ?>
                </header><!-- .comment-meta -->

                <?php if ( '0' == $comment->comment_approved ) : ?>
                    <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpcharming' ); ?></p>
                <?php endif; ?>

                <div class="comment-content entry-content">
                    <?php comment_text(); ?>
                    <?php  ?>
                </div><!-- .comment-content -->

            </div><!--/comment-wrapper-->

        </article><!-- #comment-## -->
    <?php
        break;
    endswitch; // end comment_type check
}
endif;

/**
 * Output html5 js file for ie9.
 */
function wpcharming_html5() {
	echo '<!--[if lt IE 9]>';
	echo '<script src="'. esc_url( get_template_directory_uri() ) .'/assets/js/html5.min.js"></script>';
	echo '<![endif]-->';
}
add_action( 'wp_head', 'wpcharming_html5' );

/**
 * Output site favicon to wp_head hook.
 */
function wpcharming_favicons() {
	$favicons = null;

	if ( wpcharming_option('site_favicon', '', 'url') ) $favicons .= '
	<link rel="shortcut icon" href="'. esc_url(wpcharming_option('site_favicon', '', 'url')) .'">';

	if ( wpcharming_option('site_iphone_icon', '', 'url') ) $favicons .= '
	<link rel="apple-touch-icon-precomposed" href="'. esc_url(wpcharming_option('site_iphone_icon', '', 'url')) .'">';

	if ( wpcharming_option('site_iphone_icon_retina', '', 'url') ) $favicons .= '
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'. esc_url(wpcharming_option('site_iphone_icon_retina', '', 'url')) .'">';

	if ( wpcharming_option('site_ipad_icon', '', 'url') ) $favicons .= '
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'. esc_url(wpcharming_option('site_ipad_icon', '', 'url')) .'">';

	if ( wpcharming_option('site_ipad_icon_retina', '', 'url') ) $favicons .= '
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'. esc_url(wpcharming_option('site_ipad_icon_retina', '', 'url')) .'">';

	echo $favicons;
}
add_action( 'wp_head', 'wpcharming_favicons' );

/**
 * Output Custom CSS to wp_head hook.
 */
function wpcharming_custom_css() {
	$styles     = null;
	$custom_css = wpcharming_option('site_css');
	
	if ( $custom_css !== '' ) $styles .= $custom_css;

	$css_output = "\n<style id=\"theme_option_custom_css\" type=\"text/css\">\n" . preg_replace( '/\s+/', ' ', $styles ) . "\n</style>\n";

	if ( !empty( $custom_css ) ) echo $css_output;

}
add_action( 'wp_head', 'wpcharming_custom_css' );

/**
 * Output Header Tracking Code to wp_head hook.
 */
function wpcharming_header_code() {
	$site_header_tracking = wpcharming_option('site_header_tracking');
	if ( $site_header_tracking !== '' ) echo $site_header_tracking;
}
add_action( 'wp_head', 'wpcharming_header_code' );

/**
 * Output Footer Tracking Code to wp_footer hook.
 */
function wpcharming_footer_code() {
	$site_footer_tracking = wpcharming_option('site_footer_tracking');
	if ( $site_footer_tracking !== '' ) echo $site_footer_tracking;
}
add_action( 'wp_footer', 'wpcharming_footer_code' );


/**
 * Modified Gallery Shortcode
 */

function wpcharming_post_gallery($output, $attr) {
    global $post;

    static $instance = 0;
    $instance++;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'medium-thumb',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $size = 'medium-thumb';

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? (100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";


    // Custom Lightbox
    $gallery_lightbox = null;
    if ( isset( $attr['link'] ) && $attr['link'] == 'file' ) { 
    	//wp_enqueue_script( 'wpcharming-magnific-popup' );
    	//wp_enqueue_style( 'wpcharming-magnific-style' );
    	$gallery_lightbox = 'gallery-lightbox';
    }
    

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
        <style type='text/css'>
            #{$selector} .gallery-item {
                float: {$float};
                text-align: center;
                width: {$itemwidth}%;
                margin-bottom:0;
            }
            #{$selector} img {
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>";

    if ( !empty( $attr['link'] ) && $attr['link'] != '' && $attr['link'] == 'file' ) { 
    	echo $attr['link'];
    	$gallery_style .= "
        <script type='text/javascript'>
        	jQuery(document).ready(function() {
				jQuery('.galleryid-{$id}').magnificPopup({
					delegate: '.gallery-item a',
					type: 'image',
					gallery:{
						enabled:true
					},
					zoom: {
						enabled:true
					}
				});
			});
        </script>";
    }

    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} {$gallery_lightbox}'>";
    //$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = (isset($attr['link']) && ($attr['link'] !== '') && 'file' == $attr['link']) ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<div class="clear"></div>';
    }

    $output .= '
            <div class="clear"></div>
        '."</div>\n";

    return $output;
}
//add_filter("post_gallery", "wpcharming_post_gallery",10,2);

/**
 * Output BreadCrumb.
 */
function wpcharming_breadcrumb() {
	if( function_exists('bcn_display') ) {
		if ( is_front_page() && is_home() ) {
			// Default homepage
		} elseif ( is_front_page() ) {
			// static homepage
		} elseif ( is_home() ) {
			// blog page
			?>
			<div class="breadcrumbs">
				<div class="container">
					<?php bcn_display(); ?>
				</div>
			</div>
			<?php
		} else {
			?>
			<div class="breadcrumbs">
				<div class="container">
					<?php bcn_display(); ?>
				</div>
			</div>
			<?php
		}
	}
}

/**
 * Display list child page
 */
function wpcharming_list_child_pages( $pageID, $order, $orderby, $exclude, $layout, $column, $number, $readmore_text ) {

	if ( $readmore_text == '' ) {
		$readmore_text = __('Read More', 'wpcharming');
	}

	$col_class = $thumbnail = '';
	if ( $column == 2 ) {
		$col_class = "grid-sm-6";
	} elseif ( $column == 3 ){
		$col_class = "grid-sm-6 grid-md-4";
	} elseif ( $column == 4 ) {
		$col_class = "grid-sm-6 grid-md-3";
	} else {
		$col_class = "grid-sm-6 grid-md-4";
	}
	$output = '';
	$count  = 0;

	$exclude_ids = null;
	if ( is_array( $exclude ) ) {
		$exclude_ids = explode(",",$exclude[0]);
	}

	$slick_rtl = 'false';
	if ( is_rtl() ){
		$slick_rtl = 'true';
	}

	$args = array(
		'posts_per_page' => $number,
		'post__not_in'   => $exclude_ids,
		'post_parent'    => $pageID,
		'post_type'      => 'page',
		'post_status'    => 'publish',
		'order'          => $order,
		'orderby'        => $orderby
		//'nopaging' => true
	);
	$page_childrens = new WP_Query( $args );

	$carousel_class = '';
	if ( $layout == 'carousel' ) {
		$carousel_class = 'carousel-wrapper-'.uniqid();
			$output .= '
			<script type="text/javascript">
				jQuery(document).ready(function(){
					jQuery(".'. $carousel_class .'").slick({
						rtl: '. $slick_rtl .',
						slidesToShow: '. esc_attr($column) .',
						slidesToScroll: 1,
						prevArrow: "<span class=\'carousel-prev\'><i class=\'fa fa-angle-left\'></i></span>",
        				nextArrow: "<span class=\'carousel-next\'><i class=\'fa fa-angle-right\'></i></span>",
        				responsive: [{
						    breakpoint: 1024,
						    settings: {
						    slidesToShow: '. esc_attr($column) .'
						    }
						},
						{
						    breakpoint: 600,
						    settings: {
						    slidesToShow: 2
						    }
						},
						{
						    breakpoint: 480,
						    settings: {
						    slidesToShow: 1
						    }
						}]
					});
				});
			</script>';
	}

	if ( $page_childrens->have_posts() ) :

		$output .= '
		<div class="grid-wrapper grid-'.$column.'-columns grid-row '. $carousel_class .'">';

		while ( $page_childrens->have_posts() ) : $page_childrens->the_post(); $count++;

			$output .= '
			<div class="grid-item '. $col_class .'">';

				if( has_post_thumbnail() ) {
				$output .= '
				<div class="grid-thumbnail">
					<a href="'. get_the_permalink() .'" title="'. get_the_title() .'">'. get_the_post_thumbnail( get_the_ID(), 'medium-thumb') .'</a>
				</div>';
				}
				
				$output .= '
				<h3 class="grid-title"><a href="'. get_the_permalink() .'" rel="bookmark">'. get_the_title() .'</a></h3>

				<p>'. get_the_excerpt() .'</p>

				<a class="grid-more" href="'. get_the_permalink() .'" title="'. get_the_title() .'">'. esc_attr($readmore_text) .'</a>

			</div>
			';
			if ( $layout == 'grid' ) {
				if ( $count % $column == 0 ) $output .= '
				<div class="clear"></div>';
			}

		endwhile;

		$output .= '
		</div>';

		else:
			$output .= __( 'Sorry, there is no child pages under your selected page.', 'wpcharming' );
	endif;

	wp_reset_postdata();

	return $output;

}


