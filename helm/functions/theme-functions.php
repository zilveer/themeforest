<?php
//@ Wordpress 3 Features
//@ This theme uses wp_nav_menu() in one location.
if ( function_exists( 'register_nav_menu' ) ) {
	register_nav_menu( 'top_menu', 'Top Menu Links' );
}

//@ Page Menu
function mtheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mtheme_page_menu_args' );

//@Enable Backgrounds
if (function_exists('add_custom_background')) {
	add_custom_background();
}

//@Add Feed link
add_theme_support( 'automatic-feed-links' );
// Fit to Content Area
function fit_page_width() {
	if ( get_option(MTHEME . '_blog_sidebar') == 1 || get_option(MTHEME . '_blog_sidebar') == true  ) {
		$width=MAX_CONTENT_WIDTH;
	} else {
		$width=MIN_CONTENT_WIDTH;
	}
	return $width;
}

//@ Display Featured Image 
//@ and Post Meta information
function featured_image_post_meta($linked) { 
	global $post;
	?>
	<div class="post-featured-wrap dropshadow clearfix">
		<?php
		// Show Image
		echo showfeaturedimage (
			$post->ID,
			$linked,
			$resize=true,
			$height=0,
			$width=fit_page_width(),
			$quality=72, 
			$crop=1,
			$post->post_title,
			$class="post-featured-image" 
			);
		?>
		<div class="post-entry-meta-wrap">
			<div class="post-entry-meta">
				<span class="post-comments"><?php comments_popup_link('0', '1', '%'); ?></span>
				<div class="posted-in"><?php if ( count( get_the_category() ) ) { _e('Posted in: ','mthemelocal'); the_category(', '); } ?></div>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<?php
}

//@ Entry Meta Information
function post_entry_meta() { ?>
<div class="entry-meta">
	<div><?php the_tags( __('Tags: ','mthemelocal'), ', ', ''); ?></div>
	<div><?php _e('This entry was posted on','mthemelocal');?> <?php echo esc_attr( get_the_time() ); echo " , "; echo get_the_date(); ?></div>
	<div><?php _e('You can follow any responses to this entry through the','mthemelocal'); ?> <?php post_comments_feed_link('RSS 2.0');?> <?php _e('feed.','mthemelocal'); ?></div>
</div>
<?php
}
				
//@ Blog Sidebar check
function blog_sidebar_check( $blog_sidebar_flag ) {
	// Switch off Blog Sidebar and widen the contents area
	if ( $blog_sidebar_flag == 1 || $blog_sidebar_flag == true  ) {
	?>
	<div id="contents-wrap-wide">
	<?php
	} else {
	// Display the sidebar and Narrow the contents area
	?>
		<div id="sidebar-blog" class="float-left">
			<?php require (TEMPLATEPATH . "/sidebar-blog.php"); ?>
		</div>
		<div id="contents-wrap">
	<?php
	}
}

//@ Tweetmeme Button add function
function tweetmeme(){
?>
<div class="tweetmeme-button">
<script type="text/javascript">
tweetmeme_url = '<?php the_permalink(); ?>';
</script>
<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script>
</div>
<?php
}

//@ Facebook Like button
function facebook_like(){ ?>
<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink($post->ID)); ?>&amp;layout=box_count&amp;show_faces=false&amp;width=150&amp;action=like&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:150px; height:65px"></iframe>
<?php
}
?>