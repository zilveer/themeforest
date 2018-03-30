<?php
/**
 * Author Archive Template
 */
 
// Get ID of page with Multimedia template
$tpl_page_id = risen_get_page_id_by_template( 'tpl-blog.php' );

// Get author details
if ( have_posts() ) {

	// queue first post so we can get author info from it	
	the_post();

	// get author name
	$author_name = get_the_author();

	// go back to first so loop will work
	rewind_posts();
	
}

// No posts to determine author from, show 404
else {
	locate_template( '404.php', true );
	exit;
}

// Header
get_template_part( 'header', 'blog-archive');

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'blog', $tpl_page_id ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<section>
		
			<header class="title-with-right">
				<h1 class="page-title">
					<?php
					$title = str_ireplace( '[author]', $author_name, risen_option( 'blog_author_title' ) ); // title format from Theme Options
					echo apply_filters( 'the_title', $title );
					?>
				</h1>
				<div class="page-title-right"><?php risen_post_count_message(); ?></div>
				<div class="clear"></div>
			</header>
			
			<?php risen_author_box(); ?>

			<?php get_template_part( 'loop', 'blog' ); // loop through posts, if any ?>

			<?php risen_posts_nav( false, __( '<span>&larr;</span> Newer Posts', 'risen' ), __( 'Older Posts <span>&rarr;</span>', 'risen' ) ); // prev/next page links ?>
		
		</section>
		
	</div>

</div>

<?php risen_show_sidebar( 'blog', $tpl_page_id ); ?>

<?php get_footer(); ?>