<?php
/**
 * Custom template tags for this theme.
 *
 *
 * @package heartfelt
 */


/*----------------------------------------------------*/
/*	Excerpt for Home Forums Section
/*----------------------------------------------------*/
	function heartfelt_new_excerpt_more( $more ) {
		return ' <span class="custom_excerpt"> ...</span>';
	}
	add_filter('excerpt_more', 'heartfelt_new_excerpt_more');

	function heartfelt_custom_excerpt_length( $length ) {
		return 12;
	}
	add_filter( 'excerpt_length', 'heartfelt_custom_excerpt_length', 999 );

/*----------------------------------------------------*/
/*  Template for comments and pingbacks.
/*----------------------------------------------------*/
if ( ! function_exists( 'heartfelt_comments' ) ) :
    function heartfelt_comments( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment;
        switch ( $comment->comment_type ) :
            case '' :
        ?>
        <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class=" clearfix">
                <div class="left">                    
                    <?php echo get_avatar($comment,$size='60',$default='mm' ); ?>                                       
                </div><!-- end left -->
                <div class="right-comments">
                    <div class="comment-text">                      
                        
                        <p class='comment-meta-header'>
                            <?php // Check if comment is by an admin then add badge
                                $comment = get_comment( $comment_id );
                                if ( user_can( $comment->user_id, 'administrator' ) ) : ?> 

                            <span class="rescue_staff round"><?php _e('Member', 'heartfelt'); ?></span>
                            <?php endif; ?>

                            <cite class="fn"><?php echo get_comment_author_link() ?></cite>                     
                            <span class="comment-meta commentmetadata"><?php comment_date(get_option('date_format')); ?></span>
                            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                        </p>
                        
                        <?php if ($comment->comment_approved == '0') : ?><p class="moderated"><?php _e('Your comment is awaiting moderation.','heartfelt'); ?></p><?php endif; ?>
                        <div class="comment_content">
                        <?php comment_text() ?>
                        </div>

                    </div><!--//end comment-text-->             
                </div><!--//end right-comments -->
            </div>
            
        <?php
            break;
            case 'pingback'  :
            case 'trackback' :
        ?>
            <li <?php comment_class('clearfix'); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="clearfix">
                    <?php echo "<div class='author'><em>" . __('Trackback:','heartfelt') . "</em> ".get_comment_author_link()."</div>"; ?>
                    <?php echo strip_tags(substr(get_comment_text(),0, 110)) . "..."; ?>
                    <?php comment_author_url_link('', '<small>', '</small>'); ?>
             </div>
            <?php
            break;
        endswitch;
    }
    endif;

/*----------------------------------------------------*/
/*	bbpress Avatar size http://goo.gl/A9qAoM
/*----------------------------------------------------*/
function heartfelt_bbp_avatar_size($author_avatar, $topic_id, $size) {
    $author_avatar = '';
    if ($size == 14) {
        $size = 44;
    }
    if ($size == 80) {
        $size = 100;
    }
    $topic_id = bbp_get_topic_id( $topic_id );
    if ( !empty( $topic_id ) ) {
        if ( !bbp_is_topic_anonymous( $topic_id ) ) {
            $author_avatar = get_avatar( bbp_get_topic_author_id( $topic_id ), $size );
        } else {
            $author_avatar = get_avatar( get_post_meta( $topic_id, '_bbp_anonymous_email', true ), $size );
        }
    }
    return $author_avatar;
}

/* Add priority (default=10) and number of arguments */
add_filter('bbp_get_topic_author_avatar', 'heartfelt_bbp_avatar_size', 20, 3);
add_filter('bbp_get_reply_author_avatar', 'heartfelt_bbp_avatar_size', 20, 3);
add_filter('bbp_get_current_user_avatar', 'heartfelt_bbp_avatar_size', 20, 3);


/*----------------------------------------------------*/
/*  Categories Widget
/*----------------------------------------------------*/
function heartfelt_categories_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count round"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('wp_list_categories','heartfelt_categories_postcount_filter');

/*----------------------------------------------------*/
/*  Archives Widget
/*----------------------------------------------------*/
function heartfelt_archive_postcount_filter ($variable) {
   $variable = str_replace('(', '<span class="post_count round"> ', $variable);
   $variable = str_replace(')', ' </span>', $variable);
   return $variable;
}
add_filter('get_archives_link', 'heartfelt_archive_postcount_filter');


if ( ! function_exists( 'heartfelt_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function heartfelt_paging_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination-centered round"><ul class="pagination round">' . "\n";

	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );

	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) )
			echo '<li>&period;&period;&period;</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active round"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>&period;&period;&period;</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );

	echo '</ul></div>' . "\n";

}
endif;

if ( ! function_exists( 'heartfelt_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 */
function heartfelt_post_nav() {

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'heartfelt' ); ?></h1>
		<div class="nav-links clearfix">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<div class="meta-nav-prev"><i class="fa fa-caret-left"></i></div> <div class="nav_prev_link">%title</div>', 'Previous post link', 'heartfelt' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '<div class="nav_next_link">%title</div> <div class="meta-nav-next"><i class="fa fa-caret-right"></i></div>', 'Next post link',     'heartfelt' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'heartfelt_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function heartfelt_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">%1$s</span> by <span class="byline"> %2$s</span>', 'heartfelt' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function heartfelt_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'heartfelt_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'heartfelt_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so heartfelt_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so heartfelt_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in heartfelt_categorized_blog.
 */
function heartfelt_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'heartfelt_categories' );
}
add_action( 'edit_category', 'heartfelt_category_transient_flusher' );
add_action( 'save_post',     'heartfelt_category_transient_flusher' );
