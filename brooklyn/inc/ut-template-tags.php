<?php

if ( ! function_exists( 'unitedthemes_content_nav' ) ) :

/*
|--------------------------------------------------------------------------
| Display navigation to next/previous pages when applicable
|--------------------------------------------------------------------------
*/

function unitedthemes_content_nav( $nav_id ) {
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

	$nav_class = ( is_single() ) ? 'post-navigation clearfix' : 'paging-navigation clearfix';

	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<i class="fa fa-angle-left"></i>' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '<i class="fa fa-angle-right"></i>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_next_posts_link() ) : ?>
       
        <div class="nav-previous">
            <a href="<?php next_posts(); ?>#to-main-content"><i class="fa fa-angle-left"></i></a>
        </div>
        
		<?php endif; ?>

		<?php if ( get_previous_posts_link() ) : ?>
       
		<div class="nav-next">
            <a href="<?php previous_posts();?>#to-main-content"><i class="fa fa-angle-right"></i></a>
        </div>
       
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // unitedthemes_content_nav

if ( ! function_exists( 'unitedthemes_comment' ) ) :

/*
|--------------------------------------------------------------------------
| Template for comments and pingbacks
| Used as a callback by wp_list_comments() for displaying the comments
|--------------------------------------------------------------------------
*/

function unitedthemes_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;
	
	/* override default avatar size */
	$args['avatar_size'] = 80;
			
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    
		<div class="comment-body">
			<?php _e( 'Pingback:', 'unitedthemes' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit Comment', 'unitedthemes' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>
	
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
            
		<article id="div-comment-<?php comment_ID(); ?>" class="clearfix">
        
            <figure class="comment-avatar hide-on-mobile">
            	<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      		</figure><!-- .comment-avatar -->
            
            <div class="ut-arrow-left"></div>
            
            <div class="comment-body">
            <header class="comment-header">
				
                <div class="comment-author vcard">				
					<?php printf( __( '%s', 'unitedthemes' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->
                
                <div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s', '1: date', 'unitedthemes' ), get_comment_date() ); ?>
						</time>
					</a>
				</div><!-- .comment-metadata --> 

			</header><!-- .comment-meta -->

			<div class="comment-content clearfix">
            	<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'unitedthemes' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<footer class="comment-footer clearfix">				
                <span class="reply-link"><i class="fa fa-reply"></i>
				<?php comment_reply_link( array_merge( $args, array( 'add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </span>               
				<?php edit_comment_link( __( 'Edit Comment', 'unitedthemes' ), '<span class="edit-link"></i>', '</span>' ); ?>               
			</footer><!-- .reply -->
            
            </div>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for unitedthemes_comment()

if ( ! function_exists( 'unitedthemes_the_attached_image' ) ) :

/*
|--------------------------------------------------------------------------
| Prints the attached image with a link to the next attached image
|--------------------------------------------------------------------------
*/

function unitedthemes_the_attached_image() {
	$post                = get_post();
	$attachment_size     = apply_filters( 'unitedthemes_attachment_size', array( 1200, 1200 ) );
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


if ( ! function_exists( 'unitedthemes_categorized_blog' ) ) :


/*
|--------------------------------------------------------------------------
| Returns a nice WP Links Pages list
|--------------------------------------------------------------------------
*/


/*
* @param - before - string
* @param - after - string
* @param - nextpagelink - string
* @param - previouspagelink - string
* @param - pagelink - string
* @param - echo - bolean
*/

function ut_link_pages($args = '') {
	
	$defaults = array(
		'before' => '<p>', 
		'after' => '</p>',
		'next_or_number' => 'number', 
		'nextpagelink' => __('Next page', 'unitedthemes' ),
		'previouspagelink' => __('Previous page', 'unitedthemes'), 
		'pagelink' => '%',
		'echo' => 1
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'lambda_link_pages_args', $r );
	extract( $r, EXTR_SKIP );

	global $page, $numpages, $multipage, $more, $pagenow;

	$output = '';
	
	if ( $multipage ) {
		
		if ( 'number' == $next_or_number ) {
			
			$output .= $before;
			$output .= '<ul>';
			$output .= '<li><span>'.__('Pages', 'unitedthemes' ).'</span></li>';
			
			for ( $i = 1; $i < ($numpages+1); $i = $i + 1 ) {
				
				$j = str_replace('%',$i,$pagelink);		
				
				if ( ($i != $page) || ((!$more) && ($page==1)) ) {
					
					$output .= '<li>'._wp_link_page($i);
					
				} else {
					$output .= '<li class="active"><a href="#">';					
				}
				
				$output .= $j . '</a></li>';			
					
			}
			$output .= '</ul>';
			$output .= $after;
			
		} else {
			
			if ( $more ) {
				$output .= $before;
				$output .= '<ul>';
				
				$i = $page - 1;
				if ( $i && $more ) {
					$output .= '<li>'._wp_link_page($i);
					$output .= $previouspagelink . '</a></li>';
				}
				$i = $page + 1;
				if ( $i <= $numpages && $more ) {
					$output .= '<li>'._wp_link_page($i);
					$output .=  $nextpagelink . '</a></li>';
				}
				
				$output .= '</ul>';
				$output .= $after;
			}
			
		}
	}
	
	if ( $echo )
		echo $output;

	return $output;
	
}

/*
|--------------------------------------------------------------------------
| Returns true if a blog has more than 1 category
|--------------------------------------------------------------------------
*/

function unitedthemes_categorized_blog() {
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
		// This blog has more than 1 category so unitedthemes_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so unitedthemes_categorized_blog should return false
		return false;
	}
}

endif;

if ( ! function_exists( 'unitedthemes_category_transient_flusher' ) ) :

/*
|--------------------------------------------------------------------------
| Flush out the transients used in unitedthemes_categorized_blog
|--------------------------------------------------------------------------
*/
function unitedthemes_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'unitedthemes_category_transient_flusher' );
add_action( 'save_post',     'unitedthemes_category_transient_flusher' );

endif;