<?php
		automatic_feed_links();
	
	// Register Sidebars
		if ( function_exists('register_sidebar') ) {
			register_sidebar(array(
				'name' => 'Page Widget',
				'description' => 'Widget Area for all pages. Does not include Home Page Template',
				'before_widget' => '<div class="content" id="content_right">',
				'after_widget' => '</div>',
				'before_title' => '<div class="content_right_h"><h3>',
				'after_title' => '</h3></div>',
			));
			register_sidebar(array(
				'name' => 'Home Widget',
				'description' => 'Widget Area for the home page template',
				'before_widget' => '<div class="content" id="content_right">',
				'after_widget' => '</div>',
				'before_title' => '<div class="content_right_h"><h3>',
				'after_title' => '</h3></div>',
			));
			register_sidebar(array(
				'name' => 'Error Page Side Widget',
				'description' => 'Widget Area on the right side of the error page.',
				'before_widget' => '<div class="content" id="content_right">',
				'after_widget' => '</div>',
				'before_title' => '<div class="content_right_h"><h3>',
				'after_title' => '</h3></div>',
			));
			register_sidebar(array(
				'name' => 'Error Page Widget',
				'description' => 'The Center Content for the error page, Error Page Side Widget is activated on this page as well.',
				'before_widget' => '',
				'after_widget' => '<br style="clear:both" />',
				'before_title' => '<div class="content_left_h"><h3>',
				'after_title' => '</h3></div>',
			));
		}

	// Disable not wanted style sheets
		function my_deregister_styles() {
			wp_deregister_style('wp-pagenavi');
		}
		add_action('wp_print_styles','my_deregister_styles',100);
		
	// Get category ID by name
		function get_catid($category_slug) {
			global $wpdb;
			$category_ID = $wpdb->get_var( "SELECT term_id FROM $wpdb->terms WHERE slug = '" . $category_slug . "'" );
			return $category_ID;
		}

		
	// Comments Callback funtion
		function my_comments($comment, $args, $depth) {
		   $GLOBALS['comment'] = $comment; ?>
				<li <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">
					<div class="picture alignleft">
						<?php echo get_avatar($comment,$size='64',$default=get_bloginfo('template_url').'/images/gravatar.jpg' ); ?>
						<?php comment_reply_link(array_merge( $args, array('reply_text' => 'Reply','depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>
					<div class="comment-text alignright">
						<div class="author-date">
							<div class="author-link alignleft"><? comment_author_link() ?></div>
							<div class="date-info alignright"><?php comment_date('l, F jS, Y'); ?></div>
						</div>
						<?php comment_text(); ?>
					</div>
		<?php
		}
		
	// Include Theme Options
		include(TEMPLATEPATH . "/theme-options.php");
?>
