<?php
/**
 * Tag Archive Template
 */
  
// Get ID of page with Multimedia template
$tpl_page_id = risen_get_page_id_by_template( 'tpl-blog.php' );

// Header
get_template_part( 'header', 'blog-archive' );

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'blog', $tpl_page_id ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<header class="title-with-right">
				<h1 class="page-title">
					<?php
					$title = str_ireplace( '[tag]', single_cat_title( '', false ), risen_option( 'blog_tag_title' ) ); // title format from Theme Options
					echo apply_filters( 'the_title', $title );
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>

			<?php get_template_part( 'loop', 'blog' ); // loop through posts, if any ?>

			<?php risen_posts_nav( false, __( '<span>&larr;</span> Newer Posts', 'risen' ), __( 'Older Posts <span>&rarr;</span>', 'risen' ) ); // prev/next page links ?>
			
			<?php if ( ! have_posts() ) : // show message if no posts ?>
			<p><?php _e( 'Sorry, there are no posts that have this tag.', 'risen' ); ?></p>
			<?php endif; ?>
		
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'blog', $tpl_page_id ); ?>

<?php get_footer(); ?>