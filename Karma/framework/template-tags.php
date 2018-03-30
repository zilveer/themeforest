<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package sole
 */

if ( ! function_exists( 'tt_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 */
function tt_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'tt_localize' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'tt_localize' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'tt_localize' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'tt_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function tt_posted_on() {
			
	global $ttso;
	$ka_posted_by             = $ttso->ka_posted_by;
	$ka_post_date             = $ttso->ka_post_date;
	
	
	if(is_archive()):
	        
	        //This is archive. 
	        //In WordPress the archive loop will grab post according to publish date, ignoring whether it was modified recently.
	        //therefore, we show only the publish date, or it will look weird with it's modified date.
	
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);
			
			if($ka_post_date !== 'true'):
				printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
						esc_url( get_permalink() ),
						$time_string
				);
			endif;	
	
	else:
		
			//This is for masonary blog layout, it will show the updated date (modified time), if there is any.
			
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="updated" datetime="%3$s">%4$s</time>';
			}
		
			$time_string = sprintf( $time_string,
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() ),
				esc_attr( get_the_modified_date( 'c' ) ),
				esc_html( get_the_modified_date() )
			);
			
			if($ka_post_date !== 'true'):
				printf( '<a href="%1$s" rel="bookmark">%2$s</a>',
						esc_url( get_permalink() ),
						$time_string
				);
			endif;
	
	endif;
	
	if ('true' != $ka_posted_by): ?>
		<span class="posted-by-text"><?php _e('by ', 'truethemes_localize') ?></span> <span class="vcard author"><span class="fn"><?php the_author_posts_link(); ?></span></span> 
    <?php endif;

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function tt_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'tt_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'tt_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tt_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tt_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in tt_categorized_blog.
 */
function tt_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'tt_categories' );
}
add_action( 'edit_category', 'tt_category_transient_flusher' );
add_action( 'save_post',     'tt_category_transient_flusher' );

/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 */
function truethemes_post_thumbnail() {
	if ( post_password_required() || is_attachment() ) {
		return;
	}
	
	global $post; //do not remove! or featured image external will not work!
		
	//featured image external
	$external_image_url = get_post_meta($post->ID,'truethemes_external_image_url',true);

	//featured image
	$thumb              = get_post_thumbnail_id();
	$image_width        = 500;
	$image_height       = 500; //This will be square, but if image uploaded is rectangle with height less than 500, then it will retain it's own height, anything bigger is cropped square.
	$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
	
	//use truethemes image croping script to crop image and return src
	$image_src = truethemes_crop_image($thumb,$external_image_url,$image_width,$image_height);

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<img src='<?php echo $image_src; ?>' width='<?php echo $image_width; ?>' height='<?php echo $image_height; ?>' alt='<?php echo $alt; ?>' />
	</div>

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<img src='<?php echo $image_src; ?>' width='<?php echo $image_width; ?>' height='<?php echo $image_height; ?>' alt='<?php echo $alt; ?>' />
	</a>

	<?php endif; // End is_singular()
}

function truethemes_post_video(){

	if ( post_password_required() || is_attachment() ) {
		return;
	}

	global $post; //do not remove!
	$video_url = get_post_meta($post->ID,'truethemes_video_url',true);
	$embed_video = apply_filters('the_content', '[embed width="538" height="418"]'.$video_url.'[/embed]');
	$p_tags = array('<p>','</p>');
	$embed_video = str_replace($p_tags,'',$embed_video); //remove p tags..
	echo "<div class='video_wrapper'>".$embed_video."</div>";

}