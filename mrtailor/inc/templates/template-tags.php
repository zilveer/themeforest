<?php

if ( ! is_admin() ) {

function grab_ids_from_gallery() {
			
	global $post;
    
    if ( !isset($post) ) return;
    
	$attachment_ids = array();
	$pattern = get_shortcode_regex();
	$ids = array();
	
	if (preg_match_all( '/'. $pattern .'/s', $post->post_content, $matches ) ) {   //finds the "gallery" shortcode and puts the image ids in an associative array at $matches[3]
		//$count = count($matches[3]); //in case there is more than one gallery in the post.
		$count = 1;
		for ($i = 0; $i < $count; $i++){
			$atts = shortcode_parse_atts( $matches[3][$i] );
			if ( isset( $atts['ids'] ) ){
				$attachment_ids = explode( ',', $atts['ids'] );
				$ids = array_merge($ids, $attachment_ids);
			}
		}
	}
	
	return $ids;
	
}
add_action( 'wp', 'grab_ids_from_gallery' );

}





if ( ! function_exists( 'mr_tailor_content_nav' ) ) :
function mr_tailor_content_nav( $nav_id ) {
	global $wp_query, $post, $mr_tailor_theme_options;
    
    $blog_with_sidebar = "";
    if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "1" ) ) $blog_with_sidebar = "yes";
    if (isset($_GET["blog_with_sidebar"])) $blog_with_sidebar = $_GET["blog_with_sidebar"];

	
	$blog_masonry = "";
	if ( (isset($mr_tailor_theme_options['sidebar_blog_listing'])) && ($mr_tailor_theme_options['sidebar_blog_listing'] == "2" ) ) :
		$blog_masonry = "yes";
	endif;
	
	
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

        <div class="row">
        
			<?php if ( $blog_masonry == "yes" && !is_single() ) : ?>
            <div class="large-12 columns">
        	<?php elseif ( $blog_with_sidebar == "yes" ) : ?>
            <div class="large-12 columns">
        	<?php else : ?>
            <div class="large-8 large-centered columns without-sidebar">
        	<?php endif; ?>
        
				<?php if ( is_single() ) : // navigation links for single posts ?>
        
                    <div class="row">
                        
                        <div class="large-6 columns text-center">
                            <div class="nav-previous"><?php previous_post_link( '%link', '<div class="nav-previous-title">'.__( "Previous Reading", "mr_tailor" ).'</div> &larr; %title' ); ?></div>
                        </div><!-- .columns -->
                        
                        <div class="large-6 columns text-center">
                            <div class="nav-next"><?php next_post_link( '%link', '<div class="nav-next-title">'.__( "Next Reading", "mr_tailor" ).'</div> %title &rarr;' ); ?></div>
                        </div><!-- .columns -->
                        
                    </div><!-- .row -->
            
				<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
            
					<div class="archive-navigation">
						<div class="row">
							
							<div class="small-6 columns text-left">
								<?php if ( get_next_posts_link() ) : ?>
								<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'mr_tailor' ) ); ?></div>
								<?php endif; ?>
							</div>
							
							<div class="small-6 columns text-right">
								<?php if ( get_previous_posts_link() ) : ?>
								<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mr_tailor' ) ); ?></div>
							<?php endif; ?>
							</div>
						
						</div>
					</div>
				
                <?php endif; ?>
            
            </div><!-- .columns -->
        
        </div><!-- .row -->

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
	<?php
}
endif; // mr_tailor_content_nav





