<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package CookingPress
 */

if ( ! function_exists( 'cookingpress_content_nav' ) ) :
/**
 * Display navigation to next/previous pages when applicable
 */
function cookingpress_content_nav( $nav_id ) {
	global $wp_query, $post;

	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous )
			return;
	}

	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;

	$nav_class = ( is_single() ) ? 'post-navigation' : 'paging-navigation';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'cookingpress' ); ?></h1>

		<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php
		$prevpost = get_previous_post();
		if($prevpost) {
			$prevThumbnail = get_the_post_thumbnail($prevpost->ID, 'slider-thumb');
			previous_post_link( '<div class="nav-previous">%link</div>', $prevThumbnail.'<span class="meta-nav">'  . _x(  '&larr; Previous post ', 'cookingpress' ) . '</span> <br /> %title' );
		}
		?>
		<?php
		$nextpost = get_next_post();
		if($nextpost) {
			$nextThumbnail =  get_the_post_thumbnail($nextpost->ID, 'slider-thumb');
			next_post_link( '<div class="nav-next">%link</div>',  $nextThumbnail.'<span class="meta-nav">' . _x( 'Next post link &rarr;', 'cookingpress' ) . '</span> <br /> %title ' );
		}
		?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

	<?php if ( get_next_posts_link() ) : ?>
	<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'cookingpress' ) ); ?></div>
<?php endif; ?>

<?php if ( get_previous_posts_link() ) : ?>
	<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'cookingpress' ) ); ?></div>
<?php endif; ?>

<?php endif; ?>

</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
<?php
}
endif; // cookingpress_content_nav

if ( ! function_exists( 'cookingpress_comment2' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function cookingpress_comment2( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'cookingpress' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'cookingpress' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'cookingpress' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'cookingpress' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'cookingpress' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'cookingpress' ); ?></p>
			<?php endif; ?>
		</footer><!-- .comment-meta -->

		<div class="comment-content">
			<?php comment_text(); ?>
		</div><!-- .comment-content -->

		<?php
		comment_reply_link( array_merge( $args, array(
			'add_below' => 'div-comment',
			'depth'     => $depth,
			'max_depth' => $args['max_depth'],
			'before'    => '<div class="reply">',
			'after'     => '</div>',
			) ) );
			?>
		</article><!-- .comment-body -->

		<?php
		endif;
	}
endif; // ends check for cookingpress_comment()

if ( ! function_exists( 'cookingpress_the_attached_image' ) ) :
/**
 * Prints the attached image with a link to the next attached image.
 */
function cookingpress_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'cookingpress_attachment_size', array( 1200, 1200 ) );
	$next_attachment_url = wp_get_attachment_url();

	/**
	 * Grab the IDs of all the image attachments in a gallery so we can get the
	 * URL of the next adjacent image in a gallery, or the first image (if
	 * we're looking at the last image in a gallery), or, in a gallery of one,
	 * just the link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID'
		) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
		);
}
endif;

if ( ! function_exists( 'cookingpress_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function cookingpress_posted_on() {
	global $post;


	$time_string = '<time class="entry-date updated" datetime="%1$s">%2$s</time>';
/*	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}*/
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
		);

	$level = get_the_term_list( $post->ID, 'level', ' ', ', ', '  ' );
	$time = get_the_term_list( $post->ID, 'timeneeded', ' ', ', ', '  ' );
	$serving =  get_the_term_list( $post->ID, 'serving', ' ', ', ', ' ' );
	$allergens =  get_the_term_list( $post->ID, 'allergen', ' ', ', ', ' ' );
	if(is_single()) {$metadata = ot_get_option('pp_meta_single'); } else { $metadata = ot_get_option('pp_meta_blog'); }


	if(!empty($metadata)) {

		echo '<ul class="post-meta">';
		if (in_array("com", $metadata)) {
			echo '<li><i class="fa fa-comment"></i> ';
			comments_popup_link(
		        __('<span>0</span> ', 'cookingpress'), //zero
		        __('<span>1</span> ', 'cookingpress'), //one
		        __('<span>%</span> ', 'cookingpress'), //more
		        ''
		        );
			echo "</li>";
		}
		if (in_array("author", $metadata)) {
			printf(
				__( '<li>%1$s</li>', 'cookingpress' ),
				sprintf(
					'<span class="author vcard"><i class="fa fa-user"></i> <a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
					esc_attr( sprintf( __( 'View all posts by %s', 'cookingpress' ), get_the_author() ) ),
					esc_html( get_the_author() )
					)
				);
		}
		if (!empty($time) && in_array("time", $metadata)) {
			echo '<li class="recipe-time"><i class="fa fa-clock-o"></i>';
			echo $time;
			echo "</li>";
		}

		if (!empty($serving) && in_array("servings", $metadata)) {
			echo '<li class="recipe-servings"><i class="fa fa-cutlery"></i> ';
			echo $serving;
			echo "</li>";
		}

		if (!empty($level) && in_array("level", $metadata)) {
			echo '<li class="recipe-level"><i class="fa fa-tasks"></i> ';
			echo '<em>';
			 _e('Level:','cookingpress');
			echo '</em> '.$level;
			echo "</li>";
		}

		if (!empty($allergens) && in_array("allergens", $metadata)) {
			echo '<li class="recipe-allergens">';
			echo '<i class="fa fa-warning"></i> <em>'; _e('Food Allergens:','cookingpress'); echo '</em> '.$allergens;
			echo "</li>";
		}

		if (in_array("cat", $metadata)) {
			echo '<li class="cats"><i class="fa fa-file"></i> ';
			_e('In:','cookingpress');
	
			the_category(', ');
			echo "</li>";
		}

		if (in_array("tags", $metadata)) {
			if (has_tag()) {
				echo "<li class=\"tags\"><i class=\"fa fa-tag\"></i> ";
				the_tags(__(' Tagged with:  ','cookingpress'), ',  ', ' ');
				echo "</li>";
			}
		}

		if (in_array("date", $metadata)) {


        $time_string = '<li><i class="fa fa-calendar"></i> <time class="entry-date published" datetime="%1$s">%2$s</time></li>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<li><i class="fa fa-calendar"></i> <time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time></li>';
        }

        $time_string = sprintf( $time_string,
            esc_attr( get_the_date( 'c' ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( 'c' ) ),
            esc_html( get_the_modified_date() )
        );
        echo $time_string;

		}


		//author


		//comments


		echo '</ul>';
	} //eof if
}
endif;