if ( ! function_exists( 'mr_tailor_product_nav' ) ) :
function mr_tailor_product_nav( $nav_id ) {
	
	global $wp_query, $post;
	
	// get_posts in same custom taxonomy
	$postlist_args = array(
	   'posts_per_page'  => -1,
	   'orderby'         => 'menu_order title',
	   'order'           => 'ASC',
	   'post_type'       => 'product',
	   'your_custom_taxonomy' => 'product_cat'
	); 
	
	$postlist = get_posts( $postlist_args );
	
	// get ids of posts retrieved from get_posts
	
	$ids = array();
	
	foreach ($postlist as $thepost) {
	   $ids[] = $thepost->ID;
	}
	
	// get and echo previous and next post in the same taxonomy        
	
	$thisindex = array_search($post->ID, $ids);
	
	$previd = "";
	$nextid = "";
	
	if (isset($ids[$thisindex-1])) $previd = $ids[$thisindex-1];
	
	if (isset($ids[$thisindex+1])) $nextid = $ids[$thisindex+1];

	if (defined('ICL_SITEPRESS_VERSION')) {
		$product_prev_link = get_permalink(icl_object_id($previd, 'product', true));
		$product_next_link = get_permalink(icl_object_id($nextid, 'product', true));
	} else {
		$product_prev_link = get_permalink($previd);
		$product_next_link = get_permalink($nextid);
	}
	
	?>
	
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="product-navigation">
	
        <?php if ( !empty($previd) ) : ?>
            <div class="product-nav-previous">
                <a class="product_nav_link_left" href="<?php echo $product_prev_link; ?>">
                    <i class="getbowtied-icon-arrow_left"></i>
                    <?php $product_nav_img_prev = wp_get_attachment_image_src( get_post_thumbnail_id($previd), 'shop_thumbnail' ); ?>
                    <img class="product_nav_img" src="<?php echo $product_nav_img_prev[0]; ?>" alt="<?php echo get_the_title($previd); ?>">
                </a>
            </div>
        <?php endif; ?>

        <?php if ( !empty($nextid) ) : ?>    
            <div class="product-nav-next">
                <a class="product_nav_link_right" href="<?php echo $product_next_link; ?>">
                    <?php $product_nav_img_next = wp_get_attachment_image_src( get_post_thumbnail_id($nextid), 'shop_thumbnail' ); ?>
                    <img class="product_nav_img" src="<?php echo $product_nav_img_next[0]; ?>" alt="<?php echo get_the_title($nextid); ?>">
                    <i class="getbowtied-icon-arrow_right"></i>
                </a>
            </div>
        <?php endif; ?>

	</nav><!-- #<?php echo esc_html( $nav_id ); ?> -->
    
    <?php	
	
}
endif; // mr_tailor_product_nav




if ( ! function_exists( 'mr_tailor_comment' ) ) :
function mr_tailor_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'mr_tailor' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'mr_tailor' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">

			<div class="comment-content">
				
				<div class="comment-author-avatar">
					<?php echo get_avatar( $comment, 140 ); ?>
				</div><!-- .comment-author-avatar -->
				
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'mr_tailor' ); ?></p>
				<?php endif; ?>
				
				<?php printf( __( '%s', 'mr_tailor' ), sprintf( '<h3 class="comment-author">%s</h3>', get_comment_author_link() ) ); ?>
                
                <div class="comment-metadata">
                    <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
                        <time datetime="<?php comment_time( 'c' ); ?>">
                            <?php printf( __( '%1$s at %2$s', 'mr_tailor' ), get_comment_date(), get_comment_time() ); ?>
                        </time>
                    </a>
                </div><!-- .comment-metadata -->

				<div class="comment-text"><?php comment_text(); ?></div><!-- .comment-text -->
                
                <?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<span class="comment-reply"><i class="fa fa-reply"></i>',
						'after'     => '</span>',
					) ) );
				?>
				
				<?php edit_comment_link( __( 'Edit', 'mr_tailor' ), '<span class="comment-edit-link"><i class="fa fa-pencil-square-o"></i>', '</span>' ); ?>
                
			</div><!-- .comment-content -->
            
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for mr_tailor_comment()




/**
 * Returns true if a blog has more than 1 category.
 */
function mr_tailor_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so mr_tailor_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so mr_tailor_categorized_blog should return false.
		return false;
	}
}




/**
 * Flush out the transients used in mr_tailor_categorized_blog.
 */
function mr_tailor_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'mr_tailor_category_transient_flusher' );
add_action( 'save_post',     'mr_tailor_category_transient_flusher' );