/**
 * Returns true if a blog has more than 1 category
 */
function cookingpress_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
			) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so cookingpress_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so cookingpress_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in cookingpress_categorized_blog
 */
function cookingpress_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'cookingpress_category_transient_flusher' );
add_action( 'save_post',     'cookingpress_category_transient_flusher' );


if ( ! function_exists( 'cookingpress_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since astrum 1.0
 */
function cookingpress_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
	case 'pingback' :
	case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'astrum' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'cookingpress' ), ' ' ); ?></p>
		<?php
		break;
		default :
		?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment">
				<div class="avatar"><?php echo get_avatar( $comment, 60 ); ?></div>
				<div class="comment-des">
					<div class="comment-by">
						<?php printf( '<strong>%s</strong>', get_comment_author_link() ); ?>
						<span class="date">
							<time datetime="<?php comment_time( 'c' ); ?>">
								<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'cookingpress' ), get_comment_date(), get_comment_time() ); ?>
							</time>
							<?php edit_comment_link( __( 'Edit', 'cookingpress' ), '', '' ); ?>
						</span>
					</div>
					<?php comment_text(); ?>
					<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<div class="reply">',
						'after'     => '</div>',
						) ) );
						?>
					</div>
				</article><!-- #comment-## -->
				<?php
				break;
				endswitch;
			}
endif; // ends check for astrum_comment()



function cp_continue_reading_link() {
	return ' <a class="cp-read-more" href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyten' ) . '</a>';
}

function cp_excerpt_more( $more ) {
	return '  &hellip; ' . cp_continue_reading_link();
}
add_filter( 'excerpt_more', 'cp_excerpt_more' );



class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
	var $to_depth = -1;
    function start_lvl(&$output, $depth = 0, $args = array()){
      $output .= '</option>';
  }

  function end_lvl(&$output, $depth = 0, $args = array()){
      $indent = str_repeat("\t", $depth); // don't output children closing tag
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0){
      $indent = ( $depth ) ? str_repeat( "&#151; ", $depth * 1 ) : '';
      $class_names = $value = '';
      $classes = empty( $item->classes ) ? array() : (array) $item->classes;
      $classes[] = 'menu-item-' . $item->ID;
      $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
      $class_names = ' class="' . esc_attr( $class_names ) . '"';
      $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
      $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
      $value = ' value="'. $item->url .'"';
      $output .= '<option'.$id.$value.$class_names.'>';
      $item_output = $args->before;
      $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
      $output .= $indent.$item_output;
  }

  function end_el(&$output, $item, $depth = 0, $args = array()){
      if(substr($output, -9) != '</option>')
      		$output .= "</option>"; // replace closing </li> with the option tag

      }
  }

